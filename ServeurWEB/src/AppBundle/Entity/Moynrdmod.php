<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moynrdmod
 *
 * @ORM\Table(name="moynrdmod")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MoynrdmodRepository")
 */
class Moynrdmod
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
     * @ORM\Column(name="modalite", type="string", length=255)
     */
    private $modalite;

    
    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;
    
    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;


    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * Set modalite
     *
     * @param string $modalite
     *
     * @return Moynrdmod
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

    /**
     * Set valeur
     *
     * @param float $valeur
     *
     * @return Moynrdmod
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

