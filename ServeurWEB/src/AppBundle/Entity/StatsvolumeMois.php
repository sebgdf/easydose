<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatsvolumeMois
 *
 * @ORM\Table(name="statsvolume_mois")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatsvolumeMoisRepository")
 */
class StatsvolumeMois
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
     * @return StatsvolumeMois
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
     * @return StatsvolumeMois
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

