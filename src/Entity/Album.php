<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column(length: 255)]
    private ?string $imagePath = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'artist_id')]
    private ?Genre $genre_id = null;

    #[ORM\ManyToOne(inversedBy: 'artist_id')]
    private ?Artist $artist_id = null;

    #[ORM\OneToMany(targetEntity: Song::class, mappedBy: 'album_id')]
    private Collection $album_id;

    public function __construct()
    {
        $this->album_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getGenreId(): ?Genre
    {
        return $this->genre_id;
    }

    public function setGenreId(?Genre $genre_id): static
    {
        $this->genre_id = $genre_id;

        return $this;
    }

    public function getArtistId(): ?Artist
    {
        return $this->artist_id;
    }

    public function setArtistId(?Artist $artist_id): static
    {
        $this->artist_id = $artist_id;

        return $this;
    }

    /**
     * @return Collection<int, Song>
     */
    public function getAlbumId(): Collection
    {
        return $this->album_id;
    }

    public function addAlbumId(Song $albumId): static
    {
        if (!$this->album_id->contains($albumId)) {
            $this->album_id->add($albumId);
            $albumId->setAlbumId($this);
        }

        return $this;
    }

    public function removeAlbumId(Song $albumId): static
    {
        if ($this->album_id->removeElement($albumId)) {
            // set the owning side to null (unless already changed)
            if ($albumId->getAlbumId() === $this) {
                $albumId->setAlbumId(null);
            }
        }

        return $this;
    }
}
