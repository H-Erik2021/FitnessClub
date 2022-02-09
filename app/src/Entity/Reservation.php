<?php

namespace App\Entity;
use App\Entity\TypeCours;
use App\Entity\Salle;
use App\Entity\Planification;
use App\Entity\User;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Entity\ReservationRepository")
 * @ORM\Table(name="reservation")
 */
class Reservation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="IdReservation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Planification $planning
     * @ORM\ManyToOne(targetEntity="App\Entity\Planification", inversedBy="reservations")
     * @ORM\JoinColumn(name="IdPlanification", referencedColumnName="IdPlanification")
     */
    private $planning;

    
   /**
     * @var User $client
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(name="NumClient", referencedColumnName="NumClient")
     */
    private $client;


    /**
     * Constructor
     */
    public function __construct(Planification $planning, User $client )
    {
        $this->planning =  $planning;
        $this->client = $client;      
        
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }       

    

    /**
     * Get $planning
     *
     * @return  Planification
     */
    public function getPlanning()
    {
        return $this->planning;
    }

    /**
     * Set $planning
     *
     * @param  Planification  $planning
     *
     * @return  self
     */
    public function setPlanning($planning)
    {
        $this->planning = $planning;

        return $this;
    }

    /**
     * Get $client
     *
     * @return  User
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set $client
     *
     * @param  User  $client
     * @return  self
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }
}
