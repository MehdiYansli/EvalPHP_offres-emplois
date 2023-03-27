<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Job;
use App\Entity\User;
use App\Entity\Apply;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');


        $users = [];
        for ($i = 0; $i < 5; $i++) {
            $user = new User;
            $user
                ->setEmail($faker->safeEmail())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setUsername($faker->firstName() . '_' . $faker->lastName())
                ->setPassword($faker->sha256())
                ->setRoles(['ROLE_USER']);

            $manager->persist($user);
            $users[] = $user;
        }

        $jobs = [];
        for ($i = 0; $i < 32; $i++) {
            $job = new Job;
            $job 
                ->setTitle($faker->words(10, true))
                ->setDepartment($faker->randomNumber(2, false))
                ->setCity($faker->word())
                ->setDescription($faker->paragraph())
                ->setSendAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 months', 'now')))
                ->setEndDate($faker->dateTime())
                ->setSalary($faker->randomNumber(6, false))
                ->setType($faker->randomElement(['CDI', 'CDD', 'Intérime', 'Alternance', 'Stage']))
                ->setDuration($faker->randomNumber(2, false) . ' ' . $faker->randomElement(['mois', 'ans']));
            
            $manager->persist($job);
            $jobs[] = $job;
        }

        $applies = [];
        for ($i=0; $i < 10; $i++) {
            $apply = new Apply; 
            $apply 
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setEmail($faker->safeEmail())
                ->setMessage($faker->text())
                ->setSendAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 months', 'now')))
                ->setUserId($faker->randomElement($users))
                ->setJobId($faker->randomElement($jobs))
                ;

            $manager->persist($apply);
            $applies[] = $apply;
        }

        $manager->flush();
    }
}
