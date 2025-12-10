<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="souscategorie")
 * @ORM\Entity()
 * 
 */
class Souscategorie
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
     * @ORM\Column(name="code_categorie", type="string", length=255)
     */
    private $codeSouscategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_categorie", type="string", length=255)
     */
    private $nomSouscategorie;

       /**
     * @var string
     *
     * @ORM\Column(name="couleur_categorie", type="string", length=255)
     */
    private $couleurSouscategorie;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", nullable=true)
     * */
    private $categorie;

	public function __toString() : string
    {
        return (string) $this->nomSouscategorie;
    }

	/**
	 * 
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * 
	 * @param int $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getCodeSouscategorie() {
		return $this->codeSouscategorie;
	}
	
	/**
	 * 
	 * @param string $codeSouscategorie 
	 * @return self
	 */
	public function setCodeSouscategorie($codeSouscategorie): self {
		$this->codeSouscategorie = $codeSouscategorie;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getNomSouscategorie() {
		return $this->nomSouscategorie;
	}
	
	/**
	 * 
	 * @param string $nomSouscategorie 
	 * @return self
	 */
	public function setNomSouscategorie($nomSouscategorie): self {
		$this->nomSouscategorie = $nomSouscategorie;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getCouleurSouscategorie() {
		return $this->couleurSouscategorie;
	}
	
	/**
	 * 
	 * @param string $couleurSouscategorie 
	 * @return self
	 */
	public function setCouleurSouscategorie($couleurSouscategorie): self {
		$this->couleurSouscategorie = $couleurSouscategorie;
		return $this;
	}


	/**
	 * 
	 * @return mixed
	 */
	public function getCategorie() {
		return $this->categorie;
	}
	
	/**
	 * 
	 * @param mixed $categorie 
	 * @return self
	 */
	public function setCategorie($categorie): self {
		$this->categorie = $categorie;
		return $this;
	}
}

