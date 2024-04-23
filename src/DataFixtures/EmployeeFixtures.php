<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\Login;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployeeFixtures extends Fixture
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
            $employee = new Employee();
            $employee->setName($this->faker->name());
            $employee->setSurname($this->faker->lastName());

            $login = new Login();
            $login->setUsername($this->faker->userName());
            $login->setPassword($this->hasher->hashPassword($login, 'admin'));
            $login->setRole('ROLE_ADMIN');

            $employee->setLogin($login);

            $manager->persist($login);
            $manager->persist($employee);
        }
        $manager->flush();
    }
}
