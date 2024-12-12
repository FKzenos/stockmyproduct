<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tesy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTesy(): ?string
    {
        return $this->tesy;
    }

    public function setTesy(string $tesy): static
    {
        $this->tesy = $tesy;

        return $this;
    }
}
