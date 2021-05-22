<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210522145917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, user_id, titre, contenu FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL COLLATE BINARY, contenu CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, user_id, titre, contenu) SELECT id, user_id, titre, contenu FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('DROP INDEX IDX_83FFB0F37294869C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__like_post AS SELECT id, article_id FROM like_post');
        $this->addSql('DROP TABLE like_post');
        $this->addSql('CREATE TABLE like_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, CONSTRAINT FK_83FFB0F37294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_83FFB0F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO like_post (id, article_id) SELECT id, article_id FROM __temp__like_post');
        $this->addSql('DROP TABLE __temp__like_post');
        $this->addSql('CREATE INDEX IDX_83FFB0F37294869C ON like_post (article_id)');
        $this->addSql('CREATE INDEX IDX_83FFB0F3A76ED395 ON like_post (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, user_id, titre, contenu FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL, contenu CLOB NOT NULL)');
        $this->addSql('INSERT INTO article (id, user_id, titre, contenu) SELECT id, user_id, titre, contenu FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('DROP INDEX IDX_83FFB0F37294869C');
        $this->addSql('DROP INDEX IDX_83FFB0F3A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__like_post AS SELECT id, article_id FROM like_post');
        $this->addSql('DROP TABLE like_post');
        $this->addSql('CREATE TABLE like_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO like_post (id, article_id) SELECT id, article_id FROM __temp__like_post');
        $this->addSql('DROP TABLE __temp__like_post');
        $this->addSql('CREATE INDEX IDX_83FFB0F37294869C ON like_post (article_id)');
    }
}
