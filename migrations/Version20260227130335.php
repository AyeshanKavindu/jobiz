<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260227130335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F85FA33B08');
        $this->addSql('DROP INDEX IDX_FBD8E0F85FA33B08 ON job');
        $this->addSql('ALTER TABLE job DROP job_type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD job_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F85FA33B08 FOREIGN KEY (job_type_id) REFERENCES job_type (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F85FA33B08 ON job (job_type_id)');
    }
}
