<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluationRepository")
 */
class Evaluation
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
     * @ORM\Column(name="valeur", type="integer")
     */
    private $valeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=500)
     */
    private $commentaire;
    

    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Optimisationdosedetail",inversedBy="evaluation")
     * @ORM\JoinColumn(name="optimisationdosedetail_id", referencedColumnName="id", nullable=true)
     * */
    
    
    protected $optimisationdosedetail;
    

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
     * Set valeur
     *
     * @param integer $valeur
     *
     * @return Evaluation
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return int
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Evaluation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
	public function getCommentaire() {
		return $this->commentaire;
	}
	public function setCommentaire($commentaire) {
		$this->commentaire = $commentaire;
		return $this;
	}
	public function getOptimisationdosedetail() {
		return $this->optimisationdosedetail;
	}
	public function setOptimisationdosedetail($optimisationdosedetail) {
		$this->optimisationdosedetail = $optimisationdosedetail;
		return $this;
	}
	
}

