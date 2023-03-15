<?php

declare(strict_types=1);
/**
 * /src/Repository/RegraEtiquetaRepository.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Repository;

use SuppCore\AdministrativoBackend\Entity\RegraEtiqueta as Entity;

/**
 * Class RegraEtiquetaRepository.
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
class RegraEtiquetaRepository extends BaseRepository
{
    protected static string $entityName = Entity::class;

    /**
     * @param int $usuarioId
     * @param int $modalidadeEtiquetaId
     *
     * @return Entity[]
     */
    public function findRegrasAplicaveisByUsuarioId(int $usuarioId, int $modalidadeEtiquetaId)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "
            SELECT r
            FROM SuppCore\AdministrativoBackend\Entity\RegraEtiqueta r
            INNER JOIN r.etiqueta e
            INNER JOIN e.modalidadeEtiqueta me WITH me.id = :modalidadeEtiquetaId
            INNER JOIN e.vinculacoesEtiquetas ve
            INNER JOIN ve.usuario u WITH u.id = :usuarioId
        "
        );
        $query->setParameter('usuarioId', $usuarioId);
        $query->setParameter('modalidadeEtiquetaId', $modalidadeEtiquetaId);

        return $query->getResult();
    }

    /**
     * @param int $setorId
     * @param int $modalidadeEtiquetaId
     *
     * @return Entity[]
     */
    public function findRegrasAplicaveisBySetorId(int $setorId, int $modalidadeEtiquetaId)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "
            SELECT r
            FROM SuppCore\AdministrativoBackend\Entity\RegraEtiqueta r
            INNER JOIN r.etiqueta e
            INNER JOIN e.modalidadeEtiqueta me WITH me.id = :modalidadeEtiquetaId
            INNER JOIN e.vinculacoesEtiquetas ve
            INNER JOIN ve.setor s WITH s.id = :setorId
        "
        );
        $query->setParameter('setorId', $setorId);
        $query->setParameter('modalidadeEtiquetaId', $modalidadeEtiquetaId);

        return $query->getResult();
    }

    /**
     * @param int $unidadeId
     * @param int $modalidadeEtiquetaId
     *
     * @return Entity[]
     */
    public function findRegrasAplicaveisByUnidadeId(int $unidadeId, int $modalidadeEtiquetaId)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "
            SELECT r
            FROM SuppCore\AdministrativoBackend\Entity\RegraEtiqueta r
            INNER JOIN r.etiqueta e
            INNER JOIN e.modalidadeEtiqueta me WITH me.id = :modalidadeEtiquetaId
            INNER JOIN e.vinculacoesEtiquetas ve
            INNER JOIN ve.unidade u WITH u.id = :unidadeId
        "
        );
        $query->setParameter('unidadeId', $unidadeId);
        $query->setParameter('modalidadeEtiquetaId', $modalidadeEtiquetaId);

        return $query->getResult();
    }

    /**
     * @param int $modalidadeOrgaoCentralId
     * @param int $modalidadeEtiquetaId
     *
     * @return Entity[]
     */
    public function findRegrasAplicaveisByModalidadeOrgaoCentralId(int $modalidadeOrgaoCentralId, int $modalidadeEtiquetaId)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "
            SELECT r
            FROM SuppCore\AdministrativoBackend\Entity\RegraEtiqueta r
            INNER JOIN r.etiqueta e
            INNER JOIN e.modalidadeEtiqueta me WITH me.id = :modalidadeEtiquetaId
            INNER JOIN e.vinculacoesEtiquetas ve
            INNER JOIN ve.modalidadeOrgaoCentral u WITH u.id = :modalidadeOrgaoCentralId
        "
        );
        $query->setParameter('modalidadeOrgaoCentralId', $modalidadeOrgaoCentralId);
        $query->setParameter('modalidadeEtiquetaId', $modalidadeEtiquetaId);

        return $query->getResult();
    }
}
