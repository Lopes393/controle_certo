<?php

namespace Src\Controller;

use Src\Entity\Contato;
use Src\Entity\People;

class PeopleController
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
        $pessoas = $pessoaRepository->createQueryBuilder('p')
            ->select('p')
            ->getQuery()->getArrayResult();

        return $pessoas;
    }

    public function show($id)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $pessoaRepository = $entityManager->getRepository(People::class);
        $pessoa = $pessoaRepository->createQueryBuilder('p')
            ->select('p')
            ->andWhere(
                "p.id = $id"
            )
            ->getQuery()
            ->getArrayResult()[0];

        $contatoRepository = $entityManager->getRepository(Contato::class);
        $contatos = $contatoRepository->createQueryBuilder('c')
            ->select('c')
            ->andWhere(
                "c.id_people = $id",
            )
            ->getQuery()->getArrayResult();


        $pessoa['contatos'] = $contatos;


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

        $idPessoa = $pessoa->getId();

        $pessoaRepository = $entityManager->getRepository(People::class);
        $data = $pessoaRepository->createQueryBuilder('p')
            ->select('p')
            ->andWhere(
                "p.id = $idPessoa"
            )
            ->getQuery()
            ->getArrayResult()[0];

        if ($data) {
            return [
                'status' => 'success',
                'title' => 'Pessoa salva com sucesso',
                'pessoa' => $data
            ];
        }

        return [
            'status' => 'error',
            'title' => 'Erro ao salvar pessoa',
        ];
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

        $pessoaRepository = $entityManager->getRepository(People::class);
        $data = $pessoaRepository->createQueryBuilder('p')
            ->select('p')
            ->andWhere(
                "p.id = $id"
            )
            ->getQuery()
            ->getArrayResult()[0];

        if ($data) {
            return [
                'status' => 'success',
                'title' => 'Pessoa alterada com sucesso',
                'pessoa' => $data
            ];
        }

        return [
            'status' => 'error',
            'title' => 'Erro ao alterar pessoa',
        ];
    }

    public function destroy($id)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();
        $registro = $entityManager->getRepository(People::class)->find($id);
        $contatos = $entityManager->getRepository(Contato::class)->findBy(['id_people' => $id]);

        if (!$registro) {
            throw $this->createNotFoundException('Pessoa não encontrada');
        }

        foreach ($contatos as $contato) {
            $entityManager->remove($contato);
            $entityManager->flush();
        }

        $entityManager->remove($registro);
        $entityManager->flush();

        return [
            'status' => 'success',
            'response' => 'Pessoa deletada com sucesso!'
        ];
    }
}
