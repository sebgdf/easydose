<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nrd
 *
 * @ORM\Table(name="nrd")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NrdRepository")
 */
class Nrd
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float")
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="bodypart", type="string", length=255)
     */
    private $bodypart;

    
    
    /**
     * @var string
     *
     * @ORM\Column(name="protocole", type="string", length=255)
     */
    private $protocole;
    
    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=255)
     */
    private $age;

    
    /**
     * @var string
     *
     * @ORM\Column(name="orientation", type="string", length=255)
     */
    private $orientation;
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;


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
     * Set type
     *
     * @param string $type
     *
     * @return Nrd
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set poids
     *
     * @param float $poids
     *
     * @return Nrd
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return float
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set bodypart
     *
     * @param string $bodypart
     *
     * @return Nrd
     */
    public function setBodypart($bodypart)
    {
        $this->bodypart = $bodypart;

        return $this;
    }

    /**
     * Get bodypart
     *
     * @return string
     */
    public function getBodypart()
    {
        return $this->bodypart;
    }

    /**
     * Set valeur
     *
     * @param float $valeur
     *
     * @return Nrd
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
}

