<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bodyparts
 *
 * @ORM\Table(name="bodyparts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BodypartsRepository")
 */
class Bodyparts
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
     * @ORM\Column(name="dcmname", type="string", length=255)
     */
    private $dcmname;

    /**
     * @var string
     *
     * @ORM\Column(name="easydosename", type="string", length=255)
     */
    private $easydosename;


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
     * Set dcmname
     *
     * @param string $dcmname
     *
     * @return Bodyparts
     */
    public function setDcmname($dcmname)
    {
        $this->dcmname = $dcmname;

        return $this;
    }

    /**
     * Get dcmname
     *
     * @return string
     */
    public function getDcmname()
    {
        return $this->dcmname;
    }

    /**
     * Set easydosename
     *
     * @param string $easydosename
     *
     * @return Bodyparts
     */
    public function setEasydosename($easydosename)
    {
        $this->easydosename = $easydosename;

        return $this;
    }

    /**
     * Get easydosename
     *
     * @return string
     */
    public function getEasydosename()
    {
        return $this->easydosename;
    }
}

