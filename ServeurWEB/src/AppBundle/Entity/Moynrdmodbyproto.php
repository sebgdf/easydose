<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moynrdmodbyproto
 *
 * @ORM\Table(name="moynrdmodbyproto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MoynrdmodbyprotoRepository")
 */
class Moynrdmodbyproto
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
     * @ORM\Column(name="protocole", type="string", length=255)
     */
    private $protocole;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;
    
    /**
     * @var float
     *
     * @ORM\Column(name="nrd", type="float")
     */
    private $nrd;

    /**
     * @var string
     *
     * @ORM\Column(name="modalite", type="string", length=255)
     */
    private $modalite;


    
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    
    
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
     * @return number
     */
    public function getNrd()
    {
        return $this->nrd;
    }

    /**
     * @param number $nrd
     */
    public function setNrd($nrd)
    {
        $this->nrd = $nrd;
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
     * Set protocole
     *
     * @param string $protocole
     *
     * @return Moynrdmodbyproto
     */
    public function setProtocole($protocole)
    {
        $this->protocole = $protocole;

        return $this;
    }

    /**
     * Get protocole
     *
     * @return string
     */
    public function getProtocole()
    {
        return $this->protocole;
    }

    /**
     * Set valeur
     *
     * @param float $valeur
     *
     * @return Moynrdmodbyproto
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return float
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set modalite
     *
     * @param string $modalite
     *
     * @return Moynrdmodbyproto
     */
    public function setModalite($modalite)
    {
        $this->modalite = $modalite;

        return $this;
    }

    /**
     * Get modalite
     *
     * @return string
     */
    public function getModalite()
    {
        return $this->modalite;
    }
}

