<?php
	class PdfController extends Controller {

	    public function indexAction() {
	        $this->loadModel('Commande');
	        $commande = $this->model->getCommandeRecherche($_GET["co_numero"],'CO_NUMERO','asc');
	        $articles = $this->model->getArticles($_GET["co_numero"]);

	        $this->loadModel('Client');
	        $client = $this->model->getClient($commande[0]['CL_NUMERO']);

	        $this->loadModel('Magasin');
	        $magasin = $this->model->getMagasin($commande[0]['MA_NUMERO']);
	                
	        
	        $date = strtotime($commande[0]['CO_DATE']);
	        $date = date('d-m-Y',$date);
        	require APP . 'view/pdf/index.php';
	    }
	}
