<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mails
 *
 * @ORM\Table(name="mails")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MailsRepository")
 */
class Mails
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
     * @ORM\Column(name="msg", type="string", length=1024)
     */
    private $msg;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;


    /**
     * @var int
     *
     * @ORM\Column(name="dicomfile", type="integer")
     */
    private $dicomfile;
    
    
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
     * Set object
     *
     * @param string $object
     *
     * @return Mails
     */
    public function setObject($object)
    {
        $this->obj = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->obj;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Mails
     */
    public function setMessage($message)
    {
        $this->msg = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->msg;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Mails
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
	public function getDicomfile() {
		return $this->dicomfile;
	}
	public function setDicomfile($dicomfile) {
		$this->dicomfile = $dicomfile;
		return $this;
	}
	
}

