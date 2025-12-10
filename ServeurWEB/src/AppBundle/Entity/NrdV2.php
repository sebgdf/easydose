<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NrdV2
 *
 * @ORM\Table(name="nrd_v2")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NrdV2Repository")
 */
class NrdV2
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
     * @ORM\Column(name="poids", type="float",nullable=true)
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
     * @ORM\Column(name="age", type="string", length=255)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="orientation", type="string", length=255 ,nullable=true)
     */
    private $orientation;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="protocole", type="string", length=255)
     */
    private $protocole;


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
     * @return NrdV2
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
     * @return NrdV2
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
     * @return NrdV2
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
     * Set age
     *
     * @param integer $age
     *
     * @return NrdV2
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set orientation
     *
     * @param string $orientation
     *
     * @return NrdV2
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Get orientation
     *
     * @return string
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Set valeur
     *
     * @param float $valeur
     *
     * @return NrdV2
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
     * Set protocole
     *
     * @param string $protocole
     *
     * @return NrdV2
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
}

