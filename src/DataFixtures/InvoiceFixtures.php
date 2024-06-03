<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use App\Repository\CustomerRepository;
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

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->faker = Factory::create('es_ES');
        $this->customerRepository = $customerRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $customers = $this->customerRepository->findAll();

        for ($i = 0; $i < 5; $i++) {
            $invoice = new Invoice();
            $invoice->setNumber($this->faker->unique()->numberBetween(1, 5));
            $invoice->setDate(new DateTime());
            $invoice->setPrice($this->faker->numberBetween(100, 999));
            $invoice->setDeleted(false);

            // Asignar un cliente aleatorio a la factura
            $customer = $this->faker->randomElement($customers);
            $invoice->setCustomer($customer);

            $manager->persist($invoice);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
        ];
    }
}
