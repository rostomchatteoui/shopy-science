<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $Amount = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    //#[ORM\Column]
    //private ?int $Quantity = null;

    #[ORM\Column(nullable: true)]
    private ?float $Discount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Item = null;

    #[ORM\Column(nullable: true)]
    private ?int $ItemDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $UnitCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $UnitDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $UnitPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $VATAmount = null;

    #[ORM\Column(nullable: true)]
    private ?float $VATPercentage = null;

    //#[ORM\ManyToOne(inversedBy: 'SalesOrderLines')]
    //private ?Order $orders = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->Amount;
    }

    public function setAmount(float $Amount): static
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->Discount;
    }

    public function setDiscount(float $Discount): static
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getItem(): ?string
    {
        return $this->Item;
    }

    public function setItem(string $Item): static
    {
        $this->Item = $Item;

        return $this;
    }

    public function getItemDescription(): ?int
    {
        return $this->ItemDescription;
    }

    public function setItemDescription(int $ItemDescription): static
    {
        $this->ItemDescription = $ItemDescription;

        return $this;
    }

    public function getUnitCode(): ?string
    {
        return $this->UnitCode;
    }

    public function setUnitCode(string $UnitCode): static
    {
        $this->UnitCode = $UnitCode;

        return $this;
    }

    public function getUnitDescription(): ?string
    {
        return $this->UnitDescription;
    }

    public function setUnitDescription(string $UnitDescription): static
    {
        $this->UnitDescription = $UnitDescription;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(string $UnitPrice): static
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }

    public function getVATAmount(): ?float
    {
        return $this->VATAmount;
    }

    public function setVATAmount(float $VATAmount): static
    {
        $this->VATAmount = $VATAmount;

        return $this;
    }

    public function getVATPercentage(): ?float
    {
        return $this->VATPercentage;
    }

    public function setVATPercentage(float $VATPercentage): static
    {
        $this->VATPercentage = $VATPercentage;

        return $this;
    }

    //public function getOrders(): ?Order
    //{
    //    return $this->orders;
    //}

    //public function setOrders(?Order $orders): static
    //{
        //$this->orders = $orders;

        //return $this;
    //}

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }

}
