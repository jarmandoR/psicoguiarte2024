<?php
require("login_autentica.php"); 
$id_ciudad= $_SESSION['usu_idsede'];
$id_usuario= $_SESSION['usuario_id'];
@$tipoguia=$_REQUEST["tipoguia"];
@$registros=$_REQUEST["registros"];
$id_nombre=$_SESSION['usuario_nombre'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();



if($tipoguia=='sedes'){
	
	
	for($b=1;$b<=$registros;$b++)
	{
	  $inser=1;
	  @$valor=$_REQUEST["asignar_$b"];
	
		if($valor==1){

			 $idser=$_REQUEST["servicio_$b"];
			
			$piezasg=$_REQUEST["piezasg_$b"];
			$pieza=$_REQUEST["pieza_$b"];
			$guia=$_REQUEST["guia_$b"];
			//echo $pieza."<br>";
			if($piezasg>1){

				$sql="INSERT INTO `piezasguia`(`numeroguia`, `numeropieza`) values ('$guia',$pieza)";
				$DB1->Execute($sql);

				$sql="SELECT  count(numeropieza) from piezasguia where numeroguia='$guia' ";		
				$DB->Execute($sql);
				$rw2=mysqli_fetch_row($DB->Consulta_ID);

				if($rw2[0]!=$piezasg){
					$inser=0;
					$sql2="UPDATE `servicios` SET  `ser_fechaguia`='$fechatiempo' WHERE `idservicios`='$idser' ";			
					$DB->Execute($sql2);
				}

			}else{

				 $sql4="INSERT INTO `piezasguia`( `numeroguia`, `numeropieza`) values ('$guia',1)";
				$DB1->Execute($sql4);
			}

			if($inser==1){
			
				$sql1="UPDATE `cuentaspromotor` SET  `cue_fecha`='$fechatiempo', cue_estado='7'  where cue_idservicio=$idser";
				$DB1->Execute($sql1);			
				
				$sql2="UPDATE `servicios` SET  `ser_idusuarioregistro`='$id_usuario',`ser_fechaguia`='$fechatiempo',ser_estado='7'
				WHERE `idservicios`='$idser' ";			
				$DB->Execute($sql2);
				
				$sql3="UPDATE `guias` SET `gui_ensede`='$id_nombre',`gui_fechaensede`='$fechatiempo' WHERE `gui_idservicio`='$idser'";
				$DB->Execute($sql3); 
			}

		}
		
	}

	header ("Location: guiassede.php?bandera=1");
	
} else if($tipoguia=='operador'){
	

	for($b=1;$b<=$registros;$b++)
	{
	 @$valor=$_REQUEST["asignar_$b"];
	 
		if($valor==1){
			$idser=$_REQUEST["servicio_$b"];
			
			$sql1="UPDATE `cuentaspromotor` SET `cue_idoperentrega`='$param1', `cue_fecha`='$fechatiempo', cue_estado='9'  where cue_idservicio=$idser";
			$DB1->Execute($sql1);	
			
		   $sql2="UPDATE `servicios` SET  ser_idusuarioguia='$param1',`ser_idusuarioregistro`='$id_usuario',`ser_fechaguia`='$fechatiempo',ser_estado='9',ser_visto=0
			WHERE `idservicios`='$idser' ";
			$DB->Execute($sql2);
			
			 $sql3="UPDATE `guias` SET `gui_encomienda`='$id_nombre',`gui_fechaencomienda`='$fechatiempo' WHERE `gui_idservicio`='$idser'";
			$DB->Execute($sql3); 
			
		}
	
	}	
	
	
	header ("Location: guias.php?bandera=1&param1=$param1");
	
}else if($tipoguia=='validar'){
	
	$idser=$_REQUEST["servicio"];
	$descr=$_REQUEST["descripcion"];
	$llego=$_REQUEST["llego"];
	$piezasg=$_REQUEST["piezasg"];
	$guia=$_REQUEST["guia"];

	$inser=1;
	if($llego=='SI'){
		$estadog=8;
	}else if($llego=='NO'){
		$estadog=12;
	}else if($llego=='Incompleto'){
		$estadog=13;
	}else if($llego=='Perdida'){
		$estadog=16;
	}else if($llego=='Incautada'){
		$estadog=17;
	}
	

	if($piezasg>1){

		$sql="UPDATE  `piezasguia` SET guiallega=1  WHERE numeroguia='$guia'";
		$DB1->Execute($sql);

		$sql="SELECT  count(numeropieza) from piezasguia where numeroguia='$guia' and guiallega=1  ";		
		$DB->Execute($sql);
		$rw2=mysqli_fetch_row($DB->Consulta_ID);
			
		if($rw2[0]!=$piezasg){
			$inser=0;
			$sql2="UPDATE `servicios` SET  `ser_fechaguia`='$fechatiempo' WHERE `idservicios`='$idser' ";			
			$DB->Execute($sql2);
		}

	}else{

	   	$sql4="UPDATE  `piezasguia` SET guiallega=1  WHERE numeroguia='$guia'";
		$DB1->Execute($sql4);
	}

	if($inser==1){

		  $sql1="UPDATE `cuentaspromotor` SET  `cue_fecha`='$fechatiempo', cue_estado='$estadog'  where cue_idservicio=$idser";
		$DB1->Execute($sql1);	
		
		 $sql2="UPDATE `servicios` SET  `ser_idusuarioregistro`='$id_usuario',`ser_fechaguia`='$fechatiempo',ser_estado='$estadog',ser_desvaliguia='$descr',ser_llego='$llego'
		WHERE `idservicios`='$idser' ";
		$DB->Execute($sql2);
		
		 $sql3="UPDATE `guias` SET `gui_validasede`='$id_nombre',`gui_fechavalidasede`='$fechatiempo' WHERE `gui_idservicio`='$idser'";
		$DB->Execute($sql3); 
	}

}else if($tipoguia=='agregarguia'){

	$idservicio=$_REQUEST["idservicio"];
	$sql4="INSERT INTO `tempfactura`(`id`) values ($idservicio)";
	$DB1->Execute($sql4);

	$sql2="SELECT * FROM `tempfactura` ";	
	$DB->Execute($sql2);
	$rw1=mysqli_fetch_row($DB->Consulta_ID);
	echo "jose".$rw1[0];


}else if($tipoguia=='validarsede'){
	
	$idser=$_REQUEST["servicio"];
	$descr=$_REQUEST["descripcion"];
	$llego=$_REQUEST["llego"];
	$estado="";

	if($llego=='SI'){

		$estado=" ,ser_estentrega='NO ENTREGADO EN SEDE'";

	}else if($llego=='NO'){

		$estado=" ,ser_estentrega='NO EN SEDE'";
	}
		if($descr=='Validado Con Pistola'){

			$condicionwhere=" ser_guiare='$idser'";
		}else{
			$condicionwhere=" `idservicios`='$idser'";
		}
 		 $sql1="UPDATE `servicios` SET  `ser_descentrega`='$descr',ser_fechafinal='$fechatiempo',`ser_idasignacion`='$id_usuario'  $estado WHERE $condicionwhere ";
		$DB1->Execute($sql1);		

}
else if($tipoguia=='cancelar'){
	
	$idser=$_REQUEST["servicio"];
	$descr=$_REQUEST["descripcion"];
	$llego=$_REQUEST["llego"];
	if($llego=="SI"){
		
	$sql1="UPDATE `cuentaspromotor` SET  `cue_fecha`='$fechatiempo', cue_estado='100',cue_idoperador=0,cue_fecharecogida='00:00:00'  where cue_idservicio=$idser";
	$DB1->Execute($sql1);	
		
	$sql2="UPDATE `servicios` SET  `ser_idusuarioregistro`='$id_usuario',`ser_fechafinal`='$fechatiempo',ser_estado=100,ser_desvaliguia='$descr',`ser_idusuarioregistro`='$id_usuario' 	WHERE `idservicios`='$idser' ";
		$DB->Execute($sql2);
	
		

	}else if($llego=="NO"){
		
		$sql1="UPDATE `cuentaspromotor` SET  `cue_fecha`='$fechatiempo', cue_estado='2',cue_idoperador=0,cue_fecharecogida='00:00:00'   where cue_idservicio=$idser";
		$DB1->Execute($sql1);	
	
		$sql2="UPDATE `servicios` SET  `ser_idusuarioregistro`='$id_usuario',`ser_fecharegistro`='$fechatiempo',ser_estado='2',ser_desvaliguia='',`ser_idusuarioregistro`='' 	WHERE `idservicios`='$idser' ";
		$DB->Execute($sql2);
		echo "Servicio Activo";
	}
	
} else if($tipoguia=='incompletas'){

	for($b=1;$b<=$registros;$b++)
	{
	  @$valor=$_REQUEST["asignar_$b"];
	
		if($valor==1){
			$idser=$_REQUEST["servicio_$b"];
			$guia=$_REQUEST["guia_$b"];
		
			$sql1="UPDATE `cuentaspromotor` SET  `cue_fecha`='$fechatiempo', cue_estado='7'  where cue_idservicio=$idser";
			$DB1->Execute($sql1);			
			
		  $sql2="UPDATE `servicios` SET  `ser_idusuarioregistro`='$id_usuario',`ser_fechaguia`='$fechatiempo',ser_estado='7'
			WHERE `idservicios`='$idser' ";			
			$DB->Execute($sql2);
			
			 $sql3="UPDATE `guias` SET `gui_userdevolucion`='$id_nombre',`gui_fechadevolucion`='$fechatiempo' WHERE `gui_idservicio`='$idser'";
			$DB->Execute($sql3); 

			$sql4="UPDATE `piezasguia` SET `guiallega`='0' WHERE numeroguia='$guia'";
			$DB->Execute($sql4); 
		}
		
	}

	header ("Location: guiasincompletas.php?bandera=1");
	
}else if($tipoguia=='validaprecios'){

	$nomcredito=$_REQUEST["nomcredito"];
	$tipocredito=$_REQUEST["tipocredito"];
	$ciudadori=$_REQUEST["ciudadori"];
	$ciudaddes=$_REQUEST["ciudaddes"];

	 $sql2="SELECT idprecioscredito,idcreditos FROM `precios_credito`  inner join creditos on idcreditos=pre_idcredito where cre_nombre='$nomcredito'  and pre_idciudadori='$ciudadori' and pre_idciudades='$ciudaddes' and pre_tiposervicio='$tipocredito'";	
	$DB1->Execute($sql2);
	$rw1=mysqli_fetch_row($DB1->Consulta_ID);
	$gatoscomfirmar=$rw1[1];
	if($gatoscomfirmar>0){
		echo "1";
	}else {
		echo "2";
	}
	//$datos=array("resultado"  => "3");

}else if($tipoguia=='cuentasoperador'){

	$sql="SELECT cue_estado, cue_idoperador,cue_idoperentrega,cue_fecha,cue_fecharecogida FROM `cuentaspromotor` where  cue_numeroguia='$registros' ";		
	$DB->Execute($sql);
	$rw2=mysqli_fetch_row($DB->Consulta_ID);
		
	if($rw2[0]>=9){
			$sql="UPDATE cuentaspromotor SET cue_validadoentrega=1 WHERE cue_numeroguia='$registros' ";
			$DB1->Execute($sql);
	}else{

			$sql="UPDATE cuentaspromotor SET cue_validado=1 WHERE cue_numeroguia='$registros' ";
			$DB1->Execute($sql);
	}

	 $fechar=substr($rw2[4], 0,10);
	 $fechae=substr($rw2[3], 0,10);

	if($rw2[1]==$rw2[2] and $fechar==$fechae){  
		$sql="UPDATE cuentaspromotor SET cue_validado=1 WHERE cue_numeroguia='$registros' ";
		$DB1->Execute($sql);
	}

}else if($tipoguia=='elementos'){

	$idser=$_REQUEST["servicio"];
	$descr=$_REQUEST["descripcion"];
	$llego=$_REQUEST["llego"];
		
	$sql1="UPDATE `elementostrabajo` SET  `ele_fecharetiro`='$fechatiempo',`ele_entregado`='$llego',`ele_userverifico`='$id_nombre',`ele_etregadescripcion`='$descr'  where idelementostrabajo=$idser";
	$DB1->Execute($sql1);	
			

}
	
	
	$DB->cerrarconsulta();

	



?>