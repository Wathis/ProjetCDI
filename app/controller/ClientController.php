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

		$erreurs = array();
		$informations = ["nom","prenom","ville"];

		if (isset($_POST["submit"])) {
			if (Form::champsSontRemplisPost($informations)) {
				if (($erreurRegex = Form::verifierSaisieNouveauClient($informations)) == ""){
					$erreurs[] = "Client ajouté";
				}
				else
				{
					$erreurs[] =$erreurRegex;
				}
			} else {
				$erreurs[] = "Veuillez remplir tous les champs obligatoires (*)";
			}
		}

		$client = Form::chargerValeursFormulairePost($informations);

		require APP . 'view/_templates/header.php';
        require APP . 'view/client/ajouter.php';
        require APP . 'view/_templates/footer.php';
	}


}