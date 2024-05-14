<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514173015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand DROP is_deleted');
        $this->addSql('ALTER TABLE model DROP is_deleted');
        $this->addSql('ALTER TABLE provider CHANGE is_deleted is_deleted TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand ADD is_deleted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE model ADD is_deleted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE provider CHANGE is_deleted is_deleted TINYINT(1) DEFAULT NULL');
    }
}
