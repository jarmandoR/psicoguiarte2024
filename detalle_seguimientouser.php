<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde5=" ";
error_reporting(0);
// $hoy=date("Y-m-d");

$sedesesion=$_SESSION['usu_idsede'];

if($param34!=''){ $fechaactual=$param34; }

if($param35!=''){ $id_sedes=$param35; 
	if($id_sedes =='todo'){
		$conde4=" ";
	}else{
		$conde4=" and usu_idsede=$id_sedes "; 
	}
		
}else{

$id_sedes=$sedesesion;


$conde4=" and usu_idsede=$id_sedes "; 
}



if($param32!=''){ 
		
	
		$conde6=" and usu_idempresa='".$param32."' "; 
	
		
}else{




$conde6=""; 
}

if($param38!=''){ 
		
	
	$conde7=" and idroles='".$param38."' "; 

	
}else{




$conde7=""; 
}


$hoyf=date('Y-m-d');
// .0

// $sql="SELECT  `usu_identificacion`,`roles_idroles`, `usu_nombre`, `usu_tipocontrato`,`usu_idsede`,`idusuarios`  FROM `usuarios`   where usu_estado=1  order by usu_nombre  ";

// // and usu_identificacion='1082160155'

//   $DB->Execute($sql); 
// 	  while($rw7=mysqli_fetch_row($DB->Consulta_ID))
// 	  {

// 		// UPDATE `seguimientousers` SET `seg_horaSalida`='".$cadena."' WHERE seg_id='".$id."'";
		
		
// 		$sql9="SELECT seg_iduser from seguimientousers where   seg_fechaingreso='$hoyf' and seg_iduser='$rw7[0]'";
		
		
		
// 		$DB2->Execute($sql9); 
// 		$rw10=mysqli_fetch_row($DB2->Consulta_ID);

// 		if($rw10[0]==''){
// 			// echo$rw7[0]."no";
// 			$sql11="insert into seguimientousers(seg_iduser,seg_fechaingreso) values('" .$rw7[0]."','" .$hoyf. "')";
// 		$DB1->Execute($sql11);

// 		}else{

// 			// echo$rw7[0]."si";

// 		}
		
// 		// echo$sql1="insert into seguimientousers(seg_iduser,seg_fechaingreso,seg_horaingreso)"
// 		// . "values('" .$rw7[0]."','" .$fechaActual. "')";
// 		// $DB1->Execute($sql1);



// 	  }
	// }



if($param33!=''){ $conde="and `idusuarios`= '$param33' "; 

$sql7="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles` FROM `usuarios` WHERE `idusuarios`='$param33'";
			$DB2->Execute($sql7);
			$rw6=mysqli_fetch_row($DB2->Consulta_ID);
			$nombusu =$rw6[0];

$orden="seg_fechaingreso";



 }else{

 	$nombusu ="";

 	if ($param34!='') {
 		$orden="seg_horaingreso";
 	}else{

 		$orden="seg_fechaingreso";
 	}
 	

 
 }
 // else{

 //    $nombusu ="";

 // 	// $orden="seg_horaingreso";
 // 	$orden="usu_nombre";
 // }

	
$FB->titulo_azul1("Usuario",1,0,7); 

if($nivel_acceso==1 or $nivel_acceso==12){
	$FB->titulo_azul1("Cedula",1,'5%',0); 
}
else {}



$FB->titulo_azul1("Rol",1,'5%',0); 
$FB->titulo_azul1("Sede",1,'5%',0); 
$FB->titulo_azul1("Fecha ingreso",1,0,0); 
$FB->titulo_azul1("Ingreso",1,0,0);


$FB->titulo_azul1("Salida",1,'5%',0); 
// $FB->titulo_azul1("Activo 2",1,'5%',0); 
 
// $FB->titulo_azul1("Inactivo 2",1,'5%',0); 

$FB->titulo_azul1("Total",1,'5%',0); 
if($nivel_acceso==1 or $nivel_acceso==12){
$FB->titulo_azul1("Eliminar",1,'5%',0); 
}



$conde3=""; 
if($param34!=''){ $fechaactual=$param34." 00:00:00";  }
if($param36!=''){ $fechafinal=$param36." 23:59:59";  }

// if ($nombusu =="") {
// 	$nombrearchivo="seguimiento de".$fechaactual." a ".$fechafinal."";
// }else{

// 	$nombrearchivo="seguimiento a".$nombusu."de".$fechaactual." a ".$fechafinal."";
// }






if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==26 or $nivel_acceso==58 or $nivel_acceso==53 ){
	
if($param33!=''){
	$nombrearchivo="seguimiento a".$nombusu."de".$fechaactual." a ".$fechafinal."";
	echo'<a style="color:#000000;"   href="seguimientouserexcel.php?valor1= $asesor&valor2='.$fechaactual.'&valor3='.$fechafinal.'&valor5='.$conde.'&valor6= '.$conde4.'&valor7= '.$nombrearchivo.'&orden= '.$orden.'&sedecam= '.$id_sedes.'">
            <img src="images/excel.png" style = "width:50px; height:40px; " hrf="reporteusuarios.php" title="Ver Reporte"/> Descargar 
          </a>';
}else{
	$nombrearchivo="seguimiento de".$fechaactual." a ".$fechafinal."";

	echo'<a style="color:#000000;"   href="seguimientouserexcel.php?valor1= $asesor&valor2='.$fechaactual.'&valor3='.$fechafinal.'&valor5=&valor6= '.$conde4.'&valor7= '.$nombrearchivo.'&orden= '.$orden.'&sedecam= '.$id_sedes.'">
            <img src="images/excel.png" style = "width:50px; height:40px; " hrf="reporteusuarios.php" title="Ver Reporte"/> Descargar 
          </a>';



}
}

$sql4="SELECT seg_iduser,seg_fechaingreso, seg_horaingreso, seg_ingresoAlmuerzo, seg_salioAlmuerzo, seg_idestado,seg_horaSalida, idusuarios,usu_nombre,roles_idroles, seg_id FROM `seguimientousers` inner join `usuarios` on seg_iduser=usu_identificacion inner join roles on roles_idroles=idroles  where  seg_fechaingreso>='$fechaactual' and seg_fechaingreso<='$fechafinal' and seg_iduser!=0 $conde4 $conde $conde6 $conde7 ORDER BY  seg_horaingreso  desc ";




$DB1->Execute($sql4); 
$va=0; 
$totalasignadas=0;


	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{

		
// $sql8="SELECT seg_id where  seg_fechaingreso>='$fechaactual' and seg_fechaingreso<='$fechafinal' and seg_iduser!=0 and seg_iduser='$rw1[0]' $conde4 $conde ORDER BY  $orden  asc ";
$va++;

// $DB1->Execute($sql8); 
// while($rw8=mysqli_fetch_row($DB1->Consulta_ID))
// 	{

$sql8="DELETE FROM `seguimientousers` WHERE  seg_fechaingreso='$fechaactual' and seg_iduser='$rw1[0]' and seg_id>'$rw1[10]'";
$DB2->Execute($sql8); 
	// }




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
			echo "<td colspan='1' width='0' align='center' >".$rw3[0]."</td>";

			if($nivel_acceso==1 or $nivel_acceso==12){
	echo "<td colspan='1' width='0' align='center' >".$rw3[3]."</td>";
}
else {	
		
	
}
if ($rw1[2]==''or $rw1[2]=='00:00:00') {
	$novino="#FF0000";
}else{

	$novino="#3d9f54";
}

			
            echo "<td colspan='1' width='0' align='center'>".$nomrol."</td>";
            echo "<td colspan='1' width='0' align='center'>".$nomsede."</td>";
			echo "<td colspan='1' width='0' align='center'>".$rw1[1]."</td>";
			echo "<td colspan='1' width='0' align='center' bgcolor='".$novino."' >".$rw1[2]."</td>";
			echo "<td colspan='1' width='0' align='center'>".$rw1[3]."</td>";

			// echo "<td colspan='1' width='0' align='center' >".$rw1[4]."</td>";
			// echo "<td colspan='1' width='0' align='center' >".$rw1[6]."</td>";


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
			echo "<td colspan='1' width='0' align='center' bgcolor='".$demora."' >".$horasfin.":".$minutosfin.":".$segunfin."</td>";
			
			$color1='';
			$color2='';
	

			if($nivel_acceso==1 or $nivel_acceso==12){
				$DB->edites($rw1[10], "seguimientousers", 2,0);
			}
		
		}

		echo"</tr>";
	


	$FB->titulo_azul1(" Totales :",1,0,10); 
	$FB->titulo_azul1(" $va",1,0,0); 

	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	


include("footer.php");
?>