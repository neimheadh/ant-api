<?php


namespace App\Model\User;


use App\Entity\User\User;

/**
 * Owned entity interface.
 *
 * @package App\Model\Security
 */
interface OwnedEntityInterface
{
    /**
     * Get entity owner.
     *
     * @return User|null
     */
    public function getOwner(): ?User;

    /**
     * Set entity owner.
     *
     * @param User|null $owner The entity owner.
     *
     * @return $this
     */
    public function setOwner(?User $owner): self;
}