<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200304221530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player ADD shoots INT NOT NULL, ADD shoots_on_target INT NOT NULL, ADD shoots_from_fr_kc INT NOT NULL, ADD shoots_on_target_pc DOUBLE PRECISION NOT NULL, ADD shoots_per_match DOUBLE PRECISION NOT NULL, ADD shoots_on_target_per_match DOUBLE PRECISION NOT NULL, ADD goals_per_shoot DOUBLE PRECISION NOT NULL, ADD goal_per_shoot_on_target DOUBLE PRECISION NOT NULL, ADD key_passes INT NOT NULL, ADD passes_completed INT NOT NULL, ADD passes_attempted INT NOT NULL, ADD pass_comp_percent DOUBLE PRECISION NOT NULL, ADD short_passes_completed INT NOT NULL, ADD shortpasses_attempted INT NOT NULL, ADD short_passes_comp_percent DOUBLE PRECISION NOT NULL, ADD medium_passes_completed INT NOT NULL, ADD medium_passes_attempted INT NOT NULL, ADD medium_passes_comp_percent DOUBLE PRECISION NOT NULL, ADD long_pass_completed INT NOT NULL, ADD long_passes_attempted INT NOT NULL, ADD long_passes_comp_percent DOUBLE PRECISION NOT NULL, ADD pass_completed_final_third INT NOT NULL, ADD pass_completed_penalty_area INT NOT NULL, ADD cross_into_penalty_area INT NOT NULL, ADD minutes_played INT NOT NULL, ADD minutes_percent_played DOUBLE PRECISION NOT NULL, ADD ninty_min_played DOUBLE PRECISION NOT NULL, ADD min_per_match_started INT NOT NULL, ADD points_per_match DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player DROP shoots, DROP shoots_on_target, DROP shoots_from_fr_kc, DROP shoots_on_target_pc, DROP shoots_per_match, DROP shoots_on_target_per_match, DROP goals_per_shoot, DROP goal_per_shoot_on_target, DROP key_passes, DROP passes_completed, DROP passes_attempted, DROP pass_comp_percent, DROP short_passes_completed, DROP shortpasses_attempted, DROP short_passes_comp_percent, DROP medium_passes_completed, DROP medium_passes_attempted, DROP medium_passes_comp_percent, DROP long_pass_completed, DROP long_passes_attempted, DROP long_passes_comp_percent, DROP pass_completed_final_third, DROP pass_completed_penalty_area, DROP cross_into_penalty_area, DROP minutes_played, DROP minutes_percent_played, DROP ninty_min_played, DROP min_per_match_started, DROP points_per_match');
    }
}
