<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;

class StaffRepository extends EntityRepository
    {
        /**
         * Get All users
         *
         * @return Staff
         */
        public function queryGetUsers()
        {
            return $this->createQueryBuilder("u")
                ->getQuery()
                ->getResult();
        }


    /**
     * Get user by id
     *
     * @param String $userid
     * 
     * @return Staff
     */
    public function queryGetUserById(String $userid)
    {
    return $this->createQueryBuilder("u")
        ->where('u.id = :id')
        ->setParameter('id', $userid)
        ->getQuery()
        ->getOneOrNullResult();
    }

    /**
     * Get user by NomPerso
     *
     * @param String $NomPerso
     * 
     * @return Staff
     */
    public function queryGetUserByNomPerso(String $NomPerso)
    {
    return $this->createQueryBuilder("u")
        ->where('u.NomPerso = :NomPerso')
        ->setParameter('NomPerso', $NomPerso)
        ->getQuery()
        ->getOneOrNullResult();
    }

    /**
     * Get users by NomPerso
     *
     * @param String $partialNomPerso
     * 
     * @return Staff
     */
    public function queryGetUsersByPartialNomPerso(String $partialNomPerso)
    {
    return $this->createQueryBuilder("u")
        ->where('u.NomPerso LIKE :NomPerso')
        ->setParameter('NomPerso', '%' . $partialNomPerso . '%')
        ->getQuery()
        ->getResult();
    }
}
