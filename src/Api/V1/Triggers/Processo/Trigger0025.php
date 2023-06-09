<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Processo/Trigger0025.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ProcessoResource;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo\Message\DownloadProcessoMessage;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Repository\JuntadaRepository;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Trigger0025.
 *
 * @descSwagger=Dispara processo de geração de download em segundo plano.
 * @classeSwagger=Trigger0025
 */
class Trigger0025 implements TriggerInterface
{

    public function __construct(
        private TransactionManager $transactionManager,
        private TokenStorageInterface $tokenStorage,
        private JuntadaRepository $juntadaRepository,
        private ProcessoResource $processoResource,
        private ParameterBagInterface $parameterBag
    ) {
    }

    public function supports(): array
    {
        return [
            Processo::class => [
                'beforeDownload',
            ],
        ];
    }

    /**
     * @param RestDtoInterface|Processo|null $restDto
     * @param EntityInterface|ProcessoEntity $entity
     * @param string                         $transactionId
     *
     * @return void
     */
    public function execute(
        RestDtoInterface|Processo|null $restDto,
        EntityInterface|ProcessoEntity $entity,
        string $transactionId
    ): void {
        $sizeLimit = $this->parameterBag->get('supp_core.administrativo_backend.processo_download_part_size');
        $sequencial = $this->transactionManager->getContext('sequencial', $transactionId)->getValue();
        $juntadasIds = [];

        if ($sizeLimit) {
            if ($sequencial !== 'all') {
                $juntadasIds = $this->processoResource->processaDigitosExpressaoDownload($sequencial);
            }

            $juntadasSize = $this->juntadaRepository->getJuntadasProcessoSize($restDto->getId(), $juntadasIds);

            #convertendo bytes para megabytes
            $sizeProcesso = array_sum(array_map(fn($data) => $data['tamanho_juntada'], $juntadasSize))/1048576;

            $blocoJuntadas = [];
            $currentBlocoKey = 0;
            $currentSize = 0;
            foreach ($juntadasSize as $juntadaSizeData) {
                if (!isset($blocoJuntadas[$currentSize])) {
                    $blocoJuntadas[$currentSize] = [];
                }
                $juntadaSize = $juntadaSizeData['tamanho_juntada']/1048576;
                if (($currentSize + $juntadaSize) > $sizeLimit) {
                    $currentSize = 0;
                    ++$currentBlocoKey;
                } else {
                    $currentSize += $juntadaSize;
                }
                $blocoJuntadas[$currentBlocoKey][] = $juntadaSizeData['id'];
            }

            foreach ($blocoJuntadas as $index => $bloco) {
                $message = new DownloadProcessoMessage(
                    $entity->getUuid(),
                    $this->transactionManager->getContext('tipoDownload', $transactionId)->getValue(),
                    $this->tokenStorage->getToken()->getUserIdentifier(),
                    join(',', $bloco),
                    count($blocoJuntadas) > 1 ? ($index + 1) : 0
                );

                $this->transactionManager->addAsyncDispatch($message, $transactionId);
            }
        } else {
            $this->transactionManager->addAsyncDispatch(
                new DownloadProcessoMessage(
                    $entity->getUuid(),
                    $this->transactionManager->getContext('tipoDownload', $transactionId)->getValue(),
                    $this->tokenStorage->getToken()->getUserIdentifier(),
                    $sequencial
                ),
                $transactionId
            );
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
