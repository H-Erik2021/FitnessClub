<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Entity\CasierRepository")
 * @ORM\Table(name="casier")
 */
class Casier
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="IdCasier", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $dureeResaCasiers
     *
     * @ORM\Column(name="DureeResaCasiers", type="integer")
     */
    private $dureeResaCasiers;

    
    /**
     * @var integer $tarifCasiers
     *
     * @ORM\Column(name="TarifCasiers", type="integer")
     */
    private $tarifCasiers;


    /**
     * Constructor
     */
    public function __construct(int $dureeResaCasiers, int $tarifCasiers )
    {
        $this->dureeResaCasiers = $dureeResaCasiers;
        $this->tarifCasiers = $tarifCasiers;         
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
     * Get $tarifCasiers
     *
     * @return  integer
     */
    public function getTarifCasiers()
    {
        return $this->tarifCasiers;
    }

    /**
     * Set $tarifCasiers
     *
     * @param  integer  $tarifCasiers
     *
     * @return  self
     */
    public function setTarifCasiers($tarifCasiers)
    {
        $this->tarifCasiers = $tarifCasiers;

        return $this;
    }

    /**
     * Get $dureeResaCasiers
     *
     * @return  integer
     */
    public function getDureeResaCasiers()
    {
        return $this->dureeResaCasiers;
    }

    /**
     * Set $dureeResaCasiers
     *
     * @param  integer  $dureeResaCasiers
     *
     * @return  self
     */
    public function setDureeResaCasiers($dureeResaCasiers)
    {
        $this->dureeResaCasiers = $dureeResaCasiers;

        return $this;
    }
}
