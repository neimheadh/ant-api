<?php


namespace App\Model\General;

/**
 * ORM entities interface.
 *
 * @package App\Model\General
 */
interface EntityInterface
{
    /**
     * Get the string representation of the entity.
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Get the entity primary id.
     *
     * @return int
     */
    public function getId(): ?int;
}