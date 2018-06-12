<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180518123842 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post ADD gpx_file_name VARCHAR(255) NOT NULL, DROP gpx_name, DROP gpx_original_name, DROP gpx_mime_type, DROP gpx_size, DROP gpx_dimensions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post ADD gpx_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD gpx_original_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD gpx_mime_type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD gpx_size INT DEFAULT NULL, ADD gpx_dimensions LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:simple_array)\', DROP gpx_file_name');
    }
}
