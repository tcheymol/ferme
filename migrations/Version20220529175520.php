<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220529175520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD enabled BOOLEAN NOT NULL DEFAULT FALSE');
        $this->addSql('ALTER TABLE users ALTER first_name DROP DEFAULT');
        $this->addSql('ALTER TABLE users ALTER last_name DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users DROP enabled');
        $this->addSql('ALTER TABLE users ALTER first_name SET DEFAULT \'\'');
        $this->addSql('ALTER TABLE users ALTER last_name SET DEFAULT \'\'');
    }
}
