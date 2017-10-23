<?php

class LivraisonController extends Controller {

    //Action de l'index
	public function indexAction() {
		$this->loadModel('Livraison');
		$livraisons = $this->model->getAllLivraisons();
		require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
	}

    //Action pour afficher les livraisons d'une commande
    public function commandesAction() {
        $this->loadModel('Livraison');
        $form = new Form();
        if (isset($_GET)) {
            if (isset($_GET["co_numero"]) && !empty($_GET["co_numero"])){
                $co_numero = $_GET["co_numero"];
                $co_numero = $form->securiserChamp($co_numero);
                $livraisons = $this->model->getLivraisonsCommande($co_numero);
            } else { //Alors aucun magasin choisi
                $messages[] = "Vous n'avez pas fourni de numero de commande";
            }
        } else {
            $messages[] = "Vous n'avez pas fourni de numero de commande";
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
        $form = new Form();
        if (isset($_GET)) {
            if (isset($_GET["cl_numero"]) && !empty($_GET["cl_numero"])){
                $cl_numero = $_GET["cl_numero"];
                $cl_numero = $form->securiserChamp($cl_numero);
                $livraisons = $this->model->getLivraisonsDuClient($cl_numero);
            } else { //Alors aucun magasin choisi
                $messages[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $messages[] = "Vous n'avez pas fourni de numero de client";
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