<?php

namespace CoreBundle\Entity\Traits;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait UniqueSluggable
{

    /**
     * @var string
     * @Gedmo\Slug(fields={"name"}, updatable=false)
     * @ORM\Column(name="unique_slug", type="string", length=255, unique=true, nullable=true)
     */
    #[Gedmo\Slug(fields:"create", updatable:false)]
    #[ORM\Column(name:"unique_slug", type:"string", length:255, unique:true, nullable:true)]
    private $uniqueSlug;

    /**
     * Set slug
     *
     * @param string $uniqueSlug
     * @return object
     */
    public function setUniqueSlug($uniqueSlug)
    {
        $this->uniqueSlug = $uniqueSlug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getUniqueSlug()
    {
        return $this->uniqueSlug;
    }

}