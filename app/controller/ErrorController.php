<?php


class ErrorController extends Controller
{
    public function indexAction()
    {
        //Import des vues
        require APP . 'view/_templates/header.php';
        require APP . 'view/error/index.php';
        require APP . 'view/_templates/footer.php';
    }
}