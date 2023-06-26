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

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    #[ORM\JoinColumn(name: 'related_user_id', nullable: false)]
    private ?user $relatedUser = null;

    #[ORM\Column(name: 'url', length: 255)]
    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRelatedUser(): ?user
    {
        return $this->relatedUser;
    }

    public function setRelatedUser(?user $relatedUser): static
    {
        $this->relatedUser = $relatedUser;

        return $this;
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
}
