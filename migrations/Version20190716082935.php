<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716082935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE contact_address ADD address_1 VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_address ADD address_2 VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_address ADD address_3 VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_address ADD address_4 VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_address DROP phone');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contact_address ADD phone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contact_address DROP address_1');
        $this->addSql('ALTER TABLE contact_address DROP address_2');
        $this->addSql('ALTER TABLE contact_address DROP address_3');
        $this->addSql('ALTER TABLE contact_address DROP address_4');
    }
}
