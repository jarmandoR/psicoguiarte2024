<?php
require("login_autentica.php");
include("declara.php");
$tabla=$_REQUEST["tabla"];
$id_param=$_REQUEST["id_param"];
if(isset($_REQUEST["condecion"])){ $condecion=$_REQUEST["condecion"]; } else { $condecion=""; } 
$conde=""; $bandera=1;
$tabla1=$tabla;
if($condecion=='general'){  $tabla='General'; }
elseif($condecion=='delete'){
	$tabla='delete';
}
switch($tabla)
{

	case "Elimina Archivo1":
	$valores[7]="DELETE FROM documentos WHERE iddocumentos='$id_param'  "; 
	$valores[8]=1; $valores[4]=$_SERVER["HTTP_REFERER"]; $id_param=""; $ir=1;
	break;
	case "Clientes":
	
	/* $sql1="DELETE FROM `clientesdir` WHERE `cli_idclientes`='$id_param'";
	$DB->Execute($sql1); */
	
	//$valores[7]="DELETE FROM `clientes` WHERE `idclientes`='$id_param'  "; 
	$valores[7]="DELETE FROM `clientesdir` WHERE `cli_idclientes`='$id_param' "; 
	$valores[8]=1; $valores[4]='clientes.php'; $id_param=""; $ir=1;
	
	break;
	case "referenciasfamiliares":
	$valores[7]="DELETE FROM referenciasfamiliares WHERE idrefenciasfamiliares='$id_param'  "; 
	$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=datosfamiliares&idhojadevida=$condecion"; $id_param=""; $ir=3;
	$tabla=$tabla1;
	break;
	case "referenciaslaborales":
		$valores[7]="DELETE FROM referenciaslaborales WHERE idreferenciaslaborales='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=datoslaborales&idhojadevida=$condecion"; $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "seguimientousers":
		$valores[7]="DELETE FROM seguimientousers WHERE seg_id ='$id_param'  "; 
		$valores[8]=1; $valores[4]="seguimientouser.php"; $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "seguridadsocial":
		$valores[7]="DELETE FROM seguridadsocial WHERE idseguridadsocial='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=datossalud&idhojadevida=$condecion"; $id_param=""; $ir=3;
	break;	
	case "memorandos":
		$valores[7]="DELETE FROM memorandos WHERE idmemorandos='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=memorandos&idhojadevida=$condecion"; $id_param=""; $ir=3;
	break;
	case "examenesmedicos":
		$valores[7]="DELETE FROM examenesmedicos WHERE idexamenesmedicos='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=examenesmedicos&idhojadevida=$condecion"; $id_param=""; $ir=3;
	break;
	case "elementostrabajo":
	$valores[7]="DELETE FROM elementostrabajo WHERE idelementostrabajo='$id_param'  "; 
	$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=dotacion&idhojadevida=$condecion"; $id_param=""; $ir=3;
	$tabla=$tabla1;
	break;	
	case "elementostrabajo":
		$valores[7]="DELETE FROM elementostrabajo WHERE idelementostrabajo='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=dotacion&idhojadevida=$condecion"; $id_param=""; $ir=3;
		$tabla=$tabla1;
		break;	
	case "referenciassalud":
		$valores[7]="DELETE FROM referenciassalud WHERE idrefenciassalud='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=saludafiliaciones&idhojadevida=$condecion"; $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "reportealarmas":
		$valores[7]="DELETE FROM reportealertas WHERE idreportealertas='$id_param'  "; 
		$valores[8]=1; $valores[4]="reportealertas.php"; $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	////////
	case "pqr":
		$valores[7]="DELETE FROM `pqr` WHERE pqr_id='$id_param'  "; 
		$valores[8]=1; $valores[4]="pqrsusu.php"; $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
    case "usuarios_huella":

        $valores[7]="DELETE FROM $tabla1 WHERE 	documento='$id_param'  "; 
        $sql1="DELETE FROM huellas WHERE documento='$id_param'  "; 
         $DB1->Execute($sql1);
		$valores[8]=1; $valores[4]="editaruserhuellas.php"; $id_param=""; $ir=2;
		$tabla=$tabla1;
	
	break;

	case "Incapacidades":
		$valores[7]="DELETE FROM incapacidades WHERE idincapacidades='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=Incapacidades&idhojadevida=$condecion"; $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;

	case "novedades":
		$valores[7]="DELETE FROM novedades WHERE novid ='$id_param'  "; 
		$valores[8]=1; $valores[4]="novedades.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "documentosempre":
		$valores[7]="DELETE FROM documentos_empre WHERE empre_id ='$id_param'  "; 
		$valores[8]=1; $valores[4]="documentosempre.php";

$user="SELECT empre_nombre FROM documentos_empre  where  empre_id ='$id_param' ";
	$DB->Execute($user);
	$nomuser=$DB->recogedato(0);


$linkeliminar="documentosberm/".$nomuser."";

		If (unlink($linkeliminar)) {

			
  // file was successfully deleted
} else {
  // there was a problem deleting the file
}
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "Carpetasempresa":
		$valores[7]="DELETE FROM carpetasdocumentos WHERE carp_id  ='$id_param'  "; 
		$valores[8]=1; $valores[4]="documentosempre.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "solicitudes":
		$valores[7]="DELETE FROM solicitudes WHERE soli_id ='$id_param'  "; 
		$valores[8]=1; $valores[4]="solicitudess.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "Carpetasreglamento":
		$valores[7]="DELETE FROM carpetasregla WHERE carpregla_id  ='$id_param'  "; 
		$valores[8]=1; $valores[4]="documentoregla.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "documentosreglamento":
		$valores[7]="DELETE FROM documentos_regla WHERE regla_id  ='$id_param'  "; 
		$valores[8]=1; $valores[4]="documentoregla.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "carpetascapacitacion":
		$valores[7]="DELETE FROM capacitacion WHERE capaci_id  ='$id_param'  "; 
		$valores[8]=1; $valores[4]="capaciberm.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "documentocapacitacion":
		$valores[7]="DELETE FROM docum_capaci WHERE capaci_id  ='$condecion'  "; 
		$valores[8]=1; $valores[4]="capaciberm.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "Sedes":
		$valores[7]="DELETE FROM sedes WHERE idsedes ='$id_param'  "; 
		$valores[8]=1; $valores[4]="empreysede.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "empresa":
		$valores[7]="DELETE FROM empresa WHERE empre_id  ='$id_param'  "; 
		$valores[8]=1; $valores[4]="empreysede.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "proveedor":
		$valores[7]="DELETE FROM proveedor WHERE id_prove  ='$id_param'  "; 
		$valores[8]=1; $valores[4]="preveedores.php";
		 $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "entregavehiculo":
		$valores[7]="DELETE FROM entregavehiculo WHERE identregavehiculo='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=datosvehiculo&idhojadevida=$condecion"; $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "referenciasestudio":
		$valores[7]="DELETE FROM referenciasestudio WHERE idreferenciasestudio='$id_param'  "; 
		$valores[8]=1; $valores[4]="new_hojadevida.php?bandera=1&condecion=datosestudios&idhojadevida=$condecion"; $id_param=""; $ir=3;
		$tabla=$tabla1;
	break;
	case "General":
		$valores[7]="DELETE FROM $tabla1 WHERE id$tabla1='$id_param'  "; 
		$valores[8]=1; $valores[4]="adm_general.php"; $id_param=""; $ir=2;
		$tabla=$tabla1;
		break;
		case "delete":
			$valores[7]="DELETE FROM $tabla1 WHERE id$tabla1='$id_param'  "; 
			$valores[8]=1;  $id_param=""; $ir=1;
			$tabla=$tabla1;
			break;
			
	case "Abonos":
		$valores[7]="DELETE FROM abonosguias WHERE idabono='$id_param'  "; 

		$sql1="SELECT `idabono`, `abo_fecha`, `abo_valor`, `abo_idservicio`, `abo_iduser`, `abo_idsede`, `abo_estado` FROM `abonosguias` where idabono=$id_param";
		$DB1->Execute($sql1);
		$rw3=mysqli_fetch_array($DB1->Consulta_ID);	
		if($rw3[6]=='devolucion'){

			$sql3="update  `servicios` set ser_valorabono=ser_valorabono+$rw3[2] where idservicios='$rw3[3]'";
			$DB->Execute($sql3);
	
			$sql4="update  `cuentaspromotor` set cue_abono=cue_abono+$rw3[2] where cue_idservicio='$rw3[3]'";
			$DB->Execute($sql4);
			
		}else{
		$sql3="update  `servicios` set ser_valorabono=ser_valorabono-$rw3[2] where idservicios='$rw3[3]'";
		$DB->Execute($sql3);

		$sql4="update  `cuentaspromotor` set cue_abono=cue_abono-$rw3[2] where cue_idservicio='$rw3[3]'";
		$DB->Execute($sql4);
		}

		$valores[8]=1; $valores[4]="asignar_abonos.php"; $id_param=""; $ir=2;
		$tabla=$tabla1;
		break;
	default:
	
	$valores=$LT->devuelvecampos($tabla, 3, $id_param);
	//print_r($valores);
	break;
}
$condecion=str_replace("_zzz_","&",$condecion);
if($valores[8]==1) { if($DB->Execute($valores[7])){$bandera=2;} else {$bandera=4;} ; }
else {
	
	$bandera=$QL->delete($valores[0], $DB, $valores[3], $id_param, $tabla); 
}
if($ir==1){header("Location: ".$_SERVER["HTTP_REFERER"]); }
elseif($ir==3){
	header ("Location: $valores[4]");
}
else { header ("Location: $valores[4]?bandera=$bandera&condecion=$condecion&tabla=$tabla"); } 
?>
