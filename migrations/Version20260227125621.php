<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260227125621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE contact_message (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, remoteallowed VARCHAR(255) NOT NULL, salary_min VARCHAR(255) NOT NULL, salary_max VARCHAR(255) NOT NULL, company_id INT NOT NULL, category_id INT NOT NULL, job_type_id INT NOT NULL, INDEX IDX_FBD8E0F8979B1AD6 (company_id), INDEX IDX_FBD8E0F812469DE2 (category_id), INDEX IDX_FBD8E0F85FA33B08 (job_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE job_job_type (job_id INT NOT NULL, job_type_id INT NOT NULL, INDEX IDX_6C558413BE04EA9 (job_id), INDEX IDX_6C5584135FA33B08 (job_type_id), PRIMARY KEY(job_id, job_type_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE job_application (id INT AUTO_INCREMENT NOT NULL, cover_letter LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F85FA33B08 FOREIGN KEY (job_type_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_job_type ADD CONSTRAINT FK_6C558413BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_job_type ADD CONSTRAINT FK_6C5584135FA33B08 FOREIGN KEY (job_type_id) REFERENCES job_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8979B1AD6');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F812469DE2');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F85FA33B08');
        $this->addSql('ALTER TABLE job_job_type DROP FOREIGN KEY FK_6C558413BE04EA9');
        $this->addSql('ALTER TABLE job_job_type DROP FOREIGN KEY FK_6C5584135FA33B08');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE contact_message');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_job_type');
        $this->addSql('DROP TABLE job_application');
        $this->addSql('DROP TABLE job_type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
