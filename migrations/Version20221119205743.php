<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119205743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, proprietaire VARCHAR(255) NOT NULL, adresse_mail VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, matricule_fiscal VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, numero_tel VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero_tel VARCHAR(255) NOT NULL, adresse_mail VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) DEFAULT NULL, education VARCHAR(255) DEFAULT NULL, niveau VARCHAR(255) DEFAULT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, organisme_id INT DEFAULT NULL, competence_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero_tel VARCHAR(255) NOT NULL, adresse_mail VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) DEFAULT NULL, diplome VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, INDEX IDX_ED767E4F5DDD38F5 (organisme_id), INDEX IDX_ED767E4F15761DAB (competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, formateur_id INT DEFAULT NULL, session_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) NOT NULL, date_deb DATE NOT NULL, date_fin DATE NOT NULL, niveau VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_404021BF155D8F51 (formateur_id), INDEX IDX_404021BF613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, numero_tel VARCHAR(255) DEFAULT NULL, adresse_mail VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, seance_id INT DEFAULT NULL, date DATE NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_AB55E24FDDEAB1A3 (etudiant_id), INDEX IDX_AB55E24FE3797A94 (seance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence (id INT AUTO_INCREMENT NOT NULL, seance_id INT DEFAULT NULL, etudiant_id INT DEFAULT NULL, date DATE NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_6977C7A5E3797A94 (seance_id), INDEX IDX_6977C7A5DDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, date DATE NOT NULL, heure_deb TIME NOT NULL, heure_fin TIME NOT NULL, INDEX IDX_DF7DFD0E5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, date_deb DATE NOT NULL, date_fin DATE NOT NULL, etat VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formateur ADD CONSTRAINT FK_ED767E4F5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id)');
        $this->addSql('ALTER TABLE formateur ADD CONSTRAINT FK_ED767E4F15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FE3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formateur DROP FOREIGN KEY FK_ED767E4F5DDD38F5');
        $this->addSql('ALTER TABLE formateur DROP FOREIGN KEY FK_ED767E4F15761DAB');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF155D8F51');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF613FECDF');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FDDEAB1A3');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FE3797A94');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5E3797A94');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5DDEAB1A3');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E5200282E');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE organisme');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE session');
    }
}
