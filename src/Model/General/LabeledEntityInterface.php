<?php


namespace App\Model\General;

/**
 * Labeled entity interface.
 *
 * @package App\Model\General
 */
interface LabeledEntityInterface extends EntityInterface
{
    /**
     * Get the label.
     *
     * @return string|null
     */
    public function getLabel(): ?string;

    /**
     * Set the label.
     *
     * @param string|null $label The label.
     *
     * @return self
     */
    public function setLabel(?string $label): self;
}