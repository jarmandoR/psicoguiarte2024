<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
if($param34!=''){ $fechaactual=$param34." 00:00:00";  }
if($param36!=''){ $fechainicial=$param36." 23:59:59";  }
if($param33!=''){ $conde="and (`cue_idoperador`= '$param33' or  `cue_idoperentrega`= '$param33' )";  }
if($param35!=''){ $id_sedes=$param35; 

	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2="";

	}else {
	  $conde2=" and (cue_idciudaddes in $idcidades )"; 	
	}	
}

if($param38!=''){  

	$idcidadesdes=ciudadesedes($param38,$DB);
	if($idcidadesdes=='0'){
		$conde4="";

	}else {
	  $conde4=" and (ser_ciudadentrega in $idcidadesdes )"; 	
	}	
}
	
	
$FB->titulo_azul1("Fecha Recogida ",1,0,7); 
$FB->titulo_azul1("Fecha Entrega",1,0,0); 
$FB->titulo_azul1("#Guia",1,0,0); 
$FB->titulo_azul1("Pre-guia",1,0,0); 

$FB->titulo_azul1("Contado+%",1,0,0); 
$FB->titulo_azul1("Credito+%",1,0,0); 
$FB->titulo_azul1("AL Cobro+%",1,0,0); 
$FB->titulo_azul1("Prestamos",1,0,0); 
$FB->titulo_azul1("%Pre.",1,0,0); 
$FB->titulo_azul1("Seguro",1,0,0); 
$FB->titulo_azul1("%Seguro",1,0,0); 
$FB->titulo_azul1("Abonos",1,0,0); 

$FB->titulo_azul1("Total Guia",1,0,0); 

$FB->titulo_azul1("Servicio",1,0,0); 
$FB->titulo_azul1("Destino",1,0,0); 
$FB->titulo_azul1("Validado Por",1,0,0); 

$FB->titulo_azul1("Datos",1,0,0); 

$conde1=""; 
$conde3=""; 

if($param32!="" and $param31!=""){ 
 $conde1="and $param31 like '%$param32%' "; 
  }else { $conde1="  "; } 

//if($param1==""){ $param1="ser_prioridad"; } c  `cue_idoperador`, `cue_idoperentrega`

//if($param33!=''){ $conde3 =" and (cue_idoperador='$param9' or cue_idoperentrega='$param9'  )"; }
//if($param8!=''){ $conde3 =" and $param8='$param9'"; }

$fecharecoentrega = "and ((cue_fecharecogida>='$fechaactual' and  cue_fecharecogida<='$fechainicial') or (cue_fecha>='$fechaactual' and  cue_fecha<='$fechainicial'))";
//$fechaentrega = "and (cue_fecha>='$fechaactual' and  cue_fecha<='$fechainicial') ";
//if(){}

/*  esto es la consulta con el dia en que se realizo la opracion.
 $sql="SELECT `idservicios`,cue_fecharecogida,`cue_fecha`,ser_consecutivo,ser_guiare,cue_tipoevento, `cue_valorflete`, `cue_prestamo`,`cue_porprestamo`,`cue_vrdeclarado`, `cue_pordeclarado`,  `cue_abono`,cue_tipopago,cue_validar,cue_usuvalido,ciu_nombre
 FROM servicios inner join cuentaspromotor on cue_idservicio=idservicios  inner join ciudades on ser_ciudadentrega=idciudades  where ser_estado>='8' and ser_estado<='13' and cue_validar=1 and date(cue_fechafinalizo)>='$fechaactual' and  date(cue_fechafinalizo)<='$fechainicial' $conde $conde1 $conde2   $conde3 $conde4 ORDER BY ser_guiare  $asc ";
 */

 $sql="SELECT `idservicios`,cue_fecharecogida,`cue_fecha`,ser_consecutivo,ser_guiare,cue_tipoevento, `cue_valorflete`, `cue_prestamo`,`cue_porprestamo`,`cue_vrdeclarado`, `cue_pordeclarado`,  `cue_abono`,cue_tipopago,cue_validar,cue_usuvalido,ciu_nombre
FROM servicios inner join cuentaspromotor on cue_idservicio=idservicios  inner join ciudades on ser_ciudadentrega=idciudades  where ser_estado>='8' and ser_estado<='13' and cue_validar=1 $fecharecoentrega  $conde $conde1 $conde2   $conde3 $conde4 ORDER BY ser_guiare  $asc ";
$DB->Execute($sql); 
$va=0; 
$totalcontado=0;
$totalcredito=0;
$totalalcobro=0;
$totalguias=0;
$totalprestamos=0;
$totalporp=0;
$totalseguro=0;
$totalpors=0;
$totalabonos=0;

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		//$direc1=str_replace("&"," ", $rw1[4]);
		//$direct2=str_replace("&"," ", $rw1[7]);

		echo "<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		";

		if($rw1[5]==1){  //contado
		$contado=$rw1[6]+$rw1[10];
		echo "<td>$ ".$contado."</td>
		<td>$ 0</td>
		<td>$ 0</td>
		";	
		
		$totalcontado=$contado+$totalcontado;
			
		}else if($rw1[5]==2){  //credito
		$credito=$rw1[6]+$rw1[10];
		echo "<td>$ 0</td>
		<td>$ ".$credito."</td>
		<td>$ 0</td>
		";
		$totalcredito=$credito+$totalcredito;
		
		}else if($rw1[5]==3){  //al cobro
		$alcobro=$rw1[6]+$rw1[10];
		echo "<td>$ 0</td>
		<td>$ 0</td>
		<td>$".$alcobro."</td>
		";
		$totalalcobro=$alcobro+$totalalcobro;
		
		}else {
			echo "<td>$ 0</td>
		<td>$ 0</td>
		<td>$ 0</td>
		";
		}
		echo "
		<td>$ ".$rw1[7]."</td>
		<td>$ ".$rw1[8]."</td>
		<td>$ ".$rw1[9]."</td>
		<td>$ ".$rw1[10]."</td>
		<td>$ ".$rw1[11]."</td>
		";
		
		$totalprestamos=$rw1[7]+$totalprestamos;
		$totalporp=$rw1[8]+$totalporp;
		$totalseguro=$rw1[9]+$totalseguro;
		$totalpors=$rw1[10]+$totalpors;
		$totalabonos=$rw1[11]+$totalabonos;
		
		
		$totales=$rw1[6]+$rw1[7]+$rw1[8];

		echo "<td> $".$totales."</td><td> ".$rw1[12]."</td>
		";
		$totalguias=$totales+$totalguias;
		echo "<td> ".$rw1[15]."</td><td> ".$rw1[14]."</td>
		";
		
		echo "<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";
		echo "</tr>"; 
	}
	


	$FB->titulo_azul1(" Totales :",1,0,10); 
	$FB->titulo_azul1(" Datos:$va",1,0,0); 
	$FB->titulo_azul1(" ",1,0,0); 
	$FB->titulo_azul1(" ",1,0,0); 
	$FB->titulo_azul1("$ $totalcontado",1,0,0); 
	$FB->titulo_azul1("$ $totalcredito",1,0,0); 
	$FB->titulo_azul1("$ $totalalcobro",1,0,0); 
	$FB->titulo_azul1("$ $totalprestamos",1,0,0); 
	$FB->titulo_azul1("$ $totalporp",1,0,0); 
	$FB->titulo_azul1("$ $totalseguro",1,0,0); 
	$FB->titulo_azul1("$ $totalpors",1,0,0); 
	$FB->titulo_azul1("$ $totalabonos",1,0,0); 
	$FB->titulo_azul1("$ $totalguias",1,0,0); 
	//echo "<tr><td align='center' > </td>"; echo "</tr>"; 

include("footer.php");
?>