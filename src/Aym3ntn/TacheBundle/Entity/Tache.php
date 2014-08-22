<?php

namespace Aym3ntn\TacheBundle\Entity;

use Aym3ntn\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @ORM\Table(name="tache")
 * @ORM\Entity(repositoryClass="Aym3ntn\TacheBundle\Entity\TacheRepository")
 */
class Tache
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="descr", type="text")
     */
    private $descr;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status; // en attente = 1, validé par superviseur = 2, validé par le chef du produit = 3, OK = 0

    /**
     * @ORM\ManyToOne(targetEntity="Aym3ntn\UserBundle\Entity\User")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="Aym3ntn\TacheBundle\Entity\LieuTache")
     */
    private $lieu;

    /**
     * @ORM\ManyToOne(targetEntity="Aym3ntn\TacheBundle\Entity\TypeTache")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Aym3ntn\TacheBundle\Entity\ssTypeTache")
     */
    private $ssType;

    /**
     * @ORM\ManyToMany(targetEntity="Aym3ntn\MedecinBundle\Entity\Medecin")
     * @ORM\JoinTable(name="medecin_tache",
     *      joinColumns={@ORM\JoinColumn(name="tache_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="medecin_id", referencedColumnName="id")}
     *      )
     */
    protected $medecins;

    public function __construct()
    {
        $this->medecins = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addMedecin(\Aym3ntn\MedecinBundle\Entity\Medecin $medecin)
    {
        $this->medecins[] = $medecin;
        return $this;
    }

    public function removeMedecin(\Aym3ntn\MedecinBundle\Entity\Medecin $medecin)
    {
        $this->medecins->removeElement($medecin);
    }

    public function getMedecins()
    {
        return $this->medecins;
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
     * Set date
     *
     * @param \DateTime $date
     * @return Tache
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set descr
     *
     * @param string $descr
     * @return Tache
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * Get descr
     *
     * @return string 
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param LieuTache $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return ssTypeTache
     */
    public function getSsType()
    {
        return $this->ssType;
    }

    /**
     * @param ssTypeTache $ssType
     */
    public function setSsType(ssTypeTache $ssType)
    {
        $this->ssType = $ssType;
    }
}
