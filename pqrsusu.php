<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];
$empresausu=$_SESSION['usu_idempresa'];

$fechaactualHora =date("Y-m-d");

// if($nivel_acceso==1 or $nivel_acceso==13 or $nivel_acceso==15 or $nivel_acceso==16 or $nivel_acceso==18 ){




if($param34!=''){ $fechaactual=$param34; }
if($param2!=''){ 
	$conde26=" and nov_idusuario ='$param2' ";  
 
	}else{
		$conde26="";  
	}

	if($param6!=''){ 
	$conde27=" and nov_estado ='$param6' ";  
 
	}else{
		$conde27="";  
	}
	if($param1!=''){ 
		 $id_sedes =$param1;
	$conde28=" and nov_sede ='$param1' ";  
 
	}else{

if($nivel_acceso==1 or  $nivel_acceso==18 ){
$conde28=" ";  
}else{
	$conde28=" and nov_sede ='$id_sedes' ";  
}
	


		
	}

if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }
$FB->titulo_azul1("Novedades",9,0,7);  
$FB->abre_form("form1","","post");

	$conde="";
	$conde="asi_fecha";
	$conde2="and usu_idsede=$id_sedes "; 





$mes=date('m');
$dia=date('d');

if($dia>=1 and $dia<=16){
$quincena1='Primera';
}else{
	$quincena1='Segunda';
}

if ($nivel_acceso==1 ) {
	// $FB->llena_texto("Empresa:",3,2,$DB," SELECT `empre_id`, `empre_nombre` FROM `empresa`", "cambio3(param1.value,param2.value,this.value,\"adm_usuarios.php\",1);",$param3, 1, 0);
	$param5="";
}else{

	$param5="and sed_empresa ='$empresausu'";	
}


$FB->llena_texto("Mes:", 34, 82, $DB, $mesd, "", "$mes", 1, 0);
$FB->llena_texto("Quincena", 36, 82, $DB, $quincena, "", "$quincena1", 4, 0);
// $FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechainicio", 17, 0);
// $FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);

if($nivel_acceso==1 or  $nivel_acceso==18 ){

	

		$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $param5 )", "cambio4(\"param2\",\"param1\",\"novedades.php\")", "$param1", 1, 0);
}else{
	$id_sedes=$_SESSION['usu_idsede'];

		$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4 $param5)", "cambio4(\"param2\",\"param1\",\"novedades.php\")", "$id_sedes", 1, 1);

}

	

$FB->llena_texto("Empleado:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 1, 0);
$FB->llena_texto("Estado novedad:", 6, 82, $DB,$estadosnovedades, "", "$param6", 4, 1);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 





if($rcrear==1) { $FB->nuevo("pqr", $condecion, "pqr"); } 



		$FB->titulo_azul1("Validar",1,0,5); 
		$FB->titulo_azul1("Nombre usuario ",1,0,0); 
		$FB->titulo_azul1("Tipo de PQR",1,0,0); 
		$FB->titulo_azul1("Descripcion adicional",1,0,0); 
		
		
		$FB->titulo_azul1("Fecha registro",1,0,0);
		$FB->titulo_azul1("Imagen",1,0,0); 
		$FB->titulo_azul1("Respuesta",1,0,0); 
		$FB->titulo_azul1("Sede",1,0,0); 

if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==26){	
	$param6="";
	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
} else{

	$param6="and pqr_solicitante='$id_usuario'";
}


if($param34!=''){ 
	$fechaactual=$param34." 00:00:00";  

}else{
	$param34= $mes;
}
if($param36!=''){
 $fechafinal=$param36." 23:59:59"; 

	
  }else{
  	$param36=$quincena1;
  }

$ano=date('Y');

if($param36=='Primera'){
	$fechaactual=date($ano.'-'.$param34.'-01'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-15'.' 23:59:59');
}elseif($param36=='Segunda'){
	$fin = date("t");
	$fechaactual=date($ano.'-'.$param34.'-16'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-'.$fin.' 23:59:59');
}

if($param6=="" or $param6=="0"){
	$conde21="and  asi_usercom IS NULL";
}else{
	$conde21="and  asi_usercom IS NOT NULL";
}


 $fechafinal;
 $fechaactual;



// if($param4!=''){ 
// 	$conde1=" nov_fechaingresonov >='$param5' and nov_fechaingresonov <='$param4'";  

// 	 $fechaactual=$param4;  
// 	 $fechainicio=$param5;  
// 	}else{
		$conde1=" nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal'";  
	// }

// $sql="SELECT `novid`,`nov_tipo`,`nov_descripcion`,nov_estado, `nov_idusuario`,  `nov_fechadesde`, `nov_fechahasta`,`nov_quienregistro`,`nov_fechaingresonov`,`nov_quienregistro`,`nov_imagen` FROM `novedades` where nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal' $conde26 $conde27 $conde28 ORDER BY novid desc";

$sql="SELECT `pqr_id`, `pqr_estado`, `pqr_solicitante`, `pqr_tipo`, `pqr_descripcion`, `pqr_fecha`, `pqr_imagen`, `pqr_sede`, `pqr_respuesta` FROM `pqr` WHERE pqr_id>'0' $param6";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	
	if($rw1[1]==2){

		echo "<td>CONFIRMADO</td>";

	}else if($rw1[1]==0 or $rw1[1]==1 ){
   
if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==26){

		echo "<td align='center' >
		<a  onclick='pop_dis10($id_p,\"Confirmarpqr\",\"Gastos\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
	
	}else{

		echo "<td>POR CONFIRMAR</td>";
	}


		
	}
    
	$sql3="SELECT `novt_id`,`novt_nombre` FROM tipo_novedades where novt_id= '$rw1[1]'";
	$DB->Execute($sql3);
	$rw4=mysqli_fetch_row($DB->Consulta_ID);
    

    

	        $sql2="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles` FROM `usuarios` WHERE `idusuarios`='$rw1[2]'";
			$DB->Execute($sql2);
			$rw3=mysqli_fetch_row($DB->Consulta_ID);

              $sql6="SELECT `sed_nombre`,`idsedes`FROM `sedes` WHERE `idsedes`='$rw1[7]'";
			  $DB->Execute($sql6);
			  $rw6=mysqli_fetch_row($DB->Consulta_ID);


			$sql4="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles` FROM `usuarios` WHERE `idusuarios`='$rw1[9]'";
			$DB->Execute($sql4);
			$rw5=mysqli_fetch_row($DB->Consulta_ID);
			// $sede =$rw3[0]; 

		// $valor=number_format($rw1[4],0,".",".");
		// @$valor2=number_format($rw1[9],0,".",".");

if ($rw1[3]==1) {
	$estado="Petición";
}elseif($rw1[3]==2){
	$estado="Queja";

}elseif($rw1[3]==3){
	$estado="Reclamo";


}
		echo "<td>".$rw3[0]."</td>
		<td>".$estado."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>";
		// <td>".$rw1[6]."</td>

		if ($rw1[6]=='') {
			echo"<td></td>";
			}else{
			echo"<td><a href='imgnovedades/".$rw1[6]."' target='_blank'>Ver</a></td>";
		   }
		echo"<td>".$rw1[8]."</td>
		<td>".$rw6[0]."</td>";

		// <td>".$rw1[8]."</td>"

		// if ($rw1[10]=='') {
  //       echo"<td></td>";
  //       }else{
	 //    echo"<td><a href='imgnovedades/".$rw1[10]."' target='_blank'>Ver</a></td>";


  //       }
  //       echo"<td>".$rw6[0]."</td>";
		
		// if($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==10){
		// 		echo "<td>".$rw1[10]."</td>
		// 		<td>".$rw1[3]."</td>
		// 		";
		// }	

		//  $sql="SELECT cla_nombre,tipo_nombre FROM `tipo_gastos` inner join clasificacion_gastos on inner_clasificacion_gastos=idclasificacion_gastos where idtipo_gastos='$rw1[11]';";
		// $DB->Execute($sql);
		// $rw3=mysqli_fetch_array($DB->Consulta_ID);
		
		// echo "	<td>".$rw3[0]."</td>
		// <td>".$rw3[1]."</td>
		// ";

		$LT->llenadocs2($DB, "asignaciondinero", $id_p, 1, 35, 1);
		if($nivel_acceso==1 or $nivel_acceso==18){
			$DB->edites($id_p, "pqr", 2, $condecion);
		//$DB->edites($id_p, "asignardinero", 1, $condecion);
		}
	echo "</tr>";
}


include("footer.php"); ?>