<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fichierdcm
 *
 * @ORM\Table(name="fichierdcm")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FichierdcmRepository")
 */
class Fichierdcm
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=512, nullable=true)
     */
    private $contenu;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="traceback", type="string", length=1024 , nullable=true)
     */
    private $traceback;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;


    /**
     * @return string
     */
    public function getTraceback()
    {
        return $this->traceback;
    }

    /**
     * @param string $traceback
     */
    public function setTraceback($traceback)
    {
        $this->traceback = $traceback;
    }

    /**
     * @return boolean
     */
    public function isReplay()
    {
        return $this->replay;
    }

    /**
     * @return boolean
     */
    public function isReplayed()
    {
        return $this->replayed;
    }

    /**
     * @return number
     */
    public function getOut()
    {
        return $this->out;
    }

    /**
     * @param boolean $replay
     */
    public function setReplay($replay)
    {
        $this->replay = $replay;
    }

    /**
     * @param boolean $replayed
     */
    public function setReplayed($replayed)
    {
        $this->replayed = $replayed;
    }

    /**
     * @param number $out
     */
    public function setOut($out)
    {
        $this->out = $out;
    }

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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Fichierdcm
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    
    /**
     * @var boolean
     *
     * @ORM\Column(name="replay", type="boolean")
     */
    private $replay;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="replayed", type="boolean")
     */
    private $replayed;
    
    /**
     * @var int
     *
     * @ORM\Column(name="result", type="integer")
     */
    private $out;
    
    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Fichierdcm
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
}

