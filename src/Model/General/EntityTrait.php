<?php


namespace App\Model\General;

/**
 * ORM entities trait.
 *
 * @package App\Model\General
 */
trait EntityTrait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * {@inheritDoc}
     *
     * @see EntityInterface::__toString()
     */
    public function __toString(): string
    {
        return get_class($this) . '#' . $this->id;
    }

    /**
     * {@inheritDoc}
     *
     * @see EntityInterface::getId()
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}