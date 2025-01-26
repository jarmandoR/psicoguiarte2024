<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 
//echo "jose: ".$param5;
if($param5!=''){ $id_sedes=$param5;  $conde2=" "; }  

?>
<script>


</script>
<head>

	</head>
<body>

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","cierrecaja.php","post");
//$FB->nuevo("Planillas", "$id_ciudad", "nuevo_admin.php");
$FB->titulo_azul1("Cierre de Caja ",9,0,5);  


 
if($param4!=''){ $fechaactual=$param4;  }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
$conde3="";	
$conde4="";	




 if($nivel_acceso==3) {
	
$conde3="and ser_idresponsable='$id_usuario'";	
	
}

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Sede",1,0,7); 
$FB->titulo_azul1("Fecha de cierre",1,0,0); 
$FB->titulo_azul1("Valor de Cierre",1,0,0); 


$conde1=""; 

if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; } 
  
if($param1==""){ $param1="ser_prioridad"; } 

$sql2="SELECT idsedes,sum(cus_dinerosede),sed_nombre,cus_fecha FROM `cuentassede` inner join sedes on cus_idsede=idsedes WHERE `cus_fecha` like '%$fechaactual%'  group by idsedes ORDER BY sed_nombre";
$DB1->Execute($sql2); 
$va=0; 
$cierre=array();
while($rw=mysqli_fetch_row($DB1->Consulta_ID))
	{

		$cierre[$rw[0]]['valor']=$rw[1];
		$cierre[$rw[0]]['nombre']=$rw[2];
		$cierre[$rw[0]]['fecha']=$rw[3];
	}
	$sql="SELECT idsedes,sed_nombre FROM  sedes where sed_principal='si'";
	$DB->Execute($sql); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
	
		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}		
		
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td>".$cierre[$id_p]['fecha']."</td>
		<td>".$cierre[$id_p]['valor']."</td>	
		";		
		echo "</tr>"; 

	}


include("footer.php");
?>