<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190120070859 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calisma_alanlari ADD show_frontpage SMALLINT NOT NULL, CHANGE title title VARCHAR(100) NOT NULL, CHANGE summary summary VARCHAR(100) NOT NULL, CHANGE image image VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calisma_alanlari DROP show_frontpage, CHANGE title title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE summary summary TEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image image VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
