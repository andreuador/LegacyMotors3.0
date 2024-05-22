<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522143307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD payment_details_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558EEC86F7 FOREIGN KEY (payment_details_id) REFERENCES payment_details (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849558EEC86F7 ON reservation (payment_details_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558EEC86F7');
        $this->addSql('DROP INDEX UNIQ_42C849558EEC86F7 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP payment_details_id');
    }
}
