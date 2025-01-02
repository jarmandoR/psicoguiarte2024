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



// echo $sql="SELECT `ref_consultante`,`ref_acompañante` FROM `referenciaslaborales` WHERE  ref_idhojavida=$idhojadevida";

// $DB->Execute($sql); 
// $rw0=mysqli_fetch_row($DB->Consulta_ID);

$sql = "SELECT `hoj_ReportadoColsun`, `hoj_ReportadoAcomp`FROM `hojadevida` where idhojadevida='$idhojadevida'";


	$DB1->Execute($sql);
	$rw = mysqli_fetch_row($DB1->Consulta_ID);

echo '</tr>';
echo '</tr>';
$FB->titulo_azul1(' I. Motivo de la consulta.',9,0,7);  
echo '</tr>';
echo '<td><label>Reportado por el colsuntante:</label></td>';

echo '<td><textarea name="param10" id="param10" value="" style="width:350px; height:150px; class="text" >'.$rw[0].'</textarea></td>';

echo '<td><label>Reportado por el acompañante:</label></td>';

echo '<td><textarea name="param11" id="param11" value="" style="width:350px; height:150px; class="text" >'.$rw[1].'</textarea></td>';

?> 
</body>
</html>

