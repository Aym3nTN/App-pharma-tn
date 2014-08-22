<?php

namespace Aym3ntn\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Aym3ntn\UserBundle\Entity\UserNoteRepository")
 * @ORM\Table(name="user_note")
 */
class UserNote {
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Aym3ntn\UserBundle\Entity\Note")
     */
    private $note;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Aym3ntn\UserBundle\Entity\User")
     */
    private $user;

    /**
     * @var boolean
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @param mixed $note
     */
    public function setNote(Note $note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
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
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

} 