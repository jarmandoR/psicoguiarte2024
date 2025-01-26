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
<body onload=" ">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","buzon.php","post");
//$FB->nuevo("Planillas", "$id_ciudad", "nuevo_admin.php");
$FB->titulo_azul1("Buzon de Mensajes ",9,0,5);  
if($rcrear==1) { $FB->nuevo("Buzon", $condecion, ""); } 


 $conde="and not_fecha like '$fechaactual%'"; 
 
if($param1!=''){ $conde="and not_fecha like '$param1%'";  $fechaactual=$param1;  }

$FB->llena_texto("Fecha de Busqueda:", 1, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 


$FB->titulo_azul1("Fecha",1,0,7); 
$FB->titulo_azul1("Titulo",1,0,0); 
$FB->titulo_azul1("Nota",1,0,0); 
$FB->titulo_azul1("Expira",1,0,0); 
$FB->titulo_azul1("Para",1,0,0); 
$FB->titulo_azul1("Registro",1,0,0); 
if($nivel_acceso==1 or $nivel_acceso==5){
	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
	}

 $sql="SELECT idnoticia,  not_fecha,  usu_usuario, not_titulo, not_descripcion, not_expiracion,not_idrol FROM noticia inner join usuarios on idusuarios=not_idusuario $conde  ORDER BY 1 desc";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
	
		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
		
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		
		echo "<td>".$rw1[1]."</td>
	
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		";

		 $sql5="SELECT `idroles`, `rol_nombre` FROM `roles` where  `idroles`='$rw1[6]' ";
				$DB1->Execute($sql5);
				echo $rolnombre=$DB1->recogedato(1);
				if($rolnombre=='0' or $rolnombre==''){
					$rolnombre='Todos';
				}
		echo "<td>".$rolnombre."</td>
		<td>".$rw1[2]."</td>
		";
		if($nivel_acceso==1 or $nivel_acceso==5){
			$DB->edites($id_p, "idnoticia", 1, $condecion);
			}
		
		echo "</tr>"; 

	}


include("footer.php");
?>