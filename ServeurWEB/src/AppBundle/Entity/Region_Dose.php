<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region_Dose
 *
 * @ORM\Table(name="region_dose")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Region_DoseRepository")
 */
class Region_Dose
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Dose",inversedBy="regiondose")
     * @ORM\JoinColumn(name="dose_id", referencedColumnName="id", nullable=true)
     * */

    public $dose;
    
   
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Region",inversedBy="regiondose")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id", nullable=true)
     * */

    protected $region;
    
    
    
    
    
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
     * Set dateRegionDose
     *
     * @param \DateTime $dateRegionDose
     *
     * @return Region_Dose
     */
    public function setDateRegionDose($dateRegionDose)
    {
        $this->dateRegionDose = $dateRegionDose;

        return $this;
    }

    /**
     * Get dateRegionDose
     *
     * @return \DateTime
     */
    public function getDateRegionDose()
    {
        return $this->dateRegionDose;
    }
	public function getDose() {
		return $this->dose;
	}
	public function setDose($dose) {
		$this->dose = $dose;
		return $this;
	}
	public function getRegion() {
		return $this->region;
	}
	public function setRegion($region) {
		$this->region = $region;
		return $this;
	}
	
}

