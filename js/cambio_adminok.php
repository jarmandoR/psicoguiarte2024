<?php
require("login_autentica.php");
include("declara.php");
if(isset($_POST["nivel"])) {$nivel=$_POST["nivel"]; } else { $nivel=""; } 
if(isset($_POST["id_param"])) {$id_param=$_POST["id_param"]; } else { if(isset($_REQUEST["id_param"])){ $id_param=$_REQUEST["id_param"]; } else { $id_param=""; }  } 
if(isset($_POST["condecion"])) {$condecion=$_POST["condecion"]; } else { $condecion=""; } 
if(isset($_POST["tabla"])) {$tabla=$_POST["tabla"]; } else { if(isset($_REQUEST["tabla"])){ $tabla=$_REQUEST["tabla"]; } else { $tabla=""; }  } 





   function subirimagen($var,$tipo){

 if ($var!=''){

			move_uploaded_file($var["tmp_name"],"./imgnovedades/".$var["name"]);

		// $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";
			$imagen = $var["name"]; 

	    }else{

        $imagen = ""; 
	    }
	     return $imagen;

}

$tabla1=$tabla;
if($condecion=='general'){  $tabla='General'; }
switch($tabla)
{
	
case "General": 

$sql1="SHOW COLUMNS FROM $tabla1";
$DB->Execute($sql1); $va=1; $va2=0; 
$sql="UPDATE $tabla1 SET ";
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		if($va2!=0){
		$sql.="$rw1[0]='".$_REQUEST["param$va2"]."',";
		}
		$va2++;
	}
	
	$sql = substr ($sql, 0, -1);
	$sql.=" WHERE id$tabla1='$id_param'";	

	$valores[7]=$sql; $valores[4]="adm_general.php"; $valores[8]=1; 
	$tabla=$tabla1;
	break;

	case "devolver":
	
	 $sql3="UPDATE `guias` SET `gui_userdevolucion`='$id_nombre',`gui_fechadevolucion`='$fechatiempo' WHERE `gui_idservicio`='$id_param'";
	$DB->Execute($sql3);
	
	 $sql="UPDATE `servicios` SET ser_idverificadopeso=1,ser_llego='SI',`ser_estado`='8' WHERE `idservicios`=$id_param";
	$valores[7]=$sql; $valores[4]="verificarpeso.php"; $valores[8]=1;
	
	break;
	case "cambioestado":
		
		$fechaa=date('Y-m-d');
		 $hora=date("H:i:s");

/* 		 $hora= new DateTime();
		 $hora->format('H:i:s'); */

		$estado=$_REQUEST["condecion"];
		
		if($estado=='almuerzo'){

			$actualiza="seg_horaalmuerzo='$hora'"; 

		}elseif($estado=='regreso'){

			$actualiza="seg_horaregreso='$hora'"; 

		}elseif($estado=='regresooficina'){

			$actualiza="seg_horaoficina='$hora'"; 
		}
		 $sql="UPDATE `seguimiento_user` SET  $actualiza WHERE `seg_idusuario`=$id_usuario and seg_fechaingreso like '$fechaa%'";
		$valores[7]=$sql; $valores[4]="inicio.php"; $valores[8]=1;

	break;
	case "asignardinero":
	$param5=str_replace(".","", $param5);
	 $sql="UPDATE `asignaciondinero` SET `asi_idpromotor`='$param2',	`asi_valor`='$param5',`asi_fecha`='$param3',
	`asi_idautoriza`='$id_usuario',`asi_idciudad`='$param1',`asi_tipo`='$param4',`asi_descripcion`='$param6' WHERE idasignaciondinero='$id_param'";
	$valores[7]=$sql; $valores[4]="asignardinero.php"; $valores[8]=1; 
	
	break;
	
	case "deudaspro":

	$param5=str_replace(".","", $param5);
		 $sql="UPDATE `duedapromotor` SET `deu_idpromotor`='$param2',	`deu_valor`='$param5',`deu_fecha`='$param3',
	`deu_idautoriza`='$id_usuario',`deu_idciudad`='$param1',`deu_tipo`='$param4',`due_descripcion`='$param6' WHERE iddeudapromotor='$id_param'";
	if($_FILES["param7"]!=''){
		//$QL->delete('duedapromotor', $DB, 'doc_idviene', $id_param,'duedapromotor');
		$QL->addDocumento1($_FILES["param7"], 1, "duedapromotor", $id_param, "duedapromotor", $DB);
	}
//	echo $sql;
//	exit;
	$valores[7]=$sql; $valores[4]="deudaspro.php"; $valores[8]=1; 
	
	break;

	case "Clientes":
	$param5=$param5."&".$param51."&".$param19."&".$param20;  
	$sql="UPDATE `clientes` SET `cli_iddocumento`='$param1',`cli_nombre`='$param2',`cli_telefono`='$param3',`cli_idciudad`='$param4',`cli_direccion`='$param5',`cli_email`='$param6',`cli_clasificacion`='$param7',`cli_fecharegistro`='$fechatiempo' WHERE `idclientes`='$id_param'";
	$valores[7]=$sql; $valores[4]="Clientes.php"; $valores[8]=1; 
	break;
	case "Usuario":
		$param4=md5($param4);
		$sql="UPDATE `usuarios` SET `roles_idroles`='$param1',`usu_nombre`='$param2',`usu_usuario`='$param3',`usu_pass`='$param4',`usu_mail`='$param5',`usu_idtipodocumento`='$param6',`usu_identificacion`='$param7',`usu_genero`='$param8',`usu_fechanacimiento`='$param9',`usu_idsede`='$param10',`usu_idempresa`='$param71',`usu_telefono`='$param11',`usu_celular`='$param12',`usu_nivelacademico`='$param13',`usu_tipovehiculo`='$param18',`usu_vehiculo`='$param19',`usu_licencia`='$param20',`usu_fechalicencia`='$param21',`usu_tipocontrato`='$param22',`usu_estado`='$param14',`usu_idcredito`='$param23' WHERE `idusuarios`='$id_param'";
		$valores[7]=$sql; $valores[4]="adm_usuarios.php"; $valores[8]=1; 
	break;
	case "Dependencia":
	if($_POST["param1"]==0){ 
		$saa="INSERT INTO dependencias (iddependencias, dep_predecesor, dep_nombre) VALUES ('', '0', '".$_POST["param4"]."')";
		$DB->Execute($saa);
		$sel="SELECT iddependencias FROM dependencias ORDER BY iddependencias DESC ";
		$DB->Execute($sel);		
		$iddepe=$DB->recogedato(0);		
	}
	else {$iddepe=$_POST["param1"];} 
	$valores[4]="adm_organigramas.php"; $valores[8]=1; 
	$valores[7]="UPDATE dependencias SET dep_predecesor='$iddepe', dep_nombre='".$_POST["param2"]."', dep_responsable='".$_POST["param3"]."' WHERE iddependencias='$id_param'";
	break;

case "novedades":
 $param23="".$param101;
    $param24="".$param111;



	$sql2="SELECT `nov_imagen` FROM  `novedades` WHERE `novid`='$id_param'";
        $DB->Execute($sql2);
	    $rw6=mysqli_fetch_row($DB->Consulta_ID);
			// $fotonov =$rw6[0];

    if($_FILES["param7"]!=''){

    	$fotonovedades=subirimagen($_FILES["param7"],"fotos");

			// $foto=subirimagen($_FILES["param101"],"fotos"); 
	
		
		}else{

			$fotonovedades=$rw6[0];
		}

    // $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");




// time($hr : $min : 00)

	// if($nivel_acceso==1){


    echo$sql="UPDATE `novedades` SET `nov_tipo`='$param8',`nov_descripcion`='$param20',`nov_idusuario`='$param2',`nov_fechadesde`='$param5',`nov_fechahasta`='$param6',`nov_sede`='$param1',`nov_horainicio`='$param101',`nov_horafin`='$param111',`nov_imagen`='$fotonovedades' WHERE `novid`='$id_param'";
		
		// echo$sql1="INSERT INTO `novedades`( `nov_tipo`,`nov_descripcion`,`nov_estado`,`nov_idusuario`,`nov_fechadesde`, `nov_fechahasta`,`nov_quienregistro`,`nov_fechaingresonov`,`nov_imagen`,`nov_sede`,	`nov_horainicio`,`nov_horafin`) VALUES ('$param8','$param20',1,'$param2','$param5','$param6','$id_usuario','$fechaactualHora','$fotonovedades','$param1','$param101','$param111')";
 $valores[7]=$sql;
  $valores[4]="novedades.php";
   $valores[8]=1; 
   $tabla=$sql;

break;



case "Validarsolicitud":

	echo$sql2="UPDATE `solicitudes` SET  `soli_valida`='$param9'  WHERE `soli_id`='$id_param' ";	
	$DB->Execute($sql2);

	// $dir="solicitudess.php";

	$valores[7]=$sql;
  $valores[4]="solicitudess.php";
   $valores[8]=1; 
   $tabla=$sql;

break;

case "parametrizacion":

	echo$sql2="UPDATE `parametrizables` SET `parme_nombre`='".$param4."',`parme_valor`='".$param5."' WHERE `parame_id`='$id_param' ";	
	$DB->Execute($sql2);

	// $dir="solicitudess.php";

	$valores[7]=$sql2;
  $valores[4]="parametrizacion.php";
   $valores[8]=1; 
   $tabla=$sql;



break;


case "Carpetasempresa":

$sql="UPDATE `carpetasdocumentos` SET `carp_nombre`='$param110' WHERE carp_id='$id_param'";



$valores[7]=$sql; $valores[4]="documentosempre.php"; $valores[8]=1; 
	break;

case "documentosempre":
	// $param23="".$param101;
    // $param24="".$param111;

	echo $sql4="SELECT  `empre_nombre` FROM `documentos_empre` where empre_id='$id_param' ";

	// $sql2="SELECT `nov_imagen` FROM  `novedades` WHERE `novid`='$id_param'";
        $DB->Execute($sql4);
	    $rw6=mysqli_fetch_row($DB->Consulta_ID);
			// $fotonov =$rw6[0];

    if($_FILES["param7"]['name']!=''){

    	// $fotonovedades=subirimagen($_FILES["param7"],"fotos");
		$fotonovedades=subirimagen($_FILES["param7"],"documentosberm");

			// $foto=subirimagen($_FILES["param101"],"fotos"); 
			
		}else{

			$fotonovedades=$rw6[0];
		}

    // $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");




// time($hr : $min : 00)

	// if($nivel_acceso==1){


    // echo$sql="UPDATE `novedades` SET `nov_tipo`='$param8',`nov_descripcion`='$param20',`nov_idusuario`='$param2',`nov_fechadesde`='$param5',`nov_fechahasta`='$param6',`nov_sede`='$param1',`nov_horainicio`='$param101',`nov_horafin`='$param111',`nov_imagen`='$fotonovedades' WHERE `novid`='$id_param'";
	echo $sql="UPDATE `documentos_empre` SET `empre_nombre`='$fotonovedades', `empre_descripcion`='$param111' WHERE empre_id='$id_param'";	
		// echo$sql1="INSERT INTO `novedades`( `nov_tipo`,`nov_descripcion`,`nov_estado`,`nov_idusuario`,`nov_fechadesde`, `nov_fechahasta`,`nov_quienregistro`,`nov_fechaingresonov`,`nov_imagen`,`nov_sede`,	`nov_horainicio`,`nov_horafin`) VALUES ('$param8','$param20',1,'$param2','$param5','$param6','$id_usuario','$fechaactualHora','$fotonovedades','$param1','$param101','$param111')";
//  $valores[7]=$sql;
//   $valores[4]="novedades.php";
//    $valores[8]=1; 
//    $tabla=$sql;

		
 $valores[7]=$sql; $valores[4]="documentosempre.php"; $valores[8]=1; 
break;
	
case "Carpetasreglamento":

$sql="UPDATE `carpetasregla` SET `carpregla_nombre`='$param110' WHERE carpregla_id='$id_param'";



$valores[7]=$sql; $valores[4]="documentoregla.php"; $valores[8]=1; 
	break;


case "documentosreglamento":
		// $param23="".$param101;
		// $param24="".$param111;
	
	echo $sql4="SELECT  `regla_nombre`, `regla_link` FROM `documentos_regla` where regla_id='$id_param' ";
	
		// $sql2="SELECT `nov_imagen` FROM  `novedades` WHERE `novid`='$id_param'";
			$DB->Execute($sql4);
			$rw6=mysqli_fetch_row($DB->Consulta_ID);
				// $fotonov =$rw6[0];
	
	if($_FILES['param7']['name'] != null ){
	
			// $fotonovedades=subirimagen($_FILES["param7"],"fotos");
			$fotonovedades=subirimagen($_FILES["param7"],"documentosberm");
	
				// $foto=subirimagen($_FILES["param101"],"fotos"); 
		if($param112!=''){

		 $sql="UPDATE `documentos_regla` SET `regla_link`='$param112' WHERE regla_id='$id_param'";
					
		}else{
		   
		   $param112=$rw6[1];
	     }

    }else{
	   
		$fotonovedades=$rw6[0];
			   		   
	}
		// elseif($param112!=''){

		//  $sql="UPDATE `documentos_regla` SET `regla_link`='$param112' WHERE regla_id='$id_param'";
					
		// }else{
		   
		//    $param112=$rw6[1];
	    //  }



	
		// $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");
	
	
	// time($hr : $min : 00)
	
		// if($nivel_acceso==1){
	
	// if ($rw6[0] == "" and  $rw6[1] != "") {
		// echo$sql="UPDATE `novedades` SET `nov_tipo`='$param8',`nov_descripcion`='$param20',`nov_idusuario`='$param2',`nov_fechadesde`='$param5',`nov_fechahasta`='$param6',`nov_sede`='$param1',`nov_horainicio`='$param101',`nov_horafin`='$param111',`nov_imagen`='$fotonovedades' WHERE `novid`='$id_param'";
		echo $sql="UPDATE `documentos_regla` SET `regla_nombre`='$fotonovedades', `regla_descrip`='$param111', `regla_link`='$param112' WHERE regla_id='$id_param'";	
			// echo$sql1="INSERT INTO `novedades`( `nov_tipo`,`nov_descripcion`,`nov_estado`,`nov_idusuario`,`nov_fechadesde`, `nov_fechahasta`,`nov_quienregistro`,`nov_fechaingresonov`,`nov_imagen`,`nov_sede`,	`nov_horainicio`,`nov_horafin`) VALUES ('$param8','$param20',1,'$param2','$param5','$param6','$id_usuario','$fechaactualHora','$fotonovedades','$param1','$param101','$param111')";
	//  $valores[7]=$sql;
	//   $valores[4]="novedades.php";
	//    $valores[8]=1; 
	//    $tabla=$sql;
	
			
	 $valores[7]=$sql; $valores[4]="documentoregla.php"; $valores[8]=1; 
break;

case "carpetascapacitacion":

$sql="UPDATE `capacitacion` SET `capaci_nombre`='$param110' WHERE capaci_id='$id_param'";



$valores[7]=$sql; $valores[4]="capaciberm.php"; $valores[8]=1; 
	break;


case "proveedor":

$sql="UPDATE `proveedor` SET `nom_prove`='$param110' WHERE id_prove='$id_param'";



$valores[7]=$sql; $valores[4]="preveedores.php"; $valores[8]=1; 
	break;

case "Sedes":

	echo $sql="UPDATE `sedes` SET `sed_nombre`='$param113',`sed_telefono`='$param112',`sed_direccion`='$param110' WHERE idsedes='$id_param'";
	
	$valores[7]=$sql; $valores[4]="empreysede.php"; $valores[8]=1; 
break;

case "empresa":

	$sql="UPDATE `empresa` SET `empre_nombre`='$param110' WHERE empre_id='$id_param'";
		
		
		
		$valores[7]=$sql; $valores[4]="empreysede.php"; $valores[8]=1; 
			break;

	case "rol":

$sql="UPDATE `roles` SET `rol_nombre`='$param200' WHERE idroles='$id_param'";



$valores[7]=$sql; $valores[4]="adm_roles.php"; $valores[8]=1; 
	break;
break;
	case "reclamos": 
	
					
			$sql="UPDATE `reclamos` SET `rec_fechaenvio`='$param8',`rec_tipo`='$param9',`rec_nombre`='$param4',`rec_telefono`='$param5',`rec_correo`='$param6',`rec_descripcion`='$param7',`rec_ciudadenvio`='$param1',`rec_direccion`='$param11' WHERE `idreclamos`='$id_param'";
			
			if($_FILES["param8"]!=''){
				$QL->addDocumento1($_FILES["param8"], 1, "reclamos", $vinculo, "reclamos", $DB);
			}
			
			$mensaje = "
			<html>
			<head>
			<title>HTML</title>
			</head>
			<body>
			<h1>Reclamo de Guia</h1>
			<p>
			Hola $param4. <br>Hemos recibido su solicitud de reclamo, de la guia $param2 ha sido recibida. 
			<br> nos estaremos comunicando con usted para seguir con el proceso de reclamo 
			<br> por favor estar pendiente del correo y telefono.
			<br> Su numero de reclamo es: $variableunica
			</p>
			</body>
			</html>";

			enviar_mail2($param6,'',$mensaje,$param4,'Reclamo',1);

			$valores[7]=$sql; $valores[4]="reclamos.php"; $valores[8]=1; 
			

		$valores[7]=$sql; $valores[4]="reclamos.php"; $valores[8]=1; 
	
	break;
	case "Vehiculos":
	
	 $sql="UPDATE vehiculos SET `veh_tipo`='$param1', `veh_marca`='$param2', `veh_placa`='$param3', `veh_modelo`='$param4',`veh_color`='$param12', `veh_tipov`='$param13', `veh_dueño`='$param5', `veh_fechaseguro`='$param6', `veh_fechategnomecanica`='$param7', `veh_fechamantenimiento`='$param8', `veh_kilactual`='$param9', `veh_aceitekil`='$param10',`veh_chasis`='$param14', `veh_motor`='$param15',  `veh_cilidraje`='$param16', `veh_usuve`='$param17', `veh_estado`='$param11', `veh_observaciones`='$param18' WHERE `idvehiculos`='$id_param'";
	$valores[7]=$sql; $valores[4]="adm_vehiculos.php"; $valores[8]=1; 
	$vinculo=$id_param;
		//$QL->delete('vehiculos', $DB, 'doc_idviene', $id_param,'vehiculos1');
	if($_FILES["param19"]!=''){
		$QL->addDocumento1($_FILES["param19"], 1, "Vehiculos", $vinculo, "vehiculo", $DB);
	} if($_FILES["param20"]!=''){
		//$QL->delete('vehiculos', $DB, 'doc_idviene', $id_param,'vehiculos1');
		$QL->addDocumento1($_FILES["param20"], 2, "Vehiculos", $vinculo, "vehiculo", $DB);
	} if($_FILES["param21"]!=''){
		$QL->addDocumento1($_FILES["param21"], 3, "Vehiculos", $vinculo, "vehiculo", $DB);
	} if($_FILES["param22"]!=''){
		$QL->addDocumento1($_FILES["param22"], 4, "Vehiculos", $vinculo, "vehiculo", $DB);
	}

	break;

	default:
	$valores=$LT->devuelvecampos($tabla, 2, $id_param);
	break;
}

if($valores[8]==1) { if($DB->Execute($valores[7])){$bandera=5;} else {$bandera=6;} ; }
else if($valores[8]==2) {  $valores[4]="inicio1.php";   }
else {
	
	$bandera=$QL->update($valores[0], $valores[2], $valores[6], $valores[5], $DB, $valores[3], $id_param, $tabla, 1); 
 }
if($bandera==5){
	switch($tabla){

		case "Formulario":
		if($_POST["param5"]!="Consulta"){
			$sql_create="CREATE TABLE IF NOT EXISTS respuesta_$id_param (idrespuesta_$id_param MEDIUMINT NOT NULL AUTO_INCREMENT, actindgener_idactindgener INT, 
			preguntas1_idpreguntas1 INT, res_respuesta VARCHAR(1500) NOT NULL, res_justificacion VARCHAR(1500) NOT NULL, res_fecha DATETIME, res_tipopreg VARCHAR(50), 
			res_idunico	VARCHAR(50), res_orden INT, res_estado INT, PRIMARY KEY (idrespuesta_$id_param) );";
			$DB->Execute($sql_create);
			$va2=$_POST["va2"];
			for($j=1; $j<=$va2; $j++)
			{
				if(isset($_POST["prg$j"])) { $param3=$_POST["prg$j"]; } else { $param3=""; } 
				if(isset($_POST["idps$j"])) { $idps=$_POST["idps$j"]; } else { $idps=""; } 
				if(isset($_POST["obe$j"])) { $obe=$_POST["obe$j"]; if($obe=="on"){$obe=1; } else {$obe=0;} } else { $obe=""; } 
				if(isset($_POST["tru$j"])) { $tru=$_POST["tru$j"]; } else { $tru=""; } 
				if(isset($_POST["urd$j"])) { $urd=$_POST["urd$j"]; } else { $urd=""; } 
				if(isset($_POST["tpi$j"])) { $tpi=$_POST["tpi$j"]; } else { $tpi=""; } 
				if(isset($_POST["arr$j"])) { $arr=$_POST["arr$j"]; } else { $arr=""; } 
				if(isset($_POST["par$j"])) { $par=$_POST["par$j"]; if($par=="on"){$par=1;} else {$par=0;}  } else { $par=""; } 
				if(isset($_POST["jus$j"])) { $jus=$_POST["jus$j"]; } else { $jus=""; } 
				if(isset($_POST["dep$j"])) { $dep=$_POST["dep$j"]; } else { $dep=""; } 
				if(isset($_POST["con$j"])) { $con=$_POST["con$j"]; } else { $con=""; } 
				if(isset($_POST["met$j"])) { $met=$_POST["met$j"]; if($met=="on"){$met=1;} else {$met=0;}  } else { $met=""; } 
				if(isset($_POST["vmetas$j"])) { $pre=$_POST["vmetas$j"]; } else { $pre=""; } 
				if(isset($_POST["agr$j"])) { $agr=$_POST["agr$j"]; } else { $agr=""; } 
				$sel="SELECT COUNT(*) FROM preguntas1 WHERE actindgener_idactindgener='$id_param' AND idpreguntas1='$idps'";
				$DB->Execute($sel);
				if($DB->recogedato(0)>0)
				{
					if(trim($param3)!=""){
						$sql3="UPDATE preguntas1 SET actindgener_idactindgener='$id_param', pre_pregunta='$param3', pre_tipo='$tpi', pre_array='$arr', 
						pre_parametrizacion='$par', pre_orden='$urd', pre_obligatoria='$obe', pre_componente='$tru', pre_justifica='$jus', pre_depende='$dep', 
						pre_condicion='$con', pre_areages='$pre', pre_proceso='$agr' WHERE idpreguntas1='$idps'"; 
					}
					else {
						$sql3="DELETE FROM preguntas1 WHERE idpreguntas1='$idps'";  
					}
				}
				else {
					$sql3="INSERT INTO preguntas1 (idpreguntas1, actindgener_idactindgener, pre_pregunta, pre_tipo, pre_array, pre_parametrizacion, pre_orden, pre_obligatoria, 
					pre_componente, pre_justifica, pre_depende, pre_condicion, pre_areages, pre_proceso) VALUES ('', '$id_param', '$param3', '$tpi', '$arr', '$par', '$urd', 
					'$obe',	'$tru',	'$jus', '$dep', '$con', '$pre', '$agr') ";
				}
				$DB->Execute($sql3);
			}
		}
		else {
			$sel="UPDATE actindgener SET aci_array='".$_POST["para-12"]."' WHERE idactindgener='$id_param'";
			$DB->Execute($sel);
		}
		break;
		case "Menu":
		$i=1;
		foreach($_FILES as $nom => $val)
		{
			$nomb=nombre_archivo($val);
			$ruta=subir_archivo1($val);
			if($nomb!=""){
				$sql_ins="INSERT INTO documentos (iddocumentos, doc_fecha, doc_nombre, doc_ruta, doc_tabla, doc_idviene, doc_version) VALUES 
				('', '".date("Y-m-d")."', '$nomb', '$ruta', '$tabla', '$id_param', '$i')";
				$DB->Execute($sql_ins);
			}
			$i++;
		}

	break;
	default:
//	header ("Location:$valores[4]?bandera=$bandera&id_param=$id_param");
	break;
	}
}
header ("Location:$valores[4]?bandera=$bandera&id_param=$id_param&tabla=$tabla");
?>