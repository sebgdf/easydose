<?php

namespace EasyDoseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Intl\Data\Util\ArrayAccessibleResourceBundle;
use AppBundle\Entity\Parametre;
use AppBundle\Entity\Note;
use AppBundle\Entity\Optimisationdose;
use AppBundle\Entity\Optimisationdosedetail;
use AppBundle\Entity\Evaluation;
use AppBundle\Entity\StatTopFive;
use AppBundle\Entity\StatsvolumeMois;
use AppBundle\Entity\StatsvolumeMoisNRD;
use \DateTime;
use \DateInterval;
use AppBundle\Entity\Epingle;
use AppBundle\Entity\Pyramideage;
use AppBundle\Entity\Pyramideagepediatrie;
use AppBundle\Entity\Moynrdmod;
use AppBundle\Entity\Moynrdmodbyproto;
use AppBundle\Entity\StatProtocoles;
use AppBundle\Entity\pourcentageNrdByMod;
use AppBundle\Entity\NbNrdByProto;
use AppBundle\Entity\Pyramideageadulte;
use AppBundle\Entity\Evolutionprotocole;
use Exception;

class PatientController extends Controller
{
	/**
	 * @Route("/")
	 */
	public function indexAction()
	{
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findAll();

		$etablissement=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Etablissement')
		->findAll();
		
		$repousers=$this->getDoctrine()
		->getManager()
		->getRepository('UserBundle\Entity\User');
		$listusers=$repousers->getusersingroups(['MEDECIN','RADIOPHYSICIEN']);
		$droit="";
		$avatar="";
		$ConnectedUser = $this->container->get ( 'core.security')->getUser ();
		$Groupes = $ConnectedUser->getGroups ();
		if ($Groupes !== null)
			foreach ( $Groupes as $groupe ) {
				$droit = ucfirst(strtolower ( $groupe->getName () ));
				$avatar=$groupe->getAvatar();
				break;
			}
		
		
		return $this->render('EasyDoseBundle:Patient:main.html.twig',['etablissement'=> $etablissement[0], 'patients' => $listpatients, 'listdest' =>$listusers,'firstgroupe' => $droit,'avatar' => $avatar]);
	}
	
	

	
	
	private function getNbExamsRadio(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY="select count(id) as cnt from examen where region_id
	       in (select id from region where id in (select
	    distinct region_id from region_dose where dose_id in
	    (select distinct dose_id from detail_dose where modalite='SR' and unite like'%2%')))";	    
	    
	    
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	
	public function getStatMoyNrdModAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $moynrdmod=
	    $em->getRepository('AppBundle\Entity\Moynrdmod')
	    ->findAll();
	    
	    $label=array();
	    foreach($moynrdmod as $moy){
	        if(!in_array($moy->getDate(),$label))
	        {
	           array_push($label, $moy->getDate());
	        }
	    }
	    
	    return $this->render('EasyDoseBundle:Statistiques:Moynrdmod.html.twig',[
	        'moynrdmod'=>$moynrdmod,
	        'label' =>$label
	    ]);
	    
	}
	
	public function getStatMoyNrdByProtoAction($modalite,$type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $moynrdbyproto=
	    $em->getRepository('AppBundle\Entity\Moynrdmodbyproto')
	    ->findBy(
	        array('modalite' => $modalite, 'type' =>$type)
	        );
	    
	    $protocoles=array();
	    foreach($moynrdbyproto as $moy){
	        if(!in_array($moy->getProtocole(),$protocoles))
	        {
	            array_push($protocoles, $moy->getProtocole());
	        }
	    }
	    
	    return $this->render('EasyDoseBundle:Statistiques:moynrdbyproto.html.twig',[
	        'moynrdbyproto'=>$moynrdbyproto,
	        'modalite' =>$modalite,
	        'protocoles' => $protocoles
	    ]);
	    
	}
	
	
	public function getStatMoyNrdByProtoLargerAction($modalite,$type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $moynrdbyproto=
	    $em->getRepository('AppBundle\Entity\Moynrdmodbyproto')
	    ->findBy(
	        array('modalite' => $modalite,'type' =>$type)
	        );
	    
	    $protocoles=array();
	    foreach($moynrdbyproto as $moy){
	        if(!in_array($moy->getProtocole(),$protocoles))
	        {
	            array_push($protocoles, $moy->getProtocole());
	        }
	    }
	    
	    return $this->render('EasyDoseBundle:Statistiques:moynrdbyproto_larger.html.twig',[
	        'moynrdbyproto'=>$moynrdbyproto,
	        'modalite' =>$modalite,
	        'protocoles' => $protocoles
	    ]);
	    
	}
	
	public function insertstatMoNrdByProtoAction($type,$isfirst){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    if ($isfirst=='true'){
	       $connection= $em->getConnection();
	       $platform= $connection->getDatabasePlatform();
	       $connection->executeUpdate($platform->getTruncateTableSQL('moynrdmodbyproto',true));
	    }
	    $stats=$this->getstatMoyenneDepNrdRadio($type);
	    foreach ( $stats as $Stat ) {
	        
	        $moynrdmodbyproto= new Moynrdmodbyproto();
	        $moynrdmodbyproto->setValeur($Stat["valeur"]);
	        $moynrdmodbyproto->setProtocole($this->onspace($Stat["protocole"]));
	        $moynrdmodbyproto->setModalite("RADIOGRAPHIE");
	        $moynrdmodbyproto->setNrd($Stat["nrd"]);
	        $moynrdmodbyproto->setType($type);
	        $em->persist($moynrdmodbyproto);
	        
	    }
	    
	    $stats=$this->getstatMoyenneDepNrdScanner($type);
	    foreach ( $stats as $Stat ) {
	        
	        $moynrdmodbyproto= new Moynrdmodbyproto();
	        $moynrdmodbyproto->setValeur($Stat["valeur"]);
	        $moynrdmodbyproto->setProtocole($this->onspace($Stat["protocole"]));
	        $moynrdmodbyproto->setModalite("SCANNER");
	        $moynrdmodbyproto->setNrd($Stat["nrd"]);
	        $moynrdmodbyproto->setType($type);
	        $em->persist($moynrdmodbyproto);
	        
	        
	        
	    }
	    
	    $stats=$this->getstatMoyenneDepNrdMammo();
	    foreach ( $stats as $Stat ) {
	        
	        $moynrdmodbyproto= new Moynrdmodbyproto();
	        $moynrdmodbyproto->setValeur($Stat["valeur"]);
	        $moynrdmodbyproto->setProtocole($this->onspace($Stat["protocole"]));
	        $moynrdmodbyproto->setModalite("MAMMOGRAPHIE");
	        $moynrdmodbyproto->setNrd($Stat["nrd"]);
	        $moynrdmodbyproto->setType($type);
	        $em->persist($moynrdmodbyproto);        
	        
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'updateMoynrdmodbyproto' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	    
	}
	
	
	private function getstatMoyenneDepNrdRadio($type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    if($type=='ADULTE'){
	    $RAW_QUERY=
        	"select * from (
            select
            avg(valeur) valeur,
            
            type as protocole,
            nrd
            from
            	(
            		select
            		case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.nrdvaleur 
            		end as nrd,
	               case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.valeur 
            		end as valeur,


        			case
        				when  (dd.trancheage = '') or (dd.trancheage is null) or (dd.trancheage='ADULTE') then dd.protocole
        				else  concat(dd.protocole,'_',dd.trancheage)
        						
        			end as type,


			(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
            		from
            		     detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
  			where dd.modalite='SR' and dd.unite like'%2%' and dd.nrdhavealerte!=0
            	) as tb1 where tb1.age>15
            group by type,nrd) as tb1 where valeur !=0";
	
	    }
	    
	    if($type=='PEDIATRIE'){
	        $RAW_QUERY=
	        "select * from (
            select
            avg(valeur) valeur,
	            
            type as protocole,
            nrd
            from
            	(
            		select
            		case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.nrdvaleur
            		end as nrd,
	               case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.valeur
            		end as valeur,
            		case
        				when  (dd.trancheage = '') or (dd.trancheage is null) or (dd.trancheage='ADULTE') then dd.protocole
        				else  concat(dd.protocole,'_',dd.trancheage)
        						
        			end as type,
			(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
            		from
            		     detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
  			where dd.modalite='SR' and dd.unite like'%2%' and dd.nrdhavealerte!=0
            	) as tb1 where tb1.age<=15
            group by type,nrd) as tb1 where valeur !=0";
	        
	    }
	    

	    if($type=='ALL'){
	        $RAW_QUERY=
	        "select * from (
            select
            avg(valeur) valeur,
	            
            type as protocole,
            nrd
            from
            	(
            		select
            		case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.nrdvaleur
            		end as nrd,
	               case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.valeur
            		end as valeur,
            		case
        				when  (dd.trancheage = '') or (dd.trancheage is null) or (dd.trancheage='ADULTE') then dd.protocole
        				else  concat(dd.protocole,'_',dd.trancheage)
        						
        			end as type,
			(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
            		from
            		     detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
  			where dd.modalite='SR' and dd.unite like'%2%' and dd.nrdhavealerte!=0
            	) as tb1
            group by type,nrd) as tb1 where valeur !=0";
	        
	    }
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	        $statement->execute();
	        return $statement->fetchAll();
	        
	}
	
	
	private function getstatMoyenneDepNrdScanner($type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    if($type=='ADULTE'){
	    $RAW_QUERY=
	    "select * from (
            select
            avg(valeur) valeur,
            
            type as protocole,
            nrd
            from
            	(
            		select
            		case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.nrdvaleur 
            		end as nrd,
	               case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.valeur 
            		end as valeur,
            		case
        				when  (dd.trancheage = '') or (dd.trancheage is null) or (dd.trancheage='ADULTE') then dd.protocole
        				else  concat(dd.protocole,'_',dd.trancheage)
        						
        			end as type,
			(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
            		from
            		     detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
  			where dd.modalite='SR' and dd.unite not like'%2%' and dd.nrdhavealerte!=0
            	) as tb1 where tb1.age>15
            group by type,nrd) as tb1 where valeur !=0;";
	    
	    }
	    
	    
	    if($type=='PEDIATRIE'){
	        $RAW_QUERY=
	        "select * from (
            select
            avg(valeur) valeur,
	            
            type as protocole,
            nrd
            from
            	(
            		select
            		case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.nrdvaleur
            		end as nrd,
	               case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.valeur
            		end as valeur,
            		case
        				when  (dd.trancheage = '') or (dd.trancheage is null) or (dd.trancheage='ADULTE') then dd.protocole
        				else  concat(dd.protocole,'_',dd.trancheage)
        						
        			end as type,
			(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
            		from
            		     detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
  			where dd.modalite='SR' and dd.unite not like'%2%' and dd.nrdhavealerte!=0
            	) as tb1 where tb1.age<=15
            group by type,nrd) as tb1 where valeur !=0;";
	        
	    }
	    
	    if($type=='ALL'){
	        $RAW_QUERY=
	        "select * from (
            select
            avg(valeur) valeur,
	            
            type as protocole,
            nrd
            from
            	(
            		select
            		case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.nrdvaleur
            		end as nrd,
	               case
            			when  dd.nrdhavealerte=0 then 0
            			else
            			dd.valeur
            		end as valeur,
            		case
        				when  (dd.trancheage = '') or (dd.trancheage is null) or (dd.trancheage='ADULTE') then dd.protocole
        				else  concat(dd.protocole,'_',dd.trancheage)
        						
        			end as type,
			(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
            		from
            		     detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
  			where dd.modalite='SR' and dd.unite not like'%2%' and dd.nrdhavealerte!=0
            	) as tb1
            group by type,nrd) as tb1 where valeur !=0;";
	        
	    }
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	
	private function getstatMoyenneDepNrdMammo(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    
	    $RAW_QUERY=
	    "select * from (
            select
            avg(valeur) valeur,
            
            type as protocole,
            nrd
            from
            	(
            		select
            		case
            			when  nrdhavealerte=0 then 0
            			else
            			nrdvaleur
            		end as nrd,
	               case
            			when  nrdhavealerte=0 then 0
            			else
            			valeur
            		end as valeur,
            		case
        				when  (trancheage = '') or (trancheage is null) or (trancheage='ADULTE') then protocole
        				else  concat(protocole,'_',trancheage)
        						
        			end as type
            		from
            		detail_dose where modalite!='SR' and nrdhavealerte!=0
            	) as tb1
            group by type,nrd) as tb1 where valeur !=0;";
	    
	    
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	
	
	
	
	public function insertprotocoleListAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $connection= $em->getConnection();
	    $platform= $connection->getDatabasePlatform();
	    $connection->executeUpdate($platform->getTruncateTableSQL('stat_protocoles',true));
	    $stats=$this->getprotocoleList('ADULTE');
	    foreach ( $stats as $Stat ) {
	        
	        $statProtocoles= new StatProtocoles();
	        $statProtocoles->setModalite($Stat["type"]);
	        $statProtocoles->setProtocole($this->onspace($Stat["protocole"]));
	        $statProtocoles->setUnite($Stat["unite"]);
	        $statProtocoles->setValeur($Stat["valeur"]);
	        $statProtocoles->setNbbodypart($Stat["nbbodypart"]);
	        $statProtocoles->setType('ADULTE');
	        $em->persist($statProtocoles);
	        
	    }
	    $stats=$this->getprotocoleList('PEDIATRIE');
	    foreach ( $stats as $Stat ) {
	        
	        $statProtocoles= new StatProtocoles();
	        $statProtocoles->setModalite($Stat["type"]);
	        $statProtocoles->setProtocole($this->onspace($Stat["protocole"]));
	        $statProtocoles->setUnite($Stat["unite"]);
	        $statProtocoles->setValeur($Stat["valeur"]);
	        $statProtocoles->setNbbodypart($Stat["nbbodypart"]);
	        $statProtocoles->setType('PEDIATRIE');
	        $em->persist($statProtocoles);
	        
	    }
	    $stats=$this->getprotocoleList('ALL');
	    foreach ( $stats as $Stat ) {
	        
	        $statProtocoles= new StatProtocoles();
	        $statProtocoles->setModalite($Stat["type"]);
	        $statProtocoles->setProtocole($this->onspace($Stat["protocole"]));
	        $statProtocoles->setUnite($Stat["unite"]);
	        $statProtocoles->setValeur($Stat["valeur"]);
	        $statProtocoles->setNbbodypart($Stat["nbbodypart"]);
	        $statProtocoles->setType('ALL');
	        $em->persist($statProtocoles);
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'updateStat_protocoles' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	}
	
	public function insertstatMoNrdAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $connection= $em->getConnection();
	    $platform= $connection->getDatabasePlatform();
	    $connection->executeUpdate($platform->getTruncateTableSQL('moynrdmod',true));
	    $stats=$this->getstatMoyenneDepNrd();
	    foreach ( $stats as $Stat ) {
	        
	        $moynrdmod= new Moynrdmod();
	        $moynrdmod->setValeur($Stat["valeur"]);
	        $moynrdmod->setModalite($Stat["modalite"]);
	        $moynrdmod->setDate($Stat["date"]);
	        $em->persist($moynrdmod);
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'updateMoynrdmod' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	    
	}
	
	
	public function getStatevolutionProtoAction(Request $request){
	    
	    $protocole=htmlspecialchars_decode($request->get('protocole'));
	    $type=$request->get('type');
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $evolutionprotocole=
	    $em->getRepository('AppBundle\Entity\Evolutionprotocole')
	    ->findBy(array('protocole' => $protocole,'type' => $type));
	    
	   
	    return $this->render('EasyDoseBundle:Statistiques:evolution_proto.html.twig',[
	        'evoproto'=>$evolutionprotocole,
	        'protocole' => $protocole
	    ]);
	    
	}
	public function insertevolutionProtoAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $connection= $em->getConnection();
	    $platform= $connection->getDatabasePlatform();
	    $connection->executeUpdate($platform->getTruncateTableSQL('evolutionprotocole',true));
	    $stats=$this->getevolutionprotocole('ALL');
	    foreach ( $stats as $Stat ) {
	        
	        $evolutionprotocole= new Evolutionprotocole();
	        $evolutionprotocole->setType("ALL");
	        $evolutionprotocole->setProtocole($Stat["protocole"]);
	        $evolutionprotocole->setDate($Stat["dt"]);
	        $evolutionprotocole->setCnt($Stat["cnt"]);
	        $em->persist($evolutionprotocole);
	        
	    }
	    $stats=$this->getevolutionprotocole('PEDIATRIE');
	    foreach ( $stats as $Stat ) {
	        
	        $evolutionprotocole= new Evolutionprotocole();
	        $evolutionprotocole->setType("PEDIATRIE");
	        $evolutionprotocole->setProtocole($Stat["protocole"]);
	        $evolutionprotocole->setDate($Stat["dt"]);
	        $evolutionprotocole->setCnt($Stat["cnt"]);
	        $em->persist($evolutionprotocole);
	        
	    }
	    $stats=$this->getevolutionprotocole('ADULTE');
	    foreach ( $stats as $Stat ) {
	        
	        $evolutionprotocole= new Evolutionprotocole();
	        $evolutionprotocole->setType("ADULTE");
	        $evolutionprotocole->setProtocole($Stat["protocole"]);
	        $evolutionprotocole->setDate($Stat["dt"]);
	        $evolutionprotocole->setCnt($Stat["cnt"]);
	        $em->persist($evolutionprotocole);
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'insertevolutionProto' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	    
	}
	
	private function getevolutionprotocole($type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    if($type=='PEDIATRIE'){
	        $RAW_QUERY= "
        select count(dte) as cnt,DATE_FORMAT(dte,'%d/%m/%Y') as dt,protocole from (select DATE_FORMAT(dd.date,'%Y/%m/%d') as dte,
        						  (DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age,
							    dd.protocole 
        						    from detail_dose dd inner join
        				 		     region_dose rd on rd.dose_id=dd.dose_id inner join
        						     region r on r.id=rd.region_id inner join
        						     examen e on e.region_id=r.id inner join
        						     patient p on p.id=e.patient_id
        ) as tb1 where tb1.age<=15 group by dte,protocole order by dte;
        ";
	    }
	    
	    if($type=='ADULTE'){
	        $RAW_QUERY="
        select count(dte) as cnt,DATE_FORMAT(dte,'%d/%m/%Y') as dt,protocole from (select DATE_FORMAT(dd.date,'%Y/%m/%d') as dte,
        						  (DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age,
							    dd.protocole 
        						    from detail_dose dd inner join
        				 		     region_dose rd on rd.dose_id=dd.dose_id inner join
        						     region r on r.id=rd.region_id inner join
        						     examen e on e.region_id=r.id inner join
        						     patient p on p.id=e.patient_id
        ) as tb1 where tb1.age>15 group by dte,protocole order by dte;
        ";
	    }
	        if($type=='ALL'){
	            $RAW_QUERY="
        select count(dte) as cnt,DATE_FORMAT(dte,'%d/%m/%Y') as dt,protocole from (select DATE_FORMAT(dd.date,'%Y/%m/%d') as dte,
        						  (DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age,
							    dd.protocole 
        						    from detail_dose dd inner join
        				 		     region_dose rd on rd.dose_id=dd.dose_id inner join
        						     region r on r.id=rd.region_id inner join
        						     examen e on e.region_id=r.id inner join
        						     patient p on p.id=e.patient_id
        ) as tb1 group by dte,protocole order by dte;
        ";

        }
    
    $statement=$em->getConnection()->prepare($RAW_QUERY);
    $statement->execute();
    return $statement->fetchAll();
	}
	
	private function getprotocoleList($type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    if($type=='PEDIATRIE'){
	    $RAW_QUERY="
	       select 
            avg(valeur) valeur,
            protocole,
            unite,
            type,
            sum(bodypart) nbbodypart
            from(
            		select 
                            avg(valeur) valeur,
                            protocole,
                            unite,
                            type,
            		count(body_part) bodypart
                            from 
                            (
                            	select 
                            		case
                            		  when  protocole like 'R%' and modalite='MG' then 'Sein Droit'
                            		  when  protocole like 'L%' and modalite='MG' then 'Sein Gauche'
                            		  else  protocole
                            		end as protocole,
                            		case
                            		    when modalite='SR' and unite like '%2%' then valeur * 100000
                            		    else valeur
                            		end as valeur,
                            		unite,
                             		case
                            		    when modalite<>'SR' then 'Mammographie'
                            		    when modalite='SR' and unite like '%2%' then 'Radiographie'
                            		    else 'Scanner'
                            		end as type,
            				body_part,
					(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
                            	from 
                            	     detail_dose dd inner join
		 		     region_dose rd on rd.dose_id=dd.dose_id inner join
				     region r on r.id=rd.region_id inner join
				     examen e on e.region_id=r.id inner join
				     patient p on p.id=e.patient_id
                            ) as tb1 where tb1.age<=15
                            group by protocole,unite,type ) as tb2 group by protocole,unite,type";
	    }
	    
	    if($type=='ADULTE'){
	        $RAW_QUERY="
	       select 
            avg(valeur) valeur,
            protocole,
            unite,
            type,
            sum(bodypart) nbbodypart
            from(
            		select 
                            avg(valeur) valeur,
                            protocole,
                            unite,
                            type,
            		count(body_part) bodypart
                            from 
                            (
                            	select 
                            		case
                            		  when  protocole like 'R%' and modalite='MG' then 'Sein Droit'
                            		  when  protocole like 'L%' and modalite='MG' then 'Sein Gauche'
                            		  else  protocole
                            		end as protocole,
                            		case
                            		    when modalite='SR' and unite like '%2%' then valeur * 100000
                            		    else valeur
                            		end as valeur,
                            		unite,
                             		case
                            		    when modalite<>'SR' then 'Mammographie'
                            		    when modalite='SR' and unite like '%2%' then 'Radiographie'
                            		    else 'Scanner'
                            		end as type,
            				body_part,
					(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
                            	from 
                            	     detail_dose dd inner join
		 		     region_dose rd on rd.dose_id=dd.dose_id inner join
				     region r on r.id=rd.region_id inner join
				     examen e on e.region_id=r.id inner join
				     patient p on p.id=e.patient_id
                            ) as tb1 where tb1.age>15
                            group by protocole,unite,type ) as tb2 group by protocole,unite,type";
	    }
	    
	    
	    if($type=='ALL'){
	        $RAW_QUERY="
	       select 
            avg(valeur) valeur,
            protocole,
            unite,
            type,
            sum(bodypart) nbbodypart
            from(
            		select 
                            avg(valeur) valeur,
                            protocole,
                            unite,
                            type,
            		count(body_part) bodypart
                            from 
                            (
                            	select 
                            		case
                            		  when  protocole like 'R%' and modalite='MG' then 'Sein Droit'
                            		  when  protocole like 'L%' and modalite='MG' then 'Sein Gauche'
                            		  else  protocole
                            		end as protocole,
                            		case
                            		    when modalite='SR' and unite like '%2%' then valeur  * 100000
                            		    else valeur
                            		end as valeur,
                            		unite,
                             		case
                            		    when modalite<>'SR' then 'Mammographie'
                            		    when modalite='SR' and unite like '%2%' then 'Radiographie'
                            		    else 'Scanner'
                            		end as type,
            				body_part,
					(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
                            	from 
                            	     detail_dose dd inner join
		 		     region_dose rd on rd.dose_id=dd.dose_id inner join
				     region r on r.id=rd.region_id inner join
				     examen e on e.region_id=r.id inner join
				     patient p on p.id=e.patient_id
                            ) as tb1
                            group by protocole,unite,type ) as tb2 group by protocole,unite,type";
	    }
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	
	public function insertNbAlertByProtocoleAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $connection= $em->getConnection();
	    $platform= $connection->getDatabasePlatform();
	    $connection->executeUpdate($platform->getTruncateTableSQL('nb_nrd_by_proto',true));
	    
	    $stats=$this->getNbAlertByProtocole('ALL');
	    foreach ( $stats as $Stat ) {
	        
	        $nbNrdByProto= new NbNrdByProto();
	        $nbNrdByProto->setProtocole($this->onspace($Stat["protocole"]));
	        $nbNrdByProto->setNombre($Stat["nombre"]);
	        $nbNrdByProto->setModalite($Stat["modalite"]);
	        $nbNrdByProto->setType('ALL');
	        $em->persist($nbNrdByProto);
	        
	    }
	    $stats=$this->getNbAlertByProtocole('PEDIATRIE');
	    foreach ( $stats as $Stat ) {
	        
	        $nbNrdByProto= new NbNrdByProto();
	        $nbNrdByProto->setProtocole($this->onspace($Stat["protocole"]));
	        $nbNrdByProto->setNombre($Stat["nombre"]);
	        $nbNrdByProto->setModalite($Stat["modalite"]);
	        $nbNrdByProto->setType('PEDIATRIE');
	        $em->persist($nbNrdByProto);
	        
	    }
	    $stats=$this->getNbAlertByProtocole('ADULTE');
	    foreach ( $stats as $Stat ) {
	        
	        $nbNrdByProto= new NbNrdByProto();
	        $nbNrdByProto->setProtocole($this->onspace($Stat["protocole"]));
	        $nbNrdByProto->setNombre($Stat["nombre"]);
	        $nbNrdByProto->setModalite($Stat["modalite"]);
	        $nbNrdByProto->setType('ADULTE');
	        
	        $em->persist($nbNrdByProto);
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'updatenbNrdByProto' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	    
	}
	
	
	
	
	public function getStatNbAlertByProtocoleAction($modalite,$type){
	    $em=$this->getDoctrine()
	    ->getManager();
	    $stat=$em->getRepository('AppBundle\Entity\NbNrdByProto')
	    ->findBy(
	        array('modalite' => $modalite,'type' => $type)
	        );	    
	    return $this->render('EasyDoseBundle:Statistiques:nb_nrd_by_proto.html.twig',['stat' => $stat]);
	    
	}
	

	public function getStatNbAlertByProtocolelargerAction($modalite,$type){
	    $em=$this->getDoctrine()
	    ->getManager();
	    $stat=$em->getRepository('AppBundle\Entity\NbNrdByProto')
	    ->findBy(
	        array('modalite' => $modalite,'type' => $type)
	        );
	    return $this->render('EasyDoseBundle:Statistiques:nb_nrd_by_proto_larger.html.twig',['stat' => $stat]);
	    
	}
	
	
	private function getNbAlertByProtocole($type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    if($type=='PEDIATRIE'){
	    $RAW_QUERY="
	      select  
            protocole,
            modalite,
            count(protocole) as nombre 
            from (
            	select 
            		case
        				when  (dd.trancheage = '') or (dd.trancheage is null) or (dd.trancheage='ADULTE') then dd.protocole
        				else  concat(dd.protocole,'_',dd.trancheage)
        						
        			end as protocole,
            		dd.valeur,
            		dd.nrdvaleur,
            		case
            		   when dd.modalite<>'SR' then 'MAMMOGRAPHIE'
            		   when dd.modalite='SR' and unite like '%2%' then 'RADIOGRAPHIE'
            		   else 'SCANNER'
            		end as modalite,
			   (DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age 
            	from detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
            		where dd.nrdhavealerte=1 or dd.esrhavealerte=1 
) as tb1 where tb1.age<=15 group by protocole,modalite;";}
	    
	    if($type=='ADULTE'){
	        $RAW_QUERY="
	      select  
            protocole,
            modalite,
            count(protocole) as nombre 
            from (
            	select 
            		dd.protocole,
            		dd.valeur,
            		dd.nrdvaleur,
            		case
            		   when dd.modalite<>'SR' then 'MAMMOGRAPHIE'
            		   when dd.modalite='SR' and unite like '%2%' then 'RADIOGRAPHIE'
            		   else 'SCANNER'
            		end as modalite,
			   (DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age 
            	from detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
            		where dd.nrdhavealerte=1 or dd.esrhavealerte=1 
) as tb1 where tb1.age>15 group by protocole,modalite;";}
	
	        
	        if($type=='ALL'){
	            $RAW_QUERY="
	      select
            protocole,
            modalite,
            count(protocole) as nombre
            from (
            	select
            		dd.protocole,
            		dd.valeur,
            		dd.nrdvaleur,
            		case
            		   when dd.modalite<>'SR' then 'MAMMOGRAPHIE'
            		   when dd.modalite='SR' and unite like '%2%' then 'RADIOGRAPHIE'
            		   else 'SCANNER'
            		end as modalite
            	from detail_dose dd inner join
	 		     region_dose rd on rd.dose_id=dd.dose_id inner join
			     region r on r.id=rd.region_id inner join
			     examen e on e.region_id=r.id inner join
			     patient p on p.id=e.patient_id
            		where dd.nrdhavealerte=1 or dd.esrhavealerte=1
) as tb1 group by protocole,modalite;";}
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	
	public function getPourDeptNrdModAction($modalite,$type){
	    $em=$this->getDoctrine()
	    ->getManager();
	    $stat=$em->getRepository('AppBundle\Entity\pourcentageNrdByMod')
	    ->findBy(
	        array('modalite' => $modalite, 'trancheage' =>$type)
	        );
	    
	    return $this->render('EasyDoseBundle:Statistiques:pourcentage_nrd.html.twig',['stat' => $stat[0]]);
	    
	}
	
	public function insertPourDeptNrdModAction($type,$isfirst){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    
	    if($isfirst=='true'){
	        $connection= $em->getConnection();
	        $platform= $connection->getDatabasePlatform();
	        $connection->executeUpdate($platform->getTruncateTableSQL('pourcentage_nrd_by_mod',true));
	    }
	    $stats=$this->getPourDeptNrdModalite($type);
	    foreach ( $stats as $Stat ) {
	        
	        $pourNrdByMod= new pourcentageNrdByMod();
	        $pourNrdByMod->setModalite($Stat["modalite"]);
	        $pourNrdByMod->setNbalert($Stat["nbalert"]);
	        $pourNrdByMod->setTotalexam($Stat["totalexam"]);
	        $pourNrdByMod->setPourcentage($Stat["pourcentage"]);
	        $pourNrdByMod->setTrancheage($type);
	        
	        $em->persist($pourNrdByMod);
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'updatepourcentage_nrd_by_mod' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	    
	}
	
	
	private function getPourDeptNrdModalite($type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    if($type=="ADULTE"){
	    
	    $RAW_QUERY=
        	"
        select 
        modalite,
        sumalert as nbalert,
        total as totalexam,
        ((sumalert*100)/total) as pourcentage
        from (

        select 
            modalite,
            sum(nrdhavealerte) sumalert,
            sum(cnt) total
            from(
        	select
        	case
        	   when dd.modalite<>'SR' then 'Mammographie'
        	   when dd.modalite='SR' and unite like '%2%' then 'Radiographie'
        	   else 'Scanner'
        	end as modalite,
        	dd.nrdhavealerte,
        	1 as cnt,
		(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age 
        	from detail_dose dd inner join
 		     region_dose rd on rd.dose_id=dd.dose_id inner join
		     region r on r.id=rd.region_id inner join
		     examen e on e.region_id=r.id inner join
		     patient p on p.id=e.patient_id
		     
		) as tb1 where tb1.age>15  group by modalite
	) as tb2";
	    }
	    
	    
	    if($type=="PEDIATRIE"){
	        
	        $RAW_QUERY=
	        "
                    select 
        modalite,
        sumalert as nbalert,
        total as totalexam,
        ((sumalert*100)/total) as pourcentage
        from (

        select 
            modalite,
            sum(nrdhavealerte) sumalert,
            sum(cnt) total
            from(
        	select
        	case
        	   when dd.modalite<>'SR' then 'Mammographie'
        	   when dd.modalite='SR' and unite like '%2%' then 'Radiographie'
        	   else 'Scanner'
        	end as modalite,
        	dd.nrdhavealerte,
        	1 as cnt,
		(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age 
        	from detail_dose dd inner join
 		     region_dose rd on rd.dose_id=dd.dose_id inner join
		     region r on r.id=rd.region_id inner join
		     examen e on e.region_id=r.id inner join
		     patient p on p.id=e.patient_id
		     
		) as tb1 where tb1.age<=15  group by modalite
	) as tb2";
	    }
	    
	    if($type=="ALL"){
	        
	        $RAW_QUERY=
	        "
                    select 
        modalite,
        sumalert as nbalert,
        total as totalexam,
        ((sumalert*100)/total) as pourcentage
        from (

        select 
            modalite,
            sum(nrdhavealerte) sumalert,
            sum(cnt) total
            from(
        	select
        	case
        	   when dd.modalite<>'SR' then 'Mammographie'
        	   when dd.modalite='SR' and unite like '%2%' then 'Radiographie'
        	   else 'Scanner'
        	end as modalite,
        	dd.nrdhavealerte,
        	1 as cnt,
		(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age 
        	from detail_dose dd inner join
 		     region_dose rd on rd.dose_id=dd.dose_id inner join
		     region r on r.id=rd.region_id inner join
		     examen e on e.region_id=r.id inner join
		     patient p on p.id=e.patient_id
		     
		) as tb1 group by modalite
	) as tb2";
	    }
	    
	    
	    
	    
        	$statement=$em->getConnection()->prepare($RAW_QUERY);
        	$statement->execute();
        	return $statement->fetchAll();
	}
	
	
	private function getstatMoyenneDepNrd(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    
	    $RAW_QUERY=
	    "select * from (
		select
            	avg(valeur) valeur,
            	type as modalite,
		date
            	from
            	(
            	    select
		        case
		    	    when  nrdhavealerte=0 then 0
			    when  modalite='SR' and unite like '%2%' then abs(valeur-nrdvaleur*10000000)
		    	    else  abs(valeur-nrdvaleur)
		    	end as valeur,
		        case
		    	    when modalite<>'SR' then 'Mammographie'
		    	    when modalite='SR' and unite like '%2%' then 'Radiographie'
		    	    else 'Scanner'
		    	end as type,
		    	concat(year(date), '/', month(date)) as date
            	    from
            	    detail_dose
            	    ) as tb1
        	    group by type,date) as tb2 order by date";
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	}
	
	private function getNbExamsScanner(){
	
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY="select count(id) as cnt from examen where region_id 
	       in (select id from region where id in (select  
	    distinct region_id from region_dose where dose_id in 
	    (select distinct dose_id from detail_dose where modalite='SR' and unite='mGy.cm')))";
	    
	    
	    
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();

	}
	
	
	private function getNbOptims(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    $RAW_QUERY="select count(*) as cnt from optimisationdose";	    
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	 
	
	public function setStatistiquesAction(){
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY="set global sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';";
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    $RAW_QUERY="set session sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';";
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    $repository=$em->getRepository('AppBundle\Entity\Patient');
	    $nbpatients=$repository->getNbPatient();
	    
	  //  $lastexams=$this->getLastExams(10);
	    
	    $repositoryExamen=$em->getRepository('AppBundle\Entity\Examen');
	    $nbexamens=$repositoryExamen->getNbExamens();  
	    
	    $ExamsRadio=$this->getNbExamsRadio()[0]['cnt'];
	    $ExamsScanner=$this->getNbExamsScanner()[0]['cnt'];
	    $ExamsMammo=$this->getNbExamsMammo()[0]['cnt'];	    
	    $examswithNRD=$this->getNbExamsWithNRD()[0]['cnt'];	
	    $nboptims=$this->getNbOptims()[0]['cnt'];
	  
	    
	    $etat=$em
	        ->getRepository('AppBundle\Entity\Etat')
	        ->findBy(
	            array('libelle' => 'Cloture')
	            );
	    

	    
	    $nbesr=count($em
	    ->getRepository('AppBundle\Entity\Esr')
	    ->findBy(
	            array('etat' => $etat)
	            ));
	  
	  
	   // $courbeexam=$this->getCourbeExams();
	    $top5NrdAll=$this->getaltopfiveNrd();
	    $connection= $em->getConnection();
	    $platform= $connection->getDatabasePlatform();
	    $connection->executeUpdate($platform->getTruncateTableSQL('stat_top_five',true));
	    $connection->executeUpdate($platform->getTruncateTableSQL('statsvolume_mois',true));
	    $connection->executeUpdate($platform->getTruncateTableSQL('statsvolume_mois_n_r_d',true));
	    $nbexamsByMonth=$this->getNBExamsByMonth();
	    

	    
	    foreach ( $nbexamsByMonth as $nbexamByMonth ) {
	        $statsvolumeMois=new StatsvolumeMois();
	        $statsvolumeMois->setMois($nbexamByMonth["mois"]);
	        $statsvolumeMois->setCnt($nbexamByMonth["cnt"]);
	        $em->persist($statsvolumeMois);
	    }
	    
	    $nbexamsByMonthNRD=$this->getNBExamsByMonthWithNRD();
	    foreach ( $nbexamsByMonthNRD as $nbexamByMonthNRD ) {
	        $statsvolumeMoisNRD=new StatsvolumeMoisNRD();
	        $statsvolumeMoisNRD->setMois($nbexamByMonthNRD["mois"]);
	        $statsvolumeMoisNRD->setCnt($nbexamByMonthNRD["cnt"]);
	        $em->persist($statsvolumeMoisNRD);
	    }
	    
    
	    foreach ( $top5NrdAll as $top5Nrd ) {
	        $top5 = new StatTopFive();
	        $top5->setAge($top5Nrd["age"]);
	        $top5->setBodypart($top5Nrd["body_part"]);	        
	        $top5->setDate(new \DateTime(($top5Nrd["date"])));
	        $top5->setDifference($top5Nrd["difference"]);
	        $top5->setModalite($top5Nrd["modalite"]);
	        $top5->setNom($top5Nrd["nom"]);
	        $top5->setNrdvaleur($top5Nrd["nrdvaleur"]);
	        $top5->setPrenom($top5Nrd["prenom"]);
	        $top5->setSex($top5Nrd["sex"]);
	        $top5->setUnite($top5Nrd["unite"]);
	        $top5->setUniteseuil($top5Nrd["uniteseuil"]);
	        $top5->setValeur($top5Nrd["valeur"]);
	        $top5->setPatientid($top5Nrd["patientid"]); 
	        $em->persist($top5);
	 
	    }
    
	    
	    $StatNbpatientsEntity=
	    $em->getRepository('AppBundle\Entity\Statistiques')
	    ->findAll();
	    foreach ( $StatNbpatientsEntity as $Stat ) {
	
	        if($Stat->getName()=='nbpatients' && $Stat->getType()=='dashboard')
	            $Stat->setValue($nbpatients);
	        if($Stat->getName()=='nbexamens' && $Stat->getType()=='dashboard')
	            $Stat->setValue($nbexamens);
	        if($Stat->getName()=='examswithNRD' && $Stat->getType()=='dashboard')
	            $Stat->setValue($examswithNRD);
	        if($Stat->getName()=='ExamsRadio' && $Stat->getType()=='dashboard')
	            $Stat->setValue($ExamsRadio);
	        if($Stat->getName()=='ExamsScanner' && $Stat->getType()=='dashboard')
	            $Stat->setValue($ExamsScanner);
	        if($Stat->getName()=='ExamsMammo' && $Stat->getType()=='dashboard')
	            $Stat->setValue($ExamsMammo);
	        if($Stat->getName()=='OptimDose' && $Stat->getType()=='dashboard')
	            $Stat->setValue($nboptims);
	        
	       if($Stat->getName()=='nbesr' && $Stat->getType()=='dashboard')
	           $Stat->setValue($nbesr);
	            
	            
	       $em->persist($Stat);
	    }
	    $em->flush();
	    return $this->render('EasyDoseBundle:Default:index.html.twig');
	    
	    
	}
	
	private function getNBExamsByMonth(){
	
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY="select DATE_FORMAT(date, \"%m/%Y\")  as mois,count(*) as cnt
	    from examen where date between date_sub(NOW(), 
	    INTERVAL 12 MONTH) and NOW() group by DATE_FORMAT(date, \"%m/%Y\") order by date;";
	
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	}
	
	private function onspace($string){
	    return preg_replace('/\s+/', ' ', $string);
	}
	
	private function getNBExamsByMonthWithNRD(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY="select DATE_FORMAT(date, \"%m/%Y\")  as mois,count(*) as cnt
	    from examen where date between date_sub(NOW(),
	    INTERVAL 12 MONTH) and NOW()
	    and region_id
	    in (select id from region where id in
	       (select  distinct region_id from region_dose where
	       dose_id in (select distinct dose_id from detail_dose where nrdhavealerte=1 and nrdvaleur<>0)))
	       group by  DATE_FORMAT(date, \"%m/%Y\") order by date ;";
	
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	}
	    
	private function  getValueOfMount($values,$month){

        foreach($values as $value){
            if($value->getMois()==$month)
                return $value->getCnt();
	    }
	    return 0;
	}
	
	
	
	public function getCourbeExamsAction(){
	    $courbexams=$this->getCourbeExams();   
	    return $this->render('EasyDoseBundle:Patient:courbe_accueil_1.html.twig',[
	        'courbeexam'=>$courbexams
	    ]);
	    
	}
	

	public function getCourbeExamsNRDAction(){
	    $courbexams=$this->getCourbeExamsNRD();
	    return $this->render('EasyDoseBundle:Patient:courbe_accueil_2.html.twig',[
	        'courbeexam'=>$courbexams
	    ]);
	    
	}
	
	public function top5Action(){
	    $em=$this->getDoctrine()
	    ->getManager();
	    $top5Nrd=
	    $em->getRepository('AppBundle\Entity\StatTopFive')
	    ->findAll();
	    return $this->render('EasyDoseBundle:Patient:accueil_top5.html.twig',[
	        'top5Nrd'=>$top5Nrd
	    ]);
	    
	}
	
	
	
	
	private function getCourbeExams(){
	    //$values=$this->getNBExamsByMonth();
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $values= $em->getRepository('AppBundle\Entity\StatsvolumeMois')
	    ->findAll();
	    return $values;
	}
	
	
	
	private function getCourbeExamsNRD(){
	    //$values=$this->getNBExamsByMonth();
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $values= $em->getRepository('AppBundle\Entity\StatsvolumeMoisNRD')
	    ->findAll();
	    
	     return $values;
	}
	
	private function getNbExamsMammo(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY="select count(id) as cnt from examen where region_id
	       in (select id from region where id in (select
	    distinct region_id from region_dose where dose_id in
	    (select distinct dose_id from detail_dose where modalite='MG')))";	    
	    
	    
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	
	
	
	
	private function getNbExamsWithNRD(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY="select count(id) as cnt from examen where region_id in (select distinct region_id from region_dose where dose_id in ( select distinct dose_id from detail_dose where nrdhavealerte=1 and nrdvaleur<>0))";
	    
	    
	    
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	
	private function getaltopfiveNrd(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY="(select distinct dd.body_part,(dd.valeur - dd.nrdvaleur) as difference, dd.valeur,dd.unite,
         dd.uniteseuil, dd.nrdvaleur, p.nom, p.prenom, p.sex, p.age,e.date,d.modalite,p.id as patientid from patient as 
         p inner join examen as e on p.id=e.patient_id inner join region_dose rd on rd.region_id=e.region_id 
         inner join dose d on d.id=rd.dose_id inner join detail_dose as dd on dd.dose_id=d.id where dd.nrdhavealerte=1 
         and dd.modalite='MG' order by (dd.valeur - dd.nrdvaleur) desc limit 5) union all 
         (select distinct  dd.body_part,(dd.valeur - dd.nrdvaleur) as difference, dd.valeur,dd.unite, dd.uniteseuil, 
         dd.nrdvaleur, p.nom, p.prenom, p.sex, p.age,e.date,d.modalite,p.id as patientid from patient as p inner join examen 
         as e on p.id=e.patient_id inner join region_dose rd on rd.region_id=e.region_id inner join dose d on 
         d.id=rd.dose_id inner join detail_dose as dd on dd.dose_id=d.id where dd.nrdhavealerte=1 and dd.modalite='SR'
         and dd.unite like '%2%' order by (dd.valeur - dd.nrdvaleur) desc   limit 5)  
         union all (select distinct  dd.body_part,(dd.valeur - dd.nrdvaleur) as difference, dd.valeur,dd.unite, dd.uniteseuil,
         dd.nrdvaleur, p.nom, p.prenom, p.sex, p.age,e.date,d.modalite,p.id as patientid from patient as p inner join examen as e
         on p.id=e.patient_id inner join region_dose rd on rd.region_id=e.region_id inner join dose d on d.id=rd.dose_id 
         inner join detail_dose as dd on dd.dose_id=d.id where dd.nrdhavealerte=1 and dd.modalite='SR' and dd.unite='mGy.cm'  
         order by (dd.valeur - dd.nrdvaleur) desc   limit 5)";
	    
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	}
	
	
	private function getLastExams($nb){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $RAW_QUERY=
	    "select distinct p.nom, p.prenom, p.sex, p.age,e.date,d.unite,d.modalite,e.id from patient as p inner join examen as e on p.id=e.patient_id 
         inner join region_dose rd on rd.region_id=e.region_id 
         inner join dose d on d.id=rd.dose_id order by e.id desc limit ".$nb;
    
	    
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	    
	}
	
	
	
	
	private function getstatPyramideAgeAdulte(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    
	    $RAW_QUERY="select 
                        sex,
                        tranche_age,
                        sum(nbr) as nombre,
                        ordre
                        from (
                        select 
                        sex,
                        case
                            WHEN (age>=0 and age <5) THEN 'O à 5'
                            WHEN (age>=5 and age <10) THEN '5 à 9'
                            WHEN (age>=10 and age <15) THEN '10 à 14'
                            WHEN (age>=15 and age <18) THEN '15 à 17'
                            WHEN (age>=18 and age <22) THEN '18 à 21'
                            WHEN (age>=22 and age <25) THEN '22 à 24'
                            WHEN (age>=25 and age <30) THEN '25 à 29'
                            WHEN (age>=30 and age <35) THEN '30 à 34'
                            WHEN (age>=35 and age <40) THEN '35 à 39'
                            WHEN (age>=40 and age <45) THEN '40 à 44'
                            WHEN (age>=45 and age <50) THEN '45 à 49'
                            WHEN (age>=50 and age <55) THEN '50 à 54'
                            WHEN (age>=55 and age <60) THEN '55 à 59'
                            WHEN (age>=60 and age <65) THEN '60 à 64'
                            WHEN (age>=65 and age <70) THEN '65 à 69'
                            WHEN (age>=70 and age <75) THEN '70 à 74'
                            WHEN (age>=75 and age <80) THEN '75 à 79'
                            WHEN (age>=80 and age <85) THEN '80 à 84'
                            WHEN (age>=85) THEN '85 et PLus'
                            ELSE age
                        END as tranche_age,
                        nbr,
                        case
                            WHEN (age>=0 and age <5) THEN 0
                            WHEN (age>=5 and age <10) THEN 1
                            WHEN (age>=10 and age <15) THEN 2
                            WHEN (age>=15 and age <18) THEN 3
                            WHEN (age>=18 and age <22) THEN 4
                            WHEN (age>=22 and age <25) THEN 5
                            WHEN (age>=25 and age <30) THEN 6
                            WHEN (age>=30 and age <35) THEN 7
                            WHEN (age>=35 and age <40) THEN 8
                            WHEN (age>=40 and age <45) THEN 9
                            WHEN (age>=45 and age <50) THEN 10
                            WHEN (age>=50 and age <55) THEN 11
                            WHEN (age>=55 and age <60) THEN 12
                            WHEN (age>=60 and age <65) THEN 13
                            WHEN (age>=65 and age <70) THEN 14
                            WHEN (age>=70 and age <75) THEN 15
                            WHEN (age>=75 and age <80) THEN 16
                            WHEN (age>=80 and age <85) THEN 17
                            WHEN (age>=85) THEN 18
                            ELSE age
                        END as ordre
                        from (
                        select 
                        sex, 
                        age,
                        count(age) as nbr 
                        from (
                        	select 	sex, 
                        		(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age  
                        	from patient 
                        	where sex<>'INDEFINI'
                        ) 
                        as tb1 where tb1.age>15 group by sex,age order by age) as tb2) as tb3 group by sex,tranche_age,ordre  order by ordre";
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	}
	
	private function getstatPyramideAgePediatrie(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    
	    $RAW_QUERY="select
                        sex,
                        tranche_age,
                        sum(nbr) as nombre,
                        ordre
                        from (
                        select
                        sex,
                        age as tranche_age,
                        nbr,
                        age as ordre
                        from (
                        select
                        sex,
                        age,
                        count(age) as nbr
                        from (
                        	select 	sex,
                        		(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age
                        	from patient
                        	where sex<>'INDEFINI'
                        )
                        as tb1 where tb1.age <=15 group by sex,age order by age) as tb2) as tb3 group by sex,tranche_age,ordre  order by ordre";
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();
	}
	
	
	private function getstatPyramideAge(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();

	    
	    $RAW_QUERY="select 
                        sex,
                        tranche_age,
                        sum(nbr) as nombre,
                        ordre
                        from (
                        select 
                        sex,
                        case
                            WHEN (age>=0 and age <5) THEN 'O à 5'
                            WHEN (age>=5 and age <10) THEN '5 à 9'
                            WHEN (age>=10 and age <15) THEN '10 à 14'
                            WHEN (age>=15 and age <18) THEN '15 à 17'
                            WHEN (age>=18 and age <22) THEN '18 à 21'
                            WHEN (age>=22 and age <25) THEN '22 à 24'
                            WHEN (age>=25 and age <30) THEN '25 à 29'
                            WHEN (age>=30 and age <35) THEN '30 à 34'
                            WHEN (age>=35 and age <40) THEN '35 à 39'
                            WHEN (age>=40 and age <45) THEN '40 à 44'
                            WHEN (age>=45 and age <50) THEN '45 à 49'
                            WHEN (age>=50 and age <55) THEN '50 à 54'
                            WHEN (age>=55 and age <60) THEN '55 à 59'
                            WHEN (age>=60 and age <65) THEN '60 à 64'
                            WHEN (age>=65 and age <70) THEN '65 à 69'
                            WHEN (age>=70 and age <75) THEN '70 à 74'
                            WHEN (age>=75 and age <80) THEN '75 à 79'
                            WHEN (age>=80 and age <85) THEN '80 à 84'
                            WHEN (age>=85) THEN '85 et PLus'
                            ELSE age
                        END as tranche_age,
                        nbr,
                        case
                            WHEN (age>=0 and age <5) THEN 0
                            WHEN (age>=5 and age <10) THEN 1
                            WHEN (age>=10 and age <15) THEN 2
                            WHEN (age>=15 and age <18) THEN 3
                            WHEN (age>=18 and age <22) THEN 4
                            WHEN (age>=22 and age <25) THEN 5
                            WHEN (age>=25 and age <30) THEN 6
                            WHEN (age>=30 and age <35) THEN 7
                            WHEN (age>=35 and age <40) THEN 8
                            WHEN (age>=40 and age <45) THEN 9
                            WHEN (age>=45 and age <50) THEN 10
                            WHEN (age>=50 and age <55) THEN 11
                            WHEN (age>=55 and age <60) THEN 12
                            WHEN (age>=60 and age <65) THEN 13
                            WHEN (age>=65 and age <70) THEN 14
                            WHEN (age>=70 and age <75) THEN 15
                            WHEN (age>=75 and age <80) THEN 16
                            WHEN (age>=80 and age <85) THEN 17
                            WHEN (age>=85) THEN 18
                            ELSE age
                        END as ordre
                        from (
                        select 
                        sex, 
                        age,
                        count(age) as nbr 
                        from (
                        	select 	sex, 
                        		(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`datenaissance`)), '%Y')+0) AS age  
                        	from patient 
                        	where sex<>'INDEFINI'
                        ) 
                        as tb1 group by sex,age order by age) as tb2) as tb3 group by sex,tranche_age,ordre  order by ordre";
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    return $statement->fetchAll();	    
	}
	
	
	
	public function getPyramideAgePediatrieAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $pyramideage=
	    $em->getRepository('AppBundle\Entity\Pyramideagepediatrie')
	    ->findAll();
	    
	    return $this->render('EasyDoseBundle:Statistiques:pyramide_age.html.twig',[
	        'pyramideage'=>$pyramideage
	    ]);
	    
	}
	
	
	public function getPyramideAgeAdulteAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $pyramideage=
	    $em->getRepository('AppBundle\Entity\Pyramideageadulte')
	    ->findAll();
	    //dump($pyramideage);
	    //die;
	    return $this->render('EasyDoseBundle:Statistiques:pyramide_age.html.twig',[
	        'pyramideage'=>$pyramideage
	    ]);
	    
	}
	
	public function getPyramideAgeAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $pyramideage=
	    $em->getRepository('AppBundle\Entity\Pyramideage')
	    ->findAll();
	    
	    return $this->render('EasyDoseBundle:Statistiques:pyramide_age.html.twig',[
	        'pyramideage'=>$pyramideage
	    ]);
	    
	}
	
	public function getPyramideAgeLargerAction($type){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    
	    if($type=='ALL'){
	    $pyramideage=
	    $em->getRepository('AppBundle\Entity\Pyramideage')
	    ->findAll();
	    }
	    if($type=='ADULTE'){
	        $pyramideage=
	        $em->getRepository('AppBundle\Entity\Pyramideageadulte')
	        ->findAll();
	    }
	    if($type=='PEDIATRIE'){
	        $pyramideage=
	        $em->getRepository('AppBundle\Entity\Pyramideagepediatrie')
	        ->findAll();
	    }

	    return $this->render('EasyDoseBundle:Statistiques:pyramide_age_larger.html.twig',[
	        'pyramideage'=>$pyramideage
	    ]);
	    
	}
	
	
	
	
	
	public function insertPyramideAgePediatrieAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $connection= $em->getConnection();
	    $platform= $connection->getDatabasePlatform();
	    $connection->executeUpdate($platform->getTruncateTableSQL('Pyramideagepediatrie ',true));
	    $stats=$this->getstatPyramideAgePediatrie();
	    foreach ( $stats as $Stat ) {
	        
	        $pyramideage= new Pyramideagepediatrie();
	        $pyramideage->setGenre($Stat["sex"]);
	        $pyramideage->setNombre($Stat["nombre"]);
	        $pyramideage->setTrancheAge($Stat["tranche_age"]);
	        $pyramideage->setOrdre($Stat["ordre"]);
	        $em->persist($pyramideage);
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'updatestatPiramide' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	    
	}
	
	
	public function insertPyramideAgeAdulteAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $connection= $em->getConnection();
	    $platform= $connection->getDatabasePlatform();
	    $connection->executeUpdate($platform->getTruncateTableSQL('Pyramideageadulte ',true));
	    $stats=$this->getstatPyramideAgeAdulte();
	    foreach ( $stats as $Stat ) {
	        
	        $pyramideage= new Pyramideageadulte();
	        $pyramideage->setGenre($Stat["sex"]);
	        $pyramideage->setNombre($Stat["nombre"]);
	        $pyramideage->setTrancheAge($Stat["tranche_age"]);
	        $pyramideage->setOrdre($Stat["ordre"]);
	        $em->persist($pyramideage);
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'updatestatPiramide' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	    
	}
	
	public function insertPyramideAgeAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    
	    $connection= $em->getConnection();
	    $platform= $connection->getDatabasePlatform();
	    $connection->executeUpdate($platform->getTruncateTableSQL('pyramideage ',true));
	    $stats=$this->getstatPyramideAge();
	    foreach ( $stats as $Stat ) {
	        
	        $pyramideage= new Pyramideage();
	        $pyramideage->setGenre($Stat["sex"]);
	        $pyramideage->setNombre($Stat["nombre"]);
	        $pyramideage->setTrancheAge($Stat["tranche_age"]);
	        $pyramideage->setOrdre($Stat["ordre"]);
	        $em->persist($pyramideage);
	        
	    }
	    $em->flush();
	    $response = new Response();
	    $response->setContent(json_encode([
	        'updatestatPiramide' => true
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	    
	}
	
	public function getOnlyTopStatsAction(){
	    
	    $em=$this->getDoctrine()
	    ->getManager();
	    $StatNbpatientsEntity=
	    $em->getRepository('AppBundle\Entity\Statistiques')
	    ->findAll();
	    
	    foreach ( $StatNbpatientsEntity as $Stat ) {
	        
	        if($Stat->getName()=='nbpatients' && $Stat->getType()=='dashboard')
	            $nbpatients= $Stat->getValue();
	        if($Stat->getName()=='nbexamens' && $Stat->getType()=='dashboard')
	            $nbexamens=$Stat->getValue();
	        if($Stat->getName()=='examswithNRD' && $Stat->getType()=='dashboard')
	            $examswithNRD=$Stat->getValue();
	        if($Stat->getName()=='ExamsRadio' && $Stat->getType()=='dashboard')
	            $ExamsRadio=$Stat->getValue();
	        if($Stat->getName()=='ExamsScanner' && $Stat->getType()=='dashboard')
	            $ExamsScanner=$Stat->getValue();
	        if($Stat->getName()=='ExamsMammo' && $Stat->getType()=='dashboard')
	            $ExamsMammo=$Stat->getValue();
	        if($Stat->getName()=='OptimDose' && $Stat->getType()=='dashboard')
	            $nboptims=$Stat->getValue();
	        if($Stat->getName()=='nbesr' && $Stat->getType()=='dashboard')
	            $nbesr=$Stat->getValue();
	    }
	    
	    $response = new Response();
	    $response->setContent(json_encode([
	        'nbpatients' =>$nbpatients,
	        'nbexamens' => $nbexamens,
	        'examswithNRD'=> $examswithNRD,
	        'ExamsRadio' => $ExamsRadio,
	        'ExamsScanner' => $ExamsScanner,
	        'ExamsMammo' => $ExamsMammo,
	        'nboptims' => $nboptims,
	        'nbesr' => $nbesr
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	}
	
	
	
	private function epinglerPatient($patient){
	    $current=$this->get ( 'core.security' )->getUser ();
	    $epingle=new Epingle();
	    
	    $epingle->setPatient($patient);
	    $epingle->setUser($current);
	    $em=$this->getDoctrine()
	    ->getManager();
	    $em->persist($epingle);
	    $em->flush();
	}

	private function desepinglerPatient($patient){
	    $current=$this->get ( 'core.security' )->getUser ();
	    $em=$this->getDoctrine()
	    ->getManager();
	    $epingle=$em->getRepository('AppBundle\Entity\Epingle')
	    ->findBy(
	        array('patient' =>$patient, 'user' =>$current)
	        );
	    $em=$this->getDoctrine()
	    ->getManager();
	    $em->remove($epingle[0]);
	    $em->flush();
	    
	    
	}
	
	private function getListepinglesPatient(){
	    $current=$this->get ( 'core.security' )->getUser ();
	    $em=$this->getDoctrine()
	    ->getManager();
	    $epingles=$em->getRepository('AppBundle\Entity\Epingle')
	    ->getListepinglesPatient($current);
	    return $epingles;
	    
	    
	}
	
	
	public function getlstepingleAction(){
	    $epingles=$this->getListepinglesPatient();
	    $response = new Response();
	    $listeepinglespatients=[];
	    foreach ($epingles as $epingle){
	        $patient=$epingle->getpatient();
	        $typepatient='default';
	        $age=$this->get('utils')->calculage($patient)["age"];
	        if($patient->getSex()=='FEMME' && $age>192 and age<599)
	            $typepatient="femmeproc";
	            if($age<192)
	                $typepatient="pediatrie";
	                $arraypatient=[
            	        'nompatient' =>$patient->getNom(),
            	        'prenompatient' => $patient->getPrenom(),
            	        'typepatient'=> $typepatient,
	                    'patientid' => $patient->getId(),
	                    'age' => $age,
	                    'have_alerte'=>$patient->getNrdhavealerte(),
	                    'have_comment'=>$patient->getHavenotes()
	                ];
	                array_push($listeepinglespatients,$arraypatient);
	    }
	    
	    $response->setContent(json_encode($listeepinglespatients));
	    
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	}
	
	
	public function dropepinglepatientAction($patientid){
	    $patient=$this->getDoctrine()
	    ->getManager()
	    ->find('AppBundle\Entity\Patient', $patientid);
	    $this->desepinglerPatient($patient);
	    $response = new Response();
	    $response->setContent(json_encode([
	        'return' =>'ok'
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	}
	    
	
	public function getinfopatientAction($patientid){
	    
	    $patient=$this->getDoctrine()
	    ->getManager()
	    ->find('AppBundle\Entity\Patient', $patientid);
	    
		

	    $typepatient='default';
	    $age=$this->get('utils')->calculage($patient)["age"];
	    if($patient->getSex()=='FEMME' && $age>192 and age<599)
	        $typepatient="femmeproc";
	    if($age<192)
	        $typepatient="pediatrie";
	            
	    $this->epinglerPatient($patient);
	    $response = new Response();
	    $response->setContent(json_encode([
	        'nompatient' =>$patient->getNom(),
	        'prenompatient' => $patient->getPrenom(),
	        'typepatient'=> $typepatient,
	        'patientid' => $patientid,
	        'age' => $age,
	        'have_alerte'=>$patient->getNrdhavealerte(),
	        'have_comment'=>$patient->getHavenotes()
	    ]));
	    $response->headers->set('Content-Type', 'application/json');
	    //$response->send();
	    return $response;
	}
	
	public function dashboardAction(){
	    $em=$this->getDoctrine()
	    ->getManager();
	    /*$repository=$this->getDoctrine()
	    ->getManager()
	    ->getRepository('AppBundle\Entity\Patient');
	    $nbpatients=$repository->getNbPatient();*/
	    
	    $lastexams=$this->getLastExams(10);
	    
	    /*$repositoryExamen=$this->getDoctrine()
	    ->getManager()
	    ->getRepository('AppBundle\Entity\Examen');
	    $nbexamens=$repositoryExamen->getNbExamens();*/

	    
	  /*  $top5Nrd=
	    $em->getRepository('AppBundle\Entity\StatTopFive')
	    ->findAll();*/
	
       
	    
	    $etablissement=$this->getDoctrine()
	    ->getManager()
	    ->getRepository('AppBundle\Entity\Etablissement')
	    ->findAll();
        
       
	    return $this->render('EasyDoseBundle:Patient:accueil.html.twig',[
	        'lastexams'=>$lastexams,
	        'etablissement' => $etablissement[0]
	        
	    ]);
	}
	
	public function alaragrsAction(){
	    return $this->render('EasyDoseBundle:Patient:ContenuWorklist/contenualara.html.twig');
	}
	
	
	public function statistiquesAction(){
		$detaildose=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\detail_dose');
		$dd=$detaildose->getdetaildoseall();
		
	
		return $this->render('EasyDoseBundle:Patient:statistiques.html.twig',['detaildose' => $dd]);
	}
	
	public function getprotocolescanAction(){
		$detaildose=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\detail_dose');
		$dd=$detaildose->getprotocolescanner();
		return $this->render('EasyDoseBundle:Patient:protocoles.html.twig',['detaildose' => $dd]);
	}
	

	public function getprotocoleradAction(){
		$detaildose=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\detail_dose');
		$dd=$detaildose->getprotocoleradio();
		return $this->render('EasyDoseBundle:Patient:protocoles.html.twig',['detaildose' => $dd]);
	}
	
	
	public function statdoseAction($protocolename){
		
		$dd=$this->getstatDetailDoseByProto(str_replace("*","/",urldecode($protocolename)));

		return $this->render('EasyDoseBundle:Patient:statdose.html.twig',['listedetaildose' => $dd]);
		
	}
	
	public function niveaustatdoseAction($protocolename,$type){
		
	    $modalite="";
	    if ($protocolename=="MAMMOGRAPHIE")
	        $modalite="Mammographie";
	      
	    if ($protocolename=="SCANNER")
	        $modalite="Scanner";
	            
	    if ($protocolename=="RADIOGRAPHIE")
	        $modalite="Radiographie";
	    
	    $statprotocole=$this->getDoctrine()
	    ->getManager()
	    ->getRepository('AppBundle\Entity\StatProtocoles')
	    ->findBy(array('modalite' =>$modalite,'type'=>$type));
	    
	    if($statprotocole!=null && count($statprotocole)>0){
	        if($protocolename=="RADIOGRAPHIE")
	            $unite='mGy.mm²';
	        else
	           $unite=$statprotocole[0]->getUnite();
	    }else
	        $unite='';	    
		
		return $this->render('EasyDoseBundle:Patient:charts.html.twig',['unite' => $unite,'statprotocole' =>$statprotocole]);
	}
	
	public function niveaustatdoselargerAction($protocolename,$type){
	    
	    $modalite="";
	    if ($protocolename=="MAMMOGRAPHIE")
	        $modalite="Mammographie";
	        
	        if ($protocolename=="SCANNER")
	            $modalite="Scanner";
	            
	            if ($protocolename=="RADIOGRAPHIE")
	                $modalite="Radiographie";
	                
	                $statprotocole=$this->getDoctrine()
	                ->getManager()
	                ->getRepository('AppBundle\Entity\StatProtocoles')
	                ->findBy(array('modalite' =>$modalite,'type'=>$type));
	                
	                if($statprotocole!=null && count($statprotocole)>0){
	                    if($protocolename=="RADIOGRAPHIE")
	                        $unite='mGy.mm²';
	                        else
	                            $unite=$statprotocole[0]->getUnite();
	                }else
	                    $unite='';
	                    
	                    return $this->render('EasyDoseBundle:Patient:charts_larger.html.twig',['unite' => $unite,'statprotocole' =>$statprotocole]);
	}
	
	public function addevalAction($numdetail,$note,$commentaire){
		$optimisationdosedetail=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Optimisationdosedetail', $numdetail);
		
		$commentaire2=str_replace("+"," ",$commentaire);
		
		$evaluation= new Evaluation();
		$evaluation->setValeur($note);
		$evaluation->setDate(new \DateTime(('now')));
		$evaluation->setCommentaire($commentaire2);
		$evaluation->setOptimisationdosedetail($optimisationdosedetail);
		
		$em=$this->getDoctrine()
		->getManager();
		$em->persist($evaluation);
		$em->flush();
		
	/*	
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($optimisationdosedetail){return $optimisationdosedetail->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];*/
	/*	$serializer=new Serializer($normalizers,$encoders);
		
		$jsonObject = $serializer->serialize($evaluation, 'json');*/
		return new Response("{\"id\" : ".$optimisationdosedetail->getOptimisationdose()->getId()."}", 200, ['Content-Type' => 'application/json']);
	}
	
	public function insertoptimdosedetailAction($numdetail,$protocole,$kvp,$xray,$modalite,$machine,$nbnote,$dose,$commentaire){
		
		$optimisationdose=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Optimisationdose', $numdetail);
		
		
		$dose=str_replace("+"," ",$dose);
		$commentaire=str_replace("*","/",str_replace("+"," ",$commentaire));
		
		
		$protocole2=str_replace("+"," ",$protocole);
		$machine2=str_replace("+"," ",$machine);
		$modalite2=str_replace("+"," ",$modalite);
		
		$optimdetail = new Optimisationdosedetail();
		$optimdetail->setKvp($kvp);
		$optimdetail->setMachine($machine2);
		$optimdetail->setProtocole($protocole2);
		$optimdetail->setXraytubecurrent($xray);
		$optimdetail->setModalite($modalite2);
		$optimdetail->setOptimisationdose($optimisationdose);
		$optimdetail->setNbnotesmax($nbnote);
		$optimdetail->setCommentaire($commentaire);
		$optimdetail->setValeur($dose);
		//$optimisationdose->setOptimisationdosedetail($optimdetail);
		$em=$this->getDoctrine()
		->getManager();
		$em->persist($optimdetail);	
		$em->persist($optimisationdose);
		$em->flush();
		
		
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($optimisationdose){return $optimisationdose->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];
		$serializer=new Serializer($normalizers,$encoders);
		
		$jsonObject = $serializer->serialize($optimisationdose, 'json');
		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
		
	}
	
	public function insertoptimdoseAction(Request $request){
		
	    
	    
	    $dose=$request->get('dose');
	    $commentaire=$request->get('commentaire');
	    $protocole2=$request->get('protocole');
	    $machine2=$request->get('machine');
	    $modalite2=$request->get('modalite');
	    $kvp=$request->get('kvp');
	    $xray=$request->get('xray');
		
		$optim = new Optimisationdose();
		$optim->setKvp($kvp);
		$optim->setMachine($machine2);
		$optim->setProtocole($protocole2);
		$optim->setXraytubecurrent($xray);
		$optim->setModalite($modalite2);
		$optim->setCommentaire($commentaire);
		$optim->setValeur($dose);
		$em=$this->getDoctrine()
		->getManager();
		$em->persist($optim);		
		$em->flush();
		
		
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($optim){return $optim->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];
		$serializer=new Serializer($normalizers,$encoders);
		
		$jsonObject = $serializer->serialize($optim, 'json');
		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
		
	}
	
	public function optimdoseAction(){
		$optimisationdose=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Optimisationdose')
		->findBy(
		    array(),
		    array('id' => 'DESC')
		    );
		
		
		$protocoles=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\detail_dose')
		->getprotocoleall();
		
		
		$dispositifs= $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Dispositif')->findAll();
		
		return $this->render('EasyDoseBundle:Patient:optimdose.html.twig',['dispositifs' => $dispositifs,'optimisationdose'=>$optimisationdose,'protocoles' =>$protocoles]);
	}
	
	public function optimdosedetailAction($numdetail){
		$optimisationdosedetail=
		$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Optimisationdosedetail')
		->findBy(array('optimisationdose' =>$numdetail));
		
		
		$optimisationdose=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Optimisationdose')
		->find($numdetail);
		
		$evaluations=[];
		foreach ($optimisationdosedetail as $optim){
			$eval=
			$this->getDoctrine()
			->getManager()
			->getRepository('AppBundle\Entity\Evaluation')
			->findBy(array('optimisationdosedetail' =>$optim->getId()));
			$evaluations[$optim->getId()]=$eval;
		}
		return $this->render('EasyDoseBundle:Patient:optimdosedetail.html.twig',['numdetail'=>$numdetail,'optimisationdosedetail'=>$optimisationdosedetail,'evaluations'=>$evaluations,'optimisationdose' =>$optimisationdose]);
	}
	public function getprotocolemgAction(){
		$detaildose=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\detail_dose');
		$dd=$detaildose->getprotocolemamo();
		
		
		$detaildose=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\detail_dose');
		$dd=$detaildose->getdetaildoseall();
		

		
		
		return $this->render('EasyDoseBundle:Patient:protocoles.html.twig',['detaildose' => $dd]);
	}
	
	
	
	
	public function testtemplateAction()
	{
		return $this->render('EasyDoseBundle:Patient:template.html.twig');
	}

	
	
	private function sendMail($dest, $message, $object,$dicomfile) {
		$sender=$this->container->getParameter("mailer_user");
		if($dicomfile!=null){
		$mime_message = (new \Swift_Message ( $object ))->setFrom ( $sender)->setTo ( $dest )
		->setBody ( $message." file_id : ".$dicomfile, "text/html" );
		}else{
			$mime_message = (new \Swift_Message ( $object ))->setFrom ( $sender)->setTo ( $dest )
			->setBody ( $message, "text/html" );
		}
		$this->get("mailer")->send ( $mime_message );
	}
	
	private function sendMailwithImage($dest, $twig, $object,$image,$patient,$user) {
		$sender=$this->container->getParameter("mailer_user");
		//$image='assets/images/femme_e.jpg'
		//$twig='EasyDoseBundle:Patient:mail.femmeEnceinte.html.twig'	
		$mime_message = (new \Swift_Message ( $object ))->setFrom ( $sender)->setTo ( $dest );
		
		if($image)
			$img = $mime_message->embed(\Swift_Image::fromPath($image));
		
		$mesg=$this->renderView(
					// templates/emails/registration.html.twig
					$twig,
					['patient' => $patient,'img' => $img,'user'=>$user]);
			
		$mime_message->setBody ( $mesg, "text/html" );
		
		
		
		
			$this->get("mailer")->send ( $mime_message );
	}
	
	
	private function sendMailNrdAlert($dest, $twig, $object,$patient,$user) {
	
		//$image='assets/images/femme_e.jpg'
		//$twig='EasyDoseBundle:Patient:mail.femmeEnceinte.html.twig'
		$sender=$this->container->getParameter("mailer_user");
		$mime_message = (new \Swift_Message ( $object ))->setFrom ( $sender)->setTo ( $dest );
	
			$mesg=$this->renderView(
					// templates/emails/registration.html.twig
					$twig,
			    ['bottomcolor'=>'#0052cc','color' =>'#243a51','patient' => $patient,'user' => $user, 'etablissement' =>$this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Etablissement')->findAll()[0]]);				
			$mime_message->setBody ( $mesg, "text/html" );
			$this->get("mailer")->send ( $mime_message );
	}
	
	private function sendMailEsrAlert($dest, $twig, $object,$patient,$user,$facteur) {
	    
	    //$image='assets/images/femme_e.jpg'
	    //$twig='EasyDoseBundle:Patient:mail.femmeEnceinte.html.twig'
	    $sender=$this->container->getParameter("mailer_user");
	    $mime_message = (new \Swift_Message ( $object ))->setFrom ( $sender)->setTo ( $dest );
	    
	    $mesg=$this->renderView(
	        // templates/emails/registration.html.twig
	        $twig,
	        ['facteur' => $facteur,'bottomcolor'=>'#CC0000','color' =>'#CC0000','patient' => $patient,'user' => $user, 'etablissement' =>$this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Etablissement')->findAll()[0]]);
	    $mime_message->setBody ( $mesg, "text/html" );
	    $this->get("mailer")->send ( $mime_message );
	}
	
	/**
	 * @Route("/sendmail", name="sendmail")
	 */
	public function sendmailAction()
	{
		$mails=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Mails');
		$listmails=$mails->findAll();
		
		$repousers=$this->getDoctrine()
		->getManager()
		->getRepository('UserBundle\Entity\User');
		$listusers=$repousers->findAll();
		
		
		foreach ($listmails as $mail){
			foreach ($listusers as $user){
				if($user->issuperadmin())
					$this->sendMail($user->getEmail(), $mail->getMessage(), $mail->getObject(),$mail->getDicomfile());
			}
			$this->getDoctrine()
			->getManager()
			->remove($mail);
		}
		$this->getDoctrine()
		->getManager()
		->flush();
		return $this->render('EasyDoseBundle:Default:index.html.twig');
	}
	
	public function havecommentsAction($idpatient){
		
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $idpatient);
		return $this->render('EasyDoseBundle:Patient:havecomment.html.twig',["patient"=>$patient]);
	}
	
	
	
	
	
	private function sendmailESRAlerte($patient,$facteur)
	{
	    
	    
	    $repousers=$this->getDoctrine()
	    ->getManager()
	    ->getRepository('UserBundle\Entity\User');
	    $listusers=$repousers->getusersingroups(['MEDECIN','RADIOPHYSICIEN']);
	    $etablissement = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Etablissement')->findAll()[0]->getNom();
	    $objet= $etablissement.": Attention, Evènement Significatif de Radio Protection détecté";
	    foreach ($listusers as $user){
	        $this->sendMailEsrAlert($user->getEmail(),'EasyDoseBundle:Patient:mail.esralerte.html.twig',$objet,$patient,$user,$facteur);
	    }
	    
	}
	
	
	private function sendmailNrdAlerte($patient)
	{

		
		$repousers=$this->getDoctrine()
		->getManager()
		->getRepository('UserBundle\Entity\User');
		$listusers=$repousers->getusersingroups(['MEDECIN','RADIOPHYSICIEN']);
		$etablissement = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Etablissement')->findAll()[0]->getNom();
		$objet= $etablissement.": Dépassement d'un Niveau de Référence Diagnostique";
		foreach ($listusers as $user){
			$this->sendMailNrdAlert($user->getEmail(),'EasyDoseBundle:Patient:mail.nrdalerte.html.twig',$objet,$patient,$user);
		}
	
	}
	
	private function getLasteNote($patient){
		
	}
	
	public function sendmailtooneAction(Request $request)
	{
		$dest=$request->request->get("dest");
		
		$mesg=$request->request->get("mesg");
		
		$obj=$request->request->get("obj");
		$this->sendMail($dest,  $mesg,$obj,null);
		return $this->render('EasyDoseBundle:Default:index.html.twig');
	}
	
	private function getnotes($patient){
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Note');
		$notes=$repository->getnote($patient);
		$notestble=[];
		foreach ($notes as $note){
			$notestble[]=["datenote"=>$note->getDatenote()->format('d-m-Y'),"user" => ($note->getCreateur()->getFirstname()." ".$note->getCreateur()->getLastname()), "content" =>($note->getContenu())];
		}
		return $notestble;
	}
	
	private function havenotes($patient){
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Note');
		$notes=$repository->getnote($patient);
		
		return count($notes)>0;
	}
	private function getlastnote($patient){
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Note');
		
		$lastnote=$repository->getLastnote($patient);
		if(count($lastnote)>0)
			return ["datenote"=>$lastnote[0]->getDatenote()->format('d-m-Y'),"user" => ($lastnote[0]->getCreateur()->getFirstname()." ".$lastnote[0]->getCreateur()->getLastname()), "content" =>($lastnote[0]->getContenu())];
		else return null;
	}
	
	public function shownotesAllAction($idpatient){
		
		//$idpatient=urldecode($request->request->get("idpatient"));
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $idpatient);
		$notes=$this->getnotes($patient);
		

		return $this->render('EasyDoseBundle:Patient:notes.html.twig',[ 'notes' => $notes]);
		
		
	}
	
	public function getNbPages($size){
		
		return ceil(($size-300)/60);
	}
	
	

	public function getMaxNbPagesToView($size){
	     
		return ceil(
		    count($this->getDoctrine()
		    ->getManager()
		    ->getRepository('AppBundle\Entity\Patient')
		    ->findAll())/$size);
	}
	
	public function getnotesAllAction($idpatient){
		
		//$idpatient=urldecode($request->request->get("idpatient"));
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $idpatient);
		$notes=$this->getnotes($patient);
		
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($object){return $object->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];
		$serializer=new Serializer($normalizers,$encoders);
		
		$jsonObject = $serializer->serialize($notes, 'json');
		 
		
		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
		
	}
	
	public function insertNoteAction(Request $request){
		$idpatient=urldecode($request->request->get("idpatient"));
		$content=urldecode($request->request->get("notepatient"));
		
		$ConnectedUser = $this->get ( 'core.security' )->getUser ();
		$note=new Note();
		$note->setContenu($content);
		$note->setCreateur($ConnectedUser);
		$idpatient=$request->request->get("idpatient");
		
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $idpatient);
		
		$note->setPatient($patient);
		$dt=new \DateTime(('now'));
		$note->setDatenote($dt);
		$em=$this->getDoctrine()
		->getManager();
		$em->persist($note);
		
		$patient->setHavenotes(true);
		$em->persist($patient);
			
		$em->flush();
		
		

	
		
		$lstnotes=$this->getlastnote($patient);
		//if($lstnotes)
			
		
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($object){return $object->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];
		$serializer=new Serializer($normalizers,$encoders);
		
		$jsonObject = $serializer->serialize($lstnotes, 'json');
	  
		
		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
	}
	
	public function sendmailtomanyAction(Request $request)
	{
		$idpatient=$request->request->get("idpatient");		
		
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $idpatient);
		

		$repousers=$this->getDoctrine()
		->getManager()
		->getRepository('UserBundle\Entity\User');
		$listusers=$repousers->getusersingroups(['MEDECIN','RADIOPHYSICIEN']);
				
		$obj="Easydose - irradiation femme enceinte";
		
		foreach ($listusers as $user){
			$this->sendMailwithImage($user->getEmail(), 'EasyDoseBundle:Patient:mail.femmeEnceinte.html.twig', $obj,'assets/images/femme_e.jpg',$patient,$user);
		}
		
		
		
		return $this->render('EasyDoseBundle:Default:index.html.twig');
	}
	
	public function getPatientAction($id){
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $id);
	}
	/**
	 * @Route("/all")
	 */
	public function getPatientsAction(){
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findAll();
		return $this->render('EasyDoseBundle:Patient:worklist.html.twig',[ 'patients' => $listpatients]);
	}
	
	public function getjsonPatientAllnameAction(){
		
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findAll();
		$patientname= [];
		foreach ($listpatients as $patient){
			if($patient->getNom())
				$patientname[]=$patient->getNom();
				
		}
		
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($object){return $object->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];
		$serializer=new Serializer($normalizers,$encoders);
		
		$jsonObject = $serializer->serialize($patientname, 'json');
		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
		
	}
	

	public function getjsonPatientAllprenomAction(){
	
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findAll();
		$patientPrenom= [];
		foreach ($listpatients as $patient){
			if($patient->getPrenom())
				$patientPrenom[]=$patient->getPrenom();
	
		}
	
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($object){return $object->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];
		$serializer=new Serializer($normalizers,$encoders);
	
		$jsonObject = $serializer->serialize($patientPrenom, 'json');
		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
	
	}
	
	
	public function getjsonNumIppAllprenomAction(){
	
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findAll();
		$numipp= [];
		foreach ($listpatients as $patient){
			if($patient->getNumipp())
				$numipp[]=$patient->getNumipp();
	
		}
	
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($object){return $object->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];
		$serializer=new Serializer($normalizers,$encoders);
	
		$jsonObject = $serializer->serialize($numipp, 'json');
		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
	
	}
	
	
	public function getjsonIDRegionalAction(){
	
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findAll();
		$Idregional= [];
		foreach ($listpatients as $patient){
			if($patient->getIdregional())
				$Idregional[]=$patient->getIdregional();
	
		}
	
		$normalizer=new ObjectNormalizer();
		$normalizer->setCircularReferenceLimit(2);
		$normalizer->setCircularReferenceHandler(function($object){return $object->getId();});
		$normalizers=array($normalizer);
		$encoders=[new JsonEncoder()];
		$serializer=new Serializer($normalizers,$encoders);
	
		$jsonObject = $serializer->serialize($Idregional, 'json');
		return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
	
	}
	
	private function getnbsoses($patient){
		$nbdose=0;	
		$examens=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Examen')
		->geExamen($patient);
		$regiondosestab=[];
		$detaildosetab=[];
		foreach ($examens as $examen){
			$regiondose=$examen->getRegion();
			$regiondoses=$this->getDoctrine()
			->getManager()
			->getRepository('AppBundle\Entity\Region_Dose')
			->getDoses($regiondose);
			$regiondosestab=array_merge($regiondosestab,$regiondoses);
		
			foreach ($regiondoses as $rd){
				$nbdose++;
				$dose=$rd->getDose();
				$detaildose=$this->getDoctrine()
				->getManager()
				->getRepository('AppBundle\Entity\detail_dose')
				->getdetaildosewhitoutEntireBody($dose);
				$detaildosetab=array_merge($detaildosetab,$detaildose);
			
			}
		
		}
	   if($detaildosetab)
		return count($detaildosetab);
		
		return 0;
	}

	private function getnbsosesbymodalite($patient,$modalite){
		$nbdose=0;
		$examens=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Examen')
		->geExamen($patient);
		$regiondosestab=[];
		foreach ($examens as $examen){
			$regiondose=$examen->getRegion();
			$regiondoses=$this->getDoctrine()
			->getManager()
			->getRepository('AppBundle\Entity\Region_Dose')
			->getDosesbymodalite($regiondose,$modalite);
			$regiondosestab=array_merge($regiondosestab,$regiondoses);
			$nbdose+=count($regiondoses);
	
		}
	
		return $nbdose;
	}
	private function getIdPatientByIdDose($doseid){
		$em=$this->getDoctrine()
		->getManager();
		$RAW_QUERY="select patient_id from examen where region_id in 
				(select region_id from region_dose where dose_id in 
				(select dose_id from detail_dose where id=".$doseid."));";
		$statement=$em->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		$result=$statement->fetchAll();
	    if($result && count($result)>0)
	    	return $result[0]["patient_id"];
	}
	
	private function getstatDetailDoseByProto($protocolename){
		
		$em=$this->getDoctrine()
		->getManager();
		$RAW_QUERY="select p.nom,p.prenom,dd.* from 
		detail_dose dd inner join region_dose rd 
		on dd.dose_id=rd.dose_id inner join examen ex 
		on ex.region_id=rd.region_id inner join patient p 
		on ex.patient_id=p.id where dd.protocole='".$protocolename."'";
		$statement=$em->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		return $statement->fetchAll();
		
	}
	
	private function getdoses($patient){
		$examens=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Examen')
		->geExamen($patient);
		
		$tableaurecapdoses=[];
		foreach ($examens as $examen){
			$regiondose=$examen->getRegion();
			$regiondoses=$this->getDoctrine()
			->getManager()
			->getRepository('AppBundle\Entity\Region_Dose')
			->getDoses($regiondose);
			
		
			foreach ($regiondoses as $rd){
				$dose=$rd->getDose();
				if($dose->getModalite()!="CT"){
					$detaildose=$this->getDoctrine()
					->getManager()
					->getRepository('AppBundle\Entity\detail_dose')
					->getdetaildose($dose);
					//$detaildosetab=array_merge($detaildosetab,$detaildose);
					foreach ($detaildose as $ddose){
						if( !array_key_exists($dose->getModalite(),$tableaurecapdoses) or !($tableaurecapdoses[$dose->getModalite()]))
							$tableaurecapdoses[$dose->getModalite()]=$ddose->getValeur();
						else
							$tableaurecapdoses[$dose->getModalite()]+=$ddose->getValeur();
					}
					
				}else{
					if(!array_key_exists($dose->getModalite(),$tableaurecapdoses) or  !($tableaurecapdoses[$dose->getModalite()]))
						$tableaurecapdoses[$dose->getModalite()]=$dose->getValeur();
					else
						$tableaurecapdoses[$dose->getModalite()]+=$dose->getValeur();
					
				}
			}
	}
	return $tableaurecapdoses;
	}
	
	private function PatientIsInAlert($patient){
		
		$doses=$this->getdoses($patient);
		$cmpt=0;
		foreach ($doses as $dose){
		if($patient->getAge() >15)
		{
			//getdose
			$params1=$this->getDetailParametre("age",">15");
			$params2=$this->getDetailParametre("MODALITE",array_keys($doses)[$cmpt]);
			$nbd=$this->getnbsosesbymodalite($patient,array_keys($doses)[$cmpt]);
			foreach ($params1 as $param1){
				foreach ($params2 as $param2){
					if($param2->getParametre()==$param1->getParametre()){
						$dosemax=$param2->getParametre()->getValeur();
					}
				}
			}
			
			//si dose CT et superieur > 2 ==>alerte
			//getdatailp("MODALITE","CT") ===>  2,4
			//getdetail("age",">15")==>2,3
			
			
				return $nbd>=$dosemax;
			
			
			//si dose SR et superieur 9 ==>alerte
			
		}else{
			
			$nbd=$this->getnbsosesbymodalite($patient,array_keys($doses)[$cmpt]);
			$params1=$this->getDetailParametre("age","<15");
			$params2=$this->getDetailParametre("MODALITE",array_keys($doses)[$cmpt]);
			foreach ($params1 as $param1){
				foreach ($params2 as $param2){
					if($param2->getParametre()==$param1->getParametre()){
						$dosemax=$param2->getParametre()->getValeur();
					}
				}
			}
			return $nbd>=$dosemax;

			
		}
		$cmpt++;
		}
	}
	
	
	private function getparametervalue($parametre){
		$parametre=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Parametre')
		->findBy(
				array('nom' =>$parametername)
				);
		if(count($parametre)>0)
			return $parametre[0];
		
		return null;
		
	}
	
	private function getDetailParametre($nom,$valeur){
		$detailparametre=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Detailparametre')
		->findBy(
				array('nom' =>$nom, 'valeur' =>$valeur)
				);
		return $detailparametre;
	}
	
	public function getNBPatientFiltre($withradio,$withscan,$withmammo,$withnrd,$withpediatrie,$withpatientproc,$size){
	    return ceil($this->getDoctrine()
	        ->getManager()
	        ->getRepository('AppBundle\Entity\Patient')->getNBPatientFiltre($withradio,$withscan,$withmammo,$withnrd,$withpediatrie,$withpatientproc)/$size);
	}
	
	public function getMaxNbPagesToViewsearch($nom,$prenom,$IPP,$IDR,$BD,$HDRV,$GENRE,$size){
	
		return ceil($this->getDoctrine()
				->getManager()
				->getRepository('AppBundle\Entity\Patient')->getNbPatientSearch($nom,$prenom,$IPP,$IDR,$BD,$HDRV,$GENRE)/$size);
	}
	
	
	
	
	public function getTranchesAge($age,$type){
	    $em=$this->getDoctrine()
	    ->getManager();
	    $RAW_QUERY="select tranche from tranche_age where valmin< ".$age." and valmax >".$age."  and type='".$type."';";
	    $statement=$em->getConnection()->prepare($RAW_QUERY);
	    $statement->execute();
	    $result=$statement->fetchAll();
	    if($result && count($result)>0)
	        return $result;
	}

	public function calculNRDSeuillatteint($patient,$bodypart,$unite,$dose,$orientation,$protocole,$detail_dose_id,$nom_machine,$xray,$detaildose){
	    
	    $em=$this->getDoctrine()->getManager();
	   
	    try{
	    	$replayalerte = $this->container->getParameter('replayalerte');
		}
		catch(\Exception $e){}
	    if(!$replayalerte)
	    {
    	    $havenrdvaleur=$detaildose->getNrdhavealerte()==true;
    	    $haveesr=$detaildose->isEsrhavealerte()==true;
	    }else{
    	    $havenrdvaleur=false;
    	    $haveesr=false;
	    }
	    //dump($havenrdvaleur);
	    //dump($haveesr);
	   // dump($detaildose->getId());
	    //die;
	    
	    $logger=$this->get("logger");
		
		//$unitaage="ADULTE";
		//calcule age
		$age=$this->get('utils')->calculage($patient);
		$seuildeclenchecharge=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'seuil_charge_declenchement_esr'))[0]->getValeur();
		
		if(strpos($unite,"2")!==false){
		    $typeexamen="RADIOLOGIE";
		}
		else{//Sinon TYPE SCANNER
		    $typeexamen="SCANNER";
		    
		}
		
		$tranchesAge=$this->getTranchesAge($age["age"],$typeexamen);
			
		$logger->critical("patient: ".$patient->getNom());	
		$logger->critical("protocole: ".$protocole);
		$logger->critical("age: ".$age["age"]);
		$logger->critical("date naissance: ".$patient->getDatenaissance()->format('d-m-Y'));
		$logger->critical("seuildeclenchecharge: ".$seuildeclenchecharge);
		$logger->critical("detailDoseId: ".$detaildose->getId());
		
		
		
		$listeseuils=[];
		
		$logger->critical("typeexamen: ".$typeexamen);
		if($typeexamen=='SCANNER')
		  $taillesuppressionnomproto=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'taille_supp_proto_scanner'))[0]->getValeur();
		else
		  $taillesuppressionnomproto=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'taille_supp_proto_radio'))[0]->getValeur();
		if($typeexamen=="SCANNER"){
		    foreach($tranchesAge as $trancheAge){
		        
		        $seuil=$this->getDoctrine()
		        ->getManager()
		        ->getRepository('AppBundle\Entity\NrdV2')
		        ->searchFiltre($typeexamen,$protocole,$trancheAge["tranche"],$taillesuppressionnomproto);        			
        			$logger->critical("recherche type: ".$typeexamen." | protocole :".$protocole. " | age :".$trancheAge["tranche"]);
        			$logger->critical("nb seuils trouvés: ".sizeof($seuil));
        			
      			$listeseuils=array_merge($listeseuils,$seuil);
      			$logger->critical("trancheAge: ".$trancheAge["tranche"]);
		    }
			
		}else 
		{
		    if($typeexamen=='SCANNER')
		        $taillesuppressionnomproto=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'taille_supp_proto_scanner'))[0]->getValeur();
		    else
		        $taillesuppressionnomproto=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'taille_supp_proto_radio'))[0]->getValeur();
		    foreach($tranchesAge as $trancheAge){
		     $seuil=$this->getDoctrine()
		        ->getManager()
		        ->getRepository('AppBundle\Entity\NrdV2')
		        ->searchFiltre($typeexamen,$protocole,$trancheAge["tranche"],$taillesuppressionnomproto);   
			
			$logger->critical("recherche type: ".$typeexamen." | protocole :".$protocole. " | age :".$trancheAge["tranche"]);
			$logger->critical("nb seuils trouvés: ".sizeof($seuil));
			$listeseuils=array_merge($listeseuils,$seuil);
		    }
		    $logger->critical("trancheAge: ".$trancheAge["tranche"]."---listeseuils trouvés: ".sizeof($listeseuils));
			
		}
		if( sizeof($listeseuils)>0)
		{
			
		    $logger->critical("seuils trouvés: ".sizeof($listeseuils));
			
		    foreach($listeseuils as $listeseuil){
		    
		        $seuil=$listeseuil->getValeur();
		        $tranche=$listeseuil->getAge();
    			$unitedose="mGy.cm2";
    			if($typeexamen=="SCANNER")
    				$unitedose="mGy.cm";
    			
    			$logger->critical("typeexamen: ".$typeexamen);
    			$logger->critical("seuil: ".$seuil);
    			$logger->critical("uniteseuil: ".$unitedose);
    			
    			$logger->critical("valeurdose: ".$dose["valeur"]);
    			$logger->critical("unitdose: ".$dose["unite"]);
    			
    			$seuilconverti=$this->getmgyvalue($seuil,$unitedose);
    			$logger->critical("valeur seuil convertie: ".$seuilconverti["valeur"]);
    			$logger->critical("unite seuil convertie: ".$seuilconverti["unite"]);
    			
    			
    			$valeurseuilconvertie=$seuilconverti["valeur"];
    			//$tranche=$listeseuils[0]->
    			if($valeurseuilconvertie<=($dose["valeur"]) && $xray>$seuildeclenchecharge && !$havenrdvaleur && !$haveesr)
    			    $logger->critical(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Seuil atteint : ".$detail_dose_id." charge:".$xray);
    			else
    				$logger->critical("Seuil NON atteint");
    		    if($valeurseuilconvertie<=($dose["valeur"])  && $xray>$seuildeclenchecharge && !$havenrdvaleur && !$haveesr)
    			{
    			    
    			    //Gestion des ESR
    			   $ageannuel= floor($age["age"]/12);
    			   $logger->critical("Age Annuel ".$ageannuel);
    			   if($ageannuel>18){
    			       $facteur_esr=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_seuil_depassement_adulte'))[0]->getValeur();
    			       
    			   }else{
    			       $facteur_esr=$em->getRepository('AppBundle\Entity\Parametre')->findBy( array('nom' => 'esr_seuil_depassement_pedia'))[0]->getValeur();
    			   }
    			   
    			   $logger->critical("facteur esr ".$facteur_esr);
    			   $logger->critical("seuil esr ".$valeurseuilconvertie*$facteur_esr);
    			   $logger->critical("valeur ".$dose["valeur"]);
    			   //si dépasssement de facteur 
    			   
    			   
    			   if(($valeurseuilconvertie*$facteur_esr)<=($dose["valeur"])  && $xray>$seuildeclenchecharge && !$haveesr)
    			   {
    			       $logger->critical("Seuil esr atteint ==============================================>");
    			       $examen=$em->getRepository('AppBundle\Entity\Examen')
    			       ->getExamensByIdDetailDose($detail_dose_id);
    			       
    			       
    			       //Marquagedetail dose comme ayant ateint un ESR
    			       
    			       if($detail_dose_id!=(-1)){
    			       $this->get('utils')->saveEsrAutoAction($examen[0]->getId(),$nom_machine); //On sauvegarde l'ESR;
    			       $this->get('utils')->setDetailDosehaveESR($detail_dose_id);
    			       }
    			       //dump('ESR');
    			       return["facteur"=>$facteur_esr,"esrdeclenche"=>true,"tranche" => $tranche,"seuilatteint" => true,"seuilconverti" => $seuilconverti,"havenrdvaleur" => $havenrdvaleur,"haveesr" => $haveesr];
    			   }
    			   return["facteur"=>0,"esrdeclenche"=>false,"seuilatteint" => true,"tranche" => $tranche,"seuilconverti" => $seuilconverti,"havenrdvaleur" => $havenrdvaleur,"haveesr" => $haveesr];
    			}
    			else
    			    return ["seuilatteint" => false || $havenrdvaleur,"seuilconverti" => $seuilconverti,"havenrdvaleur" => $havenrdvaleur,"haveesr" => $haveesr];
    		
    		
		    }
		
		
		}
		$seuilconverti=null;
		return ["seuilatteint" => false || $havenrdvaleur,"seuilconverti" => $seuilconverti,"havenrdvaleur" => $havenrdvaleur,"haveesr" => $haveesr];
		
		
		
		
	}
	
	public function testExamdetailAction($ddid){
	    $em=$this->getDoctrine()->getManager();
	    $em->getRepository('AppBundle\Entity\Examen')
	    ->getExamensByIdDetailDose($ddid);
	}
	
	public function workinprogressAction($pagetitle){
		return $this->render('EasyDoseBundle:Patient:page_en_construction.html.twig',array("pagetitle" => str_replace("+"," ",$pagetitle)));
	}
	
	public function rechercheglobaleAction($words){
		//recherche dans table patient
		
		
		
		
		//recherche dans table detail dose
		
		
		return $this->render('EasyDoseBundle:Patient:search.html.twig',array("results" => $results));
	}
	
	public function setalerteAction(){
		$em=$this->getDoctrine()
		->getManager();
		$repository=$em
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findAll();
		foreach ($listpatients as $patient){
			$patient->setNbdoses($this->getnbsoses($patient));
			$patient->setNrdhavealerte($this->NrdAlertpatient($patient));
			$patient->setSumhavealerte($this->PatientIsInAlert($patient));
			$patient->setHavenotes($this->havenotes($patient));
			$em->persist($patient);
			
			$this->NrdAlertpatientdetail($patient);
			
		}
		$em->flush();
		return $this->render('EasyDoseBundle:Default:index.html.twig');
	}
	
	public function setalertebetweenAction($min,$max){
	    $em=$this->getDoctrine()
	    ->getManager();
	    $repository=$em
	    ->getRepository('AppBundle\Entity\Patient');
	    
	    $listpatients=$repository->findPatient($min,$max);
	    foreach ($listpatients as $patient){
	        $patient->setNbdoses($this->getnbsoses($patient));
	        $patient->setNrdhavealerte($this->NrdAlertpatient($patient));
	        $patient->setSumhavealerte($this->PatientIsInAlert($patient));
	        $patient->setHavenotes($this->havenotes($patient));
	        $em->persist($patient);
	        
	        $this->NrdAlertpatientdetail($patient);
	        
	    }
	    $em->flush();
	    return $this->render('EasyDoseBundle:Default:index.html.twig');
	}
	
	public function setonealerteAction($idpatient){
		$em=$this->getDoctrine()
		->getManager();
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $idpatient);
		$patient->setNbdoses($this->getnbsoses($patient));
		$patient->setNrdhavealerte($this->NrdAlertpatient($patient));
		$patient->setSumhavealerte($this->PatientIsInAlert($patient));
		$patient->setHavenotes($this->havenotes($patient));
		$em->persist($patient);
		$em->flush();
		$this->NrdAlertpatientdetail($patient);
		return $this->render('EasyDoseBundle:Default:index.html.twig');
	}
	
	public function worklistsearchAction($nom,$prenom,$IPP,$IDR,$BD,$HDRV,$GENRE,$screenheigth){
		$listpatients=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient')
		->searchPatient(urldecode($nom),urldecode($prenom),urldecode($IPP),urldecode($IDR),urldecode($BD),urldecode($HDRV),$GENRE);
		
		$nbpages=$this->getNbPages($screenheigth);
		$nbpagesToview=ceil(count($listpatients),$nbpages);
		
		$isinlerte=[];
		$listenbdoses=[];
		$lsthavenotes=[];
		$listeNrd=[];

		$lastnotes=[];
		foreach ($listpatients as $patient){
			$lastnote=$this->getlastnote($patient);
			$content="";
			if($lastnote)
				$content=$lastnote;
				$lastnotes[$patient->getId()]=$content;
		}
		
		return $this->render('EasyDoseBundle:Patient:worklist.html.twig',[ 'patients' => $listpatients,'listenbdoses' => $listenbdoses,'isinlerte' => $isinlerte,'nbpagesToview' => $nbpagesToview,'offset'=>0,'lsthavenotes'=>$lsthavenotes,'listeNrd' => $listeNrd  ]);
	}
	
	
	public function savefilter($withradio,$withscan,$withmammo,$withnrd,$withpediatrie,$withpatientproc){
	    if($withradio !="-1")
	       $this->get('session')->set('withradio', $withradio);
	    if($withscan !="-1")
	       $this->get('session')->set('withscan', $withscan);
	    if($withmammo !="-1")
	       $this->get('session')->set('withmammo', $withmammo);
	    if($withnrd !="-1")
	       $this->get('session')->set('withnrd', $withnrd);
	    if($withpediatrie !="-1")
	        $this->get('session')->set('withpediatrie', $withpediatrie);
	    if($withpatientproc !="-1")
	       $this->get('session')->set('withpatientproc', $withpatientproc);
	    
	}
	
	public function savescreanAndOffset($offset,$screenheigth){
	    if($offset !="-1")
	       $this->get('session')->set('offset', $offset);
	    $this->get('session')->set('screenheigth', $screenheigth);
	}
	
	
	
	public function worklistsearchFiltreAction($withradio,$withscan,$withmammo,$withnrd,$withpediatrie,$withpatientproc,$screenheigth,$offset){
	    

	    
	    
	    $this->savefilter($withradio,$withscan,$withmammo,$withnrd,$withpediatrie,$withpatientproc);
	    $this->savescreanAndOffset($offset,$screenheigth);
	    
	    $nbpages=$this->getNbPages($screenheigth);
	    
	    $nb=$this->getDoctrine()
	    ->getManager()
	    ->getRepository('AppBundle\Entity\Patient')
	    ->getNBPatientFiltre(($this->get('session')->get('withradio')=="true"),($this->get('session')->get('withscan')=="true"),($this->get('session')->get('withmammo')=="true"),($this->get('session')->get('withnrd')=="true"),($this->get('session')->get('withpediatrie')=="true"),($this->get('session')->get('withpatientproc')=="true"));
	    
	    
	    $nbpagesToview=ceil($nb/$nbpages);
	    
	    $listpatients=$this->getDoctrine()
	    ->getManager()
	    ->getRepository('AppBundle\Entity\Patient')
	    ->searchPatientFiltre(($this->get('session')->get('withradio')=="true"),($this->get('session')->get('withscan')=="true"),($this->get('session')->get('withmammo')=="true"),($this->get('session')->get('withnrd')=="true"),($this->get('session')->get('withpediatrie')=="true"),($this->get('session')->get('withpatientproc')=="true"),$this->get('session')->get('offset')*$nbpages,$nbpages);
	    
	    
	    $isinlerte=[];
	    $listenbdoses=[];
	    $lsthavenotes=[];
	    $listeNrd=[];
	    
	    $lastnotes=[];
	    foreach ($listpatients as $patient){
	        $lastnote=$this->getlastnote($patient);
	        $content="";
	        if($lastnote)
	            $content=$lastnote;
	            $lastnotes[$patient->getId()]=$content;
	    }
	    
	    
	    
	    
	    return $this->render('EasyDoseBundle:Patient:worklist.html.twig',[ 'patients' => $listpatients,
	        'listenbdoses' => $listenbdoses,
	        'isinlerte' => $isinlerte,
	        'nbpagesToview' => $nbpagesToview,
	        'offset'=>$this->get('session')->get('offset'),
	        'lsthavenotes'=>$lsthavenotes,
	        'withradio' => $this->get('session')->get('withradio'),
	        'withscan' => $this->get('session')->get('withscan'),
	        'withmammo' =>  $this->get('session')->get('withmammo'),
	        'withnrd' => $this->get('session')->get('withnrd'),
	        'withpediatrie' => $this->get('session')->get('withpediatrie'),
	        'withpatientproc' => $this->get('session')->get('withpatientproc'),	        
	        'listeNrd' => $listeNrd  ]);
	}
	
	
	
	public function worklistAction($screenheigth){
		

		$nbpages=$this->getNbPages($screenheigth);
		$nbpagesToview=$this->getMaxNbPagesToView($nbpages);
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findBy(array(),array('id' => 'desc'),$nbpages,0);
		$isinlerte=[];
		$listenbdoses=[];
		$lsthavenotes=[];
		$listeNrd=[];

		return $this->render('EasyDoseBundle:Patient:worklist.html.twig',[ 'patients' => $listpatients,'listenbdoses' => $listenbdoses,'isinlerte' => $isinlerte,'nbpagesToview' => $nbpagesToview,'offset'=>0,'lsthavenotes'=>$lsthavenotes,'listeNrd' => $listeNrd ]);
	}
	
	
	public function worklistoffsetAction($offset,$screenheigth){
	
	
		$nbpages=$this->getNbPages($screenheigth);
		$nbpagesToview=$this->getMaxNbPagesToView($nbpages);
		$repository=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient');
		$listpatients=$repository->findBy(array(),array('id' => 'desc'),$nbpages,$offset*$nbpages);
		$isinlerte=[];
		$listenbdoses=[];
		$lsthavenotes=[];
		$listeNrd=[];
		return $this->render('EasyDoseBundle:Patient:worklist.html.twig',[ 'patients' => $listpatients,'listenbdoses' => $listenbdoses,'isinlerte' => $isinlerte,'nbpagesToview' => $nbpagesToview,'offset'=>$offset,'lsthavenotes'=>$lsthavenotes,'listeNrd' => $listeNrd   ]);
	}
	
	
	public function rechercheAction($words){
		
		$resultatrecherche=[];
		
		//recherche dans table dose
		$resultatpatient=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Patient')
		->GreatsearchPatient(explode("+",$words));
		$resultatrecherche=array_merge($resultatrecherche,$resultatpatient);
		
		//recherche dans la table détail dose
		$resultatddose=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\detail_dose')
		->searchdetaildoses(explode("+",$words));
		foreach ($resultatddose as $resultat)
		{
			$resultat->setId($this->getIdPatientByIdDose($resultat->getId()));
		}
		$resultatrecherche=array_merge($resultatrecherche,$resultatddose);
		
		
		return $this->render('EasyDoseBundle:Patient:resultat.html.twig',['resultatrecherche' =>$resultatrecherche]);
	}
	public function worklistbodyAction($id){
		
		
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $id);
		$note=$this->getlastnote($patient);

		return $this->render('EasyDoseBundle:Patient:ContenuWorklist/contenuworklist.html.twig',[ 'patient' => $patient,'note' => $note ]);
		
	}
	
	public function uploaddicomAction($valeur,$unite){
		return $this->render('EasyDoseBundle:Patient:uploaddicom.html.twig');
	}

	public function getmgyvalue($valeur,$unite){
		$conversionRepo=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Conversion');
		
		$valeurs=$conversionRepo->findByFacteur($unite);

		if($valeurs and count($valeurs)>0)
			return ["valeur" => $valeurs[0]->getFacteur()*$valeur, "unite" =>$valeurs[0]->getUnitecible()];
		else 
			return 0;
	}

	public function tdpatientAction($id){
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $id);
	
		$cou=0;
		$pelvis=0;
		$pied=0;
		$poitrine=0;
		$tete=0;
		$main=0;
		$abdomen=0;
		$leg=0;
		$nbdose=0;
		$genou=0;
		$colonne=0;
		$rachic=0;
		$rachil=0;
		
		$seingauche=0;
		$seindroit=0;
		
		$coumGycm2=0;
		$pelvisGycm2=0;
		$piedGycm2=0;
		$poitrineGycm2=0;
		$teteGycm2=0;
		$mainGycm2=0;
		$abdomenGycm2=0;
		$legGycm2=0;
		
		
		$genouGycm2=0;
		$colonneGycm2=0;
		$rachicGycm2=0;
		$rachilGycm2=0;
		
		
		$examens=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Examen')
		->geExamen($patient);
		
		$conversionRepo=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Conversion');
		
		
		
		
		$regiondosestab=[];
		$detaildosetab=[];
		foreach ($examens as $examen){
			$regiondose=$examen->getRegion();
			$regiondoses=$this->getDoctrine()
			->getManager()
			->getRepository('AppBundle\Entity\Region_Dose')
			->getDoses($regiondose);
			$regiondosestab=array_merge($regiondosestab,$regiondoses);
	
			foreach ($regiondoses as $rd){
				$nbdose++;
				$dose=$rd->getDose();
				if($dose->getModalite()!="CT"){
					$detaildose=$this->getDoctrine()
					->getManager()
					->getRepository('AppBundle\Entity\detail_dose')
					->getdetaildose($dose);
					$detaildosetab=array_merge($detaildosetab,$detaildose);
				}else{
					$detaildose=$this->getDoctrine()
					->getManager()
					->getRepository('AppBundle\Entity\detail_dose')
					->getdetaildose($dose);
	
					if($detaildose and count($detaildose)>0){
						if($detaildose[0]->getBodyPartEasydose() =='COU')
							$cou+=$dose->getValeur();
							//pelvis
							if($detaildose[0]->getBodyPartEasydose() =='PELVIS')
								$pelvis+=$dose->getValeur();
	
								if($detaildose[0]->getBodyPartEasydose() =='PIED')
									$pied+=$dose->getValeur();
	
									if($detaildose[0]->getBodyPartEasydose() =='POITRINE')
										$poitrine+=$dose->getValeur();
	
	
										if($detaildose[0]->getBodyPartEasydose() =='TETE')
											$tete+=$dose->getValeur();
												
											if($detaildose[0]->getBodyPartEasydose() =='MAIN')
												$main+=$dose->getValeur();
	
												if($detaildose[0]->getBodyPartEasydose() =='ABDOMEN')
													$abdomen+=$dose->getValeur();
														
													if($detaildose[0]->getBodyPartEasydose() =='LEG')
														$leg+=$dose->getValeur();
					}
				}
			}
	
		}
	
	
	
		foreach ($detaildosetab as $detaildose)
		{
			$valeurdose=$this->getmgyvalue($detaildose->getValeur(),$detaildose->getUnite());
			$valeur=$valeurdose["valeur"];
			//$valeur=($val==0)?0:sprintf("%.2e",$val);
			$unite=$valeurdose["unite"];
			if($detaildose->getBodyPartEasydose() =='COU')
			{
				if($unite=="mGy.cm")
					$cou+=$valeur;
				if($unite=="mGy.cm2")
					$coumGycm2+=$valeur;				
				//pelvis
			}
			if($detaildose->getBodyPartEasydose() =='GENOU')
			{
				if($unite=="mGy.cm")
					$genou+=$valeur;
				if($unite=="mGy.cm2")
					$genouGycm2+=$valeur;
							//pelvis
			}

			
			if($detaildose->getBodyPartEasydose() =='PELVIS')
			{
				if($unite=="mGy.cm")
					$pelvis+=$valeur;
					if($unite=="mGy.cm2")
						$pelvisGycm2+=$valeur;
						//pelvis
			}
			
			
			if($detaildose->getBodyPartEasydose() =='PIED')
			{
				if($unite=="mGy.cm")
					$pied+=$valeur;
				if($unite=="mGy.cm2")
					$piedGycm2+=$valeur;
			}
							
			
			
			if($detaildose->getBodyPartEasydose() =='POITRINE')
			{
				if($unite=="mGy.cm")
					$poitrine+=$valeur;
				if($unite=="mGy.cm2")
					$poitrineGycm2+=$valeur;
			}
			
								
			if($detaildose->getBodyPartEasydose() =='TETE')
			{
				if($unite=="mGy.cm")
					$tete+=$valeur;
				if($unite=="mGy.cm2")
					$teteGycm2+=$valeur;
			}
					
									
									
			if($detaildose->getBodyPartEasydose() =='MAIN')
			{
				if($unite=="mGy.cm")
					$main+=$valeur;
				if($unite=="mGy.cm2")
					$mainGycm2+=$valeur;
			}
						
			if($detaildose->getBodyPartEasydose() =='ABDOMEN')
			{
				if($unite=="mGy.cm")
					$abdomen+=$valeur;
				if($unite=="mGy.cm2")
					$abdomenGycm2+=$valeur;
			}

	
			if($detaildose->getBodyPartEasydose() =='LEG')
			{
				if($unite=="mGy.cm")
					$leg+=$valeur;
				if($unite=="mGy.cm2")
					$legGycm2+=$valeur;
			}
				
				
				
		}
		
		
		$cumul=$cou+$pelvis+$pied+$poitrine+$tete+$main+$abdomen+$leg;
		$nbmax=50;
		$cumulmax=1000;
	
		$lastnote=$this->getlastnote($patient);
		return $this->render('EasyDoseBundle:Patient:tabledosepatient.html.twig',[ 'patient' => $patient,'regiondosestable'=>$regiondosestab,'detaildose'=>$detaildosetab,
				'cou' => sprintf("%.2e",$cou)." mGy.cm",
				'pelvis' =>sprintf("%.2e",$pelvis)." mGy.cm",
				'pied' =>sprintf("%.2e",$pied)." mGy.cm",
				'poitrine' =>sprintf("%.2e",$poitrine)." mGy.cm",
				'tete' =>sprintf("%.2e",$tete)." mGy.cm",
				'main' =>sprintf("%.2e",$main)." mGy.cm",
				'abdomen' =>sprintf("%.2e",$abdomen)." mGy.cm",
				'leg' =>sprintf("%.2e",$leg)." mGy.cm",
				'seingauche'=>sprintf("%.2e",$seingauche)." mGy",
				'seindroit'=>sprintf("%.2e",$seindroit)." mGy",
				'coumGycm2' => sprintf("%.2e",$coumGycm2)." mGy.cm2",
				'pelvisGycm2' =>sprintf("%.2e",$pelvisGycm2)." mGy.cm2",
				'piedGycm2' =>sprintf("%.2e",$piedGycm2)." mGy.cm2",
				'poitrineGycm2' =>sprintf("%.2e",$poitrineGycm2)." mGy.cm2",
				'teteGycm2' =>sprintf("%.2e",$teteGycm2)." mGy.cm2",
				'mainGycm2' =>sprintf("%.2e",$mainGycm2)." mGy.cm2",
				'abdomenGycm2' =>sprintf("%.2e",$abdomenGycm2)." mGy.cm2",
				'legGycm2' =>sprintf("%.2e",$legGycm2)." mGy.cm2",
		    
		        'genou' =>sprintf("%.2e",$genou)." mGy.cm",
		        'genouGycm2' =>sprintf("%.2e",$genouGycm2)." mGy.cm2",
		    
		    
				'nbdose' => $nbdose,
				'cumul' => ($cumul==0)?0:sprintf("%.2e",$cumul),
				'nbmax' => $nbmax,
				'cumulmax' => $cumulmax,
				'lastnote'=>$lastnote
	
		]);
	
	}
	
	
	public function NrdAlertpatientdetail($patient){
	
		$em=$this->getDoctrine()
		->getManager();
		$examens=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Examen')
		->geExamen($patient);
	
	
		$detaildosetab=[];
		foreach ($examens as $examen){
			$regiondose=$examen->getRegion();
			$regiondoses=$this->getDoctrine()
			->getManager()
			->getRepository('AppBundle\Entity\Region_Dose')
			->getDoses($regiondose);
				
	
			foreach ($regiondoses as $rd){
				$dose=$rd->getDose();
				$detaildose=$this->getDoctrine()
				->getManager()
				->getRepository('AppBundle\Entity\detail_dose')
				->getdetaildose($dose);
				$detaildosetab=array_merge($detaildosetab,$detaildose);
	
	
			}
		}
	
		foreach ($detaildosetab as $detaildose)
		{
			$valeurdose=$this->getmgyvalue($detaildose->getValeur(),$detaildose->getUnite());
			$valeur=$valeurdose["valeur"];
			$unite=$valeurdose["unite"];
			$orientation="FACE";
			$calculseuil=$this->calculNRDSeuillatteint($patient,$detaildose->getBodyPartEasydose(),$unite,$valeurdose,$orientation,$detaildose->getProtocole(),$detaildose->getId(),$detaildose->getMachine(),$detaildose->getXrayTubeContent(),$detaildose);
			if ($calculseuil["seuilatteint"])
			{
				
			    $valeurseuilconverti=$calculseuil["seuilconverti"]["valeur"];
			    $uniteseuilconverti=$calculseuil["seuilconverti"]["unite"];
			    $tranche=$calculseuil["tranche"];
				if(strpos($uniteseuilconverti,"2")!==false){
				$detaildose->setUniteseuil("Gy.m2");
				$detaildose->setNrdvaleur($valeurseuilconverti/10000000);
				}else{
					$detaildose->setUniteseuil($uniteseuilconverti);
					$detaildose->setNrdvaleur($valeurseuilconverti);
				}
				$detaildose->setNrdhavealerte(true);
				$detaildose->setTrancheage($tranche);
				$em->persist($detaildose);
				$em->flush();
				
				
				
				//Calcul ESR
				
				
				
			}else {
				$detaildose->setNrdhavealerte(false);
				$em->persist($detaildose);
				$em->flush();
			}
		    
		}
		
		
	}
	
	public function NrdAlertpatient($patient){
		

		$examens=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Examen')
		->geExamen($patient);
		

		$detaildosetab=[];
		foreach ($examens as $examen){
			$regiondose=$examen->getRegion();
			$regiondoses=$this->getDoctrine()
			->getManager()
			->getRepository('AppBundle\Entity\Region_Dose')
			->getDoses($regiondose);
			
		
			foreach ($regiondoses as $rd){	
				$dose=$rd->getDose();
				$detaildose=$this->getDoctrine()
				->getManager()
				->getRepository('AppBundle\Entity\detail_dose')
				->getdetaildose($dose);
				$detaildosetab=array_merge($detaildosetab,$detaildose);
				
				
			}
		}
		
		$havenrd=false;
		$haveesr=false;
		
		
		$havenrdold=false;
		$haveesrold=false;
		$facteur=0;
		foreach ($detaildosetab as $detaildose)
		{
		    
			$valeurdose=$this->getmgyvalue($detaildose->getValeur(),$detaildose->getUnite());
			$valeur=$valeurdose["valeur"];
			$unite=$valeurdose["unite"];
			$orientation="FACE";
			$result=$this->calculNRDSeuillatteint($patient,$detaildose->getBodyPartEasydose(),$unite,$valeurdose,$orientation,$detaildose->getProtocole(),-1,$detaildose->getMachine(),$detaildose->getXrayTubeContent(),$detaildose);
			
			if ($result["seuilatteint"])
			{
			    if($result["esrdeclenche"])
			    {
			        $haveesr=true;
			        $facteur=$result["facteur"];
			        
			    }
			    else
			        $havenrd=true;
			   if($result["havenrdvaleur"])
			       $havenrdold=true;
			   if($result["haveesr"])
			       $haveesrold=true;
			         
			}
		}
		try{
			$sendemailalerte = $this->container->getParameter('sendemailalerte');
		}
		catch(\Exception $e){
			$sendemailalerte=true;
		}
		if($haveesr){
		    
		    if(!$havenrdold && $sendemailalerte=="true")
		      $this->sendmailESRAlerte($patient,$facteur);		    
		    return true;
		}
		else
	    if($havenrd) {
	        
	        if(!$havenrdold && !$haveesrold && $sendemailalerte=="true")
		      $this->sendmailNrdAlerte($patient);		    
		    return true;
		}
		return false;
	}
	
	
	public function infopatientAction(Request $request,$id){
		$patient=$this->getDoctrine()
		->getManager()
		->find('AppBundle\Entity\Patient', $id);
	
		$cou=0;
		$pelvis=0;
		$pied=0;
		$poitrine=0;
		$tete=0;
		$main=0;
		$abdomen=0;
		$leg=0;
		$nbdose=0;
		$corpsentier=0;
		$corpsentierGycm2=0;
		
		$genou=0;
		$genouGycm2=0;
		
		$seingauche=0;
		$seindroit=0;
		$coumGycm2=0;
		$pelvisGycm2=0;
		$piedGycm2=0;
		$poitrineGycm2=0;
		$teteGycm2=0;
		$mainGycm2=0;
		$abdomenGycm2=0;
		$legGycm2=0;
		
		
		
		$offset=$request->request->get("offset");
		
		$examens=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Examen')
		->geExamen($patient);
		
		$conversionRepo=$this->getDoctrine()
		->getManager()
		->getRepository('AppBundle\Entity\Examen');
		
		
		
		
		$regiondosestab=[];
		$detaildosetab=[];
		foreach ($examens as $examen){
			$regiondose=$examen->getRegion();
			$regiondoses=$this->getDoctrine()
			->getManager()
			->getRepository('AppBundle\Entity\Region_Dose')
			->getDoses($regiondose);
			$regiondosestab=array_merge($regiondosestab,$regiondoses);
	
			foreach ($regiondoses as $rd){
				$nbdose++;
				$dose=$rd->getDose();
				if($dose->getModalite()!="CT"){
					$detaildose=$this->getDoctrine()
					->getManager()
					->getRepository('AppBundle\Entity\detail_dose')
					->getdetaildose($dose);
					$detaildosetab=array_merge($detaildosetab,$detaildose);
				}else{
					$detaildose=$this->getDoctrine()
					->getManager()
					->getRepository('AppBundle\Entity\detail_dose')
					->getdetaildose($dose);
	
					if($detaildose and count($detaildose)>0){
						if($detaildose[0]->getBodyPartEasydose() =='COU')
							$cou+=$dose->getValeur();
							//pelvis
							if($detaildose[0]->getBodyPartEasydose() =='PELVIS')
								$pelvis+=$dose->getValeur();
	
								if($detaildose[0]->getBodyPartEasydose() =='PIED')
									$pied+=$dose->getValeur();
	
									if($detaildose[0]->getBodyPartEasydose() =='POITRINE')
										$poitrine+=$dose->getValeur();
	
	
										if($detaildose[0]->getBodyPartEasydose() =='TETE')
											$tete+=$dose->getValeur();
												
											if($detaildose[0]->getBodyPartEasydose() =='MAIN')
												$main+=$dose->getValeur();
	
												if($detaildose[0]->getBodyPartEasydose() =='ABDOMEN')
													$abdomen+=$dose->getValeur();
														
													if($detaildose[0]->getBodyPartEasydose() =='LEG')
														$leg+=$dose->getValeur();
					}
				}
			}
	
		}
	
	
	
		foreach ($detaildosetab as $detaildose)
		{
			$valeurdose=$this->getmgyvalue($detaildose->getValeur(),$detaildose->getUnite());
			$valeur=$valeurdose["valeur"];
			//$valeur=($val==0)?0:sprintf("%.2e",$val);
			$unite=$valeurdose["unite"];
			if($detaildose->getBodyPartEasydose() =='COU')
			{
				if($unite=="mGy.cm")
					$cou+=$valeur;
				if($unite=="mGy.cm2")
					$coumGycm2+=$valeur;
				//pelvis
			}
			if($detaildose->getBodyPartEasydose() =='PELVIS')
			{
				if($unite=="mGy.cm")
					$pelvis+=$valeur;
				if($unite=="mGy.cm2")
					$pelvisGycm2+=$valeur;
							//pelvis
			}
						
			if($detaildose->getBodyPartEasydose() =='PIED')
			{
				if($unite=="mGy.cm")
					$pied+=$valeur;
				if($unite=="mGy.cm2")
					$piedGycm2+=$valeur;
			}
			
			
			if($detaildose->getBodyPartEasydose() =='GENOU')
			{
			    if($unite=="mGy.cm")
			        $genou+=$valeur;
			    if($unite=="mGy.cm2")
			        $genouGycm2+=$valeur;
			            //pelvis
			}
			
			if($dose->getModalite()==="MG" && $detaildose->getBodyPartEasydose() =='POITRINE' && strpos($detaildose->getProtocole(),"R ")!==false)
			{
				$seindroit+=$valeur;
			}
			
			if($dose->getModalite()==="MG" && $detaildose->getBodyPartEasydose() =='POITRINE' && strpos($detaildose->getProtocole(),"L ")!==false)
			{
				$seingauche+=$valeur;
			}
							
			if($detaildose->getBodyPartEasydose() =='POITRINE')
			{
				if($unite=="mGy.cm")
					$poitrine+=$valeur;
				if($unite=="mGy.cm2")
					$poitrineGycm2+=$valeur;
			}

			if($detaildose->getBodyPartEasydose() =='BODYALL')
			{
				if($unite=="mGy.cm")
					$corpsentier+=$valeur;
				if($unite=="mGy.cm2")
					$corpsentierGycm2+=$valeur;
			}
			
			if($detaildose->getBodyPartEasydose() =='TETE')
			{
				if($unite=="mGy.cm")
					$tete+=$valeur;
				if($unite=="mGy.cm2")
					$teteGycm2+=$valeur;
			}
					
									
									
			if($detaildose->getBodyPartEasydose() =='MAIN')
			{
				if($unite=="mGy.cm")
					$main+=$valeur;
				if($unite=="mGy.cm2")
					$mainGycm2+=$valeur;
			}
						
			if($detaildose->getBodyPartEasydose() =='ABDOMEN')
			{
				if($unite=="mGy.cm")
					$abdomen+=$valeur;
				if($unite=="mGy.cm2")
					$abdomenGycm2+=$valeur;
			}

			
			if($detaildose->getBodyPartEasydose() =='LEG')
			{
				if($unite=="mGy.cm")
					$leg+=$valeur;
				if($unite=="mGy.cm2")
					$legGycm2+=$valeur;
			}
				
				
				
		}
		
		
		$cumul=$cou+$pelvis+$pied+$poitrine+$tete+$main+$abdomen+$leg+$genou;
		$nbmax=50;
		$cumulmax=1000;
	
		$lastnote=$this->getlastnote($patient);
		return $this->render('EasyDoseBundle:Patient:infopatient.html.twig',[ 'patient' => $patient,'regiondosestable'=>$regiondosestab,'detaildose'=>$detaildosetab,
				'cou' => sprintf("%.2e",$cou)." mGy.cm",
				'pelvis' =>sprintf("%.2e",$pelvis)." mGy.cm",
				'pied' =>sprintf("%.2e",$pied)." mGy.cm",
				'poitrine' =>sprintf("%.2e",$poitrine)." mGy.cm",
				'tete' =>sprintf("%.2e",$tete)." mGy.cm",
				'main' =>sprintf("%.2e",$main)." mGy.cm",
				'abdomen' =>sprintf("%.2e",$abdomen)." mGy.cm",
				'leg' =>sprintf("%.2e",$leg)." mGy.cm",
				
				'coumGycm2' => sprintf("%.2e",$coumGycm2)." mGy.cm2",
				'pelvisGycm2' =>sprintf("%.2e",$pelvisGycm2)." mGy.cm2",
				'piedGycm2' =>sprintf("%.2e",$piedGycm2)." mGy.cm2",
				'poitrineGycm2' =>sprintf("%.2e",$poitrineGycm2)." mGy.cm2",
				'teteGycm2' =>sprintf("%.2e",$teteGycm2)." mGy.cm2",
				'mainGycm2' =>sprintf("%.2e",$mainGycm2)." mGy.cm2",
				'abdomenGycm2' =>sprintf("%.2e",$abdomenGycm2)." mGy.cm2",
				'legGycm2' =>sprintf("%.2e",$legGycm2)." mGy.cm2",

				
				'corpsentier' =>sprintf("%.2e",$corpsentier)." mGy.cm",
				'corpsentierGycm2' =>sprintf("%.2e",$corpsentierGycm2)." mGy.cm2",
				'seingauche'=>sprintf("%.2e",$seingauche)." mGy",
				'seindroit'=>sprintf("%.2e",$seindroit)." mGy",
				
		    
		        'genou' =>sprintf("%.2e",$genou)." mGy.cm",
		        'genouGycm2' =>sprintf("%.2e",$genouGycm2)." mGy.cm2",
		    
				'nbdose' => $nbdose,
				'cumul' => ($cumul==0)?0:sprintf("%.2e",$cumul),
				'nbmax' => $nbmax,
				'cumulmax' => $cumulmax,
				'lastnote'=>$lastnote,
				'offset'=>$offset
	
		]);
	
	}
}
