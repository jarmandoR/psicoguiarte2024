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
$FB->titulo_azul1("Sesiones ",9,0,7);  
echo "</tr>";

// $FB->llena_texto("Fecha de inicio:",1, 10, $DB, "", "", "", 1, 0);
// $FB->llena_texto("Fecha de Terminacion:",2, 10, $DB, "", "", "", 4, 0);
// $FB->llena_texto("Dias:",3, 1, $DB, "", "", "", 17, 0);
// $FB->llena_texto("Tipo Incapacidad:", 4, 82, $DB, $tipoincapacidad, "", "", 4, 0);
// $FB->llena_texto("Foto:", 5, 6, $DB, "", "", "",4, 0);


// echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
// echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
// echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Guardar</button></td></tr>";

$FB->titulo_azul1("Fecha ",1,0,7); 
$FB->titulo_azul1("Nombre paciente",1,0,0); 
$FB->titulo_azul1("Encuentro #",1,0,0); 
$FB->titulo_azul1("Informe ",1,0,0); 
$FB->titulo_azul1("Eliminar#",1,0,0); 

$sql1="SELECT hoj_cedula, idusuarios,hoj_nombre,hoj_apellido  FROM `hojadevida` inner join usuarios on  hoj_cedula=usu_identificacion where idhojadevida='$idhojadevida'";		
$DB1->Execute($sql1);
$rw2=mysqli_fetch_row($DB1->Consulta_ID);
$idusuario=$rw2[1];





$sql="SELECT `infig_id`, `infig_Fecha`, `infig_horaInicio`, `infig_horaFin`, `infig_encuentroN`, `infig_paciente` FROM `informeGestion` WHERE infig_paciente='$rw2[0]'";

$DB->Execute($sql); 
$va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
				$id_p=$rw1[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[1]."</td>";		
				echo "<td>".$rw2[2]."".$rw2[3]."</td>";		
                echo "<td>".$rw1[4]."</td>";
                echo "<td><a href='inicio1.php?param15=informe_gestion&tabla=".$id_p."'>ver</a></td>";

				// $DB->edites($id_p, "Incapacidades", 2,"$idhojadevida");
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 



?> 
</body>
</html>
