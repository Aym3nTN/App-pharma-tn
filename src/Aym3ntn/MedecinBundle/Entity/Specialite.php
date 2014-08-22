<?php

namespace Aym3ntn\MedecinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Aym3ntn\MedecinBundle\Entity\SpecialiteRepository")
 */
class Specialite
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
     * @ORM\Column(name="etiquette", type="string", length=255)
     */
    private $etiquette;


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
     * @return Specialite
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
