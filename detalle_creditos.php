<?php 
require("login_autentica.php");
include("cabezote3.php"); 
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$asc="ASC";
$conde1=""; 
$conde3=""; 
$opcion=$_REQUEST["preguia"];

if($param4!=''){  $fechainicio=$param4;}
if($param5!=''){  $fechaactual=$param5;}

if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; } 

if($param1==""){ $param1="ser_prioridad"; } 
//if($param3!=''){ $conde3 =" and (cli_nombre like '%$param3%' or ser_destinatario like '%$param3%')";  }
if($param3!=''){ $conde3 =" and (rel_nom_credito like '%$param3%')";  }

if($param6=='Sin Facturar'){
	$conde4=' and ser_numerofactura is null';
}elseif($param6=='Facturados'){
	$conde4=' and ser_numerofactura>=1';
}else{
	$conde4='';	
}


 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_valorprestamo,ser_valor,rel_nom_credito,ser_numerofactura,ser_valorseguro
 FROM serviciosdia s inner join rel_sercre rs on rs.idservicio=idservicios where date(ser_fecharegistro)>='$fechainicio' and  date(ser_fecharegistro)<='$fechaactual' and ser_clasificacion=2 and ser_estado!=100  $conde1 $conde2 $conde3  $conde4 ORDER BY $param1 $asc ";
$idguias='';
$html1= "";
$totalcontado=0;
$guiafacturadas=0;
$DB->Execute($sql); $va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		if($rw1[17]=='' or $rw1[17]==null){
			 $rw1[17]='Sin Facturar'; 
			$idguias=$id_p.','.$idguias;
		}else{
			$estadog='Hay Guias Facturadas en este Preriodo de Tiempo';
			$color='#009624';
			$guiafacturadas++;
		}
		
		$html1.="<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$direc1=str_replace("&"," ", $rw1[4]);
		$direct2=str_replace("&"," ", $rw1[7]);
		$pordeclarado=(intval($rw1[18])*1)/100;
		$rw1[15]=$rw1[15]+$pordeclarado;
		$totalcontado=$rw1[15]+$totalcontado;
		$html1.="<td>".$rw1[10]."</td>
		<td>".$rw1[11]."</td>
		<td>".$rw1[12]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$direc1."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$direct2."</td>
		<td>".$rw1[8]."</td>
		<td>$ ".$rw1[15]."</td>
		<td>".$rw1[16]."</td>
		<td>".$rw1[17]."</td>
		";

		
		$html1.="<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";

		$html1.= "</tr>"; 
	}
	$html1.= "<tr><td align='center' > Total Datos:".$va."</td>"; 
	
	$html1.= "</tr>"; 
	$total=$va-$guiafacturadas;
	if($opcion==3 and $total>=1){
		$idguias = substr($idguias, 0, -1);
		 $variable=date("Y").date("m").date("d").date("h").date("i").date("s");
		  $variableunica=$variable;
		$fechafactura='DE: '.$fechainicio.' Hasta '.$fechaactual;
		$sqll1="INSERT INTO `facturascreditos`(`fac_numerofactura`,`fac_fechafactura`,`fac_fechaprefac`,`fac_idservicios`, `fac_estado`,`fac_credito`, `fac_iduserpre`) 
		values ('$variableunica','$fechaactual','$fechafactura','$idguias','Pre-Facturado','$param3','$id_nombre')";
		$DB1->Execute($sqll1);
		
		echo '<div class="alert alert-success" role="alert">
			Se agrego la Pre-Factura con existo, Con '.$total.' Guias 
		</div>';
		if($estadog!=''){
			echo '<div class="alert alert-danger" role="alert">'.$estadog.'</div>';
		}
	}elseif($opcion==3 and $va<=0) {
		echo '<div class="alert alert-danger" role="alert">No hay Guias para Facturar</div>';
	}
	
$FB->titulo_azul1("Total GUIAS: $va",1,0,7); 
$FB->titulo_azul1("Total Flete:",1,0,0); 
$FB->titulo_azul1(" $totalcontado",1,0,0); 

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
$FB->titulo_azul1("Flete + %Seguro",1,0,0); 
$FB->titulo_azul1("Credito",1,0,0); 
$FB->titulo_azul1("Factura No",1,0,0); 
$FB->titulo_azul1("Guia",1,0,0); 

echo $html1;

$FB->titulo_azul1("Total GUIAS: $va",1,0,7); 
$FB->titulo_azul1("Total Flete:",1,0,0); 
$FB->titulo_azul1(" $totalcontado",1,0,0); 

include("footer.php");
?>