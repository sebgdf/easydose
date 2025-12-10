<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NbNrdByProto
 *
 * @ORM\Table(name="nb_nrd_by_proto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NbNrdByProtoRepository")
 */
class NbNrdByProto
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
     * @var string
     *
     * @ORM\Column(name="modalite", type="string", length=512)
     */
    private $modalite;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=512)
     */
    private $type;
    
    /**
     * @var int
     *
     * @ORM\Column(name="nombre", type="integer")
     */
    private $nombre;


    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getModalite()
    {
        return $this->modalite;
    }

    /**
     * @param string $modalite
     */
    public function setModalite($modalite)
    {
        $this->modalite = $modalite;
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
     * Set protocole
     *
     * @param string $protocole
     *
     * @return NbNrdByProto
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
     * Set nombre
     *
     * @param integer $nombre
     *
     * @return NbNrdByProto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return int
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}

