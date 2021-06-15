<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615202640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial invoices table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE invoices (
                     id      BINARY(16)   NOT NULL COMMENT \'(DC2Type:uuid)\',
                     name    VARCHAR(255) NOT NULL,
                     file_id BINARY(16)   NOT NULL COMMENT \'(DC2Type:uuid)\',
                     type    VARCHAR(255) NOT NULL,
                     PRIMARY KEY(id)
                )
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE invoices');
    }
}
