<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;

class FonctionRepository extends EntityRepository
{
    /**
     * Get All fonctions
     *
     * @return Fonction
     */
    public function queryGetFonctions()
    {
        return $this->createQueryBuilder("f")
            ->getQuery()
            ->getResult();
    }
     
    /**
     * Get fonction by LibelleFonction
     *
     * @param String $LibelleFonction
     * @return Fonction
     */
    public function queryGetFonctionByLibelleFonction(String $LibelleFonction)
    {
        return $this->createQueryBuilder("f")
            ->where('f.LibelleFonction = :LibelleFonction')
            ->setParameter('LibelleFonction', $LibelleFonction)
            ->getQuery()
            ->getOneOrNullResult();
    }

     /**
     * Get fonction by id
     *
     * @param String $IdFonction
     * 
     * @return Fonction
     */
    public function queryGetFonctionById(String $IdFonction)
    {
    return $this->createQueryBuilder("f")
        ->where('f.id = :id')
        ->setParameter('id', $IdFonction)
        ->getQuery()
        ->getOneOrNullResult();
    }

    

    /**
     * Get fonction by LibelleFonction
     *
     * @param String $partialLibelleFonction
     * 
     * @return Fonction
     */
    public function queryGetFonctionsByPartialLibelleFonction(String $partialLibelleFonction)
    {
    return $this->createQueryBuilder("f")
        ->where('f.LibelleFonction LIKE :LibelleFonction')
        ->setParameter('LibelleFonction', '%' . $partialLibelleFonction . '%')
        ->getQuery()
        ->getResult();
    }
}