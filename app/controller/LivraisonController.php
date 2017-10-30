<?php

class LivraisonController extends Controller {

    //Action de l'index
	public function indexAction() {
		$this->loadModel('Livraison');
		$livraisons = $this->model->getAllLivraisons();
        $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
		require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
	}

    //Action pour choisir la commande avant de creer une livraison
    public function choisirCommandeAction() {

        $this->loadModel('Commande');
        $commandes = $this->model->getAllCommandes();
        $errors = array();

        if (isset($_POST["submit"])) {
            if (isset($_POST["CO_NUMERO"]) && !empty($_POST["CO_NUMERO"])){
                header("Location:".URL."livraison/ajouter?co_numero=" . $_POST["CO_NUMERO"]);
            } else {
                $errors[] = "Vous devez choisir une commande";
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/choisir.php';
        require APP . 'view/_templates/footer.php';
    }


    //Creer une livraison 
    public function ajouterAction() {
        $errors = array();
        if (isset($_GET["co_numero"])) {
            $co_numero = $_GET["co_numero"];
        } else {
            $errors[] = "Aucune commande selectionné";
        }
        //On charge les articles de la commande
        $this->loadModel('Commande');
        $articles = $this->model->getArticles($co_numero);

        $this->loadModel('Livraison');
        if (isset($_POST["submit"])){
            $articlesLivres = array();
            if (isset($_POST["CO_NUMERO"])){
                $co_numero = $_POST["CO_NUMERO"];
            }
            //On charge les numero des articles selectionnés
            foreach ($articles as $article) {
                if (isset($_POST[$article["AR_NUMERO"]])) {
                    if (isset($_POST["quantity" . $article["AR_NUMERO"]]) && !empty($_POST["quantity" . $article["AR_NUMERO"]])) {
                        $quantite = $_POST["quantity" . $article["AR_NUMERO"]];
                        $restant = $this->model->getNombreCommandéPourArticle($article["AR_NUMERO"], $co_numero);
                        if ($restant - $quantite >= 0) {
                            $articlesLivres[] = array (
                                "AR_NUMERO" => $article["AR_NUMERO"],
                                "QUANTITE" => $quantite
                            );
                        } else {
                            $errors[] = "Un article va être livré en trop";
                        }
                    } else {
                        $errors[] = "Un article n'a pas eu de quantité";
                    }
                }
            }
            if (count($errors) == 0){
                 //On insere une nouvelle commande                 
                $this->model->insererNouvelleLivraison($co_numero,$articlesLivres);
                $success = "Livraison ajoutée";
            }
        } 

        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/ajouter.php';
        require APP . 'view/_templates/footer.php';
    }

    //Action pour afficher les livraisons d'une commande
    public function commandesAction() {
        $this->loadModel('Livraison');
        $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
        $form = new Form();
        if (isset($_GET)) {
            if (isset($_GET["co_numero"]) && !empty($_GET["co_numero"])){
                $co_numero = $_GET["co_numero"];
                $co_numero = $form->securiserChamp($co_numero);
                $livraisons = $this->model->getLivraisonsCommande($co_numero);
            } else { //Alors aucun magasin choisi
                $errors[] = "Vous n'avez pas fourni de numero de commande";
            }
        } else {
            $errors[] = "Vous n'avez pas fourni de numero de commande";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function trieLiAction() {
        $this->loadModel('Livraison');
        $choix = $_POST["tris"];
        $ordre = $_POST["ordre1"];
        $livraisons = $this->model->getLivraisonOrder($choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
    }

    //Action pour afficher les livraisons d'un client
    public function consulterLivraisonsClientAction() {
        $this->loadModel('Livraison');
        $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
        $form = new Form();
        if (isset($_GET)) {
            if (isset($_GET["cl_numero"]) && !empty($_GET["cl_numero"])){
                $cl_numero = $_GET["cl_numero"];
                $cl_numero = $form->securiserChamp($cl_numero);
                $livraisons = $this->model->getLivraisonsDuClient($cl_numero);
            } else { //Alors aucun magasin choisi
                $errors[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $errors[] = "Vous n'avez pas fourni de numero de client";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function rechercherLiAction() {
        $this->loadModel('Livraison');
        $champ = $_POST["champ"];
        $choix = $_POST["choix"];
        $ordre = $_POST["ordre"];
        $livraisons = $this->model->getLivraisonRecherche($champ,$choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
    }

}