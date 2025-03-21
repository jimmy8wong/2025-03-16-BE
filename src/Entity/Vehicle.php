<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
#[ORM\Table(name: 'vehicles')]
#[ORM\Index(columns: ['slug'], name: 'slug_idx')]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('slug')]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["vehicle:details"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["vehicle:details"])]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(["vehicle:details"])]
    private ?string $slug = null;

    #[ORM\Column]
    #[Groups(["vehicle:details"])]
    private array $technicalData = [];

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Make $make = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VehicleType $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTechnicalData(): ?array
    {
        return $this->technicalData;
    }

    public function setTechnicalData(?array $technicalData): static
    {
        $this->technicalData = $technicalData;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getMake(): ?Make
    {
        return $this->make;
    }

    public function setMake(?Make $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function getType(): ?VehicleType
    {
        return $this->type;
    }

    public function setType(?VehicleType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
