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
        $sql = 'SELECT * FROM cdi_article where AR_'.$choix.' like "%'.$champ.'%" order by AR_'.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
