<?php
namespace EasyDoseBundle\Service;
use AppBundle\Entity\UserAction;
use Doctrine\Common\Persistence\ManagerRegistry;
use CoreBundle\Twig\Security;

class UserActionService
{
    private $security;
    private $doctrine;
    
    function __construct(
        Security $security,
        ManagerRegistry $doctrine){
            $this->security=$security;
            $this->doctrine=$doctrine;
    }
    
    private function saveUserAction($page,$action,$rule,$parameter1 = NULL,$parameter2 = NULL,$parameter3 = NULL){
        
        $ConnectedUser = $this->security->getUser();
        $em=$this->doctrine->getManager();
        if($rule=='current'){
            $listeActionUsers=$em
            ->getRepository('AppBundle\Entity\UserAction')
            ->findBy(
                array('user' => $ConnectedUser,'type' =>$rule)
                );
        }else{
            $listeActionUsers=$em
            ->getRepository('AppBundle\Entity\UserAction')
            ->findBy(
                array('user' => $ConnectedUser,'page' =>$page,'type' =>$rule)
                );
        }
        if(count($listeActionUsers)>0)
            $useraction=$listeActionUsers[0];
        else
            $useraction= new  UserAction();
        $useraction->setPage($page);
        $useraction->setAction($action);
        $useraction->setParameter1($parameter1);
        $useraction->setParameter2($parameter2);
        $useraction->setParameter3($parameter3);
        $useraction->setUser($ConnectedUser);
        $useraction->setType($rule);
        $em->persist($useraction);
        $em->flush();
    }
    
    
    public function setCurrentEsrPage($idpage){
        $this->saveUserAction('esrpage','update','esroperation',$idpage);
        $this->saveUserAction('esrpage','update','current');
    }
    
    
    
    public function getCurrentEsrPage(){
        $ConnectedUser = $this->security->getUser();
        $em=$this->doctrine->getManager();
        $listeActionUsers=$em
        ->getRepository('AppBundle\Entity\UserAction')
        ->findBy(
            array('user' => $ConnectedUser,'page' =>'esrpage','type' =>'esroperation')
            );
        
        if(count($listeActionUsers)==0)
            return 0;
        else
            return $listeActionUsers[0]->getParameter1();
    }
    
    public function getCurrentPage(){
        $ConnectedUser = $this->get ( 'core.security' )->getUser ();
        $em=$this->getDoctrine()->getManager();
        $listeActionUsers=$em
        ->getRepository('AppBundle\Entity\UserAction')
        ->findBy(
            array('user' => $ConnectedUser,'type' =>'current')
            );
        if(count($listeActionUsers)==0)
            return null;
        else
            return $listeActionUsers[0];
    }
}

