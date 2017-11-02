<?php
class Parametre extends Model {

    public function __construct($db) {
        parent::__construct($db);
    }

    public function resetAllTables() {
        // $this->resetTable("CDI_ARTICLE");
        // $this->resetTable("CDI_CLIENT");
        $this->resetTable("CDI_COMMANDE");
        // $this->resetTable("CDI_FOURNISSEUR");
        $this->resetTable("CDI_LIGCDE");
        $this->resetTable("CDI_LIGLIV");
        $this->resetTable("CDI_LIVRAISON");
        // $this->resetTable("CDI_MAGASIN");
    }


    public function resetTables() {
        $this->resetTable("CDI_CLIENT");
        $this->resetTable("CDI_COMMANDE");
        $this->resetTable("CDI_LIGCDE");
        $this->resetTable("CDI_LIGLIV");
        $this->resetTable("CDI_LIVRAISON");
    }

    //Delete la table passé en parametre
    public function resetTable($name) {
        $sql = "DELETE FROM $name WHERE 1;";
        $query = $this->db->prepare($sql);      
        $query->execute();
    }

}