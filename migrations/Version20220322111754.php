<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322111754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE department ADD country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AF92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('CREATE INDEX IDX_CD1DE18AF92F3E70 ON department (country_id)');
        $this->addSql('ALTER TABLE district ADD municipality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C15487AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipality (id)');
        $this->addSql('CREATE INDEX IDX_31C15487AE6F181C ON district (municipality_id)');
        $this->addSql('ALTER TABLE municipality ADD department_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE municipality ADD CONSTRAINT FK_C6F56628AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_C6F56628AE80F5DF ON municipality (department_id)');
        $this->addSql('ALTER TABLE town ADD district_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE town ADD CONSTRAINT FK_4CE6C7A4B08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
        $this->addSql('CREATE INDEX IDX_4CE6C7A4B08FA272 ON town (district_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE countries CHANGE code code VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dial_code dial_code VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AF92F3E70');
        $this->addSql('DROP INDEX IDX_CD1DE18AF92F3E70 ON department');
        $this->addSql('ALTER TABLE department DROP country_id, CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE district DROP FOREIGN KEY FK_31C15487AE6F181C');
        $this->addSql('DROP INDEX IDX_31C15487AE6F181C ON district');
        $this->addSql('ALTER TABLE district DROP municipality_id, CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE municipality DROP FOREIGN KEY FK_C6F56628AE80F5DF');
        $this->addSql('DROP INDEX IDX_C6F56628AE80F5DF ON municipality');
        $this->addSql('ALTER TABLE municipality DROP department_id, CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE town DROP FOREIGN KEY FK_4CE6C7A4B08FA272');
        $this->addSql('DROP INDEX IDX_4CE6C7A4B08FA272 ON town');
        $this->addSql('ALTER TABLE town DROP district_id, CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
