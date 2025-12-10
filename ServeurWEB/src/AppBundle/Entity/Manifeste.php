<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Manifeste
 *
 * @ORM\Table(name="manifeste")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ManifesteRepository")
 */
class Manifeste
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
     * @ORM\Column(name="etablissement", type="string", length=255)
     */
    private $etablissement;



    /**
     * @var string
     *
     * @ORM\Column(name="ippetablissementpatient", type="string", length=255)
     */
    private $ippetablissementpatient;
     
    /**
     * @var string
     *
     * @ORM\Column(name="numtransaction", type="string", length=255)
     */
    private $numtransaction;

	/**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetransmission", type="datetime")
     */
    public $datetransmission;

    /**
     * @var boolean
     *
     * @ORM\Column(name="transmissionok", type="boolean")
     */
    private $transmissionok;

	/**
	 * 
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
     * @var int
     *
     * @ORM\Column(name="idexamensource", type="integer")
     */
    private $idexamensource;

	    /**
     * @var int
     *
     * @ORM\Column(name="idexamencible", type="integer")
     */
    private $idexamencible;

	
		/**
     * @var int
     *
     * @ORM\Column(name="idpatientsource", type="integer")
     */
    private $idpatientsource;

	    /**
     * @var int
     *
     * @ORM\Column(name="idpatientcible", type="integer")
     */
    private $idpatientcible;

	/**
	 * 
	 * @return string
	 */
	public function getEtablissement() {
		return $this->etablissement;
	}
	
	/**
	 * 
	 * @param string $etablissement 
	 * @return self
	 */
	public function setEtablissement($etablissement): self {
		$this->etablissement = $etablissement;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getIppetablissementpatient() {
		return $this->ippetablissementpatient;
	}
	
	/**
	 * 
	 * @param string $ippetablissementpatient 
	 * @return self
	 */
	public function setIppetablissementpatient($ippetablissementpatient): self {
		$this->ippetablissementpatient = $ippetablissementpatient;
		return $this;
	}

	/**
	 * 
	 * @return boolean
	 */
	public function getTransmissionok() {
		return $this->transmissionok;
	}
	
	/**
	 * 
	 * @param boolean $transmissionok 
	 * @return self
	 */
	public function setTransmissionok($transmissionok): self {
		$this->transmissionok = $transmissionok;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getNumtransaction() {
		return $this->numtransaction;
	}
	
	/**
	 * 
	 * @param string $numtransaction 
	 * @return self
	 */
	public function setNumtransaction($numtransaction): self {
		$this->numtransaction = $numtransaction;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 * 
	 * @param string $status 
	 * @return self
	 */
	public function setStatus($status): self {
		$this->status = $status;
		return $this;
	}

	/**
	 * 
	 * @return int
	 */
	public function getIdexamencible() {
		return $this->idexamencible;
	}
	
	/**
	 * 
	 * @param int $idexamencible 
	 * @return self
	 */
	public function setIdexamencible($idexamencible): self {
		$this->idexamencible = $idexamencible;
		return $this;
	}

	/**
	 * 
	 * @return int
	 */
	public function getIdexamensource() {
		return $this->idexamensource;
	}
	
	/**
	 * 
	 * @param int $idexamensource 
	 * @return self
	 */
	public function setIdexamensource($idexamensource): self {
		$this->idexamensource = $idexamensource;
		return $this;
	}

	/**
	 * 
	 * @return int
	 */
	public function getIdpatientsource() {
		return $this->idpatientsource;
	}
	
	/**
	 * 
	 * @param int $idpatientsource 
	 * @return self
	 */
	public function setIdpatientsource($idpatientsource): self {
		$this->idpatientsource = $idpatientsource;
		return $this;
	}

	/**
	 * 
	 * @return int
	 */
	public function getIdpatientcible() {
		return $this->idpatientcible;
	}
	
	/**
	 * 
	 * @param int $idpatientcible 
	 * @return self
	 */
	public function setIdpatientcible($idpatientcible): self {
		$this->idpatientcible = $idpatientcible;
		return $this;
	}
}