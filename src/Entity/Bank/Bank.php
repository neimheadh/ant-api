<?php


namespace App\Entity\Bank;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\General\LabeledEntityInterface;
use App\Model\General\LabeledEntityTrait;
use App\Model\User\OwnedEntityInterface;
use App\Model\User\OwnedEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bank entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="bank_bank")
 * @ApiResource()
 *
 * @package App\Entity\Bank
 */
class Bank implements LabeledEntityInterface, OwnedEntityInterface
{
    use LabeledEntityTrait, OwnedEntityTrait;

    /**
     * Bank accounts list.
     *
     * @ORM\OneToMany(targetEntity=Account::class, mappedBy="bank", orphanRemoval=true)
     *
     * @var Collection|Account[]
     */
    private $accounts;

    /**
     * Bank constructor.
     */
    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    /**
     * Get bank accounts.
     *
     * @return Collection|Account[]
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    /**
     * Add a bank account.
     *
     * @param Account $account The added account.
     *
     * @return $this
     */
    public function addAccount(Account $account): self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts[] = $account;
            $account->setBank($this);
        }

        return $this;
    }

    /**
     * Remove a bank account.
     *
     * @param Account $account The removed bank account.
     *
     * @return $this
     */
    public function removeAccount(Account $account): self
    {
        if ($this->accounts->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getBank() === $this) {
                $account->setBank(null);
            }
        }

        return $this;
    }
}