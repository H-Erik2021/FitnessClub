<?php

namespace DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Rank;

class UserFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $dataUsers= [
            ['Pierre DURAND', 'pierre@gmail.com', '06084848484','Administrateur'],
            ['Frédéric CHOPIN', 'sylvain@yahoo.com', '0608745454','Utilisateur avec pouvoirs'],
            ['Richard STRAUSS', 'denise@men.com', '0687459994','Utilisateur simple'],
            ['Enrico MACIAS', 'elodie@altavista.com', '060788787','Administrateur'],
            ['Johnny HALIDAY', 'pierre@gmail.com', '06084848484','Administrateur'],
            ['Charles AZNAVOUR', 'sylvain@yahoo.com', '0608745454','Utilisateur simple'],
            ['Anny CORDY', 'denise@men.com', '0687459994','Utilisateur simple'],
            ['Philippe MARTIN', 'elodie@altavista.com', '060788787','Utilisateur simple'],
            ['Fred ASTAIR', 'pierre@gmail.com', '06084848484','Utilisateur simple'],
            ['Jessy OWENS', 'sylvain@yahoo.com', '0608745454','Utilisateur simple'],
            ['Yannick NOAH', 'denise@men.com', '0687459994','Utilisateur simple'],
            ['Alfred ENSTEIN', 'elodie@altavista.com', '060788787', 'toto'],
        ];

        $repository = $manager->getRepository(Rank::class);
        foreach($dataUsers as $dataUser) {
            $monuser=new User($dataUser[0],$dataUser[1],$dataUser[2], $repository->queryGetRankByName($dataUser[3]));
            ///$monuser->setRank( $repository->queryGetRankByName('Utilisateur simple') ); 
            $manager->persist($monuser);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
