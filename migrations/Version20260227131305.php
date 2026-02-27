<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260227131305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_application ADD job_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_application ADD CONSTRAINT FK_C737C688BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE job_application ADD CONSTRAINT FK_C737C688A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C737C688BE04EA9 ON job_application (job_id)');
        $this->addSql('CREATE INDEX IDX_C737C688A76ED395 ON job_application (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_application DROP FOREIGN KEY FK_C737C688BE04EA9');
        $this->addSql('ALTER TABLE job_application DROP FOREIGN KEY FK_C737C688A76ED395');
        $this->addSql('DROP INDEX IDX_C737C688BE04EA9 ON job_application');
        $this->addSql('DROP INDEX IDX_C737C688A76ED395 ON job_application');
        $this->addSql('ALTER TABLE job_application DROP job_id, DROP user_id');
    }
}
