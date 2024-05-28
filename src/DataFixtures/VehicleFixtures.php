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

        for ($i = 0; $i < 40; $i++) {
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

                $manager->persist($model);

                $models[] = $model;
            }
        }

        for ($i = 0; $i < 24; $i++) {
            $vehicle = new Vehicle();
            $vehicle->setPlate($this->faker->vehicleRegistration('[0-9]{4}[A-Z]{3}'));
            $vehicle->setFuel($this->faker->randomElement(['Gasolina', 'Gasoil', 'Eléctrico']));
            $vehicle->setColor($this->faker->colorName());
            $vehicle->setPricePerDay($this->faker->randomFloat(2, 50, 300));
            $vehicle->setTransmission($this->faker->randomElement(['Automatico', 'Manual']));
            $vehicle->setDeleted(false);
            $vehicle->setConsumption($this->faker->randomFloat(2, 3, 15)); // Liters per 100km
            $vehicle->setAcceleration($this->faker->randomFloat(2, 2, 15)); // 0-100 km/h in seconds
            $vehicle->setPower($this->faker->numberBetween(60, 500)); // Horsepower
            $vehicle->setEngine($this->faker->randomElement(['V6', 'V8', 'I4', 'I6', 'Electric']));

            $brand = $brands[array_rand($brands)];
            $vehicle->setBrand($brand);

            $providers = $this->providerRepository->findAll();
            $provider = $providers[array_rand($providers)];
            $vehicle->setProvider($provider);

            // Genera una descripción truncada a 255 caracteres
            $description = sprintf(
                'Este vehículo es un %s %s del año %d. Está equipado con un motor %s que produce una potencia de %d CV. Ofrece una aceleración de 0 a 100 km/h en %.2f segundos y tiene un consumo de combustible de %.2f litros por cada 100 km. Su color es %s y cuenta con una transmisión %s.',
                $brand->getName(),
                $model->getName(),
                $model->getYear(),
                $vehicle->getEngine(),
                $vehicle->getPower(),
                $vehicle->getAcceleration(),
                $vehicle->getConsumption(),
                $vehicle->getColor(),
                $vehicle->getTransmission()
            );

            // Trunca la descripción a 255 caracteres
            $vehicle->setDescription(substr($description, 0, 255));

            $manager->persist($vehicle);

            $this->addReference('vehicle_' . $i, $vehicle);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProviderFixtures::class];
    }
}
