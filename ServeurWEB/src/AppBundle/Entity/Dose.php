<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dose
 *
 * @ORM\Table(name="dose")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DoseRepository")
 */
class Dose
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
     * @var string
     *
     * @ORM\Column(name="modalite", type="string", length=255)
     */
    private $modalite;

    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=255)
     */
    private $unite;
    
    /**
     * @var float
     *
     * @ORM\Column(name="kvp", type="float")
     */
    private $kvp;
    
    /**
     * @var float
     *
     * @ORM\Column(name="temps_exposition", type="float")
     */
    private $tempsExposition;

 
    /**
     * @var int
     *
     * @ORM\Column(name="xray_tube_current", type="integer")
     */
    private $xrayTubeCurren2;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Region_Dose",mappedBy="dose_id",cascade={"persist", "remove"})
     */
  

    private $regiondose;
    
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="protocole", type="string", length=255)
     */
    private $protocole;
    
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\detail_dose",mappedBy="dose",cascade={"persist", "remove"})
     */
       
    private $detail_dose;
    
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
	public function getRegiondose() {
		return $this->regiondose;
	}
	public function setRegiondose($regiondose) {
		$this->regiondose = $regiondose;
		return $this;
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
	public function getDetailDose() {
		return $this->detail_dose;
	}
	public function setDetailDose($detail_dose) {
		$this->detail_dose = $detail_dose;
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

