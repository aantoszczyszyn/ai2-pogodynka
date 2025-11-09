<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeasurementRepository::class)]
class Measurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, nullable: true)]
    private ?string $celcius = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $humidity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2, nullable: true)]
    private ?string $pressure = null;

    #[ORM\Column(name: "wind_kmh", type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $windKmh = null;

    #[ORM\ManyToOne(targetEntity: Location::class, inversedBy: 'measurements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    // === GETTERY I SETTERY ===

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getCelcius(): ?string
    {
        return $this->celcius;
    }

    public function setCelcius(?string $celcius): self
    {
        $this->celcius = $celcius;
        return $this;
    }

    public function getHumidity(): ?string
    {
        return $this->humidity;
    }

    public function setHumidity(?string $humidity): self
    {
        $this->humidity = $humidity;
        return $this;
    }

    public function getPressure(): ?string
    {
        return $this->pressure;
    }

    public function setPressure(?string $pressure): self
    {
        $this->pressure = $pressure;
        return $this;
    }

    public function getWindKmh(): ?string
    {
        return $this->windKmh;
    }

    public function setWindKmh(?string $windKmh): self
    {
        $this->windKmh = $windKmh;
        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;
        return $this;
    }
}
