<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    public $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    public $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="numipp", type="string", length=255)
     */
    public $numipp;

    
    /**
     * @var string
     *
     * @ORM\Column(name="uniteage", type="string", length=255)
     */
    private $uniteage;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255)
     */
    public $sex;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="idregional", type="string", length=255,nullable=true)
     */
    public $idregional;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenaissance", type="datetime")
     */
    public $datenaissance;


    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    public $age;
  
 
    /**
     * @var int
     *
     * @ORM\Column(name="nbdoses", type="integer")
     */
    private $nbdoses;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="nrdhavealerte", type="boolean")
     */
    private $nrdhavealerte;
    

    /**
     * @var boolean
     *
     * @ORM\Column(name="sumhavealerte", type="boolean")
     */
    private $sumhavealerte;
 
    /**
     * @var boolean
     *
     * @ORM\Column(name="havenotes", type="boolean")
     */
    private $havenotes;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examen",mappedBy="patient",cascade={"persist", "remove"})
     */
    protected $examen;

    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Note",mappedBy="patient",cascade={"persist", "remove"})
     */
    protected $note;

    /**
     * @var boolean
     *
     * @ORM\Column(name="havemammo", type="boolean")
     */
    private $havemammo;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="haveradio", type="boolean")
     */
    private $haveradio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="havescanner", type="boolean")
     */
    private $havescanner;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datelastexam", type="datetime", nullable=true)
     */
    private $datelastexam;


    public function __toString(){
        return "Patient: ".$this->id." ".$this->getNom()." ".$this->prenom." , age: ".$this->age.", IPP :".$this->numipp.", id regional: ".$this->idregional.' '.$this->sex;
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
     * @return Patient
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Patient
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set numipp
     *
     * @param string $numipp
     *
     * @return Patient
     */
    public function setNumipp($numipp)
    {
        $this->numipp = $numipp;

        return $this;
    }

    /**
     * Get numipp
     *
     * @return string
     */
    public function getNumipp()
    {
        return $this->numipp;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     *
     * @return Patient
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }
	public function getExamen() {
		return $this->examen;
	}
	public function setExamen($examen) {
		$this->examen = $examen;
		return $this;
	}
	public function getSex() {
		return $this->sex;
	}
	public function setSex($sex) {
		$this->sex = $sex;
		return $this;
	}
	public function getIdregional() {
		return $this->idregional;
	}
	public function setIdregional($idregional) {
		$this->idregional = $idregional;
		return $this;
	}
	public function getAge() {
		return $this->age;
	}
	public function setAge($age) {
		$this->age = $age;
		return $this;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getNrdhavealerte() {
		return $this->nrdhavealerte;
	}
	public function setNrdhavealerte($nrdhavealerte) {
		$this->nrdhavealerte = $nrdhavealerte;
		return $this;
	}
	public function getSumhavealerte() {
		return $this->sumhavealerte;
	}
	public function setSumhavealerte($sumhavealerte) {
		$this->sumhavealerte = $sumhavealerte;
		return $this;
	}
	public function getHavenotes() {
		return $this->havenotes;
	}
	public function setHavenotes($havenotes) {
		$this->havenotes = $havenotes;
		return $this;
	}
	public function getNbdoses() {
		return $this->nbdoses;
	}
	public function setNbdoses($nbdoses) {
		$this->nbdoses = $nbdoses;
		return $this;
	}


	/**
	 * 
	 * @return boolean
	 */
	public function getHavescanner() {
		return $this->havescanner;
	}
	
	/**
	 * 
	 * @param boolean $havescanner 
	 * @return self
	 */
	public function setHavescanner($havescanner): self {
		$this->havescanner = $havescanner;
		return $this;
	}

	/**
	 * 
	 * @return boolean
	 */
	public function getHaveradio() {
		return $this->haveradio;
	}
	
	/**
	 * 
	 * @param boolean $haveradio 
	 * @return self
	 */
	public function setHaveradio($haveradio): self {
		$this->haveradio = $haveradio;
		return $this;
	}
}

