<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dose
 *
 * @ORM\Table(name="dose")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DoseRepository")
 */
#[ORM\Entity(repositoryClass:"App\Repository\DoseRepository")]
#[ORM\Table(name: 'dose')]
class Dose
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
    #[Groups(['server:read', 'command:read'])]
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    #[ORM\Column(name:"valeur", type:"float")]
    #[Groups(['server:read', 'command:read'])]
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="modalite", type="string", length=255)
     */
    #[ORM\Column(name:"modalite", type:"string", length:255)]
    #[Groups(['server:read', 'command:read'])]
    private $modalite;

    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=255)
     */
    #[ORM\Column(name:"unite", type:"string", length:255)]
    #[Groups(['server:read', 'command:read'])]
    private $unite;
    
    /**
     * @var float
     *
     * @ORM\Column(name="kvp", type="float")
     */
    #[ORM\Column(name:"kvp", type:"float")]
    #[Groups(['server:read', 'command:read'])]
    private $kvp;
    
    /**
     * @var float
     *
     * @ORM\Column(name="temps_exposition", type="float")
     */
    #[ORM\Column(name:"temps_exposition", type:"float")]
    #[Groups(['server:read', 'command:read'])]
    private $tempsExposition;

 
    /**
     * @var int
     *
     * @ORM\Column(name="xray_tube_current", type="integer")
     */
    #[ORM\Column(name:"xray_tube_current", type:"integer")]
    #[Groups(['server:read', 'command:read'])]
    private $xrayTubeCurren2;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Region_Dose",mappedBy="dose_id",cascade={"persist", "remove"})
     */
  
    #[ORM\OneToMany(targetEntity: Region_Dose::class, mappedBy: 'dose', cascade: ['persist', 'remove'])]

    private $regiondose;
    
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    #[ORM\Column(name:"date")]
    #[Groups(['server:read', 'command:read'])]
    private \DateTime $date;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="protocole", type="string", length=255)
     */
    #[ORM\Column(name:"protocole", type:"string", length:255)]
    #[Groups(['server:read', 'command:read'])]
    private $protocole;
    
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\detail_dose",mappedBy="dose",cascade={"persist", "remove"})
     */
    #[ORM\OneToMany(targetEntity: Detail_dose::class, mappedBy: 'dose', cascade: ['persist', 'remove'])]
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

