<?php

class LivraisonController extends Controller {

    //Action de l'index
	public function indexAction() {
		$this->loadModel('Livraison');
		$livraisons = $this->model->getAllLivraisons();
        $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
        $errors = $this->chargerAlertesCommandesRetards($livraisons, $livraisonsEnRetardIds);
		require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
	}

    //Action pour choisir la commande avant de creer une livraison
    public function choisirCommandeAction() {

        $this->loadModel('Commande');
        $commandes = $this->model->getAllCommandesPourAjouter();
        $errors = array();

        if (isset($_POST["submit"])) {
            if (isset($_POST["CO_NUMERO"]) && !empty($_POST["CO_NUMERO"])){
                $co_numero = $_POST["CO_NUMERO"];
                $articles = $this->model->getArticles($co_numero);
                $amodif = 0;
                foreach ($articles as $val)
                    {
                        if ($val["LIC_QTCMDEE"]-$val["LIC_QTLIVREE"] != 0)
                            {
                                $amodif = 1;                                                
                    }
                }
                if($amodif == 0){
                    $errors[] = "La commande sélectionnée a déjà reçu toutes ses livraisons";
                }else{
                header("Location:".URL."livraison/ajouter?co_numero=" . $_POST["CO_NUMERO"]);
            }
            } else {
                $errors[] = "Vous devez choisir une commande";
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/choisir.php';
        require APP . 'view/_templates/footer.php';
    }


    //Creer une livraison 
    public function ajouterAction() {
        $errors = array();
        if (isset($_GET["co_numero"])) {
            $co_numero = $_GET["co_numero"];
        } else {
            $errors[] = "Aucune commande selectionné";
        }
        //On charge les articles de la commande
        $this->loadModel('Commande');
        $articles = $this->model->getArticlesAvecLivraisonsEnCours($co_numero);
        $dav_liv_commande = $this->model->getCommandeById($co_numero)["CO_DATE"];

        $this->loadModel('Livraison');
        if (isset($_POST["submit"])){
            $articlesLivres = array();
            $form = new Form();
            if (isset($_POST["CO_NUMERO"])){
                $co_numero = $_POST["CO_NUMERO"];
            }
            if (isset($_POST["DATE_LIV_PREVUE"])){
                if ($form->validerDate($_POST["DATE_LIV_PREVUE"])) {
                    $date_liv = $_POST["DATE_LIV_PREVUE"];
                    if ($date_liv < $dav_liv_commande){
                        $errors[] = "La date de livraison doit être superieur à la date de commande";
                    }
                } else {
                    $errors[] = "Date invalide";
                }
            } else {
                $errors[] = "Aucune date prévue spécifiée";
            }
            //On charge les numero des articles selectionnés
            foreach ($articles as $article) {
                if (isset($_POST[$article["AR_NUMERO"]])) {
                    if (isset($_POST["quantity" . $article["AR_NUMERO"]]) && !empty($_POST["quantity" . $article["AR_NUMERO"]])) {
                        $quantite = $_POST["quantity" . $article["AR_NUMERO"]];
                        $restant = $this->model->getNombreCommandéPourArticle($article["AR_NUMERO"], $co_numero);
                        if ( $quantite > 0 ){
                            if ($restant - $quantite >= 0) {
                                $articlesLivres[] = array (
                                    "AR_NUMERO" => $article["AR_NUMERO"],
                                    "QUANTITE" => $quantite
                                );
                            } else {
                                $errors[] = "Un article va être livré en trop";
                            }
                        } else {
                            $errors[] = "Vous ne pouvez pas ajouter une quantité négative";
                        }
                    } else {
                        $errors[] = "Un article n'a pas eu de quantité";
                    }
                }
            }
            if (count($errors) == 0){
                 //On insere une nouvelle commande                 
                $this->model->insererNouvelleLivraison($co_numero,$articlesLivres,$date_liv);
                $success = "Livraison ajoutée";
            }
        } 

        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/ajouter.php';
        require APP . 'view/_templates/footer.php';
    }

    //Action pour dire qu'une livraison est terminée
    public function livraisonTermineeAction() {
        $this->loadModel('Livraison');
        if (isset($_GET["li_numero"]) && !empty($_GET["li_numero"])){
            $LI_NUMERO = $_GET["li_numero"];
            $this->model->livraisonEffectuee($LI_NUMERO);
        }
        $livraisons = $this->model->getAllLivraisons();
        $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
        $errors = $this->chargerAlertesCommandesRetards($livraisons, $livraisonsEnRetardIds);
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
                $errors[] = "Vous n'avez pas fourni de numero de commande";
            }
        } else {
            $errors[] = "Vous n'avez pas fourni de numero de commande";
        }
        $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
        $errors = $this->chargerAlertesCommandesRetards($livraisons, $livraisonsEnRetardIds);
        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function trieLiAction() {
        $this->loadModel('Livraison');
        $choix = $_POST["tris"];
        $ordre = $_POST["ordre1"];
        $livraisons = $this->model->getLivraisonOrder($choix,$ordre);
         $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
        $errors = $this->chargerAlertesCommandesRetards($livraisons, $livraisonsEnRetardIds);
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
                $errors[] = "Vous n'avez pas fourni de numero de client";
            }
        } else {
            $errors[] = "Vous n'avez pas fourni de numero de client";
        }
        $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
        $errors = $this->chargerAlertesCommandesRetards($livraisons, $livraisonsEnRetardIds);
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
        $livraisonsEnRetardIds = $this->model->getLivraisonsEnRetard();
        $errors = $this->chargerAlertesCommandesRetards($livraisons, $livraisonsEnRetardIds);
        require APP . 'view/_templates/header.php';
        require APP . 'view/livraison/index.php';
        require APP . 'view/_templates/footer.php';
    }

    private function chargerAlertesCommandesRetards($livraisons, $livraisonsEnRetardIds) {
        foreach ($livraisons as $livraison) {
            if (in_array($livraison["LI_NUMERO"],$livraisonsEnRetardIds)){
                return array("Des livraisons sont en retard");
            }
        }
        return null;
    }

}