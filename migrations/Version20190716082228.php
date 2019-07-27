<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716082228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE contact_email_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_phone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contact_email (id INT NOT NULL, contact_id INT NOT NULL, type VARCHAR(1) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CAB86C7BE7A1254A ON contact_email (contact_id)');
        $this->addSql('CREATE TABLE contact_phone (id INT NOT NULL, contact_id INT NOT NULL, type VARCHAR(1) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_696587D2E7A1254A ON contact_phone (contact_id)');
        $this->addSql('CREATE TABLE contact_address (id INT NOT NULL, contact_id INT NOT NULL, type VARCHAR(1) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97614E00E7A1254A ON contact_address (contact_id)');
        $this->addSql('ALTER TABLE contact_email ADD CONSTRAINT FK_CAB86C7BE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contact_phone ADD CONSTRAINT FK_696587D2E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contact_address ADD CONSTRAINT FK_97614E00E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE contact_email_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_phone_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_address_id_seq CASCADE');
        $this->addSql('DROP TABLE contact_email');
        $this->addSql('DROP TABLE contact_phone');
        $this->addSql('DROP TABLE contact_address');
    }
}
