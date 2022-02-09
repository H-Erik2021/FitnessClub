<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;

class PlanificationRepository extends EntityRepository {

    public function findAfterDateOfTheDay() 
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.datePlanification >= :datePlanification')
        ->setParameter('datePlanification', new \DateTime)
        ->orderBy('p.datePlanification', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function findAfterDateOfTheDay2() 
    {       
        return $this->createQueryBuilder('p')
        ->andWhere('p.datePlanification BETWEEN :datePlanification AND :n7days')
        ->setParameter('datePlanification', new \DateTime)
        ->setParameter('n7days', new \DateTime('+15days'))              
        ->orderBy('p.datePlanification', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function findTypeCoursSquash() 
    {
        return $this->createQueryBuilder('p')
        ->Where('p.typeCours in (:typeCours)')
        ->setParameter('typeCours',[1, 2, 4]  )            
        ->andWhere('p.datePlanification >= :datePlanification')
        ->andWhere('p.datePlanification BETWEEN :datePlanification AND :n7days')        
        ->setParameter('datePlanification', new \DateTime)
        ->setParameter('n7days', new \DateTime('+15days'))
        ->orderBy('p.datePlanification', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function findTypeCoursGym() 
    {
        return $this->createQueryBuilder('p')
        ->Where('p.typeCours in (:typeCours)')
        ->setParameter('typeCours',[3]  )            
        ->andWhere('p.datePlanification >= :datePlanification')
        ->andWhere('p.datePlanification BETWEEN :datePlanification AND :n7days') 
        ->setParameter('datePlanification', new \DateTime)
        ->setParameter('n7days', new \DateTime('+15days'))
        ->orderBy('p.datePlanification', 'ASC')
        ->getQuery()
        ->getResult();
    }
    
    public function findTypeCoursCollectif() 
    {
        return $this->createQueryBuilder('p')
        ->Where('p.typeCours in (:typeCours)')
        ->setParameter('typeCours',[3, 2]  )            
        ->andWhere('p.datePlanification >= :datePlanification')
        ->andWhere('p.datePlanification BETWEEN :datePlanification AND :n7days') 
        ->setParameter('datePlanification', new \DateTime)
        ->setParameter('n7days', new \DateTime('+15days'))
        ->orderBy('p.datePlanification', 'ASC')
        ->getQuery()
        ->getResult();
    }

    /**
     * Get Dates by datePlanification
     *
     * @param string $partialDatePlanification
     * @return Planification
     */
    public function queryGetDatesByPartialDatePlanification(string $partialDatePlanification)
    {
    return $this->createQueryBuilder("p")
        ->where('p.datePlanification LIKE :datePlanification')
        ->setParameter('datePlanification', '%' . $partialDatePlanification . '%')
        ->getQuery()
        ->getResult();
    }

    
   
}
