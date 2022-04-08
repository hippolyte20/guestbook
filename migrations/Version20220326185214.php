<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220326185214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       // $this->addSql('ALTER TABLE trip_info ADD tripid_id INT NOT NULL');
        //$this->addSql('ALTER TABLE trip_info ADD CONSTRAINT FK_E0B1A23C9597D27 FOREIGN KEY (tripid_id) REFERENCES user (id)');
        //$this->addSql('CREATE INDEX IDX_E0B1A23C9597D27 ON trip_info (tripid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE rememberme_token CHANGE series series VARCHAR(88) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE value value VARCHAR(88) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE class class VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE username username VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reset_password_request CHANGE selector selector VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hashed_token hashed_token VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        /*$this->addSql('ALTER TABLE trip_info DROP FOREIGN KEY FK_E0B1A23C9597D27');
        $this->addSql('DROP INDEX IDX_E0B1A23C9597D27 ON trip_info');
        $this->addSql('ALTER TABLE trip_info DROP tripid_id, CHANGE startcity startcity VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE endcity endcity VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');*/
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
