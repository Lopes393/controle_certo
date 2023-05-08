<?php

namespace Src\Repository;

use Doctrine\ORM\EntityRepository;

class PeopleRepository extends EntityRepository
{
    public function findAllDados()
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->select('p', 'c')
            ->leftJoin('c.idPeople', 'p')
            ->getQuery();

        return $queryBuilder->getResult();
    }
}
