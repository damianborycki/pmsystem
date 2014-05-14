<?php

namespace Framework\Model\Infrastructure;

use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository 
{
    public function count()
    {
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select('count(entity.id)')
            ->from($this->_entityName, 'entity');

        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }
}