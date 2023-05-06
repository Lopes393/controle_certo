<?php

namespace Src;

use Doctrine\ORM\EntityRepository;

class ContatoRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM Product p ORDER BY p.name ASC')
            ->getResult()
        ;
    }
}
