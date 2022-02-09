<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Entity\UserRepository")
 * @ORM\Table(name="client")
 */
class User
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="NumClient", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $NomClient
     *
     * @ORM\Column(type="string", length=80)
     */
    private $NomClient;

     /**
     * @var string $PrenomClient
     *
     * @ORM\Column(type="string", length=80)
     */
    private $PrenomClient;

    /**
     * @var string $AdresseClient
     *
     * @ORM\Column(type="string", length=200)
     */
    private $AdresseClient;

    /**
     * @var string $TelClient
     *
     * @ORM\Column(type="string", length=25)
     */
    private $TelClient;

    /**
     * @var string $MailClient
     *
     * @ORM\Column(type="string", length=120)
     */
    private $MailClient;

    /**
     * @var string $Login
     *
     * @ORM\Column(type="string", length=25)
     */
    private $Login;

     /**
     * @var string $Password
     *
     * @ORM\Column(type="string", length=30)
     */
    private $Password;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adhesion", mappedBy="client")
     */
    private $adhesions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="client")
     */
    private $reservations;

    /**
     * Constructor
     */
    public function __construct(string $nom, string $prenom, string $adresse, string $telephone, string $couriel, string $login, string $password)
    {
        $this->created_at = new \DateTime();
        $this->NomClient = $nom;
        $this->PrenomClient = $prenom;
        $this->AdresseClient = $adresse;
        $this->TelClient = $telephone;
        $this->MailClient = $couriel;
        $this->Login = $login;
        $this->Password = $password;
        
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
     * Set NomClient
     *
     * @param string $NomClient
     *
     * @return User
     */
    public function setNomClient($NomClient)
    {
        $this->NomClient = $NomClient;
        return $this;
    }

    /**
     * Get NomClient
     *
     * @return string
     */
    public function getNomClient()
    {
        return $this->NomClient;
    }

     /**
     * Set PrenomClient
     *
     * @param string $PrenomClient
     *
     * @return User
     */
    public function setPrenomClient($PrenomClient)
    {
        $this->PrenomClient = $PrenomClient;
        return $this;
    }

    /**
     * Get PrenomClient
     *
     * @return string
     */
    public function getPrenomClient()
    {
        return $this->PrenomClient;
    }

       /**
     * Set AdresseClient
     *
     * @param string $AdresseClient
     *
     * @return User
     */
    public function setAdresseClient($AdresseClient)
    {
        $this->AdresseClient = $AdresseClient;
        return $this;
    }

    /**
     * Get AdresseClient
     *
     * @return string
     */
    public function getAdresseClient()
    {
        return $this->AdresseClient;
    }

    /**
     * Set TelClient
     *
     * @param string $TelClient
     *
     */
    public function setTelClient($TelClient)
    {
        $this->TelClient = $TelClient;
        return $this;
    }

    /**
     * Get TelClient
     *
     * @return string
     */
    public function getTelClient()
    {
        return $this->TelClient;
    }

    /**
     * Set MailClient
     *
     * @param string $MailClient
     *
     */
    public function setMailClient($MailClient)
    {
        $this->MailClient = $MailClient;
        return $this;
    }

    /**
     * Get MailClient
     *
     * @return string
     */
    public function getMailClient()
    {
        return $this->MailClient;
    }

    /**
     * Set Login
     *
     * @param string $Login
     *
     */
    public function setLogin($Login)
    {
        $this->Login = $Login;
        return $this;
    }

    /**
     * Get Login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->Login;
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
     * @return User
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
     * Get the value of reservations
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Set the value of reservations
     *
     * @return  self
     */
    public function setReservations($reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdhesions()
    {
        return $this->adhesions;
    }

    /**
     * @param mixed $adhesions
     * @return  self
     */
    public function setAdhesions($adhesions)
    {
        $this->adhesions = $adhesions;

        return $this;
    }
}
