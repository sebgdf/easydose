<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * pourcentageNrdByMod
 *
 * @ORM\Table(name="pourcentage_nrd_by_mod")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\pourcentageNrdByModRepository")
 */
class pourcentageNrdByMod
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
     * @ORM\Column(name="modalite", type="string", length=512)
     */
    private $modalite;

    /**
     * @var int
     *
     * @ORM\Column(name="nbalert", type="integer")
     */
    private $nbalert;

    /**
     * @var int
     *
     * @ORM\Column(name="totalexam", type="integer")
     */
    private $totalexam;

    /**
     * @var float
     *
     * @ORM\Column(name="pourcentage", type="float")
     */
    private $pourcentage;

    
    
    /**
     * @var string
     *
     * @ORM\Column(name="trancheage", type="string", length=512)
     */
    private $trancheage;

    /**
     * @return string
     */
    public function getTrancheage()
    {
        return $this->trancheage;
    }

    /**
     * @param string $trancheage
     */
    public function setTrancheage($trancheage)
    {
        $this->trancheage = $trancheage;
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
     * Set modalite
     *
     * @param string $modalite
     *
     * @return pourcentageNrdByMod
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

    /**
     * Set nbalert
     *
     * @param integer $nbalert
     *
     * @return pourcentageNrdByMod
     */
    public function setNbalert($nbalert)
    {
        $this->nbalert = $nbalert;

        return $this;
    }

    /**
     * Get nbalert
     *
     * @return int
     */
    public function getNbalert()
    {
        return $this->nbalert;
    }

    /**
     * Set totalexam
     *
     * @param integer $totalexam
     *
     * @return pourcentageNrdByMod
     */
    public function setTotalexam($totalexam)
    {
        $this->totalexam = $totalexam;

        return $this;
    }

    /**
     * Get totalexam
     *
     * @return int
     */
    public function getTotalexam()
    {
        return $this->totalexam;
    }

    /**
     * Set pourcentage
     *
     * @param float $pourcentage
     *
     * @return pourcentageNrdByMod
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return float
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }
}

