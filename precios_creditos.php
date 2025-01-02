<?php
require("login_autentica.php"); 
include("layout.php");
 $conde="";
$conde="pre_idciudadori";

if(isset($_REQUEST["param1"])){ if($param1!=""){  $conde="pre_idciudadori"; $conde1="and pre_idciudadori='$param1'"; } } else {$param1=""; $conde1=""; }
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde="pre_idciudades"; $conde1.="and pre_idciudades='$param2'"; } } else {$param2="";  $conde1="";}

$FB->titulo_azul1("Configuraci&oacute;n de Precios Creditos",9,0,7);  
$FB->abre_form("form1","","post");

$FB->llena_texto("Ciudad Origen:",1,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM `ciudades` ","cambio1(this.value, param2.value, \"precios_creditos.php\", 1);",$param1,1,0);
$FB->llena_texto("Ciudad Destino:",2,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM ciudades","cambio1(param1.value, this.value, \"precios_creditos.php\", 1);",$param2,4,0);
$FB->cierra_form(); 

if($rcrear==1) { $FB->nuevo("Precios credito", $condecion, ""); } 

$FB->titulo_azul1("Credito",1,0,5); 
$FB->titulo_azul1("Ciudad Origen",1,0,0); 
$FB->titulo_azul1("Ciudad Destino",1,0,0); 
$FB->titulo_azul1("Precio Kilo",1,0,0); 
$FB->titulo_azul1("Precio Adicional",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);

 $sql="SELECT `idprecioscredito`,  `pre_idciudadori`, `pre_idciudades`,`pre_preciokilo`, `pre_precioadicional`, `pre_tiposervicio`, `pre_idcredito`,cre_nombre FROM `precios_credito` inner join creditos on idcreditos=pre_idcredito where idprecioscredito>0  $conde1 ORDER BY $conde, $ord $asc";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	
	$sql1="SELECT  `ciu_nombre`,idciudades FROM `ciudades` WHERE idciudades in ($rw1[1],$rw1[2]) ";
	$DB->Execute($sql1); 
	while($rw=mysqli_fetch_row($DB->Consulta_ID))
	{
		
		if($rw[1]==$rw1[1]){
			$valor[1]=$rw[0];
		}else {
			$valor[2]=$rw[0];
		}
	}
	if($rw1[1]==$rw1[2]){ $valor[2]=$valor[1];  }
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[7]."</td><td>".$valor[1]."</td>
		<td>".$valor[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>";
		if($rw1[5]!=0 and $rw1[5]!=NULL){
			$sql33="Select `idtiposervicio`, `tip_nom` from tiposervicio WHERE `idtiposervicio`='$rw1[5]'"; 
			$DB->Execute($sql33);
			$rw7=mysqli_fetch_row($DB->Consulta_ID); 
			echo "<td>$rw7[1]</td>";
		}else {
			echo "<td>NORMAL</td>";
		}

	$DB->edites($id_p, "Precios credito", 1, $condecion);
	echo "</tr>";
}
include("footer.php"); ?>