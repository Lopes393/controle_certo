<?php

// Definir rotas
$routes = [
    ['GET', '/contatos', \Src\ContatoController::class, 'index'],
    ['POST', '/contatos', \Src\ContatoController::class, 'store'],
    ['PUT', '/contatos', \Src\ContatoController::class, 'update'],
    ['DELETE', '/contatos/{id}', \Src\ContatoController::class, 'destroy'],
];

function dispatch($method, $uri)
{
    global $routes;

    foreach ($routes as $route) {
        [$routeMethod, $routeUri, $action] = $route;

        // Comparar método e URI
        if ($method == $routeMethod && preg_match("#^{$routeUri}$#", $uri, $matches)) {
            // Obter nome do controlador e método
            [$verb, $uri, $controller, $method] = $route;
            // list($controllerName, $methodName) = explode('@', $action);

            // Executar método do controlador com argumentos
            $controller = new $controller();
            $data = json_decode(file_get_contents('php://input'), true);
            $response = call_user_func_array([$controller, $method], [$data, $entityManager]);
            echo json_encode($response);

            return;
        }
    }

    // Se não houver correspondência de rota, retornar erro 404
    header('HTTP/1.0 404 Not Found');

    $verbLowercase = strtolower($method);
    echo "Cannot {$verbLowercase} {$uri}";

    exit;
}
