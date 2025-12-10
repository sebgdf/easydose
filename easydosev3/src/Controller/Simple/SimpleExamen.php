<?php

namespace App\Controller\Simple;
use App\Entity\Examen;
use App\Entity\Dose;
use App\Entity\Detail_dose;
class SimpleExamen
{
    private $id;
    private \DateTime $dateExamen;
    private $nomCabinet;
    private $manufacturermodelname;
    private $manufacturer;

    private $dose;

    private $detaildoses;
    
    public function __construct(Examen $examen){
        $this->id=$examen->getId();
        $this->dateExamen=$examen->getDateExamen();
        $this->nomCabinet=$examen->getNomCabinet();
        $this->manufacturermodelname=$examen->getManufacturermodelname();
        $this->manufacturer=$examen->getManufacturer();
        $this->detaildoses = array();
    }

    public function adddetailDose(Detail_dose $detaildose){
        $this->detaildoses[] = new  SimpleDetaildose($detaildose); 
    }

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
	
	

    /**
     * Get the value of dose
     */ 
    public function getDose()
    {
        return $this->dose;
    }

    /**
     * Set the value of dose
     *
     * @return  self
     */ 
    public function setDose(Dose $dose)
    {
        $this->dose = new SimpleDose($dose);

        return $this;
    }

    /**
     * Get the value of detaildoses
     */ 
    public function getDetaildoses()
    {
        return $this->detaildoses;
    }

    /**
     * Set the value of detaildoses
     *
     * @return  self
     */ 
    public function setDetaildoses($detaildoses)
    {
        $this->detaildoses = $detaildoses;

        return $this;
    }
}

