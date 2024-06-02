<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524182212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle ADD provider_id INT NOT NULL, ADD brand_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486A53A8AA ON vehicle (provider_id)');
        $this->addSql('CREATE INDEX IDX_1B80E48644F5D008 ON vehicle (brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486A53A8AA');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48644F5D008');
        $this->addSql('DROP INDEX IDX_1B80E486A53A8AA ON vehicle');
        $this->addSql('DROP INDEX IDX_1B80E48644F5D008 ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP provider_id, DROP brand_id');
    }
}
