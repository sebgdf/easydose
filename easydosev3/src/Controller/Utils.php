<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Controller\BootstrapTablereturn;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use App\Repository\DoseRepository;

use App\Controller\Simple\SimplePatient;
final class  Utils{
    private function getfilters(Request $request){
        $nrdhavealerte= $request->get('nrdhavealerte');
        $sumhavealerte= $request->get('sumhavealerte');
        $havenotes= $request->get('havenotes');
        $havemammo= $request->get('havemammo');
        $haveradio= $request->get('haveradio');
        $havescanner= $request->get('havescanner');
        $ishomme= $request->get('ishomme');
        $isfemme= $request->get('isfemme');
        $ispediatrie= $request->get('ispediatrie');
        $id= $request->get('id');
        $condition=array();

        if(isset($nrdhavealerte) && $nrdhavealerte=="1")
            $condition['nrdhavealerte']=true;
        if(isset($sumhavealerte) && $sumhavealerte=="1")
            $condition['sumhavealerte']=true;
        if(isset($havenotes) && $havenotes=="1")
            $condition['havenotes']=true;
        if(isset($havemammo) && $havemammo=="1")
            $condition['havemammo']=true;
        if(isset($haveradio) && $haveradio=="1")
            $condition['haveradio']=true;
        if(isset($havescanner) && $havescanner=="1")
            $condition['havescanner']=true;

        if(isset($ishomme) && $ishomme=="1")
            $condition['sex']='Homme';
        if(isset($isfemme) && $isfemme=="1")
            $condition['sex']='FEMME';
        if(isset($ispediatrie) && $ispediatrie=="1")
            $condition['ispediatrie']='1';
        if(isset($id))
            $condition['id']=$id;
        return $condition;
    }

    public  function foundpatient(Request $request,$entityManager){
        $offset= $request->get('offset');
            $limit= $request->get('limit');
            $condition= $this->getfilters($request);

            $sort=array();
            $sort['datelastexam'] = 'DESC';
            $bootstraptablereturn=$this->searchpatient($condition,$sort,$limit,$offset,$entityManager);

            $propertyInfo = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);

            $normalizers = [new ObjectNormalizer(
                new ClassMetadataFactory(new AttributeLoader()), null, null, $propertyInfo), new ArrayDenormalizer(),
            ];
            
            $serializer= new Serializer($normalizers, [new JsonEncoder()]);
            $data2 = $serializer->serialize($bootstraptablereturn,'json', [
                ObjectNormalizer::SKIP_NULL_VALUES => false,
                ObjectNormalizer::PRESERVE_EMPTY_OBJECTS => true,
                'circular_reference_handler' => function ($object): mixed {return $object;},
            
            ]);
            return new JsonResponse($data2, Response::HTTP_OK, [], true);
    }
   

    public  function foundpatientlight(Request $request,$entityManager){
        $offset= $request->get('offset');
            $limit= $request->get('limit');
            $condition= $this->getfilters($request);

            $sort=array();
            $sort['datelastexam'] = 'DESC';
            $bootstraptablereturn=$this->searchpatient($condition,$sort,$limit,$offset,$entityManager,true);

            $propertyInfo = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);

            $normalizers = [new ObjectNormalizer(
                new ClassMetadataFactory(new AttributeLoader()), null, null, $propertyInfo), new ArrayDenormalizer(),
            ];
            
            $serializer= new Serializer($normalizers, [new JsonEncoder()]);
            $data2 = $serializer->serialize($bootstraptablereturn,'json', [
                ObjectNormalizer::SKIP_NULL_VALUES => false,
                ObjectNormalizer::PRESERVE_EMPTY_OBJECTS => true,
                'circular_reference_handler' => function ($object): mixed {return $object;},
            
            ]);
            return new JsonResponse($data2, Response::HTTP_OK, [], true);
    }

    public  function getallprotocoles(Request $request,$entityManager, DoseRepository $doseRepository): JsonResponse{
                
            // Par exemple, l'URL sera : /protocols/filter-list?modalites=CT,MR
            $modalitesString = $request->query->get('modalites', ''); // Le second argument est la valeur par défaut si le paramètre est absent

            // 2. Transformer la chaîne de caractères en tableau
            // 'CT,MR' devient ['CT', 'MR']
            $modalites = [];
            if (!empty($modalitesString)) {
                // Supprime les espaces et divise la chaîne par la virgule
                $modalites = array_map('trim', explode(',', $modalitesString));
            }

            // 3. Appeler la méthode du dépôt
            $protocols = $doseRepository->findDistinctProtocolsByModalites($modalites);

            $propertyInfo = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);

            $normalizers = [new ObjectNormalizer(
                new ClassMetadataFactory(new AttributeLoader()), null, null, $propertyInfo), new ArrayDenormalizer(),
            ];
            
            $serializer= new Serializer($normalizers, [new JsonEncoder()]);
            $data2 = $serializer->serialize($protocols,'json', [
                ObjectNormalizer::SKIP_NULL_VALUES => false,
                ObjectNormalizer::PRESERVE_EMPTY_OBJECTS => true,
                'circular_reference_handler' => function ($object): mixed {return $object;},
            
            ]);
            return new JsonResponse($data2, Response::HTTP_OK, [], true);
    }
    
    private function searchpatient($condition,$sort,$limit,$offset,$entityManager,$isligth=false){
        $listpatients=$entityManager->getRepository('App\Entity\Patient')
        ->findBy($condition, $sort,$limit,$offset);
        $cnt=count($listpatients);

        $bootstraptablereturn=new BootstrapTablereturn();
        $bootstraptablereturn->total=$cnt;

        $listpatientsall=$entityManager->getRepository('App\Entity\Patient')
        ->findBy($condition, $sort);
        $cntall=count($listpatientsall);

        
        $bootstraptablereturn->totalNotFiltered=$cntall-$cnt;
        $bootstraptablereturn->rows=array();

        //Pour chaque patient, on récupère les examens
        $rpexamen=$entityManager->getRepository('App\Entity\Examen');
       
        foreach($listpatients as $pat){
            $simplePatient= new SimplePatient($pat);
            $lstexams=$rpexamen->findBy(['patient' =>$pat], []);
            if(!$isligth){
                foreach($lstexams as $exam){ 
                    $simpleexam=$simplePatient->addExamen($exam);               
                    $rpregion=$entityManager->getRepository('App\Entity\Region');
                    $reg=$rpregion->find($exam->getRegion());
                    $rpregiondose=$entityManager->getRepository('App\Entity\Region_Dose');
                    $rds=$rpregiondose->findBy(['region' => $reg]);
                    foreach($rds as $rd)
                    {
                        $dosesem=$entityManager->getRepository('App\Entity\Dose');
                        $dose=$dosesem->find($rd->getDose());
                        $simpleexam->setDose($dose);
                        $ddosesem=$entityManager->getRepository('App\Entity\Detail_dose');
                        $ddoses=$ddosesem->findBy([ 'dose'=> $rd->getDose()] );
                        $dose->setDetailDose($ddoses);
                        foreach($ddoses as $ddose)
                            $simpleexam->adddetailDose($ddose);
                        $rd->setDose($dose);
                    }
                }
            }
            $bootstraptablereturn->rows[]=  $simplePatient;
        }
        return $bootstraptablereturn;
    }

}