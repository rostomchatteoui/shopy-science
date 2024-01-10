<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Currency = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DeliverTo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $OrderID = null;

    #[ORM\Column(nullable: true)]
    private ?int $OrderNumber = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: Article::class)]
    private Collection $SalesOrderLines;

    public function __construct()
    {
        $this->SalesOrderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->Amount;
    }

    public function setAmount(int $Amount): static
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->Currency;
    }

    public function setCurrency(string $Currency): static
    {
        $this->Currency = $Currency;

        return $this;
    }

    public function getDeliverTo(): ?string
    {
        return $this->DeliverTo;
    }

    public function setDeliverTo(string $DeliverTo): static
    {
        $this->DeliverTo = $DeliverTo;

        return $this;
    }

    public function getOrderID(): ?string
    {
        return $this->OrderID;
    }

    public function setOrderID(string $OrderID): static
    {
        $this->OrderID = $OrderID;

        return $this;
    }

    public function getOrderNumber(): ?int
    {
        return $this->OrderNumber;
    }

    public function setOrderNumber(int $OrderNumber): static
    {
        $this->OrderNumber = $OrderNumber;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getSalesOrderLines(): Collection
    {
        return $this->SalesOrderLines;
    }

    public function addSalesOrderLine(Article $salesOrderLine): static
    {
        if (!$this->SalesOrderLines->contains($salesOrderLine)) {
            $this->SalesOrderLines->add($salesOrderLine);
            //$salesOrderLine->setOrders($this);
        }

        return $this;
    }

    public function removeSalesOrderLine(Article $salesOrderLine): static
    {
        if ($this->SalesOrderLines->removeElement($salesOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($salesOrderLine->getOrders() === $this) {
                $salesOrderLine->setOrders(null);
            }
        }

        return $this;
    }
}
