<?php

namespace AppBundle\Controller;

use CoreBundle\Controller\AdminAjaxControllerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $path = $this->get("cms.template.hierarchy")->getBasePathShorcut();
        return $this->render("$path/layout:layout_no_header_footer.html.twig");
    }
    
   
    

    
}
