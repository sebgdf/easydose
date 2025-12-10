<?php

namespace App\Controller\Simple;
use App\Entity\Note;
class SimpleNote
{
    private $id;
    private $contenu;
    private \DateTime $datenote;
    private $patient;
    protected $createur;

    public function __construct(Note $note){
        $this->Id=$note->getId();
        $this->Contenu=$note->getContenu();
        $this->Datenote=$note->getDatenote();
        $this->Createur=$note->getCreateur();
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id=$id;
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

