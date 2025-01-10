<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Commentary;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i=0; $i < 10; $i++) { 
            $user = new User();
            $user
                ->setFirstname($faker->firstName('male'|'female'))
                ->setLastname($faker->lastName())
                ->setEmail($user->getFirstname() . '.'. $user->getLastName() . '@' . $faker->freeEmailDomain())
                ->setPassword($this->hasher->hashPassword($user, '1234'))
                ->setAvatar($faker->imageUrl(640, 480, 'animals', true))
                ->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }
        //dd($manager);
        $manager->flush();
    }
}
