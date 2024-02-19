<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219102150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album RENAME INDEX idx_39986e43c2428192 TO IDX_39986E434296D31F');
        $this->addSql('ALTER TABLE album RENAME INDEX idx_39986e431f48ae04 TO IDX_39986E43B7970CF8');
        $this->addSql('ALTER TABLE playlist RENAME INDEX idx_d782112d9d86650f TO IDX_D782112DA76ED395');
        $this->addSql('ALTER TABLE playlist_song RENAME INDEX idx_93f4d9c3dc588714 TO IDX_93F4D9C36BBD148');
        $this->addSql('ALTER TABLE playlist_song RENAME INDEX idx_93f4d9c3b2e00b12 TO IDX_93F4D9C3A0BDB2F3');
        $this->addSql('ALTER TABLE preference RENAME INDEX idx_5d69b0539d86650f TO IDX_5D69B053A76ED395');
        $this->addSql('ALTER TABLE preference RENAME INDEX idx_5d69b0539fcd471 TO IDX_5D69B0531137ABCF');
        $this->addSql('ALTER TABLE song RENAME INDEX idx_33edeea19fcd471 TO IDX_33EDEEA11137ABCF');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album RENAME INDEX idx_39986e434296d31f TO IDX_39986E43C2428192');
        $this->addSql('ALTER TABLE album RENAME INDEX idx_39986e43b7970cf8 TO IDX_39986E431F48AE04');
        $this->addSql('ALTER TABLE playlist RENAME INDEX idx_d782112da76ed395 TO IDX_D782112D9D86650F');
        $this->addSql('ALTER TABLE playlist_song RENAME INDEX idx_93f4d9c36bbd148 TO IDX_93F4D9C3DC588714');
        $this->addSql('ALTER TABLE playlist_song RENAME INDEX idx_93f4d9c3a0bdb2f3 TO IDX_93F4D9C3B2E00B12');
        $this->addSql('ALTER TABLE preference RENAME INDEX idx_5d69b0531137abcf TO IDX_5D69B0539FCD471');
        $this->addSql('ALTER TABLE preference RENAME INDEX idx_5d69b053a76ed395 TO IDX_5D69B0539D86650F');
        $this->addSql('ALTER TABLE song RENAME INDEX idx_33edeea11137abcf TO IDX_33EDEEA19FCD471');
    }
}
