<script type="text/javascript">
	
	alert('hola');
</script>
<?php 

// $nombre = $_GET['valor7'];


require("login_autentica.php");
include("cabezote3.php"); 

// $busqueda=$_POST['cadena'];
// $=$_POST['param21'];
// $tipo=$_POST['param21'];


$valor = $_GET['cadena'];
$valor1 = $_GET['param21'];
$tipo = $_GET['tipo'];
// $valor2 = $_GET['param22'];



$campo='TELEFONO';






if($nivel_acceso==1 or $nivel_acceso==12){
$FB->titulo_azul1("Eliminar",1,'5%',0); 
}

if ($tipo==1) {
	echo$sql1="UPDATE hojadevida set `hoj_salario`='$valor' where idhojadevida='$valor1' ";
			$DB1->Execute($sql1);


}elseif ($tipo==2) {
	echo$sql1="UPDATE hojadevida set `hoj_auxilions`='$valor' where idhojadevida='$valor1' ";
			$DB1->Execute($sql1);
}




	



	


?>
</table>