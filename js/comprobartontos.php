<script type="text/javascript">
	
	// alert('hola');
</script>
<?php 

// $nombre = $_GET['valor7'];


require("login_autentica.php");
include("cabezote3.php"); 
$id_usuario=$_SESSION['usuario_id'];
// $busqueda=$_POST['cadena'];
// $=$_POST['param21'];
// $tipo=$_POST['param21'];

// $hoyf=date('h:i:s');
$cadena = $_GET['cadena'];
// $id = $_GET['id'];
// $tipo = $_GET['tipo'];
// $motivo = $_GET['motivo'];

// $hoyf=date('Y-m-d');


// echo$sql4="SELECT seg_iduser,seg_fechaingreso, seg_horaingreso, seg_ingresoAlmuerzo, seg_salioAlmuerzo, seg_idestado ,seg_horaSalida, seg_iduser  FROM `seguimientousers` where seg_id='".$id."' ";
// $DB1->Execute($sql4);
// $rw7=mysqli_fetch_row($DB1->Consulta_ID);

// $cadena="20:22:00";
// echo substr($cadena, 0, 2);

$nosepuede=substr($cadena, 0, 2);

if($nosepuede>=25){
    echo"es mayor";

    echo'<script type="text/javascript">novalido();</script>';
}



// if ($tipo==1) {

// 	$horaantigua=$rw7[2];

// 	echo$sql1="UPDATE `seguimientousers` SET `seg_horaingreso`='".$cadena."' WHERE seg_id='".$id."'";
// 			$DB1->Execute($sql1);
// 	# code...
// }elseif ($tipo==2) {

// 	$horaantigua=$rw7[3];
// 	echo$sql1="UPDATE `seguimientousers` SET `seg_ingresoAlmuerzo`='".$cadena."' WHERE seg_id='".$id."'";
// 			$DB1->Execute($sql1);
// 	# code...
// }elseif ($tipo==3) {

// 	$horaantigua=$rw7[4];
// 	echo$sql1="UPDATE `seguimientousers` SET `seg_salioAlmuerzo`='".$cadena."' WHERE seg_id='".$id."'";
// 			$DB1->Execute($sql1);
// 	# code...
// }elseif ($tipo==4) {

// 	$horaantigua=$rw7[6];
// 	echo$sql1="UPDATE `seguimientousers` SET `seg_horaSalida`='".$cadena."' WHERE seg_id='".$id."'";
// 			$DB1->Execute($sql1);
// 	# code...
// }




// echo$sql5="INSERT INTO `registromodhoras`( `mod_idusmodifica`, `mod_idusmodificado`, `mod_horanti`, `mod_horanueva`, `mod_fechacuandomod`, `mod_fechadiamodi`, `mod_motivo`) VALUES ('".$id_usuario."','".$rw7[7]."','".$horaantigua."','".$cadena."','".$hoyf."','".$rw7[1]."','".$motivo."')";
// $DB2->Execute($sql5);


$campo='TELEFONO';



	


?>
</table>