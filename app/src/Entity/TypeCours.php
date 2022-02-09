<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Entity\TypeCoursRepository")
 * @ORM\Table(name="typecours")
 */
class TypeCours
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="NumTypeCours", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nomTypeCours
     *
     * @ORM\Column(name="NomTypeCours", type="string", length=80)
     */
    private $nomTypeCours;

    /**
     * @var time $dureeCours
     *
     * @ORM\Column(name="DureeCours", type="time")
     */
    private $dureeCours;

    /**
     * @var integer $NbMaxDisponibilite
     *
     * @ORM\Column(name="NbMaxDisponibilite", type="integer")
     */
    private $NbMaxDisponibilite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormuleTypeCours", mappedBy="typecours")
     */
    private $lestypesCours;


    /**
     * Constructor
     */
    public function __construct(string $nomTypeCours, time $dureeCours, int $NbMaxDisponibilite )
    {
        $this->nomTypeCours = $nomTypeCours;
        $this->dureeCours = $dureeCours; 
        $this->nbMaxDisponiobilite = $NbMaxDisponibilite;   
        
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
     * Get $nomTypeCours
     *
     * @return  string
     */ 
    public function getNomTypeCours()
    {
        return $this->nomTypeCours;
    }

    /**
     * Set $nomTypeCours
     *
     * @param  string  $nomTypeCours 
     *
     * @return  self
     */ 
    public function setNomTypeCours(string $nomTypeCours)
    {
        $this->nomTypeCours = $nomTypeCours;

        return $this;
    }

    /**
     * Get $dureeCours
     *
     * @return  time
     */
    public function getDureeCours()
    {
        return $this->dureeCours;
    }

    /**
     * Set $dureeCours
     *
     * @param  time  $dureeCours
     *
     * @return  self
     */
    public function setDureeCours($dureeCours)
    {
        $this->dureeCours = $dureeCours;

        return $this;
    }

    /**
     * Get $NbMaxDisponibilite
     *
     * @return  integer
     */
    public function getNbMaxDisponibilite()
    {
        return $this->NbMaxDisponibilite;
    }

    /**
     * Set $NbMaxDisponibilite
     *
     * @param  integer  $NbMaxDisponibilite
     *
     * @return  self
     */
    public function setNbMaxDisponibilite($NbMaxDisponibilite)
    {
        $this->NbMaxDisponibilite = $NbMaxDisponibilite;

        return $this;
    }    

    
}
