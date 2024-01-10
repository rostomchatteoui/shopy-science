<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109015156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE discount discount DOUBLE PRECISION DEFAULT NULL, CHANGE item_description item_description INT DEFAULT NULL, CHANGE vatamount vatamount DOUBLE PRECISION DEFAULT NULL, CHANGE vatpercentage vatpercentage DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE order_number order_number INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE discount discount DOUBLE PRECISION NOT NULL, CHANGE item_description item_description INT NOT NULL, CHANGE vatamount vatamount DOUBLE PRECISION NOT NULL, CHANGE vatpercentage vatpercentage DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE order_number order_number INT NOT NULL');
    }
}
