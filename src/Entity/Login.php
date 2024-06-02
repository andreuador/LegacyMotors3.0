<?php

namespace App\Entity;

use App\Repository\LoginRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: LoginRepository::class)]
#[UniqueEntity('username')]
#[UniqueConstraint(name: 'username_unique_idx', columns: ['username'])]
class Login implements PasswordAuthenticatedUserInterface, UserInterface, \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 100)]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $role = null;

    #[ORM\OneToOne(mappedBy: 'login', cascade: ['persist', 'remove'])]
    private ?Customer $customer = null;

    #[ORM\OneToOne(mappedBy: 'login', cascade: ['persist', 'remove'])]
    private ?Employee $employee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): static
    {
        if ($customer->getLogin() !== $this) {
            $customer->setLogin($this);
        }

        $this->customer = $customer;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): static
    {
        if ($employee->getLogin() !== $this) {
            $employee->setLogin($this);
        }

        $this->employee = $employee;

        return $this;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function eraseCredentials(): void
    {
        // No es necesario realizar ninguna acción aquí, ya que no almacenamos credenciales sensibles
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'username' => $this->getUsername(),
            'role' => $this->getRole(),
            'employee' => $this->getEmployee(),
            'customer' => $this->getCustomer(),
        ];
    }
}
