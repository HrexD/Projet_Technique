<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PicturesRepository;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
#[ORM\Table(name: 'pictures')]
#[ApiResource]
class Pictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'url', length: 255)]
    private ?string $url = null;

    #[ORM\OneToOne(inversedBy: 'pictures', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $relatedUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getRelatedUser(): ?User
    {
        return $this->relatedUser;
    }

    public function setRelatedUser(User $relatedUser): static
    {
        $this->relatedUser = $relatedUser;

        return $this;
    }
}
