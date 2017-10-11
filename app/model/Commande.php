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

    public function getAllCommandes() {
        $sql = "SELECT * FROM CDI_COMMANDE;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}