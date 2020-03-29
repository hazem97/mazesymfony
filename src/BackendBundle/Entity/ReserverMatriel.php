<?php

namespace BackendBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReserverMatriel
 * @ORM\Table(name="ReserverMatriel")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\ReserverMatrielRepository")
 */
class ReserverMatriel
{
    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\MatrielMag", inversedBy="matriels")
     * @ORM\JoinColumn(name="matriel_id", referencedColumnName="idm")
     */
    private $matriel;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Staff", inversedBy="matriels")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="id_staff")
     */
    private $staff;


    /**
     * @var reserved_at
     *
     * @ORM\Column(name="Date_res", type="datetime")
     */
    private $reserved_at;

    /**
     * @var recupered_at
     *
     * @ORM\Column(name="Date_ret", type="datetime")
     */
    private $recupered_at;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * @param mixed $staff
     */
    public function setStaff($staff)
    {
        $this->staff = $staff;
    }


    /**
     * @return mixed
     */
    public function getMatriel()
    {
        return $this->matriel;
    }

    /**
     * @param mixed $matriel
     */
    public function setMatriel($matriel)
    {
        $this->matriel = $matriel;
    }

    /**
     * @return mixed
     */
    public function getReservedAt()
    {
        return $this->reserved_at;
    }

    /**
     * @param mixed $reserved_at
     */
    public function setReservedAt($reserved_at)
    {
        $this->reserved_at =$reserved_at;
    }

    /**
     * @return mixed
     */
    public function getRecuperedAt()
    {
        return $this->recupered_at;
    }

    /**
     * @param mixed $recupered_at
     */
    public function setRecuperedAt($recupered_at)
    {
        $this->recupered_at = $recupered_at;
    }
}

