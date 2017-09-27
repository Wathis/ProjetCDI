<?php

class ClientController extends Controller {
	
	public function indexAction() {
		$this->loadModel('Client');
		$clients = $this->model->getAllClients();
		require APP . 'view/_templates/header.php';
        require APP . 'view/client/index.php';
        require APP . 'view/_templates/footer.php';
	}
	
	public function ajouterAction() {

		$informations = ["nom","prenom","ville"];
		if (isset($_POST["submit"])) {
			if (Form::champsSontRemplisPost($informations)) {
				$erreur = "Client ajouté";

			} else {
				$erreur = "Veuillez remplir tous les champs obligatoires (*)";
			}
		}

		$client = Form::chargerValeursFormulairePost($informations);

		require APP . 'view/_templates/header.php';
        require APP . 'view/client/ajouter.php';
        require APP . 'view/_templates/footer.php';
	}
	public function rechercherAction() {
		$this->loadModel('Client');
		$clients = $this->model->getClientsrecherche();
		$champ = $_POST["champ"];
		require APP . 'view/_templates/header.php';
        require APP . 'view/client/index.php';
        require APP . 'view/_templates/footer.php';
	}


}