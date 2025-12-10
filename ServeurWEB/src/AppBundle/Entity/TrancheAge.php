<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrancheAge
 *
 * @ORM\Table(name="tranche_age")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrancheAgeRepository")
 */
class TrancheAge
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
     * @var int
     *
     * @ORM\Column(name="valmin", type="integer")
     */
    private $valmin;

    /**
     * @var string
     *
     * @ORM\Column(name="unitemin", type="string", length=255)
     */
    private $unitemin;

    /**
     * @var int
     *
     * @ORM\Column(name="valmax", type="integer")
     */
    private $valmax;

    /**
     * @var string
     *
     * @ORM\Column(name="unitemax", type="string", length=255)
     */
    private $unitemax;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="tranche", type="string", length=255)
     */
    private $tranche;


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
     * Set valmin
     *
     * @param integer $valmin
     *
     * @return TrancheAge
     */
    public function setValmin($valmin)
    {
        $this->valmin = $valmin;

        return $this;
    }

    /**
     * Get valmin
     *
     * @return int
     */
    public function getValmin()
    {
        return $this->valmin;
    }

    /**
     * Set unitemin
     *
     * @param string $unitemin
     *
     * @return TrancheAge
     */
    public function setUnitemin($unitemin)
    {
        $this->unitemin = $unitemin;

        return $this;
    }

    /**
     * Get unitemin
     *
     * @return string
     */
    public function getUnitemin()
    {
        return $this->unitemin;
    }

    /**
     * Set valmax
     *
     * @param integer $valmax
     *
     * @return TrancheAge
     */
    public function setValmax($valmax)
    {
        $this->valmax = $valmax;

        return $this;
    }

    /**
     * Get valmax
     *
     * @return int
     */
    public function getValmax()
    {
        return $this->valmax;
    }

    /**
     * Set unitemax
     *
     * @param string $unitemax
     *
     * @return TrancheAge
     */
    public function setUnitemax($unitemax)
    {
        $this->unitemax = $unitemax;

        return $this;
    }

    /**
     * Get unitemax
     *
     * @return string
     */
    public function getUnitemax()
    {
        return $this->unitemax;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return TrancheAge
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set tranche
     *
     * @param string $tranche
     *
     * @return TrancheAge
     */
    public function setTranche($tranche)
    {
        $this->tranche = $tranche;

        return $this;
    }

    /**
     * Get tranche
     *
     * @return string
     */
    public function getTranche()
    {
        return $this->tranche;
    }
}

