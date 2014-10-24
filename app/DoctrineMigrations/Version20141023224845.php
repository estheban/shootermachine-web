<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141023224845 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Pump ADD beverage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Pump ADD CONSTRAINT FK_38251ED349F6E812 FOREIGN KEY (beverage_id) REFERENCES Beverage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38251ED349F6E812 ON Pump (beverage_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Pump DROP FOREIGN KEY FK_38251ED349F6E812');
        $this->addSql('DROP INDEX UNIQ_38251ED349F6E812 ON Pump');
        $this->addSql('ALTER TABLE Pump DROP beverage_id');
    }
}
