<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pyramideage
 *
 * @ORM\Table(name="pyramideage")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PyramideageRepository")
 */
class Pyramideage
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
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="tranche_age", type="string", length=255)
     */
    private $trancheAge;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre", type="integer")
     */
    private $nombre;


    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;
    
    
    /**
     * @return number
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param number $ordre
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
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
     * Set genre
     *
     * @param string $genre
     *
     * @return Pyramideage
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set trancheAge
     *
     * @param string $trancheAge
     *
     * @return Pyramideage
     */
    public function setTrancheAge($trancheAge)
    {
        $this->trancheAge = $trancheAge;

        return $this;
    }

    /**
     * Get trancheAge
     *
     * @return string
     */
    public function getTrancheAge()
    {
        return $this->trancheAge;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     *
     * @return Pyramideage
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return int
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}

