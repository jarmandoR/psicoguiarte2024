<?php
require("login_autentica.php"); 
$id_nombre=$_SESSION['usuario_nombre'];


@$id_usuario=$_REQUEST["id_usuario"];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$condicion=$_REQUEST["condicion"];

if($condicion==1){

  $sql="SELECT usu_usuario,usu_mail FROM `usuarios` where idusuarios='$param2' ";
$DB->Execute($sql); 
$rw1=mysqli_fetch_row($DB->Consulta_ID);
 $usu_mail=$rw1[1];

if($usu_mail!=''){


 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
 `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_visto,`ser_fechaasignacion`,ser_valorprestamo
 FROM serviciosdia   where idservicios='$id_param2' ";
$mensaje="<table>";
$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		$rw1[7]=str_replace("&"," ", $rw1[7]);
		$mensaje.= "<tr style='font-size:12px;text-align:left;' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$mensaje.=  "<td>";
		$valorcompra="";
		$mensaje.=  "<div class='alert alert-success'>";
		if($rw1[9]=="Compra"){
			$valorcompra="$ ".$rw1[14];
		}
		$mensaje.=  "<h4><span class='label label-warning'> $rw1[9] $valorcompra</span></h4>";

		$mensaje.=  "<p  align='left'>RECOGIDA: $rw1[1] <br>";
		$mensaje.=  "CLIENTE: $rw1[2]<br>";
		$mensaje.=  "TELÉFONO: $rw1[3]<br></p>";
	
		$mensaje.=  "<div class='alert alert-info'>DIRECCIÓN: $rw1[4]</div>";
		$mensaje.=  "<p  align='left'>DESTINATARIO: $rw1[5]<br>";
		//echo "TELÉFONO: $rw1[6]<br>";
		$mensaje.=  "CIUDAD: $rw1[8]<br></p>";

		$mensaje.=  "</div>";
		$mensaje.=  "</p></div></td>";
		
		
		$mensaje.=  "</tr>"; 
	}


	 $mensaje.="</table>";
	$asunto=" le ha asinado una recogida ";
	//echo $mensaje;
	enviar_mail2($usu_mail,'',$mensaje,$id_nombre,$asunto,1);
}


 $sql1="UPDATE `servicios` SET `ser_idresponsable`='$param2',`ser_fechaasignacion`='$fechatiempo',`ser_estado`='3',ser_visto=0 WHERE `idservicios`=$id_param2";
  $DB->Execute($sql1);
  
 $sql3="UPDATE `guias` SET `gui_usurecogida`='$id_nombre',`gui_fecharecogida`='$fechatiempo',gui_recogio='' WHERE `gui_idservicio`='$id_param2'";
	$DB->Executeid($sql3); 

  $redir="asignarpaquete.php";

}else if($condicion==2 or $condicion==4){
	

  	$sql2="UPDATE `cuentaspromotor` SET `cue_idoperpendiente`='$param2',cue_fechapcobrar='$fechatiempo',cue_fechaasigno='$fechatiempo' where cue_idservicio=$id_param2";
	$DB1->Execute($sql2);	
  if($condicion==2){
	$redir="pendientes.php";

  }else{
	$redir="saldospendientes.php";
  }
	 

}else if($condicion==3){

	$url=$_REQUEST["url"];
	$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$param2' ";
	$DB->Execute($sql5);
	$id_nombre=$DB->recogedato(1);

	$sql2="UPDATE `gastos` SET `gas_iduserrecoge`='$param2',gas_nomrecibe='$id_nombre',gas_fecrecogida='$fechaactual' where idgastos=$id_param2";
	$DB1->Execute($sql2);
	if($url!=''){
		$redir=$url;
	}else{
		$redir="gastos.php";
	}

}


 
	$DB->cerrarconsulta();
	$DB1->cerrarconsulta();
	
header ("Location: $redir?bandera=1");


?>