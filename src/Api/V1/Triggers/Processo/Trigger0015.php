<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Processo/Trigger0015.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo;

use DateTime;
use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use function strlen;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ComponenteDigitalResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\JuntadaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TipoDocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoPessoaUsuarioResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoPessoaUsuario;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Trigger0015.
 *
 * @descSwagger=Cria componenete digital para usuário conveniado
 * @classeSwagger=Trigger0015
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0015 implements TriggerInterface
{
    private AuthorizationCheckerInterface $authorizationChecker;

    private TokenStorageInterface $tokenStorage;

    private ComponenteDigitalResource $componenteDigitalResource;

    private DocumentoResource $documentoResource;

    private TipoDocumentoResource $tipoDocumentoResource;

    private JuntadaResource $juntadaResource;

    private VinculacaoPessoaUsuarioResource $vinculacaoPessoaUsuarioResource;

    /**
     * Trigger0015 constructor.
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        ComponenteDigitalResource $componenteDigitalResource,
        DocumentoResource $documentoResource,
        TipoDocumentoResource $tipoDocumentoResource,
        JuntadaResource $juntadaResource,
        VinculacaoPessoaUsuarioResource $vinculacaoPessoaUsuarioResource,
        private ParameterBagInterface $parameterBag
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
        $this->componenteDigitalResource = $componenteDigitalResource;
        $this->documentoResource = $documentoResource;
        $this->tipoDocumentoResource = $tipoDocumentoResource;
        $this->juntadaResource = $juntadaResource;
        $this->vinculacaoPessoaUsuarioResource = $vinculacaoPessoaUsuarioResource;
    }

    public function supports(): array
    {
        return [
            Processo::class => [
                'afterCreate',
            ],
        ];
    }

    /**
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        if ($restDto->getRequerimento() &&
            (false === $this->authorizationChecker->isGranted('ROLE_COLABORADOR'))) {
            $vinculacaoUsuario = $this->vinculacaoPessoaUsuarioResource->getRepository()
                ->findBy(['usuarioVinculado' => $this->tokenStorage->getToken()->getUser()]);

            $vinculados = [];
            /** @var VinculacaoPessoaUsuario $vinc */
            foreach ($vinculacaoUsuario as $vinc) {
                $vinculados[] = $vinc->getPessoa()->getNome();
            }

            //CRIA DOCUMENTO DE REQUERIMENTO
            $data = new DateTime();
            $conteudoHTML = '<p><b>PROTOCOLO ELETRÔNICO</b></p>';
            $conteudoHTML .= '<p>REALIZADO POR: '.$this->tokenStorage->getToken()->getUser()->getNome().' </p>';
            $conteudoHTML .= '<p>EMAIL CADASTRADO: '.$this->tokenStorage->getToken()->getUser()->getEmail().' </p>';
            $conteudoHTML .= '<p>EM NOME DE:'.implode(', ', $vinculados).'</p>';
            $conteudoHTML .= '<p>NA DATA: '.$data->format('d/m/Y H:i:s').'</p>';
            $conteudoHTML .= '<p>TIPO:'.$restDto->getRequerimento().'</p>';
            $conteudoHTML .= '<p>PARA: '.$restDto->getSetorAtual()->getNome().'</p>';
            $conteudoHTML .= '<p></p>';
            $conteudoHTML .= '<p>'.$restDto->getDescricao().'</p>';

            $conteudoHTML = '<html><head></head><body>'.$conteudoHTML.'</body></html>';

            $tipoDocumento = $this->tipoDocumentoResource
                ->findOneBy(['nome' => $this->parameterBag->get('constantes.entidades.tipo_documento.const_2')]);
            $documentoDTO = new Documento();
            $documentoDTO->setTipoDocumento($tipoDocumento);
            $documentoDTO->setProcessoOrigem($entity);
            $documento = $this->documentoResource->create($documentoDTO, $transactionId);

            $componenteDigitalDTO = new ComponenteDigital();
            $componenteDigitalDTO->setProcessoOrigem($entity);
            $componenteDigitalDTO->setMimetype('text/html');
            $componenteDigitalDTO->setExtensao('html');
            $componenteDigitalDTO->setEditavel(false);
            $componenteDigitalDTO->setNivelComposicao(3);
            $componenteDigitalDTO->setFileName('REQUERIMENTO.html');
            $componenteDigitalDTO->setConteudo($conteudoHTML);
            $componenteDigitalDTO->setHash(hash('SHA256', $componenteDigitalDTO->getConteudo()));
            $componenteDigitalDTO->setTamanho(strlen($conteudoHTML));
            $componenteDigitalDTO->setDocumento($documento);

            $this->componenteDigitalResource->create($componenteDigitalDTO, $transactionId);

            //RESGATA O VOLUME DO PROCESSO E JUNTA O DOCUMENTO
            $volume = $restDto->getVolumes()[0];

            $juntadaDTO = new Juntada();
            $juntadaDTO->setDocumento($documento);
            $juntadaDTO->setVolume($volume);
            $juntadaDTO->setDescricao('DOCUMENTO RECEBIDO VIA PROTOCOLO EXTERNO');

            $this->juntadaResource->create($juntadaDTO, $transactionId);
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
