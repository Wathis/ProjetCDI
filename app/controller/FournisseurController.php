<?php

class FournisseurController extends Controller
{
    public function indexAction()
    {
    	$this->loadModel('Fournisseur');
    	$fournisseurs = $this->model->getAllFournisseurs();
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/Fournisseur/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function rechercherFournisseurAction() {
		$this->loadModel('Fournisseur');
		$champ = $_POST["champ"];
		$choix = $_POST["choix"];
        $ordre = $_POST["ordre"];
		$fournisseurs = $this->model->getFournisseurRecherche($champ,$choix,$ordre);
		require APP . 'view/_templates/header.php';
        require APP . 'view/Fournisseur/index.php';
        require APP . 'view/_templates/footer.php';
	}
        public function consulterAction() {

        $this->loadModel('Fournisseur');
        $form = new Form();
        if (isset($_GET)) {
            if (isset($_GET["fo_numero"]) && !empty($_GET["fo_numero"])){
                $num = $_GET["fo_numero"];
                $num = $form->securiserChamp($num);
                $fournisseur = $this->model->getFournisseur($num);
            } else { //Alors aucun magasin choisi
                $messages[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $messages[] = "Vous n'avez pas fourni de numero de client";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/fournisseur/consulter.php';
        require APP . 'view/_templates/footer.php';

    }
}