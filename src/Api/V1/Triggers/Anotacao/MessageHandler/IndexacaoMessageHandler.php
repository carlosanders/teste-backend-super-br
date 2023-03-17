<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Anotacao/MessageHandler/IndexacaoMessage.php.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Anotacao\MessageHandler;

use ONGR\ElasticsearchBundle\Service\IndexService;
use Psr\Log\LoggerInterface;
use SuppCore\AdministrativoBackend\Api\V1\Resource\AnotacaoResource;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\Anotacao\Message\IndexacaoMessage;
use SuppCore\AdministrativoBackend\Document\Anotacao as AnotacaoDocument;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

/**
 * Class IndexacaoMessageHandler.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */
#[AsMessageHandler]
class IndexacaoMessageHandler
{
    private IndexService $pessoaIndex;
    private AnotacaoResource $anotacaoResource;
    private LoggerInterface $logger;

    /**
     * Trigger0005 constructor.
     */
    public function __construct(
        IndexService $pessoaIndex,
        AnotacaoResource $anotacaoResource,
        LoggerInterface $logger
    ) {
        $this->pessoaIndex = $pessoaIndex;
        $this->anotacaoResource = $anotacaoResource;
        $this->logger = $logger;
    }

    /**
     * @param IndexacaoMessage $message
     */
    public function __invoke(IndexacaoMessage $message)
    {
        try {
            $anotacaoEntity = $this->anotacaoResource->getRepository()->findOneBy(['uuid' => $message->getUuid()]);

            if ($anotacaoEntity) {
                $anotacaoDocument = new AnotacaoDocument();
                $anotacaoDocument->setId($anotacaoEntity->getId());
                $anotacaoDocument->setDescricao($anotacaoEntity->getDescricao());
                $anotacaoDocument->setAtivo($anotacaoEntity->getAtivo());
            

                $this->pessoaIndex->persist($anotacaoDocument);
                $this->pessoaIndex->commit();

                $em = $this->anotacaoResource->getRepository()->getEntityManager();
                $conn = $em->getConnection();

            }
        } catch (Throwable $t) {
            $this->logger->critical($t->getMessage().$t->getTraceAsString());
        }
    }
}
