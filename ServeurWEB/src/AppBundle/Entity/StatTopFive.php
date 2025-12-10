<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatTopFive
 *
 * @ORM\Table(name="stat_top_five")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatTopFiveRepository")
 */
class StatTopFive
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
     * @ORM\Column(name="bodypart", type="string", length=512)
     */
    private $bodypart;

    /**
     * @var float
     *
     * @ORM\Column(name="difference", type="float")
     */
    private $difference;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=255)
     */
    private $unite;

    /**
     * @var string
     *
     * @ORM\Column(name="uniteseuil", type="string", length=255)
     */
    private $uniteseuil;

    /**
     * @var float
     *
     * @ORM\Column(name="nrdvaleur", type="float")
     */
    private $nrdvaleur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255)
     */
    private $sex;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;
    
    /**
     * @var int
     *
     * @ORM\Column(name="patientid", type="integer")
     */
    private $patientid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="modalite", type="string", length=255)
     */
    private $modalite;


    /**
     * @return number
     */
    public function getPatientid()
    {
        return $this->patientid;
    }

    /**
     * @param number $patientid
     */
    public function setPatientid($patientid)
    {
        $this->patientid = $patientid;
    }

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
     * Set bodypart
     *
     * @param string $bodypart
     *
     * @return StatTopFive
     */
    public function setBodypart($bodypart)
    {
        $this->bodypart = $bodypart;

        return $this;
    }

    /**
     * Get bodypart
     *
     * @return string
     */
    public function getBodypart()
    {
        return $this->bodypart;
    }

    /**
     * Set difference
     *
     * @param float $difference
     *
     * @return StatTopFive
     */
    public function setDifference($difference)
    {
        $this->difference = $difference;

        return $this;
    }

    /**
     * Get difference
     *
     * @return float
     */
    public function getDifference()
    {
        return $this->difference;
    }

    /**
     * Set valeur
     *
     * @param float $valeur
     *
     * @return StatTopFive
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return float
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set unite
     *
     * @param string $unite
     *
     * @return StatTopFive
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * Get unite
     *
     * @return string
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Set uniteseuil
     *
     * @param string $uniteseuil
     *
     * @return StatTopFive
     */
    public function setUniteseuil($uniteseuil)
    {
        $this->uniteseuil = $uniteseuil;

        return $this;
    }

    /**
     * Get uniteseuil
     *
     * @return string
     */
    public function getUniteseuil()
    {
        return $this->uniteseuil;
    }

    /**
     * Set nrdvaleur
     *
     * @param float $nrdvaleur
     *
     * @return StatTopFive
     */
    public function setNrdvaleur($nrdvaleur)
    {
        $this->nrdvaleur = $nrdvaleur;

        return $this;
    }

    /**
     * Get nrdvaleur
     *
     * @return float
     */
    public function getNrdvaleur()
    {
        return $this->nrdvaleur;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return StatTopFive
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return StatTopFive
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return StatTopFive
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return StatTopFive
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return StatTopFive
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

    /**
     * Set modalite
     *
     * @param string $modalite
     *
     * @return StatTopFive
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
}

