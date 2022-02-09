<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Entity\FormuleRepository")
 * @ORM\Table(name="formuletypecours")
 */
class FormuleTypeCours
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
     * @var Formule $formule
     * @ORM\ManyToOne(targetEntity="App\Entity\Formule", inversedBy="formulesTypeCours")
     * @ORM\JoinColumn(name="IdFormule", referencedColumnName="IdFormule")
     */
    private $formule;

    /**
     * @var TypeCours $typeCours
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCours", inversedBy="formulesTypeCours")
     * @ORM\JoinColumn(name="IdTypeCours", referencedColumnName="NumTypeCours")
     */
    private $typeCours; 

    

    /**
     * Constructor
     */
    public function __construct( TypeCours $typeCours, Formule $formule)
    {
        $this->formule = $formule;
        $this->typeCours = $typeCours;         
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
     * @return Formule
     */
    public function getFormule(): Formule
    {
        return $this->formule;
    }

    /**
     * @param Formule $formule
     */
    public function setFormule(Formule $formule)
    {
        $this->formule = $formule;

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
}
