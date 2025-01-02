<?php 
require("login_autentica.php");
include("cabezote3.php"); 


$asc="ASC";
$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
$FB->titulo_azul1("Hora Recogida",1,0,0); 
$FB->titulo_azul1("Remitente",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 
$FB->titulo_azul1("Creada por",1,0,0); 


//if($_SESSION['usuario_rol']!=2){
$FB->titulo_azul1("Descripcion Llamada",1,0,0); 
$FB->titulo_azul1("Abono",1,0,0); 
$FB->titulo_azul1("Llamar",1,0,0); 
$FB->titulo_azul1("MOTIVO",1,0,0); 
$FB->titulo_azul1("CANCELAR",1,0,0);
$conde1=""; 

$idsederemesas=$id_sedes;
if($nivel_acceso==1){
	if($param35!=''){ $id_ciudad=$param35;  $idsederemesas=$param35; $conde2="and cli_idciudad=$id_ciudad"; }  else {  $id_ciudad=""; }

}else {
	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2="";

	}else {
	  $conde2=" and cli_idciudad in $idcidades   "; 	
	}	
	
}


if($param32!="" and $param31!=""){ 
 $conde1="and $param31 like '%$param32%' "; 
  }else { $conde1="  "; } 

if($param31==""){ $param31="ser_prioridad"; } 
if($param34==""){ $param34=$fechaactual; } 
if($param33==""){ $param33=$fechainicial; } 

  $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_esatdollamando,ser_descllamada,gui_usucreado,ser_estado,ser_valorabono
 FROM serviciosdia inner join guias on idservicios=gui_idservicio where ser_estado in (0,1,5) and  date(ser_fecharegistro) >= '$param33' and  date(ser_fecharegistro) <= '$param34'   $conde1 $conde2 ORDER BY ser_fechaentrega,ser_descllamada $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		if($rw1[14]==5){ $color="#ec7878"; }
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$direc1=str_replace("&"," ", $rw1[4]);
		$direct2=str_replace("&"," ", $rw1[7]);
		echo "<td>".$rw1[10]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$direc1."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$direct2."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		<td>".$rw1[13]."</td>
		<td>".$rw1[12]."</td>
		<td>".$rw1[15]."</td>
		";
		if($rw1[11]!='Ocupado'){
		echo "<td align='center' >";
		echo "	<a  onclick='pop_dis1($id_p, \"Verificar Datos\",\"adm_validardatos.php\")';  style='cursor: pointer;' title='Verificar Datos' >
				<img src='img/validar.png'></a></td>";
		} else {
			$llamando=explode("<br>",$rw1[12]);
			echo "<td align='center' bgcolor='#2EFE64' data-toggle='tooltip' data-placement='top'  title='' >$llamando[0]
			<a  onclick='pop_dis1($id_p, \"Verificar Datos\",\"adm_validardatos.php\")';  style='cursor: pointer;' title='Verificar Datos' >
				<img src='img/validar.png'></a>";
		echo '</td>';
			
		}
				$descrip="des_$va";
		echo "<td><textarea name='des_$va' id='des_$va' value='' style='width:195px; class='text' ></textarea></td>";
		if($rw1[15]<=0 or $nivel_acceso==1){ 
			echo "<td><div id='campo$va'>";
			echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:#074f91;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   class='borrar' required>";
			$LT->llenaselect_ar("Selecccione...",$estados);
			echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";
		}else{
			echo "<td>Tiene Abono<td>";
		}
			echo "</tr>"; 
	}
	echo "<tr ><td align='center' > Total Datos:$va</td>"; 
	
	echo "</tr>"; 
	
	$FB->titulo_azul1("Sede Origen",1,0,5); 
	$FB->titulo_azul1("Sede Destino",1,0,0); 	
	$FB->titulo_azul1("Datos TR",1,0,0); 
	$FB->titulo_azul1("Tel Conductor",1,0,0); 
	$FB->titulo_azul1("Pagar en?",1,0,0); 
	$FB->titulo_azul1("Descripcion",1,0,0); 
	$FB->titulo_azul1("Peso",1,0,0); 
	$FB->titulo_azul1("Piezas",1,0,0); 
	$FB->titulo_azul1("Confirmo",1,0,0); 
	$FB->titulo_azul1("Valor Aprobado",1,0,0); 
	$FB->titulo_azul1("Fecha Confirmacion",1,0,0);	
	$FB->titulo_azul1("LLamo",1,0,0); 
	$FB->titulo_azul1("Descripcion Llamada",1,0,0); 
	$FB->titulo_azul1("Confirmar Recogida",1,0,0);  


	 $sql2="SELECT `idgastos`, `gas_fecharegistro`, `usu_nombre`, `gas_idciudadori`, `sed_nombre`, `gas_empresa`, `gas_bus`,
	`gas_telconductor`,`gas_pagar`,`gas_iduserremesa`, `gas_nomremesa`,`gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,
	 gas_usucom,gas_cantcom,gas_feccom ,gas_idciudaddes,gas_iduserrecoge,gas_recogio,gas_entrego,gas_fecrecogida, `gas_descrecogio`,
	`gas_nomvalida`, `gas_fechavalida`,`gas_userllamo`, `gas_fechallamo`, `gas_llamodesc`, `gas_estadollamada` 
	 FROM `gastos` inner join usuarios on gas_idusuario=idusuarios inner join sedes on idsedes=gas_idciudaddes
	  WHERE idgastos>0 and gas_iduserrecoge=0  and gas_usucom!=''   and gas_nomvalida='' and gas_feccom>='2020-08-05' and gas_feccom<='$fechaactual' and gas_idciudaddes='$idsederemesas' and gas_estadollamada!='1' ORDER BY gas_fecrecogida  asc";
	$DB1->Execute($sql2); 
	
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#EDEA10";} else{$color="#EDEA10";}

		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[3]'";
		$DB->Execute($sql2);
		$rw=mysqli_fetch_row($DB->Consulta_ID);
		
echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

  echo "<td>".$rw[1]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5] / $rw1[6] ."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[11]."</td>
		<td>".$rw1[12]."</td>
		<td>".$rw1[13]."</td>
		<td>".$rw1[15]."</td>
		<td>".$rw1[16]."</td>
		<td>".$rw1[17]."</td>
		<td>".$rw1[26]."</td>
		<td>".$rw1[28]."</td>";

		if($rw1[29]!='2'){
			echo "<td align='center' >";
			echo "	<a  onclick='pop_dis16($id_p, \"Llamar Remesas\",\"adm_validardatos.php\")';  style='cursor: pointer;' title='Verificar Remesas' >
					<img src='img/validar.png'></a></td>";
			} else {
				$llamando=explode("<br>",$rw1[26]);
				echo "<td align='center' bgcolor='#2EFE64' data-toggle='tooltip' data-placement='top'  title='' >$rw1[26]
				<a  onclick='pop_dis16($id_p, \"Llamar Remesas\",\"adm_validardatos.php\")';  style='cursor: pointer;' title='Verificar Remesas' >
					<img src='img/validar.png'></a>";
			echo '</td>';
				
			}


	echo "</tr>"; 

	} 

	$FB->cierra_form(); 
?>
