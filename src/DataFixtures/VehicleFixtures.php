<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Vehicle;
use App\Entity\VehicleType;
use App\Repository\ProviderRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider\FakeCar;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct(private readonly ProviderRepository $providerRepository)
    {
        $this->faker = Factory::create('es_ES');
        $this->faker->addProvider(new Fakecar($this->faker));
    }

    public function load(ObjectManager $manager): void
    {
        $brands = [];
        $models = [];

        for ($i = 0; $i < 20; $i++) {
            $vehicleArray = $this->faker->vehicleArray;
            $brandName = $vehicleArray['brand'];

            if (empty(array_filter($brands, function ($value) use ($brandName) {
                if ($value === $brandName)
                    return true;
            }))) {
                $brand = new Brand();
                $brand->setName($brandName);
                $manager->persist($brand);

                $brands[] = $brand;
            }

            $modelName = $vehicleArray['model'];
            if (empty(array_filter($models, function ($value) use ($modelName) {
                if ($value === $modelName)
                    return true;
            }))) {
                $model = new Model();
                $model->setName($vehicleArray['model']);
                $model->setBrand($brand);
                $model->setYear($this->faker->biasedNumberBetween(1950, date('Y'), 'sqrt'));
                $model->setDescription("funciona");

                $manager->persist($model);

                $models[] = $model;
            }
        }

        for ($i = 0; $i < 20; $i++) {
            $vehicle = new Vehicle();
            $vehicle->setPlate($this->faker->vehicleRegistration('[0-9]{4}[A-Z]{3}'));
            $vehicle->setFuel($this->faker->vehicleFuelType);
            $vehicle->setColor($this->faker->colorName());
            $vehicle->setPricePerDay($this->faker->randomFloat(2, 50, 300));
            $vehicle->setAvailable(true);
            $vehicle->setDoors($this->faker->numberBetween(2, 5));
            $vehicle->setCapacity($this->faker->numberBetween(2, 8));
            $vehicle->setTransmission($this->faker->randomElement(['automatic', 'manual']));
            $vehicle->setDescription('funciona');
            $vehicle->setCategory($this->faker->randomElement(['gasolina', 'gasoil', 'electic']));
            $vehicle->setDeleted(false);

            $brand = $brands[array_rand($brands)];
            $vehicle->setBrand($brand);

            $providers = $this->providerRepository->findAll();
            $provider = $providers[array_rand($providers)];
            $vehicle->setProvider($provider);

            $manager->persist($vehicle);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return [ProviderFixtures::class];
    }
}
