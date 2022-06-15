<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615205650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) NOT NULL, postal VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('CREATE TABLE carrier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, created_at DATETIME NOT NULL, carrier_name VARCHAR(255) NOT NULL, carrier_price DOUBLE PRECISION NOT NULL, delivery CLOB NOT NULL, is_paid BOOLEAN NOT NULL, reference VARCHAR(255) NOT NULL, stripe_session_id VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON "order" (user_id)');
        $this->addSql('CREATE TABLE order_details (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, my_order_id INTEGER NOT NULL, product VARCHAR(255) NOT NULL, quantity INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE INDEX IDX_845CA2C1BFCDF877 ON order_details (my_order_id)');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, description CLOB NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE "user"');
    }
}
