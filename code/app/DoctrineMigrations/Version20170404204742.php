<?php

namespace WeddingSite\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170404204742 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE guest_room ADD guest_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guest_room ADD CONSTRAINT FK_56250CC69A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('CREATE INDEX IDX_56250CC69A4AA658 ON guest_room (guest_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE guest_room DROP FOREIGN KEY FK_56250CC69A4AA658');
        $this->addSql('DROP INDEX IDX_56250CC69A4AA658 ON guest_room');
        $this->addSql('ALTER TABLE guest_room DROP guest_id');
    }
}
