<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * detail_dose
 *
 * @ORM\Table(name="detail_dose")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\detail_doseRepository")
 */
class detail_dose
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
     * @ORM\Column(name="kvp", type="float")
     */
    private $kvp;

    /**
     * @var string
     *
     * @ORM\Column(name="modalite", type="string", length=255)
     */
    private $modalite;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="trancheage", type="string", length=255, nullable=true)
     */
    private $trancheage;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    

    /**
     * @var string
     *
     * @ORM\Column(name="machine", type="string", length=255)
     */
    private $machine;
    
    /**
     * @var float
     *
     * @ORM\Column(name="temps_exposition", type="float")
     */
    private $tempsExposition;
    
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="uniteseuil", type="string", length=255)
     */
    private $uniteseuil;
    
    /**
     * @var float
     *
     * @ORM\Column(name="nrdvaleur", type="float",options={"default":0})
     */
    private $nrdvaleur;
    
    /**
     * @var int
     *
     * @ORM\Column(name="xray_tube_content", type="integer")
     */
    private $xrayTubeContent;

 
    
    /**
     * @var string
     *
     * @ORM\Column(name="unitexray_tube_content", type="string", length=255)
     */
    private $unitexrayTubeContent;
    
    /**
     * @var string
     *
     * @ORM\Column(name="body_part", type="string", length=255)
     */
    private $bodyPart;

    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=255)
     */
    private $unite;
 
    /**
     * @var string
     *
     * @ORM\Column(name="protocole", type="string", length=255)
     */
    private $protocole;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="body_part_easydose", type="string", length=255)
     */
    private $bodyPartEasydose;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Dose",inversedBy="detail_dose")
     * @ORM\JoinColumn(name="dose_id", referencedColumnName="id", nullable=true)
     * */
    
    protected $dose;
    

    
    /**
     * @var boolean
     *
     * @ORM\Column(name="esrhavealerte", type="boolean" , nullable=true)
     */
    private $esrhavealerte;
    
    /**
     * @return string
     */
    public function getTrancheage()
    {
        return $this->trancheage;
    }

    /**
     * @return boolean
     */
    public function isNrdhavealerte()
    {
        return $this->nrdhavealerte;
    }

    /**
     * @return boolean
     */
    public function isSumhavealerte()
    {
        return $this->sumhavealerte;
    }

    /**
     * @param string $trancheage
     */
    public function setTrancheage($trancheage)
    {
        $this->trancheage = $trancheage;
    }

    /**
     * @param boolean $sumhavealerte
     */
    public function setSumhavealerte($sumhavealerte)
    {
        $this->sumhavealerte = $sumhavealerte;
    }

    /**
     * @return boolean
     */
    public function isEsrhavealerte()
    {
        return $this->esrhavealerte;
    }

    /**
     * @param boolean $esrhavealerte
     */
    public function setEsrhavealerte($esrhavealerte)
    {
        $this->esrhavealerte = $esrhavealerte;
    }

    public function __toString(){
    	return "Dose : ".$this->valeur." , protocole: ".$this->protocole.", Body parts:".$this->bodyPartEasydose;
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
     * Set kvp
     *
     * @param integer $kvp
     *
     * @return detail_dose
     */
    public function setKvp($kvp)
    {
        $this->kvp = $kvp;

        return $this;
    }

    /**
     * Get kvp
     *
     * @return int
     */
    public function getKvp()
    {
        return $this->kvp;
    }

    /**
     * Set tempsExposition
     *
     * @param float $tempsExposition
     *
     * @return detail_dose
     */
    public function setTempsExposition($tempsExposition)
    {
        $this->tempsExposition = $tempsExposition;

        return $this;
    }

    /**
     * Get tempsExposition
     *
     * @return float
     */
    public function getTempsExposition()
    {
        return $this->tempsExposition;
    }

    /**
     * Set xrayTubeContent
     *
     * @param integer $xrayTubeContent
     *
     * @return detail_dose
     */
    public function setXrayTubeContent($xrayTubeContent)
    {
        $this->xrayTubeContent = $xrayTubeContent;

        return $this;
    }

    /**
     * Get xrayTubeContent
     *
     * @return int
     */
    public function getXrayTubeContent()
    {
        return $this->xrayTubeContent;
    }
	public function getBodyPartEasydose() {
		return $this->bodyPartEasydose;
	}
	public function setBodyPartEasydose($bodyPartEasydose) {
		$this->bodyPartEasydose = $bodyPartEasydose;
		return $this;
	}
	public function getValeur() {
		return $this->valeur;
	}
	public function setValeur($valeur) {
		$this->valeur = $valeur;
		return $this;
	}
	public function getUnite() {
		return $this->unite;
	}
	public function setUnite($unite) {
		$this->unite = $unite;
		return $this;
	}
	
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
	
	public function getProtocole() {
		return $this->protocole;
	}
	public function setProtocole($protocole) {
		$this->protocole = $protocole;
		return $this;
	}
	public function getMachine() {
		return $this->machine;
	}
	public function setMachine($machine) {
		$this->machine = $machine;
		return $this;
	}
	public function getDate() {
		return $this->date;
	}
	public function setDate(\DateTime $date) {
		$this->date = $date;
		return $this;
	}
	public function getModalite() {
		return $this->modalite;
	}
	public function setModalite($modalite) {
		$this->modalite = $modalite;
		return $this;
	}
	public function getUnitexrayTubeContent() {
		return $this->unitexrayTubeContent;
	}
	public function setUnitexrayTubeContent($unitexrayTubeContent) {
		$this->unitexrayTubeContent = $unitexrayTubeContent;
		return $this;
	}
	public function getDose() {
		return $this->dose;
	}
	public function setDose($dose) {
		$this->dose = $dose;
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
	public function getNrdvaleur() {
		return $this->nrdvaleur;
	}
	public function setNrdvaleur($nrdvaleur) {
		$this->nrdvaleur = $nrdvaleur;
		return $this;
	}
	public function getBodyPart() {
		return $this->bodyPart;
	}
	public function setBodyPart($bodyPart) {
		$this->bodyPart = $bodyPart;
		return $this;
	}
	public function getUniteseuil() {
		return $this->uniteseuil;
	}
	public function setUniteseuil($uniteseuil) {
		$this->uniteseuil = $uniteseuil;
		return $this;
	}
	
	
	
	
	
	
	
	
	
	
	
	
}

