<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602185551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicle_reservation (vehicle_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_CCF33423545317D1 (vehicle_id), INDEX IDX_CCF33423B83297E7 (reservation_id), PRIMARY KEY(vehicle_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle_reservation ADD CONSTRAINT FK_CCF33423545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_reservation ADD CONSTRAINT FK_CCF33423B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955545317D1');
        $this->addSql('DROP INDEX IDX_42C84955545317D1 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP vehicle_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_reservation DROP FOREIGN KEY FK_CCF33423545317D1');
        $this->addSql('ALTER TABLE vehicle_reservation DROP FOREIGN KEY FK_CCF33423B83297E7');
        $this->addSql('DROP TABLE vehicle_reservation');
        $this->addSql('ALTER TABLE reservation ADD vehicle_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_42C84955545317D1 ON reservation (vehicle_id)');
    }
}
