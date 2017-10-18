<?php
	class PdfController extends Controller {

	    public function indexAction() {
	        $this->loadModel('Commande');
	        $commandes = $this->model->getAllCommandes();
	        require(RACINE. 'fpdf.php');
			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(40,10,'Hello World !');
			$pdf->Output();
	    }
	}
