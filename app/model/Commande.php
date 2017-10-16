<?php
class Commande {

    private $db;

    public function __construct($db) {

        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Connexion à la base de donnée impossible');
        }
    }

    public function getArticles($co_numero) {
        $sql = 'SELECT * FROM CDI_LIGCDE JOIN CDI_ARTICLE using (AR_NUMERO) WHERE CO_NUMERO = :co_numero;';
        $query = $this->db->prepare($sql);
        $parameters = array(':co_numero' => $co_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getAllCommandes() {
        $sql = "SELECT * FROM CDI_COMMANDE;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getCommande($num){
        $sql = "SELECT * FROM CDI_COMMANDE join cdi_ligcde using(co_numero) join cdi_article using(ar_numero) where ar_numero = '$num';";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}