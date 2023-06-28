<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628073351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, INDEX IDX_E00CEDDEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_entry (id INT AUTO_INCREMENT NOT NULL, related_booking_id INT NOT NULL, related_tools_id INT NOT NULL, INDEX IDX_BA5D60C589FD14D0 (related_booking_id), INDEX IDX_BA5D60C5D3AF0631 (related_tools_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tools (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking_entry ADD CONSTRAINT FK_BA5D60C589FD14D0 FOREIGN KEY (related_booking_id) REFERENCES booking (id)');
        $this->addSql('ALTER TABLE booking_entry ADD CONSTRAINT FK_BA5D60C5D3AF0631 FOREIGN KEY (related_tools_id) REFERENCES tools (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE booking_entry DROP FOREIGN KEY FK_BA5D60C589FD14D0');
        $this->addSql('ALTER TABLE booking_entry DROP FOREIGN KEY FK_BA5D60C5D3AF0631');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_entry');
        $this->addSql('DROP TABLE tools');
        $this->addSql('DROP TABLE user');
    }
}
