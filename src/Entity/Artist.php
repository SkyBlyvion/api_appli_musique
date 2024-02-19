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

    #[ORM\OneToMany(targetEntity: Album::class, mappedBy: 'artist')]
    private Collection $album;

    public function __construct()
    {
        $this->album = new ArrayCollection();
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
    public function getartist(): Collection
    {
        return $this->album;
    }

    public function addartist(Album $artist): static
    {
        if (!$this->album->contains($artist)) {
            $this->album->add($artist);
            $artist->setartist($this);
        }

        return $this;
    }

    public function removeartist(Album $artist): static
    {
        if ($this->album->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getArtist() === $this) {
                $artist->setArtist(null);
            }
        }

        return $this;
    }
}
