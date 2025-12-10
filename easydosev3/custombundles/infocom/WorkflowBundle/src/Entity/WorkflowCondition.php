<?php

namespace WorkflowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name:"workflow_condition")]
class WorkflowCondition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]
    private $id;


    #[ORM\ManyToOne(targetEntity: WorkflowTransition::class)]
    #[ORM\JoinColumn(name: 'workflow_transition', referencedColumnName: 'id', nullable:true)]
    protected $workflowTransition;

    ///**
    // * @var string
    // *
    // * @ORM\Column(name="condition_type", type="string", length=255, nullable=true, unique=false)
    // */
    #[ORM\Column(name:"condition_type", type:"string", length:255, nullable:true, unique:false)]
    private $conditionType;

    ///**
    // * @var string
    // *
    // * @ORM\Column(name="variable_name", type="string", length=255, nullable=true, unique=false)
    // */
    #[ORM\Column(name:"variable_name", type:"string", length:255, nullable:true, unique:false)]
    private $variableName;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set workflowTransition
     *
     * @param \WorkflowBundle\Entity\WorkflowTransition $workflowTransition
     *
     * @return WorkflowCondition
     */
    public function setWorkflowTransition(\WorkflowBundle\Entity\WorkflowTransition $workflowTransition = null)
    {
        $this->workflowTransition = $workflowTransition;

        return $this;
    }

    /**
     * Get workflowTransition
     *
     * @return \WorkflowBundle\Entity\WorkflowTransition
     */
    public function getWorkflowTransition()
    {
        return $this->workflowTransition;
    }

   /**
     * Set conditionType
     *
     * @param string $conditionType
     *
     * @return WorkflowCondition
     */
    public function setConditionType($conditionType)
    {
        $this->conditionType = $conditionType;

        return $this;
    }

    /**
     * Get conditionType
     *
     * @return string
     */
    public function getConditionType()
    {
        return $this->conditionType;
    }

    /**
     * Set variableName
     *
     * @param string $variableName
     *
     * @return WorkflowCondition
     */
    public function setVariableName($variableName)
    {
        $this->variableName = $variableName;

        return $this;
    }

    /**
     * Get variableName
     *
     * @return string
     */
    public function getVariableName()
    {
        return $this->variableName;
    }
}
