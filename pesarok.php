<?php
require("login_autentica.php"); 
$id_sedes= $_SESSION['usu_idsede'];
$id_usuario= $_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();

$dato=1;

 $sql="SELECT `idprecios`, `pre_kilo`, `pre_adicional`,pre_idciudaddes FROM `precios`
  where pre_idciudadori=$param5  and pre_idciudaddes=$param16";
 $DB->Execute($sql);

$rw = mysqli_fetch_row($DB->Consulta_ID); 

@$preciokilo=$rw[1];
@$precioadicional=$rw[2];
 @$serciudad=$param16;
//$id_ciudad="";
$llego="";
if(@$serciudad>0){

if($param5!=$serciudad){
  $sql3="SELECT inner_sedes FROM `ciudades` where idciudades in ($param5,$serciudad)";
 $DB1->Execute($sql3);
 $ver=0;
while($rw3 = mysqli_fetch_row($DB1->Consulta_ID)) {
	$sedes[$ver]=$rw3[0];
	$ver++;
	}
if($sedes[0]==$sedes[1]){  $estado=8; $llego=",ser_llego='SI'"; } else { $estado=6; $llego=""; }
} else {
	
	$estado=8; $llego=",ser_llego='SI'";
	
}

 @$caso=$_REQUEST["caso"];

if($caso==1){ 

//$param3=0; 
	if($nivel_acceso==3){
		$pagina='ticketfactura.php'; 
		$pagina2="pesarmovil.php";
	}else {
		$pagina='peso.php'; 
		$pagina2="peso.php";
	}
 $sql3="UPDATE `guias` SET `gui_usupeso`='$id_nombre',`gui_fechapeso`='$fechatiempo' WHERE `gui_idservicio`='$id_param2'";
$DB->Execute($sql3); 

} else {  
		$sql3="UPDATE `guias` SET `gui_usuvalpeso`='$id_nombre',`gui_fechavalpeso`='$fechatiempo' WHERE `gui_idservicio`='$id_param2'";
		$DB->Execute($sql3); 

		$pagina2='ticketfacturatodos.php'; 
		$pagina='verificarpeso.php'; 

 }

/* if($clasificacion==1){
  $sql1="UPDATE `servicios` SET ser_descripcion='$param2',ser_idverificadopeso='$param3',ser_volumen='$param4',ser_idverificado='$id_usuario',`ser_estado`='$estado', ser_visto=0,ser_guiare='$param6',`ser_fechafinal`='$fechatiempo' $llego WHERE `idservicios`=$id_param2";
//@$precio=$param4;	
 }
else { */

$kilosvolumen=$param1+$param4;
 $clasificacion=$_REQUEST["clasificacion"];
 $sql32="Select gui_tiposervicio from guias WHERE `gui_idservicio`='$id_param2'"; 
$DB->Execute($sql32);
$rw6=mysqli_fetch_row($DB->Consulta_ID); 
if($rw6[0]==0 and $clasificacion!=2){
	if($kilosvolumen>3){
		@$precio1=($param1+$param4-3)*$precioadicional;
		@$precio=$preciokilo+$precio1;
	}else {
		@$precio=$preciokilo;	
	}
}else if($rw6[0]==1 and $clasificacion!=2){ // guias con opcion de Carga especial

	$sql33="Select tip_preciokilo,tip_precioadicional from tiposervicio WHERE `idtiposervicio`='$rw6[0]'"; 
	$DB->Execute($sql33);
	$rw7=mysqli_fetch_row($DB->Consulta_ID); 
	if($rw7[0]!=''){
		if($kilosvolumen>3){
			@$precio1=($param1+$param4-3)*$rw7[1];
			@$precio=$rw7[0]+$precio1;
		}else{
			@$precio=$rw7[0];	
		}
	}else{
			@$precio=0;
		}

}else if($clasificacion==2){

	 	$sqlc="SELECT rel_nom_credito,idcreditos FROM `rel_sercre` inner join creditos on cre_nombre=rel_nom_credito where idservicio=$id_param2 ";
		$DB->Execute($sqlc);
		$rw21=mysqli_fetch_row($DB->Consulta_ID); 
		 $creditouser=$rw21[0];
		 $idcredito=$rw21[1];

		$sql3="SELECT `pre_preciokilo`,`pre_precioadicional` FROM `precios_credito` WHERE `pre_idciudadori`='$param5'  and `pre_idciudades`='$param16' and pre_tiposervicio='$rw6[0]' and pre_idcredito='$idcredito' ";
		$DB->Execute($sql3);
		$rw2=mysqli_fetch_row($DB->Consulta_ID); 
	
		if($kilosvolumen>3){
			@$precio1=($param1+$param4-3)*$rw2[1];
			@$precio=$rw2[0]+$precio1;
		}else{
			@$precio=$rw2[0];	
		}
			
	}

	$sql2="UPDATE `cuentaspromotor` SET `cue_valorflete`='$precio', cue_estado='$estado'  where cue_idservicio=$id_param2";
	$DB1->Execute($sql2);	

  $sql1="UPDATE `servicios` SET `ser_peso`='$param1',ser_descripcion='$param2',ser_idverificado='$id_usuario',ser_idverificadopeso='$param3',ser_volumen='$param4',ser_valor='$precio',`ser_estado`='$estado',ser_visto=0,ser_guiare='$param6',`ser_fechafinal`='$fechatiempo' $llego WHERE `idservicios`=$id_param2";

//}
$DB->Execute($sql1);


/* echo $sql22="UPDATE `cuentaspromotor` SET  cue_estado='$estado' where cue_idservicio=$id_param2";
$DB1->Execute($sql22);	 */

	
/*  $sql="INSERT INTO `cuentaspromotor`(`idcuentaspromotor`, `cue_idservicio`, `cue_porprestamo`, `cue_prestamo`, `cue_pordeclarado`, `cue_totalprestamo`, `cue_totalflete`, `cue_totalfinal`, `cue_abono`, `cue_vrdeclarado`, `cue_tipopago`) 
 VALUES ('','$id_param2',[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11])";
 $DB1->Execute($sql); */
 
	$DB->cerrarconsulta();
	$DB1->cerrarconsulta();
}else {
	$dato=7;
	if($caso==1){
		if($nivel_acceso==3){
			$pagina='ticketfactura.php'; 
			$pagina2="pesarmovil.php";
		}else {
			$pagina='peso.php'; 
			$pagina2="peso.php";
		}

	} else {
		
		$pagina='verificarpeso.php'; 
		$pagina2='verificarpeso.php'; 
		//exit;
	}
}	


header ("Location: $pagina?pagina2=$pagina2&id_param=$id_param2&bandera=$dato");


?>