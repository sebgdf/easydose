<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissementei")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtablissementRepository")
 */
class EtablissementEi
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=512)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="batiment", type="string", length=512)
     */
    private $batiment;

	public function __toString() : string
    {
        return (string) $this->nom;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Etablissement
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Etablissement
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set batiment
     *
     * @param string $batiment
     *
     * @return EtablissementEi
     */
    public function setBatiment($batiment)
    {
        $this->batiment = $batiment;

        return $this;
    }

    /**
     * Get addrlogo
     *
     * @return string
     */
    public function getBatiment()
    {
        return $this->batiment;
    }
}

