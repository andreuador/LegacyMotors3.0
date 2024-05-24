<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524191006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, login_id INT NOT NULL, name VARCHAR(100) NOT NULL, lastname VARCHAR(150) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(25) NOT NULL, salary INT NOT NULL, hire_date DATE DEFAULT NULL, is_deleted TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_5D9F75A15CB2E05D (login_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A15CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE emplpoyee DROP FOREIGN KEY FK_CCA824555CB2E05D');
        $this->addSql('DROP TABLE emplpoyee');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emplpoyee (id INT AUTO_INCREMENT NOT NULL, login_id INT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, salary INT NOT NULL, hire_date DATE DEFAULT NULL, is_deleted TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_CCA824555CB2E05D (login_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE emplpoyee ADD CONSTRAINT FK_CCA824555CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A15CB2E05D');
        $this->addSql('DROP TABLE employee');
    }
}
