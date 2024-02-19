<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SongRepository;
use Vich\UploaderBundle\Entity\File;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: SongRepository::class)]
#[Vich\Uploadable]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $file_path = null;

    #[ORM\Column]
    private ?float $duration = null;

    #[ORM\ManyToOne(inversedBy: 'album')]
    private ?Album $album = null;

    #[ORM\OneToMany(targetEntity: PlaylistSong::class, mappedBy: 'song')]
    private Collection $playlistSongs;

    #[Vich\UploadableField(mapping: "songs", fileNameProperty: "filePath")]
    private ?File $filePathFile = null;

    public function getFilePathFile(): ?File
    {
        return $this->filePathFile;
    }

    public function setFilePathFile(?File $filePathFile = null): void
    {
        $this->filePathFile = $filePathFile;
    }


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

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function setFilePath(string $file_path): static
    {
        $this->file_path = $file_path;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

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
            $playlistSong->setSongId($this);
        }

        return $this;
    }

    public function removePlaylistSong(PlaylistSong $playlistSong): static
    {
        if ($this->playlistSongs->removeElement($playlistSong)) {
            // set the owning side to null (unless already changed)
            if ($playlistSong->getSongId() === $this) {
                $playlistSong->setSongId(null);
            }
        }

        return $this;
    }
}
