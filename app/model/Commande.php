<?php
class Commande extends Model {

    public function __construct($db) {
        parent::__construct($db);
    }

    //Recuperer les articles d'une commande donnée en parametre
    public function getArticles($co_numero) {
        $sql = 'SELECT * FROM CDI_LIGCDE JOIN CDI_ARTICLE using (AR_NUMERO) WHERE CO_NUMERO = :co_numero;';
        $query = $this->db->prepare($sql);
        $parameters = array(':co_numero' => $co_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    //Recuperer toutes les commandes de la base de donnée
    public function getAllCommandes() {
        $sql = "SELECT * FROM CDI_COMMANDE;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //Recuper les commandes qui ont pour numero article $ar_article
    public function getCommandeArticle($ar_numero){
        $sql = "SELECT * FROM CDI_COMMANDE join cdi_ligcde using(co_numero) join cdi_article using(ar_numero) where ar_numero = '$ar_numero';";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //Permet de recuperer les commandes concerné par le numero de client envoyé en parametre
    public function getCommandeClient($cl_numero) {
        $sql = 'SELECT * FROM CDI_COMMANDE WHERE CL_NUMERO = :cl_numero;';
        $query = $this->db->prepare($sql);
        $parameters = array(':cl_numero' => $cl_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function getCommandeRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM CDI_COMMANDE where '.$choix.' like "%'.$champ.'%" order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}