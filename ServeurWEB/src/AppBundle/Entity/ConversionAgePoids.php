<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConversionAgePoids
 *
 * @ORM\Table(name="conversion_age_poids")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConversionAgePoidsRepository")
 */
class ConversionAgePoids
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
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float")
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="typeage", type="string", length=255)
     */
    private $typeage;
    
    
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
     * Set age
     *
     * @param integer $age
     *
     * @return ConversionAgePoids
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set poids
     *
     * @param float $poids
     *
     * @return ConversionAgePoids
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return float
     */
    public function getPoids()
    {
        return $this->poids;
    }
	public function getTypeage() {
		return $this->typeage;
	}
	public function setTypeage($typeage) {
		$this->typeage = $typeage;
		return $this;
	}
	
}

