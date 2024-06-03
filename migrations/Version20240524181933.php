<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524181933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD login_id INT NOT NULL, ADD is_deleted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E095CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E095CB2E05D ON customer (login_id)');
        $this->addSql('ALTER TABLE emplpoyee ADD login_id INT NOT NULL, ADD is_deleted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE emplpoyee ADD CONSTRAINT FK_CCA824555CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CCA824555CB2E05D ON emplpoyee (login_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emplpoyee DROP FOREIGN KEY FK_CCA824555CB2E05D');
        $this->addSql('DROP INDEX UNIQ_CCA824555CB2E05D ON emplpoyee');
        $this->addSql('ALTER TABLE emplpoyee DROP login_id, DROP is_deleted');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E095CB2E05D');
        $this->addSql('DROP INDEX UNIQ_81398E095CB2E05D ON customer');
        $this->addSql('ALTER TABLE customer DROP login_id, DROP is_deleted');
    }
}
