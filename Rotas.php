<?php

require_once 'Lib/RoteadorAbstract.php';

class Rotas extends RoteadorAbstract
{
    public function __construct()
    {
        //Rotas de Pessoa
        $this->adicionarRota('GET', '/pessoas', \Src\Controller\PessoaController::class, 'index');
        $this->adicionarRota('GET', '/pessoas/{id}', \Src\Controller\PessoaController::class, 'show');
        $this->adicionarRota('POST', '/pessoas', \Src\Controller\PessoaController::class, 'store');
        $this->adicionarRota('PUT', '/pessoas/{id}', \Src\Controller\PessoaController::class, 'update');
        $this->adicionarRota('DELETE', '/pessoas/{id}', \Src\Controller\PessoaController::class, 'destroy');
        //Rotas de Contato
        $this->adicionarRota('GET', '/contatos', \Src\Controller\ContatoController::class, 'index');
        $this->adicionarRota('GET', '/contatos/{id}', \Src\Controller\ContatoController::class, 'show');
        $this->adicionarRota('POST', '/contatos', \Src\Controller\ContatoController::class, 'store');
        $this->adicionarRota('PUT', '/contatos/{id}', \Src\Controller\ContatoController::class, 'update');
        $this->adicionarRota('DELETE', '/contatos/{id}', \Src\Controller\ContatoController::class, 'destroy');
    }
}
