<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430131135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player ADD pass_attempted_from_fk INT DEFAULT NULL, ADD pressures INT DEFAULT NULL, ADD pressure_succeded INT DEFAULT NULL, ADD pressure_completion DOUBLE PRECISION DEFAULT NULL, ADD ball_blocked INT DEFAULT NULL, ADD shoot_blocked INT DEFAULT NULL, ADD shoot_ont_target_blocked INT DEFAULT NULL, ADD pass_blocked INT DEFAULT NULL, ADD clearances INT DEFAULT NULL, ADD errors INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD pressures INT DEFAULT NULL, ADD pressure_succeded INT DEFAULT NULL, ADD pressure_completion INT DEFAULT NULL, ADD ball_blocked INT DEFAULT NULL, ADD shoot_blocked INT DEFAULT NULL, ADD shoot_on_target_blocked INT DEFAULT NULL, ADD pass_blocked INT DEFAULT NULL, ADD clearances INT DEFAULT NULL, ADD errors INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player DROP pass_attempted_from_fk, DROP pressures, DROP pressure_succeded, DROP pressure_completion, DROP ball_blocked, DROP shoot_blocked, DROP shoot_ont_target_blocked, DROP pass_blocked, DROP clearances, DROP errors');
        $this->addSql('ALTER TABLE team DROP pressures, DROP pressure_succeded, DROP pressure_completion, DROP ball_blocked, DROP shoot_blocked, DROP shoot_on_target_blocked, DROP pass_blocked, DROP clearances, DROP errors');
    }
}
