<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;
use App\Entity\Reservation;

class UserRepository extends EntityRepository
    {
        /**
         * Get All users
         *
         * @return User
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
     * @return User
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
     * Get user by NomClient
     *
     * @param String $NomClient
     * @return User
     */
    public function queryGetUserByNomClient(String $NomClient)
    {
    return $this->createQueryBuilder("u")
        ->where('u.NomClient = :NomClient')
        ->setParameter('NomClient', $NomClient)
        ->getQuery()
        ->getOneOrNullResult();
    }

    /**
     * Get users by NomClient
     *
     * @param String $partialNomClient
     * @return User
     */
    public function queryGetUsersByPartialNomClient(String $partialNomClient)
    {
    return $this->createQueryBuilder("u")
        ->where('u.NomClient LIKE :NomClient')
        ->setParameter('NomClient', '%' . $partialNomClient . '%')
        ->getQuery()
        ->getResult();
    }

    public function findTypeCoursUser($numClient)
    {
        return $this->createQueryBuilder('u')
            ->select('tc.id')
            ->innerJoin('u.adhesions', 'a')
            ->innerJoin('a.formule', 'f')
            ->innerJoin('f.formulesTypeCours', 'ftc')
            ->join('ftc.typeCours', 'tc', 'WITH', 'ftc.typeCours = tc.id')
            ->where('u.id = :idClient')
            ->setParameter('idClient', $numClient)
            ->getQuery()
            ->getResult();
    }

}
