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
$FB->titulo_azul1("VIII.	Eventos considerados fortalezas (Generatividad): ",9,0,7);  
echo "</tr>";

$FB->llena_texto("Red Vincular amplia y densa:", 71, 5, $DB, $tipoexamen, "", "$rw[116]", 1, 0);
$FB->llena_texto("Recursos familiares suficientes:", 72, 5, $DB, $tipoexamen, "", "$rw[117]", 4, 0);
$FB->llena_texto("Vinculos claros- acuerdos (Autonomia):", 73, 5, $DB, $tipoexamen, "", "$rw[118]", 1, 0);
$FB->llena_texto("Contexto socio cultural. Pertenencia/inclusion:", 74, 5, $DB, $tipoexamen, "", "$rw[119]", 4, 0);
$FB->llena_texto("Situacion economica estable, suficiente:", 75, 5, $DB, $tipoexamen, "", "$rw[120]", 1, 0);
$FB->llena_texto("Relacion de Pareja armoniosa:", 76, 5, $DB, $tipoexamen, "", "$rw[121]", 4, 0);
$FB->llena_texto("Relaciones Parentales armoniosas:", 77, 5, $DB, $tipoexamen, "", "$rw[122]", 1, 0);
$FB->llena_texto("Relaciones Fraternales armoniosas:", 78, 5, $DB, $tipoexamen, "", "$rw[123]", 4, 0);
$FB->llena_texto("Relaciones familia extensa armoniosas:", 79, 5, $DB, $tipoexamen, "", "$rw[124]", 1, 0);
$FB->llena_texto("Buena situacion laboral:", 80, 5, $DB, $tipoexamen, "", "$rw[125]", 4, 0);
$FB->llena_texto("Otra:", 81, 5, $DB, $tipoexamen, "", "$rw[126]", 1, 0);
$FB->llena_texto("Cual:",82, 1, $DB, "", "", "$rw[127]", 4, 1);

echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';

// $FB->llena_texto("Fecha de Entrega de Vehiculo:", 1, 10, $DB, "", "", "", 1, 0);
// $FB->llena_texto("Vehiculo:",2,2,$DB,"(SELECT concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as id_vehiculo, concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as vehiculo FROM vehiculos where veh_estado=1)", "", "", 4, 0);

// echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
// echo '<input type="hidden" name="param8" id="param8" value="1">';

// //echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
// echo "<td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Agregar</button></td></tr>";

// $FB->titulo_azul1("Fecha de Entrega de Vehiculo",1,0,7); 
// $FB->titulo_azul1("Vehiculo",1,0,0);  
// $FB->titulo_azul1("Usuario Registro",1,0,0);  
// $FB->titulo_azul1("Fecha Registro",1,0,0);  
if($nivel_acceso==1){
	// $FB->titulo_azul1("Eliminar",1,0,0); 
}

$sql="SELECT `identregavehiculo`, `ent_fechaentrega`, `ent_vehiculo`, `ent_userregistra`, `ent_idhojadevida`, `ent_fecharegistra` FROM `entregavehiculo` WHERE  ent_idhojadevida=$idhojadevida";

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
				<td>".$rw1[5]."</td>";		

				//echo $LT->llenadocs3($DB1, "entregavehiculo",$id_p, 1, 35, 'Ver');
			if($nivel_acceso==1){
				$DB->edites($id_p, "entregavehiculo", 2,"$idhojadevida");
			}else{
				//$DB->edites($id_p, "entregavehiculo", 2,"$idhojadevida");

			}
	}
	

	
	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 



?> 
</body>
</html>
