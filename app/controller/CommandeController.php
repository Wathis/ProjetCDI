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

    public function consulterDepuisArticleAction() {
        $this->loadModel('Commande');
        $form = new Form();
        if (isset($_GET)) {
            //Faire un recherche sur un article donnée passer en $GET
            if (isset($_GET["ar_numero"]) && !empty($_GET["ar_numero"])){
                $num = $_GET["ar_numero"];
                $num = $form->securiserChamp($num);
                $commandes = $this->model->getCommande($num);
            } else { //Alors aucun magasin choisi
                $messages[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            //Sur tous les articles
            $commandes = $this->model->getAllCommandes();
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/commande/index.php';
        require APP . 'view/_templates/footer.php';
    }
}