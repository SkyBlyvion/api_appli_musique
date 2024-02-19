<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219111632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539FCD471');
        $this->addSql('DROP INDEX IDX_5D69B0531137ABCF ON preference');
        $this->addSql('ALTER TABLE preference CHANGE album album_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0531137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_5D69B0531137ABCF ON preference (album_id)');
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA19FCD471');
        $this->addSql('DROP INDEX IDX_33EDEEA11137ABCF ON song');
        $this->addSql('ALTER TABLE song CHANGE album album_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA11137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_33EDEEA11137ABCF ON song (album_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0531137ABCF');
        $this->addSql('DROP INDEX IDX_5D69B0531137ABCF ON preference');
        $this->addSql('ALTER TABLE preference CHANGE album_id album INT DEFAULT NULL');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539FCD471 FOREIGN KEY (album) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_5D69B0531137ABCF ON preference (album)');
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA11137ABCF');
        $this->addSql('DROP INDEX IDX_33EDEEA11137ABCF ON song');
        $this->addSql('ALTER TABLE song CHANGE album_id album INT DEFAULT NULL');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA19FCD471 FOREIGN KEY (album) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_33EDEEA11137ABCF ON song (album)');
    }
}
