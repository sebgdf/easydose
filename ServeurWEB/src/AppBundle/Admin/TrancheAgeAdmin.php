<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TrancheAgeAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('valmin')
            ->add('unitemin')
            ->add('valmax')
            ->add('unitemax')
            ->add('type')
            ->add('tranche')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
         //   ->add('id')
            ->add('valmin')
            ->add('unitemin')
            ->add('valmax')
            ->add('unitemax')
            ->add('type')
            ->add('tranche')
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
          //  ->add('id')
            ->add('valmin')
            ->add('unitemin')
            ->add('valmax')
            ->add('unitemax')
            ->add('type')
            ->add('tranche')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
          //  ->add('id')
            ->add('valmin')
            ->add('unitemin')
            ->add('valmax')
            ->add('unitemax')
            ->add('type')
            ->add('tranche')
        ;
    }
}
