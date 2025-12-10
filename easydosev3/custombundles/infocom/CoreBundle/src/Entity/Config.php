<?php

namespace CoreBundle\Entity;
use \UserBundle\Entity\Traits\Config as configtrait;
use CoreBundle\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name:"core_config")]
class Config
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]
    private $id;


    use configtrait;
    use Timestampable;

    ///**
    // * @var string
    // *
    // * @ORM\Column(name="name", type="string", length=255)
    // */
    #[ORM\Column(name:"name", type:"string", length:255)]
    private $name;

    public function __toString() : string
    {
        return (string) $this->getName();
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Config
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
}
