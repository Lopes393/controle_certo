<?php

abstract class RoteadorAbstract
{
    protected $rotas = [];

    public function adicionarRota($metodo, $uri, $controller, $metodoController)
    {
        $this->rotas[] = [
            'metodo' => $metodo,
            'uri' => $uri,
            'controller' => $controller,
            'metodoController' => $metodoController,
        ];
    }

    public function executar($verb, $uri)
    {
        foreach ($this->rotas as $rota) {
            $placeholders = [];
            $pattern = preg_replace_callback('/\{([^\}]+)\}/', function ($matches) use (&$placeholders) {
                $placeholders[] = $matches[1];

                return '([^\/]+)';
            }, $rota['uri']);

            if ($verb == $rota['metodo'] && preg_match("#^{$pattern}$#", $uri, $matches)) {
                $params = array_combine($placeholders, array_slice($matches, 1));

                $controller = new $rota['controller']();
                $data = json_decode(file_get_contents('php://input'), true);

                if ('POST' == $verb) {
                    $response = call_user_func_array([$controller, $rota['metodoController']], [$data]);
                }
                if ('PUT' == $verb) {
                    $response = call_user_func_array([$controller, $rota['metodoController']], [current($params), $data]);
                }
                if ('GET' == $verb and count($params)) {
                    $response = call_user_func_array([$controller, $rota['metodoController']], [current($params)]);
                }

                if ('GET' == $verb and !count($params)) {
                    $response = call_user_func_array([$controller, $rota['metodoController']], [$data]);
                }

                // dd(json_encode($response));

                echo json_encode($response);

                return;
            }
        }

        // Se não houver correspondência de rota, retornar erro 404
        header('HTTP/1.0 404 Not Found');

        $verbLowercase = strtolower($verb);
        echo "Cannot {$verbLowercase} {$uri}";

        exit;
    }
}
