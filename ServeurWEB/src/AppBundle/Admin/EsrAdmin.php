<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EsrAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nomDeclarant')
            ->add('prenomDeclarant')
            ->add('fonctionDeclarant')
            ->add('telephoneDeclarant')
            ->add('emailDeclarant')
            ->add('dateSurvenueESR')
            ->add('dateDetectionESR')
            ->add('heureSurvenueESR')
            ->add('heureDetectionESR')
            ->add('circonstancesDetection')
            ->add('origine')
            ->add('dispositif')
            ->add('agePersonneConserne')
            ->add('sex')
            ->add('type')
            ->add('typepersonnel')
            ->add('consequencereelleim')
            ->add('consequencepotentielle')
            ->add('actionconservatoires')
            ->add('actioncorrectives')
            ->add('dateSauvegarde')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nomDeclarant')
            ->add('prenomDeclarant')
            ->add('fonctionDeclarant')
            ->add('telephoneDeclarant')
            ->add('emailDeclarant')
            ->add('dateSurvenueESR')
            ->add('dateDetectionESR')
            ->add('heureSurvenueESR')
            ->add('heureDetectionESR')
            ->add('circonstancesDetection')
            ->add('origine')
            ->add('dispositif')
            ->add('agePersonneConserne')
            ->add('sex')
            ->add('type')
            ->add('typepersonnel')
            ->add('consequencereelleim')
            ->add('consequencepotentielle')
            ->add('actionconservatoires')
            ->add('actioncorrectives')
            ->add('dateSauvegarde')
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
        $formMapper
            ->add('id')
            ->add('nomDeclarant')
            ->add('prenomDeclarant')
            ->add('fonctionDeclarant')
            ->add('telephoneDeclarant')
            ->add('emailDeclarant')
            ->add('dateSurvenueESR')
            ->add('dateDetectionESR')
            ->add('heureSurvenueESR')
            ->add('heureDetectionESR')
            ->add('circonstancesDetection')
            ->add('origine')
            ->add('dispositif')
            ->add('agePersonneConserne')
            ->add('sex')
            ->add('type')
            ->add('typepersonnel')
            ->add('consequencereelleim')
            ->add('consequencepotentielle')
            ->add('actionconservatoires')
            ->add('actioncorrectives')
            ->add('dateSauvegarde')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nomDeclarant')
            ->add('prenomDeclarant')
            ->add('fonctionDeclarant')
            ->add('telephoneDeclarant')
            ->add('emailDeclarant')
            ->add('dateSurvenueESR')
            ->add('dateDetectionESR')
            ->add('heureSurvenueESR')
            ->add('heureDetectionESR')
            ->add('circonstancesDetection')
            ->add('origine')
            ->add('dispositif')
            ->add('agePersonneConserne')
            ->add('sex')
            ->add('type')
            ->add('typepersonnel')
            ->add('consequencereelleim')
            ->add('consequencepotentielle')
            ->add('actionconservatoires')
            ->add('actioncorrectives')
            ->add('dateSauvegarde')
        ;
    }
}
