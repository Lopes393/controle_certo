<?php

namespace Src;

use Src\Entity\Contato;

class ContatoController
{
    private $entityManagerFactory;
    public function __construct()
    {
        $this->entityManagerFactory = new \Src\Config\EntityManagerFactory();
    }


    /**
     * @Route("/product", name="product_list")
     */
    public function index()
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();

        $productRepository = $entityManager->getRepository(Contato::class);
        $products = $productRepository->findAllOrderedByName();

        return ['user' => 'ok', 'teste' => 123];
    }

    public function show($id)
    {
        return ['error' => 'User not found'];
    }

    public function store(array $data)
    {
        return $data;
    }

    public function update($id)
    {
        return json_encode(['error' => 'User not found']);
    }

    public function destroy($id)
    {
        return ['error' => 'User not found'];
    }
}
