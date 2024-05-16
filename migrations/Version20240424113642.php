<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424113642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E092989F1FD');
        $this->addSql('DROP INDEX IDX_81398E092989F1FD ON customer');
        $this->addSql('ALTER TABLE customer DROP invoice_id');
        $this->addSql('ALTER TABLE invoice ADD orders_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_90651744CFFE9AD6 ON invoice (orders_id)');
        $this->addSql('ALTER TABLE model ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('ALTER TABLE reservation ADD payment_details_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558EEC86F7 FOREIGN KEY (payment_details_id) REFERENCES payment_details (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849558EEC86F7 ON reservation (payment_details_id)');
        $this->addSql('ALTER TABLE review ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_794381C6B83297E7 ON review (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('DROP INDEX IDX_D79572D944F5D008 ON model');
        $this->addSql('ALTER TABLE model DROP brand_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558EEC86F7');
        $this->addSql('DROP INDEX UNIQ_42C849558EEC86F7 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP payment_details_id');
        $this->addSql('ALTER TABLE customer ADD invoice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E092989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('CREATE INDEX IDX_81398E092989F1FD ON customer (invoice_id)');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6B83297E7');
        $this->addSql('DROP INDEX IDX_794381C6B83297E7 ON review');
        $this->addSql('ALTER TABLE review DROP reservation_id');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744CFFE9AD6');
        $this->addSql('DROP INDEX UNIQ_90651744CFFE9AD6 ON invoice');
        $this->addSql('ALTER TABLE invoice DROP orders_id');
    }
}
