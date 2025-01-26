<script type="text/javascript">
	
	alert('hola');
</script>
<?php 

// $nombre = $_GET['valor7'];


require("login_autentica.php");
include("cabezote3.php"); 
$id_usuario=$_SESSION['usuario_id'];
// $busqueda=$_POST['cadena'];
// $=$_POST['param21'];
// $tipo=$_POST['param21'];

$hoyf=date('h:i:s');
$cadena = $_GET['cadena'];
$id = $_GET['id'];
$tipo = $_GET['tipo'];
$motivo = $_GET['motivo'];

$hoyf=date('Y-m-d');


echo$sql4="SELECT seg_iduser,seg_fechaingreso, seg_horaingreso, seg_ingresoAlmuerzo, seg_salioAlmuerzo, seg_idestado ,seg_horaSalida, seg_iduser  FROM `seguimientousers` where seg_id='".$id."' ";
$DB1->Execute($sql4);
$rw7=mysqli_fetch_row($DB1->Consulta_ID);










if ($tipo==1) {

	$horaantigua=$rw7[2];

	echo$sql1="UPDATE `seguimientousers` SET `seg_horaingreso`='".$cadena."' WHERE seg_id='".$id."'";
			$DB1->Execute($sql1);
	# code...
}elseif ($tipo==2) {

	$horaantigua=$rw7[3];
	echo$sql1="UPDATE `seguimientousers` SET `seg_ingresoAlmuerzo`='".$cadena."' WHERE seg_id='".$id."'";
			$DB1->Execute($sql1);
	# code...
}elseif ($tipo==3) {

	$horaantigua=$rw7[4];
	echo$sql1="UPDATE `seguimientousers` SET `seg_salioAlmuerzo`='".$cadena."' WHERE seg_id='".$id."'";
			$DB1->Execute($sql1);
	# code...
}elseif ($tipo==4) {

	$horaantigua=$rw7[6];
	echo$sql1="UPDATE `seguimientousers` SET `seg_horaSalida`='".$cadena."' WHERE seg_id='".$id."'";
			$DB1->Execute($sql1);
	# code...
}




echo$sql5="INSERT INTO `registromodhoras`( `mod_idusmodifica`, `mod_idusmodificado`, `mod_horanti`, `mod_horanueva`, `mod_fechacuandomod`, `mod_fechadiamodi`, `mod_motivo`) VALUES ('".$id_usuario."','".$rw7[7]."','".$horaantigua."','".$cadena."','".$hoyf."','".$rw7[1]."','".$motivo."')";
$DB2->Execute($sql5);


$campo='TELEFONO';

// if ($tipo==2) {

// $campo='RUT';
// }




// echo'<table border="1">';
// echo'<tr style="background-color:red;">';
// echo'<th>Empleado</th>';
// echo'<th>Cedula</th>';
// echo'<th>Rol</th>';
// echo'<th>Sede</th>';
// echo'<th>Fecha ingreso</th>';
// echo'<th>Activo</th>';
// echo'<th>Inactivo</th>';
// echo'<th>Activo</th>';
// echo'<th>Inactivo</th>';
// echo'<th>Tiempo almuerzo</th>';
// echo'</tr>';




// if($nivel_acceso==1 or $nivel_acceso==12){
// $FB->titulo_azul1("Eliminar",1,'5%',0); 
// }

// echo$sql1="UPDATE hojadevida set `hoj_salario`='$valor' where idhojadevida='$valor1' ";
// 			$DB1->Execute($sql1);


// echo$sql4="SELECT seg_iduser,seg_fechaingreso, seg_horaingreso, seg_ingresoAlmuerzo, seg_salioAlmuerzo, seg_idestado,seg_horaSalida, idusuarios,usu_nombre,roles_idroles, seg_id FROM `seguimientousers` inner join `usuarios` on seg_iduser=usu_identificacion where  seg_fechaingreso>='$fechaactual' and seg_fechaingreso<='$fechafinal' and seg_iduser!=0 $conde4 $conde ORDER BY $orden   asc ";

// $DB1->Execute($sql4); 
// $va=0; 
// $totalasignadas=0;


// 	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
// 	{

		
// 		$id_p=$rw1[0];

// 	$sql2="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles`,`usu_identificacion` FROM `usuarios` WHERE `usu_identificacion`='$rw1[0]'";
// 			$DB2->Execute($sql2);
// 			$rw3=mysqli_fetch_row($DB2->Consulta_ID);
// 			$sede =$rw3[1]; 

// $sql4="SELECT `sed_nombre` FROM `sedes` WHERE `idsedes`='".$sede."'";
// 			$DB2->Execute($sql4);
// 			$rw4=mysqli_fetch_row($DB2->Consulta_ID);
// 			$nomsede =$rw4[0]; 

// 	$sql5="SELECT `rol_nombre` FROM `roles` WHERE `idroles`='".$rw1[9]."'";
// 			$DB2->Execute($sql5);
// 			$rw5=mysqli_fetch_row($DB2->Consulta_ID);
// 			$nomrol =$rw5[0]; 		

// 		echo "<tr class='text' bgcolor='$color'>" ;
// 			echo "<td>".$rw3[0]."</td>";
//              echo "<td >".$rw3[3]."</td>";
//             echo "<td>".$nomrol."</td>";

//             echo "<td >".$nomsede."</td>";
// 			echo "<td >".$rw1[1]."</td>";
// 			echo "<td >".$rw1[2]."</td>";
// 			echo "<td >".$rw1[3]."</td>";
// 			echo "<td >".$rw1[4]."</td>";
// 			echo "<td >".$rw1[6]."</td>";


//             $horacero="00:00:00";
//             $entrolmuerzo = new DateTime($rw1[3]);
          
//             if ($rw1[4]== $horacero) {
// 	$saliodealmuerzo = new DateTime($rw1[3]);	
// 	}else{
// 		$saliodealmuerzo = new DateTime($rw1[4]);
// 	}
            
//             $tiempo = $entrolmuerzo->diff($saliodealmuerzo);
//             $horasfin= $tiempo->format('%H');
//             $minutosfin= $tiempo->format('%i');
//             $segunfin= $tiempo->format('%s');

//             if ($minutosfin>35 or $horasfin>=1 ) {
//             	$demora="#FF0000";
//             }else{

//             	$demora="#3d9f54";
//             }
// 			echo "<td  bgcolor='".$demora."' >".$horasfin.":".$minutosfin.":".$segunfin."</td>";
			
// 			$color1='';
// 			$color2='';
		
// 		}
// 		echo"</tr>";
	



	


?>
</table>