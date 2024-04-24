<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424112541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F545317D1 ON image (vehicle_id)');
        $this->addSql('ALTER TABLE reservation ADD vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_42C84955545317D1 ON reservation (vehicle_id)');
        $this->addSql('ALTER TABLE vehicle ADD provider_id INT DEFAULT NULL, ADD brand_id INT DEFAULT NULL, ADD vehicle_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486508D62AC FOREIGN KEY (vehicle_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486A53A8AA ON vehicle (provider_id)');
        $this->addSql('CREATE INDEX IDX_1B80E48644F5D008 ON vehicle (brand_id)');
        $this->addSql('CREATE INDEX IDX_1B80E486508D62AC ON vehicle (vehicle_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486A53A8AA');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48644F5D008');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486508D62AC');
        $this->addSql('DROP INDEX IDX_1B80E486A53A8AA ON vehicle');
        $this->addSql('DROP INDEX IDX_1B80E48644F5D008 ON vehicle');
        $this->addSql('DROP INDEX IDX_1B80E486508D62AC ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP provider_id, DROP brand_id, DROP vehicle_order_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F545317D1');
        $this->addSql('DROP INDEX IDX_C53D045F545317D1 ON image');
        $this->addSql('ALTER TABLE image DROP vehicle_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955545317D1');
        $this->addSql('DROP INDEX IDX_42C84955545317D1 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP vehicle_id');
    }
}
