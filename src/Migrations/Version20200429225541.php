<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429225541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player ADD total_distance INT DEFAULT NULL, ADD progress_distance INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD live_passes INT DEFAULT NULL, ADD dead_passes INT DEFAULT NULL, ADD press_passes INT DEFAULT NULL, ADD switch_passes INT DEFAULT NULL, ADD ground_passes INT DEFAULT NULL, ADD low_passes INT DEFAULT NULL, ADD high_passes INT DEFAULT NULL, ADD left_foot_passes INT DEFAULT NULL, ADD right_foot_passes INT DEFAULT NULL, ADD blocked_passes INT DEFAULT NULL, ADD offsides_passes INT DEFAULT NULL, ADD total_distance INT DEFAULT NULL, ADD progress_distance INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player DROP total_distance, DROP progress_distance');
        $this->addSql('ALTER TABLE team DROP live_passes, DROP dead_passes, DROP press_passes, DROP switch_passes, DROP ground_passes, DROP low_passes, DROP high_passes, DROP left_foot_passes, DROP right_foot_passes, DROP blocked_passes, DROP offsides_passes, DROP total_distance, DROP progress_distance');
    }
}
