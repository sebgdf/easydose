<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegionRepository")
 */
#[ORM\Entity(repositoryClass:"App\Repository\RegionRepository")]
#[ORM\Table(name:"region")]
class Region
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    #[ORM\Column(name:"nom", type:"string", length:255)]
    #[Groups(['server:read', 'command:read'])]
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    #[ORM\Column(name:"code", type:"string", length:255)]
    #[Groups(['server:read', 'command:read'])]
    private $code;

    

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Region_Dose",mappedBy="region",cascade={"persist", "remove"})
     */
    #[ORM\OneToMany(targetEntity: Region_Dose::class, mappedBy: 'region', cascade: ['persist', 'remove'])]

    private $regiondose;
    

    
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examen",mappedBy="region",cascade={"persist", "remove"})
     */
    #[ORM\OneToMany(targetEntity: Examen::class, mappedBy: 'region', cascade: ['persist', 'remove'])]
    private $examen;
    
    
    /**
     * @return mixed
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * @param mixed $examen
     */
    public function setExamen($examen)
    {
        $this->examen = $examen;
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
     * Set nomRegion
     *
     * @param string $nomRegion
     *
     * @return Region
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nomRegion
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set codeRegion
     *
     * @param string $codeRegion
     *
     * @return Region
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get codeRegion
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
	public function getRegiondose() {
		return $this->regiondose;
	}
	public function setRegiondose($regiondose) {
		$this->regiondose = $regiondose;
		return $this;
	}
	
}

