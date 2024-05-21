<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Repository\CustomerRepository;
use App\Repository\InvoiceRepository;
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
    private InvoiceRepository $invoiceRepository;

    public function __construct(CustomerRepository $customerRepository, VehicleRepository $vehicleRepository, InvoiceRepository $invoiceRepository) {
        $this->faker = Factory::create('es_ES');
        $this->customerRepository = $customerRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->invoiceRepository = $invoiceRepository;
    }
    public function load(ObjectManager $manager): void
    {
        // Obtener todos los vehiculos disponibles
        $vehicles = $this->vehicleRepository->findAll();

        // Obtener todos los clientes disponibles
        $customers = $this->customerRepository->findAll();

        // Obtener todas las facturas
        $invoices = $this->invoiceRepository->findAll();

        // Contador
        $orderCount = 0;

        // Mientras no hayamos alcanzado el limite de 10 ordenes y aun queden vehiculos disponibles
        while ($orderCount < 20 && count($vehicles) > 0) {
            $order = new Order();
            $order->setState($this->faker->randomElement(['En proceso', 'Completado']));
            $order->setDeleted(false);

            $randomVehicle = array_rand($vehicles);
            $vehicle = $vehicles[$randomVehicle];

            $order->addVehicle($vehicle);

            // Eliminar el vehiculo asignado de la lista de vehiculos disponibles
            unset($vehicles[$randomVehicle]);

            // Asignar un cliente aleatorio a la orden
            $randomCustomer = array_rand($customers);
            $customer = $customers[$randomCustomer];
            $order->setCustomer($customer);

            $manager->persist($order);

            $orderCount++;

        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [VehicleFixtures::class];
    }
}
