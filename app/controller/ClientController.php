<?php

class ClientController extends Controller {

    //Action de l'index
	public function indexAction() {
		$this->loadModel('Client');
        $clientAvecRetard = $this->model->getClientRetards();
		$clients = $this->model->getAllClients();
		require APP . 'view/_templates/header.php';
        require APP . 'view/client/index.php';
        require APP . 'view/_templates/footer.php';
	}

	//Action correspondant à l'ajout d'un nouveau client
	public function ajouterAction() {
		$this->loadModel('Pays');
        $messages = array();
		$informations = ["CL_NOM","CL_PRENOM","CL_LOCALITE","CL_CA"];
		$informationsObligatoires = ["CL_NOM","CL_PRENOM","CL_LOCALITE"];
		//On charge les pays pour la vue
		$pays = $this->model->getAllPays();
		$form = new Form();
		if (isset($_POST["submit"])) {
			if (Form::champsSontRemplisPost($informationsObligatoires)) {
			        //Faire les verifications avant d'ajouter le client
                    $client = $form->extraireClientDuPost();
                    if ($form->verifierLeNom($client["CL_NOM"])){
                        $client["CL_NOM"] = $form->transformerChampEnNom($client["CL_NOM"]);
                    } else {
                        $messages[] = "Champ nom invalide";
                    }
                    if ($form->verifierLePrenom($client["CL_PRENOM"])){
                        $client["CL_PRENOM"] = $form->transformerChampEnPrenom($client["CL_PRENOM"]);
                    } else {
                        $messages[] = "Champ prenom invalide";
                    }
                    if (!empty($client["CL_LOCALITE"]) && isset($client["CL_LOCALITE"])){
                        if ($form->verifierLaVille($client["CL_LOCALITE"])) {
                            $client["CL_LOCALITE"] = $form->transformerChampEnVille($client["CL_LOCALITE"]);
                        } else {
                            $messages[] = "Mauvais format de ville";
                        }
                    } else {
                        $messages[] = "Vous devez entrer une ville";
                    }
                    if (!empty($client["CL_CA"]) && $client["CL_TYPE"] === "Particulier") {
                        $messages[] = "Un particulier ne peut avoir de chiffre d'affaire";
                    }
                    if (!preg_match('/^[0-9]+$/', $client["CL_CA"])) {
                         $client["CL_CA"] = null;
                    }
                    // //On securise les champs avant l'insertion en base de donnée
                    // $client = $form->securiserLesChamps($client);
                    //Si il y a aucune erreur, on peut ajouter le client
                    if (empty($messages)) {
                        //on charge le modele client pour acceder aux connexions avec la base de donnée
                        $this->loadModel('Client');
                        $this->model->ajouterUnClient($client);
                        $messages[] = "Client ajouté";
                        // echo "CL_NOM : ",$client["CL_NOM"],"<br \>";
                        // echo "CL_PRENOM : ",$client["CL_PRENOM"],"<br \>";
                        // echo "CL_LOCALITE : ",$client["CL_LOCALITE"],"<br \>";
                    }
			} else {
                $messages[] = "Veuillez remplir tous les champs obligatoires (*)";
			}
		}

		// Charge les informations du client depuis le tableau $_POST
		$client = $form->chargerValeursFormulairePost($informations);

		require APP . 'view/_templates/header.php';
        require APP . 'view/client/ajouter.php';
        require APP . 'view/_templates/footer.php';
	}

	//Action permettant de consulter les informations sur un client 
	//dont l'id est passé en GET
	public function consulterAction() {

		$this->loadModel('Client');
        $form = new Form();
        if (isset($_GET)) {
        	if (isset($_GET["cl_numero"]) && !empty($_GET["cl_numero"])){
        		$num = $_GET["cl_numero"];
        		$num = $form->securiserChamp($num);
        		$client = $this->model->getClient($num);
                //Si client == false => Le client n'existe pas
                if ($client == false) {
                    $messages[] = "Ce client " . $num . " n'existe plus <br /> Regler problème => Impossible de supprimer un client si il a des commandes";
                }
        	} else { //Alors aucun client choisi
        		$messages[] = "Vous n'avez pas fourni de numero de client";
        	}
        } else {
        	$messages[] = "Vous n'avez pas fourni de numero de client";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/client/consulter.php';
        require APP . 'view/_templates/footer.php';

	}

	//Action permettant de rechercher un client en fonction de differents parametres
	public function rechercherCliAction() {
		$this->loadModel('Client');
		$champ = $_POST["champ"];
		$choix = $_POST["choix"];
		$ordre = $_POST["ordre"];
		$clients = $this->model->getClientsRecherche($champ,$choix,$ordre);
		require APP . 'view/_templates/header.php';
        require APP . 'view/client/index.php';
        require APP . 'view/_templates/footer.php';
	}
    public function trieCliAction() {
        $this->loadModel('Client');
        $choix = $_POST["tris"];
        $ordre = $_POST["ordre1"];
        $clients = $this->model->getClientOrder($choix,$ordre);
        require APP . 'view/_templates/header.php';
        require APP . 'view/client/index.php';
        require APP . 'view/_templates/footer.php';
        }

    //Action pour supprimer un client passé en get
	public function supprimerClientAction(){
		$num = $_GET["CL_NUMERO"];
		$this->loadModel('Client');
        $supprimé = $this->model->supprimerClient($num);
        if ($supprimé == false) {
            $messages[] = "Impossible de supprimer ce client, il détient des commandes";
            require APP . 'view/error/errorMessage.php';
        } else {
            header("Location:".URL."client/index");
        }
	}
	public function modifierClientAction(){
		$this->loadModel('Pays');
		$pays = $this->model->getAllPays();
		$informations = ["CL_NOM","CL_PRENOM","CL_LOCALITE","CL_CA"];
		$informationsObligatoires = ["CL_NOM","CL_PRENOM","CL_LOCALITE"];
		$form = new Form();

		$this->loadModel('Client');
		$num = $_GET["CL_NUMERO"];
		$client = $this->model->getClient($num);

		if (isset($_POST["submit"])) {
			if (Form::champsSontRemplisPost($informationsObligatoires)) {
                $client = $form->extraireClientDuPost();
       
 				if ($form->verifierLeNom($client["CL_NOM"])){
                    $client["CL_NOM"] = $form->transformerChampEnNom($client["CL_NOM"]);
                } else {
                    $messages[] = "Champ nom invalide";
                }
                if ($form->verifierLePrenom($client["CL_PRENOM"])){
                    $client["CL_PRENOM"] = $form->transformerChampEnPrenom($client["CL_PRENOM"]);
                } else {
                    $messages[] = "Champ prenom invalide";
                }
                if (empty($client["CL_LOCALITE"]) || !isset($client["CL_LOCALITE"])){
                    $messages[] = "Vous devez entrer une ville";
                }
                if (!empty($client["CL_CA"]) && $client["CL_TYPE"] === "Particulier") {
                    $messages[] = "Un particulier ne peut avoir de chiffre d'affaire";
                }
                if (!preg_match('/^[0-9]+$/', $client["CL_CA"])) {
                    $client["CL_CA"] = null;
                }
                // //On securise les champs avant l'insertion en base de donnée
                // $client = $form->securiserLesChamps($client);
                if (empty($messages))
                {
					$this->model->modifierClient($client,$num);
                    $messages[] = "Client modifié";
                }
			}

		}
		require APP . 'view/_templates/header.php';
        require APP . 'view/client/modifier.php';
        require APP . 'view/_templates/footer.php';
	}

}