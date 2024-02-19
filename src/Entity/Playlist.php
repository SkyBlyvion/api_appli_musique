<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?User $user_id = null;

    #[ORM\OneToMany(targetEntity: PlaylistSong::class, mappedBy: 'playlist_id')]
    private Collection $playlistSongs;

    public function __construct()
    {
        $this->playlistSongs = new ArrayCollection();
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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, PlaylistSong>
     */
    public function getPlaylistSongs(): Collection
    {
        return $this->playlistSongs;
    }

    public function addPlaylistSong(PlaylistSong $playlistSong): static
    {
        if (!$this->playlistSongs->contains($playlistSong)) {
            $this->playlistSongs->add($playlistSong);
            $playlistSong->setPlaylistId($this);
        }

        return $this;
    }

    public function removePlaylistSong(PlaylistSong $playlistSong): static
    {
        if ($this->playlistSongs->removeElement($playlistSong)) {
            // set the owning side to null (unless already changed)
            if ($playlistSong->getPlaylistId() === $this) {
                $playlistSong->setPlaylistId(null);
            }
        }

        return $this;
    }
}