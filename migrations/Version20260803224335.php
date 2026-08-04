<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260803224335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Joke.rating (1-4 stars) — how much Tac likes/can deliver it, drives print order';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE joke ADD rating INT NOT NULL DEFAULT 3');
        $this->addSql('ALTER TABLE joke ALTER rating DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE joke DROP rating');
    }
}
