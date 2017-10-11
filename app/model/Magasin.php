<?php
class Magasin {

    private $db;

    public function __construct($db) {

        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Connexion à la base de donnée impossible');
        }
    }

    public function getMagasin($numero) {
        $sql = "SELECT * FROM CDI_MAGASIN where MA_NUMERO = :numero;";
        $query = $this->db->prepare($sql);
        $query->bindParam(':numero', $numero);
        $query->execute();
        return $query->fetch();
    }
}