<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251108194235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Poprawiona migracja z DEFAULT 0 dla nowych kolumn
        $this->addSql('CREATE TEMPORARY TABLE __temp__location AS SELECT id, city, country, liatitude, longitude FROM location');
        $this->addSql('DROP TABLE location');
        $this->addSql('CREATE TABLE location (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            city VARCHAR(255) NOT NULL,
            country VARCHAR(2) NOT NULL,
            liatitude NUMERIC(10, 7) NOT NULL,
            longitude NUMERIC(10, 7) NOT NULL
        )');
        $this->addSql('INSERT INTO location (id, city, country, liatitude, longitude) SELECT id, city, country, liatitude, longitude FROM __temp__location');
        $this->addSql('DROP TABLE __temp__location');

        $this->addSql('CREATE TEMPORARY TABLE __temp__measurement AS SELECT id, location_id, date, humidity FROM measurement');
        $this->addSql('DROP TABLE measurement');
        $this->addSql('CREATE TABLE measurement (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            location_id INTEGER NOT NULL,
            date DATE NOT NULL,
            humidity NUMERIC(5, 2) NOT NULL,
            celcius NUMERIC(3, 0) NOT NULL DEFAULT 0,
            pressure NUMERIC(7, 2) NOT NULL DEFAULT 0,
            wind_kmh NUMERIC(5, 2) NOT NULL DEFAULT 0,
            CONSTRAINT FK_2CE0D81164D218E FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE
        )');
        $this->addSql('INSERT INTO measurement (id, location_id, date, humidity) SELECT id, location_id, date, humidity FROM __temp__measurement');
        $this->addSql('DROP TABLE __temp__measurement');
        $this->addSql('CREATE INDEX IDX_2CE0D81164D218E ON measurement (location_id)');
    }

    public function down(Schema $schema): void
    {
        // Cofnięcie migracji
        $this->addSql('CREATE TEMPORARY TABLE __temp__location AS SELECT id, city, country, liatitude, longitude FROM location');
        $this->addSql('DROP TABLE location');
        $this->addSql('CREATE TABLE location (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            city VARCHAR(255) NOT NULL,
            country VARCHAR(255) NOT NULL,
            liatitude DOUBLE PRECISION DEFAULT NULL,
            longitude DOUBLE PRECISION DEFAULT NULL
        )');
        $this->addSql('INSERT INTO location (id, city, country, liatitude, longitude) SELECT id, city, country, liatitude, longitude FROM __temp__location');
        $this->addSql('DROP TABLE __temp__location');

        $this->addSql('CREATE TEMPORARY TABLE __temp__measurement AS SELECT id, location_id, date, humidity FROM measurement');
        $this->addSql('DROP TABLE measurement');
        $this->addSql('CREATE TABLE measurement (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            location_id INTEGER NOT NULL,
            date VARCHAR(255) NOT NULL,
            humidity DOUBLE PRECISION NOT NULL,
            temperature DOUBLE PRECISION NOT NULL,
            CONSTRAINT FK_2CE0D81164D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        )');
        $this->addSql('INSERT INTO measurement (id, location_id, date, humidity) SELECT id, location_id, date, humidity FROM __temp__measurement');
        $this->addSql('DROP TABLE __temp__measurement');
        $this->addSql('CREATE INDEX IDX_2CE0D81164D218E ON measurement (location_id)');
    }
}
