<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\TypeSalle;

/**
 * @ORM\Entity(repositoryClass="App\Entity\SalleRepository")
 * @ORM\Table(name="salle")
 */
class Salle
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="NumSalle", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nomSalle
     *
     * @ORM\Column(name="NomSalle", type="string", length=80)
     */
    private $nomSalle;

    
    /**
     * @var TypeSalle $typeSalle
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeSalle")
     * @ORM\JoinColumn(name="NumTypeSalle", referencedColumnName="NumTypeSalle")
     */
    private $typeSalle;

    /**
     * Constructor
     */
    public function __construct(string $nomSalle, typeSalle $typeSalle )
    {
        $this->nomSalle = $nomSalle;
        $this->typeSalle = $typeSalle;      
        
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
     * Get $nomSalle
     *
     * @return  string
     */ 
    public function getNomSalle()
    {
        return $this->nomSalle;
    }

    /**
     * Set $nomSalle
     *
     * @param  string  $nomSalle
     *
     * @return  self
     */ 
    public function setNomSalle(string $nomSalle)
    {
        $this->nomSalle = $nomSalle;

        return $this;
    }

    /**
     * Get $typeSalle
     *
     * @return  TypeSalle
     */ 
    public function getTypeSalle()
    {
        return $this->typeSalle;
    }

    /**
     * Set $typeSalle
     *
     * @param  TypeSalle  $typeSalle  
     *
     * @return  self
     */ 
    public function setTypeSalle($typeSalle)
    {
        $this->typeSalle = $typeSalle;

        return $this;
    }
}
