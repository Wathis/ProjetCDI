<?php

class CommandeController extends Controller {

    //Action de l'index
    public function indexAction() {
        $this->loadModel('Commande');
        $commandes = $this->model->getAllCommandes();
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

}