<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: StockMovementRepository::class)]
class StockMovement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'stock')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $movementType = null; // 'entry' or 'exit'

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reason = null;

    // Getter and Setter for 'id'
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter and Setter for 'product'
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;
        return $this;
    }

    // Getter and Setter for 'quantity'
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;
        return $this;
    }

    // Getter and Setter for 'movementType'
    public function getMovementType(): ?string
    {
        return $this->movementType;
    }

    public function setMovementType(string $movementType): static
    {
        $this->movementType = $movementType;
        return $this;
    }

    // Getter and Setter for 'date'
    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;
        return $this;
    }

    // Getter and Setter for 'reason'
    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;
        return $this;
    }
}
