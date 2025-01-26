<?php
// include class

// require("login_autentica.php");
// include("cabezote3.php"); 
$nombre=$_GET["variable1"];
$cedula=$_GET["variable2"];
$fechacon=$_GET["variable3"];
$cargo=$_GET["variable4"];
$fechacerti=$_GET["variable5"];
$formato=$_GET["variable6"];
$fechini=$_GET["fechini"];
$fechfin=$_GET["fechfin"];
$asc="ASC";


$fechadelregi = strtotime($fechacon);
$fechacertificado = strtotime($fechacerti);

            

            $fechadelregidia = date("d",$fechadelregi);

// error_reporting(0);
require('fpdf/fpdf.php');

// create document
// $pdf = new FPDF();
// $pdf->AddPage();

// // add text


// $pdf->Image('assets/encabezadocert.png', null, null, 180);
// $pdf->SetFont('Times', '', 12);
// $pdf->Cell(0, 10, 'BERMUDAS S.A.S.', 0, 1);
// $pdf->Cell(0, 10, 'Nit 901.169.262-8', 0, 1);



// $pdf->MultiCell(0, 7, utf8_decode('CERTIFICA'), 0, 1);


// $pdf->Ln();
// $pdf->Ln();

// $formatofin=$formato;

// if ($formatofin==1){
// 	    $pdf->MultiCell(0, 7, utf8_decode('Que '.$nombre.', identificada con la cédula de ciudadanía N.º '.$cedula.' de Bogotá, laboró en nuestra empresa desde el '.date("d",$fechadelregi).' de '.date("m",$fechadelregi).' del '.date("Y",$fechadelregi).' con un CONTRATO A TERMINO INDEFINIDO, desempeñando el cargo de '.$cargo.'.'), 0, 1);
// }else if($formatofin==2){

// $pdf->MultiCell(0, 7, utf8_decode('Que '.$nombre.', identificada con la cédula de ciudadanía N.º '.$cedula.' de Bogotá, laboró en nuestra empresa desde el '.date("d",$fechadelregi).' de '.date("m",$fechadelregi).' del '.date("Y",$fechadelregi).'  y hasta el __ de ____ de __; con un CONTRATO A TERMINO INDEFINIDO, desempeñando el cargo de '.$cargo.'.'), 0, 1);

// }
// $pdf->Ln();

// $pdf->MultiCell(0, 7, utf8_decode('La presente se expide en la ciudad de Bogotá D.C, a los  ( '.date("d",$fechacertificado).') días del mes '.date("m",$fechacertificado).' del año  ('.date("Y",$fechacertificado).'), con destino al (la) INTERESADO(A).'), 0, 1);
// $pdf->Ln();

// $pdf->Cell(0, 10, 'Cordialmente,', 0, 1);
// $pdf->Ln();
// $pdf->Ln();


// $pdf->Cell(0, 10, '______________________________ ', 0, 1);
// $pdf->Cell(0, 10, 'MARINA CASTIBLANCO', 0, 1);
// $pdf->Cell(0, 10, 'GERENTE ADMINISTRATIVA', 0, 1);
// $pdf->Cell(0, 10, 'BERMUDAS S.A.S.', 0, 1);

// // output file
// $pdf->Output('', 'basic.pdf');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('assets/cabecerapagina.jpg',10,8,0);
    // Times bold 15
    $this->SetFont('Times','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    // $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20);

   
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Times italic 8
    $this->SetFont('Times','I',8);
    $this->Image('assets/piedepaginaberm.jpg',0,260,0);
    // Número de página
    // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);


$pdf->SetFont('Times', '', 12);
$pdf->SetLeftMargin(25);
$pdf->SetRightMargin(25);
$pdf->Ln(30);
// $pdf->Cell(0, 10, 'BERMUDAS S.A.S.', 0, 1,'C');
// $pdf->Cell(0, 10, 'Nit 901.169.262-8', 0, 1,'C');


$pdf->Ln(20);
// $pdf->MultiCell(0, 7, utf8_decode('CERTIFICA'), 0,'C');


$pdf->Ln(7);

$formatofin=$formato;

// if ($formatofin==1){
// 	    $pdf->MultiCell(0, 6, utf8_decode('Que '.$nombre.', identificada con la cédula de ciudadanía N.º '.$cedula.' de Bogotá, laboró en nuestra empresa desde el '.date("d",$fechadelregi).' de '.date("m",$fechadelregi).' del '.date("Y",$fechadelregi).' con un CONTRATO A TERMINO INDEFINIDO, desempeñando el cargo de '.$cargo.'.'), 0,'J');
// }else if($formatofin==2){

// $pdf->MultiCell(0, 6, utf8_decode('Que '.$nombre.', identificada con la cédula de ciudadanía N.º '.$cedula.' de Bogotá, laboró en nuestra empresa desde el '.date("d",$fechadelregi).' de '.date("m",$fechadelregi).' del '.date("Y",$fechadelregi).'  y hasta el __ de ____ de __; con un CONTRATO A TERMINO INDEFINIDO, desempeñando el cargo de '.$cargo.'.'), 0,'J');

// }
// $pdf->Ln(10);

// $pdf->MultiCell(0, 6, utf8_decode('La presente se expide en la ciudad de Bogotá D.C, a los  ( '.date("d",$fechacertificado).') días del mes '.date("m",$fechacertificado).' del año  ('.date("Y",$fechacertificado).'), con destino al (la) INTERESADO(A).'), 0,'J');
// $pdf->Ln(20);

$pdf->Cell(20, 6, ' '.date("d",$fechacertificado).' ', 1, 0);
$pdf->Cell(20, 6, ''.date("m",$fechacertificado).'', 1, 0);
$pdf->Cell(20, 6, ''.date("Y",$fechacertificado).'', 1, 2);
$pdf->Ln(2);
$pdf->Cell(0, 6, 'INFORMACION DEL FUNCIONARIO', 1, 1,'C');
$pdf->Ln(2);
$pdf->Cell(80.3, 6, 'Nombre ', 1, 0);
$pdf->Cell(80, 6, ''.$nombre.'', 1, 2);
$pdf->Ln(2);
$pdf->Cell(80.3, 6, 'Cargo ', 1, 0);
$pdf->Cell(80, 6, ''.$cargo.'', 1, 2);
$pdf->Ln(2);
$pdf->Cell(80.3, 6, 'C.C ', 1, 0);
$pdf->Cell(80, 6, ''.$cedula.'', 1, 2);
$pdf->Ln(2);
$pdf->Cell(80, 6, 'Sede', 1, 0);
$pdf->Cell(80, 6, '', 1, 2);

$pdf->Ln(2);
$pdf->Cell(80, 6, 'Tipo de permiso', 1, 0);
$pdf->Cell(80, 6, ''.$formato.'', 1, 2);

$pdf->Ln(2);

$pdf->Cell(80, 6, 'Presenta soporte', 1, 0);
$pdf->Cell(80, 6, '', 1, 2);
$pdf->Ln(2);
$pdf->Cell(80, 6, 'Dias solicitados', 1, 0);
$pdf->Cell(80, 6, '', 1, 2);
$pdf->Ln(2);
$pdf->Cell(40, 6, 'Desde', 1, 0);
$pdf->Cell(40, 6, ''.$fechini.'', 1, 0);


$pdf->Cell(40, 6, 'Hasta', 1, 0);
$pdf->Cell(40, 6, ''.$fechfin.'', 1, 2);


$pdf->Ln(2);

$pdf->Cell(80, 6, 'Aprobado gerencia', 1, 0);
$pdf->Cell(80, 6, 'Aprobado jefe inmediato', 1, 2);

$pdf->Ln(2);

$pdf->Cell(80, 6, '', 1, 0);
$pdf->Cell(80, 6, '', 1, 2);

$pdf->Ln(2);

$pdf->Cell(80, 6, 'Remunerado', 1, 0);
$pdf->Cell(80, 6, 'No remunerado', 1, 2);

$pdf->Ln(2);

$pdf->Cell(80, 6, '', 1, 0);
$pdf->Cell(80, 6, '', 1, 2);
// $pdf->SetFont('Times', 'I', 12);
// $pdf->Cell(40, 6, 'Marina Castiblanco', 'B', 1);

// // $pdf->Cell(0, 6, '______________________________ ', 0, 1);
// $pdf->Cell(0, 6, 'MARINA CASTIBLANCO', 0, 1);

// $pdf->Cell(0, 6, 'Gerente administrativa', 0, 1);


$pdf->Ln(10);
// $pdf->MultiCell(0, 6, 'Puede certificarla veracidad de este certificado en los correos: castiblanco@bermudas.com.co y/o recursosh@bermudas.com.co 
// ', 0,'C');

$pdf->Output();
?>