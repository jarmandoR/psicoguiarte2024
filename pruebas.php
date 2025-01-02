<?php
// include class
require('fpdf/fpdf.php');

// create document
$pdf = new FPDF();
$pdf->AddPage();

// add text


$pdf->Image('assets/encabezadocert.png', null, null, 180);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'BERMUDAS S.A.S.', 0, 1);
$pdf->Cell(0, 10, 'Nit 901.169.262-8', 0, 1);



$pdf->MultiCell(0, 7, utf8_decode('CERTIFICA'), 0, 1);


$pdf->Ln();
$pdf->Ln();

$pdf->MultiCell(0, 7, utf8_decode('Que la señora ________________________, identificada con la cédula de ciudadanía N.º 52.541.341 de Bogotá, laboró en nuestra empresa desde el __ de__ de __ y hasta el __ de ____ de __; con un CONTRATO A TERMINO INDEFINIDO, desempeñando el cargo de ______________________.'), 0, 1);
$pdf->Ln();

$pdf->MultiCell(0, 7, utf8_decode('La presente se expide en la ciudad de Bogotá D.C, a los  (___) días del mes de _____ del año  (_____), con destino al (la) INTERESADO(A).'), 0, 1);
$pdf->Ln();

$pdf->Cell(0, 10, 'Cordialmente,', 0, 1);
$pdf->Ln();
$pdf->Ln();


$pdf->Cell(0, 10, '______________________________ ', 0, 1);
$pdf->Cell(0, 10, 'MARINA CASTIBLANCO', 0, 1);
$pdf->Cell(0, 10, 'GERENTE ADMINISTRATIVA', 0, 1);
$pdf->Cell(0, 10, 'BERMUDAS S.A.S.', 0, 1);

// output file
$pdf->Output('', 'basic.pdf');