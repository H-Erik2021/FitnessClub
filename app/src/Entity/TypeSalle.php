<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Entity\TypeSalleRepository")
 * @ORM\Table(name="TypeSalle")
 */
class TypeSalle
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="NumTypeSalle", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nomTypeSalle
     *
     * @ORM\Column(name="NomTypeSalle", type="string", length=80)
     */
    private $nomTypeSalle;


    /**
     * Constructor
     */
    public function __construct(string $nomTypeSalle )
    {
        $this->nomTypeSalle = $nomTypeSalle;            
        
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
     * Get $nomTypeSalle
     *
     * @return  string
     */ 
    public function getNomTypeSalle()
    {
        return $this->nomTypeSalle;
    }

    /**
     * Set $nomTypeSalle
     *
     * @param  string  $nomTypeSalle 
     *
     * @return  self
     */ 
    public function setNomTypeSalle(string $nomTypeSalle)
    {
        $this->nomTypeSalle = $nomTypeSalle;

        return $this;
    }
}
