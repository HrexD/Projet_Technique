<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Tools;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $tool = new Tools();
        $tool->setName('Mousqueton');
        $tool->setQuantity(15);
        $tool->setSlug('mousqueton');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Gants d\'intervention');
        $tool->setQuantity(10);
        $tool->setSlug('gants');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Ceinture de sécurité tactique');
        $tool->setQuantity(20);
        $tool->setSlug('ceinture');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Détecteur de métaux');
        $tool->setQuantity(25);
        $tool->setSlug('detecteur');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Brassard de sécurité');
        $tool->setQuantity(30);
        $tool->setSlug('brassard');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Lampe torche');
        $tool->setQuantity(5);
        $tool->setSlug('lampe');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Bandeau « Agents cynophiles »');
        $tool->setQuantity(5);
        $tool->setSlug('bandeau');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Gilet pare-balles');
        $tool->setQuantity(12);
        $tool->setSlug('gilet');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Chemise manches courtes');
        $tool->setQuantity(30);
        $tool->setSlug('chemise');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Blouson');
        $tool->setQuantity(30);
        $tool->setSlug('blouson');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Coupe-vent');
        $tool->setQuantity(30);
        $tool->setSlug('coupe-vent');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Talkie walkies');
        $tool->setQuantity(20);
        $tool->setSlug('talkie');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Kits oreillettes');
        $tool->setQuantity(10);
        $tool->setSlug('oreillettes');
        $manager->persist($tool);

        $tool = new Tools();
        $tool->setName('Taser');
        $tool->setQuantity(5);
        $tool->setSlug('taser');
        $manager->persist($tool);

        $user = new User();
        $user->setLastName('Groetschel');
        $user->setFirstName('Jonas');
        $user->setRole('Vigile');
        $user->setPicture('test_1.jpg');
        $manager->persist($user);
        
        $manager->flush();
    }
}
