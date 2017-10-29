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
        $sql = 'SELECT LIC_QTCMDEE - LIC_QTLIVREE as restant FROM CDI_LIGCDE WHERE AR_NUMERO = :AR_NUMERO AND CO_NUMERO = :CO_NUMERO;';
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ":AR_NUMERO" => $ar_numero,
            ":CO_NUMERO" => $co_numero
        ));
        $query = $query->fetch();
        return (int) $query["restant"];
    }

    //Insere une nouvelle livraison et ligne de livraison
    public function insererNouvelleLivraison($co_numero,$articlesLivres) {
        $sql = 'SELECT max(CAST(SUBSTR(LI_NUMERO,2)as UNSIGNED INT)) as maxi FROM CDI_LIVRAISON ';
        $query = $this->db->prepare($sql);
        $query->execute();
        $query=$query->fetch();
        $li_numero_max = 'L'.($query["maxi"]+1);

        $sql = 'INSERT INTO CDI_LIVRAISON (LI_NUMERO,CO_NUMERO,DATE_LIV, MA_NUMERO, CL_NUMERO) VALUES (:LI_NUMERO,:CO_NUMERO,:DATE_LIV,
            (
                SELECT MA_NUMERO FROM CDI_COMMANDE WHERE CO_NUMERO = :CO_NUMERO
            ),
            (
                SELECT CL_NUMERO FROM CDI_COMMANDE WHERE CO_NUMERO = :CO_NUMERO
            ))';
        $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $dateLiv = date("Y-m-d H:i:s");

        $query->execute(array(
            ':LI_NUMERO' => $li_numero_max,
            ':CO_NUMERO' =>  $co_numero,
            ':DATE_LIV' =>  $dateLiv
        ));

        foreach ($articlesLivres as $article) {
            $sql = 'INSERT INTO CDI_LIGLIV (LI_NUMERO,AR_NUMERO,LIL_QTLIVREE) VALUES (:LI_NUMERO,:AR_NUMERO,:LIL_QTLIVREE)';
            $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $query->execute(array(
                ':LI_NUMERO' => $li_numero_max,
                ':AR_NUMERO' =>  $article["AR_NUMERO"],
                ':LIL_QTLIVREE' => $article["QUANTITE"]
            ));
            $sql = "UPDATE CDI_LIGCDE SET DATE_LIV = :DATE_LIV, LIC_QTLIVREE = (SELECT LIC_QTLIVREE FROM (select * from CDI_LIGCDE) as test WHERE AR_NUMERO = :AR_NUMERO AND CO_NUMERO = :CO_NUMERO ) + :LIC_QTLIVREE WHERE AR_NUMERO = :AR_NUMERO AND CO_NUMERO = :CO_NUMERO;";
            $this->db->prepare($sql)->execute(array(
                ':CO_NUMERO' => $co_numero,
                ':AR_NUMERO' =>  $article["AR_NUMERO"],
                ':LIC_QTLIVREE' => $article["QUANTITE"],
                ':DATE_LIV' => $dateLiv
            ));
        }

    }

    //Permet de recuperer les livraisons concerné par le numero de commande envoyé en parametre
    public function getLivraisonsCommande($co_numero) {
        $sql = 'SELECT * FROM CDI_LIVRAISON  
                JOIN CDI_CLIENT USING (CL_NUMERO)
                WHERE CO_NUMERO = :co_numero;'
            ;
        $query = $this->db->prepare($sql);
        $parameters = array(':co_numero' => $co_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    //Renvoie les ids des commandes 
    public function getLivraisonsEnRetard(){
        $sql = "SELECT LI_NUMERO FROM CDI_LIVRAISON as LIV WHERE CO_NUMERO IN 
                ( 
                    SELECT CO_NUMERO FROM CDI_LIGCDE WHERE LIC_QTCMDEE > LIC_QTLIVREE 
                ) 
                AND 
                ( 
                    DATE_ADD((SELECT CO_DATE FROM CDI_COMMANDE WHERE CO_NUMERO = LIV.CO_NUMERO), INTERVAL 5 DAY) <= NOW()
                    OR DATE_LIV is null
                )";
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
                    select co_numero from cdi_commande where co_numero = 
                    ( 
                        select distinct co_numero from CDI_LIVRAISON Where li_numero = '$li_numero' 
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
             $sql = "UPDATE CDI_LIGCDE SET LIL_QTLIVREE = $nvQuantite WHERE ar_numero = '$ar_numero' AND co_numero = (select co_numero from cdi_commande where li_numero = '$li_numero')";
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
        $sql = 'SELECT * FROM CDI_LIVRAISON where '.$choix.' like "%'.$champ.'%" order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getLivraisonOrder($choix,$ordre){
        $choix= htmlspecialchars($choix);
        $sql = 'SELECT * FROM CDI_LIVRAISON order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}