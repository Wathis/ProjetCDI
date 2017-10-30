<?php

class MagasinController extends Controller {

    //Vision d'un magasin
    public function indexAction()  {
        $this->loadModel('Magasin');
        $magasins = $this->model->getAllMagasins();

        require APP . 'view/_templates/header.php';
        require APP . 'view/magasin/index.php';
        require APP . 'view/_templates/footer.php';
    }

     //Action du controlleur pour ajouter un nouveau magasin
    public function ajouterAction() {
        $form = new Form();
        $errors = array();

        if (isset($_POST["submit"])) {
            //on fait toutes les verifications pour ajouter un magasin
            if ($form->verifierLeNom($_POST["MA_NOM_GERANT"])){
                $nom = $form->transformerChampEnNom($_POST["MA_NOM_GERANT"]);
            } else {
                $errors[] = "Champ nom invalide";
            }
            if ($form->verifierLePrenom($_POST["MA_PRENOM_GERANT"])){
                $prenom = $form->transformerChampEnPrenom($_POST["MA_PRENOM_GERANT"]);
            } else {
                $errors[] = "Champ prenom invalide";
            }
            if (!empty($_POST["MA_LOCALITE"]) && isset($_POST["MA_LOCALITE"])){
                if ($form->verifierLaVille($_POST["MA_LOCALITE"])) {
                    $localite = $form->transformerChampEnVille($_POST["MA_LOCALITE"]);
                } else {
                    $errors[] = "Mauvais format de ville";
                }
            } else {
                $errors[] = "Vous devez entrer une ville";
            }
        
            //Si il y a pas de messages erreur, on peut inserer le client
            if (count($errors) == 0) {
                $this->loadModel('Magasin');
                $this->model->insererNouveauMagasin($nom,$prenom,$localite);
                $success = "Magasin ajouté";
            }

        }

        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/Magasin/ajouter.php';
        require APP . 'view/_templates/footer.php';
    }


    //Pour trier la recherche
    public function rechercherMagasinAction() {
        $this->loadModel('Magasin');
        $champ = $_POST["champ"];
        $choix = $_POST["choix"];
        $ordre = $_POST["ordre"];
        $magasins = $this->model->getMagasinRecherche($champ,$choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/magasin/index.php';
        require APP . 'view/_templates/footer.php';
    }

	//Vision d'un magasin
    public function consulterAction()  {
        $this->loadModel('Magasin');
        $form = new Form();
        if (isset($_GET)) {
        	if (isset($_GET["ma_numero"]) && !empty($_GET["ma_numero"])){
        		$numMagasin = $_GET["ma_numero"];
        		$numMagasin = $form->securiserChamp($numMagasin);
        		$magasin = $this->model->getMagasin($numMagasin);
        	} else { //Alors aucun magasin choisi
        		$errors[] = "Vous n'avez pas fourni de numero de magasin";
        	}
        } else {
        	$errors[] = "Vous n'avez pas fourni de numero de magasin";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/magasin/consulter.php';
        require APP . 'view/_templates/footer.php';
    }

}
