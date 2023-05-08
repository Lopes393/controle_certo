<?php

require '../vendor/autoload.php';

// require '../bootstrap.php';

// Incluir arquivo de roteamento

require_once '../Rotas.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
$rotas = new Rotas();

$uri = explode('/', $_SERVER['REQUEST_URI']);
// dd($uri);
if (count($uri) > 4) {
    $uri = $uri[3] . "/" . $uri[4];
} else {
    $uri = $uri[3];
}

$rotas->executar($_SERVER['REQUEST_METHOD'], "/" . $uri);
