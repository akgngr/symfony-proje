<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190121052727 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, summary LONGTEXT DEFAULT NULL, body LONGTEXT NOT NULL, image LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', publish TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calisma_alanlari CHANGE title title VARCHAR(100) NOT NULL, CHANGE summary summary VARCHAR(100) NOT NULL, CHANGE show_frontpage show_frontpage SMALLINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pages');
        $this->addSql('ALTER TABLE calisma_alanlari CHANGE title title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE summary summary TEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE show_frontpage show_frontpage SMALLINT DEFAULT NULL');
    }
}
