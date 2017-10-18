<?php

class Fournisseur extends Model
{

    public function __construct($db) {
        parent::__construct($db);
    }

    public function getAllFournisseurs() {
        $sql = "SELECT * FROM cdi_fournisseur";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getFournisseurRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM cdi_fournisseur where '.$choix.' like "%'.$champ.'%" order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
        public function getFournisseur($num)
    {
        $sql = "SELECT * FROM cdi_fournisseur where FO_NUMERO='$num'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}