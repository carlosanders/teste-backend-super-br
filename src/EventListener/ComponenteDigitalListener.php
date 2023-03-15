<?php

declare(strict_types=1);
/**
 * /src/EventListener/ComponenteDigitalListener.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Exception;
use SuppCore\AdministrativoBackend\EARQ\EARQEventoPreservacaoLoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use function get_class;
use RuntimeException;
use function strlen;
use SuppCore\AdministrativoBackend\Crypto\CryptoManager;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital;
use SuppCore\AdministrativoBackend\Filesystem\FilesystemManager;
use SuppCore\AdministrativoBackend\Repository\ComponenteDigitalRepository;
use SuppCore\AdministrativoBackend\Utils\CompressServiceInterface;

/**
 * Class ComponenteDigitalListener.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ComponenteDigitalListener implements EventSubscriber
{
    /**
     * @param CompressServiceInterface $compresser
     * @param ComponenteDigitalRepository $componenteDigitalRepository
     * @param CryptoManager $cryptoManager
     * @param FilesystemManager $filesystemManager
     * @param EARQEventoPreservacaoLoggerInterface $eventoPreservacaoLogger
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(private CompressServiceInterface $compresser,
                                private ComponenteDigitalRepository $componenteDigitalRepository,
                                private CryptoManager $cryptoManager,
                                private FilesystemManager $filesystemManager,
                                private EARQEventoPreservacaoLoggerInterface $eventoPreservacaoLogger,
                                private ParameterBagInterface $parameterBag)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            'prePersist',
            'preUpdate',
            'postSoftDelete',
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof ComponenteDigital && $entity->getConteudo()) {
            $filesystemService = $this->filesystemManager->getFilesystemService($entity);
            $filesystem = $filesystemService->get();

            $entity->setFilesystemService($filesystemService->getClassname());

            $encrypter = $this->cryptoManager->getCryptoService($entity);
            $encryptedData = $encrypter->encrypt($this->compresser->compress($entity->getConteudo()));
            $entity->setCryptoService($encrypter->getClassname());

            $this->eventoPreservacaoLogger
                ->logEPRES1Compressao($entity);

            $bytesToWrite = strlen($encryptedData);
            if (!$filesystem->has($entity->getHash()) || !$filesystem->read($entity->getHash())) {
                $bytesWritten = $filesystem->write($entity->getHash(), $encryptedData);
                if ($bytesWritten !== $bytesToWrite) {
                    throw new RuntimeException('Houve erro na gravação do arquivo no filesystem!');
                }
            }
            $this->eventoPreservacaoLogger
                ->logEPRES4Checksum($entity, $this->parameterBag->get('algoritmo_hash_componente_digital'));
        }
    }

    /**
     * @throws Exception
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $em = $args->getEntityManager();
        $entity = $args->getObject();

        if ($entity instanceof ComponenteDigital && $entity->getConteudo()) {
            if ($entity->getHash() &&
                $entity->getHashAntigo() &&
                ($entity->getHash() !== $entity->getHashAntigo())) {
                $encrypter = $this->cryptoManager->getCryptoService($entity);
                $encryptedData = $encrypter->encrypt($this->compresser->compress($entity->getConteudo()));
                $entity->setCryptoService($encrypter->getClassname());
                $bytesToWrite = strlen($encryptedData);
                $filesystemService = $this->filesystemManager
                    ->getFilesystemService($entity);

                $this->eventoPreservacaoLogger
                    ->logEPRES1Compressao($entity)
                    ->logEPRES4Checksum($entity, $this->parameterBag->get('algoritmo_hash_componente_digital'));

                $lastFilesystemService = $entity->getFilesystemService();
                $entity->setFilesystemService($filesystemService->getClassname());

                if (!$filesystemService->get()->has($entity->getHash())) {
                    $bytesWritten = $filesystemService->get()->write($entity->getHash(), $encryptedData);
                    if ($bytesWritten !== $bytesToWrite) {
                        throw new RuntimeException('Houve erro na gravação do arquivo no filesystem!');
                    }
                }
                if (!$entity->getEditavel() && !$entity->getConvertidoPdf()) {
                    // somente apaga se houver apenas 1 componente com o mesmo hash, ou seja, ele mesmo!
                    $qtdComponenteDigitalIdentico =
                        $this->componenteDigitalRepository
                            ->findCountByHash($entity->getHashAntigo());

                    $filesystemService = $this
                        ->filesystemManager
                        ->getFilesystemService($entity);

                    /** @noinspection PhpStatementHasEmptyBodyInspection */
                    if ((1 === $qtdComponenteDigitalIdentico) &&
                        $filesystemService->get()->has($entity->getHashAntigo())) {
                        // não apaga de verdade, por garantia e segurança
//                        $filesystemService->get()->delete($entity->getHashAntigo());
                    }
                }
            }
            $uow = $em->getUnitOfWork();
            $meta = $em->getClassMetadata(get_class($entity));
            $uow->recomputeSingleEntityChangeSet($meta, $entity);
        }
    }

    public function postSoftDelete(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof ComponenteDigital &&
            !$entity->getEditavel()) {
            $qtdComponenteDigitalIdentico = $this->componenteDigitalRepository
                ->findCountByHash($entity->getHash());
            // somente apaga se houver apenas 1 componente com o mesmo hash, ou seja, ele mesmo!
            $filesystem = $this->filesystemManager->getFilesystemService($entity)->get();

            /** @noinspection PhpStatementHasEmptyBodyInspection */
            if (1 === $qtdComponenteDigitalIdentico &&
                $filesystem->has($entity->getHash())) {
                // não apaga atualmente, por garantia e segurança
//                $filesystem->delete($entity->getHash());
            }
        }
    }
}
