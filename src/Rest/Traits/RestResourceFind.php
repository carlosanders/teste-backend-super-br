<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/RestResourceFind.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Traits;

/**
 * Trait RestResourceFind.
 *
 * @SuppressWarnings("unused")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait RestResourceFind
{
    /**
     * Before lifecycle method for find method.
     *
     * @param string  $className
     * @param mixed[] $criteria
     * @param mixed[] $orderBy
     * @param int     $limit
     * @param int     $offset
     * @param mixed[] $populate
     * @param array   $result
     */
    public function beforeFind(
        string $className,
        array &$criteria,
        array &$orderBy,
        int &$limit,
        int &$offset,
        array &$populate,
        array &$result
    ): void {
        $this->triggersManager->proccessRead(
            $className,
            $criteria,
            $orderBy,
            $limit,
            $offset,
            $populate,
            $result,
            'beforeFind'
        );
    }

    /**
     * After lifecycle method for find method.
     *
     * Notes:   If you make changes to entities in this lifecycle method by default it will be saved on end of current
     *          request. To prevent this you need to clone each entity and use those.
     *
     * @param string  $className
     * @param mixed[] $criteria
     * @param mixed[] $orderBy
     * @param int     $limit
     * @param int     $offset
     * @param mixed[] $populate
     * @param array   $result
     */
    public function afterFind(
        string $className,
        array &$criteria,
        array &$orderBy,
        int &$limit,
        int &$offset,
        array &$populate,
        array &$result
    ): void {
        $this->triggersManager->proccessRead(
            $className,
            $criteria,
            $orderBy,
            $limit,
            $offset,
            $populate,
            $result,
            'afterFind'
        );
    }
}
