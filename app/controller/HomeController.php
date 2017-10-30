<?php

class HomeController extends Controller {

    public function indexAction()  {
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
