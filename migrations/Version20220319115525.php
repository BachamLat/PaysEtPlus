<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220319115525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, dial_code VARCHAR(255) DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_CD1DE18AF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE district (id INT AUTO_INCREMENT NOT NULL, municipality_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_31C15487AE6F181C (municipality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE municipality (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_C6F56628AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE town (id INT AUTO_INCREMENT NOT NULL, district_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_4CE6C7A4B08FA272 (district_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C15487AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id)');
        $this->addSql('ALTER TABLE municipality ADD CONSTRAINT FK_C6F56628AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE town ADD CONSTRAINT FK_4CE6C7A4B08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AF92F3E70');
        $this->addSql('ALTER TABLE municipality DROP FOREIGN KEY FK_C6F56628AE80F5DF');
        $this->addSql('ALTER TABLE town DROP FOREIGN KEY FK_4CE6C7A4B08FA272');
        $this->addSql('ALTER TABLE district DROP FOREIGN KEY FK_31C15487AE6F181C');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE district');
        $this->addSql('DROP TABLE municipality');
        $this->addSql('DROP TABLE town');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
