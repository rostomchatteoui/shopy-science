<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109014919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66CFFE9AD6');
        $this->addSql('DROP INDEX IDX_23A0E66CFFE9AD6 ON article');
        $this->addSql('ALTER TABLE article DROP orders_id, CHANGE amount amount DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE amount amount INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD orders_id INT DEFAULT NULL, CHANGE amount amount DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66CFFE9AD6 ON article (orders_id)');
        $this->addSql('ALTER TABLE `order` CHANGE amount amount INT NOT NULL');
    }
}
