<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Staff
 *
 * @ORM\Table(name="staff")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\StaffRepository")
 */
class Staff
{

    /**
     * @var int
     *
     * @ORM\Column(name="id_staff", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var float
     *
     * @ORM\Column(name="salary", type="float")
     */
    private $salary;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string", length=255)
     */
    private $post;

    /**
     * @var string
     *
     * @ORM\Column(name="rib", type="string", length=27)
     */
    private $rib;

    /**
     * @var float
     *
     * @ORM\Column(name="prime", type="float")
     */
    private $prime;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer",length=11)
     */
    private $statut;

    /**
     * @var Date_deb
     *
     * @ORM\Column(name="Date_deb_trav", type="date")
     */
    private $Date_deb;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_conj", type="integer",length=11)
     */
    private $nb_conj;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_heur", type="integer",length=11)
     */
    private $nb_heur;

    /**
     * @var int
     *
     * @ORM\Column(name="Phone", type="integer", length=8)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=20)
     */
    private $reference;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Staff
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Staff
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Staff
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return float
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param float $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param string $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * @param string $rib
     */
    public function setRib($rib)
    {
        $this->rib = $rib;
    }

    /**
     * @return float
     */
    public function getPrime()
    {
        return $this->prime;
    }

    /**
     * @param float $prime
     */
    public function setPrime($prime)
    {
        $this->prime = $prime;
    }

    /**
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param int $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return date
     */
    public function getDatedeb()
    {
        return $this->Date_deb;
    }

    /**
     * @param date $date
     */
    public function setDatedeb($date)
    {
        $this->Date_deb = $date;
    }

    /**
     * @return int
     */
    public function getNbConj()
    {
        return $this->nb_conj;
    }

    /**
     * @param int $nb_conj
     */
    public function setNbConj($nb_conj)
    {
        $this->nb_conj = $nb_conj;
    }

    /**
     * @return int
     */
    public function getNbHeur()
    {
        return $this->nb_heur;
    }

    /**
     * @param int $nb_heur
     */
    public function setNbHeur($nb_heur)
    {
        $this->nb_heur = $nb_heur;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }


}

