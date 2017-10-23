<?php
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(60);
	$pdf->Cell(90,40,'Etat de la commande : ' . $commande[0]['CO_NUMERO'],0,1,1);

	$pdf->Rect(5, 40, $pdf->GetPageWidth()-10,  2);
	$pdf->SetFont('Arial','',13);

	$pdf->Cell(80,15,'Numero du client : ' . $commande[0]['CL_NUMERO'],0,0,'L');
	$pdf->Cell(0,20,'Date de commande : ' . $date,0,1,'R');
	$pdf->Cell(0,10,'Nom du client : ' . $client['CL_NOM'] . '  ' . $client['CL_PRENOM'],0,1,'L');

	$pdf->Rect(5, 90, $pdf->GetPageWidth()-10,  2);

	$pdf->Cell(0,50,'Numero du magasin : ' . $commande[0]['MA_NUMERO'],0,0,'L');
	$pdf->Cell(0,55,'Ville du magasin : ' . $magasin["MA_LOCALITE"],0,1,'R');
	$pdf->Cell(0,-25,'Gerant du magasin : ' . $magasin['MA_GERANT'] ,0,1,'L');

	$pdf->Rect(5, 135, $pdf->GetPageWidth()-10,  2);
	$pdf->Cell(0,40,'',0,1,'L');

	foreach ($articles as $val)
	{
		$pdf->Cell(60,5,'Numero article : ' . $val["AR_NUMERO"],0,0,'L');						
		$pdf->Cell(70,5,'Nom article : ' . $val["AR_NOM"],0,0,'L');						
		$pdf->Cell(0,5,'Quantite : ' . $val["LIC_QTLIVREE"],0,1,'L');						
	}
	$pdf->Output();
?>