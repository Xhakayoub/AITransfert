<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306221505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, id_team INT NOT NULL, name_team VARCHAR(255) NOT NULL, league VARCHAR(255) NOT NULL, level VARCHAR(255) DEFAULT NULL, match_played INT NOT NULL, goals INT NOT NULL, assists INT NOT NULL, goals_against INT NOT NULL, goal_per_match INT NOT NULL, goals_against_per_match INT NOT NULL, saves INT NOT NULL, shoot_on_target_against INT NOT NULL, save_percent DOUBLE PRECISION NOT NULL, clean_sheets INT NOT NULL, clean_sheet_percent DOUBLE PRECISION NOT NULL, penalty_kick_allowed INT NOT NULL, penalty_kicks_saved INT NOT NULL, top_team_scoorer VARCHAR(255) DEFAULT NULL, goal_keeper VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player ADD fouls_commited INT DEFAULT NULL, ADD fouls_drawn INT DEFAULT NULL, ADD offsides INT DEFAULT NULL, ADD crosses INT DEFAULT NULL, ADD tackles_won INT DEFAULT NULL, ADD interceptions INT DEFAULT NULL, ADD penalty_kicks_won INT DEFAULT NULL, ADD penalty_kicks_conceded INT DEFAULT NULL, ADD own_goal INT DEFAULT NULL, ADD dribble_completed INT DEFAULT NULL, ADD dribble_attempted INT DEFAULT NULL, ADD dribble_percent DOUBLE PRECISION DEFAULT NULL, ADD number_of_player_driblled INT DEFAULT NULL, ADD nutmegs INT DEFAULT NULL, ADD dribble_tackled INT DEFAULT NULL, ADD dribble_tackled_percent DOUBLE PRECISION DEFAULT NULL, ADD times_dribbled_past INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE team');
        $this->addSql('ALTER TABLE player DROP fouls_commited, DROP fouls_drawn, DROP offsides, DROP crosses, DROP tackles_won, DROP interceptions, DROP penalty_kicks_won, DROP penalty_kicks_conceded, DROP own_goal, DROP dribble_completed, DROP dribble_attempted, DROP dribble_percent, DROP number_of_player_driblled, DROP nutmegs, DROP dribble_tackled, DROP dribble_tackled_percent, DROP times_dribbled_past');
    }
}
