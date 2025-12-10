<?php

namespace UserBundle\Entity;

use CoreBundle\Entity\Traits\Contentable;
use UserBundle\Entity\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AppAssert;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;
use Monolog\Logger;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Approbation;
use UserBundle\Repository\UserRepository;
use UserBundle\Entity\Group;
use CoreBundle\Entity\Image;
use Doctrine\ORM\PersistentCollection;

// /***
// /**
// * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
// * @ORM\Table(name="user_user")
// * @AppAssert\UserPasswordCustom
//  ***/

/**
* @AppAssert\UserPasswordCustom
*/
#[ORM\Entity(repositoryClass:"UserBundle\Repository\UserRepository")]
#[ORM\Table(name: 'user_user')]
//#[AppAssert\UserPasswordCustom]
class User extends BaseUser
{

    use \UserBundle\Entity\Traits\User;

    use Contentable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]
    protected  $id ;

//    /**
//     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Group")
//     * @ORM\JoinTable(name="user_user_group",
//     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
//     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
//     * )
//     */
    
    #[ORM\JoinTable(name: 'user_user_group')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'group_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Group::class)]
    protected PersistentCollection $groups;

    ///**
    // * @ORM\OneToOne(targetEntity="CoreBundle\Entity\Image", cascade={"persist"})
    // *
    // */

    #[ORM\OneToOne(targetEntity: Image::class, cascade: ['persist'])]
    protected $avatar;
    

    ///**
    // * @var string
    // *
    // * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
   //  */
    #[ORM\Column(name:"firstname", type:"string", length:255, nullable:true)]
    protected ?string $firstname=null;

   // /**
   //  * @var string
    // *
    // * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
    // */
    #[ORM\Column(name:"lastname", type:"string", length:255, nullable:true)]
    protected ?string $lastname;

    /// **
    //  * @var string
    //  *
    //  * @ORM\Column(name="type", type="string", length=255, nullable=true)
    //  */
    #[ORM\Column(name:"type", type:"string", length:255, nullable:true)]
    protected ?string $type;

   // /**
   //  * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="notification", cascade={"persist", "remove"})
   //  */
   // private $user;



    public function __construct()
    {
    	parent::__construct();
        $this->enabled = true;
        $this->roles = ['ROLE_ADMIN'];
    }

    public function __toString() : string
    {
        return ($this->getFirstname() != '' && $this->getLastname() != '') ? (string) $this->getFirstname().' '.$this->getLastname() : (string) $this->getUsername();
    }

    /**
     * Set avatar
     *
     * @param \CoreBundle\Entity\Image $avatar
     *
     * @return User
     */
    public function setAvatar(\CoreBundle\Entity\Image $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \CoreBundle\Entity\Image
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return User
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
    public function getType(): string|null
    {
        return $this->type;
    }
    
    /**
     * Get groups
     *
     * @return \GroupBundle\Entity\Group
     */
    public function getGroups(): PersistentCollection    
    {
        return $this->groups;
    }
    
    
}
