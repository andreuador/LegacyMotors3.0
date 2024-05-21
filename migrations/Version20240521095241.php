<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521095241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee CHANGE is_deleted is_deleted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice ADD is_deleted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD is_deleted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE provider CHANGE is_deleted is_deleted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD is_deleted TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP is_deleted');
        $this->addSql('ALTER TABLE employee CHANGE is_deleted is_deleted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE provider CHANGE is_deleted is_deleted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP is_deleted');
        $this->addSql('ALTER TABLE invoice DROP is_deleted');
    }
}
