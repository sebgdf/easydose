<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 * 
 */
class Categorie
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
    private $codeCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_categorie", type="string", length=255)
     */
    private $nomCategorie;

       /**
     * @var string
     *
     * @ORM\Column(name="couleur_categorie", type="string", length=255)
     */
    private $couleurCategorie;

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

	public function __toString() : string
    {
        return (string) $this->nomCategorie;
    }
	/**
	 * 
	 * @return string
	 */
	public function getCodeCategorie() {
		return $this->codeCategorie;
	}
	
	/**
	 * 
	 * @param string $codeCategorie 
	 * @return self
	 */
	public function setCodeCategorie($codeCategorie): self {
		$this->codeCategorie = $codeCategorie;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getNomCategorie() {
		return $this->nomCategorie;
	}
	
	/**
	 * 
	 * @param string $nomCategorie 
	 * @return self
	 */
	public function setNomCategorie($nomCategorie): self {
		$this->nomCategorie = $nomCategorie;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getCouleurCategorie() {
		return $this->couleurCategorie;
	}
	
	/**
	 * 
	 * @param string $couleurCategorie 
	 * @return self
	 */
	public function setCouleurCategorie($couleurCategorie): self {
		$this->couleurCategorie = $couleurCategorie;
		return $this;
	}
}

