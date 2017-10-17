<?php 

class Pays extends Model
{

    public function __construct($db) {
        parent::__construct($db);
    }

    public function getAllPays() {
        $sql = "SELECT * FROM CDI_PAYS ORDER BY NOM";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

}   