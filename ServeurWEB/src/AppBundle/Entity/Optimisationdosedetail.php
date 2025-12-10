<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Optimisationdosedetail
 *
 * @ORM\Table(name="optimisationdosedetail")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OptimisationdosedetailRepository")
 */
class Optimisationdosedetail
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
     * @ORM\Column(name="protocole", type="string", length=512)
     */
    private $protocole;

    /**
     * @var float
     *
     * @ORM\Column(name="kvp", type="float")
     */
    private $kvp;

    
    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=512)
     */
    private $commentaire;
    
    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="xraytubecurrent", type="float")
     */
    private $xraytubecurrent;

    /**
     * @var string
     *
     * @ORM\Column(name="modalite", type="string", length=512)
     */
    private $modalite;

    
    /**
     * @var int
     *
     * @ORM\Column(name="nbnotesmax", type="integer", length=512, nullable=true, options={"default" : 0})
     */
    private $nbnotesmax;
    
    /**
     * @var string
     *
     * @ORM\Column(name="machine", type="string", length=255)
     */
    private $machine;

    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Optimisationdose",inversedBy="optimisationdosedetail")
     * @ORM\JoinColumn(name="optimisationdose_id", referencedColumnName="id", nullable=true)
     * */
    

    protected $optimisationdose;
    

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Evaluation",mappedBy="optimisationdosedetail",cascade={"persist", "remove"})
     */
    
    protected $evaluation;
    
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
     * Set protocole
     *
     * @param string $protocole
     *
     * @return Optimisationdosedetail
     */
    public function setProtocole($protocole)
    {
        $this->protocole = $protocole;

        return $this;
    }

    /**
     * Get protocole
     *
     * @return string
     */
    public function getProtocole()
    {
        return $this->protocole;
    }

    /**
     * Set kvp
     *
     * @param float $kvp
     *
     * @return Optimisationdosedetail
     */
    public function setKvp($kvp)
    {
        $this->kvp = $kvp;

        return $this;
    }

    /**
     * Get kvp
     *
     * @return float
     */
    public function getKvp()
    {
        return $this->kvp;
    }

    /**
     * Set xraytubecurrent
     *
     * @param float $xraytubecurrent
     *
     * @return Optimisationdosedetail
     */
    public function setXraytubecurrent($xraytubecurrent)
    {
        $this->xraytubecurrent = $xraytubecurrent;

        return $this;
    }

    /**
     * Get xraytubecurrent
     *
     * @return float
     */
    public function getXraytubecurrent()
    {
        return $this->xraytubecurrent;
    }

    /**
     * Set modalite
     *
     * @param string $modalite
     *
     * @return Optimisationdosedetail
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
     * Set machine
     *
     * @param string $machine
     *
     * @return Optimisationdosedetail
     */
    public function setMachine($machine)
    {
        $this->machine = $machine;

        return $this;
    }

    /**
     * Get machine
     *
     * @return string
     */
    public function getMachine()
    {
        return $this->machine;
    }
	public function getOptimisationdose() {
		return $this->optimisationdose;
	}
	public function setOptimisationdose($optimisationdose) {
		$this->optimisationdose = $optimisationdose;
		return $this;
	}
	public function getNbnotesmax() {
		return $this->nbnotesmax;
	}
	public function setNbnotesmax($nbnotesmax) {
		$this->nbnotesmax = $nbnotesmax;
		return $this;
	}
	public function getEvaluation() {
		return $this->evaluation;
	}
	public function setEvaluation($evaluation) {
		$this->evaluation = $evaluation;
		return $this;
	}
	public function getCommentaire() {
		return $this->commentaire;
	}
	public function setCommentaire($commentaire) {
		$this->commentaire = $commentaire;
		return $this;
	}
	public function getValeur() {
		return $this->valeur;
	}
	public function setValeur($valeur) {
		$this->valeur = $valeur;
		return $this;
	}
	
	
	

	
}

