<?php

namespace App\Entity;

use App\Repository\ToolsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolsRepository::class)]
class Tools
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\OneToOne(mappedBy: 'relatedTools', cascade: ['persist', 'remove'])]
    private ?BookingEntry $bookingEntry = null;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getBookingEntry(): ?BookingEntry
    {
        return $this->bookingEntry;
    }

    public function setBookingEntry(BookingEntry $bookingEntry): static
    {
        // set the owning side of the relation if necessary
        if ($bookingEntry->getRelatedTools() !== $this) {
            $bookingEntry->setRelatedTools($this);
        }

        $this->bookingEntry = $bookingEntry;

        return $this;
    }
}
