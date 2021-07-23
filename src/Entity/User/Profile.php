<?php


namespace App\Entity\User;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\General\EntityInterface;
use App\Model\General\EntityTrait;
use App\Model\User\OwnedEntityInterface;
use App\Model\User\OwnedEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * User profile.
 *
 * @ORM\Entity
 * @ORM\Table(name="user_profile")
 * @ApiResource
 *
 * @package App\Entity\Security
 */
class Profile implements EntityInterface, OwnedEntityInterface
{
    use EntityTrait, OwnedEntityTrait;
}