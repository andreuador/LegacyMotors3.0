<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageFixtures extends Fixture
{
    private Generator $faker;

    public function __construct() {
        $this->faker = Factory::create('es_ES');
    }
    public function load(ObjectManager $manager): void
    {
        // Obtindre totes les entitats de Vehicle disponibles
        $vehicles = $manager->getRepository(Vehicle::class)->findAll();

        foreach ($vehicles as $vehicle) {
            // Crear imatges per als vehicles
            for ($i = 0; $i < random_int(2, 5); $i++) {
                $image = new Image();

                // Generar el nombre del archivo de imagen
                $imageFilePath = $this->faker->file('resources/vehicles', 'public/images/vehicles', false);
                $imageFile = new UploadedFile(
                    'public/images/vehicles/' . $imageFilePath,
                    $imageFilePath,
                    null,
                    null,
                    true // Mark the file as test to bypass security checks
                );

                $image->setImageFile($imageFile);
                $image->setVehicle($vehicle);
                $manager->persist($image);
            }
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [VehicleFixtures::class];
    }
}
