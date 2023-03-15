<?php

declare(strict_types=1);
/**
 * /src/Command/ApiKey/ChangeTokenCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\ApiKey;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Modelo;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ApiKeyResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ModalidadeOrgaoCentralResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ModeloResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TemplateResource;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ChangeTokenCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class JustATestCommand extends Command
{
    // Traits
    use SymfonyStyleTrait;

    private ApiKeyResource $apiKeyResource;

    private ApiKeyHelper $apiKeyHelper;
    /**
     * @var ModeloResource
     */
    private ModeloResource $modeloResource;
    /**
     * @var Modelo
     */
    private Modelo $modeloDTO;
    /**
     * @var TransactionManager
     */
    private TransactionManager $transactionManager;
    /**
     * @var TemplateResource
     */
    private TemplateResource $templateResource;
    /**
     * @var ModalidadeOrgaoCentralResource
     */
    private ModalidadeOrgaoCentralResource $orgaoCentralResource;

    /**
     * @param ModeloResource                 $modeloResource
     * @param TemplateResource               $templateResource
     * @param ModalidadeOrgaoCentralResource $orgaoCentralResource
     * @param TransactionManager             $transactionManager
     */
    public function __construct(
        ModeloResource $modeloResource,
        TemplateResource $templateResource,
        ModalidadeOrgaoCentralResource $orgaoCentralResource,
        TransactionManager $transactionManager
    ) {
        parent::__construct('testandoCommand:testar');

        $this->setDescription('Command para testar o ruleManager');
        $this->modeloResource = $modeloResource;
        $this->templateResource = $templateResource;
        $this->orgaoCentralResource = $orgaoCentralResource;
        $this->transactionManager = $transactionManager;
    }

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $dtoModelo = new Modelo();
        $dtoModelo->setTemplate($this->templateResource->findOne(1));
        $dtoModelo->setNome('testeuihaushduhas');
        $dtoModelo->setDescricao('aojsdauishduahsdhu');
        $dtoModelo->setAtivo(true);
        $dtoModelo->setOrgaoCentral($this->orgaoCentralResource->findOne(1));

        $transactionId = $this->transactionManager->begin();
        $this->modeloResource->create($dtoModelo, $transactionId);

        $this->transactionManager->commit($transactionId);

        return null;
    }
}
