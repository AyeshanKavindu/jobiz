<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260227132122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD remote_allowed TINYINT(1) NOT NULL, ADD max_salary DOUBLE PRECISION NOT NULL, DROP remoteallowed, DROP salary_max, CHANGE salary_min salary_min DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD remoteallowed VARCHAR(255) NOT NULL, ADD salary_max VARCHAR(255) NOT NULL, DROP remote_allowed, DROP max_salary, CHANGE salary_min salary_min VARCHAR(255) NOT NULL');
    }
}
