<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Optimisationdose
 *
 * @ORM\Table(name="optimisationdose")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OptimisationdoseRepository")
 */
class Optimisationdose
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
     * @var string
     *
     * @ORM\Column(name="machine", type="string", length=255)
     */
    private $machine;

    

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Optimisationdosedetail",mappedBy="optimisationdose",cascade={"persist", "remove"})
     */
    
    
    private $optimisationdosedetail;
    

    
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
     * @return Optimisationdose
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
     * @return Optimisationdose
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
     * @return Optimisationdose
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
     * @return Optimisationdose
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
     * @return Optimisationdose
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
	public function getOptimisationdosedetail() {
		return $this->optimisationdosedetail;
	}
	public function setOptimisationdosedetail($optimisationdosedetail) {
		$this->optimisationdosedetail = $optimisationdosedetail;
		return $this;
	}
	public function getValeur() {
		return $this->valeur;
	}
	public function setValeur($valeur) {
		$this->valeur = $valeur;
		return $this;
	}
	public function getCommentaire() {
		return $this->commentaire;
	}
	public function setCommentaire($commentaire) {
		$this->commentaire = $commentaire;
		return $this;
	}
	
	
}

