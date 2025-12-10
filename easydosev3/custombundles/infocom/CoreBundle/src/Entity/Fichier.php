<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * File
 * @Vich\Uploadable
 */
#[ORM\Entity]
#[ORM\Table(name:"core_file")]
#[Vich\Uploadable]
class Fichier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]

    private $id;


    /**
     *
     * @Vich\UploadableField(mapping="media", fileNameProperty="name")
     * @var File
     */
    #[Vich\UploadableField(mapping:"media", fileNameProperty:"name")]
    private $file;

    ///**
    // * @ORM\Column(type="string", length=255, nullable=true)
    // *
    // * @var string
    // */
    #[ORM\Column(name:"name", type:"string",length:255, nullable:true)]
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    #[ORM\Column(nullable:true)]
    private ? \DateTimeImmutable  $updatedAt;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString() : string
    {
        return (string) ($this->getName()) ? $this->getName() : $this->getId();
    }


    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Media
     */
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if ($file) {
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $imageName
     *
     * @return Media
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Fichier
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
