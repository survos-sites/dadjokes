<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260803223759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Joke.ageGroup (little_kids/big_kids) and Joke.sortOrder (manual admin reorder)';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE joke ADD age_group VARCHAR(16) NOT NULL DEFAULT 'big_kids'");
        $this->addSql('ALTER TABLE joke ADD sort_order INT NOT NULL DEFAULT 0');
        $this->addSql('UPDATE joke SET sort_order = id');
        $this->addSql('ALTER TABLE joke ALTER age_group DROP DEFAULT');
        $this->addSql('ALTER TABLE joke ALTER sort_order DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE joke DROP age_group');
        $this->addSql('ALTER TABLE joke DROP sort_order');
    }
}
