<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtablissementRepository")
 */
#[ORM\Entity]
#[ORM\Table(name:"etablissement")]
class Etablissement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    #[ORM\Column(name:"nom", type:"string", length:255)]
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=512)
     */
    #[ORM\Column(name:"adresse", type:"string", length:512)]
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="addrlogo", type="string", length=512)
     */
    #[ORM\Column(name:"addrlogo", type:"string", length:512)]
    private $addrlogo;


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
     * Set addrlogo
     *
     * @param string $addrlogo
     *
     * @return Etablissement
     */
    public function setAddrlogo($addrlogo)
    {
        $this->addrlogo = $addrlogo;

        return $this;
    }

    /**
     * Get addrlogo
     *
     * @return string
     */
    public function getAddrlogo()
    {
        return $this->addrlogo;
    }
}

