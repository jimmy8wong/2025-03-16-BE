<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317230646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicle_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE INDEX slug_idx ON makes (slug)');
        $this->addSql('ALTER TABLE vehicles ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicles ADD CONSTRAINT FK_1FCE69FAC54C8C93 FOREIGN KEY (type_id) REFERENCES vehicle_types (id)');
        $this->addSql('CREATE INDEX IDX_1FCE69FAC54C8C93 ON vehicles (type_id)');
        $this->addSql('CREATE INDEX slug_idx ON vehicles (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicles DROP FOREIGN KEY FK_1FCE69FAC54C8C93');
        $this->addSql('DROP TABLE vehicle_types');
        $this->addSql('DROP INDEX slug_idx ON makes');
        $this->addSql('DROP INDEX IDX_1FCE69FAC54C8C93 ON vehicles');
        $this->addSql('DROP INDEX slug_idx ON vehicles');
        $this->addSql('ALTER TABLE vehicles DROP type_id');
    }
}
