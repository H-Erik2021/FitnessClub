<?php

namespace App\Entity;
use App\Entity\TypeCours;
use App\Entity\Salle;
use App\Entity\Reservation;
;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Entity\PlanificationRepository")
 * @ORM\Table(name="planification")
 */
class Planification
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="IdPlanification", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime $datePlanification
     *
     * @ORM\Column(name="DatePlanification", type="datetime")
     */
    private $datePlanification;

   
    /**
     * @var Salle $salle
     * @ORM\ManyToOne(targetEntity="App\Entity\Salle")
     * @ORM\JoinColumn(name="NumSalle", referencedColumnName="NumSalle")
     */
    private $salle;

    /**
     * @var TypeCours $typeCours
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCours")
     * @ORM\JoinColumn(name="NumTypeCours", referencedColumnName="NumTypeCours")
     */
    private $typeCours;
    
    /**
     * @var Staff $perso
     * @ORM\ManyToOne(targetEntity="App\Entity\Staff")
     * @ORM\JoinColumn(name="NumPerso", referencedColumnName="NumPerso")
     */
    private $perso;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="planning")
     */
    private $reservations;

    
    
    /**
     * Constructor
     */
    public function __construct(\DateTime $datePlanification, Salle $salle, TypeCours $typeCours, Staff $perso )
    {
        $this->datePlanification = $datePlanification; 
        $this->salle = $salle;
        $this->typeCours = $typeCours;
        $this->perso = $perso;
    }    

    /**
     * Get $id
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get $datePlanification
     *
     * @return DateTime
     */ 
    public function getDatePlanification()
    {
        return $this->datePlanification;
    }

    /**
     * Set $datePlanification
     *
     * @param  DateTime  $datePlanification 
     * 
     * @return  self
     */ 
    public function setDatePlanification($datePlanification)
    {
        $this->datePlanification = $datePlanification;

        return $this;
    }    

    
    /**
     * Get $salle
     *
     * @return  Salle
     */ 
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set $salle
     *
     * @param  Salle  $salle  
     *
     * @return  self
     */ 
    public function setSalle($salle)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get $typeCours
     *
     * @return TypeCours 
     */ 
    public function getTypeCours()
    {
        return $this->typeCours;
    }

    /**
     * Set $typeCours
     *
     * @param  TypeCours $typeCours  
     *
     * @return  self
     */ 
    public function setTypeCours($typeCours)
    {
        $this->typeCours = $typeCours;

        return $this;
    }

    /**
     * Get $perso
     *
     * @return Staff 
     */ 
    public function getPerso()
    {
        return $this->perso;
    }

    /**
     * Set $perso
     *
     * @param  Staff  $perso
     *
     * @return  self
     */ 
    public function setPerso($perso)
    {
        $this->perso = $perso;

        return $this;
    }
    

    /**
     * Get the value of reservations
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Set the value of reservations
     *
     * @return  self
     */
    public function setReservations($reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }
}
