<?php

namespace DemoBundle\Repository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function showComments($id)
    {
        return $this->getEntityManager()->createQuery('SELECT * FROM comment WHERE task_id = :id')
            ->setParameter('id', $id);
    }
}