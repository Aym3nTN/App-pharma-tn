<?php

namespace Aym3ntn\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NoteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
   public function findByRole($role){
       $qb = $this->createQueryBuilder('q')
           ->where('q.roles LIKE :role')
           ->setParameter('role','%'.$role.'%');

       return $qb->getQuery()->getResult();
   }
}