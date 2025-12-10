<?php

namespace CoreBundle\Entity\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

trait Timestampable {

    ///**
    // * @Gedmo\Timestampable(on="create")
    // */
    #[Gedmo\Timestampable(on:"create")]
    #[ORM\Column(name:"created", nullable:false, options:["default"=> "CURRENT_TIMESTAMP"])]

    private ? \DateTime $created;

    public function __construct()
    {
        $this->created = new \DateTime(datetime: "now");
    }

    ///**
    // * @Gedmo\Timestampable(on="update")
    //*/
    #[Gedmo\Timestampable(on:"update")]
    #[ORM\Column(name:"updated", nullable:true)]

    private ? \DateTime $updated;

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return object
     */
    public function setCreated($created)
    {
        //$this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return object
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

}