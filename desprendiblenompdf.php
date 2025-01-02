<?php

// header('Content-type:application/xls');
// header('Content-Disposition: attachment; filename='.$nombre.'.xls');
require("login_autentica.php");
include("cabezote3.php"); 


// error_reporting(0);

	// $fechaactual=$_REQUEST["param1"];
	// $fechafinal=$_REQUEST["param2"];
	// $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
// $FB->titulo_azul1("Estado de la GUIA: $estadoguia  ",10,0, 5); 

$FB->titulo_azul1("DESPRENDIBLE DE NÓMINA",10,0, 5); 



require_once 'dompdf/autoload.inc.php';
use DompdfDompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();
// Le pasamos el html a dompdf
$dompdf->loadHtml('hello world');
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream();




?>

<html>
<head>
<meta charset='utf-8'>
<style>body{font-size: 16px;color: black;}</style>
<title>Title</title>
</head>
<body>
<h2>Hello</h2>
<img src="logo.png"></img>
</body>
</html>