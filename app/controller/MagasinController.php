<?php

class MagasinController extends Controller {

	//Vision d'un magasin
    public function indexAction()  {
        $this->loadModel('Magasin');
        $form = new Form();
        if (isset($_GET)) {
        	if (isset($_GET["ma_numero"]) && !empty($_GET["ma_numero"])){
        		$numMagasin = $_GET["ma_numero"];
        		$numMagasin = $form->securiserChamp($numMagasin);
        		$magasin = $this->model->getMagasin($numMagasin);
        	} else { //Alors aucun magasin choisi
        		$messages[] = "Vous n'avez pas fourni de numero de magasin";
        	}
        } else {
        	$messages[] = "Vous n'avez pas fourni de numero de magasin";
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/magasin/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
