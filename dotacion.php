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

echo "</tr>";
$FB->titulo_azul1("Eventos estresantes ",9,0,7);  
echo "</tr>";

$FB->llena_texto("Red Vincular con tamano reducido :", 10, 5, $DB, $tipoexamen, "", "$rw[128]", 1, 0);
$FB->llena_texto("Vinculos confusos- conflictos (Dependencia):", 11, 5, $DB, $tipoexamen, "", "$rw[129]", 4, 0);
$FB->llena_texto("Relacion de Pareja conflictiva:",12, 5, $DB, $tipoexamen, "", "$rw[130]", 1, 0);
$FB->llena_texto("Contexto socio cultural. anonimato/exclusion:", 13, 5, $DB, $tipoexamen, "", "$rw[131]", 4, 0);
$FB->llena_texto("Situacion economica inestable, insuficiente:", 14, 5, $DB, $tipoexamen, "", "$rw[132]", 1, 0);
$FB->llena_texto("Recursos familiares Insuficientes:", 15, 5, $DB, $tipoexamen, "", "$rw[133]", 4, 0);
$FB->llena_texto("Relaciones Parentales conflictivas:", 16, 5, $DB, $tipoexamen, "", "$rw[134]", 1, 0);
$FB->llena_texto("Relaciones Fraternales conflictivas:", 17, 5, $DB, $tipoexamen, "", "$rw[135]", 4, 0);
$FB->llena_texto("Relaciones familia extensa conflictivas:", 18, 5, $DB, $tipoexamen, "", "$rw[136]", 1, 0);
$FB->llena_texto("Dificultades en situacion laboral:", 19, 5, $DB, $tipoexamen, "", "$rw[137]", 4, 0);
$FB->llena_texto("Otra:", 20, 5, $DB, $tipoexamen, "", "$rw[138]", 1, 0);
$FB->llena_texto("Cual:",21, 1, $DB, "", "", "$rw[139]", 4, 1);

echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
// $FB->llena_texto("Elemento:",1, 1, $DB, "", "", "", 17, 0);
// $FB->llena_texto("Serie:",2, 1, $DB, "", "", "", 4, 0);
// $FB->llena_texto("Fecha Entrega:",3, 10, $DB, "", "", "", 1, 0);
// $FB->llena_texto("Foto:", 112, 6, $DB, "", "", "",4, 0);
// echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
// echo '<input type="hidden" name="param8" id="param8" value="1">';

// //echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
// echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";

// $FB->titulo_azul1("Elemento",1,0,7); 
// $FB->titulo_azul1("Serie",1,0,0); 
// $FB->titulo_azul1("Fecha Entrega",1,0,0); 
// $FB->titulo_azul1("Foto",1,0,0); 
// $FB->titulo_azul1("Eliminar",1,0,0); 

$sql="SELECT `idelementostrabajo`, `ele_nombre`,`ele_serie`, `ele_idhojavida`,ele_fechaentrega, `ele_useringresa`, `ele_fechaingreso` FROM `elementostrabajo` WHERE ele_idhojavida=$idhojadevida";

$DB->Execute($sql); 
$va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
				$id_p=$rw1[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[1]."</td>";		
				echo "<td>".$rw1[2]."</td>";		
				echo "<td>".$rw1[4]."</td>";		

				echo $LT->llenadocs3($DB1, "elementostrabajo",$id_p, 1, 35, 'Ver');
				$DB->edites($id_p, "elementostrabajo", 2,"$idhojadevida");
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 



?> 
</body>
</html>
