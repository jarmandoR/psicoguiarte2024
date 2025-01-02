<?php
require("login_autentica.php"); 
$id_nombre=$_SESSION['usuario_nombre'];
@$id_usuario=$_REQUEST["id_usuario"];
@$dir=$_REQUEST["dir"];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();

$DB1 = new DB_mssql;
$DB1->conectar();

// $_REQUEST["param99"];
 $cond="";

 if($dir=='devoluciones.php'){
	 
	$sql3="UPDATE `guias` SET `gui_userdevolucion`='$id_nombre',`gui_fechadevolucion`='$fechatiempo' WHERE `gui_idservicio`='$id_param'";
	$DB->Execute($sql3);
	
	 $sql="UPDATE `servicios` SET ser_idverificadopeso=1,ser_llego='SI',`ser_estado`='8' WHERE `idservicios`=$id_param";

}

$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
$param5 = str_replace('&0&','&&', $param5);
 
 
 	 $sql11="UPDATE `clientesservicios` SET  `cli_nombre`='$param6', `cli_telefono`='$param2',`cli_idciudad`='$param4', 
	 `cli_direccion`='$param5',  `cli_idclientes`='$id_param', `cli_principal`='1' where `idclientesdir`='".$_REQUEST['id_param0']."'";
	$DB->Execute($sql11);

$param10=$param10."&".$param101."&".$param21."&".$param22."&".$param24."&"; 
$param10 = str_replace('&0&','&&', $param10);	
	
	$sql3="UPDATE `guias` SET `gui_useredita`='$id_nombre',`gui_fechaedita`='$fechatiempo' WHERE `gui_idservicio`='".$_REQUEST['id_param2']."'";
	$DB->Executeid($sql3); 	

	
		$param177=str_replace(".","", $param17);
		$param166=str_replace(".","", $param16);
		$param188=str_replace(".","", $param18);
		
/* 		$sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$param166' and `pre_final`>='$param166'";
		$DB->Execute($sql);
		$porprestamo=$DB->recogedato(0);
		$dosporcentaje=explode(" ",$porprestamo); 

		if(@$dosporcentaje[1]=='%'){
			$porprestamo=($param166*@$dosporcentaje[0])/100;
		} */
		@$precio=valorguia($DB,$param4,$param11,$param37,$param28,$param26,$param27);
		@$porprestamo=porprestamo($DB,$param166);
		$pordeclarado=(intval($param188)*1)/100;

		$param111=$precio;

		if($param28==2){
			$param111=0;
				$sqlc="SELECT rel_nom_credito,idcreditos FROM `rel_sercre`  inner join creditos on cre_nombre=rel_nom_credito where rel_nom_credito='$param113' ";
		  $DB->Execute($sqlc);
		  $rw21=mysqli_fetch_row($DB->Consulta_ID); 
		   $creditouser=$rw21[0];
		   $idcredito=$rw21[1];
		
		   $sql3="SELECT `pre_preciokilo`,`pre_precioadicional` FROM `precios_credito` WHERE `pre_idciudadori`='$param4'  and `pre_idciudades`='$param11' and pre_tiposervicio='$param37' and pre_idcredito='$idcredito' ";
		  $DB->Execute($sql3);
		  $rw2=mysqli_fetch_row($DB->Consulta_ID);  
		
		  @$preciokilo=$rw2[0];
		  @$precioadicional=$rw2[1];
		
		  $kilosvolumen=$param26+$param27;
		   
		  if($kilosvolumen>3){
		  
			  @$precio1=($kilosvolumen-3)*$precioadicional;
			  @$param111=$preciokilo+$precio1;
		  
		  }else {
		  
			  @$param111=$preciokilo;	
		  
		  }
		  if($param111==''){
			$param111=0;
		  }
			  
		}

 		$sql="SELECT `cue_idservicio` FROM `cuentaspromotor` where cue_idservicio='".$_REQUEST['id_param2']."'";
		$DB->Execute($sql);
		$vercuentas=$DB->recogedato(0);
		if($vercuentas=="" and $param15='Envio Oficina'){

			$sql="SELECT `gui_idusuario` FROM `guias` WHERE gui_idservicio='".$_REQUEST['id_param2']."'";
			$DB->Execute($sql);
			$userid=$DB->recogedato(0);

			$sql2="INSERT INTO `cuentaspromotor`(`cue_idservicio`,`cue_idoperador`,cue_numeroguia,cue_fecharecogida) 
		   VALUES ('".$_REQUEST['id_param2']."','$userid','$param34','$fechatiempo')";
		   $DB1->Execute($sql2);
	   
		} 
	
	   $sql22="UPDATE `cuentaspromotor` SET  `cue_abono`='$param177', `cue_porprestamo`='$porprestamo', `cue_prestamo`='$param166',
	 `cue_vrdeclarado`='$param188',`cue_pordeclarado`='$pordeclarado',cue_tipopago='$param15',cue_tipoevento='$param28',cue_valorflete='$param111',cue_pendientecobrar='$param112',cue_idciudaddes='$param11',cue_idciudadori='$param4' where cue_idservicio='".$_REQUEST['id_param2']."'";
		$DB1->Execute($sql22);			

		$sql1="UPDATE `servicios` SET `ser_iddocumento`='$param7',`ser_telefonocontacto`='$param8',`ser_destinatario`='$param9',`ser_direccioncontacto`='$param10',`ser_ciudadentrega`='$param11',`ser_tipopaquete`='$param12',`ser_paquetedescripcion`='$param13',`ser_fechaentrega`='$param14',ser_prioridad='$param15',`ser_valorprestamo`='$param16',`ser_valorabono`='$param177',`ser_valorseguro`='$param18'
		,ser_guiare='$param34',ser_fecharegistro='$param35',ser_peso='$param26',ser_volumen='$param27',ser_piezas='$param30',ser_descripcion='$param31',ser_verificado='$param32',ser_tipopaq='$param33',ser_clasificacion='$param28',ser_valor='$param111',ser_pendientecobrar='$param112',ser_valorpendiente='$param36' $cond WHERE `idservicios`='".$_REQUEST['id_param2']."'";
		$DB->Execute($sql1); 

		$sql21="UPDATE guias  SET gui_tiposervicio='$param37'  where gui_idservicio='".$_REQUEST['id_param2']."'";
		$DB->Execute($sql21); 

		if($param28==2){

			$sql23="DELETE FROM rel_sercre WHERE idservicio='".$_REQUEST['id_param2']."'";
			$DB1->Execute($sql23);

			$sql32="INSERT INTO rel_sercre (`idservicio`, `rel_nom_credito`) VALUES ('".$_REQUEST['id_param2']."','$param113')";
			$DB1->Execute($sql32);
		}


 if($dir=='devoluciones.php'){
	 
	$sql3="UPDATE `guias` SET `gui_userdevolucion`='$id_nombre',`gui_fechadevolucion`='$fechatiempo' WHERE `gui_idservicio`='".$_REQUEST['id_param2']."'";
	$DB->Execute($sql3);
	
	 $sql="UPDATE `servicios` SET ser_idverificadopeso=1,ser_llego='SI',`ser_estado`='8' WHERE `idservicios`='".$_REQUEST['id_param2']."'";
	 $DB->Execute($sql); 
}
 

	$DB->cerrarconsulta();
	$DB1->cerrarconsulta();


header ("Location:$dir?bandera=1");


?>