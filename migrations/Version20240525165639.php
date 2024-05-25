<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525165639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD payment_details_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098EEC86F7 FOREIGN KEY (payment_details_id) REFERENCES payment_details (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E098EEC86F7 ON customer (payment_details_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098EEC86F7');
        $this->addSql('DROP INDEX UNIQ_81398E098EEC86F7 ON customer');
        $this->addSql('ALTER TABLE customer DROP payment_details_id');
    }
}
