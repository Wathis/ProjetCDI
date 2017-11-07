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

    //Action correspondant à l'ajout d'un nouvel article
    public function ajouterAction() {

        //On charche tous les fournisseurs pour le select
        $this->loadModel('Fournisseur');
        $fournisseurs = $this->model->getAllFournisseurs();

        $errors = array();
        $form = new Form();

        //L'utilisateur a appuyé sur "ajouter"
        if (isset($_POST["submit"])) {
            //On fait toutes les verifications obligatoires
            $articleInformations = array();
            if (isset($_POST['AR_NOM']) && !empty($_POST['AR_NOM'])){
                $articleInformations["AR_NOM"] = strtoupper($_POST['AR_NOM']);   
            } else {
                $errors[] = "Vous n'avez pas entré de nom d'article";
            }

            if (isset($_POST['AR_PV'])){
                if (!preg_match("#^[0-9]+$#", $_POST['AR_PV'])) {
                    $errors[] = "Le prix de vente doit être un nombre";
                } else {
                    $articleInformations["AR_PV"] = $_POST['AR_PV'];   
                }
            } else {
                $errors[] = "Vous n'avez pas entré de prix de vente";
            }

            if (isset($_POST['AR_PA'])){
                if (!preg_match("#^[0-9]+$#", $_POST['AR_PA'])) {
                    $errors[] = "Le prix d'achat doit être un nombre";
                } else {
                    $articleInformations["AR_PA"] = $_POST['AR_PA'];   
                }
            } else {
                $errors[] = "Vous n'avez pas entré de prix d'achat";
            }

            //On extrait les données facultatives
            $articleInformations["FO_NUMERO"] = $_POST['FO_NUMERO'];
            $articleInformations["AR_COULEUR"] = strtoupper($_POST['AR_COULEUR']); 
            //le isset et empty permettent de rendre les champs facultatifs
            if (isset($_POST['AR_POIDS']) && !empty($_POST['AR_POIDS'])) {
                if (!preg_match("#^[0-9]+$#", $_POST['AR_POIDS'])) {
                    $errors[] = "Le poids est invalide";
                } else {
                    $articleInformations["AR_POIDS"] = $_POST['AR_POIDS'];   
                }
            }
            if (isset($_POST['AR_STOCK']) && !empty($_POST['AR_STOCK'])) {
                if (!preg_match("#^[0-9]+$#", $_POST['AR_STOCK'])) {
                    $errors[] = "Le stock est invalide";
                } else {
                    $articleInformations["AR_STOCK"] = $_POST['AR_STOCK'];   
                }
            }

            //Donc toutes les données sont récupérées, on peut inserer l'article
            if (count($errors) == 0) {
                //Insertion de l'article
                $this->loadModel('Article');
                $this->model->ajouterArticle($articleInformations);
                $success = "Article ajouté";
                echo "<PRE>";
                print_r($articleInformations);
                echo "</PRE>";
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/article/ajouter.php';
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
                $erros[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $erros[] = "Vous n'avez pas fourni de numero de client";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/article/livraisons.php';
        require APP . 'view/_templates/footer.php';
    }
}
