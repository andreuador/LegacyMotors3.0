<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424111619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD login_id INT DEFAULT NULL, ADD invoice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E095CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E092989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E095CB2E05D ON customer (login_id)');
        $this->addSql('CREATE INDEX IDX_81398E092989F1FD ON customer (invoice_id)');
        $this->addSql('ALTER TABLE `order` ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON `order` (customer_id)');
        $this->addSql('ALTER TABLE reservation ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_42C849559395C3F3 ON reservation (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('DROP INDEX IDX_F52993989395C3F3 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP customer_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559395C3F3');
        $this->addSql('DROP INDEX IDX_42C849559395C3F3 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP customer_id');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E095CB2E05D');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E092989F1FD');
        $this->addSql('DROP INDEX UNIQ_81398E095CB2E05D ON customer');
        $this->addSql('DROP INDEX IDX_81398E092989F1FD ON customer');
        $this->addSql('ALTER TABLE customer DROP login_id, DROP invoice_id');
    }
}
