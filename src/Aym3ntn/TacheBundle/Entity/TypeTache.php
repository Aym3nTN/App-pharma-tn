<?php

namespace Aym3ntn\TacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeTache
 *
 * @ORM\Table(name="type_tache")
 * @ORM\Entity
 */
// @ORM\Entity(repositoryClass="Aym3ntn\TacheBundle\Entity\TypeTacheRepository")
class TypeTache
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="etiquette", type="string", length=20)
     */
    private $etiquette;

    /**
    * @ORM\OneToMany(targetEntity="Aym3ntn\TacheBundle\Entity\ssTypeTache", mappedBy="id")
    */
    private $ssTypes;

    public function __construct()
    {
        $this->ssTypes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addSsType(\Aym3ntn\TacheBundle\Entity\ssTypeTache $ssType)
    {
        $this->ssTypes[] = $ssType;
        return $this;
    }

    public function removeSsType(\Aym3ntn\TacheBundle\Entity\ssTypeTache $ssType)
    {
        $this->ssTypes->removeElement($ssType);
    }

    public function getSsTypes()
    {
        return $this->ssTypes;
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
     * Set etiquette
     *
     * @param string $etiquette
     * @return TypeTache
     */
    public function setEtiquette($etiquette)
    {
        $this->etiquette = $etiquette;

        return $this;
    }

    /**
     * Get etiquette
     *
     * @return string 
     */
    public function getEtiquette()
    {
        return $this->etiquette;
    }
}
