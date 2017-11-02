<?php

class ParametreController extends Controller {

    //Vision d'un magasin
    public function indexAction()  {
        require APP . 'view/_templates/header.php';
        require APP . 'view/parametre/index.php';
        require APP . 'view/_templates/footer.php';
    }

    //Supprimer toutes les données des tables
    public function resetAllAction() {
    	$this->loadModel("Parametre");
    	$this->model->resetAllTables();
    	// header("Location:".URL."parametre");
    }
}
