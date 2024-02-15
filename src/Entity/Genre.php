<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(targetEntity: Album::class, mappedBy: 'genre_id')]
    private Collection $genre_id;

    public function __construct()
    {
        $this->genre_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getArtistId(): Collection
    {
        return $this->genre_id;
    }

    public function addArtistId(Album $artistId): static
    {
        if (!$this->genre_id->contains($artistId)) {
            $this->genre_id->add($artistId);
            $artistId->setGenreId($this);
        }

        return $this;
    }

    public function removeArtistId(Album $artistId): static
    {
        if ($this->genre_id->removeElement($artistId)) {
            // set the owning side to null (unless already changed)
            if ($artistId->getGenreId() === $this) {
                $artistId->setGenreId(null);
            }
        }

        return $this;
    }
}
