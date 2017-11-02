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

    //Ajouter un nouveau magasin
    public function insererNouveauMagasin($nom,$prenom,$localite) {
        $num = $this->getMaxId('CDI_MAGASIN','MA_NUMERO','M');

        $sql = 'INSERT INTO CDI_MAGASIN (MA_NUMERO,MA_NOM_GERANT,MA_PRENOM_GERANT,MA_LOCALITE) VALUES (:MA_NUMERO,:MA_NOM_GERANT,:MA_PRENOM_GERANT,:MA_LOCALITE)';
        $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $query->execute(array(
            ':MA_NUMERO' => $num,
            ':MA_NOM_GERANT' =>  $nom,
            ':MA_PRENOM_GERANT' =>  $prenom,
            ':MA_LOCALITE' =>  $localite
        ));
    }

    //Permet de recuperer les magasins triés
    public function getMagasinRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM CDI_MAGASIN where '.$choix.' LIKE "%'.$champ.'%" ORDER BY '.$choix.' '.$ordre.'';
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