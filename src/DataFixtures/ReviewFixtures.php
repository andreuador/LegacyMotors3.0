<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Entity\Reservation;
use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }

    public function load(ObjectManager $manager): void
    {
        $reservations = $manager->getRepository(Reservation::class)->findAll();
        $customers = $manager->getRepository(Customer::class)->findAll();

        foreach ($reservations as $reservation) {
            $customer = $this->faker->randomElement($customers);
            for ($i = 0; $i < 2; $i++) {
                $review = new Review();
                $review->setRating($this->faker->numberBetween(1, 5));
                $review->setComment($this->faker->sentence);
                $review->setDate($this->faker->dateTimeBetween('-1 years', 'now'));
                $review->setReservation($reservation);
                $review->setCustomer($customer);
                $manager->persist($review);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ReservationFixtures::class,
            CustomerFixtures::class,
        ];
    }
}
