<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $biography = null;

    #[ORM\OneToMany(targetEntity: Album::class, mappedBy: 'artist_id')]
    private Collection $artist_id;

    public function __construct()
    {
        $this->artist_id = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getArtistId(): Collection
    {
        return $this->artist_id;
    }

    public function addArtistId(Album $artistId): static
    {
        if (!$this->artist_id->contains($artistId)) {
            $this->artist_id->add($artistId);
            $artistId->setArtistId($this);
        }

        return $this;
    }

    public function removeArtistId(Album $artistId): static
    {
        if ($this->artist_id->removeElement($artistId)) {
            // set the owning side to null (unless already changed)
            if ($artistId->getArtistId() === $this) {
                $artistId->setArtistId(null);
            }
        }

        return $this;
    }
}