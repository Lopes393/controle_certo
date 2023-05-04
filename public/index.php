<?php

require __DIR__ . '/../vendor/autoload.php';

switch (@$_SERVER['PATH_INFO']) {
    case '/listar-cursos':
        $controlador = new ListarCursos();
        $controlador->processaRequisicao();
        break;

    case '/novo-curso':
        $controlador = new FormularioInsercaoCurso();
        $controlador->processaRequisicao();
        break;

    case '':
    case '/':
    case '/index':
        $controlador = new Inicio();
        $controlador->processaRequisicao();
        break;

    default:
        echo "Erro 404 - Página não encontrada";
        break;
}
