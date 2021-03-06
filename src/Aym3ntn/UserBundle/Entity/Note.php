<?php

namespace Aym3ntn\UserBundle\Entity;

use Aym3ntn\MedecinBundle\Entity\Secteur;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="Aym3ntn\UserBundle\Entity\NoteRepository")
 */
class Note
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
     * @var integer
     *
     * @ORM\Column(name="public", type="integer")
     */
    private $public;

    /**
     * @var string
     *
     * @ORM\Column(name="descr", type="text")
     */
    private $descr;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Aym3ntn\UserBundle\Entity\User")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="related_to", type="string", length=255, nullable=true)
     */
    private $relatedTo;

    /**
     * @var Datetime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    //$public = 1, $descr = '',  $secteur = null, $relatedTo = '', $type = '', $userId = '', $isDone = true)

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
     * Set public
     *
     * @param integer $public
     * @return Note
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return integer 
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set descr
     *
     * @param string $descr
     * @return Note
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $relatedTo
     */
    public function setRelatedTo($relatedTo)
    {
        $this->relatedTo = $relatedTo;
    }

    /**
     * @return string
     */
    public function getRelatedTo()
    {
        return $this->relatedTo;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}
