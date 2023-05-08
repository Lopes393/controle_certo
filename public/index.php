<?php

require '../vendor/autoload.php';

// require '../bootstrap.php';

// Incluir arquivo de roteamento

require_once '../Rotas.php';

$rotas = new Rotas();

//$rotas->executar('GET', '/controle_certo');
$rotas->executar($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
