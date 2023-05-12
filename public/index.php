<?php

//header("Access-Control-Allow-Credentials: true");
//header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

require '../vendor/autoload.php';
require_once '../Rotas.php';

header("Access-Control-Allow-Origin: *");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}
$rotas = new Rotas();

$uri = explode('/', $_SERVER['REQUEST_URI']);

if (count($uri) > 4) {
    $uri = $uri[3] . "/" . $uri[4];
} else {
    $uri = $uri[3];
}

$rotas->executar($_SERVER['REQUEST_METHOD'], "/" . $uri);
//$rotas->executar('DELETE', "/" . 'contatos/5');
