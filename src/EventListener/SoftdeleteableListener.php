<?php

declare(strict_types=1);
/**
 * /src/EventListener/SoftdeleteableListener.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\EventListener;

use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class SoftdeleteableListener.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class SoftdeleteableListener
{
    /**
     * User tokenStorage.
     */
    private TokenStorageInterface $tokenStorage;

    /**
     * SoftdeleteableListener constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param LifecycleEventArgs $lifeCycleEvent
     *
     * @throws AccessDeniedException
     * @throws ORMInvalidArgumentException
     */
    public function preSoftDelete(LifecycleEventArgs $lifeCycleEvent): void
    {
        $token = $this->tokenStorage->getToken();
        $object = $lifeCycleEvent->getObject();
        $uow = $lifeCycleEvent->getObjectManager()->getUnitOfWork();
        $meta = $lifeCycleEvent->getObjectManager()->getClassMetadata(get_class($object));

        if (!method_exists($object, 'setApagadoPor')) {
            return;
        }

        $updateColumns = [];
        if (null !== $token) {
            $reflProp = $meta->getReflectionProperty('apagadoPor');
            $oldValue = $reflProp->getValue($object);

            $newValue = $token->getUser();
            $reflProp->setValue($object, $newValue);

            $lifeCycleEvent->getObjectManager()->persist($object);
            $uow->propertyChanged($object, 'apagadoPor', $oldValue, $newValue);
            $updateColumns = array_merge(
                $updateColumns,
                ['apagadoPor' => [$oldValue, $newValue]]
            );
        }

        if (count($updateColumns)) {
            $uow->scheduleExtraUpdate($object, $updateColumns);
        }
    }
}
