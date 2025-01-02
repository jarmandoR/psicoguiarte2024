<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];
$param2=$_GET['param2'];

$fechaactualHora =date("Y-m-d");





if($param34!=''){ $fechaactual=$param34;}
if($param2!=''){ 
	$conde26=" and capaci_id ='$param2' ";  
 
	}else{
		$conde26="";  
	}

	if($param6!=''){ 
	$conde27=" and capaci_estado ='$param6' ";  
 
	}else{
		$conde27="";  
	}
// 	if($param1!=''){ 
// 		 $id_sedes =$param1;
// 	// $conde28=" and capaci_sede ='$param1' ";  
 
// 	}else{

// if($nivel_acceso==1 or  $nivel_acceso==26 or $nivel_acceso==58){
// $conde28=" ";  
// }else{
// 	$conde28=" and nov_sede ='$id_sedes' ";  
// }
// 	}

		
// 	}

if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }
$FB->titulo_azul1("Documentos",9,0,7);  
$FB->abre_form("form1","","post");

	$conde="";
	$conde="asi_fecha";
	$conde2="and usu_idsede=$id_sedes "; 





$mes=date('m');
$dia=date('d');

if($dia>=1 and $dia<=16){
$quincena1='Primera';
}else{
	$quincena1='Segunda';
}




// $FB->llena_texto("Mes:", 34, 82, $DB, $mesd, "", "$mes", 1, 0);
// $FB->llena_texto("Quincena", 36, 82, $DB, $quincena, "", "$quincena1", 4, 0);


// if($nivel_acceso==1 or  $nivel_acceso==18 ){

	

// 		$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio4(\"param2\",\"param1\",\"novedades.php\")", "$param1", 1, 0);
// }else{
// 	$id_sedes=$_SESSION['usu_idsede'];

// 		$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "cambio4(\"param2\",\"param1\",\"novedades.php\")", "$id_sedes", 1, 1);

// }

	

// $FB->llena_texto("Carpeta:",2,2, $DB, "SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos`", "", $param2, 1, 0);
// // $FB->llena_texto("Estado novedad:", 6, 82, $DB,$estadosnovedades, "", "$param6", 4, 1);
// $FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
// $FB->cierra_form(); 



// if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==20 ){
	$tabla="documentocapacitacion";
	$name="Agregar documento";


// if($rcrear==1) { $FB->nuevoname("documentosempresa", $condecion, "Agregar documento");}




if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==20 ){

	// echo "<div class='pull-right btn btn-default'><a href='nuevo_admin.php?tabla=$tabla&condecion=$param2>$name<i class='fa fa-plus'></i></a></div>";

	echo "<div class='pull-right btn btn-default'><a href='nuevo_admin.php?tabla=$tabla&condecion=$param2'>$name <i class='fa fa-plus'></i></a></div>";


// if($rcrear==1) { $FB->nuevoname("documentosempresa", $condecion, "Agregar documento");


// $FB->nuevoname("carpetaempresa", $condecion, "Agregar carpeta");
// // echo "<div class='pull-right btn btn-default'><a href='editcarpetas.php'>Editar carpetas <i class='fa fa-plus'></i></a></div>";
//  } 

}

echo "<div class='pull-left btn btn-default'><a href='capaciberm.php'><div style='color:#000'>Volver </div></a></div>";


// $FB->nuevoname("carpetaempresa", $condecion, "Agregar carpeta");
// // echo "<div class='pull-right btn btn-default'><a href='editcarpetas.php'>Editar carpetas <i class='fa fa-plus'></i></a></div>";
//  } 

// }
        $FB->titulo_azul1("Validar",1,0,5);
		$FB->titulo_azul1("Descripcion",1,0,0); 
		$FB->titulo_azul1("Nombre",1,0,0); 
		// $FB->titulo_azul1("Registrada por",1,0,0); 
		// $FB->titulo_azul1("Fecha registro",1,0,0);
		// $FB->titulo_azul1("Imagen",1,0,0); 
		// $FB->titulo_azul1("Sede",1,0,0); 
        $FB->titulo_azul1("Confirmaron",1,0,0); 
if($nivel_acceso==1 or $nivel_acceso==18){	
	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
} 


if($param34!=''){ 
	$fechaactual=$param34." 00:00:00";  

}else{
	$param34= $mes;
}
if($param36!=''){
 $fechafinal=$param36." 23:59:59"; 

	
  }else{
  	$param36=$quincena1;
  }

$ano=date('Y');

if($param36=='Primera'){
	$fechaactual=date($ano.'-'.$param34.'-01'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-15'.' 23:59:59');
}elseif($param36=='Segunda'){
	$fin = date("t");
	$fechaactual=date($ano.'-'.$param34.'-16'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-'.$fin.' 23:59:59');
}

if($param6=="" or $param6=="0"){
	$conde21="and  asi_usercom IS NULL";
}else{
	$conde21="and  asi_usercom IS NOT NULL";
}


 $fechafinal;
 $fechaactual;


		$conde1=" nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal'"; 


	// SELECT `empre_id`, `empre_nombre`, `empre_descripcion`, `empre_per` FROM `documentos_empre` WHERE 1

// SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos`
// $sql="SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos` ";


if($nivel_acceso==1 or  $nivel_acceso==20 ){


	        
			$sql="SELECT `capaci_id`, `capaci_iddocum`, `capaci_idcarp`, `capaci_idrol`, `capaci_link`,`capaci_descrip`,`capaci_estado` FROM `docum_capaci` WHERE capaci_carpeta ='$param2' ";


			// $sql="SELECT `empre_id`, `empre_nombre`, `empre_descripcion`, `empre_per` FROM `documentos_empre` where nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal' $conde26 $conde27 $conde28 ORDER BY novid desc";
			$DB1->Execute($sql); $va=0;
			while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
			{
				$id_doc=$rw1[1];
				$id_p=$rw1[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

				$sql2="SELECT `reg_id`, `reg_idusuario`, `reg_iddocumento`, `reg_confirmacion` FROM `registrocapaci` WHERE reg_iddocumento='$rw1[0]'";
				$DB->Execute($sql2);
				$rw2=mysqli_fetch_row($DB->Consulta_ID);
				
				if($rw2[3]==2){
		
					echo "<td>CONFIRMADO</td>";
		
				}else if($rw2[3]==0 or $rw2[3]==1 or $rw2[3]==""){
			
							if($nivel_acceso==1 or $nivel_acceso==18){

								echo "<td align='center' >
								<a  onclick='pop_dis10($id_p,\"ConfirmarCapacitacion\",\"Gastos\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
							
							}else{

									echo "<td>POR CONFIRMAR</td>";
								}
			    }

					// $sql="SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos` order by carp_nombre asc ";
				
					echo"<td>".$rw1[5]."</td>";	

					// if ($rw1[1]==0 and $rw1[4] != "") {

					// 	    echo "<td ><a href=".$rw1[4]."  style='cursor: pointer;' title='Confirmar' ><img src='images/enlace.png' width='40' height='34'>".$rw1[4]."</a></td>";


								
					// }else{

				            $sql3="SELECT `empre_id`,`empre_nombre`,`empre_descripcion`,'$rw1[5]'FROM documentos_empre where empre_id= '$rw1[1]'order by empre_nombre asc";


						
				            $DB->Execute($sql3); $va=0;
							while($rw3=mysqli_fetch_row($DB->Consulta_ID))
							{
								
							
									echo "<td ><a  onclick='pop_dis10(\"".$rw3[1]."\",\"vercapacitacion\",\"cedula cara2.pdf\")';  style='cursor: pointer;' title='Confirmar' ><img src='images/documento.png' width='40' height='34'>".$rw3[1]."</a></td>";
									
									
									

									
							
							}
				        // }	
						// echo "<td><div id='inactivo'>"; 
		                // echo "<select name='param11' id='param11'  required>";		
			
						// $sql4="SELECT `reg_id`, `reg_idusuario`, `reg_iddocumento`, `reg_confirmacion` FROM `registrocapaci` WHERE reg_iddocumento='$rw1[0]'";
						// $DB->Execute($sql4); 
	                    // while($rw4=mysqli_fetch_row($DB->Consulta_ID))
	                    // {
						// 	$sql5="SELECT  `usu_nombre` FROM `usuarios` WHERE idusuarios='$rw4[1]' ";
						// 	$DB->Execute($sql5);
						// 	$rw5=mysqli_fetch_row($DB->Consulta_ID);
		                // echo"<option value='".$rw5[0]."'>".$rw5[0]."</option>";

						// }


			            // echo "</select></div></td>";
						echo "<td align='center'  >
						<a  onclick='pop_dis100(".$rw1[0].",\"Ver_quien_confirmo\",0,1,1)';  style='cursor: pointer;' title='Confirmar' >Ver</a>";
						
					echo"</td>";




				if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==20 or $nivel_acceso==15){
					$DB->edites($id_doc, "documentocapacitacion", 1, $id_p);
				
				}
				echo "</tr>";
			}

}else{
	          
	$sql="SELECT `capaci_id`, `capaci_iddocum`, `capaci_idcarp`, `capaci_idrol`, `capaci_link`,`capaci_descrip`,`capaci_estado` FROM `docum_capaci` inner join unicapaci on unicapaci_iddocum=capaci_iddocum  WHERE unicapaci_idrol ='$nivel_acceso' and capaci_carpeta ='$param2' and unicapaci_estado=1";


	// $sql="SELECT `empre_id`, `empre_nombre`, `empre_descripcion`, `empre_per` FROM `documentos_empre` where nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal' $conde26 $conde27 $conde28 ORDER BY novid desc";
	$DB1->Execute($sql); $va=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

		$sql2="SELECT `reg_id`, `reg_idusuario`, `reg_iddocumento`, `reg_confirmacion` FROM `registrocapaci` WHERE reg_iddocumento='$rw1[0]' and reg_idusuario='$id_usuario' ";
		$DB->Execute($sql2);
		$rw3=mysqli_fetch_row($DB->Consulta_ID);
        
		if($rw3[3]==2){

			echo "<td>CONFIRMADO</td>";

		}else if($rw3[3]==0 or $rw3[3]==1 or $rw3[3]==""){
	
					// if($nivel_acceso==1 or $nivel_acceso==18){

						echo "<td align='center' >
						<a  onclick='pop_dis10($id_p,\"ConfirmarCapacitacion\",\"Gastos\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
					
					// }else{

					// 		echo "<td>POR CONFIRMAR</td>";
					// 	}
		}

			// $sql="SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos` order by carp_nombre asc ";
		
			echo"<td>".$rw1[5]."</td>";	

			if ($rw1[1]==0 and $rw1[4] != "") {

					echo "<td ><a href=".$rw1[4]."  style='cursor: pointer;' title='Confirmar' ><img src='images/enlace.png' width='40' height='34'>".$rw1[4]."</a></td>";


						
			}else{

					$sql3="SELECT `empre_id`,`empre_nombre`,`empre_descripcion`FROM documentos_empre where empre_id= '$rw1[1]'order by empre_nombre asc";


				
					$DB->Execute($sql3); $va=0;
					while($rw3=mysqli_fetch_row($DB->Consulta_ID))
					{
						
					
							echo "<td ><a  onclick='pop_dis10(\"".$rw3[1]."\",\"vercapacitacion\",\"cedula cara2.pdf\")';  style='cursor: pointer;' title='Confirmar' ><img src='images/documento.png' width='40' height='34'>".$rw3[1]."</a></td>";
							
							
							

							
					
					}
				}	
				
		// if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==20 or $nivel_acceso==15){
		// 	$DB->edites($id_doc, "documentocapacitacion", 1, $condecion);
		
		// }
		echo "</tr>";
	}
	}


include("footer.php"); ?>