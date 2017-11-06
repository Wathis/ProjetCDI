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
        $success = "Toute la base a été supprimé";
        require APP . 'view/_templates/header.php';
        require APP . 'view/parametre/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function recreerLaBaseDeDonneeAction() {
        $this->loadModel("Parametre");
        $result = $this->model->recreerLaBaseDeDonnée();
        if ($result){
            $success = "La base a été recréée";
        } else {
            $errors[] = "Erreur de script, executez à la main : /utils/bdd.sql dans phpmyadmin";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/parametre/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function insertFournisseurAction() {
        $this->loadModel("Parametre");
        $this->model->insererFournisseurs();
        $success = "Les fournisseurs de base ont été ajouté";
        require APP . 'view/_templates/header.php';
        require APP . 'view/parametre/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function insertArticleAction() {
        $this->loadModel('Parametre');
        $this->model->insererArticles();
        $success = "Les articles de base ont été ajouté";
        require APP . 'view/_templates/header.php';
        require APP . 'view/parametre/index.php';
        require APP . 'view/_templates/footer.php';
    }

     public function insertMagasinAction() {
        $this->loadModel("Parametre");
        $this->model->insererMagasins();
        $success = "Les magasins de base ont été ajouté";
        require APP . 'view/_templates/header.php';
        require APP . 'view/parametre/index.php';
        require APP . 'view/_templates/footer.php';
    }

    //reset toute la base sauf la table article, client, 
    public function resetCommandeAction() {
        $this->loadModel("Parametre");
        $this->model->resetCommande();
        $success = "Livraison et commande ont été supprimé";
        require APP . 'view/_templates/header.php';
        require APP . 'view/parametre/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
