<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Controller\BootstrapTablereturn;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DoseRepository;


use App\Controller\Utils;
final class PatientController extends AbstractController
{
    /**
    * @Route("/patient", name="app_patient")
    */
    #[Route('/patient', name: 'app_patient')]
    public function index(Request $request): Response
    {
        $parameters='';
        foreach($request->query->all() as $key=>$param){
            if($key!='url' && $key!='limit' && $key!='offset')
                $parameters=($parameters=='')? "$key=$param"  : $parameters."&$key=$param";
        }
      
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
            'parameters' => $parameters,
            'jsonpatientspathname' =>'getpatientslight',
            'jsonprotocolespathname' =>'getallprotocoles',
            'jsonlocationhost' =>'easydosev2:81'
        ]);
    }

 
    #[Route('/getpatients', name: 'app_getpatients')]
    public function getallpatient(Request $request,$entityManager): JsonResponse{
        $utils=new Utils();
        return $utils->foundpatient($request,$entityManager);
    }

    #[Route('/getallprotocoles', name: 'app_getallprotocoles')]
    public function getallprotocoles(Request $request,$entityManager, DoseRepository $doseRepository): JsonResponse{
        $utils=new Utils();
        return $utils->getallprotocoles($request,$entityManager, $doseRepository);
        /*return $this->json([
            'filtered_by_modalites' => $modalites,
            'protocols' => $protocols,
            'count' => count($protocols),
        ]);*/
     }

    #[Route('/getpatientslight', name: 'app_getpatientslight')]
    public function getallpatientlight(Request $request,$entityManager): JsonResponse{
        $utils=new Utils();
        return $utils->foundpatientlight($request,$entityManager);
    }

    #[Route('/getpatient', name: 'app_getpatient')]
    public function getpatient(Request $request,$entityManager): JsonResponse{
        $utils=new Utils();
        return $utils->foundpatient($request,$entityManager);
    }
}
