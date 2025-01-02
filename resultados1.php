<?php
require("login_autentica.php");
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$rol_nombre=$_SESSION['rol_nombre'];
$id_ciudad=$_SESSION['usu_idsede'];
$id_sedes=$_SESSION['usu_idsede'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;

if(isset($_REQUEST["param1"])) {$param1=$_REQUEST["param1"]; } else { $param1=""; } 
if(isset($_REQUEST["cond"])) {$cond=$_REQUEST["cond"]; } else { $cond=""; } 
if(isset($_REQUEST["para"])) {$para=$_REQUEST["para"]; } else { $para=""; } 
if(isset($_REQUEST["nombre"])) {$nombre=$_REQUEST["nombre"]; } else { $nombre=""; } 

if($cond==1) {

	if($_REQUEST["param1"]!=""){ $param1=$_REQUEST["param1"]; $cond1=" WHERE paises_idpaises='$param1'"; } else { $cond1="";} 

	$sql="SELECT iddepartamentos, dep_nombre FROM departamentos $cond1 ORDER BY dep_nombre "; 
	$nome=explode("-",$nombre);
	$nome1=$nome[0];
	if(isset($nome[1])){ $nome2=$nome[1]; } else { $nome2=$nome1; }  
    echo "<select name='$nome1' id='$nome1' required  ";
	$nombre=str_replace("dep-","",$nome1);
	echo " onChange='cambio_ajax2(this.value, 2, \"llega_sub2\", \"$nome2\", 2, 0);' class='form-control' >";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1, $para, $DB);
	echo "</select>";
}

else if($cond==2) {

	if($_REQUEST["param1"]!=""){ $param1=$_REQUEST["param1"]; $cond1=" departamentos_iddepartamentos='$param1'"; } else {$cond1="";} 
	$sql="SELECT idciudades, ciu_nombre FROM ciudades WHERE $cond1 ORDER BY ciu_nombre ";
    echo "<select name='$nombre' id='$nombre' class='form-control'>";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1, $para, $DB);
	echo "</select>";

}else if($cond==21) {

	if($_REQUEST["param1"]!=""){ $param1=$_REQUEST["param1"]; $cond1=" inner_clasificacion_gastos='$param1'"; } else {$cond1="";} 
	 $sql="SELECT `idtipo_gastos`, `tipo_nombre` FROM `tipo_gastos` WHERE  $cond1 ORDER BY tipo_nombre ";
    echo "<select name='$nombre' id='$nombre' class='form-control'>";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1, $para, $DB);
	echo "</select>";

}else if($cond==22) {

	$cond1="idtipo_gastos>=1";
	$sql="SELECT `idtipo_gastos`, `tipo_nombre` FROM `tipo_gastos` WHERE  $cond1 ORDER BY tipo_nombre ";
    echo "<select name='$nombre' id='$nombre' class='form-control'>";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1, $para, $DB);
	echo "</select>";

}

else if($cond==200) {

	if($_REQUEST["param1"]!=""){ $param1=$_REQUEST["param1"]; $cond1=" departamentos_iddepartamentos='$param1'"; } else {$cond1="";} 

	$sql="SELECT idciudades, ciu_nombre FROM ciudades WHERE $cond1 ORDER BY ciu_nombre ";
    echo "<select name='$nombre' id='$nombre' class='form-control' onChange='llena_datos();'>";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1, $para, $DB);

	echo "</select>";

}

else if($cond==31) {

	if($_REQUEST["param1"]!=""){ $param1=$_REQUEST["param1"]; $cond1=" idciudades IN 
	(SELECT usu_idsede FROM secretarias WHERE idsecretarias='$param1' )"; } else {$cond1="";} 
	$sql="SELECT idciudades, ciu_nombre FROM ciudades WHERE $cond1 ORDER BY ciu_nombre ";
    echo "<select name='$nombre' id='$nombre' class='form-control' onChange='llena_datos(0, 0, \"ied_nombre\", \"ASC\");'>";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1, $para, $DB);
	echo "</select>";
}

else if($cond==335) {

	for($i=0; $i<$param1; $i++){

		$k=$i+1;

		$FB->llena_texto("Fecha visita d&iacute;a $k:", "1-$k", 101, $DB, $horasde, "", "", 2, 0);

	}

}

else if($cond==336) {

	if($_REQUEST["param1"]!=""){ $param1=$_REQUEST["param1"]; $condc=" WHERE departamentos_iddepartamentos='$param1' "; } else {$cond1="";} 

	$sql1="SELECT DISTINCT(idciudades), ciu_nombre FROM ciudades $condc ORDER BY ciu_nombre ";
    echo "<select name='$nombre' id='$nombre' class='form-control' onchange='cambio_ajax2(this.value, 333, \"llega_sub2\", \"param2\", 1, \"$para\");' required>";
	echo "<option  value=''>Seleccione... </option>"; 
	$LT->llenaselect_ajax($sql1,0,1, $para, $DB);
	echo "</select>";

}

else if($cond==5) {

	if($_REQUEST["param1"]!=""){ $param1=$_REQUEST["param1"]; $cond1=" AND men_predecesor='$param1'"; } else {$cond1="";} 

	$sql="SELECT idmenu, men_nombre, men_predecesor FROM menu WHERE idmenu!=0 $cond1 ORDER BY men_predecesor, men_orden, men_nombre ";
    echo "<select name='$nombre' id='$nombre' class='form-control'>";
	echo "<option  value=''>Seleccione... </option>";
	$DB->Execute($sql);  

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))

	{

		$sql1="SELECT men_nombre FROM menu WHERE idmenu='$rw1[2]' ";
		$DB1->Execute($sql1);  
		$pred=$DB1->recogedato(0);  
		$vals=$rw1[1];
		if($pred!=""){ $vals=$pred." - ".$rw1[1]; } 
		echo "<option value='$rw1[0]'>".utf8_encode($vals)."</option>";

	}

	echo "</select>";

}else if($cond==8) {

	$param1=$_REQUEST["param1"]; 
	
	if($param1!='Oficina'){ $cond1=" and `usu_tipovehiculo`='$param1'"; } else { $cond1=" and roles_idroles!=3"; }
	 $sql="SELECT `idusuarios`,`usu_nombre` FROM `usuarios`  WHERE   (usu_estado=1 or usu_filtro=1) and usu_idsede=$para $cond1 ";
    echo "<select name='$nombre' id='$nombre' class='form-control' onChange='llena_datos();'>";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1,$para,$DB);
	echo "</select>";
}
else if($cond==9) {

	$param1=$_REQUEST["param1"]; 
/* 	$sql2="SELECT `inner_sedes` FROM ciudades where inner_sedes='$para'";
	$DB->Execute($sql2);
	$para2=$DB->recogedato(0); */
	
	if($param1!='Oficina'){ $cond1=" and `usu_tipovehiculo`='$param1'"; } else { $cond1=" and roles_idroles!=3"; }
	 $sql="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` inner join ciudades on inner_sedes=usu_idsede WHERE `roles_idroles` in (2,3,5) and  (usu_estado=1 or usu_filtro=1) and idciudades=$para $cond1 ";
    echo "<select name='$nombre' id='$nombre' class='form-control' onChange='llena_datos();'>";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1,$para,$DB);
	echo "</select>";
}
else if($cond==10) {
	echo "<table width='100%'>"; $va=0;
	$sql2="SELECT `idciudad`, `idconsecutivo`, `idresolucion`,prefijo FROM `conf_fac` where idciudad='$param1'";
	$DB->Execute($sql2); 
	$rw=mysqli_fetch_row($DB->Consulta_ID); 
	$valor=0;
	if($rw[0]==''){ $valor=0; } else{ $valor=2; }
	$FB->llena_texto("Resolucion :", 2, 1, $DB, "", "",$rw[2], 17,0);
	$FB->llena_texto("Prefijo Consecutivo :", 4, 1, $DB, "","", $rw[3], 1,0);
	$FB->llena_texto("Consecutivo:", 3, 1, $DB, "","", $rw[1], 1,0);
	$FB->llena_texto("param", 4, 13, $DB, "", "", $valor, 5, 0);
	echo "</table>";

}



else if($cond==12){

	$hora=date("H:m");
	$sql="SELECT `ser_paquetedescripcion`,`ser_valorprestamo`,`ser_valorabono`,`ser_valorseguro`,ser_clasificacion,ser_ciudadentrega,ser_devolverreci,`ser_piezas`,ser_peso,ser_valor,cli_idciudad,ser_idusuarioguia FROM  serviciosdia WHERE idservicios=$para";
	$DB1->Execute($sql);
	$rw=mysqli_fetch_row($DB1->Consulta_ID);  

	if($param1=='ENTREGADO'){

		if($rw[1]==''){ $rw[1]=0; }
		@$rw[4]=$tipopago[$rw[4]];
		if($rw[6]==1){ $rw[6]='SI'; }else{ $rw[6]='NO'; }
		$FB->titulo_azul1("Datos ",14,0, 5);  
		if($nivel_acceso==1){
			$FB->llena_texto("Fecha Entrega:", 28, 10, $DB, "", "", $fechaactual, 1,0);
		}
		$FB->llena_texto("Numero de piezas:",2, 1, $DB, "", "", $rw[7], 17, 2);
		$FB->llena_texto("Dice contener:",3, 1, $DB, "", "", $rw[0].",", 1, 2);
		echo "<tr bgcolor='#EFEFEF' ><td>Devolver Recibido: </td> <td>$rw[6]</td></tr><tr bgcolor='#EFEFEF' ><td>Tipo Pago: </td> <td>$rw[4]</td></tr>"; 
		$FB->llena_texto("Peso:",7, 119, $DB, "", "", $rw[8], 1, 2);
		$FB->llena_texto("Vr Declarado:",6, 118, $DB, "", "", $rw[3], 1, 2);
	
		$rw[3]=str_replace(".","", $rw[3]);
		$rw[1]=str_replace(".","", $rw[1]);
		$seguro=(intval($rw[3])*1)/100;
	
		$sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$rw[1]' and `pre_final`>='$rw[1]'";
		$DB->Execute($sql);
		$porprestamo=$DB->recogedato(0);
		$dosporcentaje=explode(" ",$porprestamo); 
		if(@$dosporcentaje[1]=='%'){
			
			$porprestamo=($rw[1]*@$dosporcentaje[0])/100;
		}

		$totalprestamo=$rw[1]+$porprestamo;
		$totalflete=$rw[9]+$seguro;

		$porprestamo=number_format($porprestamo,0,".",".");
		$rw[1]=number_format($rw[1],0,".",".");
		$rw[9]=number_format($rw[9],0,".",".");
		$seguro=number_format($seguro,0,".",".");

		$FB->titulo_azul1("TOTALES ",8,0,5);  
		$FB->llena_texto("Valor de Prestamo:",4, 118, $DB, "", "", $rw[1], 1, 2);
		$FB->llena_texto("% Vr Declarado:",5, 118, $DB, "", "", $seguro, 17, 2);
		$FB->llena_texto("Cobro x Prestamo:",6, 118, $DB, "", "", $porprestamo, 1, 2);
		$FB->llena_texto("Vr Flete:",7, 118, $DB, "", "", $rw[9], 17, 2);
		$FB->llena_texto("Abono:",8, 118, $DB, "", "",$rw[2], 1, 2);
		echo "<tr bgcolor='#EFEFEF' ><td> </td> <td>______________________</td></tr>"; 

		$rw[2]=str_replace(".","", $rw[2]);
		$totalprestamo=$totalprestamo-$rw[2];

		$totalfinal=$totalflete+$totalprestamo;
		$devolucion=$totalfinal* -1;
		$totalflete=number_format($totalflete,0,".",".");
		$totalprestamo=number_format($totalprestamo,0,".",".");
		$totalfinal=number_format($totalfinal,0,".",".");
		$devolucion=number_format($devolucion,0,".",".");

		$FB->llena_texto("TOTAL PRESTAMO:",8, 118, $DB, "", "", $totalprestamo, 1, 2);
		$FB->llena_texto("TOTAL FLETE:",9, 118, $DB, "", "", $totalflete, 17, 2);
		$FB->llena_texto("TOTAL:",8, 118, $DB, "", "", $totalfinal, 1, 2);
		if($totalfinal<1){
			$FB->llena_texto("DEVOLUCION:",8, 118, $DB, "", "", $devolucion, 1, 2);
		}
	

		$FB->llena_texto("param9", 4, 13, $DB, "", "", $rw[5], 5,2);
		$FB->llena_texto("param10", 4, 13, $DB, "", "", $rw[4], 5,2);
		$FB->llena_texto("iduserentrega", 4, 13, $DB, "", "", $rw[11], 5,2);
		$FB->llena_texto("param19", 4, 13, $DB, "", "", $devolucion, 5,2);
		$FB->cierra_tabla();

	}else if($param1=='NO ENTREGADO'){
		
		$FB->llena_texto("MOTIVO :",2,9, $DB, "", "",@$rw1[11] ,1, 0);

	}

}



else if($cond==11){

	 $hora=date("H:m");


	if($param1=='RECOGIDO'){
		
		 $sql="SELECT `ser_paquetedescripcion`,`ser_valorprestamo`,`ser_valorabono`,`ser_valorseguro`,ser_clasificacion,ser_ciudadentrega,ser_devolverreci,cli_idciudad,ser_prioridad,ser_idresponsable,ser_tipopaq,ser_volumen,ser_verificado,ser_piezas,ser_guiare,ser_consecutivo 
		FROM  servicios inner join rel_sercli  on idservicios=ser_idservicio  inner join clientesservicios on idclientesdir=ser_idclientes WHERE idservicios=$para";
			$DB1->Execute($sql);
			$rw=mysqli_fetch_row($DB1->Consulta_ID);  

		//$rw[4]=$clasificacion[$rw[4]];
		$FB->titulo_azul1("Datos ",14,0, 5); 
		if($nivel_acceso==1){
			$FB->llena_texto("Fecha Recogida:", 28, 10, $DB, "", "", $fechaactual, 1,0);
		}
		
		$FB->llena_texto("Servicio:",17, 1, $DB, "", "", $rw[8], 1, 1);
		

		if($rw[13]==0){$rw[13]=''; }
		$FB->llena_texto("Numero de piezas:",2, 123, $DB, "", "", "$rw[13]", 1, 'min=1');
		$FB->llena_texto("&iquest;Verificado?:",19, 214, $DB, "", "",$rw[12], 1, 1);	

		$FB->llena_texto("Tipo:",21,2, $DB, "(SELECT `tip_nombre`,`tip_nombre` FROM `tipo`)", "", $rw[10], 17, 1);
		$FB->llena_texto("Dice contener:",3, 1, $DB, "", "", $rw[0].",", 1, 0);
		$FB->llena_texto("Valor de Prestamo:",4, 118, $DB, "", "", $rw[1], 1, 2);
		
		if(@$rw[3]==''){
			$seguro='50000';
		} else{
			$seguro=$rw[3];
		}
		$FB->llena_texto("Seguro:",6, 126, $DB, "", "50000", $seguro, 17, 1);

		$FB->llena_texto("Hora Recogida:",7, 122, $DB, "", "","$hora", 17, 0);
		$FB->llena_texto("Devolver Recibido:",29, 5, $DB, "3", "", $rw[6], 1, 1);
		$FB->llena_texto("# GUIA :",25,1, $DB, "", "","$rw[14]" ,17, 0);	
		$FB->llena_texto("ESTADO PAQUETE:",26,9, $DB, "", "","" ,17, 1);
		if($nivel_acceso==3){
			$FB->llena_texto("Abono:",14, 118, $DB, "", "", $rw[2], 1, 2);
		}else {

			$FB->llena_texto("Abono:",14, 118, $DB, "", "", $rw[2], 1, 0);
		}
		
		if($rw[8]=='Compra'){
		$FB->llena_texto("Pendiente Cancelar:",17, 118, $DB, "", "", "0", 1, 0);
		}else
		{
			$FB->llena_texto("param17", 4, 13, $DB, "", "", 0, 5, 0);
		}
		$tipofiltro=217;
		if($nivel_acceso==3){
			 $sqls1="SELECT idelementostrabajo FROM `elementostrabajo` inner join hojadevida on idhojadevida=ele_idhojavida inner join usuarios on hoj_cedula=usu_identificacion 
			where ele_nombre like '%datafono%' and idusuarios='$id_usuario' ";
			$DB->Execute($sqls1);
			 $iddatafono=$DB->recogedato(0);
			($iddatafono>=1)?$tipofiltro=217:$tipofiltro=213;
			//echo $iddatafono;

		}


		if($rw[4]!=2){
			$FB->llena_texto("Tipo Pago:", 8, $tipofiltro, $DB, "3", "cambio_ajax2(this.value,13,\"llega_sub2\",\"$param1\",1,$para)","",1, 1);

		}else{
			$FB->llena_texto("param8", 4, 13, $DB, "", "", "2", 5, 0);
		}

		//echo "<td>Clasificacion: </td> <td>$rw[4]</td>"; 
		$FB->llena_texto("param9", 4, 13, $DB, "", "", $rw[5], 5, 0);
		$FB->cierra_tabla();
		$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);
		$FB->llena_texto("param13", 4, 13, $DB, "", "", $rw[7], 5, 0);
		if($nivel_acceso==3){
			$FB->llena_texto("param14", 4, 13, $DB, "", "", $rw[2], 5, 0);
		}
		//
		$FB->llena_texto("param15", 4, 13, $DB, "", "", $rw[8], 5, 0);
		$FB->llena_texto("param16", 4, 13, $DB, "", "", $rw[1], 5, 0);
		$FB->llena_texto("param18", 4, 13, $DB, "", "", $rw[9], 5, 0);
		$FB->llena_texto("param27", 4, 13, $DB, "", "", $rw[15], 5, 0);

		}else if($param1=='NO RECOGIDO'){
	
		$FB->llena_texto("MOTIVO :",2,9, $DB, "", "",@$rw1[11] ,1, 0);
	
	}else if($param1=='EDITAR DATOS'){

		 $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `cli_clasificacion`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir FROM 
			serviciosdia  where idservicios=$para";
			$DB1->Execute($sql);
			$rw=mysqli_fetch_array($DB1->Consulta_ID);
			
			@$param4=$rw[4];
			if($nivel_acceso!=1){  $cond6=" WHERE inner_sedes='$id_sedes'"; }  else { $cond6=""; }
			
			$FB->titulo_azul1("Remitente",10,0, 5);  

		//$FB->llena_texto("CC / Nit:",1, 117, $DB, "", "", $rw[1], 1, 0);
		$FB->llena_texto("Tel&eacute;fonos :",2,120, $DB, "", "", $rw[2], 1, 1);
		echo  "<tr bgcolor='#FFFFFF' ><td>Remitente:</td><td colspan=1><div id='clientesdir'>";
		echo " <input name='param6' id='param6' class='trans'  type='text' value='$rw[6]' onkeypress='return noenter();'>
		</div></td>";

		$FB->llena_texto("Ciudad:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades` $cond6)", "", "$param4", 1, 1);


		@$direcc=explode("&",$rw[5]);
		@$param5=$direcc[0];
		@$param51=$direcc[1];
		@$param19=$direcc[2];
		@$param20=$direcc[3];
		@$param23=$direcc[4];
		
		echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Recogida:</td>
	<td align='left' ><select class='trans'  name='param5' id='param5' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();'>
	</td>";

	echo "</tr><tr bgcolor='#F3F3F3' ><td></td>
	<td align='left' ><select class='trans'  name='param19' id='param19' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();'>
	</td>
	
	</tr>";

		$FB->llena_texto("Barrio:", 23, 1, $DB, "", "", $param23, 1, 0);	
		$FB->llena_texto("Email:", 3, 111, $DB, "", "", $rw[3], 17	, 0);	
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

	echo $rw[19];
	$FB->llena_texto("id_param0", 1, 13, $DB, "", "", "$rw[21]", 5, 0); //idclientes
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "$rw[19]", 5, 0);  // idservicio
	
	}
}
else if($cond==13){

if($param1==1){

	//cambio_ajax2(this.value, 65, \"inactivo$nombre\", \"$nombre\", 1, $para)
	$FB->titulo_azul1("De Contado ",8,0,5);  
	$FB->llena_texto("Peso:",10, 119, $DB, "", "", $rw[7], 1, 0);
	$FB->llena_texto("Volumen:",20, 119, $DB, "", "", $rw[11], 17, 0);
	//$FB->llena_texto("Valor:",11, 118, $DB, "", "", $rw[8], 6, 0);
	$FB->llena_texto("Pendiente por Cobrar:",12, 5, $DB, "", "", $rw[9], 1, 1);
}elseif($param1==2){

	//$FB->titulo_azul1("Credito	",8,0,5);  
	//$FB->llena_texto("Cliente:",113,2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "", "", 1, 1);
	//$FB->llena_texto("Valor del Flete:",10, 118, $DB, "", "", "", 1, 0);

}elseif($param1==3){

	$FB->titulo_azul1("AL Cobro  ",8,0,5);  
	//$FB->llena_texto("Devoluciones:",10, 118, $DB, "", "", $rw[7], 1, 0);
	
}elseif($param1==4){

		$FB->titulo_azul1("Datafono ",8,0,5);  
		$FB->llena_texto("Peso:",10, 119, $DB, "", "", $rw[7], 1, 0);
		$FB->llena_texto("Volumen:",20, 119, $DB, "", "", $rw[11], 17, 0);
	//	$FB->llena_texto("Foto Del comprobate de Pago:", 110, 6, $DB, "", "", "",4, 0);

	}

}else if($cond==24){

	if($param1==1){
	
		$FB->titulo_azul1("Credito	",8,0,5);  
		$FB->llena_texto("Cliente:",113,2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "", "", 1, 1);
		//$FB->llena_texto("Valor del Flete:",10, 118, $DB, "", "", "", 1, 0);
	
	}
}else if($cond==25){

 	$param1=$_REQUEST["param1"]; 
	$cond1="cli_telefono=$param1";
	 $sql="SELECT `idclientesdir`,`cli_nombre`, `cli_direccion` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  where $cond1 ";
	$DB->Execute($sql);
	$rw7=mysqli_fetch_row($DB->Consulta_ID); 
	$rw7[2]=str_replace("&"," ", $rw7[2]);
	if($rw7[0]>=0){
	
		$FB->titulo_azul1("Cliente	",8,0,5);  
		$FB->llena_texto("Nombre:",3, 1, $DB, "", "", $rw7[1], 17, 1);
		$FB->llena_texto("Direcci&oacute;n:",4, 1, $DB, "", "", $rw7[2], 17, 1);
		$FB->llena_texto("param5", 1, 13, $DB, "", "", "$rw7[0]", 5, 0);
	
	} 
}else if($cond==26){

	$param1=$_REQUEST["param1"]; 
	$param2=$_REQUEST["param2"]; 
   $cond1="$param2=$param1 and ser_estado!=100 and ser_estado!=10";
    $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_estado,'1' as tipoc
	FROM serviciosdia   where $cond1 ";
   $DB->Execute($sql);
   $rw1=mysqli_fetch_row($DB->Consulta_ID); 
   if($rw1[0]>0){
	$FB->llena_texto("Valor:",1, 118, $DB, "", "", "", 2, 1);

	$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
	$FB->titulo_azul1("#Guia",1,0,0); 
	$FB->titulo_azul1("#Relacionado",1,0,0); 
	$FB->titulo_azul1("Remitente",1,0,0); 
	$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
	$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
	$FB->titulo_azul1("Destinatario",1,0,0); 
	$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
	$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
	$FB->titulo_azul1("Ciudad",1,0,0); 
	$FB->titulo_azul1("Servicio",1,0,0); 

					$color="#EFEFEF";
					echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
					$direc1=str_replace("&"," ", $rw1[4]);
					$direct2=str_replace("&"," ", $rw1[7]);
					echo "<td>".$rw1[10]."</td>
					<td>".$rw1[11]."</td>
					<td>".$rw1[12]."</td>
					<td>".$rw1[2]."</td>
					<td>".$rw1[3]."</td>
					<td>".$direc1."</td>
					<td>".$rw1[5]."</td>
					<td>".$rw1[6]."</td>
					<td>".$direct2."</td>
					<td>".$rw1[8]."</td>
					<td>".$rw1[9]."</td>
					";
	
	   echo "</tr>"; 
   }else{
	$color="#EFEFEF";
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>Verifique que la guia no este cancelada ni que este entregada</td>";
	echo "</tr>";   
	} 
   $FB->llena_texto("param5", 1, 13, $DB, "", "", "$rw1[0]", 5, 0);
}
else if($cond==27) { 

	$param1=$_REQUEST["param1"]; 

	if($param1!='Oficina'){ $cond1=" and `usu_tipovehiculo`='$param1'"; } else { $cond1=" and roles_idroles!=3"; }

	 $sql="SELECT `idusuarios`,`usu_nombre`,zon_nombre FROM  seguimiento_user inner join zona_trabajo on seg_idzona=idzonatrabajo  inner join  `usuarios` on idusuarios=seg_idusuario inner join ciudades on inner_sedes=usu_idsede WHERE `roles_idroles` in (2,3,5) and seg_fechaalcohol='$fechaactual' and (usu_estado=1 or usu_filtro=1) and idciudades=$para and `seg_motivo`='Ingreso' $cond1 ";
//	$sql="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` inner join ciudades on inner_sedes=usu_idsede WHERE `roles_idroles` in (2,3,5) and  (usu_estado=1 or usu_filtro=1) and idciudades=$para $cond1 ";
	echo "<select name='$nombre' id='$nombre' class='form-control' onChange='llena_datos();'>";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect($sql,0,"1-2", $valor, $DB);
	echo "</select>";

}else if($cond==28) {
	$param1=$_REQUEST["param1"]; 
	echo $sql="Select ciu_pagoorigen from ciudades where idciudades=$param1";	
	exit;	
	$DB->Execute($sql);
	$rw1=mysqli_fetch_row($DB->Consulta_ID); 
	echo $rw1[0];
	if($rw1[0]=='si'){
				
		echo "<div class='alert alert-success'><strong>Atencion!</strong> HOLA </div>";			
	}
 }else if($cond==29){

	$param1=$_REQUEST["param1"]; 
	$param2=$_REQUEST["param2"]; 
   $cond1="ser_guiare=$param1 and ser_estado!=100 and ser_estado!=10";
    $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_estado,'1' as tipoc
	FROM serviciosdia   where $cond1 ";
   $DB->Execute($sql);
   $rw1=mysqli_fetch_row($DB->Consulta_ID); 
   if($rw1[0]>0){

	$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
	$FB->titulo_azul1("#Guia",1,0,0); 
	$FB->titulo_azul1("#Relacionado",1,0,0); 
	$FB->titulo_azul1("Remitente",1,0,0); 
	$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
	$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
	$FB->titulo_azul1("Destinatario",1,0,0); 
	$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
	$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
	$FB->titulo_azul1("Ciudad",1,0,0); 
	$FB->titulo_azul1("Servicio",1,0,0); 

					$color="#EFEFEF";
					echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
					$direc1=str_replace("&"," ", $rw1[4]);
					$direct2=str_replace("&"," ", $rw1[7]);
					echo "<td>".$rw1[10]."</td>
					<td>".$rw1[11]."</td>
					<td>".$rw1[12]."</td>
					<td>".$rw1[2]."</td>
					<td>".$rw1[3]."</td>
					<td>".$direc1."</td>
					<td>".$rw1[5]."</td>
					<td>".$rw1[6]."</td>
					<td>".$direct2."</td>
					<td>".$rw1[8]."</td>
					<td>".$rw1[9]."</td>
					";
	
	   echo "</tr>"; 
   }else{
	$color="#EFEFEF";
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>Verifique que la guia no este cancelada ni que este entregada</td>";
	echo "</tr>";   
	} 
   $FB->llena_texto("param10", 1, 13, $DB, "", "", "$rw1[0]", 5, 0);
}
else if($cond==14) {

	$param1=$_REQUEST["param1"]; 
	$cond1="";
	if($nombre=='telefono'){

		$cond1="cli_telefono='$param1'";
	}else if($nombre=='documento'){

		$cond1="cli_iddocumento='$param1'";
	}

	 $sql="SELECT `idclientesdir`,`cli_nombre` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  where $cond1 ";
    echo "<select class='trans'  name='param61' id='param61' class='form-control' onChange='buscar(\"param6\")'>";
	echo "<option  value=''>--Nuevo--</option>";
	$LT->llenaselect_ajax($sql,0,1,0,$DB);
	echo "</select> <input name='param6' id='param6' class='trans'  type='text' value='$para' onkeypress='return noenter();'>";
}
else if($cond==15) {
	$cond='';
	$param1=$_REQUEST["param1"]; 
/* 	if($nivel_acceso!=1 or $nivel_acceso!=5 or $nivel_acceso!=12){
		$cond=" and idusuarios='$id_usuario' ";
	} */
	
	if($param1!='0'){ $cond1="and `usu_idsede`='$param1'"; } else { $cond1="and `usu_idsede`='$id_ciudad'"; }

	 $sql="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1)  $cond1 $cond ";
    echo "<select name='$nombre' id='$nombre' class='form-control' required >";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1,$para,$DB);
	echo "</select>";
}
else if($cond==21) {

	$param1=$_REQUEST["param1"]; 
	if($param1!='0'){ $cond1="and `usu_idsede`='$param1'"; } else { $cond1="and `usu_idsede`='$id_ciudad'"; }

	 $sql="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE    (usu_estado=1 or usu_filtro=1)  $cond1 ";
    echo "<select name='$nombre' id='$nombre' class='form-control' required >";
	echo "<option  value=''>Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1,$para,$DB);
	echo "</select>";
}
else if($cond==16) {

	 $param1=$_REQUEST["param1"]; 
	if($param1!='0'){ $cond1="and `usu_idsede`='$param1'"; } 
	 $sql="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  usu_estado=1   $cond1 order by usu_nombre asc ";
    echo "<select name='$nombre' id='$nombre' class='form-control' >";
	echo "<option  value='' >Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1,$para,$DB);
	echo "</select>";
}else if($cond==100) {

	 $param1=$_REQUEST["param1"]; 
	// if($param1!='0'){ $cond1="and `usu_idsede`='$param1'"; } else { $cond1="and `usu_idsede`='$id_ciudad'"; }
	 $sql="SELECT `empre_id`,`empre_nombre` FROM `documentos_empre` WHERE  empre_carpeta = '$param1'";
    echo "<select name='$nombre' id='$nombre' class='form-control' >";
	echo "<option  value='' >Seleccione... </option>";
	$LT->llenaselect_ajax($sql,0,1,$para,$DB);
	echo "</select>";
}else if($cond==200) {

	$param1=$_REQUEST["param1"]; 
   // if($param1!='0'){ $cond1="and `usu_idsede`='$param1'"; } else { $cond1="and `usu_idsede`='$id_ciudad'"; }
// 	$sql="SELECT `empre_id`,`empre_nombre` FROM `documentos_empre` WHERE  empre_carpeta = '$param1'";
if ($param1="vacaciones") {
	echo "10";
	
}
   
//    echo "<option  value='' >Seleccione... </option>";
//    $LT->llenaselect_ajax($sql,0,1,$para,$DB);
//    echo "</select>";

}else if($cond==101) {

	$param1=$_REQUEST["param1"]; 
   // if($param1!='0'){ $cond1="and `usu_idsede`='$param1'"; } else { $cond1="and `usu_idsede`='$id_ciudad'"; }
	$sql="SELECT `idsedes`,`sed_nombre` FROM `sedes` WHERE  sed_empresa = '$param1'";
   echo "<select name='$nombre' id='$nombre' class='form-control' >";
   echo "<option  value='' >Seleccione... </option>";
   $LT->llenaselect_ajax($sql,0,1,$para,$DB);
   echo "</select>";
}
else if($cond==17) {

	$valortservicio=$_REQUEST["valortservicio"];
	$nombre=$_REQUEST["nombre"];
if($valortservicio==0 and $param1!=2){

		$sql="SELECT `idprecios`, `pre_kilo`, `pre_adicional` FROM `precios` 
		where pre_idciudadori='$param2' and pre_idciudaddes='$param3'  ";
		$DB->Execute($sql);
		$rw = mysqli_fetch_row($DB->Consulta_ID); 
		$precio=0;
		@$preciokilo=$rw[1];
		@$precioadicional=$rw[2];
		$valorapagar=0;
//@$serciudad=$param11;
}else if($valortservicio==1 and $param1!=2){ //carga especial opcion contado
	$sql33="SELECT tip_preciokilo,tip_precioadicional from tiposervicio WHERE `idtiposervicio`=1"; 
	$DB->Execute($sql33);
	$rw7=mysqli_fetch_row($DB->Consulta_ID); 
	@$preciokilo=$rw7[0];
	@$precioadicional=$rw7[1];

}else{

	$sql="SELECT `idprecios`, `pre_kilo`, `pre_adicional` FROM `precios` 
	where pre_idciudadori='$param2' and pre_idciudaddes='$param3'  ";
	$DB->Execute($sql);
   $rw = mysqli_fetch_row($DB->Consulta_ID); 
   $precio=0;
   @$preciokilo=$rw[1];
   @$precioadicional=$rw[2];
   $valorapagar=0;

}

 @$kilosvolumen=$param7+$param8;

if($kilosvolumen>3){

	@$precio1=($kilosvolumen-3)*$precioadicional;
	@$precio=$preciokilo+$precio1;

}else {

	@$precio=$preciokilo;	

}

$param4=str_replace(".","", $param4);
$param5=str_replace(".","", $param5);
$param6=str_replace(".","", $param6);

	 $sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$param4' and `pre_final`>='$param4'";
		$DB->Execute($sql);
		$porprestamo=$DB->recogedato(0);
	
		$dosporcentaje=explode(" ",$porprestamo); 

		if(@$dosporcentaje[1]=='%'){
			$porprestamo=($param4*@$dosporcentaje[0])/100;
		}

		@$pordeclarado=(intval($param6)*1)/100;

//$valorapagar=$precio
$FB->llena_texto("porprestamo", 1, 13, $DB, "", "", "$porprestamo", 5, 0);
$FB->llena_texto("pordeclarado", 1, 13, $DB, "", "", "$pordeclarado", 5, 0);
$FB->llena_texto("precio", 1, 13, $DB, "", "", "$precio", 5, 0);

if($param1==1){
		@$valorapagar=$precio+$param4-$param5+$pordeclarado+$porprestamo;
	
	$FB->titulo_azul1("",8,0,5);  
	$FB->llena_texto("Valor:",111, 118, $DB, "", "", $valorapagar, 6, 0);
	//$FB->llena_texto("Pendiente por Cobrar:",12, 5, $DB, "", "", $rw[9], 1, 1);
	$FB->llena_texto("Pendiente por Cobrar:",112, 5, $DB, "", "", "", 1, 0);

}else if($param1==2){

	@$valorapagar=$precio+$param4-$param5+$pordeclarado+$porprestamo;
	$FB->titulo_azul1("",8,0,5);  
	//$FB->llena_texto("Ingrese El Valor:",111, 118, $DB, "", "", "", 6, 0);
	//$FB->llena_texto("param111", 1, 13, $DB, "", "","", 5, 0);
	$FB->llena_texto("Cliente:",113,2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "", "", 1, 1);

	
}else if($param1==3){

	@$valorapagar=$precio+$param4-$param5+$pordeclarado+$porprestamo;

	$FB->titulo_azul1("Valor",8,0,5);  
	$FB->llena_texto("",111, 118, $DB, "", "", $valorapagar, 6, 0);
}else if($param1==4){

		@$valorapagar=$precio+$param4-$param5+$pordeclarado+$porprestamo;
	
		$FB->titulo_azul1("Valor",8,0,5);  
		$FB->llena_texto("",111, 118, $DB, "", "", $valorapagar, 6, 0);
		$FB->llena_texto("Foto Del comprobate de Pago:", 110, 6, $DB, "", "", "",4, 0);
	}		

}
else if($cond==18) {

	$param1=$_REQUEST["param1"]; 
	$cond1="";
	if($nombre=='telefono'){

		$cond1="cli_telefono='$param1'";
	}else if($nombre=='documento'){

		$cond1="cli_iddocumento='$param1'";
	}

	 $sql="SELECT `idclientesdir`,`cli_nombre` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  where $cond1 ";
    echo "<select class='trans'  name='param71' id='param71' class='form-control' onChange='buscar(\"param7\")'>";
	echo "<option  value=''>--Clientes--</option>";
	$LT->llenaselect_ajax($sql,0,1,0,$DB);
	echo "</select> <input name='param9' id='param9' class='trans'  type='text' value='$para' onkeypress='return noenter();'>";
}
else if($cond==19) {

	$param1=$_REQUEST["param1"]; 
	$cond1="";
	if($nombre=='telefono'){

		$cond1="cli_telefono='$param1'";
	}else if($nombre=='documento'){

		$cond1="cli_iddocumento='$param1'";
	}

	 $sql="SELECT `idclientesdir`,`cli_nombre` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  where $cond1 ";
    echo "<select class='trans'  name='param71' id='param71' class='form-control' onChange='buscar(\"param7\")'>";
	echo "<option  value=''>--Clientes--</option>";
	$LT->llenaselect_ajax($sql,0,1,0,$DB);
	echo "</select> <input name='param7' id='param7' class='trans'  type='text' value='$para' onkeypress='return noenter();'>";
}else if($cond==20) {


$valortservicio=$_REQUEST["valortservicio"];
$id_param=$_REQUEST["idservicio"];

if($valortservicio==0 and $param1!=2){

	$sql="SELECT `idprecios`, `pre_kilo`, `pre_adicional` FROM `precios` 
	where pre_idciudadori='$param2' and pre_idciudaddes='$param3'  ";
	$DB->Execute($sql);
   $rw = mysqli_fetch_row($DB->Consulta_ID); 
   
   @$preciokilo=$rw[1];
   @$precioadicional=$rw[2];
   //@$serciudad=$param11;
}else if($valortservicio==1 and $param1!=2){ //carga especial opcion contado
		
	 $sql33="SELECT tip_preciokilo,tip_precioadicional from tiposervicio WHERE `idtiposervicio`=1"; 
	$DB->Execute($sql33);
	$rw7=mysqli_fetch_row($DB->Consulta_ID); 
	@$preciokilo=$rw7[0];
	@$precioadicional=$rw7[1];

}else if($valortservicio!=0 and $param1==2){

 	$sqlc="SELECT rel_nom_credito,idcreditos FROM `rel_sercre` inner join creditos on cre_nombre=rel_nom_credito where idservicio=$id_param ";
   $DB->Execute($sqlc);
   $rw21=mysqli_fetch_row($DB->Consulta_ID); 
	$creditouser=$rw21[0];
	$idcredito=$rw21[1];

   $sql3="SELECT `pre_preciokilo`,`pre_precioadicional` FROM `precios_credito` WHERE `pre_idciudadori`='$param2'  and `pre_idciudades`='$param3' and pre_tiposervicio='$valortservicio' and pre_idcredito='$idcredito' ";
   $DB->Execute($sql3);
   $rw2=mysqli_fetch_row($DB->Consulta_ID);  

   @$preciokilo=$rw2[0];
   @$precioadicional=$rw2[1];
	   
}else{
	$sql="SELECT `idprecios`, `pre_kilo`, `pre_adicional` FROM `precios` 
	where pre_idciudadori='$param2' and pre_idciudaddes='$param3'  ";
	$DB->Execute($sql);
   $rw = mysqli_fetch_row($DB->Consulta_ID); 
   
   @$preciokilo=$rw[1];
   @$precioadicional=$rw[2];
}
   
   $kilosvolumen=$param7+$param8;
   
   if($kilosvolumen>3){
   
	   @$precio1=($kilosvolumen-3)*$precioadicional;
	   @$precio=$preciokilo+$precio1;
   
   }else {
   
	   @$precio=$preciokilo;	
   
   }
   
   $param4=str_replace(".","", $param4);
   $param5=str_replace(".","", $param5);
   $param6=str_replace(".","", $param6);
   
		$sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$param4' and `pre_final`>='$param4'";
		   $DB->Execute($sql);
		   $porprestamo=$DB->recogedato(0);
	   
		   $dosporcentaje=explode(" ",$porprestamo); 
   
		   if(@$dosporcentaje[1]=='%'){
			   $porprestamo=($param4*@$dosporcentaje[0])/100;
		   }
   
		   $pordeclarado=(intval($param6)*1)/100;
   
   //$valorapagar=$precio
   $FB->llena_texto("porprestamo", 1, 13, $DB, "", "", "$porprestamo", 5, 0);
   $FB->llena_texto("pordeclarado", 1, 13, $DB, "", "", "$pordeclarado", 5, 0);
   $FB->llena_texto("precio", 1, 13, $DB, "", "", "$precio", 5, 0);
   
   if($param1==1){
		   $valorapagar=$precio+$pordeclarado;
	   
	   $FB->titulo_azul1("",8,0,5);  
	   $FB->llena_texto("Valor:",111, 118, $DB, "", "", $valorapagar, 6, 0);
	   //$FB->llena_texto("Pendiente por Cobrar:",12, 5, $DB, "", "", $rw[9], 1, 1);
	   $FB->llena_texto("Pendiente por Cobrar:",112, 5, $DB, "", "", "", 1, 2);
   
   
	   
   }else if($param1==2){
   
	   $valorapagar=$precio+$pordeclarado;
	   $FB->titulo_azul1("",8,0,5);  
	  // $FB->llena_texto("Ingrese El Valor:",111, 118, $DB, "", "", "", 6, 0);
	  //$FB->llena_texto("",111, 118, $DB, "", "", 0, 6, 0);
	  $FB->llena_texto("Cliente:",113,2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "", "", 1, 1);
	   
   }else if($param1==3){
   
		$valorapagar=$precio+$pordeclarado;
   
	   $FB->titulo_azul1("Valor",8,0,5);  
	   $FB->llena_texto("",111, 118, $DB, "", "", $valorapagar, 6, 0);
	   }	
   }
   else if($cond==23) {

	$valortservicio=$_REQUEST["valortservicio"];
	$idcredito=$_REQUEST["cliente"];
	
	if($valortservicio==0 and $param1!=1){ // tipo servicio normal y no credito
	
		 $sql="SELECT `idprecios`, `pre_kilo`, `pre_adicional` FROM `precios` 
		where pre_idciudadori='$param2' and pre_idciudaddes='$param3'  ";
		$DB->Execute($sql);
	   $rw = mysqli_fetch_row($DB->Consulta_ID); 
	   
	   @$preciokilo=$rw[1];
	   @$precioadicional=$rw[2];
	   //@$serciudad=$param11;
	}else if($valortservicio==1 and $param1!=1){ //carga especial no credito 
			
		 $sql33="SELECT tip_preciokilo,tip_precioadicional from tiposervicio WHERE `idtiposervicio`=1"; 
		$DB->Execute($sql33);
		$rw7=mysqli_fetch_row($DB->Consulta_ID); 
		@$preciokilo=$rw7[0];
		@$precioadicional=$rw7[1];
	
	}else if($param1==1){ // credito diferente a tipo servicio normal
	
	
	   $sql3="SELECT `pre_preciokilo`,`pre_precioadicional` FROM `precios_credito` WHERE `pre_idciudadori`='$param2'  and `pre_idciudades`='$param3' and pre_tiposervicio='$valortservicio' and pre_idcredito='$idcredito' ";
	   $DB->Execute($sql3);
	   $rw2=mysqli_fetch_row($DB->Consulta_ID);  
	
	   @$preciokilo=$rw2[0];
	   @$precioadicional=$rw2[1];
		   
	}else{
		$sql="SELECT `idprecios`, `pre_kilo`, `pre_adicional` FROM `precios` 
		where pre_idciudadori='$param2' and pre_idciudaddes='$param3'  ";
		$DB->Execute($sql);
	   $rw = mysqli_fetch_row($DB->Consulta_ID); 
	   
	   @$preciokilo=$rw[1];
	   @$precioadicional=$rw[2];
	}	   
	   $kilosvolumen=$param7+$param8;	   
	   if($kilosvolumen>3){
		   @$precio1=($kilosvolumen-3)*$precioadicional;
		   @$precio=$preciokilo+$precio1;
	   }else {
		   @$precio=$preciokilo;	
	   }
	   
	   $param4=str_replace(".","", $param4);
	   $param5=str_replace(".","", $param5);
	   $param6=str_replace(".","", $param6);
	   
			$sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$param4' and `pre_final`>='$param4'";
			   $DB->Execute($sql);
			   $porprestamo=$DB->recogedato(0);
		   
			   $dosporcentaje=explode(" ",$porprestamo); 
	   
			   if(@$dosporcentaje[1]=='%'){
				   $porprestamo=($param4*@$dosporcentaje[0])/100;
			   }
	   
			   $pordeclarado=(intval($param6)*1)/100;
	   
	   
		$valorapagar=$precio+$pordeclarado+$porprestamo;

		echo '<table class="table table-hover"><tr bgcolor="#074F91" class="tittle3">
		<td colspan="1" align="center">Minima(3k)</td>
		<td colspan="1"  align="center">Kilo Adicional</td>
		<td colspan="1"  align="center">%Seguro</td>
		<td colspan="1"  align="center">%Prestamo</td>
		<td colspan="1" align="center">Valor</td></tr>';
		$color="#EFEFEF";
		echo "<tr bgcolor='$color' class='text' style='background-color:$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' 	
	 onmouseout='this.style.backgroundColor=\"$color\"'>";
	 echo "<td>$preciokilo</td><td>$precioadicional</td><td>$pordeclarado</td><td>$porprestamo</td><td>".$valorapagar."</td></tr></table>";


	//	$FB->llena_texto("",111, 118, $DB, "", "", $valorapagar, 6, 0);
		   
}else if($cond==63) {

	$param1=$_REQUEST["param1"]; if($param1=="Activo"){ $st=1; } else { $st=0; } 
	$sql="UPDATE vehiculos SET veh_estado='$st' WHERE idvehiculos='$para'";
	$DB1->Execute($sql);
	echo "<select name='param11' id='param11' class='form-control' onChange='cambio_ajax2(this.value, 63, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_pro);
	echo "</select>";

}
else if($cond==64) {

	$param1=$_REQUEST["param1"]; if($param1=="SI"){ $st=1; $colorfondo="#074f91"; } else { $st=0; $colorfondo="#941727"; } 
	 $sql="UPDATE servicios SET ser_llamadarecogido=$st WHERE idservicios='$para' ";
	$DB1->Execute($sql);

	echo "<select name='param15' id='param15' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value, 64, \"campo2$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_rec);
	echo "</select>";
}
else if($cond==65) {

	$param1=$_REQUEST["param1"]; if($param1=="Activo"){ $st=1; } else { $st=0; } 
	$sql="UPDATE usuarios SET usu_estado='$st' WHERE idusuarios='$para' ";
	$DB1->Execute($sql);
	echo "<select name='param14' id='param14' class='form-control' onChange='cambio_ajax2(this.value, 65, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_pro);
	echo "</select>";
}
else if($cond==120) {

	$param1=$_REQUEST["param1"]; if($param1=="Activo"){ $st=1; } else { $st=0; } 
	$sql="UPDATE sedes SET sed_estactual='$st' WHERE idsedes='$para' ";
	$DB1->Execute($sql);
	echo "<select name='param14' id='param14' class='form-control' onChange='cambio_ajax2(this.value, 120, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_pro);
	echo "</select>";

}else if($cond==66) {

	$param1=$_REQUEST["param1"]; if($param1=="SI"){ $st=1; $colorfondo="#074f91"; } else { $st=0; $colorfondo="#941727"; } 
	 $sql="UPDATE servicios SET ser_visto=$st WHERE idservicios='$para' ";
	$DB1->Execute($sql);

	echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value, 66, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_rec);
	echo "</select>";
}

else if($cond==67) {

	$param1=$_REQUEST["param1"]; if($param1=="Si"){ $armo=$sino; } else { $armo[]="No"; } 
    echo "<select name='$nombre' id='$nombre' class='form-control'>";
	$LT->llenaselect_ar($para,$armo);
	echo "</select>";

}else if($cond==68) {

	 $param1=$_REQUEST["param1"]; 
	$st=1; $colorfondo="#941727"; 

	if($param1=="SI"){
		
		$st=2; $colorfondo="#074f91"; 
	 $sql="UPDATE servicios SET ser_pendientecobrar=$st WHERE idservicios='$para' ";
	$DB1->Execute($sql);

	$sql2="UPDATE `cuentaspromotor` SET `cue_pendientecobrar`='$st',cue_idoperpendiente='$id_usuario' where cue_idservicio=$para";
	$DB1->Execute($sql2);	

	}else if($param1=="Devolver"){

		$sql="UPDATE servicios SET ser_pendientecobrar=$st WHERE idservicios='$para' ";
		$DB1->Execute($sql);

		$sql2="UPDATE `cuentaspromotor` SET `cue_pendientecobrar`='$st',cue_idoperpendiente='',cue_fechaasigno='' where cue_idservicio=$para";
		$DB1->Execute($sql2);	

	}
	echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value, 68, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_pen);
	echo "</select>";

}else if($cond==69) {

	$param1=$_REQUEST["param1"]; if($param1=="NO"){ $st=5; $colorfondo="#074f91"; } else { $st=3; $colorfondo="#941727"; } 
	 $sql="UPDATE servicios SET ser_pendientecobrar=$st WHERE idservicios='$para' ";
	$DB1->Execute($sql);

	$sql2="UPDATE `cuentaspromotor` SET `cue_pendientecobrar`='$st',`cue_fechapcobrar`='$fechatiempo' where cue_idservicio=$para";
	$DB1->Execute($sql2);	
	echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value, 69, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_rec);
	echo "</select>";
}else if($cond==70) {

	$param1=$_REQUEST["param1"]; 
	 
	if($param1=="SI"){ $st=1; $colorfondo="#074f91"; 
		$estado_rec2[0]="SI";
		echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  required>";
		$LT->llenaselect_ar($param1,$estado_rec2);
		echo "</select>";
	
	} else { $st=0; $colorfondo="#941727";  

	echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value,70, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_rec);
	echo "</select>";
	 }
	$sql="UPDATE servicios SET ser_visto=$st WHERE idservicios='$para' ";
	$DB1->Execute($sql);
}else if($cond==71) {

	$param1=$_REQUEST["param1"]; if($param1=="SI"){ $st=1; $colorfondo="#074f91"; } else { $st=0; $colorfondo="#941727"; } 
	 $sql="UPDATE servicios SET ser_visto=$st WHERE idservicios='$para' ";
	$DB1->Execute($sql);

	echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value,71, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_rec);
	echo "</select>";
	if($param1=="SI"){
		echo "<a  onclick='pop_dis133($para,\"Recoger Paquete\")';  style='cursor: pointer;' class='btn btn-primary btn-lg' title='Recoger Paquete' role='button' >Recoger</a>";
		 }	
}else if($cond==72) {

	$param1=$_REQUEST["param1"]; if($param1=="SI"){ $st=1; $colorfondo="#074f91"; } else { $st=0; $colorfondo="#941727"; } 
	 $sql="UPDATE cuentaspromotor SET cue_validar=$st, cue_usuvalido='$id_nombre' WHERE cue_idservicio='$para' ";
	$DB1->Execute($sql);
	echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value,72, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_rec);
	echo "</select>";

}else if($cond==73) {

	$param1=$_REQUEST["param1"]; if($param1=="SI"){ $st=1; $colorfondo="#074f91"; } else { $st=0; $colorfondo="#941727"; } 
	 $sql="UPDATE cuentaspromotor SET cue_validado=$st WHERE cue_idservicio='$para' ";
	$DB1->Execute($sql);

	echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value, 73, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_rec);
	echo "</select>";
}else if($cond==74) {

	$param1=$_REQUEST["param1"]; if($param1=="SI"){ $st=1; $colorfondo="#074f91"; } else { $st=0; $colorfondo="#941727"; } 
	 $sql="UPDATE cuentaspromotor SET cue_validadoentrega=$st WHERE cue_idservicio='$para' ";
	$DB1->Execute($sql);

	echo "<select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value, 74, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_rec);
	echo "</select>";
}else if($cond==75) {

	$param1=$_REQUEST["param1"]; 
	 
	if($param1=="SI"){ $st="1"; $colorfondo="#074f91"; } else if($rw1[21]==2){ $st="2"; $colorfondo="#074f91"; } else {  $st="0"; $colorfondo="#941727"; }
						
	echo "RECOGEGIO: <select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value,75, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_pen);
	echo "</select>";

	$sql="UPDATE gastos SET gas_recogio=$st WHERE idgastos='$para' ";
	$DB1->Execute($sql);
}else if($cond==76) {

	$param1=$_REQUEST["param1"]; 

	if($param1=="SI"){ $st="1"; $colorfondo="#074f91"; } else if($rw1[21]==2){ $st="2"; $colorfondo="#074f91"; } else {  $st="0"; $colorfondo="#941727"; }
					
	echo "ENTREGADO: <select name='param14' id='param14' class='form-control'  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  onChange='cambio_ajax2(this.value,76, \"campo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_pen);
	echo "</select>";
	 

	$sql="UPDATE gastos SET gas_entrego=$st WHERE idgastos='$para' ";
	$DB1->Execute($sql);
}
else if($cond==77) {

	$param1=$_REQUEST["param1"]; 
	 
	if($param1=="Confirmada"){ $st="1"; $colorfondo="#074f91"; 
							
		echo "CONFIRMADO";

		$sql="UPDATE `asignaciondinero` SET  `asi_usercom`='$id_usuario',`asi_valorcom`=asi_valor,asi_fechaconf='$fechatiempo' WHERE `idasignaciondinero`='$para' ";
		$DB1->Execute($sql);

	} else { 
		$colorfondo="#941727";
		echo "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:12px'  name='param$nombre' id='param$nombre'  onChange='cambio_ajax2(this.value, 75, \"campo$nombre\", \"$nombre\", 1, $para)'  required>";
		$LT->llenaselect_ar($param1,$confirmar);
		echo "</select>";
	}
}else if($cond==78) {

	 $param1=$_REQUEST["param1"]; 
	if($param1=="SI"){ $st=1; $colorfondo="#074f91"; $validau=$id_usuario; } elseif($param1=="NO") { $st=0; $colorfondo="#941727"; $validau=''; } else { $st=2;  }
	
	if($param1=="SI"){ 
			$paraid = explode("_", $para);	
			
			if($paraid[1]=='asignaciondinero'){
				$sql="UPDATE asignaciondinero SET asi_idvalidaf='$id_usuario', asi_fechaf='$fechaactual' WHERE idasignaciondinero=$paraid[0]";
				$DB1->Execute($sql);
			}elseif($paraid[1]=='cajamenor'){
				$sql="UPDATE cajamenor SET caj_idvalidaf='$id_usuario', caj_fechaf='$fechaactual' WHERE idcajamenor=$paraid[0]";
				$DB1->Execute($sql);
			}	elseif($paraid[1]=='gastos'){
				$sql="UPDATE gastos SET gas_fechaf='$id_usuario', gas_idvalidaf='$fechaactual' WHERE idgastos=$paraid[0]";
				$DB1->Execute($sql);
			}
	}elseif($param1=="NO"){ 

		$paraid = explode("_", $para);	

		if($paraid[1]=='asignaciondinero'){
			$sql="UPDATE asignaciondinero SET asi_idvalidaf='', asi_fechaf='' WHERE idasignaciondinero=$paraid[0]";
			$DB1->Execute($sql);
		}elseif($paraid[1]=='cajamenor'){
			$sql="UPDATE cajamenor SET caj_idvalidaf='', caj_fechaf='' WHERE idcajamenor=$paraid[0]";
			$DB1->Execute($sql);
		}	elseif($paraid[1]=='gastos'){
			$sql="UPDATE gastos SET gas_fechaf='', gas_idvalidaf='' WHERE idgastos=$paraid[0]";
			$DB1->Execute($sql);
		}
	}

	echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:15px'  name='$nombre' id='$nombre'  onChange='cambio_ajax2(this.value,78, \"campo$nombre\", \"$nombre\", 1, \"$para\")'  class='borrar'  required>";
	$LT->llenaselect_ar($param1,$estados);
	echo "</select>";

}else if($cond==79) {

	 $param1=$_REQUEST["param1"]; 
	if($param1!='' and $param1!='0'){
	 $sql="UPDATE hojadevida SET hoj_estado='$param1' WHERE idhojadevida='$para'";
	$DB1->Execute($sql);
	}
	echo "<select name='param11' id='param11' class='form-control' onChange='cambio_ajax2(this.value, 63, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar22($param1,$estadosac);
	echo "</select>";
	
}else if($cond==80) {

	$param1=$_REQUEST["param1"]; if($param1=="Activo"){ $st=1; } else { $st=0; } 
	$sql="UPDATE usuarios SET usu_filtro='$st' WHERE idusuarios='$para' ";
	$DB1->Execute($sql);
	echo "<select name='param15' id='param15' class='form-control' onChange='cambio_ajax2(this.value, 80, \"inactivo$nombre\", \"$nombre\", 1, $para)' required>";
	$LT->llenaselect_ar($param1,$estado_pro);
	echo "</select>";

}


$DB->cerrarconsulta();

?>