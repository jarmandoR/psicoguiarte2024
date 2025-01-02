<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];

$fechaactualHora =date("Y-m-d");

if($nivel_acceso==1 or $nivel_acceso==13 or $nivel_acceso==15 or $nivel_acceso==16 or $nivel_acceso==18 or $nivel_acceso==20){

// if($param1!=""){  $conde1="and usu_idsede='$param1'";  $id_sedes =$param1; }  else {$param1=""; $conde1="and usu_idsede=$id_sedes ";  }
// if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.="and (asi_idpromotor='$param2' or asi_idautoriza='$param2')"; } } else {$param2="";  }


if($param4!=''){ 
	$conde1=" soli_fecha >='$param5' and soli_fecha <='$param4'";  

	 $fechaactual=$param4;  
	 $fechainicio=$param5;  
	}else{
		$conde1=" soli_fecha >='$fechainicio' and soli_fecha <='$fechaactualHora'";  
	}

if($param2!=''){ 
	$conde26=" and soli_idusuario ='$param2' ";  
 
	}else{
		$conde26="";  
	}

	if($param6!=''){ 
	$conde27=" and soli_valida ='$param6' ";  
 
	}else{
		$conde27="";  
	}
	if($param1!=''){ 
		 $id_sedes =$param1;
	$conde28=" and soli_sede ='$param1' ";  
 
	}else{
		$conde28="";  
	}

if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }
$FB->titulo_azul1("Solicitudes",9,0,7);  
$FB->abre_form("form1","","post");

	$conde="";
	$conde="asi_fecha";
	$conde2="and usu_idsede=$id_sedes "; 

	$FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechainicio", 17, 0);
	$FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "cambio4(\"param2\",\"param1\",\"solicitudess.php\")", "", 1, 0);
	//$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Empleado:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 1, 0);
	// $FB->llena_texto("confirmar:", 6, 82, $DB, $confirmar, "", "$param6", 4, 1);
	$FB->llena_texto("Estado solicitud:", 6, 82, $DB,$estadosnovedades, "", "$param6", 4, 1);

	$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
	$FB->cierra_form(); 


}else{
$FB->titulo_azul1("Mis solicitudes",9,0,7);  




}


if($rcrear==1) { $FB->nuevo("Solicitudes", $condecion, "novedades"); } 



$FB->titulo_azul1("Validar",1,0,5); 
$FB->titulo_azul1("Nombre usuario ",1,0,0); 
$FB->titulo_azul1("Tipo de solicitud",1,0,0); 
$FB->titulo_azul1("Descripcion ",1,0,0); 
$FB->titulo_azul1("Fecha",1,0,0); 
$FB->titulo_azul1("Descargas",1,0,0);
 
// $FB->titulo_azul1("Imagen",1,0,0); 

if($nivel_acceso==1 or $nivel_acceso==18){
	// if($param1==""){
	// 	$conde1='and  asi_usercom IS NULL';
	// }

	
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
} 

if($param6=="" or $param6=="0"){
	$conde21="and  asi_usercom IS NULL";
}else{
	$conde21="and  asi_usercom IS NOT NULL";
}



if($nivel_acceso==1 or $nivel_acceso==18){
	// if($param1==""){
	// 	$conde1='and  asi_usercom IS NULL';
	// }

$sql="SELECT `soli_valida`,`soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`,`soli_id`, `soli_inicio`, `soli_fin`, `soli_soporte`, `soli_gerente`, `soli_gefeinme`,`soli_remunerado` FROM `solicitudes` where $conde1 $conde26 $conde27 $conde28";
} else{

$sql="SELECT `soli_valida`,`soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`,`soli_id`, `soli_inicio`, `soli_fin`, `soli_soporte`, `soli_gerente`, `soli_gefeinme`, `soli_remunerado`  FROM `solicitudes` where soli_idusuario = '$id_usuario'";

}


$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[5];


	$soporte=$rw1[8];
	$gerente=$rw1[9];
	$gefeinme=$rw1[10];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	
	if($rw1[0]==2){

		
		if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==20 or $nivel_acceso==26){

			echo "<td align='center' >
			<a  onclick='pop_dis10($id_p,\"Validarsolicitud\",\"Gastos\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'>Confirmado</a></td>";
		
		}else{
	
			echo "<td>CONFIRMADO</td>";
		}



	}else if($rw1[0]==0 or $rw1[0]==1 ){
   
    if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==20 or $nivel_acceso==26){

		echo "<td align='center' >
		<a  onclick='pop_dis10($id_p,\"Validarsolicitud\",\"Gastos\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
	
	}else{

		echo "<td>POR CONFIRMAR</td>";
	}


		
	}
    
	$sql3="SELECT `novt_id`,`novt_nombre` FROM tipo_novedades where novt_id= '$rw1[1]'";
	$DB->Execute($sql3);
	$rw4=mysqli_fetch_row($DB->Consulta_ID);
    

    

	        $sql2="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles`,`usu_identificacion` FROM `usuarios` WHERE `idusuarios`='$rw1[1]'";
			$DB->Execute($sql2);
			$rw3=mysqli_fetch_row($DB->Consulta_ID);

			$sql4="SELECT `hoj_nombre`,`hoj_apellido`,`hoj_cedula`,`hoj_fechacontrato`,`hoj_cargo`, `hoj_entregapuesto` FROM `hojadevida` WHERE `hoj_cedula`='$rw3[3]'";
			$DB->Execute($sql4);
			$rw5=mysqli_fetch_row($DB->Consulta_ID);
		

            $sql5="SELECT `car_Cargo`,`idcargo` FROM `cargo` WHERE `idcargo`='$rw5[4]'";
			$DB->Execute($sql5);
			$rw6=mysqli_fetch_row($DB->Consulta_ID);


		echo "<td>".$rw3[0]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>";

		if ($rw1[0]==2 ) {


			if ($rw1[4]=="Certificado laboral") {
				if ($rw5[5]!=0){

					echo"<td><a href='certificadoLaboral.php?variable1=".$rw3[0]."&variable2=".$rw3[3]."&variable3=".$rw5[3]."&variable4=".$rw6[0]."&variable5=".$rw1[3]."&variable6=2' target='blank' >Certificado</a></td>";
					
				   


				}else{

					echo"<td><a href='certificadoLaboral.php?variable1=".$rw3[0]."&variable2=".$rw3[3]."&variable3=".$rw5[3]."&variable4=".$rw6[0]."&variable5=".$rw1[3]."&variable6=1' target='blank' >Certificado</a></td>"; 
					
				}
			}else {

				echo"<td><a href='certvacaciones.php?variable1=".$rw3[0]."&variable2=".$rw3[3]."&variable3=".$rw5[3]."&variable4=".$rw6[0]."&variable5=".$rw1[3]."&variable6=vacaciones&sede=".$rw1[3]."&fechini=".$rw1[6]."&fechfin=".$rw1[7]."&soporte=".$rw1[8]."&gerente=".$rw1[9]."&gefeinme=".$rw1[10]."&remunerado=".$rw1[11]."' target='blank' >Documento</a></td>";
					
	
			}
	



		}else{

			echo "<td>En espera..</td>";
		}

		
		// <td>".$rw1[6]."</td>
		// <td>".$rw5[0]."</td>
		// <td>".$rw1[8]."</td>

		// if ($rw1[10]=='') {
  //       echo"<td></td>";
  //       }else{
	 //    echo"<td><a href='imgnovedades/".$rw1[10]."' target='_blank'>Ver</a></td>";


  //       }

		
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
			$DB->edites($id_p, "solicitudes", 2, $condecion);
		//$DB->edites($id_p, "asignardinero", 1, $condecion);
		}
	echo "</tr>";
}


include("footer.php"); ?>