<?php
require("login_autentica.php");
include("declara.php");
@$tabla=$_REQUEST["tabla"];
if(isset($_POST["condecion"])) {$condecion=$_POST["condecion"]; } else { $condecion=""; }  
if(isset($_POST["nivel"])) {$nivel=$_POST["nivel"]; } else { $nivel=""; } 
if(isset($_POST["id_param"])) {$id_param=$_POST["id_param"]; } else { $id_param=""; } 
 $tabla1=$tabla;



    function subirimagen($var,$tipo){

 if ($var!=''){

            $carpeta="$tipo";

			move_uploaded_file($var["tmp_name"],"./".$carpeta."/".$var["name"]);

		// $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";
			$imagen = $var["name"]; 

	    }else{

        $imagen = ""; 
	    }
	     return $imagen;

}




$fechaactualHora =date("Y-m-d");
if($condecion=='general'){  $tabla='General'; }
$id_sedes=$_SESSION['usu_idsede'];
$id_nombre=$_SESSION['usuario_nombre'];
switch($tabla)
{

case "General": 

$tabla1=strtolower($tabla1);

$sql1="SHOW COLUMNS FROM `$tabla1` ";
$DB->Execute($sql1); $va=1; $va2=0; 
$sql="INSERT INTO $tabla1 (";
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$sql.="$rw1[0],";
	}
	$sql = substr ($sql, 0, -1);
	$sql.=") VALUES ('',";
	
	foreach($_REQUEST as $nombre_campo => $valor){
				if(substr($nombre_campo,0,5)=="param"){
				$sql.="'$valor',";
				}
			}
	$sql = substr ($sql, 0, -1);
	$sql.=");";	
	$valores[7]=$sql; $valores[4]="adm_general.php?tabla=$tabla1"; $valores[8]=1; 
	$tabla=$tabla1;
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
	$valores[7]="INSERT INTO dependencias (iddependencias, dep_predecesor, dep_nombre, dep_responsable) VALUES ('', '$iddepe', '".$_POST["param2"]."', '".$_POST["param3"]."')";
	break;
	case "Codigo-Ciudad":
	if($param==2){
	$sql="update `conf_fac` set idconsecutivo='$param3',idresolucion='$param2',prefijo='$param4' where idciudad=$param1";
	}else if($param==0){
		
		$sql="INSERT INTO `conf_fac`(`idconfac`,`idciudad`,`idresolucion`, `idconsecutivo`, `prefijo`) VALUES ('','$param1','$param2','$param3','$param4')";
	}

	$valores[7]=$sql; $valores[4]="conf_fac.php"; $valores[8]=1; 
	break;
	case "asignardinero":
	$param4=str_replace(".","", $param4);
	$sql="INSERT INTO `asignaciondinero`(`idasignaciondinero`, `asi_idpromotor`,`asi_fecha`, `asi_valor`,  `asi_idautoriza`,  `asi_idciudad`,asi_tipo,asi_descripcion)
	VALUES ('','$param2','$param3','$param4','$id_usuario','$param1','$param5','$param6')";
	$valores[7]=$sql; $valores[4]="asignardinero.php"; $valores[8]=1; 
	
	break;		
	case "deudaspro":
	$param5=str_replace(".","", $param5);
	 $sql="INSERT INTO `duedapromotor`(`iddeudapromotor`,`deu_idciudad`, `deu_idpromotor`, `deu_fecha`,`deu_tipo`,  `deu_valor`, `due_descripcion`, `deu_idautoriza`)
	VALUES ('','$param1','$param2','$param3','$param4','$param5','$param6','$id_usuario')";
	$vinculo=$DB->Executeid($sql);

	$QL->addDocumento1($_FILES["param7"], 1, "duedapromotor", $vinculo, "duedapromotor", $DB);
	$sql="SELECT * from documentos where doc_tabla='duedapromotor' and doc_idviene='$vinculo' limit 1";
	$valores[7]=$sql; $valores[4]="deudaspro.php"; $valores[8]=1; 
	
	break;	
	case "Entregar valor":
	$param3=str_replace(".","", $param3);
	
/* 	$sqldelect="DELETE FROM `asignaciondinero` WHERE asi_idpromotor='$param2' and asi_fecha='$param1' and asi_tipo='entregado'";
	$DB->Execute($sqldelect); */
	$hora=date("H:i:s");
	 $sql2="UPDATE `seguimiento_user` SET seg_fechafinalizo='$hora'  WHERE `seg_idusuario`='$param2'  and seg_fechaingreso like '$param1%'";
	$DB->Execute($sql2);

	$sql="INSERT INTO `asignaciondinero`(`asi_idpromotor`,`asi_fecha`, `asi_valor`,  `asi_idautoriza`,  `asi_idciudad`,asi_tipo)
	VALUES ('$param2','$param1','$param3','$id_usuario','$param4','entregado')";
	
/* 	$valorapagar=$_REQUEST["valorapagar"]-$param3;
		
	$saa="INSERT INTO `duedapromotor`(`iddeudapromotor`, `deu_idpromotor`, `deu_fecha`, `deu_valor`) VALUES  ('', '$param2', '$param1',$valorapagar)";
	$DB->Execute($saa); */
	
	
	$valores[7]=$sql; $valores[4]="cuentasoper.php"; $valores[8]=1; 
	
	break;	
	case "cajamenor":
	$param5=str_replace(".","", $param5);
	$sql="INSERT INTO `cajamenor`( `caj_idciudadori`, `caj_idciudaddes`, `caj_tipotransacion`, `caj_descripcion`,`caj_valor`,`caj_idusuario`, `caj_fecharegistro`)
	VALUES ('$param1','$param2','$param3','$param4','$param5','$id_usuario','$fechatiempo')";
	$vinculo=$DB->Executeid($sql);	
	$QL->addDocumento1($_FILES["param6"], 1, "cajamenor", $vinculo, "cajamenor", $DB);
	$sql="SELECT * from documentos where doc_tabla='cajamenor' and doc_idviene='$vinculo' limit 1";
	$valores[7]=$sql; $valores[4]="cajamenor.php"; $valores[8]=1; 
	
	break;
	case "transpasodinero":
	if($nivel_acceso==1){

		$param5=str_replace(".","", $param5);
		$sql="INSERT INTO `asignaciondinero`( `asi_idpromotor`,`asi_fecha`, `asi_valor`,  `asi_idautoriza`,  `asi_idciudad`,asi_tipo,asi_descripcion)
		VALUES ('$param2','$param3','$param5','$id_usuario','$param1','Transpaso Dinero','Gastos Promotor')";

	}else{
		$param5=str_replace(".","", $param5);
		$sql="INSERT INTO `asignaciondinero`( `asi_idpromotor`,`asi_fecha`, `asi_valor`,  `asi_idautoriza`,  `asi_idciudad`,asi_tipo,asi_descripcion)
		VALUES ('$param2','$fechaactual','$param5','$id_usuario','$id_sedes','Transpaso Dinero','Gastos Promotor')";

	}

/* 	$vinculo=$DB->Executeid($sql);	
	$QL->addDocumento1($_FILES["param6"], 1, "asignaciondinero", $vinculo, "asignaciondinero", $DB);
	$sql="SELECT * from documentos where doc_tabla='cajamenor' and doc_idviene='$vinculo' limit 1"; */

	$valores[7]=$sql; $valores[4]="transpasodinero.php"; $valores[8]=1; 
	
	break;

	case "Llamar Remesas":

		$sql="UPDATE `gastos` SET  `gas_estadollamada`='$param7',`gas_llamodesc`='$param8',gas_fechallamo='$fechatiempo' WHERE `idgastos`='$id_param' ";			
		$valores[7]=$sql; $valores[4]="adm_validardatos.php"; $valores[8]=1; 

	break;
	case "LlamarReclamos":
		$sql3="update  `servicios` set ser_estado='18' where idservicios='$param10'";
		$DB->Execute($sql3);
		//echoLog($sql3);
		 $sql="update  `cuentaspromotor` set cue_estado='18' where cue_idservicio='$param10'";
		 $DB->Execute($sql);

		$sql="UPDATE `reclamos` SET `rec_fechaconfirmacion`='$fechatiempo',`fec_descricomf`='$param2',rec_estado='Abierto' WHERE `idreclamos`='$id_param' ";			
		$valores[7]=$sql; $valores[4]="reclamos.php"; $valores[8]=1; 

	break;
	case "GastosOperador":
	$param4=str_replace(".","", $param4);
	if($nivel_acceso==1){
		
		$sql1="INSERT INTO `asignaciondinero`(`asi_idpromotor`,`asi_fecha`, `asi_valor`,  `asi_idautoriza`,  `asi_idciudad`,asi_tipo,asi_descripcion)
		VALUES ('$param2','$param3','$param4','$id_usuario','$param1','Gastos','$param6')";
		
	}else{
		$sql1="INSERT INTO `asignaciondinero`(`asi_idpromotor`,`asi_fecha`, `asi_valor`,  `asi_idautoriza`,  `asi_idciudad`,asi_tipo,asi_descripcion)
		VALUES ('$id_usuario','$fechaactual','$param4','$id_usuario','$id_sedes','Gastos','$param6')";
	}
	
	$vinculo=$DB->Executeid($sql1);	
	$QL->addDocumento1($_FILES["param7"], 1, "asignaciondinero", $vinculo, "asignaciondinero", $DB);
	$sql="SELECT * from documentos where doc_tabla='asignaciondinero' and doc_idviene='$vinculo' limit 1";
	$valores[7]=$sql; $valores[4]="gastosoperador.php"; $valores[8]=1; 
	break;

    
case "novedades":
	// $param4=str_replace(".","", $param4);

    $param23="".$param101." :00";
    $param24="".$param111." :00";

    $fotonovedades=subirimagen($_FILES["param7"],"imgnovedades");

		
		echo$sql1="INSERT INTO `novedades`( `nov_tipo`,`nov_descripcion`,`nov_estado`,`nov_idusuario`,`nov_fechadesde`, `nov_fechahasta`,`nov_quienregistro`,`nov_fechaingresonov`,`nov_imagen`,`nov_sede`,	`nov_horainicio`,`nov_horafin`) VALUES ('$param8','$param20',1,'$param2','$param5','$param6','$id_usuario','$fechaactualHora','$fotonovedades','$param1','$param23','$param24')";

	
	$vinculo=$DB->Executeid($sql1);	



	$valores[7]=$sql1; $valores[4]="novedades.php"; $valores[8]=1; 
	break;


	case "pqr":
	// $param4=str_replace(".","", $param4);

    $param23="".$param101." :00";
    $param24="".$param111." :00";

    $fotonovedades=subirimagen($_FILES["param7"],"imgnovedades");

		
		echo$sql1="INSERT INTO `pqr`(`pqr_solicitante`,`pqr_tipo`,  `pqr_descripcion`, `pqr_fecha`, `pqr_imagen`,`pqr_sede`,`pqr_estado`) VALUES ('$id_usuario','$param4','$param6','$fechaactual','$fotonovedades','$usu_idsede','0')";

	
	// $vinculo=$DB->Executeid($sql1);	



	$valores[7]=$sql1; $valores[4]="pqrsusu.php"; $valores[8]=1; 
	break;





 case "documentosempresa":
	// $param4=str_replace(".","", $param4);

    // $param23="".$param101." :00";
    // $param24="".$param111." :00";

    // $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");

// ss



 // if (isset($_FILES['parm91']) && $validar==true){ 
 //    for ($i=0; $i<$cantidad; $i++){

 //    echo "<h1>";  $imagen = $_FILES["parm91"]["name"][$i]; echo "</h1>";  


$fotonovedades=subirimagen($_FILES["param91"],"documentosberm");


   echo $sql1=" INSERT INTO `documentos_empre`( `empre_nombre`, `empre_descripcion`, `empre_usuario`, `empre_carpeta`) VALUES ('$fotonovedades','$param90','$id_usuario','$param92')";
 $vinculo=$DB->Executeid($sql1);
//  } 
// }






	// 	echo$sql1="INSERT INTOINSERT INTO `documentos_empre`(`empre_id`, `empre_nombre`, `empre_descripcion`, `empre_per`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')";


	// 	echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";

	
		



	$valores[7]=$sql; $valores[4]="documentosempre.php"; $valores[8]=1; 
	break;

case "documentosreglamento":
	// $param4=str_replace(".","", $param4);

    // $param23="".$param101." :00";
    // $param24="".$param111." :00";

    // $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");

// ss



 // if (isset($_FILES['parm91']) && $validar==true){ 
 //    for ($i=0; $i<$cantidad; $i++){

 //    echo "<h1>";  $imagen = $_FILES["parm91"]["name"][$i]; echo "</h1>";  


$fotonovedades=subirimagen($_FILES["param91"],"documentosberm");


   echo $sql1=" INSERT INTO `documentos_regla`( `regla_nombre`, `regla_descrip`, `regla_usuario`,`regla_carpeta`,`regla_link`) VALUES ('$fotonovedades','$param90','$id_usuario','$param92','$param93')";
 $vinculo=$DB->Executeid($sql1);
//  } 
// }






	// 	echo$sql1="INSERT INTOINSERT INTO `documentos_empre`(`empre_id`, `empre_nombre`, `empre_descripcion`, `empre_per`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')";


	// 	echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";

	
		



	$valores[7]=$sql; $valores[4]="documentoregla.php"; $valores[8]=1; 
	break;

 case "carpetaempresa":
	// $param4=str_replace(".","", $param4);

    // $param23="".$param101." :00";
    // $param24="".$param111." :00";

    // $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");

		echo$sql1="INSERT INTO `carpetasdocumentos`( `carp_nombre`) VALUES ('$param1')";

		
		// echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";

	
	$vinculo=$DB->Executeid($sql1);	



	$valores[7]=$sql; $valores[4]="documentosempre.php"; $valores[8]=1; 
	break;


case "carpetareglamento":
	// $param4=str_replace(".","", $param4);

    // $param23="".$param101." :00";
    // $param24="".$param111." :00";

    // $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");

		echo$sql1="INSERT INTO `carpetasregla`( `carpregla_nombre`) VALUES ('$param1')";

		
		// echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";

	
	$vinculo=$DB->Executeid($sql1);	



	$valores[7]=$sql; $valores[4]="documentoregla.php"; $valores[8]=1; 
	break;

case "capacitacion":
	// $param4=str_replace(".","", $param4);

    // $param23="".$param101." :00";
    // $param24="".$param111." :00";

    // $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");

		echo$sql1="INSERT INTO `capacitacion`( `capaci_nombre`) VALUES ('$param1')";

		
		// echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";

	
	$vinculo=$DB->Executeid($sql1);	



	$valores[7]=$sql; $valores[4]="capaciberm.php"; $valores[8]=1; 
	break;

case "documentocapacitacion":
	// $param4=str_replace(".","", $param4);

    // $param23="".$param101." :00";
    // $param24="".$param111." :00";

    // $fotonovedades=subirimagen($_FILES["param7"],"hojadevidadigi");

// ss



 // if (isset($_FILES['parm91']) && $validar==true){ 
 //    for ($i=0; $i<$cantidad; $i++){

 //    echo "<h1>";  $imagen = $_FILES["parm91"]["name"][$i]; echo "</h1>";  


// $fotonovedades=subirimagen($_FILES["param91"],"documentosberm");


   // echo $sql1=" INSERT INTO `docum_capaci`( `capaci_id`, `capaci_iddocum`, `capaci_idcarp`) VALUES ('$fotonovedades','$param90','$id_usuario','$param92')";

echo $sql1="INSERT INTO `docum_capaci`(`capaci_iddocum`,`capaci_idcarp`,`capaci_link`,`capaci_carpeta`,`capaci_descrip`) VALUES ('$param71','$param70','','$param92','$param95')";



 $vinculo=$DB->Executeid($sql1);
//  } 
// }






	// 	echo$sql1="INSERT INTOINSERT INTO `documentos_empre`(`empre_id`, `empre_nombre`, `empre_descripcion`, `empre_per`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')";


	// 	echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";

	
		



	$valores[7]=$sql; $valores[4]="capaciberm.php"; $valores[8]=1; 
	break;

	case "Sedes":
		
	
	
	   echo $sql1=" INSERT INTO `sedes`( `sed_nombre`, `sed_telefono`, `sed_direccion`, `sed_empresa`) VALUES ('$param90','$$param91','$param92','$param93'		)";
	 $vinculo=$DB->Executeid($sql1);

	
		$valores[7]=$sql; $valores[4]="empreysede.php"; $valores[8]=1; 
	break;

	case "empresa":
		
	 echo$sql1="INSERT INTO `empresa`( `empre_nombre`) VALUES ('$param1')";
		
				
				// echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";
		
			
			$vinculo=$DB->Executeid($sql1);	
		
		
		
			$valores[7]=$sql; $valores[4]="empreysede.php"; $valores[8]=1; 
		break;
    case "proveedor":
		
	 echo$sql1="INSERT INTO `proveedor`( `nom_prove`) VALUES ('$param1')";
			   
					   
		   // echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";
			   
				   
		   $vinculo=$DB->Executeid($sql1);	
			   
		   $valores[7]=$sql; $valores[4]="preveedores.php"; $valores[8]=1; 
    break;
	case "Rol":
		
		echo$sql1="INSERT INTO `roles`( `rol_nombre`,`rol_empresa`) VALUES ('$param1','$param10')";
					  
							  
		// echo$sql1="INSERT INTO `solicitudes`(`soli_validar`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`) VALUES (1,$id_usuario','$param2','$param3','$param1')";
					  
						  
		$vinculo=$DB->Executeid($sql1);	
					  
		$valores[7]=$sql1; $valores[4]="adm_roles.php"; $valores[8]=1; 
    break;
	   

 case "Solicitudes":
	$hoyf=date('Y-m-d');
		
	echo$sql1="INSERT INTO `solicitudes`(`soli_valida`, `soli_idusuario`,`soli_descripcion`,`soli_fecha`,`soli_tipo`,`soli_inicio`,`soli_fin`) VALUES (1,'$id_usuario','$param2','$hoyf','$param1','$param4','$param5')";

	
	// $vinculo=$DB->Executeid($sql1);	



	$valores[7]=$sql1; $valores[4]="solicitudess.php"; $valores[8]=1; 
	break;



	case "horaalmuerzo":
		$sql="UPDATE `seguimiento_user` SET seg_horaalmuerzo='$param3'  WHERE `idseguimiento_user`='$param2' ";

		$valores[7]=$sql; $valores[4]="seguimientouser.php"; $valores[8]=1; 
	break;
	case "horaretorno":
		$sql="UPDATE `seguimiento_user` SET seg_horaregreso='$param3'  WHERE `idseguimiento_user`='$param2' ";

		$valores[7]=$sql; $valores[4]="seguimientouser.php"; $valores[8]=1; 
	break;
	case "horaoficina":
		$sql="UPDATE `seguimiento_user` SET seg_horaoficina='$param3'  WHERE `idseguimiento_user`='$param2' ";

		$valores[7]=$sql; $valores[4]="seguimientouser.php"; $valores[8]=1; 
	break;
	case "zonatrabajo":
		$fecha=$param3;
		$param3=date("$param3 H:i:s");	

		$sql="UPDATE `seguimiento_user` SET seg_idzona='$param6'  WHERE `idseguimiento_user`='$param2' ";

		$valores[7]=$sql; $valores[4]="seguimientouser.php"; $valores[8]=1; 
	break;	
	case "ingresousuario":
		
		$fecha=substr($param3,0,10);
		$param3=date("$fecha H:i:s");	

		$sql="UPDATE `seguimiento_user` SET seg_fechaingreso='$param3',seg_motivo='$param4',seg_descr='$param5',seg_idzona='$param6'  WHERE `idseguimiento_user`='$param2' ";

		$valores[7]=$sql; $valores[4]="seguimientouser.php"; $valores[8]=1; 
	break;
	case "SeguimientoUser":
		$fecha=$param3;
		$param3=date("$param3 H:i:s");	

		 $sql1="INSERT INTO `seguimiento_user`(`seg_idusuario`, `seg_fechaingreso`,seg_motivo,seg_descr,seg_idzona,seg_alcohol,seg_fechaalcohol,`seg_iduserregistro`)
		VALUES ('$param2','$param3','$param4','$param5','$param6','$param7','$fecha','$id_usuario')";
		$vinculo=$DB->Executeid($sql1);
		$QL->addDocumento1($_FILES["param8"], 1, "seguimiento_user", $vinculo, "seguimientouser", $DB);

		$sql="INSERT INTO `pre-operacional`( `prefechaingreso`, `preidusuario`, `preestado`) VALUES ('$param3','$param2','No aplica')";

		$valores[7]=$sql; $valores[4]="seguimientouser.php"; $valores[8]=1; 
	break;
	case "crearalarma":

		 $sql1="INSERT INTO `reportealertas`(`rep_idsede`,`rep_alerta`, `rep_fechavencimiento`, `rep_fechareporte`, `rep_emails`, `rep_useractualiza`) VALUES 
		  ('$param1','$param2','$param3','$fechaactual','$param4','$id_nombre')";
		$vinculo=$DB->Executeid($sql1);
		if($_FILES["param5"]!=''){
			$QL->addDocumento1($_FILES["param5"], 1, "reportealarmas", $vinculo, "reportealarmas", $DB);
		}
		$sql='Select 1';
		$valores[7]=$sql; $valores[4]="reportealertas.php"; $valores[8]=1; 
	break;	
	case "ingresopruebacovid":
		$fecha=date("Y-m-d");
		$param3=date("Y-m-d H:i:s");
	
		if($param7!='0'){
			 $sql1="INSERT INTO `seguimiento_user`(`seg_idusuario`,seg_alcohol,seg_fechaalcohol)
			VALUES ('$id_usuario','$param7','$fecha')";
			$vinculo=$DB->Executeid($sql1);
			$QL->addDocumento1($_FILES["param8"], 1, "seguimiento_user", $vinculo, "seguimientouser", $DB);
		
			$sql="Select idseguimiento_user from seguimiento_user where idseguimiento_user=$vinculo";
	
		}
		$valores[7]=$sql; $valores[4]="inicio.php"; $valores[8]=1; 
	break;
	case "ingresoprueba":
		$fecha=date("Y-m-d");
		$param3=date("Y-m-d H:i:s");	
//registro de la huellas 

		 $sql1="INSERT INTO `seguimiento_user`(`seg_idusuario`,seg_alcohol,seg_fechaalcohol)
		VALUES ('$param2','$param7','$fecha')";
		$vinculo=$DB->Executeid($sql1);
		$QL->addDocumento1($_FILES["param8"], 1, "seguimiento_user", $vinculo, "seguimientouser", $DB);

		$sql="INSERT INTO `pre-operacional`( `prefechaingreso`, `preidusuario`, `preestado`) VALUES ('$param3','$param2','No aplica')";

		$valores[7]=$sql; $valores[4]="seguimientouser.php"; $valores[8]=1; 
	break;
	case "Vehiculos":

		  $sql1="INSERT INTO `vehiculos`(`veh_tipo`, `veh_marca`, `veh_placa`, `veh_modelo`,`veh_dueño`, `veh_fechaseguro`, `veh_fechategnomecanica`, `veh_fechamantenimiento`, `veh_kilactual`, `veh_aceitekil`, `veh_estado`,`veh_color`, `veh_tipov`, `veh_chasis`, `veh_motor`, `veh_cilidraje`, `veh_usuve`, `veh_observaciones`) 	
		 VALUES ('$param1','$param2','$param3','$param4','$param5','$param6','$param7','$param8','$param9','$param10','$param11','$param12','$param13','$param14','$param15','$param16','$param17','$param18')";
		$vinculo=$DB->Executeid($sql1);

		if($_FILES["param19"]!=''){
			$QL->addDocumento1($_FILES["param19"], 1, "Vehiculos", $vinculo, "vehiculo", $DB);

		}
	if($_FILES["param20"]!=''){
		$QL->addDocumento1($_FILES["param20"], 2, "Vehiculos", $vinculo, "vehiculo", $DB);
	} if($_FILES["param21"]!=''){
		$QL->addDocumento1($_FILES["param21"], 2, "Vehiculos", $vinculo, "vehiculo", $DB);
	} if($_FILES["param22"]!=''){

		$QL->addDocumento1($_FILES["param22"], 2, "Vehiculos", $vinculo, "vehiculo", $DB);
	}
		$sql="Select * from vehiculos where idvehiculos='$vinculo' ";
		$valores[7]=$sql; $valores[4]="adm_vehiculos.php"; $valores[8]=1; 
	break;
	case "Remesas":
	$param5=str_replace(".","", $param5);
	$user="SELECT usu_nombre FROM usuarios  where  idusuarios='$param7' ";
	$DB->Execute($user);
	$nomuser=$DB->recogedato(0);

	$sql1="INSERT INTO `gastos`(`idgastos`, `gas_idciudadori`, `gas_idciudaddes`, `gas_empresa`, `gas_bus`, `gas_telconductor`,`gas_pagar`,`gas_iduserremesa`, `gas_nomremesa`,`gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,`gas_idusuario`, `gas_fecharegistro`)
	VALUES ('','$param1','$param2','$param3','$param4','$param5','$param6','$param7','$nomuser','$param8','$param9','$param10','$param11','$id_usuario','$fechatiempo')";
	$vinculo=$DB->Executeid($sql1);	
	$QL->addDocumento1($_FILES["param12"], 2, "gastos", $vinculo, "remesas", $DB);
	$sql="SELECT * from documentos where doc_tabla='gastos' and doc_idviene='$vinculo' and doc_version=2 limit 1";


	$valores[7]=$sql; $valores[4]="gastos.php"; $valores[8]=1; 
	
	break;


///BERMUDAS
	case "cargaarchivo":

		
		$fotonovedades=subirimagen($_FILES["param3"],"documentosberm");	


	echo $sql1=" INSERT INTO `archivos_bermudas`( `arc_nombre`, `arc_fechacarga`, `arc_idusuario`, `arc_descrip`) VALUES ('$fotonovedades','$param2','$param93','$param1')";
	$vinculo=$DB->Executeid($sql1);
   
	   
	$valores[7]=$sql; $valores[4]="preveedores.php"; $valores[8]=1; 
	   


// $user="SELECT arc_id  FROM archivos_bermudas ORDER by arc_id desc LIMIT 1";

// // $user="SELECT arc_id   FROM archivos_bermudas  where  idusuarios='$param7' ";
// 	$DB->Execute($user);
// 	$idemax=$DB->recogedato(0);

// 	$idmaxfin=$idemax+1;
	
//  if (is_uploaded_file($_FILES['param3']['tmp_name'])){


// if ($_FILES['param3']['type']=='application/pdf' ){

// // $var1 =".pdf";
// 	$paramfin=$idmaxfin."_".$param1.".pdf";
//  $imagen = $paramfin;


// }elseif($_FILES['param3']['type']=='Document/docx'){


// 	// $paramfin=$idmaxfin."_".$param1.".doc";
//  $imagen = $_FILES['param3']['name'];




// }elseif($_FILES['param3']['type']=='application/xlsx'){



// 	$paramfin=$idmaxfin."_".$param1.".xlsx";
//  $imagen = $paramfin;


// }elseif($_FILES['param3']['type']=='image/png'){

// 	$paramfin=$idmaxfin."_".$param1.".png";
//  $imagen = $paramfin;




// }

// 		// $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";
//         // $imagen = $param1;
// 		move_uploaded_file($_FILES['param3']['tmp_name'], "./archivosBP/".$imagen);

// 	 }else{
// 	 	$imagen = "";
// 	 }
// 	$sql1="INSERT INTO `archivos_bermudas`( `arc_fechacarga`,`arc_nombre`, `arc_idusuario`)
// 	VALUES ('$param2','$imagen','$param4')";
// 	$vinculo=$DB->Executeid($sql1);	
// 	// $QL->addDocumento1($_FILES["param12"], 2, "gastos", $vinculo, "remesas", $DB);
// 	// $sql="SELECT * from documentos where doc_tabla='gastos' and doc_idviene='$vinculo' and doc_version=2 limit 1";


// 	$valores[7]=$sql; $valores[4]="gastos.php"; $valores[8]=1; 
	
	break;
	case "validarpreoperacional":

	$estado=$_POST["estado"]; 
	$data=$_POST["data"]; 
	if($estado=='covid19'){
		$estado='Validado Covid19';
	}else{
		$estado='Validado';
	}
	$sql="UPDATE `pre-operacional` SET `prefechavalidacion`='$fechatiempo',`predatosvalidados`='$data',`pre_descvalidada`='$param10',pre_iduservalida='$id_usuario',`preestado`='$estado', `pre_correctiva`='$param9', `pre_responsable`='$param9', `pre_temperatura`='$param19', `pre_kilrecorridos`='$param12' WHERE idpreoperacinal=$param11";
	$QL->addDocumento1($_FILES["param20"], 1, "pre-operacional", $param11, "preoperacional", $DB);
	if($param12>0){
		$sql2="UPDATE vehiculos set veh_kilactual='$param12' where idvehiculos='$param1'";
		$DB->Execute($sql2);
	}
	$valores[7]=$sql; $valores[4]="seguimientouser.php"; $valores[8]=1; 
	break;
	case "Temperatura":

		$QL->addDocumento1($_FILES["param2"], 2, "pre-operacional", $id_param, "preoperacional", $DB);
		$sql="SELECT * from `pre-operacional` where idpreoperacinal=$id_param";
		$valores[7]=$sql; $valores[4]="inicio.php"; $valores[8]=1; 
	break;
	case "preoperacional":
		
		$data=$_POST["data"]; 
		$estado=$_POST["estado"]; 
		$sql1="INSERT INTO `pre-operacional`(`prevehiculo`, `pretipovehiculo`, `prefechaingreso`, `preidusuario`, `preencuesta`,`preestado`,`pre_obsevaciones`, `pre_correctiva`, `pre_responsable`,`pre_temperatura`,`pre_kilrecorridos`,`pre_codigoimpresora`,`pre_limpiomaleta`)
		VALUES ('$param1','$param2','$fechatiempo','$id_usuario','$data','$estado','$param7','$param8','$param9','$param19','$param12','$param20','$param21')";
		$vinculo=$DB->Executeid($sql1);	
		$QL->addDocumento1($_FILES["param20"], 1, "pre-operacional", $vinculo, "preoperacional", $DB);
		if($param12>0){
			$sql2="UPDATE vehiculos set veh_kilactual='$param12' where idvehiculos='$param1'";
			$DB->Execute($sql2);
		}

		$sql="SELECT * from `pre-operacional` where idpreoperacinal=$vinculo";
		$valores[7]=$sql; $valores[4]="inicio.php"; $valores[8]=1; 
	break;
	case "RegistrarPago":

		$sql="UPDATE `incapacidades` SET `ref_fechapagoincapacidad`='',`ref_valorpagado`='',`ref_validadopago`='',`ref_fechavalidacion`=''  WHERE `idincapacidades`='$param4' ";
		$valores[7]=$sql; $valores[4]="new_hojadevida.php"; $valores[8]=1; 

	break;
	case "pruebaalcohol":
		//$fecha=$_POST["fecha"]; 
		$fecha=$param3;
		

		if($param5=='update'){
			 $sql="UPDATE `seguimiento_user` SET  `seg_alcohol` ='$param1'  WHERE `idseguimiento_user`='$param4' ";
			$vinculo=$param4;

		}else{


			if($param1=='Positivo'){
				$sql2="INSERT INTO `seguimiento_user`(`seg_idusuario`, `seg_fechaingreso`,seg_descr,seg_motivo,seg_idzona,`seg_iduserregistro`)
				VALUES ('$param2','$param3','Positivo alcoholemia','Sancionado','Sin zona','$id_usuario')";
				$alcolemia=$DB->Executeid($sql2);	
			}			

			$sql1="INSERT INTO  `seguimiento_user`(seg_alcohol,seg_idusuario,seg_fechaalcohol) VALUES ('$param1','$param4','$fecha'); ";
			$vinculo=$DB->Executeid($sql1);	
			$sql="SELECT seg_alcohol FROM `seguimiento_user`   WHERE `idseguimiento_user`='$vinculo' ";
		}

		$QL->addDocumento1($_FILES["param2"], 1, "seguimiento_user", $vinculo, "seguimientouser", $DB);
	
		if($nivel_acceso!=1 and $nivel_acceso!=5 and $nivel_acceso!=12){
			$pagina="nuevo_admin.php?tabla=ingresoprueba";
		}else{
			$pagina="seguimientouser.php?param34=$fecha";
		}
		$valores[7]=$sql; $valores[4]="$pagina"; $valores[8]=1; 

	break;
	case "Cierre del dia":

	$param5=str_replace(".","", $param5);
	
	$dinero=$_POST["dinero"];
	$valoresjson=$_POST["valoresjs"];
	$valores2json=$_POST["valores2js"];
	
	//$idciudad=$_REQUEST["idciudad"];
	$fechacierre=$_REQUEST["fecharecierre"];
	$sel="DELETE FROM cuentassede WHERE cus_idsede='$id_param' and  cus_fecha like '$fechacierre%'";
	$DB->Execute($sel);	

	$fechacierre= date("$fechacierre H:i:s"); 
	$valoresjson=json_decode($valoresjson);
	$valores2json=json_decode($valores2json);
	
	$sql="INSERT INTO `cuentassede`(`cus_idsede`, `cus_fecha`, `cus_dinerosede`, `cus_datos`,`cue_caja`) VALUES  ('$id_param','$fechacierre','$dinero','$valoresjson','$valores2json')";
	
	$valores[7]=$sql; $valores[4]="cajasciudades.php"; $valores[8]=1; 

	break;
	case "Clientes":
	//$param5=$param5."&".$param51."&".$param19."&".$param20;  
	$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
	$param5 = str_replace('&0&','&&', $param5);
	
	$sql="INSERT INTO `clientes`(`cli_iddocumento`, `cli_nombre`, `cli_telefono`, `cli_idciudad`, `cli_direccion`, `cli_email`, `cli_clasificacion`, `cli_tipo`, `cli_fecharegistro`) 
		VALUES ('$param1','$param2','$param3','$param4','$param5','$param6','$param7',2,'$fechatiempo')";
	$valores[7]=$sql; $valores[4]="clientes.php"; $valores[8]=1; 
	break;
	case "Usuario":
		$param4=md5($param4);
	 	 $sql="INSERT INTO `usuarios`(roles_idroles, usu_nombre, usu_usuario,usu_pass,usu_mail,usu_idtipodocumento,usu_identificacion, usu_genero,  usu_idsede, usu_idempresa,  usu_celular,usu_tipovehiculo,usu_vehiculo,usu_licencia,usu_fechalicencia,usu_tipocontrato,usu_estado,usu_psico_as) VALUES 
		('$param1','$param2','$param3','$param4','$param5','$param6','$param7','$param8','$param71','$param10','$param12','$param18','$param19','$param20','$param21','$param22','$param14','$param24')";
	if ($param1==28)
	{
	echo$sql1="INSERT INTO `hojadevida` (`hoj_nombre`,`hoj_cedula`,`hoj_estado`,`hoj_sede`) VALUES ('$param2', '$param7','Activo','$param71')";
	$DB->Execute($sql1);
	}



	$valores[7]=$sql; $valores[4]="adm_usuarios.php"; $valores[8]=1; 

	break;
	case "rel_crecli": 
		if(@$param5==''){
			 $sql="SELECT `idclientesdir` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  where cli_telefono=$param2";
			$DB->Execute($sql);
			 $param5=$DB->recogedato(0);
		}

		$sql="INSERT INTO `rel_crecli`( `rel_idcredito`, `rel_idcliente`) VALUES ('$param1','$param5')";
		$valores[7]=$sql; $valores[4]="relacioncreditos.php"; $valores[8]=1; 
	break;
	case "TipoPago": 
		$fechat=date("$param5 H:i:s");
		$sql="UPDATE `facturascreditos` SET `fac_fechapago`='$fechat',`fac_tipopago`='$param4',fac_userpago='$id_nombre' WHERE idfacturascreditos='$param2'";
		$valores[7]=$sql; $valores[4]="informecreditos.php"; $valores[8]=1; 
	break;
	case "tipocontrato": 
		$sql="UPDATE `usuarios` SET `usu_tipocontrato`='$param22' WHERE idusuarios='$param2'";
		$valores[7]=$sql; $valores[4]="adm_usuarios.php"; $valores[8]=1; 
	break;
	case "Buzon": 
		$sql=" INSERT INTO noticia (not_fecha, not_titulo, not_descripcion, not_expiracion,not_idrol,not_idusuario) VALUES ('$fechaactual', '$param1', '$param2', '$param3','$param4','$id_usuario')";
		
		$valores[7]=$sql; $valores[4]="buzon.php"; $valores[8]=1; 
		break;
	case "Abonos": 
		if($param5!=''){
			$param1=str_replace(".","", $param1);
			$sql="INSERT INTO `abonosguias`(`abo_fecha`, `abo_valor`, `abo_idservicio`, `abo_iduser`, `abo_idsede`, `abo_estado`)  VALUES ('$fechatiempo','$param1','$param5','$id_usuario','$id_sedes','abono')";
		
			 $sql3="update  `servicios` set ser_valorabono=ser_valorabono+$param1 where idservicios='$param5'";
			$DB->Execute($sql3);
			//echoLog($sql3);
			 $sql4="update  `cuentaspromotor` set cue_abono=cue_abono+$param1 where cue_idservicio='$param5'";
			 $DB->Execute($sql4);
			//echoLog($sql3);
			$valores[7]=$sql; $valores[4]="asignar_abonos.php"; $valores[8]=1; 
			
		}else{
			$sql="";
		}
		$valores[7]=$sql; $valores[4]="asignar_abonos.php"; $valores[8]=1; 
	
	break;
	case "reclamos": 
		if($param10!=''){
		
			$variableunica=date("Y").date("m").date("d").date("h").date("i").date("s").$id_usuario;
			$sql="INSERT INTO `reclamos`(`rec_numero`, `rec_fechaingreso`, `rec_fechaenvio`, `rec_tipo`, `rec_nombre`, `rec_telefono`, `rec_correo`,`rec_descripcion`, `rec_guia`, `rec_idservicio`, `rec_ciudadenvio`, `rec_direccion`, `rec_userregistra`,rec_estado) 
			values ('$variableunica','$fechaactual','$param8','$param9','$param4','$param5','$param6','$param7','$param2','$param10','$param1','$param11','$id_nombre','Abierto')";
			$vinculo=$DB->Executeid($sql);
			 $sql3="update  `servicios` set ser_estado='18' where idservicios='$param10'";
			$DB->Execute($sql3);
			//echoLog($sql3);
			 $sql="update  `cuentaspromotor` set cue_estado='18' where cue_idservicio='$param10'";
			 //$DB->Execute($sql);
			//echoLog($sql3);
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
			
		}else{
			$sql="";
		}
		$valores[7]=$sql; $valores[4]="reclamos.php"; $valores[8]=1; 
	
	break;
	case "crearfactura": 
		
		$sql="UPDATE `facturascreditos` SET `fac_fechafacturado`='$param4',`fac_fechavencimiento`='$param5',`fac_estado`='Facturado',`fac_iduserfac`='$id_usuario',`fac_idfacturados`='$param9',`fac_precio`='$param1',`fac_numeroref`='$param2',fac_tipopago='Pendiente' WHERE idfacturascreditos='$param8'";
			
		if($DB->Execute($sql)){
			$sel="UPDATE `servicios` SET `ser_numerofactura`='$param2' where `idservicios` in ($param9)";
			$DB->Execute($sel);	
		}
		$valores[7]=$sql; $valores[4]="informecreditos.php"; $valores[8]=1; 

	break;
	case "reportealarmas": 
		
		$sql="UPDATE `reportealertas` SET `rep_fechavencimiento`='$param1',`rep_fechareporte`='$fechaactual',`rep_useractualiza`='$id_nombre' WHERE idreportealertas='$id_param'";
		$DB->Execute($sql);	
		if($_FILES["param5"]!=''){
			$QL->addDocumento1($_FILES["param5"], 1, "reportealarmas", $id_param, "reportealarmas", $DB);
		}
		$valores[7]=$sql; $valores[4]="reportealertas.php"; $valores[8]=1; 
		
	break;
	case "cambiarfactura": 

		$sql="UPDATE `facturascreditos` SET `fac_numeroref`='$param1' WHERE idfacturascreditos='$param2'";
		
		if($DB->Execute($sql)){
			$sel="UPDATE `servicios` SET `ser_numerofactura`='$param1' where `ser_numerofactura`='$valor'";
			$DB->Execute($sel);	
		}
		$valores[7]=$sql; $valores[4]="informecreditos.php"; $valores[8]=1; 

	break;
	case "fecharadicado": 

		$sql="UPDATE `facturascreditos` SET  fac_userradicado='$id_nombre', `fac_fecharadicado`='$param1' WHERE idfacturascreditos='$param2'";				
		$QL->addDocumento1($_FILES["param3"], 1, "facturascreditos", $param2, "facturascreditos", $DB);

		$valores[7]=$sql; $valores[4]="informecreditos.php"; $valores[8]=1; 
	break;
	case "devolucion": 
		if($param5!=''){
			$param1=str_replace(".","", $param1);
			$sql="INSERT INTO `abonosguias`(`abo_fecha`, `abo_valor`, `abo_idservicio`, `abo_iduser`, `abo_idsede`, `abo_estado`)  VALUES ('$fechatiempo','$param1','$param5','$id_usuario','$id_sedes','devolucion')";
		
	/* 		$sql3="update  `servicios` set ser_valorabono=ser_valorabono-$param1 where idservicios='$param5' and ser_estado<=3";
			$DB->Execute($sql3);
			$sql4="update  `cuentaspromotor` set cue_abono=cue_abono-$param1 where cue_idservicio='$param5' and cue_estado<=3";
			$DB->Execute($sql4); */

			$valores[7]=$sql; $valores[4]="asignar_abonos.php"; $valores[8]=1; 

		}else{
			$sql="";
		}
		$valores[7]=$sql; $valores[4]="asignar_abonos.php"; $valores[8]=1; 
	
	break;
	case "Usuarios-Roles":
	$sel="SELECT idusuarios, roles_idroles, usu_nombre, usu_mail, usu_pass, usu_identificacion FROM usuarios WHERE usu_mail='$id_param'";
	$DB->Execute($sel);		
	$rw=mysql_fetch_row($DB->Consulta_ID);
	$sel="DELETE FROM usuarios WHERE usu_mail='$id_param'";
	$DB->Execute($sel);		
	foreach ($_POST['roles'] as $checkbox){ 
		$saa="INSERT INTO usuarios (idusuarios, roles_idroles, usu_nombre, usu_mail, usu_pass, usu_token, usu_identificacion, usu_estado) 
		VALUES ('', '$checkbox', '$rw[2]', '$rw[3]', '$rw[4]', '', '$rw[5]', '1')";
		$DB->Execute($saa);
	}	  
	$valores[7]="SELECT 0"; $valores[4]="adm_usuarios.php"; $valores[8]=1; 
	break;

	case "Asignar Permisos":
	$condel="";
	if($_POST["permi"]!="0"){  $condel=" AND frp_permiso='".$_POST["permi"]."'";  }
	
	$sel="DELETE FROM formroles WHERE actindgener_idactindgener='$id_param' $condel";
	$DB->Execute($sel);	
	if($_POST["permi"]=="0"){ 
		$sel="DELETE FROM formvisitas WHERE actindgener_idactindgener='$id_param' ";
		$DB->Execute($sel);
	}
	foreach ($_POST['roles'] as $checkbox){ 
		$saa="INSERT INTO formroles (idformroles, actindgener_idactindgener, roles_idroles, frp_permiso) VALUES ('', '$id_param', '$checkbox', '1' )";
		$DB->Execute($saa);
	}	  
	foreach ($_POST['roler'] as $checkbox){ 
		$saa="INSERT INTO formroles (idformroles, actindgener_idactindgener, roles_idroles, frp_permiso) VALUES ('', '$id_param', '$checkbox', '2' )";
		$DB->Execute($saa);
	}	  
	foreach ($_POST['rolea'] as $checkbox){ 
		$saa="INSERT INTO formroles (idformroles, actindgener_idactindgener, roles_idroles, frp_permiso) VALUES ('', '$id_param', '$checkbox', '3' )";
		$DB->Execute($saa);
	}	  
	foreach ($_POST['visitas'] as $checkbox){ 
		$saa="INSERT INTO formvisitas (idformvisitas, actindgener_idactindgener, vis_visita) VALUES ('', '$id_param', '$checkbox' )";
		$DB->Execute($saa);
	}
	$valores[7]="SELECT 0"; $valores[4]=$_SERVER['HTTP_REFERER']."&activo1=2"; $valores[8]=1; 
	break;
	case "Edita tu perfil":
	$saa="UPDATE usuarios SET usu_nombre='".$_POST["paramc1"]."', usu_mail='".$_POST["paramc2"]."', usu_pass='".md5($_POST["paramc3"])."' WHERE idusuarios='$id_usuario'";
	$DB->Execute($saa);
	$QL->addDocumento1($_FILES["paramc4"], 1, "Usuario", $id_usuario, "", $DB);
	$valores[7]="SELECT 0"; $valores[4]=$_SERVER['HTTP_REFERER']; $valores[8]=1; 
	break;


	default:
		$valores=$LT->devuelvecampos($tabla, 1, "");

	break;
}

if($valores[8]==1) {
	
	if($DB->Execute($valores[7])){$bandera=1;} else {$bandera=4;} ; }

else {$bandera=$QL->insert($valores[0], $valores[1], $valores[6], $valores[5], $DB, $tabla, 1); //funcion insert 

 }

if($bandera==1){
	//echo $tabla;
	switch($tabla){

		case "Formulario":
		$sel="SELECT idactindgener FROM actindgener ORDER BY idactindgener DESC";
		$DB->Execute($sel);
		$id_param=$DB->recogedato(0);
		if($_POST["param5"]!="Consulta"){
			$sql_create="CREATE TABLE IF NOT EXISTS respuesta_$idencuesta (idrespuesta_$idencuesta MEDIUMINT NOT NULL AUTO_INCREMENT,
			actindgener_idactindgener INT, preguntas1_idpreguntas1 INT, res_respuesta VARCHAR(1500) NOT NULL, res_justificacion VARCHAR(1500) NOT NULL, 
			res_fecha DATETIME, res_tipopreg VARCHAR(50), res_idunico VARCHAR(50), res_orden INT, res_estado INT, PRIMARY KEY (idrespuesta_$idencuesta) );";
			$DB->Execute($sql_create);
			$va2=$_POST["va2"];
			for($j=1; $j<=$va2; $j++)
			{
				if(isset($_POST["prg$j"])) { $param3=$_POST["prg$j"]; } else { $param3=""; } 
				if($param3!=""){  
					if(isset($_POST["obe$j"])) { $obe=$_POST["obe$j"]; if($obe=="on"){$obe=1;} else {$obe=0;} } else { $obe=""; } 
					if(isset($_POST["tru$j"])) { $tru=$_POST["tru$j"]; } else { $tru=""; } 
					if(isset($_POST["urd$j"])) { $urd=$_POST["urd$j"]; } else { $urd=""; } 
					if(isset($_POST["tpi$j"])) { $tpi=$_POST["tpi$j"]; } else { $tpi=""; } 
					if(isset($_POST["arr$j"])) { $arr=$_POST["arr$j"]; } else { $arr=""; } 
					if(isset($_POST["par$j"])) { $par=$_POST["par$j"]; if($par=="on"){$par=1;} else {$par=0;}  } else { $par=""; } 
					if(isset($_POST["jus$j"])) { $jus=$_POST["jus$j"]; } else { $jus=""; } 
					if(isset($_POST["dep$j"])) { $dep=$_POST["dep$j"]; } else { $dep=""; } 
					if(isset($_POST["con$j"])) { $con=$_POST["con$j"]; } else { $con=""; } 
					if(isset($_POST["met$j"])) { $met=$_POST["met$j"]; if($met=="on"){$met=1;} else {$met=0;}  } else { $met=""; } 
					if(isset($_POST["con$j"])) { $con=$_POST["con$j"]; } else { $con=""; } 
					if(isset($_POST["vmetas$j"])) { $pre=$_POST["vmetas$j"]; } else { $pre=""; } 
					if(isset($_POST["agr$j"])) { $agr=$_POST["agr$j"]; } else { $agr=""; } 
					$sql3="INSERT INTO preguntas1 (idpreguntas1, actindgener_idactindgener, pre_pregunta, pre_tipo, pre_array, pre_parametrizacion, pre_orden, pre_obligatoria, 
					pre_componente, pre_justifica, pre_depende, pre_condicion, pre_areages, pre_proceso) 
					VALUES ('', '$id_param', '$param3', '$tpi', '$arr', '$par', '$urd', '$obe', '$tru', '$jus', '$dep', '$con', '$pre', '$agr') ";
					$DB->Execute($sql3);
				}	
			}
		}
		else {
			$sel="UPDATE actindgener SET aci_array='".$_POST["para-12"]."' WHERE idactindgener='$id_param'";
			$DB->Execute($sel);
		}
		break;
		case "cajamenor":

		break;
	}
}
//header("Location:$valores[4]");

header ("Location: $valores[4]?bandera=$bandera&id_param=$id_param&condecion=$condecion&tabla=$tabla");
?>