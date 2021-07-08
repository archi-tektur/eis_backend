<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Trait\SerializerTrait;
use App\Infrastructure\Doctrine\Repository\DoctrineUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: DoctrineUserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use SerializerTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'json')]
    private $roles;

    #[ORM\Column(type: 'string')]
    private $password;

    private function __construct(Uuid $id, string $email, string $name, string $password, array $roles)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->roles = $roles;
    }

    public static function generic(Uuid $id, string $email, string $name, string $password): self
    {
        return new self($id,  $email,  $name,  $password, ['ROLE_USER']);
    }

    public static function admin(Uuid $id, string $email, string $name, string $password): self
    {
        return new self($id,  $email,  $name,  $password, ['ROLE_ADMIN', 'ROLE_USER']);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }
}
