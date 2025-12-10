<?php
namespace EasyDoseBundle\Service;
use Doctrine\Common\Persistence\ManagerRegistry;
use CoreBundle\Twig\Security;
use \DateTime;
use \DateInterval;
use AppBundle\Entity\Esr;
use Symfony\Component\HttpFoundation\Response;

class Utils
{
    private $security;
    private $doctrine;
    
    function __construct(
        Security $security,
        ManagerRegistry $doctrine){
            $this->security=$security;
            $this->doctrine=$doctrine;
    }
    
    
    
    /**
     * $strDate1 (string) date au format Y-m-d
     * $strDate2 (string) date au format Y-m-d
     * return (array) liste des mois entre les deux dates
     */
    private function getMonth($strDate1,$strDate2){
        $date1 = new DateTime(date('Y-m-01',strtotime($strDate1)));
        
        
        $date2 = new DateTime(date('Y-m-01',strtotime($strDate2)));
        
        
        if($date1 <= $date2){
            $arr_mois = array();
            $arr_mois[] =  $date1->format('m');
            while($date1 < $date2){
                $date1->add(new DateInterval("P1M"));
                $arr_mois[] = $date1->format('m');
            }
        }else{
            echo "Erreur : Date1 est plus grand que Date2 !";
            $arr_mois = NULL;
        }
        return sizeof($arr_mois);
    }
    
    
    public function calculage($patient){
        //$age=$patient->getDatenaissance()->diff(new \DateTime())->format('%m');
        $uniteage="MOIS";
        $today=new \DateTime();
        $age=$this->getMonth($patient->getDatenaissance()->format('Y-m-d H:i:s'),$today->format('Y-m-d H:i:s'));
        return array("age" =>$age,"unite"=> $uniteage);
        
    }
    
    
    private function ConvertTransformeDateToFrench($time){
        $jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
        
        $mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
        
        $datefr = $jour[date("w",strtotime($time))]." ".date("d",strtotime($time))." ".$mois[date("n",strtotime($time))]." ".date("Y",strtotime($time));
        return $datefr;
    }
    
    public function setDetailDosehaveESR($detail_dose_id){
        $em=$this->doctrine->getManager();
        
        $detail_dose=$em->find('AppBundle\Entity\detail_dose', $detail_dose_id);
        $detail_dose->setEsrhavealerte(true);
        
        $em->persist($detail_dose);
        $em->flush();
    }
    public function saveEsrAutoAction($examenid,$nom_machine){
        $em=$this->doctrine->getManager();
        
        
        //declarant
        $nomdeclarant=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_resp_activite_nom'))[0]->getValeur();
        $prenomdeclarant=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_resp_activite_prenom'))[0]->getValeur();
        $fonctiondeclarant=1;
        $teldeclarant=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_resp_activite_tel'))[0]->getValeur();
        $emaildeclarant=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_resp_activite_emal'))[0]->getValeur();
        
        
        
        $examen=$em->find('AppBundle\Entity\Examen', $examenid);
        
        $dispostif=$em
        ->getRepository('AppBundle\Entity\Dispositif')
        ->findBy(
            array('denomination' => $nom_machine)
            );
        
        if($dispostif!=null && count($dispostif)>0)
            $dispositifid=$dispostif[0]->getId();
        else
            $dispositifid=1;
        //$region=$examen->getRegion();
        //$dose=$region->getRegiondose->getDose();
        $patient=$examen->getpatient();       //evenemnt significatif
        

        $datesurvenentevent=$this->ConvertTransformeDateToFrench($examen->getDateExamen()->format('d-m-Y'));
        $heuresurvenentevent="00:00";
        $datedetectionevent=$this->ConvertTransformeDateToFrench($examen->getDateExamen()->format('d-m-Y'));
        $heuredetectionevent="00:00";
        
        
        $circonstancedetect=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_circonstances_detection_auto'))[0]->getValeur();
        
        
        
        
        
        $idorigine=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_event_origin'))[0]->getValeur();
        $origine=$em->find('AppBundle\Entity\OrigineEsr',$idorigine);
        
        
        
        $agepersonne=floor($this->calculage($patient)["age"]/12);
        $sexepersonne=$patient->getSex();
        if($agepersonne>18)
            $consequencesimm=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_consequence_imm_adulte'))[0]->getValeur();
            else
                $consequencesimm=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_consequence_imm_pedia'))[0]->getValeur();
                $consequencespot=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_consequence_potentielles'))[0]->getValeur();
                
                
                
                $actionsconservatoires=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_action_conservatoires'))[0]->getValeur();
                $actionscorrectives=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_action_correctives'))[0]->getValeur();
                
                $user=$em->find('UserBundle\Entity\User', 1);
                $etat=$em->find('AppBundle\Entity\Etat', 2);
                $critere=$em->find('AppBundle\Entity\CritereEsr', 2);
                
                    $esr=new Esr();
                    $esr->setType('Automatique');
                    $etablissement=$this->doctrine
                    ->getManager()
                    ->getRepository('AppBundle\Entity\Etablissement')
                    ->findAll()[0];
                    $esr->setEtablissement($etablissement);
                    $esr->setEtat($etat);
                    
                    $esr->setNomDeclarant($nomdeclarant);
                    $esr->setPrenomDeclarant($prenomdeclarant);
                    $esr->setFonctionDeclarant($fonctiondeclarant);
                    $esr->setTelephoneDeclarant($teldeclarant);
                    $esr->setEmailDeclarant($emaildeclarant);
                    
                    $esr->setIdCritereDeclaration($critere);
                    $esr->setDateSurvenueESR($datesurvenentevent);
                    $esr->setHeureSurvenueESR($heuresurvenentevent);
                    $esr->setDateDetectionESR($datedetectionevent);
                    $esr->setHeureDetectionESR($heuredetectionevent);
                    
                    
                    $esr->setCirconstancesDetection($circonstancedetect);
                    $esr->setDispositif($dispositifid);
                    $esr->setOrigine($origine);
                    $esr->setAgePersonneConserne($agepersonne);
                    $esr->setSex($sexepersonne);
                    $esr->setConsequencereelleim($consequencesimm);
                    $esr->setConsequencepotentielle($consequencespot);
                    
                    $esr->setActionconservatoires($actionsconservatoires);
                    $esr->setActioncorrectives($actionscorrectives);
                    $esr->setExamen($examen);
                    
                    
                    $esr->setUser($user);
                    $em->persist($esr);
                    $em->flush();

    }
    
    
    public function loadAutocompleteData($entityName,$attrName,$attrvalue){
        $em=$this->doctrine->getManager();
        
        $result=$em->getRepository('AppBundle\Entity\\'.$entityName)->
        search($attrName,$attrvalue);
        $response = new Response();
        $response->setContent(json_encode(
            $result
        ));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }

}

