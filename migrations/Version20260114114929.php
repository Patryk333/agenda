<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260114114929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comarca (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE contacte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, telefon VARCHAR(15) NOT NULL, email VARCHAR(255) NOT NULL, comarca_id INT NOT NULL, INDEX IDX_C794A022BE4D4658 (comarca_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE contacte ADD CONSTRAINT FK_C794A022BE4D4658 FOREIGN KEY (comarca_id) REFERENCES comarca (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacte DROP FOREIGN KEY FK_C794A022BE4D4658');
        $this->addSql('DROP TABLE comarca');
        $this->addSql('DROP TABLE contacte');
    }
}
