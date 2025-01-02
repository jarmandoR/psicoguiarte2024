<?php
require("login_autentica.php"); 
include("declara.php");
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];


@$variableunica=$_REQUEST["variableunica"];

// $sql="SELECT `ser_guiare` FROM `servicios` WHERE ser_idregistro='$variableunica'; ";		
// $DB1->Execute($sql);
// $idregistro=$DB1->recogedato(0); 

// if($idregistro==''){  


// @$id_usuario=$_REQUEST["id_usuario"];


// //@$precio=$_REQUEST["precio"];
// //@$pordeclarado=$_REQUEST["pordeclarado"];
// //@$porprestamo=$_REQUEST["porprestamo"];
// @$precio=valorguia($DB,$param4,$param11,$param37,$param28,$param26,$param27);
// @$porprestamo=porprestamo($DB,$param16);
// $param17=str_replace(".","", $param17);
// $param18=str_replace(".","", $param18);
// @$pordeclarado=(intval($param18)*1)/100;



// if($param11!=$param4){
//  $sql3="SELECT inner_sedes FROM `ciudades` where idciudades in ($param11,$param4)";
//  $DB1->Execute($sql3);
//  $ver=0;
// while($rw3 = mysqli_fetch_row($DB1->Consulta_ID)) {
// 	$sedes[$ver]=$rw3[0];
// 	$ver++;
// 	}
// if($sedes[0]==$sedes[1]){   $estado=6; } else { $estado=6; }
// 	if($param28=='2'){ $param78=2; } else { $param78=0; }
// } else {
	
// 	$estado=6; 
// }	
// if($nivel_acceso==3){  $estado=4;  $param15="Recogida Operador"; }	
 
// $param10=$param10."&".$param101."&".$param21."&".$param22."&".$param24."&"; 
// $param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
	

// $param5 = str_replace('&0&','&&', $param5);
// $param10 = str_replace('&0&','&&', $param10);

// if($id_param==0 and $id_param==0){

// 	$sql1="INSERT INTO `clientes`( `cli_iddocumento`,  `cli_email`, `cli_clasificacion`, `cli_retorno`,`cli_tipo`, `cli_fecharegistro`) 
// 	VALUES ('$param1','$param3','$param78',$param25,2,'$fechatiempo')";
// 	$idexec=$DB1->Executeid($sql1);

// 	$sql="INSERT INTO `clientesdir`(`cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
// 	VALUES ('$param6','$param2','$param4','$param5','$idexec',1)";
// 	$idcli=$DB1->Executeid($sql);

// }else {
// $idcli=$_REQUEST['id_param2'];	
//  	 $sql1="UPDATE `clientes` SET  `cli_iddocumento`='$param1',`cli_email`='$param3', `cli_clasificacion`='$param78',
// 	`cli_tipo`='2', `cli_fecharegistro`='$fechatiempo',`cli_retorno`=$param25  WHERE `idclientes`='$id_param'";
// 	$DB->Execute($sql1);

// 	 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param6', `cli_telefono`='$param2',`cli_idciudad`='$param4', `cli_direccion`='$param5',
// 	  `cli_idclientes`='$id_param', `cli_principal`=1 where `idclientesdir`='".$_REQUEST['id_param2']."'";
// 	$DB->Execute($sql);
	
// 		$idexec=$id_param;

// }

// 	 $sql2="INSERT INTO `clientesservicios` (`cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
// 	VALUES ('$param6','$param2','$param4','$param5','$idexec',1)";
// 	$idcli2=$DB->Executeid($sql2);

// if($param8!=''){

// 	 $sql3="SELECT idclientes From clientes inner join clientesdir on cli_idclientes=idclientes where cli_telefono='$param8'";
// 	$DB->Execute($sql3);
// 	$valorinser=$DB->recogedato(0);
// 	if($valorinser<=0){

// 		 $sql1="INSERT INTO `clientes`(`cli_tipo`, `cli_iddocumento`,  `cli_email`,`cli_fecharegistro`) 
// 		VALUES (0,'$param7','','$fechatiempo')";
// 		$idexec=$DB1->Executeid($sql1);

// 		 $sql5="INSERT INTO `clientesdir`(`cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
// 		VALUES ('$param9','$param8','$param11','$param10','$idexec',0)";
// 		$DB1->Execute($sql5);


// 	}else {
		
// 		 $sql1="UPDATE `clientes` SET  `cli_tipo`='0', `cli_fecharegistro`='$fechatiempo', `cli_iddocumento`='$param7'  WHERE `idclientes`='$valorinser'";
// 		$DB->Execute($sql1);

// 		 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param9', `cli_telefono`='$param8',`cli_idciudad`='$param11', 
// 		 `cli_direccion`='$param10',   `cli_principal`=0 where cli_idclientes='$valorinser' ";
// 		$DB->Execute($sql);
		
// 	}
// }

//  	$sql="SELECT `idconfac`, `idconsecutivo`, `idresolucion`, `prefijo` FROM `conf_fac` inner join ciudades on idciudad=inner_sedes WHERE idciudades='$param4'";	
// 	$DB1->Execute($sql);
// 	$rw1=mysqli_fetch_array($DB1->Consulta_ID);	
// 	$planilla="$rw1[3]$rw1[1]";
// 	$idconsecutivo=$rw1[1]+1;
// 	if($idconsecutivo>=10){
//   		 $sql2="UPDATE `conf_fac` c inner join ciudades cc on c.idciudad=cc.inner_sedes SET c.`idconsecutivo`=$idconsecutivo   WHERE cc.idciudades='$param4'";	
// 		 $DB->Execute($sql2);
// 	}else{
// 		$planilla="";
// 	}

// 	if($param16==''){
// 		$param16=$planilla;
// 	}
 
//  $param17=str_replace(".","", $param17);
//  if($param112==''){  $param112=0; }


//  if($param28==2){
// 	$precio=0;
// 		$sqlc="SELECT rel_nom_credito,idcreditos FROM `rel_sercre`  inner join creditos on cre_nombre=rel_nom_credito where rel_nom_credito='$param113' ";
//   $DB->Execute($sqlc);
//   $rw21=mysqli_fetch_row($DB->Consulta_ID); 
//    $creditouser=$rw21[0];
//    $idcredito=$rw21[1];

//    $sql3="SELECT `pre_preciokilo`,`pre_precioadicional` FROM `precios_credito` WHERE `pre_idciudadori`='$param4'  and `pre_idciudades`='$param11' and pre_tiposervicio='$param34' and pre_idcredito='$idcredito' ";
//   $DB->Execute($sql3);
//   $rw2=mysqli_fetch_row($DB->Consulta_ID);  

//   @$preciokilo=$rw2[0];
//   @$precioadicional=$rw2[1];

//   $kilosvolumen=$param26+$param27;
   
//   if($kilosvolumen>3){
  
// 	  @$precio1=($kilosvolumen-3)*$precioadicional;
// 	  @$precio=$preciokilo+$precio1;
  
//   }else {
  
// 	  @$precio=$preciokilo;	
  
//   }

	  
// }

// if($precio=='' or $precio==null){
// 	$precio=0;
//   }
  
// if($param27==''){
// 	$param27=0;
// }

//  if($nivel_acceso==3){ 

// 	$sql1="INSERT INTO `servicios` (`ser_iddocumento`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`, 
// 	`ser_guiare`, `ser_valorabono`, `ser_valorseguro`,  `ser_fecharegistro`,`ser_peso`,ser_volumen,ser_idverificado,ser_idresponsable,ser_valor,`ser_estado`,ser_visto,ser_consecutivo,ser_pendientecobrar,ser_fechafinal,ser_clasificacion,ser_idverificadopeso,ser_piezas,ser_descripcion,ser_verificado,ser_tipopaq,ser_idregistro,ser_devolverreci,ser_fechaasignacion) 
//    VALUES  ('$param7','$param8','$param9','$param10','$param11','$param12','$param13','$param14','$param15','$param16','$param17','$param18','$fechatiempo','$param26',$param27,$id_usuario,$id_usuario,$precio,$estado,0,'$planilla',$param112,'$fechatiempo','$param28',0,'$param30','$param31','$param32','$param33','$variableunica','$param25','$fechatiempo')";
//    $idser=$DB->Executeid($sql1);

//  }else {
	echo$sql1="INSERT INTO `informeGestion`( `infig_Fecha`, `infig_horaInicio`, `infig_horaFin`, `infig_encuentroN`, `infig_paciente`, `infig_objTra`, `infig_estrategia`, `infig_resumEncue`, `infig_firmaProf`, `infig_proxEncuen`) VALUES ('$param1','$param2','$param3','$param4','$param5','$param6','$param7','$param8','$param9','$param10')";

   $idser=$DB->Executeid($sql1);
//  }
 
//   $sql2="INSERT INTO `rel_sercli`(`ser_idclientes`, `ser_idservicio`, `ser_fechaingreso`) VALUES ($idcli2,$idser,'$fechatiempo')";
//   $DB1->Execute($sql2);
  
//   //echo "joseee111";
//     $sql3="INSERT INTO `guias`(`gui_idservicio`,`gui_idusuario`,`gui_usucreado`, `gui_fechacreacion`,`gui_recogio`, `gui_fecharecogio`,gui_tiposervicio,gui_usuvalida,gui_fechavalidacion,gui_usurecogida,gui_fecharecogida) 
// 		VALUES ($idser,'$id_usuario','$id_nombre','$fechatiempo','$id_nombre','$fechatiempo','$param34','$id_nombre','$fechatiempo','$id_nombre','$fechatiempo')";
// 	$DB->Executeid($sql3); 
  
// 	if($param17>0){
// 		$sql33="INSERT INTO `abonosguias`(`abo_fecha`, `abo_valor`, `abo_idservicio`, `abo_iduser`, `abo_idsede`, `abo_estado`)  VALUES ('$fechatiempo','$param17','$idser','$id_usuario','$id_sedes','abono')";
// 		$DB->Executeid($sql33);
// 	}

//   	$param18=str_replace(".","", $param18);
// 	//$param16=str_replace(".","", $param16);


// 	$sql31="DELETE FROM `rel_sercre` WHERE  idservicio=$idser";
// 	$DB1->Execute($sql31);	

// 	$sql32="INSERT INTO rel_sercre (`idservicio`, `rel_nom_credito`) VALUES ($idser,'$param113')";
// 	$DB1->Execute($sql32);
// 	//echo "joseee";
//    $sql2="INSERT INTO `cuentaspromotor`(`cue_idservicio`,`cue_idoperador`,`cue_abono`, `cue_porprestamo`, `cue_prestamo`,
// 	 `cue_vrdeclarado`,`cue_pordeclarado`,  `cue_valorflete`,  `cue_tipopago`,  `cue_fecha`,`cue_valpagar`,cue_estado, `cue_idciudadori`, `cue_idciudaddes`, `cue_tipoevento`, `cue_numeroguia`, `cue_fecharecogida`, `cue_pendientecobrar`) 
// 	VALUES ('$idser','$id_usuario','$param17','$porprestamo','0','$param18','$pordeclarado','$precio','$param15','$fechatiempo','$param26','4','$param4','$param11','$param28','$planilla','$fechatiempo','$param112')";
// 	$DB->Execute($sql2);

// 	if($param28==4 and $_FILES["param110"]!=''){
	
// 		$QL->addDocumento1($_FILES["param110"], 1, "datafono", $idser, "datafono", $DB);// datafono
		
// 	}

	$DB->cerrarconsulta();
	$DB1->cerrarconsulta();
// 	//$guia!=''

// 	if($nivel_acceso!=3){
// //header ("Location: inicio1.php?param15='$param15'");
// 		header ("Location: imprimirfactura.php?param15='reenviar'&id_param=$idser");
// 	} else {
		
// 		$pagina2="configuracion.php?idmen=163";
// 		header ("Location: ticketfactura.php?pagina2=$pagina2&id_param=$idser");
// 	}

//  }else {

	header ("Location: inicio.php");
// }  

?>