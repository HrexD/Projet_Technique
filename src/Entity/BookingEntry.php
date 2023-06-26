<?php

namespace App\Entity;

use App\Repository\BookingEntryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingEntryRepository::class)]
class BookingEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'bookingEntry', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?booking $relatedBooking = null;

    #[ORM\OneToOne(inversedBy: 'bookingEntry', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tools $relatedTools = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRelatedBooking(): ?booking
    {
        return $this->relatedBooking;
    }

    public function setRelatedBooking(booking $relatedBooking): static
    {
        $this->relatedBooking = $relatedBooking;

        return $this;
    }

    public function getRelatedTools(): ?Tools
    {
        return $this->relatedTools;
    }

    public function setRelatedTools(Tools $relatedTools): static
    {
        $this->relatedTools = $relatedTools;

        return $this;
    }
}
