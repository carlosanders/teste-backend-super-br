<?php

declare(strict_types=1);
/**
 * /src/Repository/DocumentoRepository.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Repository;

use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Documento as Entity;

/**
 * Class DocumentoRepository.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br> *
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
class DocumentoRepository extends BaseRepository
{
    /**
     * @var string
     */
    protected static string $entityName = Entity::class;

    /**
     * @param int $documentoId
     *
     * @return bool
     */
    public function isAssinado(int $documentoId): bool
    {
        $query = $this->getEntityManager()->createQuery(
            '
            SELECT a.id 
            FROM SuppCore\AdministrativoBackend\Entity\Assinatura a
            INNER JOIN a.componenteDigital cd
            INNER JOIN cd.documento d WITH d.id = :documentoId'
        );
        $query->setParameter('documentoId', $documentoId);
        $query->setMaxResults(1);
        return (bool) count($query->getArrayResult());
    }

    /**
     * @param int $documentoId
     *
     * @return bool
     */
    public function isMinuta(int $documentoId)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            '
                SELECT d
                FROM SuppCore\AdministrativoBackend\Entity\Documento d
                WHERE d.juntadaAtual IS NULL AND d.id = :documentoId'
        );
        $query->setParameter('documentoId', $documentoId);
        $query->setMaxResults(1);

        return (bool) count($query->getResult());
    }

    /**
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function findDocumentoValidadeVencida()
    {
        $fim = new DateTime();
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT d 
                FROM SuppCore\AdministrativoBackend\Entity\Documento d
                WHERE 
                d.dataHoraValidade IS NOT NULL AND
                d.dataHoraValidade < :fim'
        );

        $query->setParameter('fim', $fim);

        return $query->getResult();
    }
}
