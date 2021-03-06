<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210615220200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make invoice file not obligatory on startup.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
        ALTER TABLE invoices 
        CHANGE file_id 
        file_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
        ALTER TABLE invoices 
        CHANGE file_id file_id 
        BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'
        ');
    }
}
