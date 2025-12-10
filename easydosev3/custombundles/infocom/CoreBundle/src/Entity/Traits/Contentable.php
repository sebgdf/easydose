<?php

namespace CoreBundle\Entity\Traits;
use Doctrine\ORM\Mapping as ORM;
trait Contentable
{

   // /**
   //  * @var string
   //  * @ORM\Column(name="content", type="text", nullable=true)
   //  */
    #[ORM\Column(name:"content", type:"text", nullable:true)]
    private $content;

    #[ORM\Column(name:"content2", type:"text", nullable:true)]
    private $content2;

    #[ORM\Column(name:"content3", type:"text", nullable:true)]
    private $content3;
    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Contentable
     */
    public function setContent($content = null)
    {
        $this->content = $content;

        return $this;
    }
    
    public function getContent2()
    {
        return $this->content2;
    }

    /**
     * @param string $content
     * @return Contentable
     */
    public function setContent2($content = null)
    {
        $this->content2 = $content;

        return $this;
    }

    public function getContent3()
    {
        return $this->content3;
    }

    /**
     * @param string $content
     * @return Contentable
     */
    public function setContent3($content = null)
    {
        $this->content3 = $content;

        return $this;
    }
}