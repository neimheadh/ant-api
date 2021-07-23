<?php

namespace App\Entity\User;

use App\Model\General\EntityInterface;
use App\Model\General\EntityTrait;
use App\Repository\User\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User.
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user_user`")
 *
 * @package App\Entity\Security
 */
class User implements EntityInterface, UserInterface, PasswordAuthenticatedUserInterface
{
    use EntityTrait;

    /**
     * The user username.
     *
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @var string
     */
    private $username;

    /**
     * The user role list.
     *
     * @ORM\Column(type="json")
     *
     * @var string[]
     */
    private $roles = [];

    /**
     * The hashed password.
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $password;

    /**
     * The user salt.
     *
     * @ORM\Column(type="string", length=32)
     *
     * @var string
     */
    private $salt;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->salt = uniqid('', true);
    }

    /**
     * {@inheritDoc}
     *
     * @see EntityInterface::__toString()
     */
    public function __toString(): string
    {
        return $this->getUserIdentifier();
    }

    /**
     * Get user username.
     *
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     *
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * Set user username.
     *
     * @param string $username The username.
     *
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the visual identifier that represents this user.
     *
     * @see UserInterface::getUserIdentifier()
     *
     * @return string
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * {@inheritDoc}
     *
     * @see UserInterface::getRoles()
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Set user roles.
     *
     * @param string[] $roles User roles.
     *
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @see PasswordAuthenticatedUserInterface::getPassword()
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set user hashed password.
     *
     * @param string $password The hashed password.
     *
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @see UserInterface::getSalt()
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * {@inheritDoc}
     *
     * @see UserInterface::eraseCredentials()
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
