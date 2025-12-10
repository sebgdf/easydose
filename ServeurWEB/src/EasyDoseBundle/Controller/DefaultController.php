<?php

namespace EasyDoseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use FOS\UserBundle\Controller\SecurityController;


class DefaultController extends SecurityController
{
	
	protected $tokenManager;
	
	public function testStatistiquesAction(){
	    return $this->render('EasyDoseBundle:Statistiques:pyramide_age.html.twig');
	}
	
	public function __construct(CsrfTokenManagerInterface $tokenManager = null)
	{
		parent::__construct($tokenManager);
	}

	/**
	 * @param Request $request
	 *
	 * @return Response
	 */
    public function indexAction(Request $request)
    {
    	/** @var $session Session */
    	$session = $request->getSession();
    	
    	$authErrorKey = Security::AUTHENTICATION_ERROR;
    	$lastUsernameKey = Security::LAST_USERNAME;
    	
    	// get the error if any (works with forward and redirect -- see below)
    	if ($request->attributes->has($authErrorKey)) {
    		$error = $request->attributes->get($authErrorKey);
    	} elseif (null !== $session && $session->has($authErrorKey)) {
    		$error = $session->get($authErrorKey);
    		$session->remove($authErrorKey);
    	} else {
    		$error = null;
    	}
    	
    	if (!$error instanceof AuthenticationException) {
    		$error = null; // The value does not come from the security component.
    	}
    	
    	// last username entered by the user
    	$lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
    	
    	$csrfToken = $this->tokenManager
    	? $this->tokenManager->getToken('authenticate')->getValue()
    	: null;
    	
    	
    	$csrfToken=$this->container->get("security.csrf.token_manager")->getToken('authenticate')->getValue();
    	return $this->renderLogin(array(
    			'last_username' => $lastUsername,
    			'error' => $error,
    			'csrf_token' => $csrfToken,
    	));
       // return $this->render('EasyDoseBundle:Default:logineasydose.html.twig');
       
    }
    
    
    
    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return Response
     */
    protected function renderLogin(array $data)
    {
    	return $this->render('EasyDoseBundle:Default:logineasydose.html.twig', $data);
    }
    
    
}
