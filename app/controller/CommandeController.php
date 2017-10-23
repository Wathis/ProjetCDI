<?php

class CommandeController extends Controller {

    //Action de l'index
    public function indexAction() {
        $this->loadModel('Commande');
        $form = new Form();
        $commandes = $this->model->getAllCommandes();
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/index.php';
        require APP . 'view/_templates/footer.php';


    }
    public function trieCoAction() {
        $this->loadModel('Commande');
        $choix = $_POST["tris"];
        $ordre = $_POST["ordre1"];
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
                $messages[] = "Vous n'avez pas sélectionné une commande valide";
            }
        } else {
            $messages[] = "Vous n'avez pas sélectionné une commande valide";
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
                $messages[] = "Vous n'avez pas fourni de numero d'article";
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
        $form = new Form();
        if (isset($_GET)) {
            //Faire un recherche sur un article donnée passer en $GET
            if (isset($_GET["CL_NUMERO"]) && !empty($_GET["CL_NUMERO"])){
                $num = $_GET["CL_NUMERO"];
                $num = $form->securiserChamp($num);
                $commandes = $this->model->getCommandeClient($num);
            } else { //Alors aucun magasin choisi
                $messages[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $messages[] = "Vous n'avez pas fourni de numero de client";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function rechercherCoAction() {
        $this->loadModel('Commande');
        $champ = $_POST["champ"];
        $choix = $_POST["choix"];
        $ordre = $_POST["ordre"];
        $commandes = $this->model->getCommandeRecherche($champ,$choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/index.php';
        require APP . 'view/_templates/footer.php';
    }
}