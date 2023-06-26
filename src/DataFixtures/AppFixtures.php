<?php

namespace App\DataFixtures;

use App\Entity\Tools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

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
        
        $manager->flush();
    }
}
