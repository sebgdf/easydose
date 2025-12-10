<?php

namespace UserBundle\Repository;

use CoreBundle\Repository\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends BaseRepository
{

    /**
     * @param array $criterias
     * @param array $orders
     * @param array $numbers
     * @param array $options
     * @return QueryBuilder
     */
    public function findMany($criterias = array(), $orders = array(), $numbers = array(), $options = array())
    {
        // TODO: Implement findMany() method.
    }

    /**
     * @param array $criterias
     * @param array $options
     * @return QueryBuilder
     */
    public function findOne($criterias = array(), $options = array())
    {
        // TODO: Implement findOne() method.
    }
    
    
    public function getusersingroups($group)
    {
    	$qb = $this->createQueryBuilder('u');
    	$qb->innerJoin('u.groups', 'g')
    	//->innerJoin('rd.region', 'r')
    	->where('g.name IN (:ds)')
    	->setParameter('ds', $group)
    	->addSelect('u')
    	;
    	return $qb->getQuery()->getResult();
    }
    
    
    public function issuperadmin(){
    	$qb = $this->createQueryBuilder('u');
    	$qb->innerJoin('u.groups', 'g')
    	//->innerJoin('rd.region', 'r')
    	->where('g.id IN (:ds)')
    	->setParameter('ds', 1)
    	->addSelect('u')
    	;
    		
    	return $qb->getQuery()->getResult()->rowCount()>0;
    }
}