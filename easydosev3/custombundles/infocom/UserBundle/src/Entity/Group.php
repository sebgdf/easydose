<?php

namespace UserBundle\Entity;

use GroupBundle\Entity\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'user_group')]
class Group extends BaseGroup
{
    
    use \UserBundle\Entity\Traits\Group;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]
    protected $id;
    
    #[ORM\Column(name:"color", length:255, nullable:true)]
    protected ?string $color;
    
    #[ORM\Column(name:"name", length:180, nullable:false,unique:true)]
    protected string $name;
    public function __toString() : string
    {
        return (string) $this->getName();
    }

    public function __construct($name ='', $roles = array('ROLE_USER'))
    {
        $this->name = $name;
        $this->roles = $roles;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Group
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
}
