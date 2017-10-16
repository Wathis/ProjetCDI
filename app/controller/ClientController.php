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
		$informations = ["cl_nom","cl_prenom","cl_localite","cl_ca","emp_enume"];
		$informationsObligatoires = ["cl_nom","cl_prenom","cl_ville"];
		//On charge les pays pour la vue
		$pays = $this->model->getAllPays();
		$form = new Form();
		if (isset($_POST["submit"])) {
			if (Form::champsSontRemplisPost($informationsObligatoires)) {
			        //Faire les verifications avant d'ajouter le client
                    $client = $form->extraireClientDuPost();
                    if ($form->faireToutesLesVerifications($client["cl_nom"])){
                        $client["cl_nom"] = $form->transformerChampEnNom($client["cl_nom"]);
                    } else {
                        $messages[] = "Champ nom invalide";
                    }
                    if ($form->faireToutesLesVerifications($client["cl_prenom"])){
                        $client["cl_prenom"] = $form->transformerChampEnPrenom($client["cl_prenom"]);
                    } else {
                        $messages[] = "Champ prenom invalide";
                    }
                    if (empty($client["cl_localite"]) || !isset($client["cl_localite"])){
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
        	} else { //Alors aucun magasin choisi
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
	public function supprimerClientAction(){
		$num = $_GET["CL_NUMERO"];
		$this->loadModel('Client');
		$this->model->supprimerClient($num);
		header("Location:".URL."client/index");
	}
	public function modifierClientAction(){
		$this->loadModel('Pays');
		$pays = $this->model->getAllPays();
		$informations = ["CL_NOM","CL_PRENOM","CL_LOCALITE","CL_CA","EMP_ENUME"];
		$informationsObligatoires = ["CL_NOM","CL_PRENOM","CL_LOCALITE"];
		$form = new Form();

		$this->loadModel('Client');
		$num = $_GET["CL_NUMERO"];
		$client = $this->model->getClient($num);

		if (isset($_POST["submit"])) {
			if (Form::champsSontRemplisPost($informationsObligatoires)) {
                $client = $form->extraireClientDuPost();
       
 				if ($form->faireToutesLesVerifications($client["CL_NOM"])){
                    $client["CL_NOM"] = $form->transformerChampEnNom($client["CL_NOM"]);
                } else {
                    $messages[] = "Champ nom invalide";
                }
                if ($form->faireToutesLesVerifications($client["CL_PRENOM"])){
                    $client["CL_PRENOM"] = $form->transformerChampEnPrenom($client["CL_PRENOM"]);
                } else {
                    $messages[] = "Champ prenom invalide";
                }
                if (empty($client["CL_LOCALITE"]) || !isset($client["CL_LOCALITE"])){
                    $messages[] = "Vous devez entrer une ville";
                }
                    //On securise les champs avant l'insertion en base de donnée
                $client = $form->securiserLesChamps($client);
                if (empty($messages))
                {
					$this->model->modifierClient($client,$num);
                }
			}

		}
		require APP . 'view/_templates/header.php';
        require APP . 'view/client/modifier.php';
        require APP . 'view/_templates/footer.php';
	}

}