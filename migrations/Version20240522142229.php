<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522142229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle ADD provider_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486A53A8AA ON vehicle (provider_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486A53A8AA');
        $this->addSql('DROP INDEX IDX_1B80E486A53A8AA ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP provider_id');
    }
}
