<?php
require("definirvar.php");
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
@$id_usuario=$_REQUEST["id_usuario"];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
//echo $condecion;
if($condecion==1){

	//$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23;  
	$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
	$param5 = str_replace('&0&','&&', $param5);
	$param25 = str_replace('.','', $param25);	

	 $sql1="INSERT INTO `clientes`(`idclientes`, `cli_iddocumento`,  `cli_email`, `cli_clasificacion`, `cli_tipo`, `cli_valoraprobado`, `cli_fecharegistro`) 
	VALUES ('','$param1','$param3','$param7',2,'$param25','$fechatiempo')";
	$idexec=$DB->Executeid($sql1);
	
	

	 $sql="INSERT INTO `clientesdir`(`idclientesdir`, `cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`, `cli_au`, `cli_ac`, `cli_whatsap`) 
	VALUES ('','$param6','$param2','$param4','$param5','$idexec','1','$param26','$param27','$param14')";
	$DB->Execute($sql);

	//$campos=$campos+1;
	if($campos>1){
		for($a=1;$a<$campos;$a++){
			
			$direccion=$_REQUEST['param4'.$a]."&".$_REQUEST['param5'.$a]."&".$_REQUEST['param6'.$a]."&".$_REQUEST['param7'.$a]."&".$_REQUEST['param8'.$a]."&";
			
			$direccion = str_replace('&0&','&&', $direccion);

			$sql2="INSERT INTO `clientesdir`(`idclientesdir`, `cli_idciudad`, `cli_direccion`,`cli_telefono`, `cli_nombre`,  `cli_idclientes`,`cli_au`,`cli_ac`) 
			VALUES ('','".$_REQUEST['param3'.$a]."','$direccion','".$_REQUEST['param9'.$a]."','".$_REQUEST['param10'.$a]."',$idexec,'".$_REQUEST['param11'.$a]."','".$_REQUEST['param12'.$a]."')";
			$DB1->Execute($sql2);
			
		}
	}	
}else if($condecion==2) {
	
	//$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23; 
	$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
	$param5 = str_replace('&0&','&&', $param5);	
	$param25 = str_replace('.','', $param25);	
	
	 $sql1="UPDATE `clientes` SET  `cli_iddocumento`='$param1',`cli_email`='$param3', `cli_clasificacion`='$param7',
	`cli_tipo`='2', `cli_fecharegistro`='$fechatiempo',`cli_valoraprobado`='$param25'  WHERE `idclientes`='$id_param'";
	$DB->Execute($sql1);
	
	
	 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param6', `cli_telefono`='$param2',`cli_idciudad`='$param4', 
	 `cli_direccion`='$param5', cli_au='$param26', cli_ac='$param27', `cli_idclientes`='$id_param',`cli_principal`='1',`cli_whatsap`='$param14' where `idclientesdir`='".$_REQUEST['id_param0']."'";
	
	
	$DB->Execute($sql);
	$insert=$_REQUEST['inserta'];
	// $campos++;
		for($a=1;$a<$campos;$a++){
			
			$direccion=$_REQUEST['param4'.$a]."&".$_REQUEST['param5'.$a]."&".$_REQUEST['param6'.$a]."&".$_REQUEST['param7'.$a]."&".$_REQUEST['param8'.$a]."&";
			$direccion = str_replace('&0&','&&', $direccion);
			if($a<=$insert){
				
			 $sql2="UPDATE `clientesdir` SET  `cli_nombre`='".$_REQUEST['param10'.$a]."', `cli_telefono`='".$_REQUEST['param9'.$a]."',`cli_idciudad`='".$_REQUEST['param3'.$a]."',`cli_au`='".$_REQUEST['param11'.$a]."',`cli_ac`='".$_REQUEST['param12'.$a]."',`cli_direccion`='$direccion',  `cli_idclientes`='$id_param'  where `idclientesdir`='".$_REQUEST['paramid'.$a]."'";
				$DB1->Execute($sql2);
				
			}else {
				 $sql2="INSERT INTO `clientesdir`(`idclientesdir`, `cli_idciudad`, `cli_direccion`,`cli_telefono`, `cli_nombre`,  `cli_idclientes`,`cli_au`,`cli_ac`) 
				VALUES ('','".$_REQUEST['param3'.$a]."','$direccion','".$_REQUEST['param9'.$a]."','".$_REQUEST['param10'.$a]."',$id_param,'".$_REQUEST['param11'.$a]."','".$_REQUEST['param12'.$a]."')";
				$DB1->Execute($sql2);
			}
			
		}

}

 //`cli_nombre`, `cli_telefono`, `cli_idciudad`, `cli_direccion`,
 //'$param2','$param3','$param4','$param5',
	$DB->cerrarconsulta();
	

header ("Location: clientes.php?bandera=1");


?>