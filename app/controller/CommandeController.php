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
}