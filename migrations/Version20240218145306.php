<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218145306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E431F48AE04');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43C2428192');
        $this->addSql('DROP INDEX IDX_39986E43C2428192 ON album');
        $this->addSql('DROP INDEX IDX_39986E431F48AE04 ON album');
        $this->addSql('ALTER TABLE album ADD genre_id_id INT DEFAULT NULL, ADD artist_id_id INT DEFAULT NULL, DROP genre_id, DROP artist_id');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E431F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43C2428192 FOREIGN KEY (genre_id_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_39986E43C2428192 ON album (genre_id_id)');
        $this->addSql('CREATE INDEX IDX_39986E431F48AE04 ON album (artist_id_id)');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D9D86650F');
        $this->addSql('DROP INDEX IDX_D782112D9D86650F ON playlist');
        $this->addSql('ALTER TABLE playlist CHANGE user_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D782112D9D86650F ON playlist (user_id_id)');
        $this->addSql('ALTER TABLE playlist_song DROP FOREIGN KEY FK_93F4D9C3B2E00B12');
        $this->addSql('ALTER TABLE playlist_song DROP FOREIGN KEY FK_93F4D9C3DC588714');
        $this->addSql('DROP INDEX IDX_93F4D9C3DC588714 ON playlist_song');
        $this->addSql('DROP INDEX IDX_93F4D9C3B2E00B12 ON playlist_song');
        $this->addSql('ALTER TABLE playlist_song ADD playlist_id_id INT DEFAULT NULL, ADD song_id_id INT DEFAULT NULL, DROP playlist_id, DROP song_id');
        $this->addSql('ALTER TABLE playlist_song ADD CONSTRAINT FK_93F4D9C3B2E00B12 FOREIGN KEY (song_id_id) REFERENCES song (id)');
        $this->addSql('ALTER TABLE playlist_song ADD CONSTRAINT FK_93F4D9C3DC588714 FOREIGN KEY (playlist_id_id) REFERENCES playlist (id)');
        $this->addSql('CREATE INDEX IDX_93F4D9C3DC588714 ON playlist_song (playlist_id_id)');
        $this->addSql('CREATE INDEX IDX_93F4D9C3B2E00B12 ON playlist_song (song_id_id)');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539FCD471');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539D86650F');
        $this->addSql('DROP INDEX IDX_5D69B0539FCD471 ON preference');
        $this->addSql('DROP INDEX IDX_5D69B0539D86650F ON preference');
        $this->addSql('ALTER TABLE preference ADD user_id_id INT DEFAULT NULL, ADD album_id_id INT DEFAULT NULL, DROP user_id, DROP album_id');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539FCD471 FOREIGN KEY (album_id_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5D69B0539FCD471 ON preference (album_id_id)');
        $this->addSql('CREATE INDEX IDX_5D69B0539D86650F ON preference (user_id_id)');
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA19FCD471');
        $this->addSql('DROP INDEX IDX_33EDEEA19FCD471 ON song');
        $this->addSql('ALTER TABLE song CHANGE album_id album_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA19FCD471 FOREIGN KEY (album_id_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_33EDEEA19FCD471 ON song (album_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43C2428192');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E431F48AE04');
        $this->addSql('DROP INDEX IDX_39986E43C2428192 ON album');
        $this->addSql('DROP INDEX IDX_39986E431F48AE04 ON album');
        $this->addSql('ALTER TABLE album ADD genre_id INT DEFAULT NULL, ADD artist_id INT DEFAULT NULL, DROP genre_id_id, DROP artist_id_id');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43C2428192 FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E431F48AE04 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_39986E43C2428192 ON album (genre_id)');
        $this->addSql('CREATE INDEX IDX_39986E431F48AE04 ON album (artist_id)');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D9D86650F');
        $this->addSql('DROP INDEX IDX_D782112D9D86650F ON playlist');
        $this->addSql('ALTER TABLE playlist CHANGE user_id_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D9D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D782112D9D86650F ON playlist (user_id)');
        $this->addSql('ALTER TABLE playlist_song DROP FOREIGN KEY FK_93F4D9C3DC588714');
        $this->addSql('ALTER TABLE playlist_song DROP FOREIGN KEY FK_93F4D9C3B2E00B12');
        $this->addSql('DROP INDEX IDX_93F4D9C3DC588714 ON playlist_song');
        $this->addSql('DROP INDEX IDX_93F4D9C3B2E00B12 ON playlist_song');
        $this->addSql('ALTER TABLE playlist_song ADD playlist_id INT DEFAULT NULL, ADD song_id INT DEFAULT NULL, DROP playlist_id_id, DROP song_id_id');
        $this->addSql('ALTER TABLE playlist_song ADD CONSTRAINT FK_93F4D9C3DC588714 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_song ADD CONSTRAINT FK_93F4D9C3B2E00B12 FOREIGN KEY (song_id) REFERENCES song (id)');
        $this->addSql('CREATE INDEX IDX_93F4D9C3DC588714 ON playlist_song (playlist_id)');
        $this->addSql('CREATE INDEX IDX_93F4D9C3B2E00B12 ON playlist_song (song_id)');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539D86650F');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539FCD471');
        $this->addSql('DROP INDEX IDX_5D69B0539D86650F ON preference');
        $this->addSql('DROP INDEX IDX_5D69B0539FCD471 ON preference');
        $this->addSql('ALTER TABLE preference ADD user_id INT DEFAULT NULL, ADD album_id INT DEFAULT NULL, DROP user_id_id, DROP album_id_id');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539FCD471 FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_5D69B0539D86650F ON preference (user_id)');
        $this->addSql('CREATE INDEX IDX_5D69B0539FCD471 ON preference (album_id)');
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA19FCD471');
        $this->addSql('DROP INDEX IDX_33EDEEA19FCD471 ON song');
        $this->addSql('ALTER TABLE song CHANGE album_id_id album_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA19FCD471 FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_33EDEEA19FCD471 ON song (album_id)');
    }
}
