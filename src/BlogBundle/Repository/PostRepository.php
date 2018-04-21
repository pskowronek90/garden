<?php

namespace BlogBundle\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function sortNewestToOldest()
    {
        return $this->getEntityManager()->createQuery('SELECT p FROM BlogBundle:Post p ORDER BY p.date DESC')
            ->getResult();
    }

}
