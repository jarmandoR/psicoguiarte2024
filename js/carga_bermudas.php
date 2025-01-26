<?php
require("login_autentica.php"); 
include("layout.php");
$nivel_acceso=$_SESSION['usuario_rol'];
$id_usuario=$_SESSION['usuario_id'];
if(isset($_REQUEST["param1"])){ if($param1!=""){  $conde1="and (gas_idciudadori='$param1' or gas_idciudaddes='$param1') ";  $id_sedes=$param1; } } 
else {$param1="";  
	if($nivel_acceso==1){
		$conde1="";
	}else{
		$conde1="and (gas_idciudadori='$id_sedes' or gas_idciudaddes='$id_sedes') "; 

	}

}
$conde3='';
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.=" and asi_idpromotor='$param2'"; } } else {$param2="";  }
if($param4!=''){ $conde1.="and date(gas_fecharegistro)>='$param5' and date(gas_fecharegistro)<='$param4'";  $fechaactual=$param4;    $fechainicio=$param5;    } 
else { $conde1.=" and date(gas_fecharegistro)>='$fechainicio' and date(gas_fecharegistro)<='$fechaactual'";  }

if(isset($_REQUEST["param3"]) and $_REQUEST["param3"]>0){ 

	if($param3=="1" or $param3==""){
		$conde3="and gas_usucom='' and gas_cantcom='' ";
	}elseif($param3=="2")
	{
		$conde3="and gas_usucom!='' and gas_cantcom!='' and gas_iduserrecoge<=0 ";
	}elseif($param3=="3")
	{
		$conde3="and gas_iduserrecoge>0  and gas_recogio<=0";

	}elseif($param3=="4")
	{
		$conde3="and gas_iduserrecoge>0  and gas_recogio=1";
	}elseif($param3=="5")
	{
		$conde3="and gas_usucom!='' and gas_iduserrecoge>0  and gas_recogio=2";
	}
	elseif($param3=="6")
	{
		$conde3="and gas_usucom!='' and gas_iduserrecoge>0  and gas_recogio=1 and gas_nomvalida!=''";
	}
	
}else{
	$conde3="and gas_usucom='' and gas_cantcom='' ";
}

// $FB->titulo_azul1("Cargar A",9,0,7);  
// $FB->abre_form("form1","","post");


// $conde="";
// $conde="gas_fecharegistro";

// $FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechainicio", 1, 0);
// $FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);

// $FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$id_sedes", 1, 0);
// $FB->llena_texto("Estado:", 3, 82, $DB, $estado_remesa, "", "$param3", 4, 1);

// $FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
// $FB->cierra_form(); 

// // if($rcrear==1) { $FB->nuevo("Remesas", $condecion, ""); } 
// echo'<a href="huella/index.php" class="btn btn-light">Cargar Archivos</a>';
// echo'<a href="huella/index.php" class="btn btn-light">Descargar Archivos</a>';

// $FB->titulo_azul1("Fecha Cargar",1,0,5); 
// $FB->titulo_azul1("Archivo",1,0,0); 
// $FB->titulo_azul1("Proveedor",1,0,0); 
// $FB->titulo_azul1("Descargar",1,0,0); 	
// $FB->titulo_azul1("Estado",1,0,0); 
// $FB->titulo_azul1("Eliminar",1,0,0); 
// // $FB->titulo_azul1("Tel Conductor",1,0,0); 
// // $FB->titulo_azul1("Pagar en?",1,0,0); 
// // $FB->titulo_azul1("Operario Remesa",1,0,0); 
// // $FB->titulo_azul1("Entrego?",1,0,0); 
// // $FB->titulo_azul1("Descripcion",1,0,0); 
// // $FB->titulo_azul1("Peso",1,0,0); 
// // $FB->titulo_azul1("Piezas",1,0,0); 
// // $FB->titulo_azul1("Pagar",1,0,0); 
// // $FB->titulo_azul1("confirmar",1,0,0); 
// // $FB->titulo_azul1("Confirmo",1,0,0); 
// // $FB->titulo_azul1("Valor Aprobado",1,0,0); 
// // $FB->titulo_azul1("Fecha Confirmacion",1,0,0);

// // if($nivel_acceso!=3){  
// // 	$FB->titulo_azul1("Asignar Recogida",1,0,0);  
// // 	$FB->titulo_azul1("Fecha Recogida",1,0,0);  
// // 	$FB->titulo_azul1("Operario Recoge",1,0,0); 
// // 	$FB->titulo_azul1("Recogio?",1,0,0); 
// // 	$FB->titulo_azul1("Valido",1,0,0); 
// // 	$FB->titulo_azul1("Descripcion",1,0,0); 
// // 	$FB->titulo_azul1("Fecha Va",1,0,0); 
// // 	$FB->titulo_azul1("Imagen",1,0,0); 

// // 	$conde2="";
// // }else {
// // 	$conde2=" and (gas_iduserrecoge='$id_usuario' or gas_iduserremesa='$id_usuario'  )"; 
// // }
// // if($nivel_acceso==1){
// // 	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
// // 	}

//   $sql="SELECT `idgastos`, `gas_fecharegistro`, `usu_nombre`, `gas_idciudadori`, `sed_nombre`, `gas_empresa`, `gas_bus`, `gas_telconductor`,`gas_pagar`,`gas_iduserremesa`, `gas_nomremesa`,
//   `gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,gas_usucom,gas_cantcom,gas_feccom ,gas_idciudaddes,gas_iduserrecoge,gas_recogio,gas_entrego,gas_fecrecogida,`gas_descrecogio`, `gas_nomvalida`, `gas_fechavalida`
//   FROM `gastos` inner join usuarios on gas_idusuario=idusuarios inner join sedes on idsedes=gas_idciudaddes
//    WHERE idgastos>0  $conde1 $conde2 $conde3 ORDER BY $conde, $ord $asc";
// $DB1->Execute($sql); $va=0;
// while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
// {
// 	$id_p=$rw1[0];
// 	$va++; $p=$va%2;
// 	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
// 		if($rw1[16]!='' or $rw1[16]>0){
// 			$rw1[16]=number_format($rw1[16],0,".",".");
// 		}
// 		$rw1[16]=number_format($rw1[16],0,".",".");

// 		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[3]'";
// 		$DB->Execute($sql2);
// 		$rw=mysqli_fetch_row($DB->Consulta_ID);
// 		if($rw1[21]==0){
// 			$entrego='Sin Recoger';

// 		} else if($rw1[21]==1){
// 			$entrego='SI';

// 		} else if($rw1[21]==2){
// 			$entrego='Devuelto';
// 		}

// 	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
// 		echo "<td>".$rw1[1]."</td>
// 		<td>".$rw1[2]."</td>
// 		<td>".$rw[1]."</td>
// 		<td>".$rw1[4]."</td>
// 		<td>".$rw1[5]."</td>
// 		<td>".$rw1[6]."</td>
// 		<td>".$rw1[7]."</td>
		
// 		<td>".$rw1[8]."</td>
// 		<td>".$rw1[10]."</td>
// 		<td>".$entrego."</td>
// 		<td>".$rw1[11]."</td>
// 		<td>".$rw1[12]."</td>
// 		<td>".$rw1[13]."</td>
// 		<td>".$rw1[14]."</td>
		

// 		";
		
// 		if($nivel_acceso==1){
// 			echo "<td align='center' >
// 			<a  onclick='pop_dis10($id_p,\"Aprobar\",1)';  style='cursor: pointer;' title='Aprobar' ><img src='img/Confirmar1.png'></a></td>";
// 		}else if($rw1[16]<=0){
// 			echo "<td align='center' >Pendiente por Aprobar
// 			</td>";
// 		}else {
// 			echo "<td align='center' >Solicitud  Aprobada
// 			</td>";
// 		}
		
// 		echo "<td>".$rw1[15]."</td>
// 		<td>".$rw1[16]."</td>
// 		<td>".$rw1[17]."</td>
// 		";
// 		if($nivel_acceso!=3){  

// 			if($rw1[15]!=''){
// 				echo "<td align='center' >";
// 				echo "<a  onclick='pop_dis24($id_p,\"asignar remesa\",$rw1[18])';  style='cursor: pointer;' title='Asignar Remesa' ><img src='img/paquete.png'></a></td>";
// 			}else{
// 				echo "<td align='center' >Pendiente por Aprobar
// 			</td>";
// 			}

// 				$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[19]' ";
// 				$DB->Execute($sql5);
// 				$nombreuser=$DB->recogedato(1);
				
// 				echo "<td>".$rw1[22]."</td>";
// 				echo "<td>".$nombreuser."</td>";
// 				if($rw1[20]==0){
// 					$recogio='Sin Recoger';

// 				}else if($rw1[20]==1){
// 					$recogio='Si';

// 				} else if($rw1[20]==2){
// 					$recogio='Devuelto';
// 				}
// 		}
// 		echo "<td>".$recogio."</td>
// 		<td>".$rw1[24]."</td>
// 		<td>".$rw1[23]."</td>
// 		<td>".$rw1[25]."</td>
// 		";
// 		$LT->llenadocs2($DB, "gastos", $id_p, 2, 35, 1);
// 	if($nivel_acceso==1){
// 		$DB->edites($id_p, "remesas", 2, $condecion);
// 	}
// 	echo "</tr>";
// }
// $FB->titulo_azul1("Formulario de Reclamos ","2","0", 4); 
$FB->titulo_azul1("Carga de archivos",15,0,7);

$FB->llena_texto("Nombre Archivo:", 16, 82, $DB, $nombrearchivo, "", "", 2, 1);
$FB->llena_texto("Selecion el archivo a cargar ", 8, 6, $DB, "", "", "",1,0);
	

	// $FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$fechaactual", 2, 1);
	$FB->llena_texto("Proveedor:", 9, 82, $DB, $tiporeclamo, "", "", 2, 1);
	echo "<td><button type='submit' class='btn btn-primary btn-lg'>Cagar Archivo </button></td>";
	echo'<a href="gastos.php" class="btn btn-light">Regresar</a>';
	// $FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "", 1, 1);
	// $FB->llena_texto("telefono:", 5, 1, $DB, "", "", "", 1, 1);
	// $FB->llena_texto("E-mail:", 6, 111, $DB, "", "", "", 1, 1);
	// $FB->llena_texto("Ciudad donde quiere recibir la notificacion:", 1, 1, $DB, "", "", "", 1, 1);
	// $FB->llena_texto("Direccion donde quiere recibir la notificacion:",9, 1, $DB, "", "", "", 1, 1);
	// $FB->llena_texto("Descripcion de Reclamo:<br> Por favor coloque una descripcion <br>del paquete y su contenido", 7,9, $DB, "", "", "", 2, 1);
	// $FB->llena_texto("Numero De Guia Completo<br> lo encontrara en la parte superior del recibo",2, 1, $DB, "", "", "",2,1);
	// $FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);



			// echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(29);'  >Validar Guia </button></td></tr>";	
   //          $FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);

	

	$FB->llena_texto("param10", 1, 13, $DB, "", "0", 0, 5, 0);	

	








include("footer.php"); ?>

<!-- <div class="alert alert-warning alert-dismissable">

  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><h5>¡Descarga y lee!<h5/></strong> 
  	<a href="http://pruebas.transmillaslogin.com/uploaded/politicapdf6735738.pdf" target="_blank" class="btn btn-primary btn-lg">Descargar contrato Cliente  <span class="glyphicon glyphicon-download"></span></a>
</div> -->
 <script>

           

          </script>
