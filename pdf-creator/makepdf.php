<?php

require('tfpdf/tfpdf.php');
$pdf = new tFPDF;


$pdf->AddFont('ShipporiMincho','','ShipporiMincho-Regular.ttf',true);
$names = htmlentities($_GET['names'], ENT_QUOTES, "utf-8");
$names = explode("\r\n", $names);

foreach ($names as $name) {
 	// ループする処理
  $pdf->SetFont('ShipporiMincho','',20);
  $pdf->AddPage();
  $pdf->Cell(0,10,"たし算練習プリント");
  $pdf->Ln(5);
  $pdf->Cell(100);
  $pdf->Cell(90,10,"名前 : $name","B");

  $pdf->Ln(40);

  make_contents();
}

$pdf->Output();

function make_contents(){
  global $pdf;

  $contents = htmlentities($_GET['contents'], ENT_QUOTES, "utf-8");
 	$contents = explode("\r\n", $contents);
 	$count = 0;
  $Y = $pdf->getY();

  foreach ($contents as $content) {
 		$count++;
 		if($count == 10){
 			$pdf->setY($Y);
 		}
 		if($count >= 10){
 			$pdf->setX(110);
 		}
 		$pdf->SetFont('ShipporiMincho','',25);
 		$pdf->Cell(20,10,"({$count})");
 		$pdf->SetFont('ShipporiMincho','',30);
 		$pdf->Cell(80,10,$content);
 		$pdf->Ln(25);
 	}
}
