<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];

$fechaactualHora =date("Y-m-d");

if($nivel_acceso==1 or $nivel_acceso==13 or $nivel_acceso==15 or $nivel_acceso==16 or $nivel_acceso==20 or $nivel_acceso==26 or $nivel_acceso==25 or $nivel_acceso==58){




if($param34!=''){ $fechaactual=$param34; }
if($param2!=''){ 
	$conde26=" and nov_idusuario ='$param2' ";  
 
	}else{
		$conde26="";  
	}

	if($param6!=''){ 
	$conde27=" and nov_estado ='$param6' ";  
 
	}else{
		$conde27="";  
	}
	if($param1!=''){ 
		 $id_sedes =$param1;
	$conde28=" and nov_sede ='$param1' ";  
 
	}else{

if($nivel_acceso==1 or  $nivel_acceso==26 or $nivel_acceso==58){
$conde28=" ";  
}else{
	$conde28=" and nov_sede ='$id_sedes' ";  
}
	


		
	}

if($nivel_acceso==1 or $nivel_acceso==10 or $nivel_acceso==26 or $nivel_acceso==25 or $nivel_acceso==58){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }
$FB->titulo_azul1("Pacientes asignados",9,0,7);  
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
// $FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechainicio", 17, 0);
// $FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);


if($nivel_acceso==1  or $nivel_acceso==26 or $nivel_acceso==58){

	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio4(\"param2\",\"param1\",\"novedades.php\")", "$param1", 1, 0);
	$FB->llena_texto("Paciente:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 4, 0);
		
}else{
	$id_sedes=$_SESSION['usu_idsede'];

		$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "cambio4(\"param2\",\"param1\",\"novedades.php\")", "$id_sedes", 1, 1);

}
$FB->llena_texto("Informe ICBF:", 6, 82, $DB,$estadosnovedades, "", "$param6", 1, 0);
$FB->llena_texto("...", 6, 82, $DB,$estadosnovedades, "", "$param6", 4, 0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 





if($rcrear==1) { $FB->nuevo("novedades", $condecion, "novedades"); } 



		$FB->titulo_azul1("	Seleccionar ",1,0,5); 
		$FB->titulo_azul1("Fecha ingreso",1,0,0);
		$FB->titulo_azul1("Folio oficio",1,0,0);
		$FB->titulo_azul1("Nombre usuario ",1,0,0); 
		$FB->titulo_azul1("ACT",1,0,0); 
		$FB->titulo_azul1("Idfolio",1,0,0); 
		$FB->titulo_azul1("PrimInforme",1,0,0);
		$FB->titulo_azul1("Clasificacion",1,0,0); 
	
if($nivel_acceso==1 or $nivel_acceso==26 or $nivel_acceso==25 or $nivel_acceso==58){	
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



// if($param4!=''){ 
// 	$conde1=" nov_fechaingresonov >='$param5' and nov_fechaingresonov <='$param4'";  

// 	 $fechaactual=$param4;  
// 	 $fechainicio=$param5;  
// 	}else{
		$conde1=" nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal'";  
	// }



$sql="SELECT `idusuarios`, `roles_idroles`, `usu_nombre`, `usu_usuario`, `usu_mail`, `usu_pass`, `usu_token`, `usu_idtipodocumento`, `usu_identificacion`, `usu_genero`, `usu_fechanacimiento`, `usu_idsede`, `usu_idempresa`, `usu_nivelacademico`, `usu_telefono`, `usu_celular`, `usu_tipovehiculo`, `usu_licencia`, `usu_fechalicencia`, `usu_vehiculo`, `usu_estado`, `usu_tipocontrato`, `usu_idcredito`, `usu_filtro`, `fecha_creacion`, `foto`, `ext`, `con_huella`, `usu_horario` FROM `usuarios` WHERE roles_idroles=28";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	echo "<td></td>";
	echo "<td>".$rw1[24]."</td>";
	echo "<td></td>";
	echo "<td>".$rw1[2]."</td>";
	echo "</tr>";
}

}else{





}
include("footer.php"); ?>