<?php

namespace Src\Config;

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
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . "/../../src/Entity"], $isDevMode);

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
// use Doctrine\ORM\Tools\Setup;
// use Doctrine\ORM\EntityManager;

// require_once "vendor/autoload.php";

// $isDevMode = true;
// $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
// $conn = array(
//     'driver' => 'pdo_mysql',
//     'dbname' => 'controle_certo',
//     'user' => 'root',
//     'password' => '@postgres',
//     'host' => '192.168.0.100',
// );
// $entityManager = EntityManager::create($conn, $config);
