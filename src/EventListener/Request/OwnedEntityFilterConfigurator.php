<?php


namespace App\EventListener\Request;


use App\Entity\User\User;
use App\Filter\User\OwnedEntityFilter;
use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Owned entity filter configurator.
 *
 * @package App\EventListener\Request
 */
class OwnedEntityFilterConfigurator
{
    /**
     * The entity manager.
     *
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * The annotation reader.
     *
     * @var Reader
     */
    private $reader;

    /**
     * The authentication token storage.
     *
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * OwnedEntityFilterConfigurator constructor.
     *
     * @param EntityManagerInterface $em           The entity manager.
     * @param TokenStorageInterface  $tokenStorage The authentication token storage.
     * @param Reader                 $reader       The annotation reader.
     */
    public function __construct(EntityManagerInterface $em, TokenStorageInterface $tokenStorage, Reader $reader)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
        $this->reader = $reader;
    }

    /**
     * Get the authenticated user.
     *
     * @return User|null
     */
    private function _getUser(): ?User
    {
        $token = $this->tokenStorage->getToken();
        $user = $token ? $token->getUser() : null;

        return $user && $user instanceof User ? $user : null;
    }

    /**
     * Handle kernel.request event.
     */
    public function onKernelRequest(): void
    {
        /**
         * @var OwnedEntityFilter $filter
         */
        $filter = $this->em->getFilters()->enable('owned_entity');
        $filter->setUser($this->_getUser());
        $filter->setAnnotationReader($this->reader);
    }
}