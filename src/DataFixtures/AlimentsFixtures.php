<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AlimentsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Aliment();
        $a1->setNom('Carotte')
            ->setPrix(1.70)
            ->setImage("/public/img/aliments/carotte.png")
            ->setCalorie(30)
            ->setProteine(0.26)
            ->setGlucide(2.7)
            ->setLipide(0.26);
        $manager->persist($a1);

        $a2 = new Aliment();
        $a2->setNom('Patate')
            ->setPrix(1.81)
            ->setImage("/public/img/aliments/patate.jpg")
            ->setCalorie(73)
            ->setProteine(1.8)
            ->setGlucide(20)
            ->setLipide(0.36);
        $manager->persist($a2);

        $a3 = new Aliment();
        $a3->setNom('Pomme')
            ->setPrix(2.02)
            ->setImage("/public/img/aliments/pomme.png")
            ->setCalorie(52)
            ->setProteine(0.3)
            ->setGlucide(14)
            ->setLipide(0.2);
        $manager->persist($a3);

        $a4 = new Aliment();
        $a4->setNom('Tomate')
            ->setPrix(2.50)
            ->setImage("/public/img/aliments/tomate.png")
            ->setCalorie(21)
            ->setProteine(0.51)
            ->setGlucide(2.26)
            ->setLipide(0.26);
        $manager->persist($a4);

        $manager->flush();
    }
}
