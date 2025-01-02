<!DOCTYPE html>
<html>

<head>
<script>
function enviar_formulario(){
   document. getElementById("param8").value='2';
   document.form1.submit()
}
</script>
</head>
<body>

 <?php 

 $fechaactual=date("Y-m-d");
 $nivel_acceso=$_SESSION['usuario_rol'];
 $id_sedes=$_SESSION['usu_idsede'];

 if($nivel_acceso==1){
	if($param35!=''){   $conde2=""; }  

}
else {	
	$param35=$id_sedes;
	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}

$sql1 = "SELECT  `fp_idhistoclinica`, `fp_Trastornos_neurologicosA`, `fp_Quien_la_padeceA`, `fp_Caracteristicas_relevantesA`, `fp_Discapacidad_fisicaB`, `fp_Quien_la_padeceB`, `fp_Caracteresticas_relevantesB`, `fp_Discapacidad_CognitivaC`, `fp_Quien_padeceC`, `fp_Caracteresticas_relevantesC`, `fp_Trastornos_mentalesD`, `fp_Quien_adeceD`, `fp_Caracteresticas_relevantesD`, `fp_Alteraciones_conductualesE`, `fp_Quien_padeceE`, `fp_Caracteristicas_relevantesE`, `fp_Consumo_alcoholF`, `fp_Quien_padeceF`, `fp_Caracteresticas_relevantesF`, `fp_Consumo_cigarrilloG`, `fp_Quien_padeceG`, `fp_Caracteresticas_relevantesG`, `fp_Consumo_SPAH`, `fp_Quien_padeceH`, `fp_Caracteresticas_relevantesH`, `fp_OtraJ`, `fp_CualJ`, `fp_Quien_padeceJ`, `fp_Caracteresticas_relevantesJ`, `fp_Convulsiones`, `fp_a_queEdadconvul`, `fp_Tratamiento_convul`, `fp_Caidas_golpes`, `fp_Edad_caidas_golp`, `fp_Tratamiento_caida_golp`, `fp_Cirugias`, `fp_Edad_cirujia`, `fp_Motivo_cirujia`, `fp_Otras_enfer`, `fp_valor_Terapia_ocup`, `fp_valor_Neuropsicologia`, `fp_valor_Psiquiatra`, `fp_valor_Fonoaudiologiara`, `fp_valor_Otra`, `fp_valor_Cual`, `fp_otra_Motivo`, `fp_otra_Tiempo`, `fp_Toma_medicamento`, `fp_medica_Cual`, `fp_medica_Por_que` FROM `AntecedentesFP` WHERE fp_idhistoclinica = '$idhojadevida'";


$DB->Execute($sql1);
$rw1 = mysqli_fetch_row($DB->Consulta_ID);


echo "</tr>";
$FB->titulo_azul1("V.	Antecedentes médicos y psiquiátricos familiares y personales",9,0,7);  
echo "</tr>";

$FB->llena_texto("Trastornos neurologicos:", 1, 5, $DB, $tipoexamen, "", "$rw1[1]", 1, 0);
$FB->llena_texto("Quien la padece:",2, 1, $DB, "", "", "$rw1[2]", 4, 0);
$FB->llena_texto("Caracteristicas relevantes:", 3, 1, $DB, "", "", "$rw1[3]", 4, 0);
$FB->llena_texto("Discapacidad fisica:", 4, 5, $DB, $tipoexamen, "", "$rw1[4]", 1, 0);
$FB->llena_texto("Quien la padece:",5, 1, $DB, "", "", "$rw1[5]", 4, 0);
$FB->llena_texto("Caracteresticas relevantes:", 6, 1, $DB, "", "", "$rw1[6]", 4, 0);
$FB->llena_texto("Discapacidad Cognitiva:", 7, 5, $DB, $tipoexamen, "", "$rw1[7]", 1, 0);
$FB->llena_texto("Quien la padece:",8, 1, $DB, "", "", "$rw1[8]", 4, 0);
$FB->llena_texto("Caracteresticas relevantes:", 9, 1, $DB, "", "", "$rw1[9]", 4, 0);
$FB->llena_texto("Trastornos mentales:", 10, 5, $DB, $tipoexamen, "", "$rw1[10]", 1, 0);
$FB->llena_texto("Quien la padece:",11, 1, $DB, "", "", "$rw1[11]", 4, 0);
$FB->llena_texto("Caracteresticas relevantes:", 12, 1, $DB, "", "", "$rw1[12]", 4, 0);
$FB->llena_texto("Alteraciones conductuales:", 13, 5, $DB, $tipoexamen, "", "$rw1[13]", 1, 0);
$FB->llena_texto("Quien la padece:",14, 1, $DB, "", "", "$rw1[14]", 4, 0);
$FB->llena_texto("Caracteristicas relevantes:", 15, 1, $DB, "", "", "$rw1[15]", 4, 0);
$FB->llena_texto("Consumo de alcohol:", 16, 5, $DB, $tipoexamen, "", "$rw1[16]", 1, 0);
$FB->llena_texto("Quien la padece:",17, 1, $DB, "", "", "$rw1[17]", 4, 0);
$FB->llena_texto("Caracteresticas relevantes:", 18, 1, $DB, "", "", "$rw1[18]", 4, 0);
$FB->llena_texto("Consumo de cigarrillo:", 19, 5, $DB, $tipoexamen, "", "$rw1[19]", 1, 0);
$FB->llena_texto("Quien la padece:",20, 1, $DB, "", "", "$rw1[20]", 4, 0);
$FB->llena_texto("Caracteresticas relevantes:",21, 1, $DB, "", "", "$rw1[21]", 4, 0);
$FB->llena_texto("Consumo de SPA:", 22, 5, $DB, $tipoexamen, "", "$rw1[22]", 1, 0);
$FB->llena_texto("Quien la padece:",23, 1, $DB, "", "", "$rw1[23]", 4, 0);
$FB->llena_texto("Caracteresticas relevantes:",24, 1, $DB, "", "", "$rw1[24]", 4, 0);
$FB->llena_texto("Otra:", 25, 5, $DB, $tipoexamen, "", "$rw1[25]", 1, 0);
$FB->llena_texto("Cual:",26, 1, $DB, "", "", "$rw1[26]", 4, 0);
$FB->llena_texto("Quien la padece:",27, 1, $DB, "", "", "$rw1[27]", 1, 0);
$FB->llena_texto("Caracteresticas relevantes:", 28, 1, $DB, "", "", "$rw1[28]", 4, 0);

$FB->titulo_azul1("Personales",9,0,7);  
$FB->llena_texto("Convulsiones: ", 29, 82, $DB, $estados, "", "$rw1[29]", 1, 0);
$FB->llena_texto("Edad:",30, 1, $DB, "", "", "$rw1[30]", 4, 0);
$FB->llena_texto("Tratamiento:", 31, 1, $DB, "", "", "$rw1[31]", 1, 0);
$FB->llena_texto("Caidas o golpes: ", 32, 82, $DB, $estados, "", "$rw1[32]", 1, 0);
$FB->llena_texto("Edad:",33, 1, $DB, "", "", "$rw1[33]", 4, 0);
$FB->llena_texto("Tratamiento:", 34, 1, $DB, "", "", "$rw1[34]", 1, 0);
$FB->llena_texto("Cirugias: ", 35, 82, $DB, $estados, "", "$rw1[35]", 1, 0);
$FB->llena_texto("Edad:",36, 1, $DB, "", "", "$rw1[36]", 4, 0);
$FB->llena_texto("Tratamiento:", 37, 1, $DB, "", "", "$rw1[37]", 1, 0);
$FB->llena_texto("Otras enfermedades:", 38, 1, $DB, "", "", "$rw1[38]", 4, 0);
$FB->llena_texto("Ha sido valorado por :", "", "", "", "", "", "$rw1[39]", 1, 0); //titulo
$FB->llena_texto("Terapia Ocupacional :", 39, 5, $DB, $tipoexamen, "", "$rw1[40]", 1, 0);
$FB->llena_texto("Neuropsicologia :", 40, 5, $DB, $tipoexamen, "", "$rw1[41]", 4, 0);
$FB->llena_texto("Psiquiatra :", 41, 5, $DB, $tipoexamen, "", "$rw1[42]", 1, 0);
$FB->llena_texto("Fonoaudiologia:", 42, 5, $DB, $tipoexamen, "", "$rw1[43]", 4, 0);
$FB->llena_texto("Otra:", 43, 5, $DB, $tipoexamen, "", "$rw1[44]", 1, 0);
$FB->llena_texto("Cual:",44, 1, $DB, "", "", "$rw1[45]", 4, 0);
$FB->llena_texto("Motivo:",45, 1, $DB, "", "", "$rw1[46]", 1, 0);
$FB->llena_texto("Tiempo:",46, 1, $DB, "", "", "$rw1[47]", 4, 0);
$FB->llena_texto("Toma algun medicamento: ", 47, 82, $DB, $estados, "", "$rw1[48]", 1, 0);
$FB->llena_texto("Cual:",48, 1, $DB, "", "", "$rw1[49]", 1, 0);
$FB->llena_texto("Por que:",49, 1, $DB, "", "", "$rw1[50]", 4, 0);

// $FB->llena_texto("Documentos Familiares:", 109, 6, $DB, "", "", "",1, 0);
echo '<input type="hidden" name="param50" id="param50" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param51" id="param51" value="'.$rw1[0].'">';
// echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
// echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";

// $FB->titulo_azul1("Nombre",1,0,7); 
// $FB->titulo_azul1("Parentesco",1,0,0); 
// $FB->titulo_azul1("Ocupaci&oacute;n u oficio",1,0,0); 
// $FB->titulo_azul1("Celular",1,0,0); 
// $FB->titulo_azul1("Documentos Familiares",1,0,0); 
// $FB->titulo_azul1("Eliminar",1,0,0); 

$sql="SELECT `idrefenciasfamiliares`, `ref_nombre`, `ref_parentesco`, `ref_ocupacion`, `ref_telefono`, `ref_idhojavida`, `ref_usuregistra`, `ref_fecharegistra` FROM `referenciasfamiliares` WHERE  ref_idhojavida=$idhojadevida";

$DB->Execute($sql); 
$va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
				$id_p=$rw1[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>";		

				echo $LT->llenadocs3($DB1, "referenciasfamiliares",$id_p, 1, 35, 'Ver');
				$DB->edites($id_p, "referenciasfamiliares", 2,"$idhojadevida");
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 

?> 
</body>
</html>
