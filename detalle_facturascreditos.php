<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde1=""; 
$conde3=""; 

if($param4!=''){  $fechainicio=$param4;}
if($param5!=''){  $fechaactual=$param5;}
if($param3!=''){ $conde3 =" and fac_credito like '%$param3%'";  }


$FB->titulo_azul1("Fecha",1,0,7); 
$FB->titulo_azul1("Credito",1,0,0); 
$FB->titulo_azul1("# Pre-Factura",1,0,0); 
$FB->titulo_azul1("Fechas Pre-Factura",1,0,0); 
$FB->titulo_azul1("Excel",1,0,0); 
$FB->titulo_azul1("Usuario P",1,0,0); 
$FB->titulo_azul1("No Factura",1,0,0); 
$FB->titulo_azul1("Fecha Factura",1,0,0); 
$FB->titulo_azul1("Fecha Vencimiento",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("Fecha Radicado",1,0,0); 
$FB->titulo_azul1("Tipo Pago",1,0,0); 
$FB->titulo_azul1("Fecha Pago",1,0,0); 
$FB->titulo_azul1("Usuario F",1,0,0); 
$FB->titulo_azul1("Eliminar",1,0,0); 

// fac_numeroref fec_idcredito

 $sql="SELECT `idfacturascreditos`, `fac_fechafactura`,`fac_credito`, `fac_numerofactura`, `fac_fechaprefac`,`fac_idservicios`, `fac_iduserpre`,`fac_numeroref`, `fac_fechafacturado`, `fac_fechavencimiento`, `fac_estado`,`fac_tipopago`,`fac_iduserfac`,fac_precio,`fac_fecharadicado`,fac_fechapago FROM `facturascreditos` WHERE date(fac_fechafactura)>='$fechainicio' and  date(fac_fechafactura)<='$fechaactual' $conde2 $conde3 ORDER BY idfacturascreditos $asc ";

$DB->Execute($sql); $va=0; 
$guias=0;
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$direc1=str_replace("&"," ", $rw1[4]);
		$direct2=str_replace("&"," ", $rw1[7]);
		if($rw1[17]=='' or $rw1[17]==null){ $rw1[17]='Sin Facturar'; }else{
			$guias=$guias+1;
		}
		//$rw1[5]
		if($rw1[7]==''){
			$rw1[7]='Facturar';
		}else{
			$nufactura=$rw1[7];
			$rw1[7]='Factura #:'.$rw1[7];	
			$color='#F26B56';
		}
		$nompromotor='';
		if($rw1[12]!=''){
			$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[12]'";
			$DB1->Execute($sql5);
			$nompromotor=$DB1->recogedato(1);
		}

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

		echo "
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td colspan='1' width='0' align='center' ><a id='link' onclick='llena_datos(4, $nivel_acceso, \"$id_p\", \"ASC\");' title='Descargar' >Descargar</td>
		<td>".$rw1[6]."</td>";
		//<td>".$rw1[7]."</td>
		//echo "<td align='center' ><a  onclick='pop_dis5($id_p,\"facturarcreditos\")';  style='cursor: pointer;' title='Recogidas' >$rw1[7]</a></td>";
		if($rw1[7]=='Facturar'){
		echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='window.open(\"crearfacturacredito.php?param6=$id_p&param3=$rw1[2]\")';  title='Pre operacional' >$rw1[7]</td>";
		}else{
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$id_p\",\"cambiarfactura\",\"$nufactura\")';  title='cambiar Factura' >$rw1[7]</td>";
		}
		echo "<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		<td>".$rw1[10]."</td>
		<td>".$rw1[13]."</td>
		";

		if($rw1[14]=='0000-00-00'){
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"fecharadicado\",\"$rw1[3]\")';  title='fecharadicado' >Sin Radicar</td>";

		}else{
			$radicado="Radicado:".$rw1[14];
			echo $LT->llenadocs3($DB1,"facturascreditos",$id_p, 1, 15,"$radicado");
		} 

		if($rw1[11]=='Pendiente'){
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"TipoPago\",\"$rw1[3]\")';  title='Tipopago' >$rw1[11]</td>";

		}else{
			echo "<td>".$rw1[11]."</td>";
		}
		echo "<td>".$rw1[15]."</td>";
		echo "<td>".$nompromotor."</td>
		";
		
		if($nivel_acceso==1 or $rw1[7]=='Facturar'){
			$DB->edites($id_p, "facturascreditos", 2, $condecion);
		}else{
			echo "<td></td>";
		}
		echo "</tr>"; 
	}
	echo "<tr><td align='center' ><input name='guiasfacturadas' id='guiasfacturadas' type='hidden'  value='$guias'> Total Datos:$va</td>"; 
	
	echo "</tr>"; 


include("footer.php");
?>
