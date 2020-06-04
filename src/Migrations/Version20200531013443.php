<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531013443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE hotel_group (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TEMPORARY TABLE __temp__hotel AS SELECT id, name, address FROM hotel');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('CREATE TABLE hotel (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , group_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , name VARCHAR(50) NOT NULL COLLATE BINARY, address VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_3535ED9FE54D947 FOREIGN KEY (group_id) REFERENCES hotel_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO hotel (id, name, address) SELECT id, name, address FROM __temp__hotel');
        $this->addSql('DROP TABLE __temp__hotel');
        $this->addSql('CREATE INDEX IDX_3535ED9FE54D947 ON hotel (group_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__review AS SELECT id, hotel_id, score, comment FROM review');
        $this->addSql('DROP TABLE review');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, hotel_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , score INTEGER NOT NULL, comment VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_794381C63243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO review (id, hotel_id, score, comment) SELECT id, hotel_id, score, comment FROM __temp__review');
        $this->addSql('DROP TABLE __temp__review');
        $this->addSql('CREATE INDEX IDX_794381C63243BB18 ON review (hotel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE hotel_group');
        $this->addSql('DROP INDEX IDX_3535ED9FE54D947');
        $this->addSql('CREATE TEMPORARY TABLE __temp__hotel AS SELECT id, name, address FROM hotel');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('CREATE TABLE hotel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, address VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO hotel (id, name, address) SELECT id, name, address FROM __temp__hotel');
        $this->addSql('DROP TABLE __temp__hotel');
        $this->addSql('DROP INDEX IDX_794381C63243BB18');
        $this->addSql('CREATE TEMPORARY TABLE __temp__review AS SELECT id, hotel_id, score, comment FROM review');
        $this->addSql('DROP TABLE review');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, score INTEGER NOT NULL, comment VARCHAR(255) DEFAULT NULL, hotel_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO review (id, hotel_id, score, comment) SELECT id, hotel_id, score, comment FROM __temp__review');
        $this->addSql('DROP TABLE __temp__review');
    }
}
