<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];

$fechaactualHora =date("Y-m-d");





if($param34!=''){ $fechaactual=$param34;}

if($param2!=''){ 

	$conde26=" empre_carpeta ='$param2' ";  
 
	}else{
		$conde26="empre_id>'0'";  
	}

// 	if($param6!=''){ 
// 	$conde27=" and nov_estado ='$param6' ";  
 
// 	}else{
// 		$conde27="";  
// 	}
// 	if($param1!=''){ 
// 		 $id_sedes =$param1;
// 	$conde28=" and nov_sede ='$param1' ";  
 
// 	}else{

// if($nivel_acceso==1 or  $nivel_acceso==18 ){
// $conde28=" ";  
// }else{
// 	$conde28=" and nov_sede ='$id_sedes' ";  
// }
	


		
// 	}

if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }
$FB->titulo_azul1("Carpetas",9,0,7);  
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
echo "<div class='pull-left btn btn-default'><a href='inicio.php'><div style='color:#000'>Volver </div></a></div>";


if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==20 ){


// if($rcrear==1) { $FB->nuevoname("documentosempresa", $condecion, "Agregar documento");


$FB->nuevoname("capacitacion", $condecion, "Agregar carpeta");
// echo "<div class='pull-right btn btn-default'><a href='editcarpetas.php'>Editar carpetas <i class='fa fa-plus'></i></a></div>";
 } 

// }

		// $FB->titulo_azul1("",1,0,5); 
		// $FB->titulo_azul1("Nombre",1,0,0); 
		// $FB->titulo_azul1("Accio",1,0,0); 
		// $FB->titulo_azul1("Descripcion adicional",1,0,0); 
		// $FB->titulo_azul1("Fecha inicio",1,0,0); 
		// $FB->titulo_azul1("Fecha fin",1,0,0);
		// $FB->titulo_azul1("Registrada por",1,0,0); 
		// $FB->titulo_azul1("Fecha registro",1,0,0);
		// $FB->titulo_azul1("Imagen",1,0,0); 
		// $FB->titulo_azul1("Sede",1,0,0); 

// if($nivel_acceso==1 or $nivel_acceso==18){	
// 	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
// } 


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


		if($nivel_acceso==1 or  $nivel_acceso==20 ){
			
		

        $sql="SELECT `capaci_id`, `capaci_nombre` FROM `capacitacion` order by capaci_nombre asc ";



		}else{
          
          $sql="SELECT `capaci_id`, `capaci_nombre` FROM `capacitacion` order by capaci_nombre asc ";
          
        // echo $sql="SELECT * FROM `capacitacion` inner join unicarpetas on unicar_idcarpeta=capaci_id WHERE unicarp_idrol='$nivel_acceso' order by capaci_nombre asc";

		}




$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{


	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}





// $sql1="SELECT `carp_id`, `carp_nombre` FROM `unicarpetas`  ";

// $DB1->Execute($sql1); $va=0;
// while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
// {}

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	
// 	if($rw1[3]==2){

// 		echo "<td>CONFIRMADO</td>";

// 	}else if($rw1[3]==0 or $rw1[3]==1 ){
   
// if($nivel_acceso==1 or $nivel_acceso==18){

// 		echo "<td align='center' >
// 		<a  onclick='pop_dis10($id_p,\"Confirmarnovedades\",\"Gastos\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
	
// 	}else{

// 		echo "<td>POR CONFIRMAR</td>";
// 	}


		
// 	}
    
	// $sql3="SELECT `novt_id`,`novt_nombre` FROM tipo_novedades where novt_id= '$rw1[1]'";
	// $DB->Execute($sql3);
	// $rw4=mysqli_fetch_row($DB->Consulta_ID);
    

    

	//         $sql2="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles` FROM `usuarios` WHERE `idusuarios`='$rw1[4]'";
	// 		$DB->Execute($sql2);
	// 		$rw3=mysqli_fetch_row($DB->Consulta_ID);

 //              $sql6="SELECT `sed_nombre`,`idsedes`FROM `sedes` WHERE `idsedes`='$rw3[1]'";
	// 		  $DB->Execute($sql6);
	// 		  $rw6=mysqli_fetch_row($DB->Consulta_ID);


	// 		$sql4="SELECT `usu_nombre`,`usu_idsede`,`roles_idroles` FROM `usuarios` WHERE `idusuarios`='$rw1[9]'";
	// 		$DB->Execute($sql4);
	// 		$rw5=mysqli_fetch_row($DB->Consulta_ID);



		echo"	
		<td><a  href='navcapaci.php?param2=".$rw1[0]."' ><img src='images/carpeta.png' width='40' height='34' href='navcapaci.php'>".$rw1[1]."<a/></td>
		
		";
		
		// <td>".$rw1[1]."</td>
		// <td>".$rw1[2]."</td>x

		// if ($rw1[2]=='') {
  //       echo"<td></td>";
  //       }else{
	 //    echo"<td><a href='visualizar.php?variable1=".$rw1[1]."&variable2=documentosberm' target='_blank'>Ver</a></td>";


  //       }
        // echo"<td>".$rw1[0]."</td>";
		

		if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==20){
			$DB->edites($id_p, "carpetascapacitacion", 1, $condecion);
		
		}
	echo "</tr>";




}


include("footer.php"); ?>