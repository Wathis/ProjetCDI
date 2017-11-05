<?php

class CommandeController extends Controller {

    //Action de l'index
    public function indexAction() {
        $this->loadModel('Commande');
        $form = new Form();
        $commandesSansLivraisons = $this->model->getCommandeSansLivraisons();
        $commandes = $this->model->getAllCommandes();
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/index.php';
        require APP . 'view/_templates/footer.php';
    }


    //Créer une commande 
    public function ajouterAction() {
        //On charche tous les clients
        $this->loadModel('Client');
        $clients = $this->model->getAllClients();

        //On charche tous les magasins pour le select
        $this->loadModel('Magasin');
        $magasins = $this->model->getAllMagasins();

        //On charche tous les articles pour le select
        $this->loadModel('Article');
        $articles = $this->model->getAllArticles();

        $form = new Form();

        //L'utilisateur a appuyé sur "ajouter"
        if (isset($_POST["submit"])) {
            $errors = array();
            $articlesPost = array();
            $co_date = date("Y-m-d H:i:s");
            //On extrait les articles
            //On extrait aussi les quantités correspondants aux articles
            for ($i = 1; isset($_POST['article' . $i]) && isset($_POST['quantity' . $i]) && isset($_POST['reduction' . $i]);$i++) {
                if (isset($_POST['reduction' . $i])) {
                    $reduction = $_POST['reduction' . $i] == "" ? 0 : $_POST['reduction' . $i];
                    if (!preg_match("#^[0-9]+$#", $reduction)) {
                        $errors[] = "Erreur dans la reduction";
                    } else {
                        $reduction = (int) $reduction;
                        if ($reduction > 100 || $reduction < 0) {
                            $errors[] = "La reduction ne peut pas être superieure à 100% ou inferieure à 0%";
                        } else {
                            if (isset($_POST['quantity' . $i])){
                                $article_id = $_POST['article' . $i];
                                $quantity = $_POST['quantity' . $i];
                                if ($this->model->stockEstNull($article_id)) {
                                    $informations[] = "Le stock n'est pas géré pour cet article";
                                }
                                if ($this->model->estEnStock($article_id,$quantity) || $this->model->stockEstNull($article_id)) {
                                    $articlesPost[$article_id] = array(
                                        "LIC_QTCMDEE" => $quantity,
                                        "REDUCTION" => $reduction
                                    );
                                } else {
                                    $errors[] = "Rupture de stock pour l'article : $article_id ";
                                }
                            } else {
                                $errors[] = "Quantité non présente";
                            }
                        }  
                    }
                }
            }

            if (isset($_POST['CL_NUMERO'])){
                $cl_numero = $_POST['CL_NUMERO'];   
            } else {
                $errors[] = "Vous n'avez pas sélectionné de client";
            }

            if (isset($_POST['MA_NUMERO'])){
                $ma_numero = $_POST['MA_NUMERO'];   
            } else {
                $errors[] = "Vous n'avez pas sélectionné de magasin";
            }

            //Donc toutes les données sont récupérées, on peut inserer la commande
            if (count($errors) == 0) {
                //Insertion de la commande
                $this->loadModel('Commande');
                $co_numero_ajouté = $this->model->nouvelleCommande($co_date,$ma_numero,$cl_numero, $articlesPost);
                $success = "Commande passée";
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/ajouter.php';
        require APP . 'view/_templates/footer.php';
    }

    public function trieCoAction() {
        $this->loadModel('Commande');
        $choix = $_POST["tris"];
        $ordre = $_POST["ordre1"];
        $commandesSansLivraisons = $this->model->getCommandeSansLivraisons();
        $commandes = $this->model->getCommandeOrder($choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * Consulter les articles d'une commande dont le numero est passé en GET
    */
    public function consulterArticlesAction() {
        $this->loadModel('Commande');

        $form = new Form();
        if (isset($_GET)) {
            if (isset($_GET["co_numero"]) && !empty($_GET["co_numero"])){
                $co_numero = $_GET["co_numero"];
                $co_numero = $form->securiserChamp($co_numero);
                $articles = $this->model->getArticles($co_numero);
            } else { //Alors aucune commande choisie
                $errors[] = "Vous n'avez pas sélectionné une commande valide";
            }
        } else {
            $errors[] = "Vous n'avez pas sélectionné une commande valide";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/articles.php';
        require APP . 'view/_templates/footer.php';
    }

    //Consulter les commandes disponibles concernée par l'article passé en GET
    public function consulterAction() {
        $this->loadModel('Commande');
        $form = new Form();
        if (isset($_GET)) {
            //Faire un recherche sur un article donnée passer en $GET
            if (isset($_GET["ar_numero"]) && !empty($_GET["ar_numero"])){
                $ar_numero = $_GET["ar_numero"];
                $ar_numero = $form->securiserChamp($ar_numero);
                $commandes = $this->model->getCommandeArticle($ar_numero);
            } else { //Alors aucun magasin choisi
                $errors[] = "Vous n'avez pas fourni de numero d'article";
            }
        } else {
            //Sur tous les articles
            $commandes = $this->model->getAllCommandes();
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/consulter.php';
        require APP . 'view/_templates/footer.php';
    }

    // Consulter les commandes depuis un client 
    // Permet de voir les commandes en cours ou terminées 
    public function consulterDepuisClientAction() {
        $this->loadModel('Commande');
        $commandesSansLivraisons = $this->model->getCommandeSansLivraisons();
        $form = new Form();
        if (isset($_GET)) {
            //Faire un recherche sur un article donnée passer en $GET
            if (isset($_GET["CL_NUMERO"]) && !empty($_GET["CL_NUMERO"])){
                $num = $_GET["CL_NUMERO"];
                $num = $form->securiserChamp($num);
                $commandes = $this->model->getCommandeClient($num);
            } else { //Alors aucun magasin choisi
                $errors[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $errors[] = "Vous n'avez pas fourni de numero de client";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function rechercherCoAction() {
        $this->loadModel('Commande');
        $commandesSansLivraisons = $this->model->getCommandeSansLivraisons();
        $champ = $_POST["champ"];
        $choix = $_POST["choix"];
        $ordre = $_POST["ordre"];
        $commandes = $this->model->getCommandeRecherche($champ,$choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/index.php';
        require APP . 'view/_templates/footer.php';
    }
}