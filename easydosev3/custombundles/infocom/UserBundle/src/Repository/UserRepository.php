<?php

namespace UserBundle\Repository;
use UserBundle\Entity\User;
use \Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends EntityRepository<User>
 */
class UserRepository extends EntityRepository
{
   
    /**
     * @param array $criterias
     * @param array $orders
     * @param array $numbers
     * @param array $options
     * @return QueryBuilder
     */
   // public function findMany($criterias = array(), $orders = array(), $numbers = array(), $options = array())
   // {
        // TODO: Implement findMany() method.
   // }
    public function getUserNotAdmin()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->select('u')
        ->where("u.username != :userAdmin")
        ->setParameter ( 'userAdmin', 'admin' )
        ->orderBy ( 'u.lastname, u.firstname', 'ASC' );
        
        return $qb;
    }

    /**
     * @param array $criterias
     * @param array $options
     * @return QueryBuilder
     */
   // public function findOne($criterias = array(), $options = array())
   // {
        // TODO: Implement findOne() method.
//}
}