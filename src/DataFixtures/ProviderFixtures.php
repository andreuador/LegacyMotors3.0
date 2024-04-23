<?php

namespace App\DataFixtures;

use App\Entity\Provider;
use App\Repository\ProviderRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ProviderFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }
    public function load(ObjectManager $manager): void
    {
        $providers = [];

        for ($i = 0; $i < 10; $i++) {
            $provider = new Provider();
            $provider->setName($this->faker->company());
            $provider->setEmail($this->faker->companyEmail());
            $provider->setDni($this->faker->dni());
            $provider->setCif($this->faker->regexify('/^[0-9]{8}[A-Z]{1}$/'));
            $provider->setAddress($this->faker->address());

            $providers[] = $provider;
            $manager->persist($provider);
        }

        $manager->flush();
    }
}
