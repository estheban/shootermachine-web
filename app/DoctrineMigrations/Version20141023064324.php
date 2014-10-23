<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141023064324 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE Beverage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, sku VARCHAR(255) NOT NULL, time NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE BeverageDrink (id INT AUTO_INCREMENT NOT NULL, beverage_id INT DEFAULT NULL, drink_id INT DEFAULT NULL, qty NUMERIC(10, 0) NOT NULL, INDEX IDX_9D6C11C249F6E812 (beverage_id), INDEX IDX_9D6C11C236AA4BB4 (drink_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Drink (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Pump (id INT AUTO_INCREMENT NOT NULL, pin INT NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE BeverageDrink ADD CONSTRAINT FK_9D6C11C249F6E812 FOREIGN KEY (beverage_id) REFERENCES Beverage (id)');
        $this->addSql('ALTER TABLE BeverageDrink ADD CONSTRAINT FK_9D6C11C236AA4BB4 FOREIGN KEY (drink_id) REFERENCES Drink (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE BeverageDrink DROP FOREIGN KEY FK_9D6C11C249F6E812');
        $this->addSql('ALTER TABLE BeverageDrink DROP FOREIGN KEY FK_9D6C11C236AA4BB4');
        $this->addSql('DROP TABLE Beverage');
        $this->addSql('DROP TABLE BeverageDrink');
        $this->addSql('DROP TABLE Drink');
        $this->addSql('DROP TABLE Pump');
    }
}
