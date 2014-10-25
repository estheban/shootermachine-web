<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141025023234 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    $this->addSql("
INSERT INTO `Pump` (`id`, `pin`, `active`, `beverage_id`)
VALUES
	(1,2,1,1),
	(2,3,1,2),
	(3,4,1,3),
	(4,5,1,4),
	(5,6,1,5),
	(6,7,1,6),
	(7,8,1,7),
	(8,9,1,8),
	(9,10,1,9),
	(10,11,1,10);
");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
