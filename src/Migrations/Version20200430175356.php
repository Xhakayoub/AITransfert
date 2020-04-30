<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430175356 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player ADD arial_duels_won INT DEFAULT NULL, ADD arial_duels_lost INT DEFAULT NULL, ADD arial_duels_completion INT DEFAULT NULL, ADD ball_controlls INT DEFAULT NULL, ADD ball_controlls_move_distance INT DEFAULT NULL, ADD ball_controlls_move_distance_progressive INT DEFAULT NULL, ADD receiving_ball_attempted INT DEFAULT NULL, ADD receiving_ball_completed INT DEFAULT NULL, ADD receiving_ball_completion INT DEFAULT NULL, ADD mis_controlls INT DEFAULT NULL, ADD dispossessed INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD arial_duels_won INT DEFAULT NULL, ADD arial_duels_lost INT DEFAULT NULL, ADD arial_duels_completion INT DEFAULT NULL, ADD ball_controlls INT DEFAULT NULL, ADD ball_controlls_move_distance INT DEFAULT NULL, ADD ball_controlls_move_distance_progressive INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player DROP arial_duels_won, DROP arial_duels_lost, DROP arial_duels_completion, DROP ball_controlls, DROP ball_controlls_move_distance, DROP ball_controlls_move_distance_progressive, DROP receiving_ball_attempted, DROP receiving_ball_completed, DROP receiving_ball_completion, DROP mis_controlls, DROP dispossessed');
        $this->addSql('ALTER TABLE team DROP arial_duels_won, DROP arial_duels_lost, DROP arial_duels_completion, DROP ball_controlls, DROP ball_controlls_move_distance, DROP ball_controlls_move_distance_progressive');
    }
}
