<?php

require_once('src/Config/EntityManagerFactory.php');

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use src\Config\EntityManagerFactory;


require_once __DIR__ . '/vendor/autoload.php';


$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);

// execute no terminal os comandos vendor\bin\doctrine.bat
// vendor\bin\doctrine list
// vendor\bin\doctrine.bat orm:info
// vendor\bin\doctrine.bat orm:mapping:describe ENTIDADE
// entityName People - Contact
// CRIAR TABELAS MAPEADAS DAS CLASSES
// vendor\bin\doctrine.bat orm:schema-tool:create