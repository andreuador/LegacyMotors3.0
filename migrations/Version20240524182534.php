<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524182534 extends AbstractMigration
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
        $this->addSql('ALTER TABLE review ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_794381C6B83297E7 ON review (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558EEC86F7');
        $this->addSql('DROP INDEX UNIQ_42C849558EEC86F7 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP payment_details_id');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6B83297E7');
        $this->addSql('DROP INDEX IDX_794381C6B83297E7 ON review');
        $this->addSql('ALTER TABLE review DROP reservation_id');
    }
}
