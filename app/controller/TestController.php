<?php

class TestController extends Controller {

    public function indexAction()  {
    	require APP . 'view/_templates/header.php';
        $form = new Form();
        $nom = "éÉé-Ébé";
        if ($form->faireToutesLesVerifications($form->transformerChampEnNom($nom))) {
        	echo "validé";
        } else {
        	echo "non validé";
        }
        require APP . 'view/_templates/footer.php';
    }
}
