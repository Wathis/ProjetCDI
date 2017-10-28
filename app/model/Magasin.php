<?php
class Magasin extends Model {

    public function __construct($db) {
        parent::__construct($db);
    }

    //Permet de recuperer tous les magasins
    public function getAllMagasins() {
        $sql = "SELECT * FROM CDI_MAGASIN;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getMagasin($numero) {
        $sql = "SELECT * FROM CDI_MAGASIN where MA_NUMERO = :numero;";
        $query = $this->db->prepare($sql);
        $query->bindParam(':numero', $numero);
        $query->execute();
        return $query->fetch();
    }
}