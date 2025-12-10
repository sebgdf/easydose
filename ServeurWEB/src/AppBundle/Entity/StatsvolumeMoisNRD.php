<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatsvolumeMoisNRD
 *
 * @ORM\Table(name="statsvolume_mois_n_r_d")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatsvolumeMoisNRDRepository")
 */
class StatsvolumeMoisNRD
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
     * @ORM\Column(name="mois", type="string", length=255)
     */
    private $mois;

    /**
     * @var int
     *
     * @ORM\Column(name="cnt", type="integer")
     */
    private $cnt;


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
     * Set mois
     *
     * @param string $mois
     *
     * @return StatsvolumeMoisNRD
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set cnt
     *
     * @param integer $cnt
     *
     * @return StatsvolumeMoisNRD
     */
    public function setCnt($cnt)
    {
        $this->cnt = $cnt;

        return $this;
    }

    /**
     * Get cnt
     *
     * @return int
     */
    public function getCnt()
    {
        return $this->cnt;
    }
}

