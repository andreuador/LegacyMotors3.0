<?php

namespace App\Entity;

use App\Repository\PaymentDetailsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentDetailsRepository::class)]
class PaymentDetails implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $payment_method = null;

    #[ORM\Column(length: 255)]
    private ?string $card_number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $expiry_date = null;

    #[ORM\Column(length: 10)]
    private ?string $cvv = null;

    #[ORM\OneToOne(mappedBy: 'paymentDetails', cascade: ['persist', 'remove'])]
    private ?Reservation $reservation = null;

    #[ORM\OneToOne(mappedBy: 'paymentDetails', cascade: ['persist', 'remove'])]
    private ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): static
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    public function getCardNumber(): ?string
    {
        return $this->card_number;
    }

    public function setCardNumber(string $card_number): static
    {
        $this->card_number = $card_number;

        return $this;
    }

    public function getExpiryDate(): ?\DateTimeInterface
    {
        return $this->expiry_date;
    }

    public function setExpiryDate(\DateTimeInterface $expiry_date): static
    {
        $this->expiry_date = $expiry_date;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): static
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): static
    {
        // set the owning side of the relation if necessary
        if ($reservation->getPaymentDetails() !== $this) {
            $reservation->setPaymentDetails($this);
        }

        $this->reservation = $reservation;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
        return [
            'id' => $this->id,
            'payment_method' => $this->payment_method,
            'card_number' => $this->card_number,
            'expiry_date' => $this->expiry_date,
            'cvv' => $this->cvv,
        ];
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        // unset the owning side of the relation if necessary
        if ($customer === null && $this->customer !== null) {
            $this->customer->setPaymentDetails(null);
        }

        // set the owning side of the relation if necessary
        if ($customer !== null && $customer->getPaymentDetails() !== $this) {
            $customer->setPaymentDetails($this);
        }

        $this->customer = $customer;

        return $this;
    }
}
