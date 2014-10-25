<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141025022705 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql("
SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Dumping data for table `beverage`
--

INSERT INTO `beverage` (`id`, `name`, `sku`, `time`) VALUES
(1, 'Gin', '', '1'),
(2, 'Tequila', '', '1'),
(3, 'Vodka', '', '1'),
(4, 'Rhum', '', '1'),
(5, 'Triple Sec', '', '1'),
(6, 'Citron', '', '1'),
(7, 'Brandy', '', '1'),
(8, 'Whisky', '', '1'),
(9, 'Orange', '', '1'),
(10, 'Cranberry', '', '1');

--
-- Dumping data for table `beveragedrink`
--

INSERT INTO `beveragedrink` (`id`, `beverage_id`, `drink_id`, `qty`) VALUES
(1, 1, 1, '1.0000'),
(2, 2, 2, '1.0000'),
(3, 3, 3, '1.0000'),
(4, 4, 4, '1.0000'),
(5, 5, 5, '1.0000'),
(6, 6, 6, '1.0000'),
(7, 7, 7, '1.0000'),
(8, 8, 8, '1.0000'),
(9, 9, 9, '1.0000'),
(10, 10, 10, '1.0000'),
(11, 3, 11, '1.0000'),
(12, 5, 11, '0.5000'),
(13, 6, 11, '1.0000'),
(14, 4, 12, '2.0000'),
(15, 6, 12, '0.5000'),
(16, 3, 13, '0.5000'),
(17, 6, 13, '0.5000'),
(18, 1, 14, '0.5000'),
(19, 2, 14, '0.5000'),
(20, 3, 14, '0.5000'),
(21, 4, 14, '0.5000'),
(22, 5, 14, '0.5000'),
(23, 4, 15, '1.0000'),
(24, 5, 15, '0.5000'),
(25, 6, 15, '0.5000'),
(26, 2, 16, '0.5000'),
(27, 5, 16, '0.5000'),
(28, 6, 16, '1.0000'),
(29, 4, 17, '2.0000'),
(30, 6, 17, '1.0000'),
(31, 7, 17, '1.0000'),
(32, 9, 17, '1.0000'),
(33, 2, 18, '2.0000'),
(34, 9, 18, '6.0000'),
(35, 1, 19, '1.2500'),
(36, 6, 19, '1.0000'),
(37, 3, 20, '1.5000'),
(38, 9, 20, '1.0000'),
(39, 10, 20, '4.0000'),
(40, 7, 21, '1.0000'),
(41, 8, 21, '1.0000'),
(42, 9, 21, '0.5000'),
(43, 3, 22, '1.5000'),
(44, 6, 22, '0.5000'),
(45, 10, 22, '3.0000'),
(46, 3, 23, '1.0000'),
(47, 9, 23, '3.0000'),
(48, 2, 24, '1.0000'),
(49, 6, 24, '0.5000'),
(50, 1, 25, '3.0000'),
(51, 3, 26, '3.0000'),
(52, 6, 27, '0.2500'),
(53, 8, 27, '2.0000'),
(54, 1, 28, '1.0000'),
(55, 5, 28, '0.2500'),
(56, 6, 28, '0.7500'),
(57, 7, 28, '5.0000'),
(58, 9, 28, '4.0000'),
(59, 3, 29, '2.0000'),
(60, 6, 29, '0.5000'),
(61, 7, 29, '1.0000'),
(62, 6, 30, '0.5000'),
(63, 8, 30, '2.0000'),
(64, 8, 31, '2.0000'),
(65, 9, 31, '2.0000'),
(66, 3, 32, '1.0000'),
(67, 5, 32, '1.0000'),
(68, 9, 32, '0.5000'),
(69, 4, 33, '0.5000'),
(70, 5, 33, '0.5000'),
(71, 6, 33, '1.0000'),
(72, 7, 33, '0.5000'),
(73, 4, 34, '0.5000'),
(74, 5, 34, '0.5000'),
(75, 7, 34, '0.5000'),
(76, 2, 35, '0.5000'),
(77, 3, 35, '0.5000'),
(78, 8, 35, '0.5000'),
(79, 4, 36, '1.5000'),
(80, 10, 36, '1.5000'),
(81, 6, 37, '0.5000'),
(82, 7, 37, '2.0000'),
(83, 8, 37, '2.0000'),
(84, 3, 38, '1.5000'),
(85, 6, 38, '0.5000'),
(86, 9, 38, '1.0000'),
(87, 10, 38, '0.5000'),
(88, 6, 39, '2.0000'),
(89, 9, 39, '0.5000'),
(90, 1, 40, '0.5000'),
(91, 2, 40, '0.5000'),
(92, 3, 40, '0.5000'),
(93, 4, 40, '0.5000'),
(94, 5, 40, '0.5000'),
(95, 6, 40, '0.5000'),
(96, 7, 40, '0.5000'),
(97, 8, 40, '0.5000'),
(98, 9, 40, '0.5000'),
(99, 10, 40, '0.5000');

--
-- Dumping data for table `drink`
--

INSERT INTO `drink` (`id`, `name`) VALUES
(1, 'Gin (P)'),
(2, 'Tequila (P)'),
(3, 'Vodka (P)'),
(4, 'Rhum (P)'),
(5, 'Triple Sec (P)'),
(6, 'Citron (P)'),
(7, 'Brandy (P)'),
(8, 'Whiskey (P)'),
(9, 'Orange (P)'),
(10, 'Cranberry (P)'),
(11, 'Cosmopolitan (D)'),
(12, 'Cuba (D)'),
(13, 'Lemon Drop (S)'),
(14, 'Long Island Iced Tea (D)'),
(15, 'Mai Tai (D)'),
(16, 'Margarita (D)'),
(17, 'Zombie (D)'),
(18, 'Tequila Sunrise (C)'),
(19, 'Gimlet Recipe (D)'),
(20, 'Madras (C)'),
(21, 'Red Sundance (D)'),
(22, 'Cape Codder (C)'),
(23, 'Screw Driver (C)'),
(24, 'Tequila Shot (S)'),
(25, 'Martini Gin (D)'),
(26, 'Martini Vodka (D)'),
(27, 'Rusty Nail (D)'),
(28, 'Singapour Sling (C)'),
(29, 'Raisa (D)'),
(30, 'Whiskey Sour (D)'),
(31, 'Velvet Devil (D)'),
(32, 'Baby Aspirin (D)'),
(33, 'Between the Sheets (D)'),
(34, 'Bivari (S)'),
(35, 'The Buck Cherry (S)'),
(36, 'Jimmozor'),
(37, 'Fat Dick'),
(38, 'Drink My Cool-Aid'),
(39, 'Salsa Baby'),
(40, 'Hyper Thread');


SET FOREIGN_KEY_CHECKS=1;
COMMIT;
");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
