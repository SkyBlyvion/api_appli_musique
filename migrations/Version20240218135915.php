<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218135915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE preference (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, album_id_id INT DEFAULT NULL, INDEX IDX_5D69B0539D86650F (user_id_id), INDEX IDX_5D69B0539FCD471 (album_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0539FCD471 FOREIGN KEY (album_id_id) REFERENCES album (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539D86650F');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0539FCD471');
        $this->addSql('DROP TABLE preference');
    }
}
