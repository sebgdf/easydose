<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conversion
 *
 * @ORM\Table(name="conversion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConversionRepository")
 */
class Conversion
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
     * @ORM\Column(name="unitesource", type="string", length=255)
     */
    private $unitesource;

    /**
     * @var string
     *
     * @ORM\Column(name="unitecible", type="string", length=255)
     */
    private $unitecible;

    /**
     * @var float
     *
     * @ORM\Column(name="facteur", type="float")
     */
    private $facteur;


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
     * Set unitesource
     *
     * @param string $unitesource
     *
     * @return Conversion
     */
    public function setUnitesource($unitesource)
    {
        $this->unitesource = $unitesource;

        return $this;
    }

    /**
     * Get unitesource
     *
     * @return string
     */
    public function getUnitesource()
    {
        return $this->unitesource;
    }

    /**
     * Set unitecible
     *
     * @param string $unitecible
     *
     * @return Conversion
     */
    public function setUnitecible($unitecible)
    {
        $this->unitecible = $unitecible;

        return $this;
    }

    /**
     * Get unitecible
     *
     * @return string
     */
    public function getUnitecible()
    {
        return $this->unitecible;
    }

    /**
     * Set facteur
     *
     * @param integer $facteur
     *
     * @return Conversion
     */
    public function setFacteur($facteur)
    {
        $this->facteur = $facteur;

        return $this;
    }

    /**
     * Get facteur
     *
     * @return int
     */
    public function getFacteur()
    {
        return $this->facteur;
    }
}

