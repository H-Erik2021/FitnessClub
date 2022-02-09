<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Entity\FormuleRepository")
 * @ORM\Table(name="formule")
 */
class Formule
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="IdFormule", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nomFormule
     *
     * @ORM\Column(name="NomFormule", type="string")
     */
    private $nomFormule;

    
    /**
     * @var integer $tarifFormule
     *
     * @ORM\Column(name="TarifFormule", type="integer")
     */
    private $tarifFormule;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormuleTypeCours", mappedBy="formule")
     */
    private $formulesTypeCours;

    /**
     * Constructor
     */
    public function __construct(string $nomFormule, int $tarifFormule )
    {
        $this->nomFormule = $nomFormule;
        $this->tarifFormule = $tarifFormule;      
        
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
     * Get $nomFormule
     *
     * @return  string
     */
    public function getNomFormule()
    {
        return $this->nomFormule;
    }

    /**
     * Set $nomFormule
     *
     * @param  string  $nomFormule
     *
     * @return  self
     */
    public function setNomFormule(string $nomFormule)
    {
        $this->nomFormule = $nomFormule;

        return $this;
    }

    /**
     * Get $tarifFormule
     *
     * @return  integer
     */
    public function getTarifFormule()
    {
        return $this->tarifFormule;
    }

    /**
     * Set $tarifFormule
     *
     * @param  integer  $tarifFormule
     *
     * @return  self
     */
    public function setTarifFormule($tarifFormule)
    {
        $this->tarifFormule = $tarifFormule;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormulesTypeCours()
    {
        return $this->formulesTypeCours;
    }

    /**
     * @param mixed $formulesTypeCours
     */
    public function setFormulesTypeCours($formulesTypeCours)
    {
        $this->formulesTypeCours = $formulesTypeCours;

        return $this;
    }

}
