<?php

namespace App\Entity;

use App\Repository\PlaylistSongRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSongRepository::class)]
class PlaylistSong
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSongs')]
    private ?Playlist $playlist = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSongs')]
    private ?Song $song = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistId(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylistId(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getSongId(): ?Song
    {
        return $this->song;
    }

    public function setSongId(?Song $song): static
    {
        $this->song = $song;

        return $this;
    }
}
