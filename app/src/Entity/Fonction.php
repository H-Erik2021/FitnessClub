<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Entity\FonctionRepository")
 * @ORM\Table(name="fonction")
 */
class Fonction
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="IdFonction", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $LibelleFonction
     *
     * @ORM\Column(type="string", length=50)
     */
    private $LibelleFonction;

    /**
     * @var bool $isProf
     *
     * @ORM\Column(type="boolean")
     */
    private $isProf;

    /**
     * Constructor
     */
    public function __construct(String $fonction, bool $isProf)
    {
        $this->LibelleFonction = $fonction;
        $this->isProf = $isProf;
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
     * Set LibelleFonction
     *
     * @param string $LibelleFonction
     *
     * @return Fonction
     */
    public function setLibelleFonction($LibelleFonction)
    {
        $this->LibelleFonction = $LibelleFonction;
        return $this;
    }

    /**
     * Get LibelleFonction
     *
     * @return string
     */
    public function getLibelleFonction()
    {
        return $this->LibelleFonction;
    }

    /**
     * Get $isProf
     *
     * @return  bool
     */
    public function getIsProf()
    {
        return $this->isProf;
    }

    /**
     * Set $isProf
     *
     * @param  bool  $isProf
     *
     * @return  self
     */
    public function setIsProf(bool $isProf)
    {
        $this->isProf = $isProf;

        return $this;
    }
}
