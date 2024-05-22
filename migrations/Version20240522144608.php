<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522144608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle ADD vehicle_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486508D62AC FOREIGN KEY (vehicle_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486508D62AC ON vehicle (vehicle_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486508D62AC');
        $this->addSql('DROP INDEX IDX_1B80E486508D62AC ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP vehicle_order_id');
    }
}
