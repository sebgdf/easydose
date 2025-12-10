<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatProtocoles
 *
 * @ORM\Table(name="stat_protocoles")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatProtocolesRepository")
 */
class StatProtocoles
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
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;
    
    /**
     * @var int
     *
     * @ORM\Column(name="nbbodypart", type="integer")
     */
    private $nbbodypart;

    /**
     * @var string
     *
     * @ORM\Column(name="protocole", type="string", length=512)
     */
    private $protocole;

    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=255)
     */
    private $unite;

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
    public function getNbbodypart()
    {
        return $this->nbbodypart;
    }

    /**
     * @param number $nbbodypart
     */
    public function setNbbodypart($nbbodypart)
    {
        $this->nbbodypart = $nbbodypart;
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
     * Set valeur
     *
     * @param float $valeur
     *
     * @return StatProtocoles
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
     * @return StatProtocoles
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
     * Set unite
     *
     * @param string $unite
     *
     * @return StatProtocoles
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * Get unite
     *
     * @return string
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Set modalite
     *
     * @param string $modalite
     *
     * @return StatProtocoles
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

