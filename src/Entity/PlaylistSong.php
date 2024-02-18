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
    private ?Playlist $playlist_id = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSongs')]
    private ?Song $song_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistId(): ?Playlist
    {
        return $this->playlist_id;
    }

    public function setPlaylistId(?Playlist $playlist_id): static
    {
        $this->playlist_id = $playlist_id;

        return $this;
    }

    public function getSongId(): ?Song
    {
        return $this->song_id;
    }

    public function setSongId(?Song $song_id): static
    {
        $this->song_id = $song_id;

        return $this;
    }
}
