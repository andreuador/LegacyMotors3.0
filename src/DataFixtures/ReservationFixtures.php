<?php

namespace App\DataFixtures;

use App\Entity\PaymentDetails;
use App\Entity\Reservation;
use App\Entity\Review;
use App\Entity\Order;
use App\Repository\CustomerRepository;
use App\Repository\VehicleRepository;
use App\Repository\OrderRepository;
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
    private OrderRepository $orderRepository;

    public function __construct(CustomerRepository $customerRepository, VehicleRepository $vehicleRepository, OrderRepository $orderRepository) {
        $this->faker = Factory::create('es_ES');
        $this->customerRepository = $customerRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->orderRepository = $orderRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $customers = $this->customerRepository->findAll();
        $vehicles = $this->vehicleRepository->findAll();
        $orders = $this->orderRepository->findAll();

        // Solo crear reservas si hay clientes, vehículos y órdenes disponibles
        if (!empty($customers) && !empty($vehicles) && !empty($orders)) {
            for ($i = 0; $i < 5; $i++) {
                $reservation = new Reservation();
                $startDate = $this->faker->dateTimeBetween('now', '+1 month');

                // Calcular la fecha de fin
                $endDate = clone $startDate;
                $endDate->modify('+1 day');

                $reservation->setStartDate($startDate);
                $reservation->setEndDate($endDate);
                $reservation->setTotalPrice($this->faker->numberBetween(100, 1000));
                $reservation->setDeleted(false);

                // Asignar un cliente y un vehículo a la reserva
                $randomCustomer = array_rand($customers);
                $customer = $customers[$randomCustomer];
                $reservation->setCustomer($customer);

                $randomVehicle = array_rand($vehicles);
                $vehicle = $vehicles[$randomVehicle];
                $reservation->setVehicle($vehicle);

                // Asignar una orden a la reserva
                $randomOrder = array_rand($orders);
                $order = $orders[$randomOrder];
                $reservation->setReservationOrder($order);

                // Crear la review aleatoria
                $review = new Review();
                $review->setComment($this->faker->sentence());
                $review->setRating($this->faker->numberBetween(1, 5));

                $endDateReservation = $reservation->getEndDate()->format('Y-m-d');
                $review->setDate($this->faker->dateTimeBetween($startDate, $endDateReservation));
                $reservation->addReview($review);

                // Crear PaymentDetails aleatorios
                $paymentDetails = new PaymentDetails();
                $paymentDetails->setPaymentMethod($this->faker->randomElement(['visa', 'mastercard']));
                $paymentDetails->setCardNumber($this->faker->creditCardNumber());
                $paymentDetails->setExpiryDate($this->faker->dateTimeBetween('now', '+5 years'));
                $paymentDetails->setCvv($this->faker->randomNumber(3));

                $reservation->setPaymentDetails($paymentDetails);

                $manager->persist($reservation);
                $manager->persist($review);
                $manager->persist($paymentDetails);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CustomerFixtures::class, VehicleFixtures::class, OrderFixtures::class];
    }
}
