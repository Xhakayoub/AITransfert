<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200304183733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, id_player INT DEFAULT NULL, name VARCHAR(255) NOT NULL, nation VARCHAR(255) DEFAULT NULL, position VARCHAR(255) NOT NULL, squad VARCHAR(255) NOT NULL, age INT NOT NULL, born INT DEFAULT NULL, matchs_played INT NOT NULL, match_starts INT NOT NULL, mins_played INT NOT NULL, goals INT NOT NULL, assits INT NOT NULL, pk_made INT DEFAULT NULL, pk_attempted INT DEFAULT NULL, yellow_card INT NOT NULL, red_card INT NOT NULL, goals_per_min INT NOT NULL, assists_per_min DOUBLE PRECISION NOT NULL, gls_ass_per_min DOUBLE PRECISION NOT NULL, goals_without_pk_per_min DOUBLE PRECISION NOT NULL, gls_ass_without_pk_per_min DOUBLE PRECISION NOT NULL, goals_exp DOUBLE PRECISION NOT NULL, non_pen_goals_exp DOUBLE PRECISION NOT NULL, assists_exp DOUBLE PRECISION NOT NULL, goals_per_min_exp DOUBLE PRECISION NOT NULL, assists_per_min_exp DOUBLE PRECISION NOT NULL, gls_assists_per_min_exp DOUBLE PRECISION NOT NULL, non_pen_goals_exp_per_min DOUBLE PRECISION NOT NULL, non_pen_goals_assists_exp_per_min DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE player');
    }
}
