<?php
class Livraison extends Model {

    public function __construct($db) {
        parent::__construct($db);
    }

    //Recuperer toutes les livraisons de la base de donnée
    public function getAllLivraisons() {
        $sql = "SELECT * FROM CDI_LIVRAISON;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //Permet de recuperer les livraisons concerné par le numero de commande envoyé en parametre
    public function getLivraisonsCommande($co_numero) {
        $sql = 'SELECT * FROM CDI_LIVRAISON WHERE CO_NUMERO = :co_numero;';
        $query = $this->db->prepare($sql);
        $parameters = array(':co_numero' => $co_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    //Permet de recuperer les livraisons concerné par le numero de client envoyé en parametre
    public function getLivraisonsDuClient($cl_numero) {
        $sql = 'SELECT * FROM CDI_LIVRAISON WHERE CL_NUMERO = :cl_numero;';
        $query = $this->db->prepare($sql);
        $parameters = array(':cl_numero' => $cl_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function getLivraisonRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM CDI_LIVRAISON where '.$choix.' like "%'.$champ.'%" order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}