<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Examen
 *
 * @ORM\Table(name="examen")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExamenRepository")
 */
#[ORM\Entity(repositoryClass:"App\Repository\ExamenRepository")]
#[ORM\Table(name: 'examen')]
class Examen
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    #[ORM\Column(name:"date")]
    #[Groups(['server:read', 'command:read'])]
    private \DateTime $dateExamen;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_cabinet", type="string", length=255)
     */
    #[ORM\Column(name:"nom_cabinet", type:"string", length:255)]
    #[Groups(['server:read', 'command:read'])]
    private $nomCabinet;

    
    /**
     * @var string
     *
     * @ORM\Column(name="manufacturermodelname", type="string", length=512, nullable=true)
     */
    #[ORM\Column(name:"manufacturermodelname", type:"string", length:512, nullable:true)]
    #[Groups(['server:read', 'command:read'])]
    private $manufacturermodelname;
 
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=512, nullable=true)
     */
    #[ORM\Column(name:"manufacturer", type:"string", length:512, nullable:true)]
    #[Groups(['server:read', 'command:read'])]
    private $manufacturer;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Patient",inversedBy="examen")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id", nullable=true)
     * */
    #[ORM\ManyToOne(targetEntity: Patient::class)]
    #[ORM\JoinColumn(name: 'patient_id', referencedColumnName: 'id', nullable:true)]

    private $patient;

   
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SalleExamen",inversedBy="examen")
     * @ORM\JoinColumn(name="salle_examen_id", referencedColumnName="id", nullable=true)
     * */
    #[ORM\ManyToOne(targetEntity: SalleExamen::class,inversedBy:"examen")]
    #[ORM\JoinColumn(name: 'salle_examen_id', referencedColumnName: 'id', nullable:true)]
    #[Groups(['server:read', 'command:read'])]
    private $salleExament;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Region",inversedBy="examen")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id", nullable=true)
     * */
    #[ORM\ManyToOne(targetEntity: Region::class,inversedBy:"examen")]
    #[ORM\JoinColumn(name: 'region_id', referencedColumnName: 'id', nullable:true)]
    private $region;
    
    /**
     * @return string
     */
    public function getManufacturermodelname()
    {
        return $this->manufacturermodelname;
    }

    /**
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturermodelname
     */
    public function setManufacturermodelname($manufacturermodelname)
    {
        $this->manufacturermodelname = $manufacturermodelname;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set dateExamen
     *
     * @param \DateTime $dateExamen
     *
     * @return Examen
     */
    public function setDateExamen($dateExamen)
    {
        $this->dateExamen = $dateExamen;

        return $this;
    }

    /**
     * Get dateExamen
     *
     * @return \DateTime
     */
    public function getDateExamen()
    {
        return $this->dateExamen;
    }

    /**
     * Set nomCabinet
     *
     * @param string $nomCabinet
     *
     * @return Examen
     */
    public function setNomCabinet($nomCabinet)
    {
        $this->nomCabinet = $nomCabinet;

        return $this;
    }

    /**
     * Get nomCabinet
     *
     * @return string
     */
    public function getNomCabinet()
    {
        return $this->nomCabinet;
    }
	public function getPatient() {
		return $this->patient;
	}
	public function setPatient($patient) {
		$this->patient = $patient;
		return $this;
	}
	public function getRegion() {
		return $this->region;
	}
	public function setRegion($region) {
		$this->region = $region;
		return $this;
	}
	public function getSalleExament() {
		return $this->salleExament;
	}
	public function setSalleExament($salleExament) {
		$this->salleExament = $salleExament;
		return $this;
	}
	
	
}

