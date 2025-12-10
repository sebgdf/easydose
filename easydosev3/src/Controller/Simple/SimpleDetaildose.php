<?php

namespace App\Controller\Simple;
use App\Entity\Detail_Dose;

class SimpleDetaildose
{
    private $id;
    private $kvp;
    private $modalite;
    private $trancheage;
    private \DateTime $date;
    private $machine;
    private $tempsExposition;
    private $valeur;
    private $uniteseuil;
    private $nrdvaleur;
    private $xrayTubeContent;
    private $unitexrayTubeContent;
    private $bodyPart;
    private $unite;
    private $protocole;
    private $bodyPartEasydose;
    private $esrhavealerte;
    

    public function __construct(Detail_Dose $detaildose){
        $this->id=$detaildose->getId();
        $this->kvp=$detaildose->getKvp();
        $this->modalite=$detaildose->getModalite();
        $this->trancheage=$detaildose->getTrancheage();
        $this->date=$detaildose->getDate();
        $this->machine=$detaildose->getMachine();
        $this->tempsExposition=$detaildose->getTempsExposition();
        $this->valeur=$detaildose->getValeur();
        $this->uniteseuil=$detaildose->getUniteseuil();
        $this->nrdvaleur=$detaildose->getNrdvaleur();
        $this->xrayTubeContent=$detaildose->getXrayTubeContent();
        $this->unitexrayTubeContent=$detaildose->getUnitexrayTubeContent();
        $this->bodyPart=$detaildose->getBodyPart();
        $this->unite=$detaildose->getUnite();
        $this->protocole=$detaildose->getProtocole();
        $this->bodyPartEasydose=$detaildose->getBodyPartEasydose();
        $this->esrhavealerte=$detaildose->isEsrhavealerte();
    }

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
    #[ORM\Column(name:"nrdhavealerte", type:"boolean")]
	private $nrdhavealerte;
	
	
	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="sumhavealerte", type="boolean")
	 */
    #[ORM\Column(name:"sumhavealerte", type:"boolean")]
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

	public function setId($id) {
		$this->id = $id;
		return $this;
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

