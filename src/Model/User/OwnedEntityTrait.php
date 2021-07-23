<?php


namespace App\Model\User;

use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Owned entity trait.
 *
 * @package App\Model\Security
 */
trait OwnedEntityTrait
{
    /**
     * The entity owner.
     *
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="owner_id")
     *
     * @var User
     */
    private $owner;

    /**
     * {@inheritDoc}
     *
     * @see OwnedEntityInterface::getOwner()
     */
    public function getOwner(): ?User
    {
        return $this->owner;
    }

    /**
     * {@inheritDoc}
     *
     * @see OwnedEntityInterface::setOwner()
     *
     * @return $this
     */
    public function setOwner(?User $owner): OwnedEntityInterface
    {
        $this->owner = $owner;

        return $this;
    }
}