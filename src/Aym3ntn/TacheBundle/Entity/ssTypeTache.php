<?php

namespace Aym3ntn\TacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ssTypeTache
 *
 * @ORM\Table(name="ssTypeTache")
 * @ORM\Entity
 */
class ssTypeTache
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
     * @ORM\ManyToOne(targetEntity="Aym3ntn\TacheBundle\Entity\TypeTache", inversedBy="id")
     */
    private $type;

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
     * @return ssTypeTache
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

    /**
     * @return TypeTache
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param TypeTache $type
     */
    public function setType(TypeTache $type)
    {
        $this->type = $type;
    }
}
