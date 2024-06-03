<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Login;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerFixtures extends Fixture
{
    private Generator $faker;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Factory::create('es_ES');

    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $customer = new Customer();
            $customer->setName($this->faker->name());
            $customer->setLastname($this->faker->lastName());
            $customer->setEmail($this->faker->email());
            $customer->setAddress($this->faker->address());
            $customer->setDni($this->faker->regexify('/^[A-Z0-9]{9}$/'));
            $customer->setPhone($this->faker->phoneNumber());
            $customer->setDeleted(false);

            $login = new Login();
            $login->setUsername($this->faker->userName);
            $login->setPassword($this->hasher->hashPassword($login, "private"));
            $login->setRole('ROLE_PRIVATE');

            $customer->setLogin($login);

            $manager->persist($login);
            $manager->persist($customer);
        }

        // Client
        $customerPrivate = new Customer();
        $customerPrivate->setName('private');
        $customerPrivate->setLastname('private');
        $customerPrivate->setEmail($this->faker->email());
        $customerPrivate->setAddress($this->faker->address());
        $customerPrivate->setDni($this->faker->regexify('/^[A-Z0-9]{9}$/'));
        $customerPrivate->setPhone($this->faker->phoneNumber());
        $customerPrivate->setDeleted(false);

        $loginPrivate = new Login();
        $loginPrivate->setUsername('private');
        $loginPrivate->setPassword($this->hasher->hashPassword($loginPrivate, "private"));
        $loginPrivate->setRole('ROLE_PRIVATE');

        $customerPrivate->setLogin($loginPrivate);

        $manager->persist($loginPrivate);
        $manager->persist($customerPrivate);

        $manager->flush();
    }
}