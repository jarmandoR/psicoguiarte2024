


	
<script type="text/javascript">


function disableIE() {
    if (document.all) {
        return false;
    }
}
function disableNS(e) {
    if (document.layers || (document.getElementById && !document.all)) {
        if (e.which==2 || e.which==3) {
            return false;
        }
    }
}
if (document.layers) {
    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown = disableNS;
} 
else {
    document.onmouseup = disableNS;
    document.oncontextmenu = disableIE;
}
document.oncontextmenu=new Function("return false");


</script>





<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];

$nomimg=$_GET["variable1"];
$carpeta=$_GET["variable2"];


$fechaactualHora =date("Y-m-d");

// if($nivel_acceso==1 or $nivel_acceso==13 or $nivel_acceso==15 or $nivel_acceso==16 or $nivel_acceso==18 or $nivel_acceso==20 ){


echo'
<div id="ver">




<iframe id="inlineFrameExample"
    title="Inline Frame Example"
    width="1100"
    height="600"
    src="'.$carpeta.'/'.$nomimg.'">
</iframe>
</div>

';










































// if($param34!=''){ $fechaactual=$param34; }
// if($param2!=''){ 
// 	$conde26=" and nov_idusuario ='$param2' ";  
 
// 	}else{
// 		$conde26="";  
// 	}

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

// if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }
// $FB->titulo_azul1("Novedades",9,0,7);  
// $FB->abre_form("form1","","post");

// 	$conde="";
// 	$conde="asi_fecha";
// 	$conde2="and usu_idsede=$id_sedes "; 





// $mes=date('m');
// $dia=date('d');

// if($dia>=1 and $dia<=16){
// $quincena1='Primera';
// }else{
// 	$quincena1='Segunda';
// }




// // $FB->llena_texto("Mes:", 34, 82, $DB, $mesd, "", "$mes", 1, 0);
// // $FB->llena_texto("Quincena", 36, 82, $DB, $quincena, "", "$quincena1", 4, 0);


// // if($nivel_acceso==1 or  $nivel_acceso==18 ){

	

// // 		$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio4(\"param2\",\"param1\",\"novedades.php\")", "$param1", 1, 0);
// // }else{
// // 	$id_sedes=$_SESSION['usu_idsede'];

// // 		$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "cambio4(\"param2\",\"param1\",\"novedades.php\")", "$id_sedes", 1, 1);

// // }

	

// $FB->llena_texto("Carpeta:",2,2, $DB, "SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos`", "", $param2, 1, 0);
// // $FB->llena_texto("Estado novedad:", 6, 82, $DB,$estadosnovedades, "", "$param6", 4, 1);
// $FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
// $FB->cierra_form(); 





// if($rcrear==1) { $FB->nuevoname("documentosempresa", $condecion, "Agregar documento");


// $FB->nuevoname("carpetaempresa", $condecion, "Agregar carpeta");
//  } 



// 		$FB->titulo_azul1("Documento",1,0,5); 
// 		$FB->titulo_azul1("Descripcion ",1,0,0); 
// 		$FB->titulo_azul1("Ver",1,0,0); 
// 		// $FB->titulo_azul1("Descripcion adicional",1,0,0); 
// 		// $FB->titulo_azul1("Fecha inicio",1,0,0); 
// 		// $FB->titulo_azul1("Fecha fin",1,0,0);
// 		// $FB->titulo_azul1("Registrada por",1,0,0); 
// 		// $FB->titulo_azul1("Fecha registro",1,0,0);
// 		// $FB->titulo_azul1("Imagen",1,0,0); 
// 		// $FB->titulo_azul1("Sede",1,0,0); 

// if($nivel_acceso==1 or $nivel_acceso==18){	
// 	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
// } 


// if($param34!=''){ 
// 	$fechaactual=$param34." 00:00:00";  

// }else{
// 	$param34= $mes;
// }
// if($param36!=''){
//  $fechafinal=$param36." 23:59:59"; 

	
//   }else{
//   	$param36=$quincena1;
//   }

// $ano=date('Y');

// if($param36=='Primera'){
// 	$fechaactual=date($ano.'-'.$param34.'-01'.' 00:00:00');
// 	$fechafinal=date($ano.'-'.$param34.'-15'.' 23:59:59');
// }elseif($param36=='Segunda'){
// 	$fin = date("t");
// 	$fechaactual=date($ano.'-'.$param34.'-16'.' 00:00:00');
// 	$fechafinal=date($ano.'-'.$param34.'-'.$fin.' 23:59:59');
// }

// if($param6=="" or $param6=="0"){
// 	$conde21="and  asi_usercom IS NULL";
// }else{
// 	$conde21="and  asi_usercom IS NOT NULL";
// }


//  $fechafinal;
//  $fechaactual;




// 		$conde1=" nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal'"; 


	


// $sql="SELECT `empre_id`, `empre_nombre`, `empre_descripcion`, `empre_usuario` FROM `documentos_empre`";



// $DB1->Execute($sql); $va=0;
// while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
// {
// 	$id_p=$rw1[0];
// 	$va++; $p=$va%2;
// 	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

// 	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	



// 		echo"	
// 		<td>".$rw1[1]."</td>
// 		<td>".$rw1[2]."</td>
// 		";

// 		if ($rw1[2]=='') {
//         echo"<td></td>";
//         }else{
// 	    echo"<td><a href='documentosberm/".$rw1[1]."' target='_blank'>Ver</a></td>";


//         }
     
		

// 		if($nivel_acceso==1 or $nivel_acceso==18){
// 			$DB->edites($id_p, "novedades", 1, $condecion);
		
// 		}
// 	echo "</tr>";
// }

// }else{





// }
include("footer.php"); ?>