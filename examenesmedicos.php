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
$sql1 = "SELECT `hoj_Negligencia`, `hoj_AbusoPsicologico`, `hoj_ConsumoSPA`, `hoj_IdeacionSuicida`, `hoj_VinculacionNegativo`, `hoj_PresuntoAbusoSexual`, `hoj_ConsumoAlcohol`, `hoj_TrabajoInfantil`, `hoj_DificultadesConyugales`, `hoj_DificultadesFamiliaExtensa`, `hoj_Abandono`, `hoj_ViolenciaIntrafamiliar`, `hoj_IdeasMuerte`, `hoj_ExposicionContenidoSexual`, `hoj_AbusoFisico`, `hoj_ConsumoCigarrillo`, `hoj_PermanenciaCalle`, `hoj_IntentosSuicidio`, `hoj_DificultadesFraternale`FROM `hojadevida` where idhojadevida='$idhojadevida'";


	$DB->Execute($sql1);
	$rw1 = mysqli_fetch_row($DB->Consulta_ID);
	
   
echo "</tr>";
$FB->titulo_azul1("II.	Posibles causas que le atribuye el consultante a su problema.",9,0,7);  
echo "</tr>";

$FB->llena_texto("Negligencia:",21, 5, $DB, "", "", "$rw1[0]", 1, 0);
$FB->llena_texto("Abandono:",31, 5, $DB, "", "", "$rw1[10]", 4, 0);

$FB->llena_texto("Abuso Psicologico:",22, 5, $DB, "", "", "$rw1[1]", 1, 0);
$FB->llena_texto("Violencia Intrafamiliar:", 32, 5, $DB, "", "", "$rw1[11]",4, 0);

$FB->llena_texto("Consumo SPA:", 23, 5, $DB, $tipoexamen, "", "$rw1[2]", 1, 0);
$FB->llena_texto("Ideas de muerte:", 33, 5, $DB, $tipoexamen, "", "$rw1[12]", 4, 0);

$FB->llena_texto("Ideacion suicida:", 24, 5, $DB, $tipoexamen, "", "$rw1[3]", 1, 0);
$FB->llena_texto("Exposicion a contenido sexual:", 34, 5, $DB, $tipoexamen, "", "$rw1[13]", 4, 0);

$FB->llena_texto("Vinculacion con pares negativos:", 25, 5, $DB, $tipoexamen, "", "$rw1[4]", 1, 0);
$FB->llena_texto("Abuso Fisico:", 35, 5, $DB, $tipoexamen, "", "$rw1[14]", 4, 0);

$FB->llena_texto("Presunto abuso sexual:", 26, 5, $DB, $tipoexamen, "", "$rw1[5]", 1, 0);
$FB->llena_texto("Consumo de cigarrillo:", 36, 5, $DB, $tipoexamen, "", "$rw1[15]", 4, 0);

$FB->llena_texto("Consumo de alcohol:", 27, 5, $DB, $tipoexamen, "", "$rw1[6]", 1, 0);
$FB->llena_texto("Permanencia en calle:", 37, 5, $DB, $tipoexamen, "", "$rw1[16]", 4, 0);

$FB->llena_texto("Trabajo infantil:", 28, 5, $DB, $tipoexamen, "", "$rw1[7]", 1, 0);
$FB->llena_texto("Intentos de suicidio:", 38, 5, $DB, $tipoexamen, "", "$rw1[17]", 4, 0);

$FB->llena_texto("Dificultades conyugales:", 29, 5, $DB, $tipoexamen, "", "$rw1[8]", 1, 0);
$FB->llena_texto("Dificultades fraternales:", 39, 5, $DB, $tipoexamen, "", "$rw1[18]", 4, 0);

$FB->llena_texto("Dificultades familia extensa:", 30, 5, $DB, $tipoexamen, "", "$rw1[9]", 1, 0);

echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
// echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Guardar</button></td></tr>";

// $FB->titulo_azul1("Examen",1,0,7); 
// $FB->titulo_azul1("Entidad",1,0,0); 
// $FB->titulo_azul1("Fecha Entrega",1,0,0); 
// $FB->titulo_azul1("Foto",1,0,0); 
// $FB->titulo_azul1("Eliminar",1,0,0); 

// $sql="SELECT `idexamenesmedicos`, `exa_nombre`,`exa_serie`, `exa_idhojavida`,exa_fechaentrega, `exa_useringresa`, `exa_fechaingreso` FROM `examenesmedicos` WHERE exa_idhojavida=$idhojadevida";

// $DB->Execute($sql); 
// $va=0; 

// 	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
// 	{
// 				$id_p=$rw1[0];
// 				$va++; $p=$va%2;
// 				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
// 				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
// 				echo "<td>".$rw1[1]."</td>";		
// 				echo "<td>".$rw1[2]."</td>";		
// 				echo "<td>".$rw1[4]."</td>";		

// 				echo $LT->llenadocs3($DB1, "examenesmedicos",$id_p, 1, 35, 'Ver');
// 				$DB->edites($id_p, "examenesmedicos", 2,"$idhojadevida");
// 	}
	


// 	$FB->titulo_azul1(" ------ ",1,0,10); 
// 	$FB->titulo_azul1(" ------",1,0,0); 
// 	$FB->titulo_azul1(" ------",1,0,0); 
// 	$FB->titulo_azul1(" ------",1,0,0); 
// 	$FB->titulo_azul1(" ------",1,0,0); 



?> 
</body>
</html>
