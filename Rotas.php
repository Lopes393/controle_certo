<?php

require_once 'Lib/RoteadorAbstract.php';

class Rotas extends RoteadorAbstract
{
    public function __construct()
    {

        //Rotas de Pessoa
        $this->adicionarRota('GET', '/controle_certo', \Src\Controller\PeopleController::class, 'indexApi');
        $this->adicionarRota('GET', '/pessoas', \Src\Controller\PeopleController::class, 'index');
        $this->adicionarRota('GET', '/pessoas/{id}', \Src\Controller\PeopleController::class, 'show');
        $this->adicionarRota('POST', '/pessoas', \Src\Controller\PeopleController::class, 'store');
        $this->adicionarRota('PUT', '/pessoas/{id}', \Src\Controller\PeopleController::class, 'update');
        $this->adicionarRota('DELETE', '/pessoas/{id}', \Src\Controller\PeopleController::class, 'destroy');
        //Rotas de Contato
        $this->adicionarRota('GET', '/contatos', \Src\Controller\ContatoController::class, 'index');
        $this->adicionarRota('GET', '/contatos/{id}', \Src\Controller\ContatoController::class, 'show');
        $this->adicionarRota('POST', '/contatos', \Src\Controller\ContatoController::class, 'store');
        $this->adicionarRota('PUT', '/contatos/{id}', \Src\Controller\ContatoController::class, 'update');
        $this->adicionarRota('DELETE', '/contatos/{id}', \Src\Controller\ContatoController::class, 'destroy');
    }
}
