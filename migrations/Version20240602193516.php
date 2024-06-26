<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602193516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment_details ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment_details ADD CONSTRAINT FK_6B6F05609395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_6B6F05609395C3F3 ON payment_details (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment_details DROP FOREIGN KEY FK_6B6F05609395C3F3');
        $this->addSql('DROP INDEX IDX_6B6F05609395C3F3 ON payment_details');
        $this->addSql('ALTER TABLE payment_details DROP customer_id');
    }
}
