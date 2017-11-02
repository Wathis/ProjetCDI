<?php

class Fournisseur extends Model
{

    public function __construct($db) {
        parent::__construct($db);
    }

    public function getAllFournisseurs() {
        $sql = "SELECT * FROM CDI_FOURNISSEUR";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //Ajouter un nouveau fournisseur
    public function ajouterFournisseur($nom) {
        $num = $this->getMaxId('CDI_FOURNISSEUR','FO_NUMERO','F');

        $sql = 'INSERT INTO CDI_FOURNISSEUR (FO_NUMERO,FO_NOM) VALUES (:FO_NUMERO,:FO_NOM)';
        $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $query->execute(array(
            ':FO_NUMERO' => $num,
            ':FO_NOM' =>  $nom
        ));
    }

    //Permet de recuperer les fournisseurs triés
    public function getFournisseurRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM CDI_FOURNISSEUR WHERE '.$choix.' LIKE "%'.$champ.'%" ORDER BY '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    public function getFournisseur($num) {
        $sql = "SELECT * FROM CDI_FOURNISSEUR WHERE FO_NUMERO='$num'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getFournisseurOrder($choix,$ordre){
        $choix= htmlspecialchars($choix);
        $sql = 'SELECT * FROM CDI_FOURNISSEUR ORDER BY '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}