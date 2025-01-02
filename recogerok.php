<?php
require("login_autentica.php"); 
$id_nombre=$_SESSION['usuario_nombre'];
$id_usuario=$_SESSION['usuario_id'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
//echo $param1;
if($param1=='RECOGIDO'){

 //echo "ggg--".$param27."---";


if($param27!=''){
	$planilla=$param27;
}else{
	 $sql="SELECT `idconfac`, `idconsecutivo`, `idresolucion`, `prefijo` FROM `conf_fac`  inner join ciudades on idciudad=inner_sedes WHERE idciudades='$param13'";	
	$DB1->Execute($sql);
	$rw1=mysqli_fetch_array($DB1->Consulta_ID);	

	$planilla="$rw1[3]$rw1[1]";
	$idconsecutivo=$rw1[1]+1;

	if($idconsecutivo>=10){
		$sql2="UPDATE conf_fac inner join ciudades on idciudad=inner_sedes  SET `idconsecutivo`=$idconsecutivo  WHERE idciudades='$param13'";	
		$DB->Execute($sql2);
	}else{
		$planilla="";
	}
	
}

if($param25==''){
	$param25=$planilla;
}
	$cond="";
	$cond1="";
	$valortotal=0; 
	if($param12=='')
	{
		$param12=0;
	}
	if($param20=='')
	{
		$param20=0;
	}

	if($param8==1){  // dejar como pendiente por cobrar
		$cond=",`ser_peso`='$param10', `ser_pendientecobrar`='$param12'";

	} else if($param8==2){   //creditos y valor del credito 
		//$cond=",ser_pendientecobrar=2,`ser_valorpendiente`='$param10'";
		$cond=",ser_pendientecobrar=2 	";
		$param12=2;
	}else if($param8==3){   //devoluciones.
		//$cond=",ser_pendientecobrar=3,`ser_valorpendiente`='$param10'";
	}else if($param8==4){ 
		$cond=",`ser_peso`='$param10', `ser_pendientecobrar`='$param12'";
	}
	else {

		$cond="";
		//$param18="";
	}
	if($param17>0 and $param12==1){
		$cond=",ser_pendientecobrar=4,`ser_valorpendiente`='$param17'";
		$param12=4;

	}else if($param17>0){
		$cond=",ser_pendientecobrar=5,`ser_valorpendiente`='$param17'";
		$param12=5;
	}
	

//	echo "uuu--".$param18."---";
		//`ser_valorabono`='$param5',

	 $sql32="Select gui_tiposervicio from guias WHERE `gui_idservicio`='$id_param2'"; 
	$DB->Execute($sql32);
	$rw6=mysqli_fetch_row($DB->Consulta_ID); 
	if($rw6[0]==0 and $param8!=2){

	if($param8==1 and $param12==0 and $param10>=1){

		$sql3="SELECT `pre_kilo`,`pre_adicional` FROM `precios` WHERE `pre_idciudadori`='$param13'  and `pre_idciudaddes`='$param9'";
		$DB->Execute($sql3);
		$rw2=mysqli_fetch_row($DB->Consulta_ID); 
			$kilos=$param10+$param20;
			if($kilos>3){  
				$varor1=$rw2[0];  
				$valor2=($param10+$param20-3)*$rw2[1];  
				$valortotal=$varor1+$valor2;  
			 }else { $valortotal=$rw2[0];  }

					$cond1=",ser_valor='$valortotal'";
	} else if($param8==3) {
				//$valortotal=$param10;
				$valortotal=0;
				$cond1=",ser_valor='$valortotal'";
	}else	if($param8==4 and $param10>=1){

				$sql3="SELECT `pre_kilo`,`pre_adicional` FROM `precios` WHERE `pre_idciudadori`='$param13'  and `pre_idciudaddes`='$param9'";
				$DB->Execute($sql3);
				$rw2=mysqli_fetch_row($DB->Consulta_ID); 
					$kilos=$param10+$param20;
					if($kilos>3){  
						$varor1=$rw2[0];  
						$valor2=($param10+$param20-3)*$rw2[1];  
						$valortotal=$varor1+$valor2;  
					 }else { $valortotal=$rw2[0];  }
		
							$cond1=",ser_valor='$valortotal'";
	} 
			
			

	}else if($rw6[0]==1 and ($param8==1 or $param8==4)){ //carga especial opcion contado
		
		$sql33="SELECT tip_preciokilo,tip_precioadicional from tiposervicio WHERE `idtiposervicio`='$rw6[0]'"; 
		$DB->Execute($sql33);
		$rw7=mysqli_fetch_row($DB->Consulta_ID); 
		if($rw7[0]!=''){
			$varor1=$rw7[0];  $valor2=($param10+$param20-3)*$rw7[1];  $valortotal=$varor1+$valor2; 
		}else{
			$valortotal=0;
		}
		 $cond1=",ser_valor='$valortotal'";

	}else if($rw6[0]!=0 and $param8==2){

	/* 	$sqlc="SELECT rel_nom_credito,idcreditos FROM `rel_sercre` inner join creditos on cre_nombre=rel_nom_credito where idservicio=$id_param2 ";
		$DB->Execute($sqlc);
		$rw21=mysqli_fetch_row($DB->Consulta_ID); 
		 $creditouser=$rw21[0];
		 $idcredito=$rw21[1];

		$sql3="SELECT `pre_preciokilo`,`pre_precioadicional` FROM `precios_credito` WHERE `pre_idciudadori`='$rw[17]'  and `pre_idciudades`='$rw[18]' and pre_tiposervicio='$rw6[0]' and pre_idcredito='$idcredito' ";
		$DB->Execute($sql3);
		$rw2=mysqli_fetch_row($DB->Consulta_ID); 
	
		  if($param10>3){  
			$varor1=$rw2[0];  $valor2=($param10+$param20-3)*$rw2[1];  $valortotal=$varor1+$valor2; 
			} else { 
			  $valortotal=$rw2[0]; 
			 } 
			 $cond1=",ser_valor='$valortotal'"; */
			$valortotal=0;
			$cond1=",ser_valor='$valortotal'";

	}else {

		if($param8==1 and $param12==0 and $param10>=1){

			$sql3="SELECT `pre_kilo`,`pre_adicional` FROM `precios` WHERE `pre_idciudadori`='$param13'  and `pre_idciudaddes`='$param9'";
			$DB->Execute($sql3);
			$rw2=mysqli_fetch_row($DB->Consulta_ID); 
	
			$kilos=$param10+$param20;
			if($kilos>3){   
				$varor1=$rw2[0];  
				$valor2=($param10+$param20-3)*$rw2[1];  
				$valortotal=$varor1+$valor2;   
			}else { $valortotal=$rw2[0];  }
	
						$cond1=",ser_valor='$valortotal'";
				} else if($param8==3) {
					//$valortotal=$param10;
					$valortotal=0;
					$cond1=",ser_valor='$valortotal'";
				}else if($param8==4 and $param10>=1) {
				
					$sql3="SELECT `pre_kilo`,`pre_adicional` FROM `precios` WHERE `pre_idciudadori`='$param13'  and `pre_idciudaddes`='$param9'";
					$DB->Execute($sql3);
					$rw2=mysqli_fetch_row($DB->Consulta_ID); 
			
					$kilos=$param10+$param20;
					if($kilos>3){   
						$varor1=$rw2[0];  
						$valor2=($param10+$param20-3)*$rw2[1];  
						$valortotal=$varor1+$valor2;   
					}else { $valortotal=$rw2[0];  }
	
						$cond1=",ser_valor='$valortotal'";

				}


	}

		 $param14=str_replace(".","", $param14);
		
		// prestamos...
		if($param16!=''){
			$param16=str_replace(".","", $param16);
		}else{
			$param16=0;
		}
		
		$param6=str_replace(".","", $param6);
		if($param16!=''){
			 $sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$param16' and `pre_final`>='$param16'";
			$DB->Execute($sql);
			$porprestamo=$DB->recogedato(0);
			$dosporcentaje=explode(" ",$porprestamo); 
	
			if(@$dosporcentaje[1]=='%'){
				$porprestamo=($param16*@$dosporcentaje[0])/100;
			}
			
		}else {
			$porprestamo=0;
		}

		$pordeclarado=(intval($param6)*1)/100;

	$sql21="DELETE FROM `cuentaspromotor` WHERE  cue_idservicio=$id_param2";
	$DB1->Execute($sql21);	
	
	if($nivel_acceso==1){
		$fechatiempo=$param28;
		$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$param18' and  (usu_estado=1 or usu_filtro=1)";
		$DB->Execute($sql5);
		$id_nombre=$DB->recogedato(1);
		
		//$param18=$id_usuario;
	} else if($nivel_acceso!=3 and $nivel_acceso!=1){

		$param18=$id_usuario;

	}

	/* $sql31="DELETE FROM `rel_sercre` WHERE  idservicio=$id_param2";
	$DB1->Execute($sql31);	 */

/* 	$sql32="INSERT INTO rel_sercre (`idservicio`, `rel_nom_credito`) VALUES ($id_param2,'$param113')";
	$DB1->Execute($sql32); */


	 $sql2="INSERT INTO `cuentaspromotor`(`cue_idservicio`,`cue_idoperador`,`cue_abono`, `cue_porprestamo`, `cue_prestamo`,
	 `cue_vrdeclarado`,`cue_pordeclarado`,  `cue_valorflete`,  `cue_tipopago`, `cue_pendientecobrar`,  `cue_fecha`,`cue_valpagar`,cue_estado, `cue_idciudadori`, `cue_idciudaddes`, `cue_tipoevento`, `cue_numeroguia`, `cue_fecharecogida`) 
	VALUES ('$id_param2','$param18','$param14',$porprestamo,'$param16','$param6','$pordeclarado','$valortotal','$param15','$param12','$fechatiempo','$param17','4','$param13','$param9','$param8','$planilla','$fechatiempo')";
	$DB1->Execute($sql2);

	 $sql3="UPDATE `guias` SET `gui_recogio`='$id_nombre',`gui_fecharecogio`='$fechatiempo' WHERE `gui_idservicio`='$id_param2'";
		$DB->Execute($sql3);
	if($param29==''){ $param29=0;}


	$sql1="UPDATE `servicios` SET `ser_consecutivo`='$planilla',`ser_resolucion`='$rw1[2]',`ser_recogida`='$param1',  `ser_piezas`='$param2', `ser_paquetedescripcion`='$param3', `ser_valorseguro`='$param6', `ser_horaentrega`='$param7', `ser_clasificacion`='$param8',`ser_fechafinal`='$fechatiempo',`ser_fechaasignacion`='$fechatiempo',`ser_estado`='4',ser_devolverreci='$param29',ser_tipopaq='$param21',ser_verificado='$param19',ser_volumen='$param20',ser_guiare='$param25',ser_descripcion='$param26',`ser_valorabono`='$param14',ser_idresponsable='$param18'  $cond1 $cond WHERE `idservicios`=$id_param2";
	
	if($nivel_acceso==3){
		
		$dir="ticketfactura.php";
		$pagina2="asignaciones.php";
		
	}else {
		$dir="recogerpaquete.php";
		$pagina2="recogerpaquete.php";
		
	}

}
else if($param1=='NO RECOGIDO'){
	
	if($nivel_acceso==3){
			
			$dir="asignaciones.php";
			$pagina2="asignaciones.php";
		}else {

			$dir="recogerpaquete.php";
			$pagina2="recogerpaquete.php";
			$cond3=",ser_idresponsable='$id_usuario'";
		}

		$sql2="DELETE FROM `cuentaspromotor` WHERE  cue_idservicio=$id_param2";
		$DB1->Execute($sql2);	
		
		 $sql3="UPDATE `guias` SET `gui_recogio`='$id_nombre',`gui_fecharecogio`='$fechatiempo' WHERE `gui_idservicio`='$id_param2'";
			$DB->Execute($sql3);
			$descripcion=$id_nombre.": ".$param2;
			$sql1="UPDATE `servicios` SET ser_esatdollamando='',`ser_recogida`='$param1', `ser_motivo`='$descripcion',ser_descllamada='$descripcion',`ser_estado`='5',`ser_fechaasignacion`='$fechatiempo' $cond3 WHERE `idservicios`=$id_param2";
			
		
		
	}
else if($param1=='EDITAR DATOS'){
	
 	$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
$param5 = str_replace('&0&','&&', $param5);
	
	if($_REQUEST['encomiendas']==0){
	 $sql11="UPDATE `clientesservicios` SET  `cli_nombre`='$param6', `cli_telefono`='$param2',`cli_idciudad`='$param4', 
	 `cli_direccion`='$param5' where `idclientesdir`='".$_REQUEST['id_param0']."'";
	$DB->Execute($sql11);
	}

	$param10=$param10."&".$param101."&".$param21."&".$param22."&".$param24."&"; 
	$param10 = str_replace('&0&','&&', $param10);	
	 $sql1="UPDATE `servicios` SET `ser_telefonocontacto`='$param8',`ser_destinatario`='$param9',`ser_direccioncontacto`='$param10',`ser_ciudadentrega`='$param11' WHERE `idservicios`='".$_REQUEST['id_param2']."'";
	$DB->Execute($sql1);

    $sql3="UPDATE `guias` SET `gui_useredita`='$id_nombre',`gui_fechaedita`='$fechatiempo' WHERE `gui_idservicio`='".$_REQUEST['id_param2']."'";
	$DB->Executeid($sql3); 
	if($dir!=''){

		$pagina2=$dir;

	}else if($nivel_acceso==3){
		
		$dir="asignaciones.php";
		$pagina2="asignaciones.php";
		
	}else if($id_param1=='recogidas') {
		$dir="recogidas.php";
		$pagina2="recogidas.php";
		
	}else  {
		$dir="recogerpaquete.php";
		$pagina2="recogerpaquete.php";
		
	}
		
}
else if($param1=='ENTREGADO'){
	$iduserentrega=$_REQUEST["iduserentrega"];
	$id_usuario2=$id_usuario;
	$id_nombre2=$id_nombre;


	if($iduserentrega==''){

		$iduserentrega=$id_usuario2;
	}
if($nivel_acceso==1){

	$fechatiempo=$param28;
	$fechaactual=$param28;

	$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$iduserentrega' ";
	$DB->Execute($sql5);
	$id_nombre2=$DB->recogedato(1);
	
	$id_usuario2=$iduserentrega;
} 



//if($param10!=1){	
$sql2="UPDATE `cuentaspromotor` SET `cue_idoperentrega`='$id_usuario2', `cue_fecha`='$fechatiempo', cue_estado='10'  where cue_idservicio=$id_param2";
$DB1->Execute($sql2);		
//}	

	$sql3="UPDATE `guias` SET `gui_userecomienda`='$id_nombre2',`gui_fechaentrega`='$fechatiempo' WHERE `gui_idservicio`='$id_param2'";
	$DB->Execute($sql3);
	if($param19>=1){
		$param19=str_replace(".","", $param19);
		$sql4="INSERT INTO `abonosguias`(`abo_fecha`, `abo_valor`, `abo_idservicio`, `abo_iduser`, `abo_idsede`, `abo_estado`)  VALUES ('$fechatiempo','$param19','$id_param2','$id_usuario','$id_sedes','devolucion')";
		$DB->Execute($sql4);
	}
 $sql1="UPDATE `servicios` SET `ser_estentrega`='$param1',ser_fechafinal='$fechatiempo',ser_fechaguia='$fechatiempo',`ser_estado`='10' WHERE `idservicios`=$id_param2";





 if($nivel_acceso==3){
		
		$dir="ticketfactura.php";
		$pagina2="inicio.php";
	}else {
			$dir="entregas.php";
			$pagina2="entregas.php";
		}
	
	
		
}	else if($param1=='NO ENTREGADO'){

		
		$sql2="UPDATE `cuentaspromotor` SET `cue_idoperentrega`='0', `cue_fecha`='$fechatiempo', cue_estado='11'  where cue_idservicio=$id_param2";
	$DB1->Execute($sql2);

	$sql3="UPDATE `guias` SET `gui_userecomienda`='$id_nombre',`gui_fechaentrega`='$fechatiempo' WHERE `gui_idservicio`='$id_param2'";
	$DB->Execute($sql3);	
		
	$sql1="UPDATE `servicios` SET `ser_estentrega`='$param1',ser_idverificadopeso=0,ser_fechafinal='$fechatiempo',ser_fechaguia='$fechatiempo', `ser_descentrega`='$param2',`ser_estado`='11' WHERE `idservicios`=$id_param2";
	
	if($nivel_acceso==3){
		
		$dir="inicio.php";
		$pagina2="inicio.php";
		
	}else {
		$dir="entregas.php";
		$pagina2="entregas.php";
		
	}
}

$tabla="";
if ($DB->Execute($sql1))
		{
		$bandera=1;	
		}
	else{ $bandera=6; }

 	$DB->cerrarconsulta();
	$DB1->cerrarconsulta();
//pop_dis3($id_p,\"Recoger Paquete\")
//exit;
header ("Location: $dir?pagina2=$pagina2&bandera=$bandera&tabla=$tabla&id_param=$id_param2");
?>

