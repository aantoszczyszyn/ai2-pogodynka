<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 7, nullable: true)]
    private ?string $liatitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 7, nullable: true)]
    private ?string $longitude = null;

    /**
     * @var Collection<int, Measurement>
     */
    #[ORM\OneToMany(targetEntity: Measurement::class, mappedBy: 'location')]
    private Collection $measurements;

    public function __construct()
    {
        $this->measurements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getLiatitude(): ?string
    {
        return $this->liatitude;
    }

    public function setLiatitude(?string $liatitude): self
    {
        $this->liatitude = $liatitude;
        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return Collection<int, Measurement>
     */
    public function getMeasurements(): Collection
    {
        return $this->measurements;
    }

    public function addMeasurement(Measurement $measurement): self
    {
        if (!$this->measurements->contains($measurement)) {
            $this->measurements->add($measurement);
            $measurement->setLocation($this);
        }

        return $this;
    }

    public function removeMeasurement(Measurement $measurement): self
    {
        if ($this->measurements->removeElement($measurement)) {
            if ($measurement->getLocation() === $this) {
                $measurement->setLocation(null);
            }
        }

        return $this;
    }
}
