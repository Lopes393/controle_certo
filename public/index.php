<?php

require '../vendor/autoload.php';

// require '../bootstrap.php';

// Incluir arquivo de roteamento

require_once '../Rotas.php';

$rotas = new Rotas();
$rotas->executar('PUT', '/contatos/2');
//$rotas->executar($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
