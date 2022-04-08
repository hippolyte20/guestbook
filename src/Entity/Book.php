<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $lat;

    #[ORM\Column(type: 'float')]
    private $lng;

    #[ORM\Column(type: 'float')]
    private $lat2;

    #[ORM\Column(type: 'float')]
    private $lng2;

    #[ORM\Column(type: 'string', length: 255)]
    private $transmean;

    
    #[ORM\Column(type: 'datetime')]
    private $reserveAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private $usere;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $numconducteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getLat2(): ?float
    {
        return $this->lat2;
    }

    public function setLat2(float $lat2): self
    {
        $this->lat2 = $lat2;

        return $this;
    }

    public function getLng2(): ?float
    {
        return $this->lng2;
    }

    public function setLng2(float $lng2): self
    {
        $this->lng2 = $lng2;

        return $this;
    }

    public function getTransmean(): ?string
    {
        return $this->transmean;
    }

    public function setTransmean(string $transmean): self
    {
        $this->transmean = $transmean;

        return $this;
    }

    public function getReserveAt(): ?\DateTimeInterface
    {
        return $this->reserveAt;
    }

    public function setReserveAt(\DateTimeInterface $reserveAt): self
    {
        $this->reserveAt = $reserveAt;

        return $this;
    }

    public function getUsere(): ?User
    {
        return $this->usere;
    }

    public function setUsere(?User $usere): self
    {
        $this->usere = $usere;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getNumconducteur(): ?int
    {
        return $this->numconducteur;
    }

    public function setNumconducteur(int $numconducteur): self
    {
        $this->numconducteur = $numconducteur;

        return $this;
    }
}
