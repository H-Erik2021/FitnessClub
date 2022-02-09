<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Formule;
use App\Entity\User;
use App\Entity\Casier;

/**
 * @ORM\Entity(repositoryClass="App\Entity\AdhesionRepository")
 * @ORM\Table(name="adhesion")
 */
class Adhesion
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="NumAdhes", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Formule $formule
     * @ORM\ManyToOne(targetEntity="App\Entity\Formule")
     * @ORM\JoinColumn(name="IdFormule", referencedColumnName="IdFormule")
     */
    private $formule;

    /**
     * @var integer $dureeAdhesion
     *
     * @ORM\Column(name="DureeAdhesion", type="integer")     
     */
    private $dureeAdhesion;

    /**
     * @var date $dateAdhesion
     *
     * @ORM\Column(name="DateAdhes", type="date")
     */
    private $dateAdhesion;

    /**
     * @var \DateTime $dateFinAdhesion
     *
     */
    private $dateFinAdhesion;

    /**
     * @var integer $tarifAdhesion
     *
     * @ORM\Column(name="TarifAdhes", type="integer")     
     */
    private $tarifAdhesion;

    /**
     * @var User $client
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="adhesions")
     * @ORM\JoinColumn(name="NumClient", referencedColumnName="NumClient")
     */
    private $client;
    
    /**
     * @var Casier $casier
     * @ORM\ManyToOne(targetEntity="App\Entity\Casier")
     * @ORM\JoinColumn(name="IdCasier", referencedColumnName="IdCasier")
     */
    private $casier;

    /**
     * Constructor
     */
    public function __construct(Formule $formule, $dureeAdhesion, \Datetime $dateAdhesion, $tarifAdhesion, User $client, Casier $casier )
    {
        $this->formule = $formule;
        $this->dureeAdhesion = $dureeAdhesion;
        $this->dateAdhesion = $dateAdhesion;
        $this->tarifAdhesion = $tarifAdhesion;
        $this->client = $client;
        $this->casier = $casier;
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
     * Get $formule
     *
     * @return  Formule
     */
    public function getFormule()
    {
        return $this->formule;
    }

       /**
     * Set $formule
     *
     * @param  Formule  $formule
     *
     * @return  self
     */
    public function setFormule(Formule $formule)
    {
        $this->formule = $formule;

        return $this;
    }
    
    /**
     * Get $dureeAdhesion
     *
     * @return  integer
     */
    public function getDureeAdhesion()
    {
        return $this->dureeAdhesion;
    }

    /**
     * Set $dureeAdhesion
     *
     * @param  integer  $dureeAdhesion
     * @return  self
     */
    public function setDureeAdhesion($dureeAdhesion)
    {
        $this->dureeAdhesion = $dureeAdhesion;

        return $this;
    }

    /**
     * Get $dateAdhesion
     *
     * @return Datetime
     */
    public function getDateAdhesion()
    {
        return $this->dateAdhesion;
    }

    /**
     * Set $dateAdhesion
     *
     * @param  Datetime $dateAdhesion
     *
     * @return  self
     */
    public function setDateAdhesion($dateAdhesion)
    {
        $this->dateAdhesion = $dateAdhesion;

        return $this;
    }

    /**
     * Get $tarifAdhesion
     *
     * @return  integer
     */
    public function getTarifAdhesion()
    {
        return $this->tarifAdhesion;
    }

    /**
     * Set $tarifAdhesion
     *
     * @param  integer  $tarifAdhesion
     *
     * @return  self
     */
    public function setTarifAdhesion($tarifAdhesion)
    {
        $this->tarifAdhesion = $tarifAdhesion;

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
     *
     * @return  self
     */
    public function setClient(User $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get $Casier
     *
     * @return  Casier
     */
    public function getCasier()
    {
        return $this->casier;
    }

    /**
     * Set $casier
     *
     * @param  Casier  $casier
     * @return  self
     */
    public function setCasier(Casier $casier)
    {
        $this->casier = $casier;

        return $this;
    }

    /**
     * @param \DateTime $dateFinAdhesion
     */
    public function setDateFinAdhesion()
    {
        $duree = sprintf('+%d month', $this->getDureeAdhesion());
        $dateFinAdhesion = $this->getDateAdhesion();
        $dateFinAdhesion->modify($duree);
        $this->dateFinAdhesion = $dateFinAdhesion;
    }

    /**
     * @return \DateTime
     */
    public function getDateFinAdhesion(): \DateTime
    {
        return $this->dateFinAdhesion;
    }

}
