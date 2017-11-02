<?php

class FournisseurController extends Controller
{
    public function indexAction()
    {
    	$this->loadModel('Fournisseur');
    	$fournisseurs = $this->model->getAllFournisseurs();
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/fournisseur/index.php';
        require APP . 'view/_templates/footer.php';
    }

    //Action du controlleur pour ajouter un nouveau fournisseur
    public function ajouterAction() {
        $form = new Form();
        $errors = array();
        if (isset($_POST["submit"])) {
            if (isset($_POST["FO_NOM"]) && !empty($_POST["FO_NOM"])) {
                if ($form->verifierLeNom($_POST["FO_NOM"])) {
                    $nomFournisseur = $form->transformerChampEnNom($_POST["FO_NOM"]);
                    $this->loadModel('Fournisseur');
                    $this->model->ajouterFournisseur($nomFournisseur);
                    $success = "Fournisseur ajouté";
                } else {
                    $errors[] = "Le champ nom est mal formaté";
                }
            } else {
                $errors[] = "Le champ nom est obligatoire";
            }
        }

        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/fournisseur/ajouter.php';
        require APP . 'view/_templates/footer.php';
    }

    public function rechercherFournisseurAction() {
		$this->loadModel('Fournisseur');
		$champ = $_POST["champ"];
		$choix = $_POST["choix"];
        $ordre = $_POST["ordre"];
		$fournisseurs = $this->model->getFournisseurRecherche($champ,$choix,$ordre);
		require APP . 'view/_templates/header.php';
        require APP . 'view/fournisseur/index.php';
        require APP . 'view/_templates/footer.php';
	}
    public function trieFoAction() {
        $this->loadModel('Fournisseur');
        $choix = $_POST["tris"];
        $ordre = $_POST["ordre1"];
        $fournisseurs = $this->model->getFournisseurOrder($choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/fournisseur/index.php';
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
                $errors[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $errors[] = "Vous n'avez pas fourni de numero de client";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/fournisseur/consulter.php';
        require APP . 'view/_templates/footer.php';

    }
    public function rechercherFoAction() {
        $this->loadModel('Fournisseur');
        $champ = $_POST["champ"];
        $choix = $_POST["choix"];
        $ordre = $_POST["ordre"];
        $fournisseurs = $this->model->getFournisseurRecherche($champ,$choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/fournisseur/index.php';
        require APP . 'view/_templates/footer.php';
    }
}