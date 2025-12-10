<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass:"App\Repository\PatientRepository")]
#[ORM\Table(name:"patient")]
class Patient
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]
    #[Groups(['server:read', 'command:read'])]
    public $id;


    #[ORM\Column(length:255)]
    #[Groups(['server:read', 'command:read'])]
    public ?string $nom;

    
    #[ORM\Column(length:255)]
    #[Groups(['server:read', 'command:read'])]
    public ?string $prenom;


    #[ORM\Column(length:255)]
    #[Groups(['server:read', 'command:read'])]
    public ?string $numipp;

    
    #[ORM\Column(length:255)]
    #[Groups(['server:read', 'command:read'])]
    private ?string $uniteage;
    

    #[ORM\Column(length:255)]
    #[Groups(['server:read', 'command:read'])]
    public ?string $sex;
    
    #[ORM\Column(name:"idregional", type:"string", length:255, nullable:true)]
    #[Groups(['server:read', 'command:read'])]
    public string $idregional;
    

    #[ORM\Column(name:"datenaissance")]
    #[Groups(['server:read', 'command:read'])]
    public \DateTime $datenaissance;


    #[ORM\Column(name:"age")]
    #[Groups(['server:read', 'command:read'])]
    public int $age;
  
 
    #[ORM\Column(name:"nbdoses")]
    #[Groups(['server:read', 'command:read'])]
    private ?int $nbdoses;
    
    
 
    #[ORM\Column(name:"nrdhavealerte")]
    #[Groups(['server:read', 'command:read'])]
    private ?bool $nrdhavealerte;
 
    #[ORM\Column(name:"ispediatrie", nullable:true)]
    #[Groups(['server:read', 'command:read'])]
    private ?bool $ispediatrie;

    #[ORM\Column(name:"sumhavealerte")]
    #[Groups(['server:read', 'command:read'])]
    private ?bool $sumhavealerte;
 
    #[ORM\Column(name:"havenotes")]
    #[Groups(['server:read', 'command:read'])]
    private ?bool $havenotes;
    
    #[ORM\Column(name:"havemammo")]
    #[Groups(['server:read', 'command:read'])]
    private ?bool $havemammo;
    #[ORM\Column(name:"haveradio")]
    #[Groups(['server:read', 'command:read'])]
    private ?bool $haveradio;
    #[ORM\Column(name:"havescanner")]
    #[Groups(['server:read', 'command:read'])]
    private ?bool $havescanner;

    #[ORM\Column(name:"datelastexam", nullable:true)]
    #[Groups(['server:read', 'command:read'])]
    private ?\DateTime $datelastexam=null;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examen",mappedBy="patient",cascade={"persist", "remove"})
     */
    #[ORM\OneToMany(targetEntity: Examen::class, mappedBy: 'patient', cascade: ['persist', 'remove'])]
    protected $examen;

    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Note",mappedBy="patient",cascade={"persist", "remove"})
     */

    #[ORM\OneToMany(targetEntity: Note::class, mappedBy: 'patient', cascade: ['persist', 'remove'])]
    protected $note;
    
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
    public function addExamen($examen) {
		$this->examen[] = $examen;
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
     * Get the value of ispediatrie
     */ 
    public function getIspediatrie()
    {
        return $this->ispediatrie;
    }

    /**
     * Set the value of ispediatrie
     *
     * @return  self
     */ 
    public function setIspediatrie($ispediatrie)
    {
        $this->ispediatrie = $ispediatrie;

        return $this;
    }
}

