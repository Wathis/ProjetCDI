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

    //Recupere les ids des commandes qui n'ont pas encore de livraisons
    public function getCommandeSansLivraisons() {
        $sql = 'SELECT CO_NUMERO FROM CDI_COMMANDE WHERE CO_NUMERO NOT IN 
                ( 
                    SELECT CO_NUMERO FROM CDI_LIVRAISON 
                );';
        $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $query->execute();
        $results = $query->fetchAll();
        $commandes = array();
        foreach ($results as $result) {
            $commandes[] = $result["CO_NUMERO"];
        }
        return $commandes;
    }

    //permet d'ajouter une nouvelle commande  avec ses articles
    public function nouvelleCommande($co_date,$ma_numero,$cl_numero, $articles) {
        $sql = 'SELECT max(CAST(SUBSTR(CO_NUMERO,2)as UNSIGNED INT)) as maxi FROM cdi_commande ';
        $query = $this->db->prepare($sql);
        $query->execute();
        $query=$query->fetch();
        $co_numero_max = 'C'.($query["maxi"]+1);


        $sql = 'INSERT INTO cdi_commande (CO_NUMERO,MA_NUMERO,CL_NUMERO,CO_DATE) VALUES (:CO_NUMERO,:MA_NUMERO,:CL_NUMERO,:CO_DATE)';
        $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $query->execute(array(
            ':CO_NUMERO' => $co_numero_max,
            ':MA_NUMERO' =>  $ma_numero,
            ':CL_NUMERO' =>  $cl_numero,
            ':CO_DATE' =>  $co_date
        ));

        foreach ($articles as $articleId => $article) {

            //On cherche le PV de l'article pour effectuer la reduction
            $sql = 'SELECT AR_PV FROM cdi_article WHERE AR_NUMERO = :AR_NUMERO;';
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':AR_NUMERO' => $articleId
            ));
            $query = $query->fetch();
            $PrixVente = $query["AR_PV"];

            $sql = 'INSERT INTO cdi_ligcde (AR_NUMERO,CO_NUMERO,LIC_QTCMDEE,LIC_QTLIVREE,LIC_PU) VALUES (:AR_NUMERO,:CO_NUMERO,:LIC_QTCMDEE,:LIC_QTLIVREE,:LIC_PU)';
            $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $query->execute(array(
                ':AR_NUMERO' => $articleId,
                ':CO_NUMERO' => $co_numero_max,
                ':LIC_QTCMDEE' => $article["LIC_QTCMDEE"],
                ':LIC_QTLIVREE' => 0,
                ':LIC_PU' => $PrixVente - $PrixVente * ($article["REDUCTION"] / 100)
            ));

            $sql = 'UPDATE CDI_ARTICLE SET AR_STOCK = AR_STOCK - "' . $article['LIC_QTCMDEE'] . '" WHERE AR_NUMERO = "' . $articleId . '";';
            $query = $this->db->prepare($sql);
            $query->execute();
        }
        return $co_numero_max;
    }

    public function clientExiste($num){
        $sql = 'SELECT count(CL_NUMERO)as num FROM CDI_CLIENT where CL_NUMERO = '.$num.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function magasinExiste($num){
        $sql = 'SELECT count(MA_NUMERO)as num FROM CDI_MAGASIN where MA_NUMERO = '.$num.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    //Recuperer toutes les commandes de la base de donnée
    public function getAllCommandes() {
        $sql = "SELECT * FROM CDI_COMMANDE;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getCommandeOrder($choix,$ordre){
        $choix= htmlspecialchars($choix);
        $sql = 'SELECT * FROM cdi_commande order by '.$choix.' '.$ordre.'';
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