<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookingRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
#[ORM\Table(name: 'booking')]
#[ApiResource]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'start_date', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(name: 'end_date', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\ManyToOne(inversedBy: 'Bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'booking', targetEntity: BookingEntry::class)]
    private Collection $bookingEntries;

    public function __construct()
    {
        $this->bookingEntries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, BookingEntry>
     */
    public function getBookingEntries(): Collection
    {
        return $this->bookingEntries;
    }

    public function addBookingEntry(BookingEntry $bookingEntry): static
    {
        if (!$this->bookingEntries->contains($bookingEntry)) {
            $this->bookingEntries->add($bookingEntry);
            $bookingEntry->setBooking($this);
        }

        return $this;
    }

    public function removeBookingEntry(BookingEntry $bookingEntry): static
    {
        if ($this->bookingEntries->removeElement($bookingEntry)) {
            // set the owning side to null (unless already changed)
            if ($bookingEntry->getBooking() === $this) {
                $bookingEntry->setBooking(null);
            }
        }

        return $this;
    }
}
