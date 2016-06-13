<?php

namespace WeddingSite\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160613200631 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_ACB79A35E7927C74 ON guest');
        $this->addSql('ALTER TABLE guest ADD username VARCHAR(255) NOT NULL, ADD username_canonical VARCHAR(255) NOT NULL, ADD email_canonical VARCHAR(255) NOT NULL, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) NOT NULL, ADD last_login DATETIME DEFAULT NULL, ADD locked TINYINT(1) NOT NULL, ADD expired TINYINT(1) NOT NULL, ADD expires_at DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(255) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD credentials_expired TINYINT(1) NOT NULL, ADD credentials_expire_at DATETIME DEFAULT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACB79A3592FC23A8 ON guest (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACB79A35A0D96FBF ON guest (email_canonical)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_ACB79A3592FC23A8 ON guest');
        $this->addSql('DROP INDEX UNIQ_ACB79A35A0D96FBF ON guest');
        $this->addSql('ALTER TABLE guest DROP username, DROP username_canonical, DROP email_canonical, DROP enabled, DROP salt, DROP last_login, DROP locked, DROP expired, DROP expires_at, DROP confirmation_token, DROP password_requested_at, DROP roles, DROP credentials_expired, DROP credentials_expire_at, CHANGE password password LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACB79A35E7927C74 ON guest (email)');
    }
}
