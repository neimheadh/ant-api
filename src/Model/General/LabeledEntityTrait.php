<?php


namespace App\Model\General;

use Doctrine\ORM\Mapping as ORM;

/**
 * Labeled entity trait.
 *
 * @package App\Model\General
 */
trait LabeledEntityTrait
{
    use EntityTrait;

    /**
     * Entity label.
     *
     * @ORM\Column(name="label", length=255)
     *
     * @var string
     */
    private $label;

    /**
     * {@inheritDoc}
     *
     * @see EntityInterface::__toString()
     */
    public function __toString(): string
    {
        return $this->label;
    }

    /**
     * {@inheritDoc}
     *
     * @see LabeledEntityInterface::getLabel()
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * {@inheritDoc}
     *
     * @see LabeledEntityInterface::setLabel()
     *
     * @return $this
     */
    public function setLabel(?string $label): LabeledEntityInterface
    {
        $this->label = $label;

        return $this;
    }
}