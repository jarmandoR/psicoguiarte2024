<script type="text/javascript">
	
	function buscador(valor){

	alert("Eliminaste:" );
}
</script>
<script type="text/javascript">
	
	function buscador(valor){

	alert("Eliminaste:" );
}
</script>
<style type="text/css">
#global {
	height: 100px;
	width: 200px;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
}
#mensajes {
	height: auto;
}
.texto {
	padding:4px;
	background:#fff;
}
</style>
<?php 


require("login_autentica.php");
include("declara.php");


// include('ScreenCatalogo_Seguridad.php');
// 	include('Conexion_Abrir.php');
//Recogemos la cadena

$busqueda=$_POST['cadena'];


if (strlen($busqueda)>=4) {
	# code...
 strlen($busqueda);
//Aquí hacer la consulta para la busqueda con LIKE $busqueda
// echo'<select >';



$sql="SELECT idusuarios,usu_nombre FROM usuarios where usu_nombre LIKE '%".$busqueda."%'";
$DB1->Execute($sql); $va=0;

echo'<div id="global">
  <div id="mensajes">';
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	if ($busqueda!='')
		 {$aux=$rw1[1];
		
		    // echo'<a href="contenido_sale.php?clillega='.$row['ID'].'">'.$aux.'<a><br>'; 
		    echo'<div class="texto"> <a href="contenido_sale.php?clillega='.$rw1[0].'">'.$aux.'<a><br></div>';
		}

}



// $sqlx = "SELECT * FROM clientes where TELEFONO LIKE '%".$busqueda."%'";
// 	$rsx  = mysqli_query($conexion,$sqlx);
// echo'<div id="global">
//   <div id="mensajes">';
// 	# code...
//    // echo'<select name="buscador"  onChange="buscador(this.value)">';
// if(mysqli_num_rows($rsx)!=0){
	
// 		while($row = mysqli_fetch_assoc($rsx)){
// 		if ($busqueda!='')
// 		 {$aux=$row['TELEFONO'];
		
// 		    // echo'<a href="contenido_sale.php?clillega='.$row['ID'].'">'.$aux.'<a><br>'; 
// 		    echo'<div class="texto"> <a href="contenido_sale.php?clillega='.$row['ID'].'">'.$aux.'<a><br></div>';
// 		}
// 		 }
			
// 		 }
		 echo'</div></div>';
		}	



?>