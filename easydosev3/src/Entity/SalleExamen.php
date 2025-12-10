<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SalleExamen
 *
 * @ORM\Table(name="salle_examen")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SalleExamenRepository")
 */
#[ORM\Entity]
#[ORM\Table(name:"salle_examen")]
class SalleExamen
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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    #[ORM\Column(name:"nom", type:"string", length:255)]
    private $nomSalle;

    
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examen",mappedBy="salleExament",cascade={"persist", "remove"})
     */
    #[ORM\OneToMany(targetEntity: Examen::class, mappedBy: 'salleExamen', cascade: ['persist', 'remove'])]
    protected $examen;
    

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
     * Set nomSalle
     *
     * @param string $nomSalle
     *
     * @return SalleExamen
     */
    public function setNomSalle($nomSalle)
    {
        $this->nomSalle = $nomSalle;

        return $this;
    }

    /**
     * Get nomSalle
     *
     * @return string
     */
    public function getNomSalle()
    {
        return $this->nomSalle;
    }
	public function getExamen() {
		return $this->examen;
	}
	public function setExamen($examen) {
		$this->examen = $examen;
		return $this;
	}
	
}

