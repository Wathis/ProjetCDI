<?php

class Article extends Model
{
    public function __construct($db) {
        parent::__construct($db);
    }

    public function getAllArticles() {
        $sql = "SELECT * FROM CDI_ARTICLE";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //Return true si le stock est null
    public function stockEstNull($ar_numero) {
        $sql = "SELECT count(AR_NUMERO) as nb FROM CDI_ARTICLE WHERE  AR_NUMERO = :AR_NUMERO AND AR_STOCK IS NULL";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ":AR_NUMERO" => $ar_numero
        ));
        $query = $query->fetch();
        $nbr = (int) $query["nb"];
        var_dump($nbr);
        return $nbr > 0;
    }

    //On check si il reste des articles en stock
    public function estEnStock($ar_numero,$quantity) {
        $sql = "SELECT AR_STOCK FROM CDI_ARTICLE WHERE  AR_NUMERO = :ar_numero";
        $query = $this->db->prepare($sql);
        $parameters = array(':ar_numero' => $ar_numero);
        $query->execute($parameters);
        $result = $query->fetch();
        $stock = (int) $result["AR_STOCK"];
        return $stock - $quantity >= 0 ? true : false;
    }

    //permet d'ajouter un nouvel article
    public function ajouterArticle($article) {
        $num = $this->getMaxId('CDI_ARTICLE','AR_NUMERO','A');

        $sql = 'INSERT INTO CDI_ARTICLE (AR_NUMERO,AR_NOM,AR_POIDS,AR_COULEUR,AR_STOCK,AR_PA,AR_PV,FO_NUMERO) VALUES (:AR_NUMERO,:AR_NOM,:AR_POIDS,:AR_COULEUR,:AR_STOCK,:AR_PA,:AR_PV,:FO_NUMERO)';
        $query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $query->execute(array(
            ':AR_NUMERO' => $num,
            ':AR_NOM' =>  $article["AR_NOM"],
            ':AR_POIDS' =>  $article["AR_POIDS"],
            ':AR_COULEUR' =>  $article["AR_COULEUR"],
            ':AR_STOCK' =>  $article["AR_STOCK"],
            ':AR_PA' =>  $article["AR_PA"],
            ':AR_PV' =>  $article["AR_PV"],
            ':FO_NUMERO' =>  $article["FO_NUMERO"]
        ));
    }


    //supprimer un article
    public function deleteArticle($articleId) {
        $sql = "DELETE FROM CDI_ARTICLE WHERE AR_NUMERO = :ar_numero";
        $query = $this->db->prepare($sql);
        $parameters = array(':ar_numero' => $articleId);
        $query->execute($parameters);
    }
    public function getArticleRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM CDI_ARTICLE where '.$choix.' LIKE "%'.$champ.'%" order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


    //Recupere les articles restants a livrer pour une commande
    public function getArticlesRestantALivrer($co_numero) {
        $sql = 'SELECT * FROM CDI_ARTICLE JOIN CDI_LIGCDE USING (AR_NUMERO) 
                WHERE CO_NUMERO = :CO_NUMERO AND LIC_QTCMDEE > LIC_QTLIVREE';
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ":CO_NUMERO" => $co_numero
        ));
        return $query->fetchAll();
    }

    //Permet de recuperer les articles d'une livraison
    public function getArticlesPourLivraison($li_numero) {
        $sql = 'SELECT * FROM CDI_ARTICLE JOIN CDI_LIGLIV USING (ar_numero) WHERE LI_NUMERO = :li_numero;';
        $query = $this->db->prepare($sql);
        $parameters = array(':li_numero' => $li_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function getArticleOrder($choix,$ordre){
        $choix= htmlspecialchars($choix);
        $sql = 'SELECT * FROM CDI_ARTICLE order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
