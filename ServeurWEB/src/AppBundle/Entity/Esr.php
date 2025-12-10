<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Esr
 *
 * @ORM\Table(name="esr")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EsrRepository")
 */
class Esr
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
     * @ORM\Column(name="nomDeclarant", type="string", length=512, nullable=true)
     */
    private $nomDeclarant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomDeclarant", type="string", length=512, nullable=true)
     */
    private $prenomDeclarant;

    /**
     * @var int
     *
     * @ORM\Column(name="fonctionDeclarant", type="integer", nullable=true)
     */
    private $fonctionDeclarant;

    /**
     * @var string
     *
     * @ORM\Column(name="telephoneDeclarant", type="string", length=255, nullable=true)
     */
    private $telephoneDeclarant;

    /**
     * @var string
     *
     * @ORM\Column(name="emailDeclarant", type="string", length=512, nullable=true)
     */
    private $emailDeclarant;

    /**
     * @var string
     *
     * @ORM\Column(name="dateSurvenueESR", type="string", nullable=true)
     */
    private $dateSurvenueESR;

    /**
     * @var string
     *
     * @ORM\Column(name="dateDetectionESR", type="string", nullable=true)
     */
    private $dateDetectionESR;

    
    /**
     * @var string
     *
     * @ORM\Column(name="heureSurvenueESR", type="string", nullable=true)
     */
    private $heureSurvenueESR;
    
    /**
     * @var string
     *
     * @ORM\Column(name="heureDetectionESR", type="string", nullable=true)
     */
    private $heureDetectionESR;
    
    /**
     * @var string
     *
     * @ORM\Column(name="circonstancesDetection", type="string", length=1024, nullable=true)
     */
    private $circonstancesDetection;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CritereEsr")
     * @ORM\JoinColumn(name="idCritereDeclaration", referencedColumnName="id")
     * */
    private $idCritereDeclaration;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypePersonnalEvent")
     * @ORM\JoinColumn(name="idTypePersonnalEvent", referencedColumnName="id")
     * */
    private $idTypePersonnalEvent;
    
    /**
     * @var int
     *
     * @ORM\Column(name="origine", type="integer", nullable=true)
     */
    private $origine;
 
 
    /**
     * @var int
     *
     * @ORM\Column(name="dispositif", type="integer", nullable=true)
     */
    private $dispositif;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="agePersonneConserne", type="integer", nullable=true)
     */
    private $agePersonneConserne;
    
   
    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=20, nullable=true)
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=true)
     */
    private $type;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="typepersonnel", type="string", length=20, nullable=true)
     */
    private $typepersonnel;
    
    /**
     * @var string
     *
     * @ORM\Column(name="consequencereelleim", type="string", length=1024, nullable=true)
     */
    private $consequencereelleim;
    

    /**
     * @var string
     *
     * @ORM\Column(name="consequencepotentielle", type="string", length=1024, nullable=true)
     */
    private $consequencepotentielle;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="groupei", type="string", length=1024, nullable=true)
     */
    private $groupei;

    /**
     * @var string
     *
     * @ORM\Column(name="actionconservatoires", type="string", length=1024, nullable=true)
     */
    private $actionconservatoires;
    
   
    /**
     * @var string
     *
     * @ORM\Column(name="actioncorrectives", type="string", length=1024, nullable=true)
     */
    private $actioncorrectives;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSauvegarde", type="datetime", nullable=true)
     */
    private $dateSauvegarde;
    


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedecla", type="datetime", nullable=true)
     */
    private $datedecla;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="createur", referencedColumnName="id")
     * */
    
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Patient")
     * @ORM\JoinColumn(name="patient", referencedColumnName="id")
     * */
    
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etat")
     * @ORM\JoinColumn(name="etat", referencedColumnName="id")
     * */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="patientname", type="string", length=1024, nullable=true)
     */
    private $patientname;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Examen")
     * @ORM\JoinColumn(name="examen", referencedColumnName="id")
     * */
    
    private $examen;

    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etablissement")
     * @ORM\JoinColumn(name="etablissement", referencedColumnName="id")
     * */
    
    private $etablissement;
    /**
     * @return mixed
     */

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Souscategorie")
     * @ORM\JoinColumn(name="souscategorie_id", referencedColumnName="id", nullable=true)
     * */

    private $souscategorie;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EtablissementEi")
     * @ORM\JoinColumn(name="etablissementeiid", referencedColumnName="id", nullable=true)
     * */

     private $etablissementeiid;

    public function getIdTypePersonnalEvent()
    {
        return $this->idTypePersonnalEvent;
    }

    /**
     * @param mixed $idTypePersonnalEvent
     */
    public function setIdTypePersonnalEvent($idTypePersonnalEvent)
    {
        $this->idTypePersonnalEvent = $idTypePersonnalEvent;
    }

    /**
     * @return mixed
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @param mixed $patient
     */
    public function setPatient($patient)
    {
        $this->patient = $patient;
    }

    /**
     * @return mixed
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * @return mixed
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * @param mixed $examen
     */
    public function setExamen($examen)
    {
        $this->examen = $examen;
    }

    /**
     * @param mixed $etablissement
     */
    public function setEtablissement($etablissement)
    {
        $this->etablissement = $etablissement;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getHeureSurvenueESR()
    {
        return $this->heureSurvenueESR;
    }

    /**
     * @return string
     */
    public function getHeureDetectionESR()
    {
        return $this->heureDetectionESR;
    }

    /**
     * @param string $heureSurvenueESR
     */
    public function setHeureSurvenueESR($heureSurvenueESR)
    {
        $this->heureSurvenueESR = $heureSurvenueESR;
    }

    /**
     * @param string $heureDetectionESR
     */
    public function setHeureDetectionESR($heureDetectionESR)
    {
        $this->heureDetectionESR = $heureDetectionESR;
    }

    /**
     * @return number
     */
    public function getDispositif()
    {
        return $this->dispositif;
    }

    /**
     * @param number $dispositif
     */
    public function setDispositif($dispositif)
    {
        $this->dispositif = $dispositif;
    }

    /**
     * @return string
     */
    public function getActioncorrectives()
    {
        return $this->actioncorrectives;
    }

    /**
     * @param string $actioncorrectives
     */
    public function setActioncorrectives($actioncorrectives)
    {
        $this->actioncorrectives = $actioncorrectives;
    }

    /**
     * @return number
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * @param number $origine
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }

    /**
     * @return number
     */
    public function getIdOrigineEvenement()
    {
        return $this->idOrigineEvenement;
    }

    /**
     * @return number
     */
    public function getAgePersonneConserne()
    {
        return $this->agePersonneConserne;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getConsequencereelleim()
    {
        return $this->consequencereelleim;
    }

    /**
     * @return string
     */
    public function getConsequencepotentielle()
    {
        return $this->consequencepotentielle;
    }

    /**
     * @return string
     */
    public function getActionconservatoires()
    {
        return $this->actionconservatoires;
    }

    /**
     * @return \DateTime
     */
    public function getDateSauvegarde()
    {
        return $this->dateSauvegarde;
    }

  
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param number $idOrigineEvenement
     */
    public function setIdOrigineEvenement($idOrigineEvenement)
    {
        $this->idOrigineEvenement = $idOrigineEvenement;
    }

    /**
     * @param number $agePersonneConserne
     */
    public function setAgePersonneConserne($agePersonneConserne)
    {
        $this->agePersonneConserne = $agePersonneConserne;
    }

    /**
     * @param string $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @param string $consequencereelleim
     */
    public function setConsequencereelleim($consequencereelleim)
    {
        $this->consequencereelleim = $consequencereelleim;
    }

    /**
     * @param string $consequencepotentielle
     */
    public function setConsequencepotentielle($consequencepotentielle)
    {
        $this->consequencepotentielle = $consequencepotentielle;
    }

    /**
     * @param string $actionconservatoires
     */
    public function setActionconservatoires($actionconservatoires)
    {
        $this->actionconservatoires = $actionconservatoires;
    }

    /**
     * @param \DateTime $dateSauvegarde
     */
    public function setDateSauvegarde($dateSauvegarde)
    {
        $this->dateSauvegarde = $dateSauvegarde;
    }


    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
     * Set nomDeclarant
     *
     * @param string $nomDeclarant
     *
     * @return Esr
     */
    public function setNomDeclarant($nomDeclarant)
    {
        $this->nomDeclarant = $nomDeclarant;

        return $this;
    }

    /**
     * Get nomDeclarant
     *
     * @return string
     */
    public function getNomDeclarant()
    {
        return $this->nomDeclarant;
    }

    /**
     * Set prenomDeclarant
     *
     * @param string $prenomDeclarant
     *
     * @return Esr
     */
    public function setPrenomDeclarant($prenomDeclarant)
    {
        $this->prenomDeclarant = $prenomDeclarant;

        return $this;
    }

    /**
     * Get prenomDeclarant
     *
     * @return string
     */
    public function getPrenomDeclarant()
    {
        return $this->prenomDeclarant;
    }

    /**
     * Set fonctionDeclarant
     *
     * @param integer $fonctionDeclarant
     *
     * @return Esr
     */
    public function setFonctionDeclarant($fonctionDeclarant)
    {
        $this->fonctionDeclarant = $fonctionDeclarant;

        return $this;
    }

    /**
     * Get fonctionDeclarant
     *
     * @return int
     */
    public function getFonctionDeclarant()
    {
        return $this->fonctionDeclarant;
    }

    /**
     * Set telephoneDeclarant
     *
     * @param string $telephoneDeclarant
     *
     * @return Esr
     */
    public function setTelephoneDeclarant($telephoneDeclarant)
    {
        $this->telephoneDeclarant = $telephoneDeclarant;

        return $this;
    }

    /**
     * Get telephoneDeclarant
     *
     * @return string
     */
    public function getTelephoneDeclarant()
    {
        return $this->telephoneDeclarant;
    }

    /**
     * Set emailDeclarant
     *
     * @param string $emailDeclarant
     *
     * @return Esr
     */
    public function setEmailDeclarant($emailDeclarant)
    {
        $this->emailDeclarant = $emailDeclarant;

        return $this;
    }

    /**
     * Get emailDeclarant
     *
     * @return string
     */
    public function getEmailDeclarant()
    {
        return $this->emailDeclarant;
    }

    /**
     * Set dateSurvenueESR
     *
     * @param \DateTime $dateSurvenueESR
     *
     * @return Esr
     */
    public function setDateSurvenueESR($dateSurvenueESR)
    {
        $this->dateSurvenueESR = $dateSurvenueESR;

        return $this;
    }

    /**
     * Get dateSurvenueESR
     *
     * @return \DateTime
     */
    public function getDateSurvenueESR()
    {
        return $this->dateSurvenueESR;
    }

    /**
     * Set dateDetectionESR
     *
     * @param \DateTime $dateDetectionESR
     *
     * @return Esr
     */
    public function setDateDetectionESR($dateDetectionESR)
    {
        $this->dateDetectionESR = $dateDetectionESR;

        return $this;
    }

    /**
     * Get dateDetectionESR
     *
     * @return \DateTime
     */
    public function getDateDetectionESR()
    {
        return $this->dateDetectionESR;
    }

    /**
     * Set circonstancesDetection
     *
     * @param string $circonstancesDetection
     *
     * @return Esr
     */
    public function setCirconstancesDetection($circonstancesDetection)
    {
        $this->circonstancesDetection = $circonstancesDetection;

        return $this;
    }

    /**
     * Get circonstancesDetection
     *
     * @return string
     */
    public function getCirconstancesDetection()
    {
        return $this->circonstancesDetection;
    }

    /**
     * Set idCritereDeclaration
     *
     * @param integer $idCritereDeclaration
     *
     * @return Esr
     */
    public function setIdCritereDeclaration($idCritereDeclaration)
    {
        $this->idCritereDeclaration = $idCritereDeclaration;

        return $this;
    }

    /**
     * Get idCritereDeclaration
     *
     * @return int
     */
    public function getIdCritereDeclaration()
    {
        return $this->idCritereDeclaration;
    }

	/**
	 * 
	 * @return mixed
	 */
	public function getSouscategorie() {
		return $this->souscategorie;
	}
	
	/**
	 * 
	 * @param mixed $souscategorie 
	 * @return self
	 */
	public function setSouscategorie($souscategorie): self {
		$this->souscategorie = $souscategorie;
		return $this;
	}

	/**
	 * 
	 * @return mixed
	 */
	public function getEtablissementeiid() {
		return $this->etablissementeiid;
	}
	
	/**
	 * 
	 * @param mixed $etablissementeiid 
	 * @return self
	 */
	public function setEtablissementeiid($etablissementeiid): self {
		$this->etablissementeiid = $etablissementeiid;
		return $this;
	}

	/**
	 * 
	 * @return \DateTime
	 */
	public function getDatedecla() {
		return $this->datedecla;
	}
	
	/**
	 * 
	 * @param \DateTime $datedecla 
	 * @return self
	 */
	public function setDatedecla($datedecla): self {
		$this->datedecla = $datedecla;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getGroupei() {
		return $this->groupei;
	}
	
	/**
	 * 
	 * @param string $groupei 
	 * @return self
	 */
	public function setGroupei($groupei): self {
		$this->groupei = $groupei;
		return $this;
	}


	/**
	 * 
	 * @param string $groupei 
	 * @return self
	 */
    public function setPatientname($patientname): self {
		$this->patientname = $patientname;
		return $this;
	}

    /**
	 * 
	 * @return string
	 */
	public function getPatientname() {
		return $this->patientname;
	}
}

