<?php

namespace App\DataFixtures;

use App\Entity\Software;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private const SOFTWARES = ["Adobe Photoshop", "Adobe After Effects", "Adobe Illustrator", "Blender"];

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        //ajout du processus du hachage de pwd
    }


    public function load(ObjectManager $manager): void
    {
        $regularUser = new User();
        $regularUser
            ->setEmail('visiteur@visiteur.com')
            ->setPassword($this->hasher->hashPassword($regularUser, 'test'));

        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setEmail('lana.karmaoui@admin.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($adminUser, 'test'));

        $manager->persist($adminUser);

        //...autres fixures...

        $faker = Factory::create('zh_TW');

        $softwares = [];

        foreach (self::SOFTWARES as $softwareName) {
            $software = new Software();
            $software->setName($softwareName);

           $manager->persist($software);
           $softwares[] = $software;
        }

        $manager->flush();
    }
}
