<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $AccountName = null;

    #[ORM\Column(length: 255)]
    private ?string $AddressLine1 = null;

    #[ORM\Column(length: 255)]
    private ?string $City = null;

    #[ORM\Column(length: 255)]
    private ?string $ContactName = null;

    #[ORM\Column(length: 255)]
    private ?string $Country = null;

    #[ORM\Column(length: 255)]
    private ?string $ZipCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setID(string $ID): static
    {
        $this->ID = $ID;

        return $this;
    }

    public function getAccountName(): ?string
    {
        return $this->AccountName;
    }

    public function setAccountName(string $AccountName): static
    {
        $this->AccountName = $AccountName;

        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->AddressLine1;
    }

    public function setAddressLine1(string $AddressLine1): static
    {
        $this->AddressLine1 = $AddressLine1;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): static
    {
        $this->City = $City;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->ContactName;
    }

    public function setContactName(string $ContactName): static
    {
        $this->ContactName = $ContactName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): static
    {
        $this->Country = $Country;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->ZipCode;
    }

    public function setZipCode(string $ZipCode): static
    {
        $this->ZipCode = $ZipCode;

        return $this;
    }
}
