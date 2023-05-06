<?php

namespace Src;

use Doctrine\ORM\EntityRepository;

class ContatoRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT * FROM contato c ORDER BY c.name ASC')
            ->getResult();
    }
}
