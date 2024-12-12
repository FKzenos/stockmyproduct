<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use App\Repository\ProductRepository;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $quantity = null;

    // Many-to-One relation with Category
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, StockMovement>
     */
    #[ORM\OneToMany(targetEntity: StockMovement::class, mappedBy: 'product')]
    private Collection $stock;

    public function __construct()
    {
        $this->stock = new ArrayCollection();
    }

    // Getter and Setter for 'id'
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter and Setter for 'name'
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    // Getter and Setter for 'description'
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    // Getter and Setter for 'price'
    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;
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

    // Getter for 'category'
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    // Setter for 'category'
    public function setCategory(?Category $category): static
    {
        $this->category = $category;
        return $this;
    }

    // Getter for 'stock' (OneToMany relation)
    public function getStock(): Collection
    {
        return $this->stock;
    }

    // Add a StockMovement
    public function addStock(StockMovement $stock): static
    {
        if (!$this->stock->contains($stock)) {
            $this->stock->add($stock);
            $stock->setProduct($this);
        }
        return $this;
    }

    // Remove a StockMovement
    public function removeStock(StockMovement $stock): static
    {
        if ($this->stock->removeElement($stock)) {
            if ($stock->getProduct() === $this) {
                $stock->setProduct(null);
            }
        }
        return $this;
    }
}
