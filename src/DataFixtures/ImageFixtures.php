<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Random\RandomException;

class ImageFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }

    /**
     * @throws RandomException
     */
    public function load(ObjectManager $manager): void
    {

        $vehicles = $manager->getRepository(Vehicle::class)->findAll();

        foreach ($vehicles as $vehicle) {
            // Crear tres imágenes para cada vehículo
            for ($i = 0; $i < random_int(2, 5); $i++) {
                $image = new Image();
                $image->setFilename($this->faker->file('/resources/images/', '/public/images/vehicles/', false));
                $image->setVehicle($vehicle);
                $manager->persist($image);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VehicleFixtures::class,
        ];
    }
}
