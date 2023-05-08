<?php

namespace src\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Src\Entity\Contato;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="people")
 */
class People
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private int $cpf;

    /**
     * @ORM\OneToMany(targetEntity="Contato", mappedBy="id_people")
     */
    private $contato;

    public function __construct()
    {
        $this->contato = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
}
