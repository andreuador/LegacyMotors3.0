<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Repository\CustomerRepository;
use App\Repository\VehicleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private CustomerRepository $customerRepository;
    private VehicleRepository  $vehicleRepository;

    public function __construct(CustomerRepository $customerRepository, VehicleRepository $vehicleRepository) {
        $this->faker = Factory::create('es_ES');
        $this->customerRepository = $customerRepository;
        $this->vehicleRepository = $vehicleRepository;
    }
    public function load(ObjectManager $manager): void
    {
        // Obtener todos los vehiculos disponibles
        $vehicles = $this->vehicleRepository->findAll();

        // Obtener todos los clientes disponibles
        $customers = $this->customerRepository->findAll();

        // Contador
        $orderCount = 0;

        while ($orderCount < 10 && count($vehicles) > 0) {
            $order = new Order();
            $order->setState($this->faker->randomElement(['In process', 'Completed']));

            $randomVehicle = array_rand($vehicles);
            $vehicle = $vehicles[$randomVehicle];

            $order->addVehicle($vehicle);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
    }
}
