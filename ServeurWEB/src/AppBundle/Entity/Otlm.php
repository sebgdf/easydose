<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Otlm
 *
 * @ORM\Table(name="otlm")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OtlmRepository")
 */
class Otlm
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
     * @ORM\Column(name="obj", type="string", length=255)
     */
    private $obj;

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="string", length=255)
     */
    private $msg;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;


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
     * Set obj
     *
     * @param string $obj
     *
     * @return Otlm
     */
    public function setObj($obj)
    {
        $this->obj = $obj;

        return $this;
    }

    /**
     * Get obj
     *
     * @return string
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * Set msg
     *
     * @param string $msg
     *
     * @return Otlm
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Otlm
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}

