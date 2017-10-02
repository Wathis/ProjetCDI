<?php

class ArticleController extends Controller
{
    public function indexAction()
    {
    	$this->loadModel('Article');
    	$articles = $this->model->getAllArticles();
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/article/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function rechercherArtAction() {
		$this->loadModel('Article');
		$champ = $_POST["champ"];
		$choix = $_POST["choix"];
		$articles = $this->model->getArticleRecherche($champ,$choix);
		require APP . 'view/_templates/header.php';
        require APP . 'view/article/index.php';
        require APP . 'view/_templates/footer.php';
	}
}
