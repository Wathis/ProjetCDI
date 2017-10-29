<?php

class Article extends Model
{
    public function __construct($db) {
        parent::__construct($db);
    }

    public function getAllArticles() {
        $sql = "SELECT * FROM cdi_article";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //On check si il reste des articles en stock
    public function estEnStock($ar_numero,$quantity) {
        $sql = "SELECT AR_STOCK FROM cdi_article WHERE  ar_numero = :ar_numero";
        $query = $this->db->prepare($sql);
        $parameters = array(':ar_numero' => $ar_numero);
        $query->execute($parameters);
        $result = $query->fetch();
        $stock = (int) $result["AR_STOCK"];
        return $stock - $quantity >= 0 ? true : false;
    }

    public function deleteArticle($articleId) {
        $sql = "DELETE FROM cdi_article WHERE ar_numero = :ar_numero";
        $query = $this->db->prepare($sql);
        $parameters = array(':ar_numero' => $articleId);
        $query->execute($parameters);
    }
    public function getArticleRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM cdi_article where '.$choix.' like "%'.$champ.'%" order by '.$choix.' '.$ordre.'';
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
        $sql = 'SELECT * FROM cdi_article order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
