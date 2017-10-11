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
}