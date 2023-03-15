<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Resource/ComponenteDigitalResource.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Resource;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Knp\Snappy\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html as ReaderHtml;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use ReflectionException;
use RuntimeException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital as ComponenteDigitalDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Crypto\CryptoManager;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\EARQ\EARQEventoPreservacaoLoggerInterface;
use SuppCore\AdministrativoBackend\Entity\Assinatura;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital as Entity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Filesystem\FilesystemManager;
use SuppCore\AdministrativoBackend\Repository\ComponenteDigitalRepository as Repository;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use SuppCore\AdministrativoBackend\Utils\CompressServiceInterface;
use SuppCore\AdministrativoBackend\Utils\ZipStream;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Process\Process;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

/**
 * Class ComponenteDigitalResource.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @codingStandardsIgnoreStart
 *
 * @method Repository  getRepository(): Repository
 * @method Entity[]    find(array $criteria = null, array $orderBy = null, int $limit = null, int $offset = null, array $search = null, array $populate = null): array
 * @method Entity|null findOne(int $id, bool $throwExceptionIfNotFound = null): ?EntityInterface
 * @method Entity|null findOneBy(array $criteria, array $orderBy = null, bool $throwExceptionIfNotFound = null): ?EntityInterface
 * @method Entity      create(RestDtoInterface $dto, string $transactionId, bool $skipValidation = null): EntityInterface
 * @method Entity      update(int $id, RestDtoInterface $dto, string $transactionId, bool $skipValidation = null): EntityInterface
 * @method Entity      delete(int $id, string $transactionId): EntityInterface
 * @method Entity      save(EntityInterface $entity, string $transactionId, bool $skipValidation = null): EntityInterface
 *
 * @codingStandardsIgnoreEnd
 */
class ComponenteDigitalResource extends RestResource
{
    /** @noinspection MagicMethodsValidityInspection */

    /**
     * ComponenteDigitalResource constructor.
     *
     * @param Repository                    $repository
     * @param ValidatorInterface            $validator
     * @param ParameterBagInterface         $parameterBag
     * @param CompressServiceInterface      $compresser
     * @param Pdf                           $pdfManager
     * @param Environment                   $twig
     * @param CryptoManager                 $cryptoManager
     * @param FilesystemManager             $filesystemManager
     * @param ZipStream                     $zipStream
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        private Repository $repository,
        private ValidatorInterface $validator,
        private ParameterBagInterface $parameterBag,
        private CompressServiceInterface $compresser,
        private Pdf $pdfManager,
        private Environment $twig,
        private CryptoManager $cryptoManager,
        private FilesystemManager $filesystemManager,
        private ZipStream $zipStream,
        private AuthorizationCheckerInterface $authorizationChecker,
        private EARQEventoPreservacaoLoggerInterface $eventoPreservacaoLogger
    ) {
        $this->setRepository($repository);
        $this->setValidator($validator);
        $this->setDtoClass(ComponenteDigitalDTO::class);
    }

    /**
     * @return EntityInterface|null
     */
    public function download(
        int $id,
        string $transactionId,
        ?bool $chancelaAssinatura = null,
        ?bool $asPdf = null,
        ?string $versao = null,
        ?bool $throwExceptionIfNotFound = null,
        ?bool $asXls = null
    ): ?Entity {
        $throwExceptionIfNotFound ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);
        $restDto = $this->getDtoForEntity($id, ComponenteDigitalDTO::class);

        // Before callback method call
        $this->beforeDownload($id, $restDto, $entity, $transactionId);

        // Entity not found
        if ($throwExceptionIfNotFound && null === $entity) {
            throw new NotFoundHttpException('Not found');
        }

        // After callback method call
        $this->afterDownload($id, $restDto, $entity, $transactionId, $chancelaAssinatura, $asPdf, $versao, $asXls);

        return $entity;
    }

    /**
     * Before lifecycle method for download method.
     */
    public function beforeDownload(
        int &$id,
        ?RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertDownload');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeDownload');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeDownload');
    }

    public function afterDownload(
        int &$id,
        ?RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId,
        ?bool $chancelaAssinatura = null,
        ?bool $asPdf = null,
        ?string $versao = null,
        ?bool $asXls = null
    ): void {
        $filesystem = $this->filesystemManager
            ->getFilesystemService($entity)
            ->get();
        if ($filesystem->has($entity->getHash())) {
            $entity->setConteudo(
                $this->compresser->uncompress(
                    $this->cryptoManager->getCryptoService(
                        $entity,
                        $dto
                    )->decrypt(
                        $filesystem->read($versao ? $versao : $entity->getHash())
                    )
                )
            );

            $this->eventoPreservacaoLogger
                ->logEPRES1Descompressao($entity)
                ->logEPRES2Decifracao($entity);
        } elseif ('prod' !== $this->parameterBag->get('kernel.environment')) {
            $html =
                <<<'HTML'
                        <!DOCTYPE html>
                        <html lang="pt">
                            <head>
                                <meta charset="utf-8">
                                <title>SUPP</title>
                            </head>
                            <body>
                                <p>Documento gerado para desenvolvimento</p>
                            </body>
                        </html>
HTML;
            if ('text/html' === $entity->getMimetype()) {
                $entity->setConteudo($html);
            } else {
                if (!mb_detect_encoding($html, 'UTF-8', true)) {
                    $html = utf8_encode($html);
                }
                $entity->setConteudo(
                    $this->pdfManager->getOutputFromHtml($html)
                );
            }
        } else {
            throw new RuntimeException('Houve erro na recuperação do arquivo no filesystem!');
        }

        // validação storage filesystem
        $hash = hash($this->parameterBag->get('algoritmo_hash_componente_digital'), $entity->getConteudo());
        if ($entity->getHash() !== $hash && !$versao) {
            $this->eventoPreservacaoLogger->logEPRES5FixidadeInvalida($dto, 'checksum');
            throw new RuntimeException('O conteúdo do Componente Digital não bate com o hash!');
        }
        $this->eventoPreservacaoLogger->logEPRES5FixidadeValida($entity, 'checksum');

        // append das chancelas de assinaturas
        if ($chancelaAssinatura && 'text/html' === $entity->getMimetype()) {
            $linkSistema = $this->parameterBag->get('supp_core.administrativo_backend.url_sistema_frontend');
            if ($entity->getDocumento()->getJuntadaAtual()) {
                $chaveAcesso = $entity->getDocumento()->getJuntadaAtual()->getVolume()->getProcesso()->getChaveAcesso();
            } else {
                $chaveAcesso = $entity->getDocumento()->getProcessoOrigem()?->getChaveAcesso();
            }

            /** @var Assinatura $assinatura */
            foreach ($entity->getAssinaturas() as $assinatura) {
                $sCertChain = $assinatura->getCadeiaCertificadoPEM();
                if (false == $sCertChain) {
                    continue;
                }

                if ('cadeia_teste' === $sCertChain) {
                    $assinatura = "<br><br><hr><div style='text-align: justify;'>Documento assinado eletronicamente por TESTE, de acordo com os normativos legais aplicáveis.
                            A conferência da autenticidade do documento está disponível com o código $id e chave de acesso $chaveAcesso no endereço eletrônico $linkSistema.
                            Informações adicionais:
                            Signatário (a): TESTE.
                            Data e Hora: TESTE.
                            Número de Série: TESTE.
                            Emissor: TESTE.</div><hr>";
                    $conteudo = str_replace('</body>', '', $entity->getConteudo());
                    $conteudo = str_replace('</html>', '', $conteudo);
                    $entity->setConteudo($conteudo.$assinatura.'</body></html>');
                    continue;
                }
                $aCertChain = explode('-----END CERTIFICATE-----', $sCertChain);
                if (false === $sCertChain || 0 == count($aCertChain)) {
                    continue;
                }
                $firstCert = $aCertChain[0].'-----END CERTIFICATE-----';
                $parsed = openssl_x509_parse($firstCert, true);
                if (false === $parsed) {
                    continue;
                }
                if (false === isset($parsed['subject']['CN']) ||
                    false === isset($parsed['serialNumber']) ||
                    false === isset($parsed['issuer']['CN'])) {
                    continue;
                }
                $nomeProcessado = explode(':', $parsed['subject']['CN']);
                if (isset($nomeProcessado[0])) {
                    $nome = $nomeProcessado[0];
                } else {
                    $nome = $parsed['subject']['CN'];
                }
                $cnInstitucional = $this->parameterBag->get(
                    'supp_core.administrativo_backend.certificado_a1_institucional_CN'
                );
                if ($cnInstitucional && $nome === $cnInstitucional) {
                    $nome = $assinatura->getCriadoPor()->getNome().
                        ', com certificado A1 institucional ('.$cnInstitucional.')';
                }
                $serialNumber = $parsed['serialNumber'];
                $emissor = $parsed['issuer']['CN'];
                $dataHora = $assinatura->getDataHoraAssinatura()->format('d-m-Y H:i');
                $id = $entity->getId();
                $assinatura = $this->twig->render(
                    $this->parameterBag->get('supp_core.administrativo_backend.template_chancela_assinatura'),
                    [
                        'nome' => $nome,
                        'id' => $id,
                        'chaveAcesso' => $chaveAcesso,
                        'linkSistema' => $linkSistema,
                        'dataHora' => $dataHora,
                        'serialNumber' => $serialNumber,
                        'emissor' => $emissor,
                    ]
                );
                $conteudo = str_replace('</body>', '', $entity->getConteudo());
                $conteudo = str_replace('</html>', '', $conteudo);
                $entity->setConteudo($conteudo.$assinatura.'</body></html>');
            }
        }

        // transforma em PDF
        if ($asPdf && 'text/html' === $entity->getMimetype()) {
            $html = $entity->getConteudo();
            $entity->setConteudo(
                $this->pdfManager->getOutputFromHtml($html)
            );
            /*
            $entity->setMimetype('application/pdf');
            $entity->setExtensao('pdf');
            $entity->setFileName(str_replace('.html', '.pdf', str_replace('.HTML', '.pdf', $entity->getFileName())));
            */
        }

        // transforma em XLSX
        if ($asXls && 'text/html' === $entity->getMimetype()) {
            $entity->setConteudo(
                $this->htmlToXls($entity->getConteudo())
            );
            /*
            $entity->setMimetype('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $entity->setExtensao('xlsx');
            $entity->setFileName(
                str_replace(
                    '.html',
                    '.xlsx',
                    str_replace('.HTML', '.xlsx', $entity->getFileName())
                )
            );*/
        }
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'afterDownload');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterDownload');
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function reverter(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        /**
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeReverter($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterReverter($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    public function beforeReverter(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertReverter');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeReverter');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeReverter');
    }

    public function afterReverter(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterReverter');
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function aprovar(
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        /*
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */

        // Validate DTO
        $this->validateDto($dto, $skipValidation);

        // Before callback method call

        // Create or update entity
        $entity = new Entity();

        $this->beforeAprovar($dto, $entity, $transactionId);

        $skipValidation ??= false;

        $this->persistEntity($entity, $dto, $transactionId);

        // After callback method call
        $this->afterAprovar($dto, $entity, $transactionId);

        return $entity;
    }

    public function beforeAprovar(
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeAprovar');
    }

    public function afterAprovar(
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterAprovar');
    }

    /**
     * @throws AnnotationException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function convertPDF(
        int $id,
        string $transactionId,
        ?bool $skipValidation = null
    ): array {
        $componentesDigitais = $this->getRepository()->findBy(['documento' => $id]);
        $return['entities'] = [];

        foreach ($componentesDigitais as $componenteDigital) {
            if (!$this->authorizationChecker->isGranted('VIEW', $componenteDigital->getDocumento())) {
                throw new AccessDeniedException('Acesso negado!');
            }

            $processo = $componenteDigital->getDocumento()->getJuntadaAtual()?->getVolume()->getProcesso();
            if ($componenteDigital->getDocumento()->getJuntadaAtual() &&
                (
                    !$this->authorizationChecker->isGranted('VIEW', $processo) ||
                    ($processo->getClassificacao() &&
                        $processo->getClassificacao()->getId() &&
                        !$this->authorizationChecker->isGranted('VIEW', $processo->getClassificacao()))
                )) {
                throw new AccessDeniedException('Acesso negado!');
            }

            /** @var ComponenteDigitalDTO $restDto */
            $restDto = $this->getDtoForEntity(
                $componenteDigital->getId(),
                ComponenteDigitalDTO::class,
                null,
                $componenteDigital
            );

            $this->validateDto($restDto, $skipValidation);
            $this->convert($restDto, $componenteDigital);
            $return['entities'][] = $this->update($componenteDigital->getId(), $restDto, $transactionId);
        }

        $return['total'] = count($componentesDigitais);

        return $return;
    }

    /**
     * @throws AnnotationException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function convertPdfInternoToHTML(
        int $id,
        string $transactionId,
        ?bool $skipValidation = null
    ): array {
        $componentesDigitais = $this->getRepository()->findBy(['documento' => $id]);
        $return['entities'] = [];

        $logEntryRepository = $this->getRepository()
            ->getEntityManager()
            ->getRepository('Gedmo\Loggable\Entity\LogEntry');

        foreach ($componentesDigitais as $componenteDigital) {
            $restDto = $this->getDtoForEntity(
                $componenteDigital->getId(),
                ComponenteDigitalDTO::class,
                null,
                $componenteDigital
            );

            $this->validateDto($restDto, $skipValidation);

            if ('application/pdf' === $restDto->getMimetype() && $restDto->getConvertidoPdf()) {
                $filesystem = $this->filesystemManager
                    ->getFilesystemService($componenteDigital, $restDto)
                    ->get();
                $logs = $logEntryRepository->getLogEntries($componenteDigital);

                $lastHtmlVersion = $logs[1]->getData()['hash'];

                $restDto
                    ->setHashAntigo($restDto->getHash())
                    ->setConteudo(
                        $this->compresser->uncompress(
                            $this->cryptoManager->getCryptoService($componenteDigital, $restDto)
                                ->decrypt($filesystem->read($lastHtmlVersion))
                        )
                    )
                    ->setHash(hash('SHA256', $restDto->getConteudo()))
                    ->setMimetype('text/html')
                    ->setExtensao('html')
                    ->setEditavel(true)
                    ->setConvertidoPdf(false)
                    ->setTamanho(strlen($restDto->getConteudo()))
                    ->setFileName(
                        str_replace(
                            '.pdf',
                            '.html',
                            str_replace('.PDF', '.html', $restDto->getFileName())
                        )
                    );

                $this->eventoPreservacaoLogger
                    ->logEPRES1Descompressao($restDto)
                    ->logEPRES2Decifracao($restDto);
            } else {
                throw new RuntimeException('Arquivo não pode ser convertido!');
            }

            $return['entities'][] = $this->update($restDto->getId(), $restDto, $transactionId);
        }

        $return['total'] = count($componentesDigitais);

        return $return;
    }

    /**
     * Lifecycle method for convert method.
     */
    public function convert(
        ComponenteDigitalDTO|null $restDto = null,
        Entity|null $componenteDigital = null
    ): void {
        // transforma em PDF
        if ('text/html' === $restDto->getMimetype()) {
            $filesystem = $this->filesystemManager
                ->getFilesystemService($componenteDigital, $restDto)
                ->get();

            $conteudoHTML = $this->compresser->uncompress(
                $this->cryptoManager->getCryptoService($componenteDigital, $restDto)
                    ->decrypt($filesystem->read($restDto->getHash()))
            );

            $restDto->setHashAntigo($restDto->getHash());
            $restDto->setConteudo(
                $this->pdfManager->getOutputFromHtml(
                    $conteudoHTML
                )
            );
            $restDto->setHash(hash('SHA256', $restDto->getConteudo()));
            $restDto->setMimetype('application/pdf');
            $restDto->setExtensao('pdf');
            $restDto->setConvertidoPdf(true);
            $restDto->setEditavel(false);
            $restDto->setTamanho(strlen($restDto->getConteudo()));
            $restDto->setFileName(str_replace('.html', '.pdf', str_replace('.HTML', '.pdf', $restDto->getFileName())));

            $this->eventoPreservacaoLogger
                ->logEPRES1Descompressao($restDto)
                ->logEPRES2Decifracao($restDto);
        } else {
            throw new RuntimeException('Arquivo não pode ser convertido!');
        }
    }

    /**
     * @return false|string
     *
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws Exception
     */
    private function htmlToXls(string $html): bool|string
    {
        $readerHtml = new ReaderHtml();
        //CRIA NOVO READER HTML, PARA REALIZAR A CONVERSÃO DO HTML PARA XLS
        $spreadsheet = $readerHtml->loadFromString($html);

        //REALIZA A CONVERSÃO
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        //VERIFICA O DIRETÓRIO TEMPORÁRIO
        $temp = rtrim(sys_get_temp_dir());

        //GERA UM NOME ÚNICO PARA O ARQUIVO
        $filename = $temp.DIRECTORY_SEPARATOR.uniqid('supp_excel', true).'.xlsx';

        //SALVA O ARQUIVO NO DIRETÓRIO TEMPORÁRIO
        $writer->save($filename);

        //LÊ O CONTEÚDO DO ARQUIVO RECÉM CRIADO E INSERE NO ATRIBUTO CONTEÚDO DO COMPONENTE DIGITAL
        $conteudo = file_get_contents($filename);

        //EXCLUÍ O ARQUIVO DO DIRETÓRIO TEMPORÁRIO
        if (file_exists($filename)) {
            unlink($filename);
        }

        return $conteudo;
    }

    public function downloadP7s(
        int $id,
        string $transactionId,
        ?bool $throwExceptionIfNotFound = null
    ): ComponenteDigitalDTO {
        /** @var Entity $componenteDigitalEntity */
        $componenteDigitalEntity = $this->getEntity($id);

        if ($throwExceptionIfNotFound && (null === $componenteDigitalEntity)) {
            throw new NotFoundHttpException('Not found');
        }

        $conteudo = $this
            ->download($componenteDigitalEntity->getId(), $transactionId)->getConteudo();

        $hash = $componenteDigitalEntity->getHash();
        $filename = '/tmp/'.$hash;
        file_put_contents($filename, $conteudo);

        $ass = [];

        /** @var Assinatura $assinatura */
        foreach ($componenteDigitalEntity->getAssinaturas() as $assinatura) {
            if ('cadeia_teste' === $assinatura->getCadeiaCertificadoPEM()) {
                continue;
            }
            $data = base64_decode($assinatura->getAssinatura());
            if ($this->isPkcs7($data)) {
                $assFilename = '/tmp/ass'.$assinatura->getId().'.p7s';
                $ass[$assFilename] = 'ass'.$assinatura->getId();
                file_put_contents($assFilename, $data);
            }
        }

        if (!count($ass)) {
            throw new RuntimeException('Não existem assinaturas p7s válidas!');
        }

        $signerProxyParams = [];
        $signerProxy = $this->parameterBag->get('supp_core.administrativo_backend.signer_proxy');

        if ($signerProxy) {
            $signerProxyParams = explode(' ', $signerProxy);
        }
        $params = [
            'java',
            '-jar',
            '/usr/local/bin/supp-signer-1.9.jar',
            '--mode=attach',
            '--hash='.$hash,
            '--assinaturas='.implode(',', $ass),
        ];
        $process = new Process(
            array_merge($params, $signerProxyParams)
        );
        $process->run();
        if ($process->isSuccessful()) {
            $conteudo = file_get_contents($filename.'.p7s');
        }
        unlink($filename);
        unlink($filename.'.p7s');
        foreach ($ass as $f => $a) {
            unlink($f);
        }

        if (!$conteudo) {
            throw new RuntimeException('Erro! Não foi possível gerar o ZIP!');
        }

        $componenteDigitalResponse = new ComponenteDigitalDTO();
        $componenteDigitalResponse->setConteudo($conteudo);
        $componenteDigitalResponse->setExtensao('p7s');
        $componenteDigitalResponse->setMimetype('application/pkcs7-signature');
        $componenteDigitalResponse->setTamanho(strlen($conteudo));
        $componenteDigitalResponse->setFileName($componenteDigitalEntity->getFileName().'.p7s');

        $documentoResponse = new DocumentoDTO();
        $componenteDigitalResponse->setDocumento($documentoResponse);

        return $componenteDigitalResponse;
    }

    public function isPkcs7(string $assinatura): bool
    {
        $byteSignature = '30 80 06 09 2A 86 48 86 F7 0D 01 07 02';
        $hex_ary = [];
        $ok = false;
        foreach (str_split(substr($assinatura, 0, 15)) as $chr) {
            $hex_ary[] = sprintf('%02X', ord($chr));
        }
        $s = '';
        $maxSize = 0;
        foreach ($hex_ary as $item) {
            ++$maxSize;
            $s .= $item;
            if ($s === $byteSignature) {
                $ok = true;
                break;
            }
            $s .= ' ';
        }

        return $ok;
    }

    public function renderHtmlContent(string $conteudo, string $filename, string $transactionId): ?Entity
    {
        $entity = new Entity();
        $restDto = (new ComponenteDigitalDTO())
            ->setConteudo(base64_decode($conteudo))
            ->setFileName($filename);
        // Before callback method call
        $this->beforeRenderHtmlContent($restDto, $entity, $transactionId);

        $this->afterRenderHtmlContent($restDto, $entity, $transactionId);

        return $entity;

    }

    public function beforeRenderHtmlContent(RestDtoInterface $dto, EntityInterface $entity, string $transactionId): void
    {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertRenderHtmlContent');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeRenderHtmlContent');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeRenderHtmlContent');
    }

    public function afterRenderHtmlContent(
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterRenderHtmlContent');
    }
}
