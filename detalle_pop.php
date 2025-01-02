
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
	
	function buscar_ajax(cadena){
		$.ajax({
		type: 'GET',
		url: 'cambiohoras.php',
		data: 'cadena=' + cadena,
		success: function(respuesta) {
			//Copiamos el resultado en #mostrar
			$('#mostrar').html(respuesta);
	   }
	});
	}

	function holi(){
		alert("holi");
	}


	function calcularauxilio(auxilio){

		var valorsueldo = document.getElementById("paramsueldo").value;

		var totalmonto=parseInt(valorsueldo)+parseInt(auxilio);

		

        var cuarentaporc=parseInt(totalmonto)*40/100;

        if (auxilio>cuarentaporc) {

        	alert("A sobrepasado el 40% del monto total que es "+totalmonto);
        }else{

        	
        }

	
	}


</script>


<?php

error_reporting(0);//oculta errores
require("login_autentica.php");
include("cabezote3.php");
include("cabezote1.php"); 

if(isset($_REQUEST["id_param"])) {$id_param=$_REQUEST["id_param"]; } else { $id_param=""; } 
if(isset($_REQUEST["tabla"])) {$tabla=$_REQUEST["tabla"]; } else { $tabla=""; } 
if(isset($_REQUEST["dir"])) {$dir=$_REQUEST["dir"]; } else { $dir=""; } 
$fechatiempo=date("Y-m-d H:i:s");
?>	

<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title"><?php echo $tabla; ?></h4></div>
<?php 
if($tabla=="Verificar Datos") {

$estadofactura='verificacion';
$nombre=explode(" ",$id_nombre);
$descllamada=$nombre[0]." ".$nombre[1].'<br>';
$descllamada.="$fechatiempo";
$dir=$_REQUEST["dir"];


  $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `ser_iddocumento`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`,
 `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir,ser_descllamada,date(ser_fecharegistro),ser_clasificacion,ser_tipopaq FROM 
 servicios inner join rel_sercli  on idservicios=ser_idservicio  inner join clientesservicios on idclientesdir=ser_idclientes inner join clientes on idclientes=cli_idclientes  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

//$descllamada.=@$rw[22];
$fecharegistro=@$rw[23];
  $sql2="UPDATE `servicios` SET  `ser_esatdollamando`='Ocupado',`ser_descllamada`='$descllamada' WHERE `idservicios`='$id_param' ";			
	$DB->Execute($sql2);

$actuliza="no";
$param15=$rw[15];

if($param15=="Envio Oficina"){
	
   include("oficina.php");

}else if($param15=="Compra"){
	$boton='no';
	include("recoleccion_compra.php");

} else {
include("recoleccion_datos.php");	
}

if($dir=="adm_validardatos.php"){
$FB->llena_texto("LLAMAR DESPUES:",99, 5, $DB, "", "", "", 1, 0);
$FB->llena_texto("MOTIVO:",100,1, $DB, "", "","" ,4, 0);	
$FB->llena_texto("Reasignar Fecha:", 105, 10, $DB, "", "", "$fecharegistro", 4, 0);

}else {
	$FB->llena_texto("param99", 1, 13, $DB, "", "", "", 5, 0);
	$FB->llena_texto("param100", 1, 13, $DB, "", "", "", 5, 0);
	$FB->llena_texto("param105", 1, 13, $DB, "", "", "$fecharegistro", 4, 0);

}

$FB->llena_texto("param106", 1, 13, $DB, "", "", "$fecharegistro", 4, 0);
$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("dir", 1, 13, $DB, "", "", $dir, 5, 0);
$FB->llena_texto("descllamada", 1, 13, $DB, "", "", $descllamada, 5, 0);
//$FB->llena_texto("id_param0", 1, 13, $DB, "", "", $id_usuario, 5, 0);
 
}elseif($tabla=="LlamarReclamos") {

	$idservicio=$_REQUEST["dir"];
	$FB->llena_texto("Descripcion de LLamada:",2,9, $DB, "", "","" ,1, 1);		
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param10", 1, 13, $DB, "", "", $idservicio, 5, 0);


}elseif($tabla=="Llamar Remesas") {

	$estadofactura='2';
	$nombre=explode(" ",$id_nombre);
	$descllamada=$nombre[0]." ".$nombre[1].'<br>';
	$descllamada.="$fechatiempo";
	$dir=$_REQUEST["ide"];
	
	
	  $sql="SELECT `idgastos`,  `gas_descripcion`, `gas_peso`, `gas_piezas`,  `gas_cantcom`, `gas_empresa`, `gas_bus`, `gas_telconductor`, `gas_iduserremesa`, `gas_nomremesa` from gastos  where idgastos=$id_param ";
	$DB->Execute($sql);
	$rw=mysqli_fetch_array($DB->Consulta_ID);	

	  $sql2="UPDATE `gastos` SET  `gas_estadollamada`='2',`gas_userllamo`='$descllamada',gas_fechallamo='$fechatiempo' WHERE `idgastos`='$id_param' ";			
		$DB->Execute($sql2);
	
		echo "<p  align='left'>TELEFONO: $rw[7]<br></p>";
	$FB->llena_texto("Descripcion:",1, 1, $DB, "", "", "$rw[1]", 1, 0);
	$FB->llena_texto("Peso:",2, 1, $DB, "", "", "$rw[2]", 1, 0);
	$FB->llena_texto("Piezas:",4, 1, $DB, "", "", "$rw[3]", 1, 0);
	$FB->llena_texto("Valor a Pagar:",4, 1, $DB, "", "", "$rw[4]", 1, 0);
	$FB->llena_texto("Empresa:",5, 1, $DB, "", "", "$rw[5]", 1, 0);
	$FB->llena_texto("Bus:",6, 1, $DB, "", "", "$rw[6]", 1, 0);
	$FB->llena_texto("Telefono:",1, 1, $DB, "", "", "$rw[7]", 1, 0);
	$FB->llena_texto("Pasar a Asignar:",7, 5, $DB, "", "", "", 1, 0);
	$FB->llena_texto("MOTIVO:",8,1, $DB, "", "","" ,4, 0);	
	$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	 
	
}else if($tabla=="Seguimiento Datos") {

$estadofactura='verificacion';

 $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `cli_clasificacion`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir FROM 
serviciosdia  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	
$actuliza="no";
$param15=$rw[15];
if($param15=="Envio Oficina"){
	
   include("oficina.php");

}else if($param15=="Compra"){
	
	include("recoleccion_compra.php");

} else {
include("recoleccion_datos.php");	
}	

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
//$FB->llena_texto("id_param0", 1, 13, $DB, "", "", $id_usuario, 5, 0);

}
else if($tabla=="Reaccionar"){ 
$rw[4]=0;

$idciudad=$_REQUEST["idciudad"];
$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 9, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,0);

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("condicion", 1, 13, $DB, "", "", "2", 5, 0);

}
else if($tabla=="Reaccionarsaldos"){ 
	$rw[4]=0;
	
	$idciudad=$_REQUEST["idciudad"];
	$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 9, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
	$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,0);
	
	$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("condicion", 1, 13, $DB, "", "", "4", 5, 0);
	
	}
else if($tabla=="Reaccionardos"){ 
$rw[4]=0;

$idciudad=$_REQUEST["idciudad"];
$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 9, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,0);

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("condicion", 1, 13, $DB, "", "", "3", 5, 0);
}
else if($tabla=="Reasignar"){ 
	
$idciudad=$_REQUEST["idciudad"];
$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 8, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,1);

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);


}else if($tabla=="remesas"){ 

$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Usuario",1,0,0); 
$FB->titulo_azul1("Sede Origen",1,0,0); 
$FB->titulo_azul1("Sede Destino",1,0,0); 	
$FB->titulo_azul1("Empresa TR",1,0,0); 
$FB->titulo_azul1("# BUS",1,0,0); 



$sql="SELECT `idgastos`, `gas_fecharegistro`, `usu_nombre`, `gas_idciudadori`, `sed_nombre`, `gas_empresa`, `gas_bus`, `gas_telconductor`,`gas_pagar`,`gas_iduserremesa`, `gas_nomremesa`,`gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,gas_usucom,gas_cantcom,gas_feccom ,gas_idciudaddes,gas_iduserrecoge,gas_recogio,gas_entrego,gas_fecrecogida FROM `gastos` inner join usuarios on gas_idusuario=idusuarios inner join sedes on idsedes=gas_idciudaddes WHERE idgastos=$id_param ";
$DB1->Execute($sql); $va=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

			$rw1[16]=number_format($rw1[16],0,".",".");
			$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[3]'";
			$DB->Execute($sql2);
			$rw=mysqli_fetch_row($DB->Consulta_ID);

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw[1]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			<td>".$rw1[6]."</td>";
			echo "</tr>";
			$FB->titulo_azul1("Tel Conductor",1,0,5); 
$FB->titulo_azul1("Pagar en?",1,0,0); 
$FB->titulo_azul1("Operario Remesa",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Peso",1,0,0); 
$FB->titulo_azul1("Piezas",1,0,0); 
echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	
			echo "<td>".$rw1[7]."</td>
			<td>".$rw1[8]."</td>
			<td>".$rw1[10]."</td>
			<td>".$rw1[11]."</td>
			<td>".$rw1[12]."</td>
			<td>".$rw1[13]."</td>";
			echo "</tr>";
	
		
		
			$FB->titulo_azul1("Pagar",1,0,5); 
$FB->titulo_azul1("Confirmo",1,0,0); 
$FB->titulo_azul1("Valor Aprobado",1,0,0); 
$FB->titulo_azul1("Fecha Confirmacion",1,0,0);
$FB->titulo_azul1("Fecha Recogida",1,0,0);  
$FB->titulo_azul1("Operario Recoge",1,0,0); 
echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

echo "
<td>".$rw1[14]."</td>
<td>".$rw1[15]."</td>
<td>".$rw1[16]."</td>
<td>".$rw1[17]."</td>
";
			$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[19]' ";
			$DB->Execute($sql5);
			$nombreuser=$DB->recogedato(1);
			echo "<td>".$rw1[22]."</td>";
			echo "<td>".$nombreuser."</td>";

		echo "</tr>";
	}

}
else if($tabla=="asignar remesa"){ 
	
	$idciudad=$_REQUEST["idciudad"];
	/* $urls=$_SERVER['PHP_SELF'];
	$obtenerurl=explode('?',$urls,1); */

	$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 8, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
	$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,1);
	
	$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("condicion", 1, 13, $DB, "", "", "3", 5, 0);
	$FB->llena_texto("url", 1, 13, $DB, "", "", "$url", 5, 0);

	
	}
	else if($tabla=="asignar dinero"){ 
	
		$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Operador",1,0,0); 
$FB->titulo_azul1("Tipo",1,0,0); 
$FB->titulo_azul1("Valor ",1,0,0); 
$FB->titulo_azul1("Descripcion ",1,0,0); 
$FB->titulo_azul1("Asigno ",1,0,0); 

$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and idasignaciondinero=$id_param  ";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		";
		$slqs="SELECT usu_nombre FROM usuarios WHERE idusuarios='$rw1[6]' ";
		$DB->Execute($slqs); 
		$asigno=$DB->recogedato(0);
		echo "<td>".$asigno."</td>
		";
	echo "</tr>";

	}
}else if($tabla=="detalleprestamos"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
	  $sql="SELECT ser_guiare,ser_valorprestamo FROM `servicios` inner join cuentaspromotor on idservicios=cue_idservicio WHERE cue_fecharecogida  like '$fechaab%' and  ser_estado!=100   and cue_idciudadori=$id_param and ser_valorprestamo>0 order by cue_fecharecogida";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$sumatotal=number_format($sumatotal,0,".",".");
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="detalledias"){



$FB->titulo_azul1("Rol",1,0,5); 
$FB->titulo_azul1("Sede",1,0,0); 
$FB->titulo_azul1("Fecha ingreso",1,0,0); 
$FB->titulo_azul1("Activo",1,0,0);


$FB->titulo_azul1("Inactivo",1,0,0); 
$FB->titulo_azul1("Activo",1,0,0); 
 
$FB->titulo_azul1("Inactivo",1,0,0); 

$FB->titulo_azul1("Tiempo almuerzo",1,0,0); 



echo$sql4="SELECT seg_iduser,seg_fechaingreso, seg_horaingreso, seg_ingresoAlmuerzo, seg_salioAlmuerzo, seg_idestado,seg_horaSalida, idusuarios,usu_nombre,roles_idroles, seg_id FROM `seguimientousers` inner join `usuarios` on seg_iduser=usu_identificacion where  seg_fechaingreso>='$dir' and seg_fechaingreso<='$id_param2' and seg_iduser='$id_param' ORDER BY  seg_fechaingreso  asc ";




$DB1->Execute($sql4); 
$va=0; 
$totalasignadas=0;


	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{

		
		$id_p=$rw1[0];

	$sql2="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles`,`usu_identificacion` FROM `usuarios` WHERE `usu_identificacion`='$rw1[0]'";
			$DB2->Execute($sql2);
			$rw3=mysqli_fetch_row($DB2->Consulta_ID);
			$sede =$rw3[1]; 

$sql4="SELECT `sed_nombre` FROM `sedes` WHERE `idsedes`='".$sede."'";
			$DB2->Execute($sql4);
			$rw4=mysqli_fetch_row($DB2->Consulta_ID);
			$nomsede =$rw4[0]; 

	$sql5="SELECT `rol_nombre` FROM `roles` WHERE `idroles`='".$rw1[9]."'";
			$DB2->Execute($sql5);
			$rw5=mysqli_fetch_row($DB2->Consulta_ID);
			$nomrol =$rw5[0]; 		

		echo "<tr class='text' bgcolor='$color'>" ;
			echo "<td colspan='1' width='0' align='center' >".$rw3[0]."</td>";

			if($nivel_acceso==1 or $nivel_acceso==12){
	echo "<td colspan='1' width='0' align='center' >".$rw3[3]."</td>";
}
else {	
		
	
}
			

			
            echo "<td colspan='1' width='0' align='center'>".$nomrol."</td>";
            echo "<td colspan='1' width='0' align='center'>".$nomsede."</td>";
			echo "<td colspan='1' width='0' align='center'>".$rw1[1]."</td>";
			echo "<td colspan='1' width='0' align='center'>".$rw1[2]."</td>";
			echo "<td colspan='1' width='0' align='center'>".$rw1[3]."</td>";

			echo "<td colspan='1' width='0' align='center' >".$rw1[4]."</td>";
			echo "<td colspan='1' width='0' align='center' >".$rw1[6]."</td>";


            $horacero="00:00:00";
            $entrolmuerzo = new DateTime($rw1[3]);

            if ($rw1[4]== $horacero) {
	$saliodealmuerzo = new DateTime($rw1[3]);	
	}else{
		$saliodealmuerzo = new DateTime($rw1[4]);
	}
            
            $tiempo = $entrolmuerzo->diff($saliodealmuerzo);
            $horasfin= $tiempo->format('%H');
            $minutosfin= $tiempo->format('%i');
            $segunfin= $tiempo->format('%s');

            if ($minutosfin>35 or $horasfin>=1 ) {
            	$demora="#FF0000";
            }else{

            	$demora="#3d9f54";
            }
			echo "<td colspan='1' width='0' align='center' bgcolor='".$demora."' >".$horasfin.":".$minutosfin.":".$segunfin."</td>";
			
			$color1='';
			$color2='';
	

			if($nivel_acceso==1 or $nivel_acceso==12){
				$DB->edites($rw1[10], "seguimientousers", 2,0);
			}
		
		}

		echo"</tr>";





	// $FB->titulo_azul1("GUIA",1,0,5); 
	// $FB->titulo_azul1("VALOR",1,0,0); 
	// //$idusuarioab=$id_param['idusuario'];
	// //$fechaab=$id_param['fecha'];
	// $fechaab=$_REQUEST["ide"];
	//   $sql="SELECT ser_guiare,ser_valorprestamo FROM `servicios` inner join cuentaspromotor on idservicios=cue_idservicio WHERE cue_fecharecogida  like '$fechaab%' and  ser_estado!=100   and cue_idciudadori=$id_param and ser_valorprestamo>0 order by cue_fecharecogida";

	// 	$DB1->Execute($sql); $va=0;
	// 	$sumatotal=0;
	// 	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	// 	{
	// 		$id_p=$rw1[0];
	// 		$va++; $p=$va%2;
	// 		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
	// 		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	// 			echo "<td>".$rw1[0]."</td>
	// 			<td>".$rw1[1]."</td>
	// 			";
	// 			$rw1[1]=str_replace(".","", $rw1[1]);
	// 			$sumatotal=$rw1[1]+$sumatotal;
	// 		echo "</tr>";
	// 	}
	// 	$sumatotal=number_format($sumatotal,0,".",".");
	// 	$FB->titulo_azul1("TOTAL",1,0,5); 
	// 	$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="detalleexcedente"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudaddes WHERE `cue_fecha` like '$fechaab%'  and cue_estado=10  and cue_tipoevento=1 and  cue_prestamo>0 and inner_sedes=$id_param  order by `cue_fecha` ";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);

				$sumatotal=$rw1[1]+$rw1[2]+$sumatotal;
			echo "</tr>";
		}
		$sumatotal=number_format($sumatotal,0,".",".");
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="detallecontado"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudadori WHERE `cue_fecharecogida` like '$fechaab%'  and cue_estado<=14  and cue_tipoevento=1 and  cue_pendientecobrar=0 and inner_sedes=$id_param  order by `cue_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);

				$sumatotal=$rw1[3]+$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$sumatotal=number_format($sumatotal,0,".",".");
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallepxc"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudadori WHERE `cue_fechapcobrar` like '$fechaab%'  and cue_estado<=14  and cue_tipoevento=1 and  cue_pendientecobrar=2 and inner_sedes=$id_param  order by `cue_fecha` ";
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado FROM `cuentaspromotor`  inner join usuarios on idusuarios=cue_idoperpendiente WHERE `cue_fechapcobrar` like '$fechaab%'  and cue_estado<=14  and cue_tipoevento=1 and cue_pendientecobrar=2 and usu_idsede=$id_param  order by `cue_fecha` ";

	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);

				$sumatotal=$rw1[1]+$rw1[2]+$rw1[3]+$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$sumatotal=number_format($sumatotal,0,".",".");
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallealcobro"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	$FB->titulo_azul1("- ABONO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado,cue_abono FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudaddes WHERE `cue_fecha` like '$fechaab%' and  cue_estado>=8  and cue_estado<=14  and cue_tipoevento=3 and inner_sedes=$id_param  order by `cue_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);
				$rw1[5]=str_replace(".","", $rw1[5]);

				$sumatotal=$rw1[1]+$rw1[2]+$rw1[3]+$rw1[4]-$rw1[5]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallpagasalcobro"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	$FB->titulo_azul1("- ABONO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado,cue_abono FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudaddes WHERE `cue_fecha` like '$fechaab%'  and cue_estado=10  and cue_tipoevento=3 and inner_sedes=$id_param  order by `cue_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);
				$rw1[5]=str_replace(".","", $rw1[5]);

				$sumatotal=$rw1[1]+$rw1[2]+$rw1[3]+$rw1[4]-$rw1[5]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallependiente"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	$FB->titulo_azul1("- ABONO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado,cue_abono FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudaddes WHERE `cue_fecha` like '$fechaab%' and  cue_estado>=8  and cue_estado!=10  and  cue_estado<=14  and cue_tipoevento=3 and inner_sedes=$id_param  order by `cue_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);
				$rw1[5]=str_replace(".","", $rw1[5]);

				$sumatotal=$rw1[1]+$rw1[2]+$rw1[3]+$rw1[4]-$rw1[5]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallecompras"){


	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and `asi_fecha` like '$fechaab%'  and asi_idciudad=$id_param and asi_tipo='Asignar Dinero' order by `asi_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";

				$rw1[4]=str_replace(".","", $rw1[4]);
	

				$sumatotal=$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="detalletranspaso"){


	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and `asi_fecha` like '$fechaab%'  and asi_idciudad=$id_param and asi_tipo='Transpaso Dinero' order by `asi_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";

				$rw1[4]=str_replace(".","", $rw1[4]);
	

				$sumatotal=$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallegastos"){


	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and `asi_fecha` like '$fechaab%'  and usu_idsede=$id_param and asi_tipo='Gastos' order by `asi_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";

				$rw1[4]=str_replace(".","", $rw1[4]);
	

				$sumatotal=$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 
 else if($tabla=="detalleenviados"){

	$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Usuario",1,0,0); 
$FB->titulo_azul1("Sede Origen / Destino",1,0,0); 
$FB->titulo_azul1("Transaccion",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Valor ",1,0,0); 
$FB->titulo_azul1("Valor Aprobado",1,0,0); 
$fechaab=$_REQUEST["ide"];

 $sql="SELECT `idcajamenor`, `caj_fecharegistro`, `usu_nombre`,`sed_nombre`, `caj_tipotransacion`, `caj_descripcion`, `caj_valor`,`caj_usucom`, 
`caj_cantcom`, `caj_feccom`,caj_idciudaddes,caj_idciudadori  
FROM `cajamenor` inner join usuarios on caj_idusuario=idusuarios 
inner join sedes on idsedes=caj_idciudaddes and `caj_fecharegistro` like '$fechaab%'  and caj_tipotransacion in ('Consignacion','Envio de Dinero Efectivo') WHERE idcajamenor>0 and caj_idciudadori='$id_param'  ORDER BY caj_fecharegistro  ASC ";
	$DB1->Execute($sql); $va=0;
	$sumatotal=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[11]'";
		$DB->Execute($sql2);
		$rw=mysqli_fetch_row($DB->Consulta_ID);

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "
			<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw[1]." / ".$rw1[3]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			<td>".$rw1[6]."</td>

			<td>".$rw1[8]."</td>

			";

		//	$rw1[6]=str_replace(".","", $rw1[6]);
			$rw1[8]=str_replace(".","", $rw1[8]);


			$sumatotal=$rw1[8]+$sumatotal;
		echo "</tr>";
	}
	$FB->titulo_azul1("TOTAL",1,0,5); 
	$sumatotal=number_format($sumatotal,0,".",".");	
	$FB->titulo_azul1("$ $sumatotal",1,0,0); 

 }
 else if($tabla=="detalleprestamosoper"){

	$FB->titulo_azul1("Fecha",1,0,5); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	$fechaab=$_REQUEST["ide"];

 $sql="SELECT `iddeudapromotor`, `deu_fecha`, usu_nombre,   `deu_tipo` , `deu_valor`, `due_descripcion`, `deu_idautoriza`, `deu_idpromotor` FROM `duedapromotor`  inner join usuarios on deu_idpromotor=idusuarios WHERE iddeudapromotor>0  and `deu_fecha`='$fechaab' and deu_idciudad='$id_param'  and deu_tipo='Prestamos' order by `deu_fecha`";
	$DB1->Execute($sql); $va=0;
	$sumatotal=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "
			<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw1[3]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			";

		//	$rw1[6]=str_replace(".","", $rw1[6]);
			$rw1[4]=str_replace(".","", $rw1[4]);


			$sumatotal=$rw1[4]+$sumatotal;
		echo "</tr>";
	}
	$FB->titulo_azul1("TOTAL",1,0,5); 
	$sumatotal=number_format($sumatotal,0,".",".");	
	$FB->titulo_azul1("$ $sumatotal",1,0,0); 


 }
 else if($tabla=="detallegastosper"){

	$FB->titulo_azul1("Fecha",1,0,5); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	$fechaab=$_REQUEST["ide"];

 $sql="SELECT `iddeudapromotor`, `deu_fecha`, usu_nombre,   `deu_tipo` , `deu_valor`, `due_descripcion`, `deu_idautoriza`, `deu_idpromotor` FROM `duedapromotor`  inner join usuarios on deu_idpromotor=idusuarios WHERE iddeudapromotor>0  and `deu_fecha`='$fechaab' and deu_idciudad='$id_param'  and deu_tipo='Pagos' order by `deu_fecha`";
	$DB1->Execute($sql); $va=0;
	$sumatotal=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "
			<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw1[3]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			";

		//	$rw1[6]=str_replace(".","", $rw1[6]);
			$rw1[4]=str_replace(".","", $rw1[4]);


			$sumatotal=$rw1[4]+$sumatotal;
		echo "</tr>";
	}
	$FB->titulo_azul1("TOTAL",1,0,5); 
	$sumatotal=number_format($sumatotal,0,".",".");	
	$FB->titulo_azul1("$ $sumatotal",1,0,0); 


 }
 else if($tabla=="detallegastossede"){

	$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Usuario",1,0,0); 
$FB->titulo_azul1("Sede Origen / Destino",1,0,0); 
$FB->titulo_azul1("Transaccion",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Valor ",1,0,0); 
$FB->titulo_azul1("Valor Aprobado",1,0,0); 
$fechaab=$_REQUEST["ide"];

 $sql="SELECT `idcajamenor`, `caj_fecharegistro`, `usu_nombre`,`sed_nombre`, `caj_tipotransacion`, `caj_descripcion`, `caj_valor`,`caj_usucom`, 
`caj_cantcom`, `caj_feccom`,caj_idciudaddes,caj_idciudadori  
FROM `cajamenor` inner join usuarios on caj_idusuario=idusuarios 
inner join sedes on idsedes=caj_idciudaddes and `caj_feccom` like '$fechaab%'  and caj_tipotransacion in ('Gastos') WHERE idcajamenor>0 and caj_idciudadori='$id_param'  ORDER BY caj_fecharegistro  ASC ";
	$DB1->Execute($sql); $va=0;
	$sumatotal=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[11]'";
		$DB->Execute($sql2);
		$rw=mysqli_fetch_row($DB->Consulta_ID);

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "
			<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw[1]." / ".$rw1[3]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			<td>".$rw1[6]."</td>

			<td>".$rw1[8]."</td>

			";

		//	$rw1[6]=str_replace(".","", $rw1[6]);
			$rw1[8]=str_replace(".","", $rw1[8]);


			$sumatotal=$rw1[8]+$sumatotal;
		echo "</tr>";
	}
	$FB->titulo_azul1("TOTAL",1,0,5); 
	$sumatotal=number_format($sumatotal,0,".",".");	
	$FB->titulo_azul1("$ $sumatotal",1,0,0); 

 }	else if($tabla=="detalleremesas"){

	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 
	$FB->titulo_azul1("Sede Origen",1,0,0); 
	$FB->titulo_azul1("Sede Destino",1,0,0); 
	$FB->titulo_azul1("Pago en?",1,0,0); 
	$FB->titulo_azul1("Operario Remesa / Recoge ",1,0,0); 
	$FB->titulo_azul1("Valor Aprobado",1,0,0); 

	$fechaab=$_REQUEST["ide"];
	//	$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and `asi_fecha` like '$fechaab%'  and usu_idsede=$id_param and asi_tipo='Gastos' order by `asi_fecha` ";
	 $sql="SELECT idgastos,`gas_fecharegistro`,gas_feccom ,`gas_fecrecogida`,`gas_idciudadori`,`sed_nombre`,`gas_bus`,`gas_pagar`,`gas_nomremesa`,gas_iduserrecoge,gas_cantcom FROM `gastos` inner join usuarios on gas_idusuario=idusuarios and gas_cantcom>0 inner join sedes on idsedes=gas_idciudaddes
		WHERE idgastos>0  and (gas_idciudadori='$id_param' and gas_pagar='Sede Origen' and gas_feccom like '$fechaab%')  or (gas_idciudaddes='$id_param' and gas_pagar='Sede Destino' and  gas_fechavalida like '$fechaab%' and gas_nomvalida!='' )  ORDER BY idgastos";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>";
			if($rw1[7]=='Sede Origen'){
				echo "<td>".$rw1[2]."</td>";
			}elseif($rw1[7]=='Sede Destino'){
				echo "<td>".$rw1[3]."</td>";
			}
			$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[4]'";
			$DB->Execute($sql2);
			$rw=mysqli_fetch_row($DB->Consulta_ID);

			$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[9]' ";
			$DB->Execute($sql5);
			$nombreuser=$DB->recogedato(1);

				echo "	<td>".$rw[1]."</td>
				<td>".$rw1[5]."</td>
				<td>".$rw1[7]."</td>
				<td>".$rw1[8]." /
				".$nombreuser."</td>
				<td>".$rw1[10]."</td>
				";

				$rw1[10]=str_replace(".","", $rw1[10]);
	

				$sumatotal=$rw1[10]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="facturarcreditos"){
	$param4='ingresado';
	$fecha=$_REQUEST["ide"];

/* 	$slq="SELECT `pre_obsevaciones`,`pre_correctiva`,`pre_responsable` FROM `pre-operacional` where preidusuario='$iduser' and prefechaingreso like '$fecha%'";	
	$DB->Execute($slq); 
	$rw1=mysqli_fetch_row($DB->Consulta_ID); */

	include_once("detalle_crearfacturacreditos.php");


}  else if($tabla=="preoperacional"){
	$param4='ingresado';
	$fecha=$_REQUEST["ide"];

	$slq="SELECT `pre_obsevaciones`,`pre_correctiva`,`pre_responsable` FROM `pre-operacional` where preidusuario='$iduser' and prefechaingreso like '$fecha%'";	
	$DB->Execute($slq); 
	$rw1=mysqli_fetch_row($DB->Consulta_ID);
	include_once("preoperacional.php");


} 
else if($tabla=="tipocontrato"){
	$contrato=$_REQUEST["ide"];
	$FB->llena_texto("Tipo de Contrato:",22,82, $DB, $tipocontrato, "","$contrato", 2, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);
}
else if($tabla=="zonatrabajo"){
	$fecha=$_REQUEST["ide"];
	$FB->llena_texto("Zona:",6,2,$DB,"(SELECT `idzonatrabajo`,`zon_nombre` FROM zona_trabajo where idzonatrabajo>0 )", "", "", 2, 1);

	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param3", 1, 13, $DB, "", "", $fecha, 5, 0);

}else if($tabla=="horaoficina"){
	$hora=date("H:i:s");
	$FB->llena_texto("Retorno de Oficina:", 3, 102, $DB, "", "", "$hora", 2, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

}else if($tabla=="horaretorno"){
	$hora=date("H:i:s");
	$FB->llena_texto("Retorno de Almuerzo:", 3, 102, $DB, "", "", "$hora", 2, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

}else if($tabla=="horaalmuerzo"){
	$hora=date("H:i:s");
	$FB->llena_texto("Hora de Almuerzo:", 3, 102, $DB, "", "", "$hora", 2, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

}else if($tabla=="ingresousuario"){
	$fecha=$_REQUEST["ide"];
	$FB->llena_texto("Motivo Ingreso:", 4, 82, $DB, $motivoingreso, "", "", 2, 1);
	$FB->llena_texto("Descripcion:", 5, 1, $DB, "", "", "", 2, 0);
	$FB->llena_texto("Zona:",6,2,$DB,"(SELECT `idzonatrabajo`,`zon_nombre` FROM zona_trabajo where idzonatrabajo>0 )", "", "", 2, 0);

	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param3", 1, 13, $DB, "", "", $fecha, 5, 0);
	

 }else if($tabla=="Abonos"){

	$idservicio=$_REQUEST["ide"];
	$FB->llena_texto("Valor:",1, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", "$idservicio", 5, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }else if($tabla=="TipoPago"){

	//$idservicio=$_REQUEST["ide"];
	$FB->llena_texto("Tipo de Pago:", 4, 82, $DB, $tipopagos, "", "", 2, 1);
	$FB->llena_texto("Fecha de Pago:",5, 10, $DB, "", "", "$fechaactual", 1, 0);
	//$FB->llena_texto("param5", 1, 13, $DB, "", "", "$idservicio", 5, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 else if($tabla=="devolucion"){

	$idservicio=$_REQUEST["ide"];
	$FB->llena_texto("Valor:",1, 118, $DB, "", "", "$id_param", 2, 1);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", "$idservicio", 5, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 else if($tabla=="cambiarfactura"){

	$valor=$_REQUEST["ide"];
	$FB->llena_texto("# Factura:",1, 1, $DB, "", "", "$valor", 2, 1);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", "$valor", 5, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 else if($tabla=="fecharadicado"){


	$FB->llena_texto("Fecha de Pago:",1, 10, $DB, "", "", "$fechaactual", 1, 0);
	$FB->llena_texto("Imagen", 3, 6, $DB, "", "", "",1,0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 elseif($tabla=="pruebaalcohol"){

	$fecha=$_REQUEST["ide"];
	$FB->llena_texto("Prueba de Alcohol:", 1, 82, $DB, $pruebaalcohol, "", "", 2, 1);
	$FB->llena_texto("Imagen", 2, 6, $DB, "", "", "",1,0);

	$opcion=explode(' ',$id_param);
	if($opcion[0]=='update'){
		$metodo='update';
	}else{
		$metodo='insert';
	}

	$FB->llena_texto("param3", 1, 13, $DB, "", "", $fecha, 5, 0);
	$FB->llena_texto("param4", 1, 13, $DB, "", "", $opcion[1], 5, 0);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", $metodo, 5, 0);


 }elseif($tabla=="RegistrarPago"){
	$id_param2=$_REQUEST["ide"];
	$FB->llena_texto("Fecha de Pago:",1, 10, $DB, "", "", "$fechaactual", 1, 0);
	$FB->llena_texto("Valor Pagado:",2, 118, $DB, "", "", "", 1, 1);
	$FB->llena_texto("Documento:", 112, 6, $DB, "", "", "",4, 0);

	$FB->llena_texto("idhojadevida", 1, 13, $DB, "", "", $id_param2, 5, 0);
	$FB->llena_texto("idincapacidades", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("condecion", 1, 13, $DB, "", "", "RegistrarPago", 5, 0);

 }elseif($tabla=="reportealarmas"){
	  
	 $id_param2=$_REQUEST["ide"];
	$FB->llena_texto("Fecha de Vencimiento:",1, 10, $DB, "", "", "$id_param2", 1, 0);
	$FB->llena_texto("Documento:", 5, 6, $DB, "", "", "",4, 0);

	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 else if($tabla=="detallerecogido"){

	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	$FB->titulo_azul1("OPERADOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono` FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$sql="SELECT  idasignaciondinero,`asi_valor`,asi_idpromotor FROM `asignaciondinero` inner join usuarios on idusuarios=asi_idautoriza WHERE `asi_fecha` like '$fechaab%'  and asi_idciudad=$id_param and roles_idroles not in (2,3) and asi_tipo='entregado'";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[2]' ";
				$DB->Execute($sql5);
				$nombreuser=$DB->recogedato(1);
				echo "<td>".$nombreuser."</td>";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$sumatotal=number_format($sumatotal,0,".",".");	
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="Devolucionescuentas"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("IDSERVICIO",1,0,0); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		 $sql="SELECT ser_guiare ,abo_valor,abo_idservicio FROM `abonosguias` inner join servicios on  idservicios=abo_idservicio WHERE abo_iduser='$id_param' and abo_fecha like '$fechaab%' and `abo_estado`='devolucion'";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
else if($tabla=="Abonoscuentas"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$sql="SELECT ser_guiare ,abo_valor FROM `abonosguias` inner join servicios on  idservicios=abo_idservicio WHERE abo_iduser='$id_param' and abo_fecha like '$fechaab%' and `abo_estado`='abono'";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="Abonossedes"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$sql="SELECT ser_guiare ,abo_valor FROM `abonosguias` inner join servicios on  idservicios=abo_idservicio WHERE abo_idsede='$id_param' and abo_fecha like '$fechaab%' and `abo_estado`='abono'";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="Devolucionsedes"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$sql="SELECT ser_guiare ,abo_valor FROM `abonosguias` inner join servicios on  idservicios=abo_idservicio WHERE abo_idsede='$id_param' and abo_fecha like '$fechaab%' and `abo_estado`='devolucion'";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 /* else if($tabla=="Abonoscuentas"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 } */
 else if($tabla=="dineroentregado"){

	$FB->titulo_azul1("Valor",1,0,5); 
	$FB->titulo_azul1("Eliminar",1,0,0); 

	$fechaab=$_REQUEST["ide"];
		 $sql="SELECT idasignaciondinero ,`asi_valor` FROM `asignaciondinero`  WHERE  `asi_fecha`='$fechaab' and `asi_idpromotor`='$id_param' and asi_tipo='entregado'";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "
				<td>".$rw1[1]."</td>
				";
			$DB->edites($id_p, "cuentasentrega", 2,0);
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
else if($tabla=="Asignar Paquete"){ 
$rw[4]=0;
$idsede=$_REQUEST["idciudad"];

$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value,27, \"llega_sub1\", \"param2\", 1,  $idsede)",@$rw[1], 17, 1);
$FB->llena_texto("Operador:", 2, 444, $DB, "llega_sub1", "", "",4,1);

$sql="SELECT ser_estado,ser_motivo FROM servicios where idservicios=$id_param";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);
if($rw[0]==5){
$FB->llena_texto("MOTIVO DE NO RECOGIDA:",3,9, $DB, "", "",@$rw[1] ,1, 0);	
	
}

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

$FB->llena_texto("condicion", 1, 13, $DB, "", "", "1", 5, 0);

}
else if($tabla=="Entregar valor"){ 

$idciudad=$_REQUEST["idciudad"];
$valorapagar=$_REQUEST["valordos"];
$conde2="and usu_idsede=$idciudad";
$FB->llena_texto("Fecha de Busqueda:", 1, 10, $DB, "", "", "$fechaactual", 4, 0);
$FB->llena_texto("Operario:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) $conde2", "", $id_param, 1, 1);
$FB->llena_texto("Valor:",3, 118, $DB, "", "", "", 2, 1);
$FB->llena_texto("param4", 4, 13, $DB, "", "", $idciudad, 5, 0);

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("valorapagar", 1, 13, $DB, "", "", $valorapagar, 5, 0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

}
else if($tabla=="Confirmar"){
	$idciudad=$_REQUEST["idciudad"]; 
	$FB->llena_texto("Dinero que Llego:",6, 118, $DB, "", "", "", 2, 1);
	if($idciudad=='Gastos'){
  	$FB->llena_texto("Gastos de:",9,2, $DB, "SELECT * FROM `clasificacion_gastos` ", "cambio_ajax2(this.value, 21, \"llega_sub1\", \"param10\", 1,$id_param)","", 17, 1);
	  $FB->llena_texto("Tipo:", 10, 4, $DB, "llega_sub1", "", "",4,1);
 }
  	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
  	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "confirmar", 5, 0);
  	$FB->llena_texto("tipo_gastos", 1, 13, $DB, "", "", "$idciudad", 5, 0);

}
else if($tabla=="Confirmargastos"){
	$idciudad=$_REQUEST["idciudad"];
	$FB->llena_texto("Valor:",8, 118, $DB, "", "", "", 2, 1);
	if($idciudad=='Gastos'){
		$FB->llena_texto("Gastos de:",9,2, $DB, "SELECT * FROM `clasificacion_gastos` ", "cambio_ajax2(this.value, 21, \"llega_sub1\", \"param10\", 1,$id_param)","", 17, 1);
		$FB->llena_texto("Tipo:", 10, 4, $DB, "llega_sub1", "", "",4,1);
   }
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "Confirmargastos", 5, 0);
	$FB->llena_texto("tipo_gastos", 1, 13, $DB, "", "", "$idciudad", 5, 0);

}else if($tabla=="Confirmarnovedades"){
	$idciudad=$_REQUEST["idciudad"];
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
    $FB->llena_texto("id_param2", 1, 13, $DB, "", "", "Confirmarnovedades", 5, 0);
	// $FB->llena_texto("Tipo Contrato:", 39, 82, $DB, $tipocontrato, "", "$rw[30]", 1, 1);
	// $FB->llena_texto("Valor:",8, 118, $DB, "", "", "", 2, 1);
	// if($idciudad=='Gastos'){
	// 	$FB->llena_texto("Gastos de:",9,2, $DB, "SELECT * FROM `clasificacion_gastos` ", "cambio_ajax2(this.value, 21, \"llega_sub1\", \"param10\", 1,$id_param)","", 17, 1);
	// 	$FB->llena_texto("Tipo:", 10, 4, $DB, "llega_sub1", "", "",4,1);
 //   }
	// $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	// $FB->llena_texto("id_param2", 1, 13, $DB, "", "", "Confirmargastos", 5, 0);
	// $FB->llena_texto("tipo_gastos", 1, 13, $DB, "", "", "$idciudad", 5, 0);


	$FB->llena_texto("Estado novedad:", 9, 82, $DB,$estadosnovedades, "", "", 1, 1);

}else if($tabla=="ConfirmarCapacitacion"){
	$idciudad=$_REQUEST["idciudad"];
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
    $FB->llena_texto("id_param2", 1, 13, $DB, "", "", "ConfirmarCapacitacion", 5, 0);
	
	$FB->llena_texto("Valida que realizo adecuamanete la capacitacion:", 99, 82, $DB,$estadosnovedades, "", "", 1, 1);

}else if($tabla=="Confirmarpqr"){
	$idciudad=$_REQUEST["idciudad"];
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
    $FB->llena_texto("id_param2", 1, 13, $DB, "", "", "Confirmarpqr", 5, 0);
	// $FB->llena_texto("Tipo Contrato:", 39, 82, $DB, $tipocontrato, "", "$rw[30]", 1, 1);

	$FB->llena_texto("Valida que realizo adecuamanete la capacitacion:", 99, 82, $DB,$estadosnovedades, "", "", 1, 1);

	$FB->llena_texto("Respuesta:",20,9, $DB,$estadosnovedades, "", "", 1, 1);

}else if($tabla=="verdocumento"){
	$idciudad=$_REQUEST["idciudad"];
	// $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

	echo'
<div id="ver">




<iframe id="inlineFrameExample"
    title="Inline Frame Example"
    width="900"
    height="600"
    src="documentosberm/'.$id_param.'">
</iframe>
</div>

';


	// $FB->llena_texto("Estado novedad:", 9, 82, $DB,$estadosnovedades, "", "", 1, 1);

}else if($tabla=="vercapacitacion"){
	$idciudad=$_REQUEST["idciudad"];
	// $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

	echo'
<div id="ver">




<iframe id="inlineFrameExample"
    title="Inline Frame Example"
    width="900"
    height="600"
    src="documentosberm/'.$id_param.'">
</iframe>
</div>

';

 
 echo "<tr bgcolor='#F5F5F5'><td align='right' colspan='2' ><button type='submit'  id='submit' class='btn btn-primary  pull-right' ><i class='fa fa-check'></i> Aceptar</button></td></tr>";
	// $FB->llena_texto("Estado novedad:", 9, 82, $DB,$estadosnovedades, "", "", 1, 1);

}else if($tabla=="verinfo"){
	$idciudad=$_REQUEST["idciudad"];
	// $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

	echo'
<div id="ver">




<iframe id="inlineFrameExample"
    title="Inline Frame Example"
    width="900"
    height="600"
    src="confi_imagen/'.$id_param.'">
</iframe>
</div>

';


	// $FB->llena_texto("Estado novedad:", 9, 82, $DB,$estadosnovedades, "", "", 1, 1);
	
}else if($tabla=="Ver_quien_confirmo"){

	error_reporting(0);
		$param1=$_REQUEST["param1"];
		$fechafinal=$_REQUEST["param2"];
		// $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	// $FB->titulo_azul1("Estado de la GUIA: $estadoguia  ",10,0, 5); 
	
	$FB->titulo_azul1("Confirmaciones",10,0, 5); 
	$FB->titulo_azul1("Empleado",1,0,7); 
	
	 
	
	

						$sql4="SELECT `reg_id`, `reg_idusuario`, `reg_iddocumento`, `reg_confirmacion` FROM `registrocapaci` WHERE reg_iddocumento='$id_param'";
						$DB1->Execute($sql4); 
						$va=0;
	                    while($rw4=mysqli_fetch_row($DB1->Consulta_ID))
	                    {
							$va++;
							$sql5="SELECT  `usu_nombre` FROM `usuarios` WHERE idusuarios='$rw4[1]' ";
							$DB2->Execute($sql5);
							$rw5=mysqli_fetch_row($DB2->Consulta_ID);

							echo "<tr class='text' >" ;
		                
                        echo"<td>".$rw5[0]."</td>";
						

						echo"</tr>";
						}



		
	
		$FB->titulo_azul1(" $va",1,0,10); 
		
	

	
	
	}else if($tabla=="verquincena"){

error_reporting(0);
	$fechaactual=$_REQUEST["param1"];
	$fechafinal=$_REQUEST["param2"];
	// $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
// $FB->titulo_azul1("Estado de la GUIA: $estadoguia  ",10,0, 5); 

$FB->titulo_azul1("RESUMEN QUINCENAL",10,0, 5); 


$FB->titulo_azul1("Empleado",1,0,7); 

if($nivel_acceso==1 or $nivel_acceso==12){
	$FB->titulo_azul1("Cedula",1,'5%',0); 
}
else {}

function calculototaltiempo($minutosp){
	$aux1=$minutosp*1/60;
	
	//calcula decimal
	$float = $aux1; 
	 $dec = ltrim(($float - floor($float)),"0."); // result .3
	
	$findecimal='0.'.$dec;
	
	$finminutos=round($findecimal*60);
	
	//calcula entero
	
	$float1 = floor($aux1); 
	
	$horadfinal=$horas+$float1;
	
	
	return $array = array($float1,$finminutos );
	}

 
$FB->titulo_azul1("Fecha ingreso",1,0,0); 
$FB->titulo_azul1("Activo",1,0,0);


$FB->titulo_azul1("Inactivo",1,'5%',0); 
$FB->titulo_azul1("Activo",1,'5%',0); 
 
$FB->titulo_azul1("Inactivo",1,'5%',0); 

$FB->titulo_azul1("Tiempo almuerzo",1,'5%',0);  
$FB->titulo_azul1("Novedad",1,'5%',0);  
$FB->titulo_azul1("Edicion",1,'5%',0);  


function saber_dia($nombredia){
	$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
	$fecha = $dias[date('N', strtotime($nombredia))];
	
	
	return $fecha;
	
	}
	// seg_horaingreso,seg_horaSalida,seg_ingresoAlmuerzo,seg_salioAlmuerzo,seg_fechaingreso
	
$sql4="SELECT seg_iduser,seg_fechaingreso, seg_horaingreso, seg_ingresoAlmuerzo, seg_salioAlmuerzo, seg_idestado,seg_horaSalida, idusuarios,usu_nombre,roles_idroles, seg_id FROM `seguimientousers` inner join `usuarios` on seg_iduser=usu_identificacion where seg_fechaingreso>='$fechaactual' and seg_fechaingreso<='$fechafinal' and seg_iduser!=0 and `idusuarios`= '$id_param' ORDER BY  seg_fechaingreso  asc ";




$DB1->Execute($sql4); 
$va=0; 
$totalasignadas=0;
$color="";
$hoyess="";

	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{

		$horas1=0;
		$minutos1=0;
        $segundos1=0;
		$horas2=0;

		$minutos2=0;
		$segundos2=0;
		$segunaldia=0;
		$tiempo=0;
		$tiempo2=0;



		
		$hoyess="".saber_dia($rw1[1])."";




		
		
		$horacero="00:00:00";
		$horafinnormal="21:00:00";
		//para calcular primer tiempo del dia 
			$apertura = new DateTime($rw1[2]);
		
			if ($rw1[3]== $horacero) {
			$cierre = new DateTime($rw1[2]);	
			}else{
				$cierre = new DateTime($rw1[3]);
			}
		
		
		$tiempo = $apertura->diff($cierre);
		

		$horas1 = $horas1 + $tiempo->format('%H');
        $minutos1 = $minutos1 +$tiempo->format('%i');
        $segundos1 = $segundos1 + $tiempo->format('%s');



		//para calcular segundo tiempo del dia 
		
		$apertura2 = new DateTime($rw1[4]);

		if ($rw1[6]== $horacero) {
		$cierre2 = new DateTime($rw1[4]);	
		}else{
			$cierre2 = new DateTime($rw1[6]);
		}
		$tiempo2 = $apertura2->diff($cierre2);
		// $secondDate = new DateTime($tiempo);


		$horas2 = $horas2 + $tiempo2->format('%H');
		$minutos2 = $minutos2 +$tiempo2->format('%i');
		$segundos2 = $segundos2 + $tiempo2->format('%s');




		$horasaldia=$tiempo->format('%H')+ $tiempo2->format('%H');
		$minualdia=$tiempo->format('%i')+ $tiempo2->format('%i');//total de minutos los dos tiempos del dia
		$segunaldia=$tiempo->format('%s')+ $tiempo2->format('%s');//total de segundos los dos tiempos del dia

		list($minus,$segus) = calculototaltiempo($segunaldia);

			$minualdia=$minualdia+$minus;

		list($horas,$munitos)=calculototaltiempo($minualdia);
	    $horasaldiat=$horas+$horasaldia;
		$minualdia=$munitos;

		// if ($hoyess=="Domingo"){$color="afabb4";}else{$color='#FFFF00';}


		
			
	// }

		
		$id_p=$rw1[0];

	        $sql2="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles`,`usu_identificacion`,`idusuarios`  FROM `usuarios` WHERE `usu_identificacion`='$rw1[0]'";
			$DB2->Execute($sql2);
			$rw3=mysqli_fetch_row($DB2->Consulta_ID);
			$sede =$rw3[1]; 


			$sql9="SELECT hoj_cargo,hoj_salario,hoj_salario, hoj_tipocontrato,hoj_auxilions,hoj_horario,hoj_area,hoj_mediop FROM `hojadevida` WHERE `hoj_cedula`='$rw3[3]'";
			$DB2->Execute($sql9);
			$rw7=mysqli_fetch_row($DB2->Consulta_ID);	

            $sql4="SELECT `sed_nombre` FROM `sedes` WHERE `idsedes`='".$sede."'";
			$DB2->Execute($sql4);
			$rw4=mysqli_fetch_row($DB2->Consulta_ID);
			$nomsede =$rw4[0]; 

	$sql5="SELECT `rol_nombre` FROM `roles` WHERE `idroles`='".$rw1[9]."'";
			$DB2->Execute($sql5);
			$rw5=mysqli_fetch_row($DB2->Consulta_ID);
			$nomrol =$rw5[0]; 		

			if($horasaldiat>=8 and $hoyess!="Domingo" or ($hoyess=="Sabado" and $rw7[6]=="Administrativo" )){
				$color='';
			
			}else if ($hoyess=="Domingo"){
					$color="afabb4";
					$domingoss=$domingoss+1;
				// $color="afabb4";
					// $domingos=$domingos+1;
					
				}else{
					$color='#FFFF00';
				}

		echo "<tr class='text' bgcolor='$color'>" ;
			echo "<td colspan='1' width='0' align='center' >".$rw3[0]."</td>";

			if($nivel_acceso==1 or $nivel_acceso==12){
	echo "<td colspan='1' width='0' align='center' >".$rw3[3]."</td>";



}
else {	
		
	
}
			

			
echo'<script type="text/javascript">novalido();</script>';

			echo "<td colspan='1' width='0' align='center'>".$rw1[1]."</td>";

			$nomcampo1="parm1".$rw1[10]."";
			echo "<td colspan='1' width='0' align='center'><form><input onkeyup='buscarerror(this.value);' id='parm1".$rw1[10]."' type='text'  style='width: 100px;' value='".$rw1[2]."'><button type='button' onclick='buscar_ajax( \"$rw1[2]\",".$rw1[10].",1,\"$nomcampo1\");' class='btn btn-success'>Editar</button></form></td>";
			
			$nomcampo2="parm2".$rw1[10]."";
			echo "<td colspan='1' width='0' align='center'> <form><input onkeyup='buscarerror(this.value);' id='parm2".$rw1[10]."' type='text' style='width: 100px;'  value='".$rw1[3]."'><button type='button' onclick='buscar_ajax(\"$rw1[3]\",".$rw1[10].",2,\"$nomcampo2\");' class='btn btn-success'>Editar</button></form></td>";
			
			$nomcampo3="parm3".$rw1[10]."";
			echo "<td colspan='1' width='0' align='center' ><form><input onkeyup='buscarerror(this.value);' id='parm3".$rw1[10]."' type='text' style='width: 100px;'  value='".$rw1[4]."'><button type='button' onclick='buscar_ajax(\"$rw1[4]\",".$rw1[10].",3,\"$nomcampo3\");' class='btn btn-success'>Editar</button></form></td>";
			
			$nomcampo4="parm4".$rw1[10]."";
			echo "<td colspan='1' width='0' align='center' ><form><input onkeyup='buscarerror(this.value);' id='parm4".$rw1[10]."' type='text' style='width: 100px;'  value='".$rw1[6]."'><button type='button' onclick='buscar_ajax(\"$rw1[6]\",".$rw1[10].",4,\"$nomcampo4\");' class='btn btn-success'>Editar</button></form></td>";


		


            $horacero="00:00:00";
            $entrolmuerzo = new DateTime($rw1[3]);

            if ($rw1[4]== $horacero) {
	$saliodealmuerzo = new DateTime($rw1[3]);	
	}else{
		$saliodealmuerzo = new DateTime($rw1[4]);
	}
            
            $tiempo = $entrolmuerzo->diff($saliodealmuerzo);
			
            $horasfin= $tiempo->format('%H');
            $minutosfin= $tiempo->format('%i');
            $segunfin= $tiempo->format('%s');

            if ($minutosfin>35 or $horasfin>=1 ) {
            	$demora="#FF0000";
            }else{

            	$demora="#3d9f54";
            }
			echo "<td colspan='1' width='0' align='center' bgcolor='".$demora."' >".$horasfin.":".$minutosfin.":".$segunfin."</td>";
			
			$color1='';
			$color2='';


$sql6="SELECT `novid`FROM `novedades` where	 nov_idusuario = '$rw3[4]'and( '$rw1[1]'>= nov_fechadesde and '$rw1[1]'<=nov_fechahasta) ORDER BY novid desc";
$DB2->Execute($sql6); 
$rw6=mysqli_fetch_row($DB2->Consulta_ID);
$idnovedad =$rw6[0];
if ($idnovedad!=0 or $idnovedad!="") {
	echo "<td colspan='1' width='0' align='center' bgcolor='#EB984E' >Novedad</td>";
}else{


	echo "<td colspan='1' width='0' align='center' >-</td>";
}
			 

	

			if($nivel_acceso==1 or $nivel_acceso==12){
				$DB->edites($rw1[10], "seguimientousers", 2,0);
			}
		
		}

		echo"</tr>";
	




	$FB->titulo_azul1(" Totales :",1,0,10); 
	$FB->titulo_azul1(" $va",1,0,0); 

	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
    $FB->titulo_azul1(" ------",1,0,0); 


}else if($tabla=="Desprendible"){




// error_reporting(0);

//Incluímos la clase pago
require_once "CifrasEnLetras.php";
$v=new CifrasEnLetras();



	$conde=$_REQUEST["param1"];
	$conde4=$_REQUEST["param2"];
	$fechaactual=$_REQUEST["param3"];
	$fechafinal=$_REQUEST["param4"];

	$fechaComoEntero = strtotime($fechaactual);
	$fechaderegistro=$fechaComoEntero;

	$mesfiltrado=date('m',$fechaderegistro);
	$diafiltrado=date('d',$fechaderegistro);
$FB->titulo_azul1("DESPRENDIBLE DE NÓMINA",10,0, 5); 



 $hoyf=date('Y-m-d h:i:s');

 if ($hoyf<=$fechafinal and $hoyf>=$fechaactual) {

 	$fechafinal=$hoyf;
 }




$sql11="SELECT `parame_id`, `parme_nombre`, `parme_valor` FROM `parametrizables` WHERE 1";

 $DB->Execute($sql11); $va=(($compag-1)*$CantidadMostrar); 
	 while($rw11=mysqli_fetch_row($DB->Consulta_ID))
	 {
if ($rw11[0]==1) {
	$salud=$rw11[2]/100;

}elseif ($rw11[0]==0) {
	

	$pension=$rw11[2]/100;

}elseif ($rw11[0]==3) {
	

	$subtransport=$rw11[2];

}elseif ($rw11[0]==4) {
	
	$salariominimo=$rw11[2]/100;


}elseif ($rw11[0]==5) {
	
	$horaregularlimite=$rw11[2];


}elseif ($rw11[0]==6) {
	
	$porrecargonocturno=$rw11[2]/100;


}elseif ($rw11[0]==7) {
	
	$porRecargoDomFesDiu=$rw11[2]/100;


}elseif ($rw11[0]==8) {
	
	$porHorasExDiurno=$rw11[2]/100;


}elseif ($rw11[0]==9) {
	

	$porHorasExNoct=$rw11[2]/100;

}elseif($rw11[0]==10){
	

	$porHorasExDiurnoDomFes=$rw11[2]/100;

}elseif($rw11[0]==11){
	

	$porHorasExNoctDomFes=$rw11[2]/100;

}elseif($rw11[0]==12){

	$porRecargoDomFesNocturno=$rw11[2]/100;
}
	 }




//SUBSIDIO DE TRANSPORTE
$subtrans=$subtransport;
$subtransQ=$subtrans/2;
$subtransD=$subtrans/30;








// echo"año".$param34;
$conde3=""; 

if($param34!=''){ $fechaactual=$param34." 00:00:00";  }
if($param36!=''){ $fechafinal=$param36." 23:59:59";  }
if($param38!=''){ $ano=$param38;   }



 $fechafinal;
 $fechaactual;

if($param37!='0'){ $conde5=" and usu_tipocontrato='$param37'";  }

 $hoyf=date('Y-m-d h:i:s');

 if ($hoyf<=$fechafinal and $hoyf>=$fechaactual) {

 	$fechafinal=$hoyf;
 }



 $horasDI=0;
$diaincom=0;
$domingoss=0;
$fechaactual1=strtotime($fechaactual);
$fechafinal2=strtotime($fechafinal);



function saber_dia($nombredia){
$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
$fecha = $dias[date('N', strtotime($nombredia))];


return $fecha;

}



for($i=$fechaactual1; $i<=$fechafinal2; $i+=86400){
     date("d-m-Y", $i)."<br>";


   $hoyess="".saber_dia(date("d-m-Y",$i))."";




if ($hoyess=="Domingo"){

	$domingoss=$domingoss+1;

	// $domingos=$domingos+1;
	
}



}
// echo'DOMINGOS DE LA 15NA'.$domingoss; ;)


function calculototaltiempo($minutosp){
$aux1=$minutosp*1/60;

//calcula decimal
$float = $aux1; 
 $dec = ltrim(($float - floor($float)),"0."); // result .3

$findecimal='0.'.$dec;

$finminutos=round($findecimal*60);

//calcula entero

$float1 = floor($aux1); 

$horadfinal=$horas+$float1;
// $TOTALTIEMPO=$horadfinal.':'.$finminutos;
// return $horadfinal;

return $array = array($float1,$finminutos );
}







$sql="SELECT  `usu_identificacion`,`roles_idroles`, `usu_nombre`, `usu_tipocontrato`,`usu_idsede`,`idusuarios`  FROM `usuarios`   where usu_estado=1 and idusuarios ='".$id_param."' order by usu_nombre  ";

// and usu_identificacion='1082160155'
$DB->Execute($sql); 
			$rw1=mysqli_fetch_row($DB->Consulta_ID);
  
			$valorsalariodia=0;
			$valorsalariohora=0;
			$valorsalariominuto=0;
			
			
			$vsrnocH=0;
			$vsrnocM=0;
			
			//valores salario con recargo domingo y festivo diurno
			
			$vsrdomfesdiuH=0;
			$vsrdomfesdiuM=0;
			
			//valores salario con recargo domingo y festivo nocturno
			
			$vsrdomfesnocH=0;
			$vsrdomfesnocM=0;
			
			
			//valores salario extr diurno
			
			$vexdiurH=0;
			$vexdiurM=0;
			
			//valores salario extra nocturno
			
			$vexnocH=0;
			$vexnocM=0;
			
			//valores salario extra nocturna domingos y festivos
			
			$vsexnocdfH=0;
			$vsexnocdfM=0;
			
			//valores salario extra diurno domingos y festivos
			
			$vsexdiurdfH=0;
			$vsexdiurdfM=0;












$horasnocturnas=0;
$contdiastraba=0;
$horas1 = 0;
$minutos1 = 0;
$segundos1 = 0;
$contador = 0;
$horasextraini = 0;
$minutosDomingo=0;

$horas2 = 0;
$minutos2 = 0;
$segundos2 = 0;
 $minutosDI=0;
  $horasDI=0;
$totahlextras=0;
$totalfinhoex=0;
$minuEXT=0;
$conveminuaho=0;
$horasEXT=0;
$sql9="SELECT hoj_cargo,hoj_salario,hoj_salario, hoj_tipocontrato,hoj_auxilions,hoj_horario,hoj_area,hoj_mediop,hoj_nopension  FROM `hojadevida` WHERE `hoj_cedula`='$rw1[0]'";
			$DB2->Execute($sql9);
			$rw6=mysqli_fetch_row($DB2->Consulta_ID);
			$idcargo =$rw6[0];
			$sinpension =$rw6[8];
			if ($rw6[7]==1) {
				$mediopago ="Consignacion";
			}elseif ($rw6[7]==2) {
				$mediopago ="Efectivo";
			}else {
				$mediopago ="";
			}
			

			$sql4="SELECT `sed_nombre` FROM `sedes` WHERE `idsedes`='".$rw1[4]."'";
			$DB2->Execute($sql4);
			$rw4=mysqli_fetch_row($DB2->Consulta_ID);
			$nomsede =$rw4[0]; 


            $sql10="SELECT rol_nombre FROM `roles` WHERE `idroles`='$rw6[0]'";
			$DB2->Execute($sql10);
			$rw8=mysqli_fetch_row($DB2->Consulta_ID);
			$nomcargo =$rw8[0];

			$sql11="SELECT hora_entrada,hora_salida FROM `horarios` WHERE `id_horarios`='$rw6[5]'";
			$DB2->Execute($sql11);
			$rw9=mysqli_fetch_row($DB2->Consulta_ID);
			$horarioentrada =$rw9[0];
			$horariosalida =$rw9[1];



$horasDomingo=0;
$Dsinfin= 0;

$valorsalariodia=$rw6[1]/30;
$valorsalariohora=$rw6[1]/240;
$valorsalariominuto=$rw6[1]/14400;

//valores salario con recargo nocturno
// echo"DR".$vsrnocD=$rw6[1]/30;
$vsrnocH=($porrecargonocturno*$valorsalariohora)+$valorsalariohora;
$vsrnocM=$rw6[1]/14400;

//valores salario con recargo domingo y festivo diurno
// echo"DR".$vsrdomfesdiuD=$rw6[1]/30;
$vsrdomfesdiuH=($porRecargoDomFesDiu*$valorsalariohora)+$valorsalariohora;
$vsrdomfesdiuM=$rw6[1]/14400;

//valores salario con recargo domingo y festivo nocturno
// echo"DR".$vsrdomfesnocD=$rw6[1]/30;
$vsrdomfesnocH=($porRecargoDomFesNocturno*$valorsalariohora)+$valorsalariohora;;
$vsrdomfesnocM=$rw6[1]/14400;


//valores salario extr diurno
// echo"DR".$vexdiurD=$rw6[1]/30;
$vexdiurH=($porHorasExDiurno*$valorsalariohora)+$valorsalariohora;;
$vexdiurM=$rw6[1]/14400;

//valores salario extra nocturno
// echo"DR".$vsexnocD=$rw6[1]/30;
$vexnocH=($porHorasExNoct*$valorsalariohora)+$valorsalariohora;;
$vexnocM=$vexnocH/60;

//valores salario extra nocturna domingos y festivos
// echo"DR".$vsexnocdfD=$rw6[1]/30;
$vsexnocdfH=($porHorasExDiurnoDomFes*$valorsalariohora)+$valorsalariohora;;
$vsexnocdfM=$rw6[1]/14400;

//valores salario extra diurno domingos y festivos
// echo"DR".$vsexdiurdfD=$rw6[1]/30;
$vsexdiurdfH=($porHorasExNoctDomFes*$valorsalariohora)+$valorsalariohora;;
$vsexdiurdfM=$rw6[1]/14400;



$sql8= "SELECT seg_horaingreso,seg_horaSalida,seg_ingresoAlmuerzo,seg_salioAlmuerzo,seg_fechaingreso FROM `seguimientousers`  where seg_iduser='".$rw1[0]."'and seg_fechaingreso>='".$fechaactual."' and seg_fechaingreso<='". $fechafinal."' order by seg_fechaingreso desc ";
	$DB1->Execute($sql8); 
	$domingos=0;
	$va=0;
	while($rw2=mysqli_fetch_row($DB1->Consulta_ID)){
					$condeenviar="and seg_fechaingreso>='".$fechaactual."' and seg_fechaingreso<='". $fechafinal."";

				$rw2[0];



				$horas1=0;
				$minutos1=0;
				$segundos1=0;
				$horas2=0;
				$minutos2=0;
				$segundos2=0;
				$segunaldia=0;
				$tiempo=0;
				$tiempo2=0;
				

				
				

				
			//Para calcular los dias incompletos
				if ($rw2[2]==$horacero and $rw2[1]==$horacero or  $rw2[2]==$horacero) {

					//dias sin finalizar
					$Dsinfin= $Dsinfin+1;
					}




				$horacero="00:00:00";
				$horafinnormal="21:00:00";
			//para calcular primer tiempo del dia 
				$apertura = new DateTime($rw2[0]);

				if ($rw2[2]== $horacero) {
				$cierre = new DateTime($rw2[0]);	
				}else{
					$cierre = new DateTime($rw2[2]);
				}


			$tiempo = $apertura->diff($cierre);






			$horas1 = $horas1 + $tiempo->format('%H');//total de segundos del primer tiempo del dia
			$minutos1 = $minutos1 +$tiempo->format('%i');//total de segundos del primer tiempo del dia
			$segundos1 = $segundos1 + $tiempo->format('%s');//total de segundos del primer tiempo del dia





			//para calcular segundo tiempo del dia 
			$apertura2 = new DateTime($rw2[3]);

				if ($rw2[1]== $horacero){
				$cierre2 = new DateTime($rw2[3]);	
				}else{
					$cierre2 = new DateTime($rw2[1]);
				}


			$tiempo2 = $apertura2->diff($cierre2);
			// $secondDate = new DateTime($tiempo);


//para extras despues de las hora limite diurno a nocturno
if ($rw2[1]>=$horaregularlimite){

	$horalimnoctcon=new DateTime($horaregularlimite);

	$tiemponocturno = $cierre2->diff($horalimnoctcon);

	$horasnocturnas = $horasnocturnas+$tiemponocturno->format('%H');
	$minunocturnas = $minunocturnas+$tiemponocturno->format('%i');
	// echo"las horas nocturnas".$horasnocturnas;
	// echo"Trabajo con rcargos";


	
	
}
//PARA RECARGOS Y HORAS EXTRA NOCTURNAS
if($horariosalida>$horaregularlimite){
    $horasderecargonoc=$horasnocturnas;
	$minutosderecargonoc=$horasnocturnas;

}else{

	$horasdeextranoc=$horasnocturnas;
	$minutosdeextranoc=$minunocturnas;
}
	

			$horas2 = $horas2 + $tiempo2->format('%H');//total de horas del segundo tiempo del dia
			$minutos2 = $minutos2 +$tiempo2->format('%i');//total de minutos del segundo tiempo del dia
			$segundos2 = $segundos2 + $tiempo2->format('%s');//total de segundos del segundo tiempo del dia



			$hoyes="".saber_dia($rw2[4])."";




			if ($hoyes=="Domingo"){

				$domingos=$domingos+1;	
			}


			

			$horasaldia=$tiempo->format('%H')+ $tiempo2->format('%H');//total de horas  los dos tiempos del dia
			$minualdia=$tiempo->format('%i')+ $tiempo2->format('%i');//total de minutos los dos tiempos del dia
			$segunaldia=$tiempo->format('%s')+ $tiempo2->format('%s');//total de segundos los dos tiempos del dia


			//para calcular si son mas de 60 minutos pasa a ser una hora mas y se restan 60 minutos

			// if ($minualdia>=60) {
			// 	$horasaldia+1;
			// 	$minualdia=$minualdia-60;

			// if ($segunaldia>=60) {
			// 	$minualdia+1;
			// 	$segunaldia=$segunaldia-60;

				
			// }
			list($minus,$segus) = calculototaltiempo($segunaldia);

			$minualdia=$minualdia+$minus;


			list($horasn,$minusn) = calculototaltiempo($minualdia);

			$horasaldia=$horasaldia+$horasn;
			$minualdia=$minusn;
			


			 
			if ($horasaldia>=8 and $hoyes!="Domingo" ) {


			
                    $horasextraini=$horasaldia-8;
					$minuextradia=$minualdia;


				// }

				$horasEXT=$horasEXT+$horasextraini;
				$minuEXT=$minuEXT+$minuextradia;
				$seguEXT=$seguEXT+$segunaldia;  


				if($rw2[0]=='00:00:00'or $rw2[0]==''){
				
				}else{

					$contdiastraba++; 
				}
				// if ($horasextraini>0) {

					// if ($cierre2>$horafinnormal){
						

					// 	$horasantesde=

					//     $horasdespuesde=
					// }



///////////////CALCULO DE HORAS MINUTOS Y SEGUNDOS EXTRA///////////////
			          	
							// }
					
					$va++;


			// $vaenhorasnormales=$va*8;
			// $vaenhorasnormales=$vaenhorasnormales+$vaenhorasnormales;
			}else if($hoyes=="Domingo"){



			$horasDomingo = $horasDomingo+$horasaldia;
			$minutosDomingo = $minutosDomingo+$minualdia;
				// $diaincom++;


			// $vaenhorasnormales=$vaenhorasnormales+$horasaldia;
			}elseif($hoyes=="Sabado" and $rw6[6]=="Administrativo" ){


				$contdiastraba=$contdiastraba+1; 
				
				
			
			}else{


			$horasDI = $horasaldia+$horasDI;

			$minutosDI=$minualdia+$minutosDI;

			}
			if($horasaldia>8){
			$diaincom++;
			}else{

			}

    }
if ($mesfiltrado==2 and $diafiltrado>15 ) {
	$contdiastraba=$contdiastraba+2;
}
// 

	list($unop,$dosp) = calculototaltiempo($minuEXT);

	// echo"TOTAL HORAS EXTRA sin descontar noc".$unop.":".$dosp;


	setlocale(LC_MONETARY, 'es_CO');

	
//RESTANDO HORAS EXTRA NOCTURNAS A LAS HORS EXTRA TOTALES 
              if($minutosdeextranoc>0 or $horasdeextranoc>0 ){
				$minuEXT=$minuEXT-$minutosdeextranoc;
                $horasEXT=$horasEXT-$horasdeextranoc;
			  }
// }
//PRECIO DE LAS HORAS EXTRAS NOCTURNAS TRABAJADAS
$valorhEXnoc=$horasdeextranoc*$vexnocH;
$valormEXnoc=$minutosdeextranoc*$vexnocM;
$valortotalexnoc=$valorhEXnoc+$valormEXnoc;

$VALORTOTALEXNOC=number_format($valortotalexnoc, 2);



             //horas totales extra

			 if ($minuEXT>=60) {
				// $conveminuaho=calculototaltiempo($minuEXT);//funcion para convertir minutos a horas
				// $totalfinhoex=$horasEXT+$conveminuaho;
				// $minuEXT=0;


				list($uno,$dos) = calculototaltiempo($minuEXT);
				$conveminuaho=$uno;//funcion para convertir minutos a horas
				$totalfinhoex=$horasEXT+$conveminuaho;
				$minuEXT=$dos;
			 }else{

				$totalfinhoex=$horasEXT;
				$minuEXT=$minuEXT;
			 }
            
           


//TOTAL DE HORAS EXTRA PARA MOSTRAR







$totahlextras= $totalfinhoex.":".$minuEXT;


$PRE_HEX=$vexdiurH;//para calcular el 25% del precio por hora
$PRE_MEX=$minuprecio*0.25;//para calcular el 25% del precio por minuto

////
             $THEXP_PRE=$totalfinhoex*$vexdiurH;   
             $THEXP=$minuEXT*$valorsalariohora;
             echo"TPHEX".$totalpreciohorasex=$THEXP_PRE."//"; //TOTAL precio HORA EXTRA Diurno
///             

///
             $TMEXP_PRE=$minuEXT*$PRE_MEX;
             $TMEXP=$minuEXT*$valorsalariominuto;
             echo"TPMEX".$totalpreciominutosex=$TMEXP_PRE+$TMEXP."//";//TOTAL precio minuto EXTRA Diurno
             $TprecioHEX = $totalpreciohorasex+$totalpreciominutosex; 
			 $tpreciohex=number_format($TprecioHEX, 2);

         
           



			//DIURNO



			//NOCTURNO



			//DOM/FES/DIUR
			$precioexdf=$horasDomingo*$vsexdiurdfH;
			$precioexdft=number_format($precioexdf, 2);

			//DOM/FES/NOC

			echo"totalextras".$THEXPQ= $totalpreciohorasex+$totalpreciominutosex+$valortotalexnoc+$precioexdf;

			$THEXPQF=number_format($THEXPQ, 2); //total valor horas extra trabajadas para mostrar
		  


$horas = $horas1+$horas2;
$minutos = $minutos1+$minutos2;
$segundos = $segundos1+$segundos2;




$aux1=$minutos*1/60;

//calcula decimal
$float = $aux1; 
 $dec = ltrim(($float - floor($float)),"0."); // result .3

$findecimal='0.'.$dec;

$finminutos=round($findecimal*60);

//calcula entero

$float1 = floor($aux1); 

$horadfinal=$horas+$float1;
$TOTALTIEMPO=$horadfinal.':'.$finminutos;



  $tsegundos = gmdate('H:i:s', $segundos);
 $tminutos = gmdate('H:i:s', $minutos * 60);
 $thoras = gmdate('H:i:s', $horas*3600);



$falso1='08:30:02';
$falso2='08:30:01';



        $horaprecio = $rw6[2]/240;
       $minuprecio = $rw6[2]/14400;
        
$preciohora= number_format( $horaprecio, 2);

$salariobasico= number_format( $rw6[2], 2);



 
		  echo "<tr class='text' bgcolor='#EFEFEF' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		 
		 
		  	if ($va<15) {

		  		
            // $diasneto=$va+1;
		  	 $diasneto=$va;

		  	 }


		  	 $diastraba=$va;
             
             // echo"HORAS DIAS INCOMPLETOS".$horasDI.""; ;)

             $vaenhorasnormales=$diastraba*8;

///calculo de horas de dias incompletos

list($horasinco,$munitosinco)=calculototaltiempo($minutosDI);
            $horasdeminINC=$horasinco;

            $horasDI=$horasDI+$horasdeminINC;
             


             $horasacalcular=$vaenhorasnormales+$horasDI;
             
		  	 $saladia=$rw6[2]/30;
///calculo horas diurno
            //  $salario15=$horasacalcular*$horaprecio;
			 ///calculo horas diurno DIAS
             $contdiastraba=$contdiastraba+$domingos;
             $salario15=$contdiastraba*$valorsalariodia;
///calculo horas recargo domingo diurno
		  	
		  	 $salario15DN=$horasDomingo*$horaprecio;


		  	 $salariorecargo15=$horaprecio*1;
             $salariorecargo15F=$salariorecargo15*$horasDomingo;
///calculo total precio extra domingos
             $salarioTRD=$salariorecargo15F+ $salario15DN;
             $salarioTRDM= number_format( '0', 2);








//total susbsidio de transporte quincenal

              if ($rw6[0]<2320000) {
              $diasconsubsitrans=$contdiastraba;
              }else{

              	$diasconsubsitrans=0;
              }
         



         $Totalsubtrans=$diasconsubsitrans*$subtransD;
         $TSTQ=number_format( $Totalsubtrans, 2);

 // echo'TOTAL TODAS H EXT'. $horasEXT.'/'.$minuEXT.'/'.$seguEXT;
         $salariobasetotal= number_format( $salario15, 2);





//Calculo auxilio extra salarial segun dias laborados
if ($rw6[4]=="") {
	$bonoxt=0;
}else{

	$bonoxt=$rw6[4];
}


$bonoxtra1=$bonoxt/30;
$bonoxtra2=$bonoxtra1*$contdiastraba;
$bonoxtra=number_format($bonoxtra2, 2);

// $AUXTHSP1=$salario15+$THEXPQ+$valortotalexnoc+$precioexdf;

echo$AUXTHSP1=$salario15+$THEXPQ;
// $THSPf1=$AUXTHSP2+$AUXTHSP2;
if ($sinpension==2) {
	$AUXTHSP2=0;
	$THSPf1=0;
}else{
	$AUXTHSP2=$AUXTHSP1*$salud;
	$THSPf1=$AUXTHSP2+$AUXTHSP2;
}

$THSP=number_format($AUXTHSP2, 2);           
$THSPf=number_format($THSPf1, 2);
$totaldeducciones=$AUXTHSP2+$AUXTHSP2;
$TOTALDEDUCCIONES=number_format($totaldeducciones, 2);


$devengado=$salario15+$Totalsubtrans+$TprecioHEX+$valortotalexnoc+$precioexdf;


$DEVENGADO=number_format($devengado, 2);

$totalapagarfinal=$devengado-$totaldeducciones+$bonoxtra2;
$totalapagarfinalredondeado=round($totalapagarfinal);
$TOTALAPAGARFINAL=number_format($totalapagarfinalredondeado, 2);;




	 



		echo "<tr class='text' bgcolor='#EFEFEF'>" ;
	

			
            echo "<td colspan='1' width='0' align='center' bgcolor='#F08080'><strong>EMPRESA:</strong></td>";
            echo "<td colspan='2' width='0' align='center'>BERMUDAS S.A.S. </td>";
			echo "<td colspan='1' width='0' align='center' bgcolor='#F08080'><strong>NIT:</strong></td>";
			echo "<td colspan='4' width='0' align='center'>901.169.262-8</td>";
			// echo "<td colspan='1' width='0' align='center' >-</td>";
			// echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' ><strong>CÓDIGO</strong></td>";

			// echo "<td colspan='4' width='0' align='center' ></td>";
		
			



		echo"</tr>";
	

	

echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' ><strong>TRABAJADOR:</strong></td>";
            echo "<td  width='0' align='center' colspan='4'>".$rw1[2]."</td>";
			echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' ><strong>C.C.</strong></td>";
			echo "<td colspan='4' width='0' align='center'>".$rw1[0]."</td>";
			
			
echo"</tr>";




echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 echo "<td colspan='1' width='0' align='center' bgcolor='#F08080'><strong>SALARIO BÁSICO</strong></td>";
            echo "<td colspan='1' width='0' align='center'>".$salariobasico."</td>";
			echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' ><strong>SUB DE TRANS</strong></td>";
			echo "<td colspan='1' width='0' align='center'>".$TSTQ."</td>";
			echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' ><strong>SEDE</strong></td>";
			echo "<td colspan='1' width='0' align='center'>".$nomsede."</</td>";

			echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' ><strong>MEDIO DE PAGO</strong></td>";
			// echo "<td colspan='1' width='0' align='center' >--</td>";
			// echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' >MEDIO DE PAGO</td>";
			echo "<td colspan='3' width='0' align='center' >".$mediopago."</td>";
echo"</tr>";


echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' ><strong>PERÍODO DE PAGO:</strong></td>";
            echo "<td colspan='1' width='0' align='center'>".$conde."</td>";
			echo "<td colspan='1' width='0' align='center'><strong>Mes</strong></td>";
			echo "<td colspan='1' width='0' align='center'>".date('m',$fechaderegistro)."</td>";
			echo "<td colspan='1' width='0' align='center' ><strong>A&ntilde;o</strong></td>";
			echo "<td colspan='1' width='0' align='center'>".date('Y',$fechaderegistro)."</td>";

			echo "<td colspan='1' width='0' align='center' bgcolor='#F08080' ><strong>D&Iacute;AS LABORADOS</strong></td>";
			echo "<td colspan='3' width='0' align='center' >". $contdiastraba."</td>";
			
echo"</tr>";

echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 echo "<td colspan='3' width='0' align='center' bgcolor='#F08080' ><strong>DESCRIPCION:</strong></td>";
			echo "<td colspan='3' width='0' align='center' bgcolor='#F08080' ><strong>PAGOS:</strong></td>";
			echo "<td colspan='4' width='0' align='center' bgcolor='#F08080' ><strong>DESCUENTOS</strong></td>";
			
			
echo"</tr>";



		
		
	
	
	
		
	
	
	
		
		
		
	

echo "<tr class='text' bgcolor='#EFEFEF'>" ;
         echo "<td colspan='3' width='0' align='center'  >Basico devengado</td>";
			echo "<td colspan='3' width='0' align='center'><strong>".$salariobasetotal."</strong></td>";
			echo "<td colspan='4' width='0' align='center' ><strong>$0</strong></td>";
			
			
echo"</tr>";
$recarnnoctor=0;	
if($recarnnoctor!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
            echo "<td colspan='3' width='0' align='center'>Recargo nocturno ordinario</td>";
			echo "<td colspan='3' width='0' align='center'><strong>$0</strong></td>";
			echo "<td colspan='4' width='0' align='center' ><strong>$0</strong></td>";
	        
		
echo"</tr>";	
}
$recardomfesdiurn=0;	
if($recardomfesdiurn!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
            echo "<td colspan='3' width='0' align='center'>Recargo dom./fest. diurna	</td>";
            echo "<td colspan='3' width='0' align='center'>$0</td>";
			echo "<td colspan='4' width='0' align='center'><strong>$0</strong></td>";
			
			
echo"</tr>";	
}
$recardomfesnoct=0;	
if($recardomfesnoct!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
            echo "<td colspan='3' width='0' align='center'>Recargo dom./fest. noct.</td>";
            echo "<td colspan='3' width='0' align='center'>$0</td>";
			echo "<td colspan='4' width='0' align='center'><strong>$0</strong></td>";
		
			
echo"</tr>";	
}
	
if($TprecioHEX!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 			echo "<td colspan='3' width='0' align='center'>Hora Extra Diurna Ordinaria	</td>";
            echo "<td colspan='3' width='0' align='center'>".$tpreciohex."</td>";
			echo "<td colspan='4' width='0' align='center'><strong>$0</strong></td>";
			
		
echo"</tr>";	
}

if($valortotalexnoc!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 			echo "<td colspan='3' width='0' align='center'>Hora Extra Nocturna Ordinaria</td>";
            echo "<td colspan='3' width='0' align='center'>".$VALORTOTALEXNOC."</td>";
			echo "<td colspan='4' width='0' align='center'><strong>$0</strong></td>";
			
			
			// echo "<td colspan='1' width='0' align='center' >$0</td>";
echo"</tr>";	
}

if($precioexdf!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 			echo "<td colspan='3' width='0' align='center'>Hora Extra Diurna Dom/Fest	</td>";
            echo "<td colspan='3' width='0' align='center'>".$precioexdft."</td>";
			echo "<td colspan='4' width='0' align='center'><strong>$0</strong></td>";
			
			
			// echo "<td colspan='1' width='0' align='center' >$0</td>";
echo"</tr>";	
}
$horaexnocdomfes=0;
if($horaexnocdomfes!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 			echo "<td colspan='3' width='0' align='center'>Hora Extra Nocturna Dom/Fest</td>";
            echo "<td colspan='3' width='0' align='center'>$0</td>";
			echo "<td colspan='4' width='0' align='center'><strong>$0</strong></td>";
			
			
echo"</tr>";	
}
if($Totalsubtrans!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 echo "<td colspan='3' width='0' align='center'>Subsidio de transporte	</td>";
            echo "<td colspan='3' width='0' align='center'>".$TSTQ."</td>";
			echo "<td colspan='4' width='0' align='center'><strong>$0</strong></td>";
			
			
echo"</tr>";
}	

if($bonoxtra2!=0){
echo "<tr class='text' bgcolor='#EFEFEF'>" ;
 echo "<td colspan='3' width='0' align='center'>Auxilio Extralegal (No salarial)</td>";
            echo "<td colspan='3' width='0' align='center'>".$bonoxtra."</td>";
			echo "<td colspan='4' width='0' align='center'><strong>$0</strong></td>";
			
			
echo"</tr>";	
}
	


if ($sinpension==2) {
	
}else{

	echo "<tr class='text' bgcolor='#EFEFEF'>" ;
echo "<td colspan='3' width='0' align='center' ><strong>Aporte a salud</strong></td>";
echo "<td colspan='3' width='0' align='center'>$0</td>";
			echo "<td colspan='4' width='0' align='center' >".$THSP."</td>";
	
echo"</tr>";
	echo "<tr class='text' bgcolor='#EFEFEF'>" ;
echo "<td colspan='3' width='0' align='center' ><strong>Aporte a pension</strong></td>";
echo "<td colspan='3' width='0' align='center'>$0</td>";
echo "<td colspan='4' width='0' align='center' >".$THSP."</td>";
echo"</tr>";
}
	



// echo "<tr class='text' bgcolor='#EFEFEF'>" ;
//  echo "<td colspan='1' width='0' align='center'>Dominical no reportado anteriormente</td>";
//             echo "<td colspan='1' width='0' align='center'>$0-</td>";
// 			echo "<td colspan='1' width='0' align='center'><strong>-</strong></td>";
// 			echo "<td colspan='1' width='0' align='center'>--</td>";
// 			echo "<td colspan='1' width='0' align='center' ><strong>-</strong></td>";
// 			echo "<td colspan='1' width='0' align='center'>--</td>";

// 			echo "<td colspan='1' width='0' align='center' ><strong>-</strong></td>";
// 			echo "<td colspan='1' width='0' align='center' >--</td>";
// 			
// 			echo "<td colspan='1' width='0' align='center' >--</td>";
// echo"</tr>";	

echo "<tr class='text' bgcolor='#EFEFEF'>";
 echo "<td colspan='2' width='0' align='center' bgcolor='#F08080'>TOTAL DEVENGADO:</td>";
            echo "<td colspan='2' width='0' align='center'>".$DEVENGADO."</td>";
			echo "<td colspan='2' width='0' align='center' bgcolor='#F08080'><strong>TOTAL DEDUCCIONES:</strong></td>";
			echo "<td colspan='2' width='0' align='center'>".$TOTALDEDUCCIONES."</td>";
	

//Convertimos el total en letras
$totalpagar=$totalapagarfinalredondeado;
$valorLetra=($v->convertirEurosEnLetras($totalpagar));


			echo "<td colspan='1' width='0' align='center' >-</td>";
echo"</tr>";

echo "<tr class='text' bgcolor='#EFEFEF'>";
 echo "<td colspan='2' width='0' align='center' bgcolor='#F08080'>NETO A PAGAR:</td>";
            echo "<td colspan='2' width='0' align='center'>".$TOTALAPAGARFINAL."</td>";
			echo "<td colspan='2' width='0' align='center' bgcolor='#F08080'><strong>VALOR LETRAS:</strong></td>";
			echo "<td colspan='2' width='0' align='center'><strong>".$valorLetra."</strong></td>";
			
			// echo "<td colspan='1' width='0' align='center' >-</td>";
			echo "<td colspan='1' width='0' align='center' >--</td>";
echo"</tr>";


	$FB->titulo_azul1("",1,0,10); 
	$FB->titulo_azul1(" $va",1,0,0); 

	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 



    $conde=$_REQUEST["param1"];
	$conde4=$_REQUEST["param2"];
	$fechaactual=$_REQUEST["param3"];
	$fechafinal=$_REQUEST["param4"];
    



	// $valorenletras=$formatterES->format($totalapagarfinalredondeado)." pesos ";


	
    echo'<a style="color:#000000;"   href="desprendibleexcel.php?trabajador='.$rw1[2].'&cedula='.$rw1[0].'&salbase='.$salariobasico.'&subtrans='.$TSTQ.'&sede='.$nomsede.'&diaslaborados='.$contdiastraba.'&salbasetotal='.$salariobasetotal.'&HEDO='.$THEXPQF.'&HoraENocOr='.$VALORTOTALEXNOC.'&HoraExDiuDoFe='.$precioexdft.'&Subtrans='.$TSTQ.'&AuxExNosal='.$bonoxtra.'&Aportesalud='.$THSP.'
	&Aportepension='.$THSP.'&TOTALDEVENGADO='.$DEVENGADO.'&TOTALDEDUCCIONES='.$TOTALDEDUCCIONES.'&NETOPAGAR='.$TOTALAPAGARFINAL.'&quincena='.$conde.'&VALORLETRAS='.$valorLetra.'&fechaderegistro='.$fechaderegistro.'"">
            <img src="images/excel.png" style = "width:50px; height:40px; " hrf="reporteusuarios.php" title="Ver Reporte"/> Descargar</a>';

	








	
// trabajador
// $rw1[2]

// cedula
// $rw1[0]

// salbase
// $salariobasico

// subtrans
// $TSTQ

// sede
//$nomsede

// HoraENocOr
// $VALORTOTALEXNOC

// HoraExDiuDoFe	
// $precioexdft

// Subtrans	
// $TSTQ

// AuxExNosal
// $bonoxtra

// Aportesalud
// $THSP

// Aportepension
// $THSP



// TOTALDEVENGADO
// $DEVENGADO

// TOTALDEDUCCIONES:
// $TOTALDEDUCCIONES


// NETOPAGAR
// $TOTALAPAGARFINAL

// VALORLETRAS
// $valorenletras;

// // echo "<td colspan='1' width='0' align='center' >-</td>";
// echo "<td colspan='1' width='0' align='center' >--</td>";
// echo"</tr>";


		  

}else if($tabla=="Validarsolicitud"){
	$idciudad=$_REQUEST["idciudad"];

	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);	
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "Validarsolicitud", 5, 0);

	$sql11="SELECT `soli_id`,`soli_tipo`,`soli_inicio`, `soli_fin`,`soli_valida`, `soli_soporte`, `soli_gerente`, `soli_gefeinme`, `soli_remunerado` FROM `solicitudes` WHERE soli_id='$id_param'";
	$DB2->Execute($sql11);
	$rw9=mysqli_fetch_row($DB2->Consulta_ID);
	// $horarioentrada =$rw9[0];
	// $horariosalida =$rw9[1];	


	




	


	$FB->llena_texto("Estado de la solicitud:", 9, 82, $DB,$estadosnovedades, "", "$rw9[4]", 1, 1);
	if ($rw9[1]=="Certificado laboral") {
	
	}else {
		$FB->llena_texto("Fecha inicio:",4, 10, $DB, "", "", "$rw9[2]", 2, 0);
		$FB->llena_texto("Fecha fin:",5, 10, $DB, "", "", "$rw9[3]", 2, 0);
	}
	$FB->llena_texto("Presenta soporte:", 10, 2, $DB,"SELECT  `confir_valor`,`confir_nombre` FROM `confirmcion` ", "", "$rw9[5]", 1, 1);
    $FB->llena_texto("Aprobado rcursos humanos:", 11, 2, $DB,"SELECT `confir_valor`,`confir_nombre` FROM `confirmcion` ", "", "$rw9[6]", 1, 1);
    $FB->llena_texto("Aprobado jefe inmediato:", 12, 2, $DB,"SELECT `confir_valor`,`confir_nombre` FROM `confirmcion` ", "", "$rw9[7]", 1, 1);
    $FB->llena_texto("Remunerado?", 13, 2, $DB,"SELECT `confir_valor`,`confir_nombre` FROM `confirmcion` ", "", "$rw9[8]", 1, 1);
	
}else if($tabla=="Aprobar"){
	
	$FB->llena_texto("Fecha de aprobacion:", 7, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Dinero Aprobado para el gasto:",6, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "aprobar", 5, 0);

}
else if($tabla=="Verificar Remesa"){
	
	//$FB->llena_texto("Dinero Aprobado para el gasto:",6, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Descripcion:",2,9, $DB, "", "","" ,1, 1);		
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "Verificar Remesa", 5, 0);

}
else if($tabla=="Cierre del dia"){
	
	 $valorjson=$_REQUEST["valordos"];
	 $valor2json=$_REQUEST["varcal"];
	 $fecharecierre=$_REQUEST["fecharecierre"];
	 $idciudad=$_REQUEST["idciudad"];
	 $valorjson=json_encode($valorjson, JSON_FORCE_OBJECT);
	// $valor2json=json_encode($valor2json, JSON_FORCE_OBJECT);
	 if($nivel_acceso==1){ 
		echo "<div class='alert alert-danger'>
		<strong> CIERRE DIARIO </strong> ¿DESEA HACER EL CIERRE DE ESTE DIA  POR ESTE VALOR?
	  ";
	  echo " <input name='dinero' id='dinero'   type='text' value='$id_param' >
		</div>";

	 }else{
		echo "<div class='alert alert-danger'>
		<strong> CIERRE DIARIO </strong> ¿DESEA HACER EL CIERRE DE ESTE DIA  POR ESTE VALOR $id_param?
	  </div>";
	  $FB->llena_texto("dinero", 1, 13, $DB, "", "", $id_param, 5, 0);

	 }
	//print_r($valor2json);

	$FB->llena_texto("fecharecierre", 1, 13, $DB, "", "", $fecharecierre, 5, 0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $idciudad, 5, 0);
	$FB->llena_texto("valoresjs", 1, 13, $DB, "", "", $valorjson, 5, 0);
	$FB->llena_texto("valores2js", 1, 13, $DB, "", "", $valor2json, 5, 0);

} 
else if($tabla=="Recoger Paquete"){ 

$FB->llena_texto("¿Paquete Recogido?:",1,82, $DB, $recogido, "cambio_ajax2(this.value, 11, \"llega_sub1\", \"param2\", 1,$id_param)",@$rw[1], 17, 1);
$FB->llena_texto("", 2, 4, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "", 5, 0);
$FB->llena_texto("encomiendas", 1, 13, $DB, "", "", "0", 5, 0);
}
else if($tabla=="Recoger oficina"){ 

	$FB->llena_texto("¿Paquete Recogido?:",1,82, $DB, $recogido, "cambio_ajax2(this.value, 11, \"llega_sub1\", \"param2\", 1,$id_param)",@$rw[1], 17, 1);
	$FB->llena_texto("", 2, 4, $DB, "llega_sub1", "", "",4,0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "operadoroficina", 5, 0);
	$FB->llena_texto("encomiendas", 1, 13, $DB, "", "", "0", 5, 0);
	}
else if($tabla=="Entregar Guias"){ 

$FB->llena_texto("¿Paquete Entregado?:",1,82, $DB, $entregado, "cambio_ajax2(this.value, 12, \"llega_sub1\", \"param2\", 1,$id_param)",@$rw[1], 17, 1);
$FB->llena_texto("", 2, 4, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
}
else if($tabla=="Factura"){

 $sql="SELECT `idclientes`,`ser_consecutivo`, `ser_resolucion`,`cli_nombre`,  `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`, `ser_tipopaquete`,`cli_iddocumento`, `cli_telefono`, `cli_email`, 
 `cli_idciudad`, `cli_direccion`,  `ser_fechaentrega`,`ser_prioridad`,  `idservicios` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  inner join rel_sercli on idclientes=ser_idclientes 
 inner join servicios on  ser_idservicio=idservicios  inner join ciudades on ser_ciudadentrega=idciudades where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

$planillas=explode("/",$rw[1]);
include("imprimir.php");	
$rw[9]=$tipopago[$rw[9]];

	}
else if($tabla=="Editar datos"){ 

 $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `cli_clasificacion`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir,ser_idusuarioguia FROM 
			serviciosdia  where idservicios=$id_param";
			$DB1->Execute($sql);
			$rw=mysqli_fetch_array($DB1->Consulta_ID);
			$blo=0;
			$blo2="";
						
			@$param4=$rw[4];
			if($nivel_acceso!=1){  $cond6=" WHERE inner_sedes='$id_sedes'"; }  else { $cond6=""; }
			if($rw[22]!=0){ $blo=2;  $blo2="disabled";   }
			
			$FB->titulo_azul1("Remitente",10,0, 5);  

		//$FB->llena_texto("CC / Nit:",1, 117, $DB, "", "", $rw[1], 1, 0);
		$FB->llena_texto("Tel&eacute;fonos :",2,120, $DB, "", "", $rw[2], 1, $blo);
		echo  "<tr bgcolor='#FFFFFF' ><td>Remitente:</td><td colspan=1><div id='clientesdir'>";
		echo " <input name='param6' id='param6' class='trans'  type='text' value='$rw[6]' onkeypress='return noenter();' $blo2>
		</div></td>";

		$FB->llena_texto("Ciudad:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades` $cond6)", "", "$param4", 1, $blo);


		@$direcc=explode("&",$rw[5]);
		@$param5=$direcc[0];
		@$param51=$direcc[1];
		@$param19=$direcc[2];
		@$param20=$direcc[3];
		@$param23=$direcc[4];
		echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Recogida:</td>
	<td align='left' ><select class='trans'  name='param5' id='param5'  $blo2 >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();' $blo2>
	</td>";

	echo "</tr><tr bgcolor='#F3F3F3' ><td></td>
	<td align='left' ><select class='trans'  name='param19' id='param19' $blo2 >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();' $blo2>
	</td>
	
	</tr>";

		$FB->llena_texto("Barrio:", 23, 1, $DB, "", "", $param23, 1, $blo);	
		$FB->llena_texto("Email:", 3, 111, $DB, "", "", $rw[3], 17	, $blo);	
		$FB->titulo_azul1("Destinatario",9,0,5); 

		$FB->llena_texto("Tel&eacute;fono:",8, 120, $DB, "", "", $rw[8], 17, 1);
		$FB->llena_texto("Nombre:",9, 1, $DB, "", "", $rw[9], 17, 1);
		$FB->llena_texto("Ciudad:",11,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`)", "", "$rw[11]", 1, 1);

		@$direcc2=explode("&",$rw[10]);
		@$param10=$direcc2[0];
		@$param101=$direcc2[1];
		@$param21=$direcc2[2];
		@$param22=$direcc2[3];
		@$param24=$direcc2[4];

	echo "</tr><tr bgcolor='#F3F3F3' ><td>Direcci&oacute;n del Contacto:</td>
	<td align='left' ><select class='trans'  name='param10' id='param10' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param10, $DB);

    echo "</select>
	<input name='param101' id='param101' class='trans'  type='text' value='$param101' onkeypress='return noenter();'>
	</td></tr>";

	echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Entrega:</td>
	<td align='left' ><select class='trans'  name='param21' id='param21' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param21, $DB);
    echo "</select>
	<input name='param22' id='param22' class='trans'  type='text' value='$param22' onkeypress='return noenter();'>
	</td>
	";
	$FB->llena_texto("Barrio:", 24, 1, $DB, "", "", $param24, 1, 0);

	$FB->llena_texto("id_param0", 1, 13, $DB, "", "", "$rw[21]", 5, 0); //idclientes
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "$rw[19]", 5, 0);  // idservicio
	
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param1", 1, 13, $DB, "", "", "EDITAR DATOS", 5, 0);
	$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "recogidas", 5, 0);
	$FB->llena_texto("encomiendas", 1, 13, $DB, "", "", "$blo", 5, 0);
	//$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);

	}
else if($tabla=="Editar Datos Guia"){ 	

 $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `ser_iddocumento`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`,
 `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir,ser_descllamada,date(ser_fecharegistro) 
 ,`ser_peso`,`ser_guiare`,ser_volumen,`ser_piezas`,ser_descripcion,ser_verificado,ser_tipopaq,ser_clasificacion,`ser_valor`, `ser_estado`,`ser_fechafinal`, `ser_fechaentrega`, `ser_prioridad`,  `ser_recogida`, `ser_motivo`,
 `ser_fechaconfirmacion`, `ser_fechaasignacion`, `ser_estado`,ser_devolverreci,ser_idverificadopeso,ser_descentrega
 FROM  serviciosdia  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

   include("editardatos.php");

}
else if($tabla=="Cuentas"){ 	
	
	include("cuentas.php");
 
}
else if($tabla=="Cotizar"){ 	
	
	  include("cotizar.php");
   
 } else if($tabla=="Temperatura"){ 	
	
/* echo	'<div class="form-group">
	<div class="btn btn-success btn-file">
		<i class="fa fa-paperclip"></i>  Temperatura
		<input type="file" name="paramc4" />
	</div>
	<p class="help-block">Tama&ntilde;o: 215px x 215px</p>
</div>'; */
$slq="SELECT idpreoperacinal FROM `pre-operacional` where preidusuario='$id_usuario' and prefechaingreso like '$fechaactual%'";	
$DB->Execute($slq); 
$rw2=mysqli_fetch_row($DB->Consulta_ID);

$FB->llena_texto("Imagen Temperatura:",2, 6, $DB, "", "", "",2, 0); 
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $rw2[0], 5, 0);

 }
else if($tabla=="recorridooperador"){ 
	
	 $param33=$id_param;
	 $fechaactual=$_REQUEST["ide"];
	include("detalle_recorrido.php");

}
else if($tabla=="Recogidas"){ 

  $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_nombre`,  `cli_telefono`, `cli_email`, `ciu_nombre`, `cli_direccion`, `cli_clasificacion`, `cli_idciudad`,  `cli_tipo`,
`idservicios`, `ser_destinatario`, `ser_telefonocontacto`,`ser_ciudadentrega`,`ser_direccioncontacto`, `ser_tipopaquete`,`ser_piezas`, `ser_paquetedescripcion`, 
  `ser_horaentrega`,`ser_clasificacion`,`ser_valorprestamo`, `ser_valorseguro`,`ser_valorabono`, `ser_consecutivo`,`ser_idresponsable`, `ser_iduserverific`,
  `ser_idasignacion`,`ser_peso`,`ser_guiare`,`ser_fechafinal`,`ser_valor`,  `ser_fechaentrega`, `ser_prioridad`,  `ser_recogida`, `ser_motivo`,  `ser_fecharegistro`,
  `ser_fechaconfirmacion`, `ser_fechaasignacion`, `ser_estado`,ser_devolverreci,ser_volumen,ser_idverificadopeso,ser_descentrega FROM serviciosdia  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

if($rw[0]=="" or $rw[0]==0){

  $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_nombre`,  `cli_telefono`, `cli_email`, `ciu_nombre`, `cli_direccion`, `cli_clasificacion`, `cli_idciudad`,  `cli_tipo`,
`idservicios`, `ser_destinatario`, `ser_telefonocontacto`,`ser_ciudadentrega`,`ser_direccioncontacto`, `ser_tipopaquete`,`ser_piezas`, `ser_paquetedescripcion`, 
  `ser_horaentrega`,`ser_clasificacion`,`ser_valorprestamo`, `ser_valorseguro`,`ser_valorabono`, `ser_consecutivo`,`ser_idresponsable`, `ser_iduserverific`,
  `ser_idasignacion`,`ser_peso`,`ser_guiare`,`ser_fechafinal`,`ser_valor`,  `ser_fechaentrega`, `ser_prioridad`,  `ser_recogida`, `ser_motivo`,  `ser_fecharegistro`,
  `ser_fechaconfirmacion`, `ser_fechaasignacion`, `ser_estado`,ser_devolverreci,ser_volumen,ser_idverificadopeso,ser_descentrega FROM servicios2 inner join rel_sercli  on idservicios=ser_idservicio  inner join clientesservicios on idclientesdir=ser_idclientes inner join clientes on idclientes=cli_idclientes  inner join ciudades on idciudades=ser_ciudadentrega  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

}

if($rw[38]==6 and $rw[41]==1){
	$rw[38]=14;
}
//echo $rw[38];
$estadoguia=$estado_guia["$rw[38]"];

$FB->titulo_azul1("Estado de la GUIA: $estadoguia  ",10,0, 5); 

$FB->titulo_azul1("Datos Cliente",10,0, 5);  
$rw[7]=$clasificacion[$rw[7]];
$rw[19]=$tipopago[$rw[19]];
$rw[6]=str_replace("&"," ", $rw[6]);
$rw[14]=str_replace("&"," ", $rw[14]);

echo "<tr bgcolor='#FFFFFF' >
          <td>CC / Nit:</td><td >$rw[1]</td>
		  <td>Nombre Del Cliente:</td><td >$rw[2]</td>
          <td>Tel&eacute;fonos:</td><td >$rw[3]</td>
          
     </tr>";
	 		$sel="SELECT ciu_nombre FROM ciudades where idciudades=$rw[8]";
		$DB->Execute($sel);		
		$idciudad=$DB->recogedato(0);	
	 
echo "<tr bgcolor='#F3F3F3' >
		  <td>Email:</td><td >$rw[4]</td>
          <td>Ciudad :</td><td >$idciudad</td>
          <td>Direccion:</td><td >$rw[6]</td>     
     </tr>";
echo "<tr bgcolor='#FFFFFF' >
          <td colspan='2'>Clasificaci&oacute;n:</td><td colspan='4'>$rw[7]</td>
     </tr>";

$FB->titulo_azul1("Datos Destinatario",10,0, 5);  


$rw[15]=utf8_encode($rw[15]);
echo "<tr bgcolor='#FFFFFF' >
          <td>Nombre Destinatario:</td><td >$rw[11]</td>
		  <td>Tel&eacute;fono:</td><td >$rw[12]</td>
          <td>Ciudad Destino:</td><td >$rw[5]</td>
          
     </tr>";
echo "<tr bgcolor='#F3F3F3' >
		  <td>Direccion del Contacto:</td><td >$rw[14]</td>
            <td>Hora Recogida:</td><td >$rw[18]</td>
          <td></td><td ></td>  
     </tr>";
	 
	 $FB->titulo_azul1("Servicio",10,0, 5); 
	 if($rw[39]==1){ $rw[39]='SI'; }else{ $rw[39]='NO'; }
	 
 echo "<tr bgcolor='#FFFFFF' >
	  <td># Guia/Pre Guia:</td><td >$rw[23] / $rw[28]</td>
	  
	  <td>Devolver Recibido:</td><td> $rw[39]</td>
	  <td>Tipo de paquete:</td><td >$rw[15]</td>
	       
 </tr>";
	 
echo "<tr bgcolor='#F3F3F3' >
		<td>Piezas:</td><td >$rw[16]</td> 
        <td>Dice contener:</td><td >$rw[17]</td>
         <td>Tipo Pago:</td><td >$rw[19]</td>
     </tr>";

	  

$planillas=explode("/",$rw[23]);	


	
		$sql2="SELECT idusuarios,usu_nombre FROM usuarios where idusuarios in ($rw[24],$rw[25],$rw[26])";
		$DB->Execute($sql2);
		while($rw2=mysqli_fetch_row($DB->Consulta_ID))
		{
			$dato[$rw2[0]]=$rw2[1];
		}

//	echo $rw[23];
$rw[20]=str_replace(".","", $rw[20]);
	echo "<tr bgcolor='#F3F3F3' >
          <td>Peso:</td><td >$rw[27]</td>
          <td>Volumen:</td><td > $rw[40]</td>
		  <td>Valor de Prestamo:</td><td>$ $rw[20]</td>
     </tr>";
		
	 	$sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$rw[20]' and `pre_final`>='$rw[20]'";
		$DB->Execute($sql);
		$porprestamo=$DB->recogedato(0);
		$dosporcentaje=explode(" ",$porprestamo); 
		if(@$dosporcentaje[1]=='%'){
			
			$porprestamo=($rw[20]*@$dosporcentaje[0])/100;
		}
		$rw[21]=str_replace(".","", $rw[21]);
		$seguro=(intval($rw[21])*1)/100;
		$rw[21]=number_format($rw[21],0,".",".");
	 echo "<tr bgcolor='#FFFFFF' >
		  
		  <td>Cobro x Prestamo:</td><td>$ $porprestamo</td>
		<td>Abono:</td><td>$ $rw[22]</td>
		<td>Valor Asegurado:</td><td >$ $rw[21]</td>
      </tr>";
	  $rw[9]=number_format($rw[9],0,".",".");
		
		$seguro=number_format($seguro,0,".",".");
		$rw[30]=number_format($rw[30],0,".",".");
		
		$sql="SELECT sum(abo_valor) FROM `abonosguias` WHERE `abo_idservicio`='$id_param' and `abo_estado`='devolucion'";
		$DB->Execute($sql);
		$devoluciong=$DB->recogedato(0);

	echo "<tr bgcolor='#F3F3F3' >
	 
		   <td>Valor Seguro:</td><td>$ $seguro</td>
		  <td>Vr Flete:</td><td>$ $rw[30]</td>
		  <td>Devoluciones:</td><td>$ $devoluciong</td>
     </tr>";
	 
$FB->titulo_azul1("Seguimito Guia",10,0, 5); 


  $sql="SELECT `idguias`,`gui_usucreado`, `gui_fechacreacion`, `gui_usuvalida`, `gui_fechavalidacion`, `gui_usurecogida`, `gui_fecharecogida`, 
`gui_usupeso`, `gui_fechapeso`, `gui_usuvalpeso`, `gui_fechavalpeso`, `gui_ensede`, `gui_fechaensede`, `gui_validasede`, `gui_fechavalidasede`,
 `gui_encomienda`, `gui_fechaencomienda`,`gui_userecomienda`, `gui_fechaentrega`,`gui_recogio`, `gui_fecharecogio`, `gui_useredita`, `gui_fechaedita`,`gui_userdevolucion`,`gui_fechadevolucion` 
 
 FROM `guias` WHERE  `gui_idservicio`=$id_param";
$DB->Execute($sql);
$rw2=mysqli_fetch_array($DB->Consulta_ID);	
	 
echo "<tr bgcolor='#F3F3F3' >
		 <td>Creada Por:</td><td >".$rw2[1]."</td>
		 <td>Fecha:</td><td >".$rw2[2]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Validada Por:</td><td >".$rw2[3]."</td>
		 <td>Fecha:</td><td >".$rw2[4]."</td>
		 <td></td><td ></td>  
      </tr>";
	  
echo "<tr bgcolor='#F3F3F3' >
		 <td>Asigno Recogida:</td><td >".$rw2[5]."</td>
		 <td>Fecha:</td><td >".$rw2[6]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Pesada Por:</td><td >".$rw2[7]."</td>
		 <td>Fecha:</td><td >".$rw2[8]."</td>
		 <td></td><td ></td>  
      </tr>";	

echo "<tr bgcolor='#F3F3F3' >
		 <td>Peso validado Por:</td><td >".$rw2[9]."</td>
		 <td>Fecha:</td><td >".$rw2[10]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Asigno otra sede:</td><td >".$rw2[11]."</td>
		 <td>Fecha:</td><td >".$rw2[12]."</td>
		 <td></td><td ></td>  
      </tr>";		  

echo "<tr bgcolor='#F3F3F3' >
		 <td>Valido llegada sede:</td><td >".$rw2[13]."</td>
		 <td>Fecha:</td><td >".$rw2[14]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Asigno Operario:</td><td >".$rw2[15]."</td>
		 <td>Fecha:</td><td >".$rw2[16]."</td>
		 <td></td><td ></td>  
      </tr>";
	  

	  
	  echo "<tr bgcolor='#F3F3F3' >
		 <td>Edito Información:</td><td >".$rw2[21]."</td>
		 <td>Fecha:</td><td >".$rw2[22]."</td>
		 <td></td><td ></td>  
      </tr>";		  

echo "<tr bgcolor='#FFFFFF' >
		 <td>Recogio Paquete:</td><td >".$rw2[19]."</td>
		 <td>Fecha:</td><td >".$rw2[20]."</td>
		 <td></td><td ></td>  
      </tr>";	
		
		if($rw[38]==11){
			echo "<tr bgcolor='#F3F3F3' >
			<td>Guia Devuelta:</td><td >".$rw2[17]."</td>
			<td>Fecha:</td><td >".$rw2[18]."</td>
			<td></td><td ></td>  
			 </tr>";

		}	else {
	  echo "<tr bgcolor='#F3F3F3' >
		 <td>Entrego Encomienda:</td><td >".$rw2[17]."</td>
		 <td>Fecha:</td><td >".$rw2[18]."</td>
		 <td></td><td ></td>  
			</tr>";
		
		}	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Recibio Devolucion:</td><td >".$rw2[23]."</td>
		 <td>Fecha:</td><td >".$rw2[24]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	 $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

}
else if($tabla=="Peso"){ 
$sql="SELECT `ser_peso`,`ser_valor`,`ser_pendientecobrar`,`ser_clasificacion`,ser_volumen,ser_guiare,ser_descripcion,ser_ciudadentrega FROM `servicios` WHERE `idservicios`=$id_param";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	
$clasificacion=0;
if($rw[3]==1 and $rw[2]==0){

$clasificacion=1;
}else if($rw[3]==2){
		$clasificacion=2;
}
if($nivel_acceso!=1){ 
	if($rw[0]!=''){ $valor="min=$rw[0]";  } else { $valor=""; }
	if($rw[4]!=''){ $valor2="min=$rw[4]";  } else { $valor2=""; }

}else {
	$valor="";
	$valor2="";
}	

$FB->llena_texto("PESO KG:",1,123, $DB, "", "$valor",$rw[0] ,1,1);	
$FB->llena_texto("VOLUMEN:",4,125, $DB, "", "$valor2",$rw[4],1, 0);	
$FB->llena_texto("# GUIA:",6,1, $DB, "", "","$rw[5]" ,1, 0);	
$FB->llena_texto("ESTADO PAQUETE:",2,9, $DB, "", "","$rw[6]" ,1, 2);		
	

$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("clasificacion", 1, 13, $DB, "", "", $clasificacion, 5, 0);
$FB->llena_texto("caso", 1, 13, $DB, "", "", 1, 5, 0);
$FB->llena_texto("param5", 1, 13, $DB, "", "", $id_param2, 5, 0);
$FB->llena_texto("param16", 1, 13, $DB, "", "", $rw[7], 5, 0);
}

else if($tabla=="validapeso"){ 
$sql="SELECT `ser_peso`,`ser_valor`,`ser_pendientecobrar`,`ser_clasificacion`,ser_volumen,ser_descripcion,ser_guiare,ser_ciudadentrega FROM `servicios` WHERE `idservicios`=$id_param";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	
if($nivel_acceso!=1){ 
	if($rw[0]!=''){ $valor="min=$rw[0]";  } else { $valor=""; }
	if($rw[4]!=''){ $valor2="min=$rw[4]";  } else { $valor2=""; }

}else {
	$valor="";
	$valor2="";
}

$FB->llena_texto("PESO KG:",1,123, $DB, "", "$valor",$rw[0] ,1,1);	
$FB->llena_texto("VOLUMEN:",4,125, $DB, "", "$valor2",$rw[4],1, 0);	
$FB->llena_texto("ESTADO PAQUETE:",2,9, $DB, "", "",$rw[5] ,1, 0);	
$FB->llena_texto("# GUIA:",6,1, $DB, "", "",$rw[6],1, 0);		
$FB->llena_texto("VERIFICADO:",3, 5, $DB, "", "", "", 1, 1);

if($rw[3]==1 and $rw[2]==0){
	$clasificacion=1;
} else if($rw[3]==2){
	$clasificacion=2;
}else {
	$clasificacion=0;
}

$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("clasificacion", 1, 13, $DB, "", "", $clasificacion, 5, 0);
$FB->llena_texto("caso", 1, 13, $DB, "", "", 2, 5, 0);
$FB->llena_texto("param5", 1, 13, $DB, "", "", $id_param2, 5, 0);
$FB->llena_texto("param16", 1, 13, $DB, "", "", $rw[7], 5, 0);
}
else if($tabla=="descargaoficina"){ 
	$sql="SELECT `ser_peso`,`ser_valor`,`ser_pendientecobrar`,`ser_clasificacion`,ser_volumen,ser_descripcion,ser_guiare,ser_ciudadentrega,ser_destinatario,ser_direccioncontacto,cli_idciudad,ser_idservicio FROM `servicios`
	inner join rel_sercli  on idservicios=ser_idservicio  inner join clientesservicios on idclientesdir=ser_idclientes
	 WHERE `ser_guiare`='$id_param'";
	$DB->Execute($sql);
	$rw=mysqli_fetch_array($DB->Consulta_ID);	
	if($nivel_acceso!=1){ 
		if($rw[0]!=''){ $valor="min=$rw[0]";  } else { $valor=""; }
		if($rw[4]!=''){ $valor2="min=$rw[4]";  } else { $valor2=""; }
	
	}else {
		$valor="";
		$valor2="";
	}
	$rw[9]=str_replace("&"," ", $rw[9]);
	$FB->llena_texto("CIUDAD:",17,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where idciudades=$rw[7])", "", "$rw[7]", 1, 0);
	$FB->llena_texto("DESTINATARIO:",18, 1, $DB, "", "","$rw[8]", 4,0);
	$FB->llena_texto("DIRECCION:",19, 1, $DB, "", "","$rw[9]", 4,0);
	$FB->llena_texto("PESO KG:",1,123, $DB, "", "$valor",$rw[0] ,1, 'min=1');	
	$FB->llena_texto("VOLUMEN:",4,125, $DB, "", "$valor2",$rw[4],1, 0);	
	$FB->llena_texto("ESTADO PAQUETE:",12,82, $DB, $estadopaquete, "",@$rw[5], 1, 1);
	$FB->llena_texto("# GUIA:",6,1, $DB, "", "",$rw[6],1, 0);		
	
	if($rw[3]==1 and $rw[2]==0){
		$clasificacion=1;
	} else if($rw[3]==2){
		$clasificacion=2;
	}else {
		$clasificacion=0;
	}
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $rw[11], 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $rw[11], 5, 0);
	$FB->llena_texto("clasificacion", 1, 13, $DB, "", "", $clasificacion, 5, 0);
	$FB->llena_texto("caso", 1, 13, $DB, "", "", 2, 5, 0);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", $rw[10], 5, 0);
	$FB->llena_texto("param3", 1, 13, $DB, "", "", 1, 5, 0);
	$FB->llena_texto("param16", 1, 13, $DB, "", "", $rw[7], 5, 0);
	}
else if($tabla=="Usuarios-Roles"){ 
$FB->abre_form("form1","nuevo_adminok.php","post");
$slqs="SELECT usu_nombre FROM usuarios WHERE usu_mail='$id_param' ";
$DB1->Execute($slqs); 
$eventos=$DB1->recogedato(0);
?>
<div class="modal-body"><div class="form-group">
<div class="input-group"><h4><?php echo utf8_encode($eventos); ?></h4></div>
<?php 
$sql="SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre ";
$DB->Execute($sql); echo "<table width='100%' class='Intabla'><tr>"; $va=0;
while($rw1=mysqli_fetch_row($DB->Consulta_ID)){ 
	if($va==5){ $va=0; echo "</tr><tr>"; } $va++;
	$slqs="SELECT COUNT(*) FROM usuarios WHERE usu_mail='$id_param' AND roles_idroles='$rw1[0]'";
	$DB1->Execute($slqs); 
	if($DB1->recogedato(0)>0){ $conss1="checked"; } else { $conss1=""; } 
	echo "<td width='2%'><input type='checkbox' id='roles' name='roles[]' style='width:35px;' value='$rw1[0]' $conss1></td><td width='18%'>".utf8_encode($rw1[1])."</td>";
} 
echo "</table>";
?>
</div>
<?php 
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

}else if ($tabla=="Descargar reporte") {
$FB->llena_texto("Desde:", 105, 10, $DB, "", "", "$fecharegistro", 4, 0);
$FB->llena_texto("Hasta:", 105, 10, $DB, "", "", "$fecharegistro", 4, 0);
	
} 

$FB->llena_texto("tabla", 1, 13, $DB, "", "", $tabla, 5, 0);
$FB->llena_texto("dir", 1, 13, $DB, "", "", $dir, 5, 0);


$FB->cierra_form(); 
$DB->cerrarconsulta(); 
?>