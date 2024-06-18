<?php

namespace App\DataFixtures;

use App\Entity\Software;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    private const SOFTWARES = ["Adobe Photoshop", "Adobe After Effects", "Adobe Illustrator", "Blender"];

    public function load(ObjectManager $manager): void
    {
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
