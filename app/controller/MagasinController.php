<?php

class MagasinController extends Controller {

    public function indexAction()  {
        //Import des vues
        if (isset($_GET)) {

        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/magasin/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
