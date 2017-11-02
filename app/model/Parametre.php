<?php
class Parametre extends Model {

    public function __construct($db) {
        parent::__construct($db);
    }

    public function resetAllTables() {
        $this->resetTable("CDI_ARTICLE");
        $this->resetTable("CDI_CLIENT");
        $this->resetTable("CDI_COMMANDE");
        $this->resetTable("CDI_FOURNISSEUR");
        $this->resetTable("CDI_LIGCDE");
        $this->resetTable("CDI_LIGLIV");
        $this->resetTable("CDI_LIVRAISON");
        $this->resetTable("CDI_MAGASIN");
    }


    public function resetCommande() {
        $this->resetTable("CDI_COMMANDE");
        $this->resetTable("CDI_LIVRAISON");
    }

    //Inserer des données de base
    public function insererFournisseurs() {
        $this->inserer("INSERT INTO CDI_FOURNISSEUR (FO_NUMERO, FO_NOM) VALUES
                        ('F01', 'CATI O ELECTRONIC'),
                        ('F02', 'LES STYLOS REUNIS'),
                        ('F03', 'MECANIQUE DE PRECISION'),
                        ('F04', 'SARL ROULAND'),
                        ('F05', 'ELECTROLAMP'),
                        ('F06', 'RAMONAGE BDD');");
    }
    //Inserer des données de base
    public function insererMagasins() {
        $this->inserer("INSERT INTO `CDI_MAGASIN` (`MA_NUMERO`, `MA_LOCALITE`, `MA_NOM_GERANT`, `MA_PRENOM_GERANT`) VALUES
                        ('M01', 'PARIS 5E', 'BERTON','Louis'),
                        ('M02', 'PARIS 10E', 'JANNEAU','Luc'),
                        ('M03', 'LYON', 'MOUILLARD','Marcel'),
                        ('M04', 'MARSEILLE', 'CAMUS','Marius'),
                        ('M05', 'MONTPELLIER', 'BAIJOT','Marc'),
                        ('M06', 'BORDEAUX', 'DETIENNE','Nicole'),
                        ('M07', 'NANTES', 'DUMONT','Henri'),
                        ('M08', 'TOURS', 'DEMARTEAU','Renee'),
                        ('M09', 'ROUEN', 'NOSSENT','Daniel'),
                        ('M10', 'LILLE', 'NIZET','Jean Luc'),
                        ('M11', 'BRUXELLES', 'VANDAELE','Annick'),
                        ('M12', 'LIEGE', 'HANNEAU','Vincent');"
        );
    }

    //Inserer des données de base
    public function insererArticles() {
        $this->inserer("INSERT INTO `CDI_ARTICLE` (`AR_NUMERO`, `FO_NUMERO`, `AR_NOM`, `AR_POIDS`, `AR_COULEUR`, `AR_STOCK`, `AR_PA`, `AR_PV`, `ar_poicode`) VALUES
            ('A01', 'F04', 'AGRAFEUSE', '150.000', 'ROUGE', 3, '7.00', '10.00', NULL),
            ('A02', 'F01', 'CALCULATRICE', '100.000', 'NOIR', NULL, '25.00', '40.00', NULL),
            ('A03', 'F04', 'CACHEUR-DATEUR', '100.000', 'BLANC', 3, '15.00', '25.00', NULL),
            ('A04', 'F05', 'LAMPE', '550.000', 'ROUGE', 48, '18.00', '28.00', NULL),
            ('A05', 'F05', 'LAMPE', '550.000', 'BLANC', 666, '18.00', '28.00', NULL),
            ('A06', 'F05', 'LAMPE', '550.000', 'BLEU', NULL, '18.00', '28.00', NULL),
            ('A07', 'F05', 'LAMPE', '550.000', 'VERT', 3, '18.00', '28.00', NULL),
            ('A08', 'F03', 'PESE-LETTRE 1-500', '1230.000', NULL, NULL, '28.00', '35.00', NULL),
            ('A09', 'F03', 'PESE-LETTRE 1-1000', NULL, NULL, 3, '30.00', '39.00', NULL),
            ('A10', 'F02', 'CRAYON', '20.000', 'ROUGE', NULL, '1.00', '2.00', NULL),
            ('A11', 'F02', 'CRAYON', '20.000', 'BLEU', NULL, '3.00', '4.00', NULL),
            ('A12', 'F02', 'CRAYON LUXE', '20.000', 'ROUGE', 8, '3.00', '4.00', NULL),
            ('A13', 'F02', 'CRAYON LUXE', '20.000', 'VERT', 7, '3.00', '4.00', NULL),
            ('A14', 'F02', 'CRAYON LUXE', '20.000', 'BLEU', NULL, '3.00', '4.00', NULL),
            ('A15', 'F02', 'CRAYON LUXE', '20.000', 'NOIR', NULL, '3.00', '5.00', NULL),
            ('A20', 'F01', 'COLLE', '60.000', 'BLANC', NULL, '1.00', '3.00', NULL),
            ('A21', 'F06', 'COLLE', '60.000', 'BLANC', 10, '1.00', '2.00', NULL),
            ('A22', 'F03', 'COLLE', '60.000', 'BLANC', 34, '1.00', '2.00', NULL),
            ('A25', 'F01', 'COLLE', NULL, 'BLANC', 10, '1.00', '2.00', NULL),
            ('A26', 'F02', 'COLLE', '60.000', 'BLANC', 15, '1.00', '2.00', NULL),
            ('A27', 'F05', 'COLLE', '60.000', 'BLANC', 1, '1.00', '2.00', NULL),
            ('A28', 'F03', 'Surligneur', '10.000', 'JAUNE', 0, '1.00', '2.00', NULL),
            ('A30', 'F01', 'Calculatrice', '80.000', 'Bleu', NULL, '6.00', '15.00', NULL),
            ('A31', 'F06', 'SOURIS', '35.000', 'Vert', 5, '2.00', '5.00', NULL);"
        );
    }

    private function inserer($sql) {
        $query = $this->db->prepare($sql);
        $query->execute();
    }

    //Delete la table passé en parametre
    public function resetTable($name) {
        $sql = "DELETE FROM $name WHERE 1;";
        $query = $this->db->prepare($sql);      
        $query->execute();
    }

}