<?php

declare(strict_types=1);
/**
 * /src/Repository/CronjobRepository.php.
 */

namespace SuppCore\AdministrativoBackend\Repository;

use SuppCore\AdministrativoBackend\Entity\Cronjob as Entity;

/**
 * Class CronjobRepository.
 *
 * @codingStandardsIgnoreStart
 *
 * @method Entity|null find(int $id, ?array $populate = null)
 * @method Entity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]    findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null)
 * @method Entity[]    findByAdvanced(array $criteria, array $orderBy = null, int $limit = null, int $offset = null, array $search = null): array
 * @method Entity[] findAll()
 *
 * @codingStandardsIgnoreEnd
 */
class CronjobRepository extends BaseRepository
{
    /**
     * @var string
     */
    protected static string $entityName = Entity::class;


    /**
     * @param float $percentualExecucacao
     * @param int   $cronjobId
     *
     * @return bool
     */
    public function atualizaPercentualExecucao(float $percentualExecucacao, int $cronjobId): bool
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            UPDATE SuppCore\AdministrativoBackend\Entity\Cronjob c
            SET c.percentualExecucao = c.percentualExecucao + :percentualExecucao  
            WHERE c.id = :cronjobId');

        $query->setParameter(':percentualExecucao', $percentualExecucacao);
        $query->setParameter('cronjobId', $cronjobId);
        $query->execute();

        return true;
    }
}
