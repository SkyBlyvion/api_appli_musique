<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219090616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, genre_id INT DEFAULT NULL, artist_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, release_date DATETIME NOT NULL, image_path VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_39986E43C2428192 (genre_id), INDEX IDX_39986E431F48AE04 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, biography LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_D782112D9D86650F (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_song (id INT AUTO_INCREMENT NOT NULL, playlist_id INT DEFAULT NULL, song_id INT DEFAULT NULL, INDEX IDX_93F4D9C3DC588714 (playlist_id), INDEX IDX_93F4D9C3B2E00B12 (song_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, album INT DEFAULT NULL, INDEX IDX_5D69B0539D86650F (user_id), INDEX IDX_5D69B0539FCD471 (album), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE song (id INT AUTO_INCREMENT NOT NULL, album_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, file_path VARCHAR(255) NOT NULL, duration DOUBLE PRECISION NOT NULL, INDEX IDX_33EDEEA19FCD471 (album), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43C2428192 FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E431F48AE04 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D9D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE playlist_song ADD CONSTRAINT FK_93F4D9C3DC588714 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_song ADD CONSTRAINT FK_93F4D9C3B2E00B12 FOREIGN KEY (song_id) REFERENCES song (id)');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539FCD471 FOREIGN KEY (album) REFERENCES album (id)');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA19FCD471 FOREIGN KEY (album) REFERENCES album (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43C2428192');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E431F48AE04');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D9D86650F');
        $this->addSql('ALTER TABLE playlist_song DROP FOREIGN KEY FK_93F4D9C3DC588714');
        $this->addSql('ALTER TABLE playlist_song DROP FOREIGN KEY FK_93F4D9C3B2E00B12');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539D86650F');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539FCD471');
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA19FCD471');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE playlist_song');
        $this->addSql('DROP TABLE preference');
        $this->addSql('DROP TABLE song');
        $this->addSql('DROP TABLE user');
    }
}
