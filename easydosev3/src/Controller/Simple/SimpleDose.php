<?php

namespace App\Controller\Simple;
use App\Entity\Dose;
class SimpleDose
{
    private $id;
    private $valeur;
    private $modalite;
    private $unite;
    private $kvp;
    private $tempsExposition;
    private $xrayTubeCurren2;
    private \DateTime $date;
    private $protocole;
    
    public function __construct(Dose $dose){
        $this->id=$dose->getId();
        $this->valeur=$dose->getValeur();
        $this->modalite=$dose->getModalite();
        $this->unite=$dose->getUnite();
        $this->kvp=$dose->getKvp();
        $this->tempsExposition=$dose->getTempsExposition();
        $this->xrayTubeCurren2=$dose->getXrayTubeCurren2();
        $this->date=$dose->getDate();
        $this->protocole=$dose->getProtocole();
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
     * @return Dose
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
     * Set modalite
     *
     * @param string $modalite
     *
     * @return Dose
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

	public function getKvp() {
		return $this->kvp;
	}
	public function setKvp($kvp) {
		$this->kvp = $kvp;
		return $this;
	}
	public function getTempsExposition() {
		return $this->tempsExposition;
	}
	public function setTempsExposition($tempsExposition) {
		$this->tempsExposition = $tempsExposition;
		return $this;
	}
	public function getXrayTubeCurren2() {
		return $this->xrayTubeCurren2;
	}
	public function setXrayTubeCurren2($xrayTubeCurren2) {
		$this->xrayTubeCurren2 = $xrayTubeCurren2;
		return $this;
	}
	public function getDate() {
		return $this->date;
	}
	public function setDate(\DateTime $date) {
		$this->date = $date;
		return $this;
	}
	public function getProtocole() {
		return $this->protocole;
	}
	public function setProtocole($protocole) {
		$this->protocole = $protocole;
		return $this;
	}
	public function getUnite() {
		return $this->unite;
	}
	public function setUnite($unite) {
		$this->unite = $unite;
		return $this;
	}
	
	
	
}

