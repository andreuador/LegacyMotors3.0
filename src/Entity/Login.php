<?php

namespace App\Entity;

use App\Repository\LoginRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoginRepository::class)]
class Login
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
    private ?Emplpoyee $emplpoyee = null;

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
        // set the owning side of the relation if necessary
        if ($customer->getLogin() !== $this) {
            $customer->setLogin($this);
        }

        $this->customer = $customer;

        return $this;
    }

    public function getEmplpoyee(): ?Emplpoyee
    {
        return $this->emplpoyee;
    }

    public function setEmplpoyee(Emplpoyee $emplpoyee): static
    {
        // set the owning side of the relation if necessary
        if ($emplpoyee->getLogin() !== $this) {
            $emplpoyee->setLogin($this);
        }

        $this->emplpoyee = $emplpoyee;

        return $this;
    }
}
