<?php

use src\Helper\EntityManagerFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Helper/EntityManagerFactory.php';

$entityManegerFactory = new EntityManagerFactory();
$entityManeger = $entityManegerFactory->getEntityManager();

$teste = $entityManeger->getConnection();

var_dump($teste);
