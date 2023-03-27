<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327101824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apply_user DROP FOREIGN KEY FK_F7F37EAA4DDCCBDE');
        $this->addSql('ALTER TABLE apply_user DROP FOREIGN KEY FK_F7F37EAAA76ED395');
        $this->addSql('DROP TABLE apply_user');
        $this->addSql('ALTER TABLE apply ADD user_id INT NOT NULL, CHANGE job_id job_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F9D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BD2F8C1F9D86650F ON apply (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apply_user (apply_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F7F37EAA4DDCCBDE (apply_id), INDEX IDX_F7F37EAAA76ED395 (user_id), PRIMARY KEY(apply_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE apply_user ADD CONSTRAINT FK_F7F37EAA4DDCCBDE FOREIGN KEY (apply_id) REFERENCES apply (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apply_user ADD CONSTRAINT FK_F7F37EAAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F9D86650F');
        $this->addSql('DROP INDEX IDX_BD2F8C1F9D86650F ON apply');
        $this->addSql('ALTER TABLE apply DROP user_id, CHANGE job_id job_id INT NOT NULL');
    }
}
