<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs! This block will be used as the migration description if getDescription() is not used.
 */
class Version20170607112248 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Rewrite squad policies - squad leader is a property of the squad';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');

        $this->addSql('ALTER TABLE squadit_webapp_domain_model_squad ADD leader VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE squadit_webapp_domain_model_squad ADD CONSTRAINT FK_EE964ABBF5E3EAD7 FOREIGN KEY (leader) REFERENCES squadit_webapp_domain_model_user (persistence_object_identifier)');
        $this->addSql('CREATE INDEX IDX_EE964ABBF5E3EAD7 ON squadit_webapp_domain_model_squad (leader)');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');

        $this->addSql('ALTER TABLE squadit_webapp_domain_model_squad DROP FOREIGN KEY FK_EE964ABBF5E3EAD7');
        $this->addSql('DROP INDEX IDX_EE964ABBF5E3EAD7 ON squadit_webapp_domain_model_squad');
        $this->addSql('ALTER TABLE squadit_webapp_domain_model_squad DROP leader');
    }
}
