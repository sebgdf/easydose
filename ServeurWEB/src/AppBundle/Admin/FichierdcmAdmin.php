<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FichierdcmAdmin extends AbstractAdmin
{
   
    
    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'date'  // name of the ordered field
        // (default = the model's id field, if any)
        
        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );
    
  
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            //->add('contenu')
            ->add('date')
            ->add('replay')
            ->add('replayed')
            ->add('out')
            ->add('traceback')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('contenu')
            ->add('date')
            ->add('replay', null, array (
                'label' => 'Replay',
                'editable' => true
            ))
            ->add('replayed', null, array (
                'label' => 'Replayed',
                'editable' => true
            ))
            ->add('out')
            ->add('traceback')
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
            //->add('id')
            ->add('contenu')
            ->add('date')
            ->add('replay')
            ->add('replayed')
            ->add('out')
            ->add('traceback')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('contenu')
            ->add('date')
            ->add('replay')
            ->add('replayed')
            ->add('out')
        ;
    }
}
