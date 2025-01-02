<?php 
require("login_autentica.php"); 
include("layout.php");
if($_SESSION['inicio']==1){
?>
<!-- <script type="text/javascript">
$("#myModalinicio").modal("show"); 
</script> -->
<?php 
$_SESSION['inicio']='2';
}
?>
<script>
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	p4=document.getElementById('param4').value;
	id_usuario=document.getElementById('id_usuario').value;

	destino="guiascliente_excel.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&id_usuario="+id_usuario;
	location.href=destino;
}
</script>
<?php 
if($nivel_acceso==6){

	$FB->titulo_azul1("Busqueda de Guias",9,0,5);  
	$FB->abre_form("form1","","post");

	$fechaactual=date('Y-m-d');
	if($param4!=''){  $fechaactual=$param4;  } else { $param4=$fechaactual; }


	$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
	echo '<td align="right">Exportar a :<a href="#" onclick="llena_datos(1, 1, &quot;id_nombre&quot;, &quot;ASC&quot;);" target=""><img src="img/excel.jpg" width="30"></a></td></tr>';
	$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda,"",$param1,1,0);
	$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
	$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);


	$FB->cierra_form(); 	
	$FB->titulo_azul1("#Idservicio",1,0,7); 
	$FB->titulo_azul1("#Guia",1,0,0); 
	$FB->titulo_azul1("Destinatario",1,0,0); 
	$FB->titulo_azul1("Ciudad",1,0,0); 
	$FB->titulo_azul1("Fecha Ingreso",1,0,0); 
	$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
	$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
	$FB->titulo_azul1("Piezas",1,0,0); 
	$FB->titulo_azul1("Volumen",1,0,0); 
	$FB->titulo_azul1("Peso",1,0,0); 
	$FB->titulo_azul1("Valor",1,0,0); 
	$FB->titulo_azul1("Guia",1,0,0); 
	$FB->titulo_azul1("Imprimir",1,0,0); 

	$conde1=""; 
	$conde3=""; 

	if($param2!="" and $param1!=""){ 
	$conde1=" and $param1 like '%$param2%' "; 
	}else { $conde1=""; } 

	if($param1==""){ $param1="ser_prioridad"; } 


	$fehcaactual=date('Y-m-d');	 
	$idtelefono="SELECT `usu_telefono`,`usu_idcredito` FROM `usuarios` WHERE  `idusuarios`='$id_usuario'";
	$DB->Execute($idtelefono);
	$telefono=$DB->recogedato(0);

		 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_estado,'1' as tipoc,ser_peso,ser_volumen,ser_valor,ser_valorseguro,ser_piezas
		FROM serviciosdia where cli_telefono='$telefono' and ser_fecharegistro like  '$fechaactual%'  and ser_estado!=100  $conde1  ORDER BY $param1 $asc ";
	
		$DB->Execute($sql); $va=0; 
		while($rw1=mysqli_fetch_row($DB->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			
			$direct2=str_replace("&"," ", $rw1[7]);
			$pordeclarado=(intval($rw1[19])*1)/100;
			$rw1[18]=$rw1[18]+$pordeclarado;
			echo "
			<td>".$rw1[0]."</td>
			<td>".$rw1[12]."</td>
			<td>".$rw1[5]."</td>
			<td>".$rw1[8]."</td>
			<td>".$rw1[10]."</td>
			<td>".$rw1[6]."</td>
			<td>".$direct2."</td>
			<td>".$rw1[20]."</td>
			<td>".$rw1[17]."</td>
			<td>".$rw1[16]."</td>
			<td>".$rw1[18]."</td>
			";
	
			echo "<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";
		//	echo "<td align='center' ><a  onclick='pop_dis24($id_p,\"Asignar Paquete\",$rw1[13])';  style='cursor: pointer;' title='Asignar Paquete' ><img src='img/paquete.png'></a></td>";
			//echo "<td align='center' >	<a  onclick='pop_dis1($id_p, \"Seguimiento Datos\")';  style='cursor: pointer;' title='Editar Datos' ><img src='img/informacion.jpg'></a></td>";		
		echo "<td align='center' >";
			echo "<a href='ticketfactura.php?id_param=$id_p&pagina2=imprimirasignar.php' target='_blank'><img src='img/imprimir.png'></a></td>";	
	
/* 			echo "<td align='center'  data-toggle='tooltip' data-placement='top'  title='' ><a  onclick='generarcodigo($id_p)';  target='_blank'  style='cursor: pointer;' title='Imprimir Codigo' >
			<img src='img/codigo.png'></a>";
			echo '</td>';  */
		
			echo "</tr>"; 
		
		}
		echo "<tr><td align='center' > Total Datos:$va</td>"; 				
		echo "</tr>"; 

}elseif($nivel_acceso!=3){

		$fechaactual=date('Y-m-d');	 
		$preoper="SELECT `idpreoperacinal` FROM `pre-operacional` WHERE `prefechaingreso` like '$fechaactual%' and `preidusuario`='$id_usuario'";
		$DB->Execute($preoper);
		$preop=$DB->recogedato(0);
		if($preop>=1){
			//echo $_SESSION['usuario_rol'];
			$FB->titulo_azul1("Busqueda de Guias",9,0,5);  
			$FB->abre_form("form1","","post");
			$fechainicial=date('Y-m-01');


			$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda,"",$param1,1,0);
			$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
			$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);


			$FB->cierra_form(); 
			$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
			$FB->titulo_azul1("#Idservicio",1,0,0); 
			$FB->titulo_azul1("#Guia",1,0,0); 
			$FB->titulo_azul1("#Relacionado",1,0,0); 
			$FB->titulo_azul1("Remitente",1,0,0); 
			$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
			$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
			$FB->titulo_azul1("Destinatario",1,0,0); 
			$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
			$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
			$FB->titulo_azul1("Ciudad",1,0,0); 
			$FB->titulo_azul1("Servicio",1,0,0); 
			$FB->titulo_azul1("Guia",1,0,0); 
			$FB->titulo_azul1("Imprimir",1,0,0); 
			$FB->titulo_azul1("Codigo",1,0,0); 
			$FB->titulo_azul1("Editar",1,0,0); 


			$conde1=""; 
			$conde3=""; 

			if($param2!="" and $param1!=""){ 
			$conde1=" $param1 like '%$param2%' "; 
			}else { $conde1=" idservicios=0 "; } 

			if($param1==""){ $param1="ser_prioridad"; } 


			$fehcaactual=date('Y-m-d');	 
				

				 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_estado,'1' as tipoc
				FROM serviciosdia where $conde1 
				union 
				SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_estado,'2' as tipoc
				FROM servicios2 inner join rel_sercli  on idservicios=ser_idservicio  inner join clientesservicios on idclientesdir=ser_idclientes inner join clientes on idclientes=cli_idclientes  inner join ciudades on idciudades=ser_ciudadentrega  where $conde1 
				ORDER BY $param1 $asc ";
			
				$DB->Execute($sql); $va=0; 
				while($rw1=mysqli_fetch_row($DB->Consulta_ID))
				{
					$id_p=$rw1[0];
					$va++; $p=$va%2;
					if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
					echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
					$direc1=str_replace("&"," ", $rw1[4]);
					$direct2=str_replace("&"," ", $rw1[7]);
					echo "<td>".$rw1[10]."</td>
					<td>".$rw1[0]."</td>
					<td>".$rw1[11]."</td>
					<td>".$rw1[12]."</td>
					<td>".$rw1[2]."</td>
					<td>".$rw1[3]."</td>
					<td>".$direc1."</td>
					<td>".$rw1[5]."</td>
					<td>".$rw1[6]."</td>
					<td>".$direct2."</td>
					<td>".$rw1[8]."</td>
					<td>".$rw1[9]."</td>
					";
			
					echo "<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";
				//	echo "<td align='center' ><a  onclick='pop_dis24($id_p,\"Asignar Paquete\",$rw1[13])';  style='cursor: pointer;' title='Asignar Paquete' ><img src='img/paquete.png'></a></td>";
					//echo "<td align='center' >	<a  onclick='pop_dis1($id_p, \"Seguimiento Datos\")';  style='cursor: pointer;' title='Editar Datos' ><img src='img/informacion.jpg'></a></td>";		
				echo "<td align='center' >";
					echo "<a href='ticketfactura.php?id_param=$id_p&pagina2=imprimirasignar.php' target='_blank'><img src='img/imprimir.png'></a></td>";	
			
					echo "<td align='center'  data-toggle='tooltip' data-placement='top'  title='' ><a  onclick='generarcodigo($id_p)';  target='_blank'  style='cursor: pointer;' title='Imprimir Codigo' >
					<img src='img/codigo.png'></a>";
					echo '</td>'; 
			
					if($nivel_acceso==1 or $nivel_acceso==10){
					echo "<td align='center'  data-toggle='tooltip' data-placement='top'  title='' ><a  onclick='pop_dis11($id_p, \"Editar Datos Guia\", \"inicio.php\",\"editarguiacompleta.php\",0)';  style='cursor: pointer;' title='Verificar Datos' >
					<img src='img/informacion.jpg'></a>";
					echo '</td>';
					} else {
						echo "<td align='center'  data-toggle='tooltip' data-placement='top'  title='' ></td>";
					}	
					echo "</tr>"; 
				
				}
				echo "<tr><td align='center' > Total Datos:$va</td>"; 				
				echo "</tr>"; 
			}else{

				$param4='covid19';
				$campo='preencuesta';
				$preoperacional='preoperacional';
				include("preoperacional.php");
			
			}

	}else {
	$fechaactual=date('Y-m-d');	 
	
		 $preoper="SELECT `idpreoperacinal` FROM `pre-operacional` WHERE `prefechaingreso` like '$fechaactual%' and `preidusuario`=$id_usuario";
		$DB->Execute($preoper);
		$preop=$DB->recogedato(0);
		if($preop>=1){
		include("recogidasentregas.php");
	
		}else{

			 $vehiculo="SELECT usu_vehiculo FROM `usuarios` where  `idusuarios`=$id_usuario";
			$DB->Execute($vehiculo);
			$valorvehiculo=$DB->recogedato(0);
			if($valorvehiculo>0){

				$param4='nuevo';
			}else{
				echo '<table><tr bgcolor="#ff0000" class="tittle3"><td colspan="4" >SI USTED ES CONDUCTOR Y NO LE APARECE EL PREOPERACIONAL POR FAVOR COMUNIQUELO AL ADMINISTRADOR</td></tr></table>';

				$param4='covid19';
			}
			$param5='nuevo';
			$campo='preencuesta';
			$preoperacional='preoperacional';
			include("preoperacional.php");
		}  
	//include("recogidasentregas.php");	
  }
  $FB->llena_texto("id_usuario", 1, 13, $DB, "", "", "$id_usuario", 5, 0);
	 ?>

	<?php
include("footer.php");
?>



