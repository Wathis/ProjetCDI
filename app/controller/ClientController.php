<?php

class ClientController extends Controller {

    //Action de l'index
	public function indexAction() {
		$this->loadModel('Client');
		$clients = $this->model->getAllClients();
		require APP . 'view/_templates/header.php';
        require APP . 'view/client/index.php';
        require APP . 'view/_templates/footer.php';
	}

	//Action correspondant à l'ajout d'un nouveau client
	public function ajouterAction() {
		$this->loadModel('Pays');
        $messages = array();
		$informations = ["nom","prenom","ville","ca","enume"];
		$informationsObligatoires = ["nom","prenom","ville"];
		//On charge les pays pour la vue
		$pays = $this->model->getAllPays();
		$form = new Form();
		if (isset($_POST["submit"])) {
			if (Form::champsSontRemplisPost($informationsObligatoires)) {
			        //Faire les verifications avant d'ajouter le client
                    $client = $form->extraireClientDuPost();
                    if ($form->faireToutesLesVerifications($client["nom"])){
                        $client["nom"] = $form->transformerChampEnNom($client["nom"]);
                    } else {
                        $messages[] = "Champ nom invalide";
                    }
                    if ($form->faireToutesLesVerifications($client["prenom"])){
                        $client["prenom"] = $form->transformerChampEnPrenom($client["prenom"]);
                    } else {
                        $messages[] = "Champ prenom invalide";
                    }
                    if (empty($client["ville"]) || !isset($client["ville"])){
                        $messages[] = "Vous devez entrer une ville";
                    }
                    //On securise les champs avant l'insertion en base de donnée
                    $client = $form->securiserLesChamps($client);
                    //Si il y a aucune erreur, on peut ajouter le client
                    if (empty($messages)) {
                        //on charge le modele client pour acceder aux connexions avec la base de donnée
                        $this->loadModel('Client');
                        $this->model->ajouterUnClient($client);
                        $messages[] = "Client ajouté";
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
	public function supprimerClientAction(){
		$num = $_GET["CL_NUMERO"];
		$this->loadModel('Client');
		$this->model->supprimerClient($num);
		header("Location:".URL."client/index");
	}
	public function modifierClientAction(){
		$this->loadModel('Client');
		$num = $_GET["CL_NUMERO"];
		$client = $this->model->getClient($num);

		$this->loadModel('Pays');
		$pays = $this->model->getAllPays();
		require APP . 'view/_templates/header.php';
        require APP . 'view/client/modifier.php';
        require APP . 'view/_templates/footer.php';
	}

}