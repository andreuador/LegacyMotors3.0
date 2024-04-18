<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240418172602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD customer_id INT DEFAULT NULL, ADD invoice_id INT DEFAULT NULL, ADD vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B72989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_BA388B79395C3F3 ON cart (customer_id)');
        $this->addSql('CREATE INDEX IDX_BA388B72989F1FD ON cart (invoice_id)');
        $this->addSql('CREATE INDEX IDX_BA388B7545317D1 ON cart (vehicle_id)');
        $this->addSql('ALTER TABLE customer ADD login_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E095CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E095CB2E05D ON customer (login_id)');
        $this->addSql('ALTER TABLE employee ADD login_id INT NOT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A15CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A15CB2E05D ON employee (login_id)');
        $this->addSql('ALTER TABLE image ADD vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F545317D1 ON image (vehicle_id)');
        $this->addSql('ALTER TABLE invoice ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_906517449395C3F3 ON invoice (customer_id)');
        $this->addSql('ALTER TABLE model ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('ALTER TABLE reservation ADD customer_id INT DEFAULT NULL, ADD vehicle_id INT DEFAULT NULL, ADD payment_details_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558EEC86F7 FOREIGN KEY (payment_details_id) REFERENCES payment_details (id)');
        $this->addSql('CREATE INDEX IDX_42C849559395C3F3 ON reservation (customer_id)');
        $this->addSql('CREATE INDEX IDX_42C84955545317D1 ON reservation (vehicle_id)');
        $this->addSql('CREATE INDEX IDX_42C849558EEC86F7 ON reservation (payment_details_id)');
        $this->addSql('ALTER TABLE review ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_794381C6B83297E7 ON review (reservation_id)');
        $this->addSql('ALTER TABLE vehicle ADD provider_id INT DEFAULT NULL, ADD brand_id INT DEFAULT NULL, ADD vehicle_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486DA3FD1FC FOREIGN KEY (vehicle_type_id) REFERENCES vehicle_type (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486A53A8AA ON vehicle (provider_id)');
        $this->addSql('CREATE INDEX IDX_1B80E48644F5D008 ON vehicle (brand_id)');
        $this->addSql('CREATE INDEX IDX_1B80E486DA3FD1FC ON vehicle (vehicle_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B79395C3F3');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B72989F1FD');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7545317D1');
        $this->addSql('DROP INDEX IDX_BA388B79395C3F3 ON cart');
        $this->addSql('DROP INDEX IDX_BA388B72989F1FD ON cart');
        $this->addSql('DROP INDEX IDX_BA388B7545317D1 ON cart');
        $this->addSql('ALTER TABLE cart DROP customer_id, DROP invoice_id, DROP vehicle_id');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E095CB2E05D');
        $this->addSql('DROP INDEX UNIQ_81398E095CB2E05D ON customer');
        $this->addSql('ALTER TABLE customer DROP login_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F545317D1');
        $this->addSql('DROP INDEX IDX_C53D045F545317D1 ON image');
        $this->addSql('ALTER TABLE image DROP vehicle_id');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486A53A8AA');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48644F5D008');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486DA3FD1FC');
        $this->addSql('DROP INDEX IDX_1B80E486A53A8AA ON vehicle');
        $this->addSql('DROP INDEX IDX_1B80E48644F5D008 ON vehicle');
        $this->addSql('DROP INDEX IDX_1B80E486DA3FD1FC ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP provider_id, DROP brand_id, DROP vehicle_type_id');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517449395C3F3');
        $this->addSql('DROP INDEX IDX_906517449395C3F3 ON invoice');
        $this->addSql('ALTER TABLE invoice DROP customer_id');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('DROP INDEX IDX_D79572D944F5D008 ON model');
        $this->addSql('ALTER TABLE model DROP brand_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559395C3F3');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955545317D1');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558EEC86F7');
        $this->addSql('DROP INDEX IDX_42C849559395C3F3 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955545317D1 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849558EEC86F7 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP customer_id, DROP vehicle_id, DROP payment_details_id');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A15CB2E05D');
        $this->addSql('DROP INDEX UNIQ_5D9F75A15CB2E05D ON employee');
        $this->addSql('ALTER TABLE employee DROP login_id');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6B83297E7');
        $this->addSql('DROP INDEX IDX_794381C6B83297E7 ON review');
        $this->addSql('ALTER TABLE review DROP reservation_id');
    }
}
