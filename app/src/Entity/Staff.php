<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Entity\StaffRepository")
 * @ORM\Table(name="personnel")
 */
class Staff
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="NumPerso", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $NomPerso
     *
     * @ORM\Column(type="string", length=80)
     */
    private $NomPerso;

     /**
     * @var string $PrenomPerso
     *
     * @ORM\Column(type="string", length=80)
     */
    private $PrenomPerso;

    /**
     * @var string $AdressePerso
     *
     * @ORM\Column(type="string", length=200)
     */
    private $AdressePerso;

    /**
     * @var string $TelPerso
     *
     * @ORM\Column(type="string", length=25)
     */
    private $TelPerso;

    /**
     * @var string $MailPerso
     *
     * @ORM\Column(type="string", length=120)
     */
    private $MailPerso;

    /**
     * @var string $Password
     *
     * @ORM\Column(type="string", length=30)
     */
    private $Password;

   /**
     * @var integer $Fonction
     * @ORM\ManyToOne(targetEntity="App\Entity\Fonction", cascade={"persist"})
     * @ORM\JoinColumn(name="IdFonction", referencedColumnName="IdFonction", nullable=true)
     */
    private $Fonction;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * Constructor
     */
    public function __construct(string $nom, string $prenom, string $adresse, string $telephone, string $couriel, string $Password, $fonction)
    {
        $this->created_at = new \DateTime();
        $this->NomPerso = $nom;
        $this->PrenomPerso = $prenom;
        $this->AdressePerso = $adresse;
        $this->TelPerso = $telephone;
        $this->MailPerso = $couriel;
        $this->Password = $Password;
        if ($fonction != NULL)
            $this->Fonction = $fonction;
        
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
     * Set NomPerso
     *
     * @param string $NomPerso
     *
     * @return Staff
     */
    public function setNomPerso($NomPerso)
    {
        $this->NomPerso = $NomPerso;
        return $this;
    }

    /**
     * Get NomPerso
     *
     * @return string
     */
    public function getNomPerso()
    {
        return $this->NomPerso;
    }

     /**
     * Set PrenomPerso
     *
     * @param string $PrenomPerso
     *
     * @return Staff
     */
    public function setPrenomPerso($PrenomPerso)
    {
        $this->PrenomPerso = $PrenomPerso;
        return $this;
    }

    /**
     * Get PrenomPerso
     *
     * @return string
     */
    public function getPrenomPerso()
    {
        return $this->PrenomPerso;
    }

       /**
     * Set AdressePerso
     *
     * @param string $AdressePerso
     *
     * @return Staff
     */
    public function setAdressePerso($AdressePerso)
    {
        $this->AdressePerso = $AdressePerso;
        return $this;
    }

    /**
     * Get AdressePerso
     *
     * @return string
     */
    public function getAdressePerso()
    {
        return $this->AdressePerso;
    }

    /**
     * Set TelPerso
     *
     * @param string $TelPerso
     *
     */
    public function setTelPerso($TelPerso)
    {
        $this->TelPerso = $TelPerso;
        return $this;
    }

    /**
     * Get TelPerso
     *
     * @return string
     */
    public function getTelPerso()
    {
        return $this->TelPerso;
    }

    /**
     * Set MailPerso
     *
     * @param string $MailPerso
     *
     */
    public function setMailPerso($MailPerso)
    {
        $this->MailPerso = $MailPerso;
        return $this;
    }

    /**
     * Get MailPerso
     *
     * @return string
     */
    public function getMailPerso()
    {
        return $this->MailPerso;
    }

     /**
     * Set Password
     *
     * @param string $Password
     *
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
        return $this;
    }

    /**
     * Get Password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $created_at
     *
     * @return Staff
     */
    public function setcreated_at(\DateTime $created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getcreated_at()
    {
        return $this->created_at;
    }

    /**
    * Get Fonction
    *
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getFonction()
    {
        return $this->Fonction;
    }

    /**
     * Set Fonction
     *
     * @param \App\Entity\Fonction $Fonction
     *
     * @return Staff
     */
    public function setFonction(\App\Entity\Fonction $Fonction = null)
    {
        $this->Fonction = $Fonction;
        return $this;
    }
    
}
