<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User as User;
use Symfony\Component\Serializer\Attribute\MaxDepth;
/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoteRepository")
 */
#[ORM\Entity(repositoryClass:"App\Repository\NoteRepository")]
#[ORM\Table(name: 'note')]
class Note
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
     * @ORM\Column(name="contenu", type="string", length=500)
     */
    #[ORM\Column(name:"contenu", type:"string", length:500)]
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenote", type="datetime")
     */
    #[ORM\Column(name:"datenote")]
    private \DateTime $datenote;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Patient",inversedBy="note")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id", nullable=true)
     * */
    #[MaxDepth(1)]
    #[ORM\ManyToOne(targetEntity: Patient::class,inversedBy:"note")]
    #[ORM\JoinColumn(name: 'patient_id', referencedColumnName: 'id', nullable:true)]
    private $patient;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="createur", referencedColumnName="id", nullable=true)
     * */
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'createur', referencedColumnName: 'id', nullable:true)]
    protected $createur;
    
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Note
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set datenote
     *
     * @param \DateTime $datenote
     *
     * @return Note
     */
    public function setDatenote($datenote)
    {
        $this->datenote = $datenote;

        return $this;
    }

    /**
     * Get datenote
     *
     * @return \DateTime
     */
    public function getDatenote()
    {
        return $this->datenote;
    }
	public function getPatient() {
		return $this->patient;
	}
	public function setPatient($patient) {
		$this->patient = $patient;
		return $this;
	}
	public function getCreateur() {
		return $this->createur;
	}
	public function setCreateur($createur) {
		$this->createur = $createur;
		return $this;
	}
	
}

