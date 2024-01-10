<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109015911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE unit_code unit_code VARCHAR(255) DEFAULT NULL, CHANGE unit_description unit_description VARCHAR(255) DEFAULT NULL, CHANGE unit_price unit_price VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE currency currency VARCHAR(255) DEFAULT NULL, CHANGE deliver_to deliver_to VARCHAR(255) DEFAULT NULL, CHANGE order_id order_id VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE unit_code unit_code VARCHAR(255) NOT NULL, CHANGE unit_description unit_description VARCHAR(255) NOT NULL, CHANGE unit_price unit_price VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE currency currency VARCHAR(255) NOT NULL, CHANGE deliver_to deliver_to VARCHAR(255) NOT NULL, CHANGE order_id order_id VARCHAR(255) NOT NULL');
    }
}
