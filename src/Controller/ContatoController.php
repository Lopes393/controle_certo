<?php

namespace Src\Controller;

use Src\Entity\Contato;

class ContatoController
{
    private $entityManagerFactory;
    public function __construct()
    {
        $this->entityManagerFactory = new \Src\Config\EntityManagerFactory();
    }

    public function index()
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $contactRepository = $entityManager->getRepository(Contato::class);
        $contacts = $contactRepository->findAll();

        return $contacts;
    }

    public function show($id)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $contactRepository = $entityManager->getRepository(Contato::class);
        $contact = $contactRepository->find($id);

        return $contact;
    }

    public function store(array $data)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $contato = new Contato();
        $contato->setType($data['type']);
        $contato->setDescription($data['description']);
        $contato->setIdPeople($data['id_people']);

        $entityManager->persist($contato);
        $entityManager->flush();

        $idContato = $contato->getId();

        $contatoRepository = $entityManager->getRepository(Contato::class);
        $data = $contatoRepository->createQueryBuilder('c')
            ->select('c')
            ->andWhere(
                "c.id = $idContato"
            )
            ->getQuery()
            ->getArrayResult()[0];

        if ($data) {
            return [
                'status' => 'success',
                'title' => 'Contato salvo com sucesso',
                'contato' => $data
            ];
        }

        return [
            'status' => 'error',
            'title' => 'Erro ao salvar contato',
        ];
    }

    public function update($id, $data)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $contato = $entityManager->getRepository(Contato::class)->find($id);

        if (!$contato) {
            throw $this->createNotFoundException('Contato não encontrado');
        }

        $contato->setType($data['type']);
        $contato->setDescription($data['description']);
        $contato->setIdPeople($data['id_people']);

        $entityManager->persist($contato);
        $entityManager->flush();

        if ($contato) {
            return [
                'status' => 'success',
                'title' => 'Contato alterado com sucesso',
                'contato' => $data
            ];
        }

        return [
            'status' => 'error',
            'title' => 'Erro ao alterar contato',
        ];
    }

    public function destroy($id)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $registro = $entityManager->getRepository(Contato::class)->find($id);
        $idPeople = $registro->getIdPeople();
        if (!$registro) {
            throw $this->createNotFoundException('Contato não encontrado');
        }

        $entityManager->remove($registro);
        $entityManager->flush();

        return [
            'status' => 'success',
            'response' => 'Contato deletado com sucesso!',
            'id_people' => $idPeople
        ];
    }
}
