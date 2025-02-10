<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210135809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_tag (book_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F2F4CE1516A2B381 (book_id), INDEX IDX_F2F4CE15BAD26311 (tag_id), PRIMARY KEY(book_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_tag ADD CONSTRAINT FK_F2F4CE1516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_tag ADD CONSTRAINT FK_F2F4CE15BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_book DROP FOREIGN KEY FK_D278E8396FB82471');
        $this->addSql('ALTER TABLE book_book DROP FOREIGN KEY FK_D278E839765D74FE');
        $this->addSql('DROP TABLE book_book');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_book (book_source INT NOT NULL, book_target INT NOT NULL, INDEX IDX_D278E839765D74FE (book_source), INDEX IDX_D278E8396FB82471 (book_target), PRIMARY KEY(book_source, book_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE book_book ADD CONSTRAINT FK_D278E8396FB82471 FOREIGN KEY (book_target) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_book ADD CONSTRAINT FK_D278E839765D74FE FOREIGN KEY (book_source) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_tag DROP FOREIGN KEY FK_F2F4CE1516A2B381');
        $this->addSql('ALTER TABLE book_tag DROP FOREIGN KEY FK_F2F4CE15BAD26311');
        $this->addSql('DROP TABLE book_tag');
    }
}
