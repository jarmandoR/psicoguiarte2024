<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();
$id_sedes=$_SESSION['usu_idsede'];
$nivel_acceso=$_SESSION['usuario_rol'];

$tipo=$_POST["tipo"];

if($tipo==1){

	$numerocomfirmar=null;
	$gatoscomfirmar=null;
	$remesascomfirmar=null;
	$cajasciudades=null;
	$seguimiento=null;
	$pendientes=null;

	if($nivel_acceso==1){
	$sql="SELECT count(*) as gastos FROM `cajamenor`  WHERE  caj_usucom=''";	
	$DB1->Execute($sql);
	$rw1=mysqli_fetch_row($DB1->Consulta_ID);
	$numerocomfirmar=$rw1[0];

	$sql2="SELECT count(*) as gastos FROM `asignaciondinero`  WHERE  asi_usercom IS NULL and asi_tipo in ('Gastos') ";	
	$DB1->Execute($sql2);
	$rw2=mysqli_fetch_row($DB1->Consulta_ID);
	$gatoscomfirmar=$rw2[0];

	$sql3="SELECT count(*) as gastos FROM `gastos`  WHERE  gas_usucom='' and gas_cantcom='' ";	
	$DB1->Execute($sql3);
	$rw3=mysqli_fetch_row($DB1->Consulta_ID);
	$remesascomfirmar=$rw3[0];

	$sql4="SELECT count(*) as sede FROM  sedes where sed_principal='si' and idsedes not in (SELECT cus_idsede FROM `cuentassede` WHERE `cus_fecha` like '%$fechaactual%')";	
	$DB1->Execute($sql4);
	$rw4=mysqli_fetch_row($DB1->Consulta_ID);
	$cajasciudades=$rw4[0];


	$sql8="SELECT count(*) as sinpesar FROM  servicios WHERE  ser_fechafinal like '$fechaactual%' and ser_estado in (4,6) and  ser_idverificadopeso!=1";	
	$DB1->Execute($sql8);
	$rw4=mysqli_fetch_row($DB1->Consulta_ID);
	$pendientes=$rw4[0];

	}

	if($nivel_acceso==10){
		$sql4="SELECT count(*) as sede FROM  sedes where sed_principal='si' and idsedes not in (SELECT cus_idsede FROM `cuentassede` WHERE `cus_fecha` like '%$fechaactual%')";	
		$DB1->Execute($sql4);
		$rw4=mysqli_fetch_row($DB1->Consulta_ID);
		$cajasciudades=$rw4[0];
	}

    if($nivel_acceso==2 or $nivel_acceso==12 or $nivel_acceso==5){

		$sql8="SELECT count(*) as sinpesar FROM  servicios inner join usuarios on idusuarios=ser_idresponsable  WHERE  ser_fechafinal like '$fechaactual%' and ser_estado in (4,6) and  ser_idverificadopeso!=1 and usu_idsede=$id_sedes";	
		$DB1->Execute($sql8);
		$rw4=mysqli_fetch_row($DB1->Consulta_ID);
		$pendientes=$rw4[0];
	
	}

	if($nivel_acceso==1 or $nivel_acceso==2){
		if($nivel_acceso==2){
			$consda=" and usu_idsede=$id_sedes";
		}
		$sql5a="SELECT ser_idresponsable as usuario FROM `servicios` inner join usuarios on idusuarios=ser_idresponsable where ser_estado in (3,9) and usu_estado=1 and ser_fechaasignacion like '$fechaactual%' $consda group by ser_idresponsable"; //guias recogidas
		$sql5b="SELECT ser_idusuarioguia as usuario FROM `servicios` inner join usuarios on idusuarios=ser_idusuarioguia where ser_estado in (3,9) and usu_estado=1 and ser_fechaguia like '$fechaactual%'  group by ser_idusuarioguia ORDER BY `usuario` ASC"; // guias entregadas
		$sql5=$sql5a." UNION ".$sql5b;	
		$DB->Execute($sql5);
		$terminaron='';
		$condec='';
		$varau=0;
		while($rw5=mysqli_fetch_row($DB->Consulta_ID))
		{
			$terminaron=$terminaron.$rw5[0].",";
			$varau++;
		}
		if($terminaron!=''){
			$terminaron = substr($terminaron, 0, -1);
			$condec="and idusuarios not in ($terminaron)";
		}
		
		 $sql6="SELECT count(*) as usuariost FROM `usuarios` where  usu_estado=1  and roles_idroles in (3) $condec $consda  ORDER BY usu_nombre  asc ";
		$DB1->Execute($sql6);
		$rw6=mysqli_fetch_row($DB1->Consulta_ID); 
		$seguimiento=$rw6[0];
	}

	$datos=array("gastossede"  => "$numerocomfirmar","gastosoperador"  => "$gatoscomfirmar","gastosremesas"  => "$remesascomfirmar","cierrecaja"  => "$cajasciudades","seguimiento"  => "$seguimiento","pendientes"  => "$pendientes");
}
/* 	echo "jose--".$datos;
exit;  */
//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
header('Content-Type: application/json');
//Devolvemos el array pasado a JSON como objeto
echo json_encode($datos, JSON_FORCE_OBJECT);

?>