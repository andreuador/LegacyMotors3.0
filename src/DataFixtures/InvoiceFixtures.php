<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use App\Repository\CustomerRepository;
use App\Repository\ReservationRepository;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Generator;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private CustomerRepository $customerRepository;
    private ReservationRepository $reservationRepository;

    public function __construct(CustomerRepository $customerRepository, ReservationRepository $reservationRepository)
    {
        $this->faker = Factory::create('es_ES');
        $this->customerRepository = $customerRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $reservations = $this->reservationRepository->findAll();

        for ($i = 0; $i < 10; $i++) {
            $invoice = new Invoice();
            $invoice->setPrice($this->faker->numberBetween(100000, 1000000));
            $dateString = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d');
            $date = DateTime::createFromFormat('Y-m-d', $dateString);
            $invoice->setDate($date);
            $invoice->setNumber($this->faker->numberBetween('200€', '1000€'));
            $invoice->setDeleted(false);

            // Asociar una reserva aleatoria a la factura
            $reservation = $this->faker->randomElement($reservations);
            $invoice->addReservation($reservation);

            // Obtener el cliente asociado a la reserva
            $customer = $reservation->getCustomer();
            $invoice->setCustomer($customer);

            $manager->persist($invoice);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ReservationFixtures::class];
    }
}