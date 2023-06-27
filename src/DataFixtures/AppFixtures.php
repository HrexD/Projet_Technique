<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Tools;
use App\Entity\Pictures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $tool = new Tools();
        $tool->setName('mousqueton');
        $tool->setQuantity(15);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('gants d\'intervention');
        $tool->setQuantity(10);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('ceinture de sécurité tactique');
        $tool->setQuantity(20);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('détecteur de métaux');
        $tool->setQuantity(25);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('brassard de sécurité');
        $tool->setQuantity(30);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('lampe torche');
        $tool->setQuantity(5);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('bandeaux « Agents cynophiles »');
        $tool->setQuantity(5);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('gilet pare-balles');
        $tool->setQuantity(12);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('chemise manches courtes');
        $tool->setQuantity(30);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('blouson');
        $tool->setQuantity(30);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('coupe-vent');
        $tool->setQuantity(30);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('talkie walkies');
        $tool->setQuantity(20);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('kits oreillettes');
        $tool->setQuantity(10);
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('taser');
        $tool->setQuantity(5);
        $manager->persist($tool);

        $user = new User();
        $user->setLastName('Groetschel');
        $user->setFirstName('Jonas');
        $user->setRole('Vigile');
        $manager->persist($user);

        $picture = new Pictures();
        $picture->setUrl('test_1.jpg');
        $picture->setRelatedUser($user);
        $manager->persist($picture);
        
        $manager->flush();
    }
}
