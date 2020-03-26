<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326193952 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE team ADD gk_pass_launched_comp INT DEFAULT NULL, ADD gk_pass_launched_att INT DEFAULT NULL, ADD gk_pass_launched_completion DOUBLE PRECISION DEFAULT NULL, ADD gk_pass_attempted INT DEFAULT NULL, ADD gk_pass_throws INT DEFAULT NULL, ADD gk_pass_launched_percent DOUBLE PRECISION DEFAULT NULL, ADD avg_length_of_passes DOUBLE PRECISION DEFAULT NULL, ADD goal_kicks_att INT NOT NULL, ADD goal_kicks_launched_percent DOUBLE PRECISION DEFAULT NULL, ADD goal_kicks_avg_length DOUBLE PRECISION DEFAULT NULL, ADD gk_crosses_attempted INT DEFAULT NULL, ADD gk_crosses_stopped INT DEFAULT NULL, ADD gk_crosses_stp_percent DOUBLE PRECISION DEFAULT NULL, ADD opa INT DEFAULT NULL, ADD opa_per_match DOUBLE PRECISION DEFAULT NULL, ADD average_distance DOUBLE PRECISION DEFAULT NULL, ADD shoot_on_target INT DEFAULT NULL, ADD shoot_from_free_kick INT DEFAULT NULL, ADD shoot_on_target_percent DOUBLE PRECISION DEFAULT NULL, ADD shoot_per90_minutes DOUBLE PRECISION DEFAULT NULL, ADD shoot_on_target_per90_minutes DOUBLE PRECISION DEFAULT NULL, ADD goal_per_shoot DOUBLE PRECISION DEFAULT NULL, ADD goal_per_shoot_on_target DOUBLE PRECISION DEFAULT NULL, ADD passes_completed INT DEFAULT NULL, ADD passes_attempted INT DEFAULT NULL, ADD pass_completion DOUBLE PRECISION DEFAULT NULL, ADD short_pass_completed INT DEFAULT NULL, ADD short_pass_attempted INT DEFAULT NULL, ADD short_pass_completion DOUBLE PRECISION DEFAULT NULL, ADD medium_pass_completed INT DEFAULT NULL, ADD medium_pass_attempted INT DEFAULT NULL, ADD medium_pass_completion DOUBLE PRECISION DEFAULT NULL, ADD long_pass_completed INT DEFAULT NULL, ADD long_pass_attempted INT DEFAULT NULL, ADD long_pass_completion DOUBLE PRECISION DEFAULT NULL, ADD pass_attempted_from_fk INT DEFAULT NULL, ADD through_balls INT DEFAULT NULL, ADD corner_kicks INT DEFAULT NULL, ADD throw_ins_taken INT DEFAULT NULL, ADD pass_into_final_third INT DEFAULT NULL, ADD pass_into_penalty_area INT DEFAULT NULL, ADD cross_into_penalty_area INT DEFAULT NULL, ADD minutes_played INT DEFAULT NULL, ADD substitutions INT DEFAULT NULL, ADD point_per_match DOUBLE PRECISION DEFAULT NULL, ADD yellow_cards INT DEFAULT NULL, ADD red_cards INT DEFAULT NULL, ADD foul_commited INT DEFAULT NULL, ADD foul_drawn INT DEFAULT NULL, ADD offsides INT DEFAULT NULL, ADD crosses INT DEFAULT NULL, ADD tackles_won INT DEFAULT NULL, ADD interceptions INT DEFAULT NULL, ADD penalty_kick_won INT DEFAULT NULL, ADD penalty_kick_conceded INT DEFAULT NULL, ADD own_goal INT DEFAULT NULL, ADD dribbles_succeded INT DEFAULT NULL, ADD dribbles_attempted INT DEFAULT NULL, ADD dribbles_completion DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE team DROP gk_pass_launched_comp, DROP gk_pass_launched_att, DROP gk_pass_launched_completion, DROP gk_pass_attempted, DROP gk_pass_throws, DROP gk_pass_launched_percent, DROP avg_length_of_passes, DROP goal_kicks_att, DROP goal_kicks_launched_percent, DROP goal_kicks_avg_length, DROP gk_crosses_attempted, DROP gk_crosses_stopped, DROP gk_crosses_stp_percent, DROP opa, DROP opa_per_match, DROP average_distance, DROP shoot_on_target, DROP shoot_from_free_kick, DROP shoot_on_target_percent, DROP shoot_per90_minutes, DROP shoot_on_target_per90_minutes, DROP goal_per_shoot, DROP goal_per_shoot_on_target, DROP passes_completed, DROP passes_attempted, DROP pass_completion, DROP short_pass_completed, DROP short_pass_attempted, DROP short_pass_completion, DROP medium_pass_completed, DROP medium_pass_attempted, DROP medium_pass_completion, DROP long_pass_completed, DROP long_pass_attempted, DROP long_pass_completion, DROP pass_attempted_from_fk, DROP through_balls, DROP corner_kicks, DROP throw_ins_taken, DROP pass_into_final_third, DROP pass_into_penalty_area, DROP cross_into_penalty_area, DROP minutes_played, DROP substitutions, DROP point_per_match, DROP yellow_cards, DROP red_cards, DROP foul_commited, DROP foul_drawn, DROP offsides, DROP crosses, DROP tackles_won, DROP interceptions, DROP penalty_kick_won, DROP penalty_kick_conceded, DROP own_goal, DROP dribbles_succeded, DROP dribbles_attempted, DROP dribbles_completion');
    }
}
