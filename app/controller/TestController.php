<?php

class TestController extends Controller {

    public function indexAction()  {
        $form = new Form();
        $test =  $form->faireUnTest();
        require APP . 'view/_templates/header.php';
        require APP . 'view/test/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
