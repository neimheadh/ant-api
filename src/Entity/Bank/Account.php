<?php

namespace App\Entity\Bank;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\General\LabeledEntityInterface;
use App\Model\General\LabeledEntityTrait;
use App\Model\User\OwnedEntityInterface;
use App\Model\User\OwnedEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bank account entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="bank_account")
 * @ApiResource
 *
 * @package App\Entity\Bank
 */
class Account implements LabeledEntityInterface, OwnedEntityInterface
{
    use LabeledEntityTrait, OwnedEntityTrait;

    /**
     * Accout bank.
     *
     * @ORM\ManyToOne(targetEntity=Bank::class, inversedBy="accounts")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var Bank
     */
    private $bank;

    /**
     * Get account bank.
     *
     * @return Bank|null
     */
    public function getBank(): ?Bank
    {
        return $this->bank;
    }

    /**
     * Set account bank.
     *
     * @param Bank|null $bank
     *
     * @return $this
     */
    public function setBank(?Bank $bank): self
    {
        $this->bank = $bank;

        return $this;
    }
}
