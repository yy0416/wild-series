<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Id = null;

    #[ORM\Column]
    private ?int $GeneratedValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getGeneratedValue(): ?int
    {
        return $this->GeneratedValue;
    }

    public function setGeneratedValue(int $GeneratedValue): self
    {
        $this->GeneratedValue = $GeneratedValue;

        return $this;
    }
}
