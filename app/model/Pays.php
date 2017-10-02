<?php 

class Pays
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

    public function getAllPays() {
        $sql = "SELECT * FROM pays";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

?>