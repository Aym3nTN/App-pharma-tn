<?php

namespace Aym3ntn\UserBundle\Entity;

use Aym3ntn\MedecinBundle\Entity\Secteur;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $prenom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $date_naissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $sexe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * @ORM\OneToMany(targetEntity="Aym3ntn\MedecinBundle\Entity\Secteur", mappedBy="id")
     */
    protected $secteurs;

    public function __construct()
    {
        parent::__construct();
        $this->secteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addSecteur(Secteur $secteur)
    {
        $this->secteurs[] = $secteur;
        return $this;
    }

    public function removeSecteur(Secteur $secteur)
    {
        $this->secteurs->removeElement($secteur);
    }

    public function getSecteurs()
    {
        return $this->secteurs;
    }

    /**
     * @param mixed $date_naissance
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    function __toString()
    {
        return $this->getNom().' '.$this->getPrenom();
    }

}