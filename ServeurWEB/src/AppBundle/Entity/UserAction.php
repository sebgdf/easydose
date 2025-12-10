<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAction
 *
 * @ORM\Table(name="user_action")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserActionRepository")
 */
class UserAction
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
     * @ORM\Column(name="page", type="string", length=255)
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=true)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="parameter1", type="string", length=255, nullable=true)
     */
    private $parameter1;

    /**
     * @var string
     *
     * @ORM\Column(name="parameter2", type="string", length=255, nullable=true)
     */
    private $parameter2;

    /**
     * @var string
     *
     * @ORM\Column(name="parameter3", type="string", length=255 , nullable=true)
     */
    private $parameter3;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="createur", referencedColumnName="id")
     * */
    
    private $user;
    
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    
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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
     * Set page
     *
     * @param string $page
     *
     * @return UserAction
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return UserAction
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set parameter1
     *
     * @param string $parameter1
     *
     * @return UserAction
     */
    public function setParameter1($parameter1)
    {
        $this->parameter1 = $parameter1;

        return $this;
    }

    /**
     * Get parameter1
     *
     * @return string
     */
    public function getParameter1()
    {
        return $this->parameter1;
    }

    /**
     * Set parameter2
     *
     * @param string $parameter2
     *
     * @return UserAction
     */
    public function setParameter2($parameter2)
    {
        $this->parameter2 = $parameter2;

        return $this;
    }

    /**
     * Get parameter2
     *
     * @return string
     */
    public function getParameter2()
    {
        return $this->parameter2;
    }

    /**
     * Set parameter3
     *
     * @param string $parameter3
     *
     * @return UserAction
     */
    public function setParameter3($parameter3)
    {
        $this->parameter3 = $parameter3;

        return $this;
    }

    /**
     * Get parameter3
     *
     * @return string
     */
    public function getParameter3()
    {
        return $this->parameter3;
    }
}

