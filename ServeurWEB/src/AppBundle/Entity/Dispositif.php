<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dispositif
 *
 * @ORM\Table(name="dispositif")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DispositifRepository")
 */
class Dispositif
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
     * @ORM\Column(name="denomination", type="string", length=255, nullable=true)
     */
    private $denomination;

    /**
     * @var string
     *
     * @ORM\Column(name="num_salle", type="string", length=255, nullable=true)
     */
    private $numSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="num_serie", type="string", length=512, nullable=true)
     */
    private $numSerie;

    
    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=512, nullable=true)
     */
    private $marque;
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemiseenservice", type="datetime", nullable=true)
     */
    private $datemiseenservice;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    /**
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param string $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
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
     * Set denomination
     *
     * @param string $denomination
     *
     * @return Dispositif
     */
    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;

        return $this;
    }

    /**
     * Get denomination
     *
     * @return string
     */
    public function getDenomination()
    {
        return $this->denomination;
    }

    /**
     * Set numSalle
     *
     * @param string $numSalle
     *
     * @return Dispositif
     */
    public function setNumSalle($numSalle)
    {
        $this->numSalle = $numSalle;

        return $this;
    }

    /**
     * Get numSalle
     *
     * @return string
     */
    public function getNumSalle()
    {
        return $this->numSalle;
    }

    /**
     * Set numSerie
     *
     * @param string $numSerie
     *
     * @return Dispositif
     */
    public function setNumSerie($numSerie)
    {
        $this->numSerie = $numSerie;

        return $this;
    }

    /**
     * Get numSerie
     *
     * @return string
     */
    public function getNumSerie()
    {
        return $this->numSerie;
    }

    /**
     * Set datemiseenservice
     *
     * @param \DateTime $datemiseenservice
     *
     * @return Dispositif
     */
    public function setDatemiseenservice($datemiseenservice)
    {
        $this->datemiseenservice = $datemiseenservice;

        return $this;
    }

    /**
     * Get datemiseenservice
     *
     * @return \DateTime
     */
    public function getDatemiseenservice()
    {
        return $this->datemiseenservice;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Dispositif
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}

