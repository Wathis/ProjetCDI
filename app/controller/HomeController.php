<?php

class HomeController extends Controller {

    public function indexAction()  {
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function page1Action() {
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/page1.php';
        require APP . 'view/_templates/footer.php';
    }

    public function page2Action() {
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/page2.php';
        require APP . 'view/_templates/footer.php';
    }
}
