<?php
namespace EasyDoseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class OptimisationController extends Controller
{

    
    public function showListTypeExamsAction($type){
        $dd_repo=$this->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle\Entity\detail_dose');
        
        if($type=='scanner')
            $protocoles=$dd_repo->getprotocolescanner();
        if($type=='mammo')
            $protocoles=$dd_repo->getprotocolemamo();
        if($type=='radio')
            $protocoles=$dd_repo->getprotocoleradio();
        
       return $this->render('EasyDoseBundle:portlet/optimdosimetrique/helper:liste_proto_by_exams.html.twig',[
           'protocoles' =>$protocoles
            ]);
    }
    public function BestCommentAction($optimid){
        $em=$this->getDoctrine()->getManager();
        
        $evaluation=$em->getRepository('AppBundle\Entity\Optimisationdose')->getBestComment($optimid);
        $cnt=$em->getRepository('AppBundle\Entity\Optimisationdose')->getNbNotes($optimid);
        return $this->render('EasyDoseBundle:portlet/optimdosimetrique:desc_note.html.twig',[
            'bestevaluation' =>$evaluation[0],
            'nombrenotes' =>$cnt[0]
        ]);
    }
    
    public function deleteOptimAction($optimid){
        $response = new Response();
        try {            
            $em=$this->getDoctrine()->getManager();
            $optim=$em->find('AppBundle\Entity\Optimisationdose', $optimid);
            $em->remove($optim);
            $em->flush();
            
            
            $response->setContent(json_encode([
                'delete_done' =>true,
                'id_optim_updated' => $optimid
                
            ]));
        } catch (\Exception $e) {
            $response->setContent(json_encode([
                'delete_done' =>false,
                'exception' =>$e->getMessage(),
                'optim_id' =>$optimid
            ]));
        }
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function saveOptimValueAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $optim_id=$request->get('optimid');
        $valuename=$request->get('valuename');
        $value=$request->get('value');
        

        $response = new Response();
        try {
                
                $optimisation=$em->find('AppBundle\Entity\Optimisationdose', $optim_id);
                $setFunctionName='set'.ucfirst($valuename);
                $optimisation->$setFunctionName($value);
                $em->persist($optimisation);
                $em->flush();

                $response->setContent(json_encode([
                    'update_done' =>true,
                    'id_optim_updated' => $optim_id,
                    'value' =>$value
                ]));
         } catch (\Exception $e) {
                $response->setContent(json_encode([
                    'update_done' =>false,
                    'exception' =>$e->getMessage(),
                    'value' =>$value,
                    'optim_id' =>$optim_id
                ]));
         }
         $response->headers->set('Content-Type', 'application/json');
         return $response;
    }
}
	
