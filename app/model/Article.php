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

    public function deleteArticle($articleId) {
        $sql = "DELETE FROM cdi_article WHERE id = :articleId";
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
    //Permet de recuperer les articles d'une livraison
    public function getArticlesPourLivraison($li_numero) {
        $sql = 'SELECT * FROM CDI_ARTICLE JOIN CDI_LIGLIV USING (ar_numero) WHERE LI_NUMERO = :li_numero;';
        $query = $this->db->prepare($sql);
        $parameters = array(':li_numero' => $li_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }
}
