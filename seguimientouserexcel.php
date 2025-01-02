<?php 
error_reporting(0);
$nombre = $_GET['valor7'];

header('Content-type:application/xls');
header('Content-Disposition: attachment; filename='.$nombre.'.xls');
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";



    $asesor = $_GET['valor1'];
	$fechaactual = $_GET['valor2'];
	$fechafinal = $_GET['valor3'];

	$conde = $_GET['valor5'];
	$conde4 = $_GET['valor6'];

	
	$sedellega = $_GET['sedecam'];


$sedesesion=$_SESSION['usu_idsede'];


// if($id_sedes =='todo'){
// 	$conde4=" ";
// }else{
// 	$conde4=" and usu_idsede=$id_sedes "; 
// }

// if ($conde="") {
    
//     $orden="usu_nombre";
	
// }else{

	
// }
if ($sedellega=='todo') {
	# code...
	$orden="usu_nombre";

}else{
	$orden = $_GET['orden'];

}

echo'<table border="1">';
echo'<tr style="background-color:red;">';
echo'<th>Empleado</th>';
echo'<th>Cedula</th>';
echo'<th>Rol</th>';
echo'<th>Sede</th>';
echo'<th>Fecha ingreso</th>';
echo'<th>Activo1</th>';
echo'<th>Inactivo1</th>';
echo'<th>Activo2</th>';
echo'<th>Inactivo2</th>';
echo'<th>Tiempo almuerzo</th>';
echo'</tr>';




// if($nivel_acceso==1 or $nivel_acceso==12){
// $FB->titulo_azul1("Eliminar",1,'5%',0); 
// }




$sql4="SELECT seg_iduser,seg_fechaingreso, seg_horaingreso, seg_ingresoAlmuerzo, seg_salioAlmuerzo, seg_idestado,seg_horaSalida, idusuarios,usu_nombre,roles_idroles, seg_id FROM `seguimientousers` inner join `usuarios` on seg_iduser=usu_identificacion where  seg_fechaingreso>='$fechaactual' and seg_fechaingreso<='$fechafinal' and seg_iduser!=0 $conde4 $conde ORDER BY usu_nombre  asc ";

$DB1->Execute($sql4); 
$va=0; 
$totalasignadas=0;


	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{

		
		$id_p=$rw1[0];

	$sql2="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles`,`usu_identificacion` FROM `usuarios` WHERE `usu_identificacion`='$rw1[0]'";
			$DB2->Execute($sql2);
			$rw3=mysqli_fetch_row($DB2->Consulta_ID);
			$sede =$rw3[1]; 

$sql4="SELECT `sed_nombre` FROM `sedes` WHERE `idsedes`='".$sede."'";
			$DB2->Execute($sql4);
			$rw4=mysqli_fetch_row($DB2->Consulta_ID);
			$nomsede =$rw4[0]; 

	$sql5="SELECT `rol_nombre` FROM `roles` WHERE `idroles`='".$rw1[9]."'";
			$DB2->Execute($sql5);
			$rw5=mysqli_fetch_row($DB2->Consulta_ID);
			$nomrol =$rw5[0]; 		

		echo "<tr class='text' bgcolor='$color'>" ;
			echo "<td>".$rw3[0]."</td>";
             echo "<td >".$rw3[3]."</td>";


			 if ($rw1[2]==''or $rw1[2]=='00:00:00') {
				$novino="#FF0000";
			}else{
			
				$novino="#3d9f54";
			}
            echo "<td>".$nomrol."</td>";
 		    echo "<td >".$nomsede."</td>";
			echo "<td >".$rw1[1]."</td>";
			echo "<td bgcolor='".$novino."' >".$rw1[2]."</td>";
			echo "<td '>".$rw1[3]."</td>";
			echo "<td '>".$rw1[4]."</td>";
			echo "<td '>".$rw1[6]."</td>";


            $horacero="00:00:00";
            $entrolmuerzo = new DateTime($rw1[3]);
          
            if ($rw1[4]== $horacero) {
	$saliodealmuerzo = new DateTime($rw1[3]);	
	}else{
		$saliodealmuerzo = new DateTime($rw1[4]);
	}
            
            $tiempo = $entrolmuerzo->diff($saliodealmuerzo);
            $horasfin= $tiempo->format('%H');
            $minutosfin= $tiempo->format('%i');
            $segunfin= $tiempo->format('%s');

            if ($minutosfin>35 or $horasfin>=1 ) {
            	$demora="ff8000";
            }else{

            	$demora="#3d9f54";
            }
			echo "<td  bgcolor='".$demora."' >".$horasfin.":".$minutosfin.":".$segunfin."</td>";
			
			$color1='';
			$color2='';
		
		}
		echo"</tr>";
	



	


?>
</table>