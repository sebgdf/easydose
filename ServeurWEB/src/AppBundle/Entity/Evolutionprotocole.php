<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evolutionprotocole
 *
 * @ORM\Table(name="evolutionprotocole")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvolutionprotocoleRepository")
 */
class Evolutionprotocole
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
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    
    /**
     * @var string
     *
     * @ORM\Column(name="protocole", type="string", length=255)
     */
    private $protocole;
    

    /**
     * @var int
     *
     * @ORM\Column(name="cnt", type="integer")
     */
    private $cnt;


    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getProtocole()
    {
        return $this->protocole;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $protocole
     */
    public function setProtocole($protocole)
    {
        $this->protocole = $protocole;
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
     * Set date
     *
     * @param string $date
     *
     * @return Evolutionprotocole
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set cnt
     *
     * @param integer $cnt
     *
     * @return Evolutionprotocole
     */
    public function setCnt($cnt)
    {
        $this->cnt = $cnt;

        return $this;
    }

    /**
     * Get cnt
     *
     * @return int
     */
    public function getCnt()
    {
        return $this->cnt;
    }
}

