<?php

namespace WeddingSite\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160909153010 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE guest ADD numPlusOnes INT NOT NULL, ADD masterGuestId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A355F382E98 FOREIGN KEY (masterGuestId) REFERENCES guest (id)');
        $this->addSql('CREATE INDEX IDX_ACB79A355F382E98 ON guest (masterGuestId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE guest DROP FOREIGN KEY FK_ACB79A355F382E98');
        $this->addSql('DROP INDEX IDX_ACB79A355F382E98 ON guest');
        $this->addSql('ALTER TABLE guest DROP numPlusOnes, DROP masterGuestId');
    }
}
