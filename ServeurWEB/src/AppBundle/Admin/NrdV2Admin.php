<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NrdV2Admin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('type')
            ->add('poids')
            ->add('bodypart')
            ->add('age')
            ->add('orientation')
            ->add('valeur')
            ->add('protocole')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
           // ->add('id')
            ->add('type')
            ->add('poids')
            ->add('bodypart')
            ->add('age')
          //  ->add('orientation')
            ->add('valeur')
            ->add('protocole')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->modelManager->getEntityManager ( 'AppBundle\Entity\TrancheAge' );
        
        
        $queryTrancheAge = $em->createQueryBuilder ( 't' )->select ( 't' )->from ( 'AppBundle:TrancheAge', 't' )->orderBy ( 't.id', 'ASC' );
        
        $formMapper
            //->add('id')
            ->add('type')
            ->add('poids')
            ->add('bodypart')
            ->add('age')
           // ->add('orientation')
            ->add('valeur')
            ->add('protocole')
            /*->add ( 'age', 'sonata_type_model', array (
                'label' => 'Tranche Age',
                'query' => $queryTrancheAge,
                'btn_add' => false,
                'required' => false
            ) )*/
        ;
            
           
    }

    
    
    public function getTemplate($name) {
        switch ($name) {
            /* case 'edit' :
                return 'AppBundle:NrdV2:nrdV2_edit.html.twig';
                break;
            case 'show' :
                return 'AppBundle:Facture:facture_show.html.twig';
                break;
            case 'list' :
                return 'AppBundle:Facture:facture_list.html.twig';
                break;*/
            default :
                return parent::getTemplate ( $name );
                break;
        }
    }
    
    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
           // ->add('id')
            ->add('type')
            ->add('poids')
            ->add('bodypart')
            ->add('age')
            //->add('orientation')
            ->add('valeur')
            ->add('protocole')
        ;
    }
}
