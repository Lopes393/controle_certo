<?php

namespace src\Helper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager(): EntityManagerInterface
    {
        $isDevMode = true;
        $rootDir = __DIR__ . '/../..';

        $config = Setup::createAnnotationMetadataConfiguration([$rootDir . "/src"], $isDevMode);

        $conn = [
            'dbname' => 'controle_certo',
            'user' => 'root',
            'password' => '@postgres',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];

        return EntityManager::create($conn, $config);
    }
}
