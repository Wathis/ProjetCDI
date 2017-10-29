<?php

class ArticleController extends Controller
{
    public function indexAction()
    {
    	$this->loadModel('Article');
        if (isset($_GET["fo_numero"]))
        {
            $num = trim ($_GET["fo_numero"]);
            $articles = $this->model->getArticleRecherche($num,'FO_NUMERO','asc');
        }
    	else
        {
            $articles = $this->model->getAllArticles();
        }
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/article/index.php';
        require APP . 'view/_templates/footer.php';
    }

    //Consuler les articles qui restent a livrer
    public function restantALivrerAction(){

        $this->loadModel('Article');
        if (isset($_GET["co_numero"])) {    
            $co_numero = $_GET["co_numero"];
            $articles = $this->model->getArticlesRestantALivrer($co_numero);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/article/restant.php';
        require APP . 'view/_templates/footer.php';
    }

    public function rechercherArtAction() {
		$this->loadModel('Article');
		$champ = $_POST["champ"];
		$choix = $_POST["choix"];
        $ordre = $_POST["ordre"];
		$articles = $this->model->getArticleRecherche($champ,$choix,$ordre);
		require APP . 'view/_templates/header.php';
        require APP . 'view/article/index.php';
        require APP . 'view/_templates/footer.php';
	}
    public function trieArtAction() {
        $this->loadModel('Article');
        $choix = $_POST["tris"];
        $ordre = $_POST["ordre1"];
        $articles = $this->model->getArticleOrder($choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/article/index.php';
        require APP . 'view/_templates/footer.php';
        }

    //permet de rechercher les articles d'une livraisons donnée en GET
    public function articlesDeLivraisonAction() {
        $this->loadModel('Article');
        $form = new Form();
        if (isset($_GET)) {
            if (isset($_GET["li_numero"]) && !empty($_GET["li_numero"])){
                $li_numero = $_GET["li_numero"];
                $li_numero = $form->securiserChamp($li_numero);
                $articles = $this->model->getArticlesPourLivraison($li_numero);
            } else { //Alors aucun client choisi
                $messages[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $messages[] = "Vous n'avez pas fourni de numero de client";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/article/livraisons.php';
        require APP . 'view/_templates/footer.php';
    }
}
