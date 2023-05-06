<?php

namespace Src\Controller;

use Src\Entity\People;

class PessoaController
{
    private $entityManagerFactory;
    public function __construct()
    {
        $this->entityManagerFactory = new \Src\Config\EntityManagerFactory();
    }

    public function index()
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $pessoaRepository = $entityManager->getRepository(People::class);
        $pessoas = $pessoaRepository->findAll();

        return $pessoas;
    }

    public function show($id)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $pessoaRepository = $entityManager->getRepository(People::class);
        $pessoa = $pessoaRepository->find($id);

        return $pessoa;
    }

    public function store(array $data)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $pessoa = new People();
        $pessoa->setName($data['name']);
        $pessoa->setCpf($data['cpf']);

        $entityManager->persist($pessoa);
        $entityManager->flush();

        return ['ok' => 'Pessoa salva com sucesso ' . $pessoa->getId()];
    }

    public function update($id, $data)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $pessoa = $entityManager->getRepository(People::class)->find($id);

        if (!$pessoa) {
            throw $this->createNotFoundException('Pessoa não encontrada');
        }

        $pessoa->setName($data['name']);
        $pessoa->setCpf($data['cpf']);

        $entityManager->flush();

        return ['ok' => 'Pessoa ' . $id . ' alterada com sucesso'];
    }

    public function destroy($id)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $pessoa = $entityManager->getRepository(People::class)->find($id);

        if (!$pessoa) {
            throw $this->createNotFoundException('Pessoa não encontrada');
        }

        $entityManager->remove($pessoa);
        $entityManager->flush();

        return ['ok' => 'Pessoa ' . $id . ' deletada com sucesso'];
    }
}
