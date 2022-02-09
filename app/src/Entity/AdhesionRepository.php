<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;

class AdhesionRepository extends EntityRepository
{
    public function findAdhesionsUserByTypeCours($numClient, $idTypeCours)
    {
        return $this->createQueryBuilder('a')
            ->join('a.client', 'c', 'WITH', 'a.client = :numClient')
            ->innerJoin('a.formule', 'f')
            ->innerJoin('f.formulesTypeCours', 'ftc')
            ->setParameter('numClient', $numClient)
            ->andWhere('ftc.typeCours = :idTypeCours')
            ->setParameter('idTypeCours', $idTypeCours)
            ->getQuery()
            ->getResult();
    }
}