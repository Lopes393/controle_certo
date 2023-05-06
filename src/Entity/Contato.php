<?php

namespace Src\Entity;

use Src\Entity\People;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contato")
 */
class Contato
{
    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */

    private string $type;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @ORM\Column(type="integer")
     *
     * @ORM\ManyToOne(targetEntity="People")
     *
     * @ORM\JoinColumn(name="idPeople", referencedColumnName="id")
     */
    private int $idPeople;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getIdPeople(): int
    {
        return $this->idPeople;
    }

    public function setIdPeople($idPeople)
    {
        $this->idPeople = $idPeople;
    }
}
