<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use App\Entity\Reservation;
use App\Entity\PaymentDetails;
use App\Repository\CustomerRepository;
use App\Repository\InvoiceRepository;
use App\Repository\VehicleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private CustomerRepository $customerRepository;
    private VehicleRepository $vehicleRepository;
    private InvoiceRepository $invoiceRepository;

    public function __construct(CustomerRepository $customerRepository, VehicleRepository $vehicleRepository, InvoiceRepository $invoiceRepository)
    {
        $this->faker = Factory::create('es_ES');
        $this->customerRepository = $customerRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $customers = $this->customerRepository->findAll();
        $vehicles = $this->vehicleRepository->findAll();
        $invoices = $this->invoiceRepository->findAll();

        for ($i = 0; $i < 5; $i++) {
            $reservation = new Reservation();
            $reservation->setStartDate($this->faker->dateTimeBetween('-1 month', '+1 month'));
            $reservation->setEndDate($this->faker->dateTimeBetween($reservation->getStartDate(), '+1 month'));
            $reservation->setTotalPrice($this->faker->numberBetween(100, 1000));
            $reservation->setStatus($this->faker->randomElement(['pending', 'confirmed', 'cancelled']));
            $reservation->setReservationDate($this->faker->dateTimeBetween('-3 months', '-1 day'));
            $reservation->setCustomer($this->faker->randomElement($customers));
            $reservation->setVehicle($this->faker->randomElement($vehicles));
            $reservation->setInvoice($this->faker->randomElement($invoices));

            $paymentDetails = new PaymentDetails();
            $paymentDetails->setPaymentMethod($this->faker->randomElement(['Visa', 'MasterCard']));
            $cardNumber = $this->faker->numerify('############');
            $paymentDetails->setCardNumber('************'.substr($cardNumber, -4)); // Mostrar solo los últimos 4 dígitos
            $paymentDetails->setExpiryDate($this->faker->dateTimeBetween($reservation->getStartDate(), '+12 months'));
            $paymentDetails->setCvv('***'); // Establecer CVV como oculto
            $reservation->setPaymentDetails($paymentDetails);

            $manager->persist($reservation);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            VehicleFixtures::class,
            InvoiceFixtures::class
        ];
    }
}