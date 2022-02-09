<?php

namespace DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Fonction;

class FonctionFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datafonction= ['Administrateur','Employe','Profgym','Profsquash'];
        foreach ( $datafonction as $datafonctions) {
            $newfonctions = new Fonction( $datafonctions);
            $manager->persist($newfonctions);
        }
        $manager->flush();
        //$this->addReference('fonction-admin', $user);
    }

    public function getOrder()
    {
        return 1;
    }
}
