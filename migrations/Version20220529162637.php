<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220529162637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ALTER this_week DROP DEFAULT');
        $this->addSql('ALTER TABLE product ALTER showcased DROP DEFAULT');
        $this->addSql("ALTER TABLE users ADD first_name VARCHAR(255) NOT NULL DEFAULT ''");
        $this->addSql("ALTER TABLE users ADD last_name VARCHAR(255) NOT NULL DEFAULT ''");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ALTER this_week SET DEFAULT false');
        $this->addSql('ALTER TABLE product ALTER showcased SET DEFAULT false');
        $this->addSql('ALTER TABLE users DROP first_name');
        $this->addSql('ALTER TABLE users DROP last_name');
    }
}
