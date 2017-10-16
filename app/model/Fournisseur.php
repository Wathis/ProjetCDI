<?php

class Fournisseur
{
    private $db;

    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Connexion à la base de donnée impossible');
        }
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
        $sql = 'SELECT * FROM cdi_fournisseur where FO_'.$choix.' like "%'.$champ.'%" order by FO_'.$choix.' '.$ordre.'';
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