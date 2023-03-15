<?php

declare(strict_types=1);
/**
 * /src/Repository/DocumentoAvulsoRepository.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Repository;

use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso as Entity;

/**
 * Class DocumentoAvulsoRepository.
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
class DocumentoAvulsoRepository extends BaseRepository
{
    /**
     * @var string
     */
    protected static string $entityName = Entity::class;

    /**
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function findDocumentoAvulsoVencido()
    {
        $fim = new DateTime();
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT da 
                FROM SuppCore\AdministrativoBackend\Entity\DocumentoAvulso da
                WHERE 
                da.documentoResposta IS NULL AND
                da.documentoRemessa IS NOT NULL AND 
                da.dataHoraFinalPrazo < :fim'
        );

        $query->setParameter('fim', $fim);

        return $query->getResult();
    }
}
