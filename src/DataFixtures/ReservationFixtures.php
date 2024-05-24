<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use App\Entity\Reservation;
use App\Entity\PaymentDetails;
use App\Repository\CustomerRepository;
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

    public function __construct(CustomerRepository $customerRepository, VehicleRepository $vehicleRepository)
    {
        $this->faker = Factory::create('es_ES');
        $this->customerRepository = $customerRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $customers = $this->customerRepository->findAll();
        $vehicles = $this->vehicleRepository->findAll();

        for ($i = 0; $i < 20; $i++) {
            $reservation = new Reservation();
            $reservation->setStartDate($this->faker->dateTimeBetween('-1 month', '+1 month'));
            $reservation->setEndDate($this->faker->dateTimeBetween($reservation->getStartDate(), '+1 month'));
            $reservation->setTotalPrice($this->faker->numberBetween(100, 1000));
            $reservation->setStatus($this->faker->randomElement(['pending', 'confirmed', 'cancelled']));
            $reservation->setReservationDate($this->faker->dateTimeBetween('-3 months', '-1 day'));
            $reservation->setCustomer($this->faker->randomElement($customers));
            $reservation->setVehicle($this->faker->randomElement($vehicles));

            $paymentDetails = new PaymentDetails();
            $paymentDetails->setPaymentMethod($this->faker->randomElement(['Visa', 'MasterCard']));
            $paymentDetails->setCardNumber($this->faker->numerify('############')); // Genera un número de tarjeta de crédito de 12 dígitos
            $paymentDetails->setExpiryDate($this->faker->dateTimeBetween($reservation->getStartDate(), '+12 months'));
            $paymentDetails->setCvv($this->faker->numerify('###')); // Genera un código CVV de 3 dígitos
            $reservation->setPaymentDetails($paymentDetails);

            $invoice = new Invoice();
            $invoice->setNumber($this->faker->numerify('INV-########'));
            $invoice->setPrice($reservation->getTotalPrice()); // Precio de la reserva
            $invoice->setDate($reservation->getReservationDate()); // Fecha de la reserva
            $invoice->setCustomer($reservation->getCustomer()); // Cliente de la reserva

            $manager->persist($reservation);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            VehicleFixtures::class,
        ];
    }
}
