<?php
class Livraison extends Model {

    public function __construct($db) {
        parent::__construct($db);
    }

    //Recuperer toutes les livraisons de la base de donnée
    public function getAllLivraisons() {
        $sql = "SELECT * FROM CDI_LIVRAISON 
                JOIN CDI_CLIENT USING (CL_NUMERO)";
        $query = $this->db->prepare($sql);      
        $query->execute();
        return $query->fetchAll();
    }

    //Donne le nombre d'article commandé
    public function getNombreCommandéPourArticle($ar_numero, $co_numero) {
        $sql = 'SELECT LIC_QTCMDEE FROM CDI_LIGCDE WHERE AR_NUMERO = :AR_NUMERO AND CO_NUMERO = :CO_NUMERO;';
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ":AR_NUMERO" => $ar_numero,
            ":CO_NUMERO" => $co_numero
        ));
        $query = $query->fetch();
        return (int) $query["LIC_QTCMDEE"];
    }

    //Insere une nouvelle livraison et ligne de livraison
    public function insererNouvelleLivraison($co_numero,$articlesLivres,$date_liv_prevue) {
        $li_numero_max = $this->getMaxId('CDI_LIVRAISON','LI_NUMERO','L');

        $sql = 'INSERT INTO CDI_LIVRAISON (LI_NUMERO,CO_NUMERO,DATE_LIV_PREVUE, MA_NUMERO, CL_NUMERO) VALUES (:LI_NUMERO,:CO_NUMERO,:DATE_LIV_PREVUE,
            (
                SELECT MA_NUMERO FROM CDI_COMMANDE WHERE CO_NUMERO = :CO_NUMERO
            ),
            (
                SELECT CL_NUMERO FROM CDI_COMMANDE WHERE CO_NUMERO = :CO_NUMERO
            ))';
        $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $dateLiv = $date_liv_prevue;

        $query->execute(array(
            ':LI_NUMERO' => $li_numero_max,
            ':CO_NUMERO' =>  $co_numero,
            ':DATE_LIV_PREVUE' =>  $date_liv_prevue
        ));

        foreach ($articlesLivres as $article) {
            $sql = 'INSERT INTO CDI_LIGLIV (LI_NUMERO,AR_NUMERO,LIL_QTLIVREE) VALUES (:LI_NUMERO,:AR_NUMERO,:LIL_QTLIVREE)';
            $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $query->execute(array(
                ':LI_NUMERO' => $li_numero_max,
                ':AR_NUMERO' =>  $article["AR_NUMERO"],
                ':LIL_QTLIVREE' => $article["QUANTITE"]
            ));
        }

    }

    //Permet de dire qu'une livraison a été effectuée en faisant un update sur LIGCDE
    public function livraisonEffectuee($li_numero) {
        //Recuperer articles de la commande
        $sql = "SELECT AR_NUMERO FROM CDI_LIGLIV WHERE LI_NUMERO = :LI_NUMERO";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ":LI_NUMERO" => $li_numero
        ));
        $results = $query->fetchAll();
        $date = date("Y-m-d H:i:s");
        foreach ($results as $result) {
            $sql = "UPDATE CDI_LIGCDE SET DATE_LIV = :DATE_LIV, LIC_QTLIVREE = 
                (
                    SELECT LIC_QTLIVREE FROM (select * from CDI_LIGCDE) as test 
                    WHERE AR_NUMERO = :AR_NUMERO 
                    AND CO_NUMERO = (SELECT CO_NUMERO FROM CDI_LIVRAISON WHERE LI_NUMERO = :LI_NUMERO )
                ) 
                + 
                (
                    SELECT LIL_QTLIVREE FROM CDI_LIGLIV WHERE AR_NUMERO = :AR_NUMERO AND LI_NUMERO = :LI_NUMERO
                )
                WHERE AR_NUMERO = :AR_NUMERO 
                AND CO_NUMERO = 
                (
                    SELECT CO_NUMERO FROM CDI_LIVRAISON WHERE LI_NUMERO = :LI_NUMERO   
                )
                ;";
            $query = $this->db->prepare($sql);
            $return = $query->execute(array(
                ":AR_NUMERO" => $result["AR_NUMERO"],
                ":LI_NUMERO" => $li_numero,
                ":DATE_LIV" => $date
            ));
        }

        //On met à la date du jour la date de livraison reele
        $sql = "UPDATE CDI_LIVRAISON SET DATE_LIV_REELE = :DATE_LIV WHERE LI_NUMERO = :LI_NUMERO";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ":LI_NUMERO" => $li_numero,
            ":DATE_LIV" => $date
        ));
    }

    //Permet de recuperer les livraisons concerné par le numero de commande envoyé en parametre
    public function getLivraisonsCommandeFinies($co_numero) {
        $sql = 'SELECT * FROM CDI_LIVRAISON  
                JOIN CDI_CLIENT USING (CL_NUMERO)
                WHERE CO_NUMERO = :co_numero
                AND DATE_LIV_REELE IS NOT NULL'
            ;
        $query = $this->db->prepare($sql);
        $parameters = array(':co_numero' => $co_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    //Permet de recuperer les livraisons  en cours d'une commande
    public function getLivraisonsCommandeEnCours($co_numero) {
        $sql = 'SELECT * FROM CDI_LIVRAISON  
                JOIN CDI_CLIENT USING (CL_NUMERO)
                WHERE CO_NUMERO = :co_numero
                AND DATE_LIV_REELE IS NULL'
            ;
        $query = $this->db->prepare($sql);
        $parameters = array(':co_numero' => $co_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    //Renvoie les ids des commandes
    public function getLivraisonsEnRetard(){
        $sql = "SELECT LI_NUMERO FROM CDI_LIVRAISON as LIV WHERE DATE_LIV_REELE IS NULL AND DATE_LIV_PREVUE <= NOW()";
        $query = $this->db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC); 
        //Extraire juste les ids
        $ids = array();
        foreach ($results as $result) {
            $ids[] = $result["LI_NUMERO"];
        }
        return $ids;
    }

     //Ajouter une quantite d'article a un nouvel 
    public function ajouterUneQuantiteArticleLivre($ar_numero,$li_numero,$quantite) {
        $sql = "SELECT * FROM CDI_LIGCDE WHERE ar_numero = '$ar_numero' AND co_numero = 
                ( 
                    SELECT CO_NUMERO FROM CDI_COMMANDE WHERE co_numero = 
                    ( 
                        SELECT DISTINCT CO_NUMERO FROM CDI_LIVRAISON WHERE LI_NUMERO = '$li_numero' 
                    ) 
                );";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $qteCmdee = intval($result["LIL_QTCMDEE"]);
        $qteLivree = intval($result["LIL_QTLIVREE"]);
        echo $qteLivree;
        echo $qteCmdee;
        $nvQuantite = $qteLivree + intval($quantite);
        echo $nvQuantite;
        if ($qteCmdee - $nvQuantite >= 0) {
            echo "cc";
            $sql = "UPDATE CDI_LIGLIV SET LIL_QTLIVREE = $nvQuantite WHERE ar_numero = '$ar_numero' AND li_numero = '$li_numero'";
            $query = $this->db->prepare($sql);
            $query->execute();
             $sql = "UPDATE CDI_LIGCDE SET LIL_QTLIVREE = $nvQuantite WHERE AR_NUMERO = '$ar_numero' AND CO_NUMERO = (select CO_NUMERO from CDI_COMMANDE where LI_NUMERO = '$li_numero')";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
    }

    //Permet de recuperer les livraisons concerné par le numero de client envoyé en parametre
    public function getLivraisonsDuClient($cl_numero) {
        $sql = 'SELECT * FROM CDI_LIVRAISON  
                JOIN CDI_CLIENT USING (CL_NUMERO)
                WHERE CL_NUMERO = :cl_numero';
        $query = $this->db->prepare($sql);
        $parameters = array(':cl_numero' => $cl_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function getLivraisonRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM CDI_LIVRAISON JOIN CDI_CLIENT USING (CL_NUMERO) WHERE '.$choix.' LIKE "%'.$champ.'%" ORDER BY '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getLivraisonOrder($choix,$ordre){
        $choix= htmlspecialchars($choix);
        $sql = 'SELECT * FROM CDI_LIVRAISON JOIN CDI_CLIENT USING (CL_NUMERO) ORDER BY '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}