<?php

class TestController extends Controller {

    public function indexAction()  {
    	require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/footer.php';
    }
}
