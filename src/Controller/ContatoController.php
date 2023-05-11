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

        $contact = new Contato();
        $contact->setType($data['type']);
        $contact->setDescription($data['description']);
        $contact->setIdPeople($data['idPeople']);

        $entityManager->persist($contact);
        $entityManager->flush();

        return ['ok' => 'Contato salvo com sucesso ' . $contact->getId()];
    }

    public function update($id, $data)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $contact = $entityManager->getRepository(Contato::class)->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Contato não encontrado');
        }

        $contact->setType($data['type']);
        $contact->setDescription($data['description']);

        $entityManager->flush();

        return ['ok' => 'Contato ' . $id . ' alterado com sucesso'];
    }

    public function destroy($id)
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $registro = $entityManager->getRepository(Contato::class)->find($id);

        if (!$registro) {
            throw $this->createNotFoundException('Contato não encontrado');
        }

        $entityManager->remove($registro);
        $entityManager->flush();

        return [
            'status' => 'success',
            'response' => 'Contato deletado com sucesso!'
        ];
    }
}
