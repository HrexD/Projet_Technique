<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ToolsRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ToolsRepository::class)]
#[ORM\Table(name: 'tools')]
#[ApiResource]
class Tools
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'name', type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[ORM\Column(name: 'quantity', type: Types::INTEGER)]
    private ?int $quantity = null;

    #[ORM\OneToMany(mappedBy: 'tools', targetEntity: BookingEntry::class)]
    private Collection $bookingEntries;

    #[ORM\Column(name: 'slug', length: 255)]
    private ?string $slug = "";

    public function __construct()
    {
        $this->bookingEntries = new ArrayCollection();
    }

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
            $bookingEntry->setTools($this);
        }

        return $this;
    }

    public function removeBookingEntry(BookingEntry $bookingEntry): static
    {
        if ($this->bookingEntries->removeElement($bookingEntry)) {
            // set the owning side to null (unless already changed)
            if ($bookingEntry->getTools() === $this) {
                $bookingEntry->setTools(null);
            }
        }

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
}
