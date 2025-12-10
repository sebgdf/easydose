<?php

namespace App\Controller\Simple;
use App\Entity\Patient;
use App\Entity\Examen;
use App\Entity\Note;
class SimplePatient
{

    public $id;
    public ?string $nom;
    public ?string $prenom;
    public ?string $numipp;
    private ?string $uniteage;
    public ?string $sex;
    public string $idregional;
    public \DateTime $datenaissance;

    public int $age;
    private ?int $nbdoses;
    private ?bool $nrdhavealerte;  
     private ?bool $sumhavealerte;
    private ?bool $havenotes;
    private ?bool $havemammo;
    private ?bool $haveradio;
    private ?bool $havescanner;
    private ?\DateTime $datelastexam;
    protected $examen;
    protected $note;

    private ?string $datedenaissancestring;
    
    public function __construct(Patient $patient){
        $this->id=$patient->getId();
        $this->nom=$patient->getNom();
        $this->prenom=$patient->getPrenom();
        $this->numipp=$patient->getNumipp();
        $this->uniteage=$patient->getUniteage();
        $this->sex=$patient->getSex();
        $this->idregional=$patient->getIdregional();
        $this->datenaissance=$patient->getDatenaissance();
        $this->datedenaissancestring=$patient->getDatenaissance()->format('d/m/Y');
        $this->age=$patient->getAge();
        $this->nbdoses=$patient->getNbdoses();
        $this->nrdhavealerte=$patient->getNrdhavealerte();  
        $this->sumhavealerte=$patient->getSumhavealerte();
        $this->havenotes=$patient->getHavenotes();
        $this->havemammo=$patient->getHavemammo();
        $this->haveradio=$patient->getHaveradio();
        $this->havescanner=$patient->getHavescanner();
        $this->datelastexam=$patient->getDatelastexam();
        $this->examen=array();
        $this->note=array();
        $this->datelastexam==$patient->getDatelastexam();
    }
    public function addExamen(Examen $examen): SimpleExamen{

        $simpleexamen= new \App\Controller\Simple\SimpleExamen($examen);
        $this->examen[]=$simpleexamen;
        return $simpleexamen;

    }

    public function addNote(Note $note){

        $simplenote= new \App\Controller\Simple\SimpleNote($note);
        $this->note[]=$simplenote;

    }
    public function __toString(){
        return "Patient: ".$this->id." ".$this->getNom()." ".$this->prenom." , age: ".$this->age.", IPP :".$this->numipp.", id regional: ".$this->idregional.' '.$this->sex;
    }
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
   // public function addExamen($examen) {
	//	$this->examen[] = $examen;
	//	return $this;
//	}
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
     * Get the value of havemammo
     */ 
    public function getHavemammo()
    {
        return $this->havemammo;
    }

    /**
     * Set the value of havemammo
     *
     * @return  self
     */ 
    public function setHavemammo($havemammo)
    {
        $this->havemammo = $havemammo;

        return $this;
    }

    /**
     * Get the value of haveradio
     */ 
    public function getHaveradio()
    {
        return $this->haveradio;
    }

    /**
     * Set the value of haveradio
     *
     * @return  self
     */ 
    public function setHaveradio($haveradio)
    {
        $this->haveradio = $haveradio;

        return $this;
    }

    /**
     * Get the value of havescanner
     */ 
    public function getHavescanner()
    {
        return $this->havescanner;
    }

    /**
     * Set the value of havescanner
     *
     * @return  self
     */ 
    public function setHavescanner($havescanner)
    {
        $this->havescanner = $havescanner;

        return $this;
    }

    /**
     * Get the value of uniteage
     */ 
    public function getUniteage()
    {
        return $this->uniteage;
    }

    /**
     * Set the value of uniteage
     *
     * @return  self
     */ 
    public function setUniteage($uniteage)
    {
        $this->uniteage = $uniteage;

        return $this;
    }


    /**
     * Get the value of datelastexam
     */ 
    public function getDatelastexam()
    {
        return $this->datelastexam;
    }

    /**
     * Set the value of datelastexam
     *
     * @return  self
     */ 
    public function setDatelastexam($datelastexam)
    {
        $this->datelastexam = $datelastexam;

        return $this;
    }

    /**
     * Get the value of datedenaissancestring
     */ 
    public function getDatedenaissancestring()
    {
        return $this->datedenaissancestring;
    }

    /**
     * Set the value of datedenaissancestring
     *
     * @return  self
     */ 
    public function setDatedenaissancestring($datedenaissancestring)
    {
        $this->datedenaissancestring = $datedenaissancestring;

        return $this;
    }
}

