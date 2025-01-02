<!DOCTYPE html>
<html>

<head>
<script>
function enviar_formulario(){
   document. getElementById("param8").value='2';
   document.form1.submit()
}
</script>
</head>
<body>

 <?php 

 $fechaactual=date("Y-m-d");
 $nivel_acceso=$_SESSION['usuario_rol'];
 $id_sedes=$_SESSION['usu_idsede'];

 if($nivel_acceso==1){
	if($param35!=''){   $conde2=""; }  

}
else {	
	$param35=$id_sedes;
	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}

echo "</tr>";
$FB->titulo_azul1("X. Comprensión del caso: ",9,0,7);  
echo "</tr>";

echo "<td><label>Comprensión del caso:</label></td>";
echo "<td><textarea name='param10' id='param10' value='$rw[140]' style='width:600px; height:150px; class='text' ></textarea></td>";
echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';



// $FB->llena_texto("Fecha de inicio:",1, 10, $DB, "", "", "", 1, 0);
// $FB->llena_texto("Fecha de Terminacion:",2, 10, $DB, "", "", "", 4, 0);
// $FB->llena_texto("Dias:",3, 1, $DB, "", "", "", 17, 0);
// $FB->llena_texto("Novedad:", 4, 82, $DB, $tipoincapacidad, "", "", 4, 0);
// $FB->llena_texto("Foto:", 5, 6, $DB, "", "", "",4, 0);


// echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
// echo '<input type="hidden" name="param8" id="param8" value="1">';

// //echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
// echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";

// $FB->titulo_azul1("Fecha de inicio",1,0,7); 
// $FB->titulo_azul1("Fecha de Terminacion:",1,0,0); 
// $FB->titulo_azul1("Dias",1,0,0); 
// $FB->titulo_azul1("Tipo Incapacidad",1,0,0); 
// $FB->titulo_azul1("Foto",1,0,0); 
// $FB->titulo_azul1("Registrar Pago",1,0,0); 
// $FB->titulo_azul1("Fecha de Pago",1,0,0); 
// $FB->titulo_azul1("Documento de Pago",1,0,0); 

// $FB->titulo_azul1("Valor Pagado",1,0,0); 
// $FB->titulo_azul1("Valido Pago",1,0,0); 
// $FB->titulo_azul1("Fecha Validacion",1,0,0); 
// $FB->titulo_azul1("Eliminar",1,0,0); 

// $FB->titulo_azul1("Validar",1,0,5); 
// 		$FB->titulo_azul1("Nombre usuario ",1,0,0); 
// 		$FB->titulo_azul1("Tipo de novedad",1,0,0); 
// 		$FB->titulo_azul1("Descripcion adicional",1,0,0); 
// 		$FB->titulo_azul1("Fecha inicio",1,0,0); 
// 		$FB->titulo_azul1("Fecha fin",1,0,0);
// 		$FB->titulo_azul1("Registrada por",1,0,0); 
// 		$FB->titulo_azul1("Fecha registro",1,0,0);
// 		$FB->titulo_azul1("Imagen",1,0,0); 
// 		$FB->titulo_azul1("Sede",1,0,0); 



$sql2="SELECT `hoj_cedula` FROM `hojadevida` WHERE `idhojadevida`='$idhojadevida'";
			$DB2->Execute($sql2);
			$rw3=mysqli_fetch_row($DB2->Consulta_ID);
			$cedulausu =$rw3[0]; 
$sql3="SELECT `idusuarios` FROM `usuarios` WHERE `usu_identificacion`='$cedulausu'";
			$DB2->Execute($sql3);
			$rw4=mysqli_fetch_row($DB2->Consulta_ID);
			$idusua =$rw4[0];


$sql="SELECT `novid`,`nov_tipo`,`nov_descripcion`,nov_estado, `nov_idusuario`,  `nov_fechadesde`, `nov_fechahasta`,`nov_quienregistro`,`nov_fechaingresonov`,`nov_quienregistro`,`nov_imagen` FROM `novedades` where	nov_idusuario='$idusua'  ORDER BY novid desc";

// $sql="SELECT `idincapacidades`, `ref_fehcainicio`, `ref_fechaterminacion`, `ref_dias`, `ref_tipodeincapacidad`, `ref_userregistra`, `ref_fechaingreso`, `ref_idhojavida`, `ref_fechapagoincapacidad`, `ref_valorpagado`, `ref_validadopago`, `ref_fechavalidacion` FROM `incapacidades` WHERE ref_idhojavida=$idhojadevida";

$DB->Execute($sql); 
$va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	// {
	// 			$id_p=$rw1[0];
	// 			$va++; $p=$va%2;
	// 			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	// 			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	// 			echo "<td>".$rw1[1]."</td>";		
	// 			echo "<td>".$rw1[2]."</td>";		
	// 			echo "<td>".$rw1[3]."</td>";		
	// 			echo "<td>".$rw1[4]."</td>";	
	// 			echo $LT->llenadocs3($DB1, "Incapacidades",$id_p, 1, 35, 'Ver');
	// 			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis17($rw1[0],\"RegistrarPago\",\"$idhojadevida\")';  title='Registrar Pago' >Registrar Pago</td>";
					
	// 			echo "<td>".$rw1[8]."</td>";
	// 			echo $LT->llenadocs3($DB1, "RegistrarPago",$id_p, 1, 35, 'Ver');		
	// 			echo "<td>".$rw1[9]."</td>";		
	// 			echo "<td>".$rw1[10]."</td>";		
	// 			echo "<td>".$rw1[11]."</td>";		

	// 			$DB->edites($id_p, "Incapacidades", 2,"$idhojadevida");
	// }
	


	{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	
	if($rw1[3]==2){

		echo "<td>CONFIRMADO</td>";

	}else if($rw1[3]==0 or $rw1[3]==1 ){
   
if($nivel_acceso==1 or $nivel_acceso==26 or $nivel_acceso==20 or $nivel_acceso==58){

		echo "<td align='center' >
		<a  onclick='pop_dis10($id_p,\"Confirmarnovedades\",\"Gastos\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
	
	}else{

		echo "<td>POR CONFIRMAR</td>";
	}


		
	}
    
	$sql3="SELECT `novt_id`,`novt_nombre` FROM tipo_novedades where novt_id= '$rw1[1]'";
	$DB->Execute($sql3);
	$rw4=mysqli_fetch_row($DB->Consulta_ID);
    

    

	        $sql2="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles` FROM `usuarios` WHERE `idusuarios`='$rw1[4]'";
			$DB->Execute($sql2);
			$rw3=mysqli_fetch_row($DB->Consulta_ID);

              $sql6="SELECT `sed_nombre`,`idsedes`FROM `sedes` WHERE `idsedes`='$rw3[1]'";
			  $DB->Execute($sql6);
			  $rw6=mysqli_fetch_row($DB->Consulta_ID);


			$sql4="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles` FROM `usuarios` WHERE `idusuarios`='$rw1[9]'";
			$DB->Execute($sql4);
			$rw5=mysqli_fetch_row($DB->Consulta_ID);
			// $sede =$rw3[0]; 

		// $valor=number_format($rw1[4],0,".",".");
		// @$valor2=number_format($rw1[9],0,".",".");


		echo "<td>".$rw3[0]."</td>	
		<td>".$rw4[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw5[0]."</td>
		<td>".$rw1[8]."</td>";

		if ($rw1[10]=='') {
        echo"<td></td>";
        }else{
	    echo"<td><a href='imgnovedades/".$rw1[10]."' target='_blank'>Ver</a></td>";


        }
        echo"<td>".$rw6[0]."</td>";
		
		// if($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==10){
		// 		echo "<td>".$rw1[10]."</td>
		// 		<td>".$rw1[3]."</td>
		// 		";
		// }	

		//  $sql="SELECT cla_nombre,tipo_nombre FROM `tipo_gastos` inner join clasificacion_gastos on inner_clasificacion_gastos=idclasificacion_gastos where idtipo_gastos='$rw1[11]';";
		// $DB->Execute($sql);
		// $rw3=mysqli_fetch_array($DB->Consulta_ID);
		
		// echo "	<td>".$rw3[0]."</td>
		// <td>".$rw3[1]."</td>
		// ";

		// $LT->llenadocs2($DB, "asignaciondinero", $id_p, 1, 35, 1);
		if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==26 or $nivel_acceso==15 or $nivel_acceso==13 or $nivel_acceso==25 or $nivel_acceso==58){
			$DB->edites($id_p, "novedades", 1, $condecion);
		//$DB->edites($id_p, "asignardinero", 1, $condecion);
		}
	echo "</tr>";
}


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 



?> 
</body>
</html>
