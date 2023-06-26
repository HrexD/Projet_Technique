<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookingEntryRepository;

#[ORM\Entity(repositoryClass: BookingEntryRepository::class)]
#[ORM\Table(name: 'booking_entry')]
#[ApiResource]
class BookingEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bookingEntries')]
    #[ORM\JoinColumn(name: 'related_booking_id', nullable: false)]
    private ?Booking $booking = null;

    #[ORM\ManyToOne(inversedBy: 'bookingEntries')]
    #[ORM\JoinColumn(name: 'related_tools_id', nullable: false)]
    private ?Tools $tools = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): static
    {
        $this->booking = $booking;

        return $this;
    }

    public function getTools(): ?Tools
    {
        return $this->tools;
    }

    public function setTools(?Tools $tools): static
    {
        $this->tools = $tools;

        return $this;
    }
}
