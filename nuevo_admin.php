<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	function buscar_ajax(cadena){
		$.ajax({
		type: 'POST',
		url: 'buscar.php',
		data: 'cadena=' + cadena,
		success: function(respuesta) {
			//Copiamos el resultado en #mostrar
			$('#mostrar').html(respuesta);
	   }
	});
	}

	function check(param1,param2,param3){




    var ruta="param1="+param1+"&param2="+param2+"&param3="+param3;

    $.ajax({
    
    url: 'guardacheckdocumentos.php',
    type: 'Post',
    data: ruta,
    }).done(function(res){
    

     // recarga(param1,param2,param3);

     // location.reload();
 
    });
    // alert("ok");
   
   


}
</script>

<?php
require("login_autentica.php");
include("layout.php");


$tabla=$_REQUEST["tabla"];
if(isset($_REQUEST["condecion"])){ $condecion=$_REQUEST["condecion"];  $ess=explode("-",$condecion); if(isset($ess[1])){$nivel=$ess[1]; $id_p=$ess[0];} else {$nivel=""; $id_p="";} } else { $condecion=""; } 

?>

<body onLoad="

<?php 
switch ($tabla)
{
	case "Campo de Cabezote de formularios":
	echo "cambio_ajax2(param1.value, 9, 'llega_sub1', 'param4', 1, 0)";
	break;

case "documentocapacitacion":
    echo "cambio_ajax2('', 100, \"llega_sub1\", \"param151\", 1, 0)";
	// echo "cambio_ajax2(param1.value, 9, 'llega_sub1', 'param4', 1, 0)";
	break;


	case "Parametro":
	echo "cambio_ajax2(param1.value, 9, 'llega_sub1', 'param4', 1, 0)";
	break;

	case "Permiso":
	echo "cambio_ajax2(param1.value, 5, 'llega_sub1', 'param2', 1, 0);  ";
	break;

	case "Usuario":
	echo "cambio_ajax2(0, 32, 'llega_sub1', 'param13', 1, 0); ";
	break;

	case "Vehiculos":
		echo "cambio_ajax2(0, 32, 'llega_sub1', 'param13', 1, 0); ";
	break;

	case "Formulario":
	echo "cambio_ajax2(0,133,'llega_sub1','param2',3,0); cambio_ajax2(0, 95, 'llega_sub2', 'param4', 2, 0);";
	break;	

	case "asignardinero":
	echo "cambio_ajax2(0,15,'llega_sub1','param2',3,0); ";
	break;	
	case "GastosOperador":
	echo "cambio_ajax2(0,15,'llega_sub1','param2',3,0); ";
	break;	
	case "SeguimientoUser":
		echo "cambio_ajax2($id_sedes,15,'llega_sub1','param2',3,0); ";
	break;	
	case "ingresoprueba":
		echo "cambio_ajax2($id_sedes,15,'llega_sub1','param2',3,0); ";
	break;		
	case "transpasodinero":
	echo "cambio_ajax2(0,15,'llega_sub1','param2',3,0); ";
	break;	
	
	case "deudaspro":
	echo "cambio_ajax2(0,15,'llega_sub1','param2',3,0); ";
	break;

	case "Remesas":
	echo "cambio_ajax2(0,15,'llega_sub1','param7',3,0); ";
	break;

	default:

	break;

}

?>



">

<?php

$FB->abre_form("form1","nuevo_adminok.php","post");
$FB->titulo_azul1("Agregar $tabla","2","0", 4); 
$tabla1=$tabla;

if($condecion=='general'){  $tabla='General'; }

switch ($tabla)

{

case "General": 

$tabla1=strtolower($tabla1);
$sql="SHOW COLUMNS FROM $tabla1";
$DB->Execute($sql); $va=1; $va2=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		if($va2!=0){

		$dato=explode("_",$rw1[0]);

		if($dato[0]=="val"){
			$FB->llena_texto("Valor $dato[1]:",$va2, 118, $DB, "", "", "",1, 1);
		}else if($dato[0]=="inner"){
			if($dato[2]!=''){
				$nombretable=$dato[1]."_".$dato[2];
			}else{
				$nombretable=$dato[1];
			}
			

			$FB->llena_texto("$dato[1]:",$va2,2,$DB,"(Select * FROM  `$nombretable` ORDER BY 2)", "","", 2, 1);
			
		}
		else {
			$FB->llena_texto("$dato[1]:",$va2, 1, $DB, "", "", "",1, 0);
		}

		}
		$va2++;
	}

	$tabla=$tabla1;
	$condecion='general';

break;

case "Rol": 

	$FB->llena_texto("Empresa a la cual pertenece:",10,2,$DB,"( SELECT `empre_id`, `empre_nombre` FROM `empresa`)", "", "", 2, 1);
	$FB->llena_texto("Nombre Rol:", 1, 1, $DB, "", "", "",2, 1);
break; 



case "Pais": 

$FB->llena_texto("Nombre:",1, 1, $DB, "", "", "",2,1);
$FB->llena_texto("C&oacute;digo:",2, 1, $DB, "", "", "",2,1);

break; 

case "Region": 

$FB->llena_texto("Pa&iacute;s:",1,2,$DB,"(SELECT idpaises, pai_nombre FROM paises WHERE pai_nombre='COLOMBIA') UNION (SELECT idpaises, pai_nombre FROM paises WHERE pai_nombre!='COLOMBIA' ORDER BY pai_nombre)","","",2,1);
$FB->llena_texto("Nombre regi&oacute;n:",2, 1, $DB, "", "", "",2,1);

break; 

case "Departamento": 

$FB->llena_texto("Nombre departamento:",1, 1, $DB, "", "", "",2,1);

break; 

case "Menu":

$FB->llena_texto("Nombre Men&uacute;:",1, 1, $DB, "", "", "",2,1);
$FB->llena_texto("URL destino:",2, 1, $DB, "", "", "",2,1);
$FB->llena_texto("Categor&iacute;a jer&aacute;rquica a la que pertenece?",3,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE (men_predecesor=0 or men_principal=1) ORDER BY men_predecesor, men_nombre","","",2,0);
$FB->llena_texto("Orden:",4, 112, $DB, "", "", "",2,1);
$FB->llena_texto("Principal:", 5, 5, $DB, "", "", "", 2, 0);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", "",2,0);
$FB->llena_texto("&Iacute;cono", 7, 6, $DB, "", "", "",1,0);
break;

case "Precios": 

$FB->llena_texto("Ciudad Origen:",1,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades` ", "","",2,1);
$FB->llena_texto("Ciudad Destino:",2,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades` ", "","",2,1);
$FB->llena_texto("Precio Kilo:",3, 123, $DB, "", "", "", 2, 1);
$FB->llena_texto("Precio Adicional:",4, 123, $DB, "", "","",2,1);

break;

case "Precios credito": 
$FB->llena_texto("Credito:",1,2,$DB,"SELECT `idcreditos`, `cre_nombre` FROM `creditos` ", "","",2,1);
$FB->llena_texto("Ciudad Origen:",2,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades` ", "","",2,1);
$FB->llena_texto("Ciudad Destino:",3,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades` ", "","",2,1);
$FB->llena_texto("Precio Kilo:",4, 123, $DB, "", "", "", 2, 1);
$FB->llena_texto("Precio Adicional:",5, 123, $DB, "", "","",2,1);
$FB->llena_texto("Servicio:",6,279,$DB,"SELECT `idtiposervicio`, `tip_nom` FROM `tiposervicio`  ", "","",2,0);
break;

case "Permiso": 

// $FB->llena_texto("Predecesor:",1,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE (men_predecesor=0 OR men_principal=1) ORDER BY men_predecesor, men_nombre", "	(this.value, 5, \"llega_sub1\", \"param2\", 1, 0)","",2,0);
$FB->llena_texto("Item Men&uacute;:", 2, 2, $DB, "SELECT `idmenu`, `men_nombre` FROM `menu` WHERE 1 order by men_nombre asc ", "", "",2,0);
$FB->llena_texto("Rol:",3,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","","",2,1);
$FB->llena_texto("Crear:", 4, 5, $DB, "", "", "", 2, 0);
$FB->llena_texto("Editar:", 5, 5, $DB, "", "", "", 2, 0);
$FB->llena_texto("Eliminar:", 6, 5, $DB, "", "", "", 2, 0);
$FB->llena_texto("Visible en el men&uacute;:", 7, 5, $DB, "", "", "",2, 0);

break;

case "asignardinero":

$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", "",2,1);
$FB->llena_texto("Fecha de Ingreso:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
$FB->llena_texto("Tipo de transaccion:", 5, 82, $DB, $transaccionoper, "", "", 2, 1);
$FB->llena_texto("Valor:",4, 118, $DB, "", "", "", 2, 1);
$FB->llena_texto("Descripcion:", 6,1, $DB, "", "", "", 1, 0);
break;

case "Buzon":

	$FB->llena_texto("Titulo:", 1,1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Mensaje:", 2,9, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Fecha de Expiracion:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Para:",4,2,$DB,"(SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre)", "", "$id_sedes ", 2, 1);
	//$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", "",2,1);
	break;

case "deudaspro":

	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
	$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", "",2,1);
	$FB->llena_texto("Fecha de Ingreso:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Tipo de transaccion:", 4, 82, $DB, $deudaoper, "", "", 2, 1);
	$FB->llena_texto("Valor:",5, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Descripcion:", 6,1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Imagen", 7, 6, $DB, "", "", "",1,0);
break;

case "deudaspro":

	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
	$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", "",2,1);
	$FB->llena_texto("Fecha de Ingreso:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Tipo de transaccion:", 4, 82, $DB, $deudaoper, "", "", 2, 1);
	$FB->llena_texto("Valor:",5, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Descripcion:", 6,1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Imagen", 7, 6, $DB, "", "", "",1,0);
break;

case "pqr":

	// $FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
	// $FB->llena_texto("usuario:", 2, 4, $DB, "llega_sub1", "", "",2,1);
    $FB->llena_texto("Tipo de PQR:", 4, 82, $DB, $pqr, "", "", 2, 1);
    $FB->llena_texto("Descripcion:", 6,1, $DB, "", "", "", 1, 0);
	// $FB->llena_texto("Fecha de Registro:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
	// $FB->llena_texto("Tipo de transaccion:", 4, 82, $DB, $deudaoper, "", "", 2, 1);
	$FB->llena_texto("Imagen", 7, 6, $DB, "", "", "",1,0);
	// $FB->llena_texto("Valor:",5, 118, $DB, "", "", "", 2, 1);
	
break;

case "transpasodinero":
if($nivel_acceso==1){

	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "", 2, 1);
	$FB->llena_texto("Asignar a:", 2, 4, $DB, "llega_sub1", "", "",2,1);
	$FB->llena_texto("Fecha de Ingreso:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Valor:",5, 118, $DB, "", "", "", 2, 1);
	//$FB->llena_texto("Imagen", 6, 6, $DB, "", "", "",1,0);
}else{

$FB->llena_texto("Valor:",5, 118, $DB, "", "", "", 2, 1);
$FB->llena_texto("Asignar a:", 2, 2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5) and  (usu_estado=1 or usu_filtro=1) and usu_idsede=$id_sedes and idusuarios!=$id_usuario order by usu_nombre,roles_idroles desc", "", "",2,1);
//$FB->llena_texto("Imagen", 6, 6, $DB, "", "", "",1,0);

}

break;
case "SeguimientoUser":

	if($nivel_acceso!='1' and $nivel_acceso!='12'){  $cond="and idsedes=$id_sedes";  }
		$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $cond  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes", 2, 1);
		$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", "",2,1);
		$FB->llena_texto("Fecha de Ingreso:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
		$FB->llena_texto("Motivo Ingreso:", 4, 82, $DB, $motivoingreso, "", "", 2, 1);
		$FB->llena_texto("Descripcion:", 5, 1, $DB, "", "", "", 2, 0);
		$FB->llena_texto("Zona:",6,2,$DB,"(SELECT `idzonatrabajo`,`zon_nombre` FROM zona_trabajo where idzonatrabajo>0 )", "", "", 2, 1);
		$FB->llena_texto("Prueba de Alcohol:", 7, 82, $DB, $pruebaalcohol, "", "", 2, 1);
		$FB->llena_texto("Imagen", 8, 6, $DB, "", "", "",1,0);


	break;
	case "reclamos":

		//if($nivel_acceso!='1'){  $cond="and idsedes=$id_sedes";  }
			//$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "", "$id_sedes", 2, 1);
			$FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$fechaactual", 2, 0);
			$FB->llena_texto("Tipo Reclamo:", 9, 82, $DB, $tiporeclamo, "", "", 2, 1);
			$FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "", 1, 0);
			$FB->llena_texto("telefono:", 5, 1, $DB, "", "", "", 1, 0);
			$FB->llena_texto("E-mail:", 6, 1, $DB, "", "", "", 1, 0);	
			$FB->llena_texto("Ciudad donde quiere recibir la notificacion:", 1, 1, $DB, "", "", "", 1, 1);
			$FB->llena_texto("Direccion donde quiere recibir la notificacion:",11, 1, $DB, "", "", "", 1, 1);

			$FB->llena_texto("Descripcion de Reclamo:", 7,9, $DB, "", "", "", 2, 0);
			$FB->llena_texto("Numero De Guia Completo",2, 1, $DB, "", "", "",2,1);
			$FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);
			echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(29);'  >Validar Guia </button></td></tr>";		
			$FB->llena_texto("Foto Guia", 8, 6, $DB, "", "", "",1,0);
			$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);
	
		break;
	case "crearalarma":

		if($nivel_acceso!='1' and $nivel_acceso!='12'){  $cond="and idsedes=$id_sedes";  }
			$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $cond  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
			$FB->llena_texto("Alarma:", 2, 1, $DB, "", "", "", 1, 0);
			$FB->llena_texto("Fecha de Vencimiento:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
			$FB->llena_texto("E-mail:", 4, 1, $DB, "", "", "", 1, 0);
			$FB->llena_texto("Documento", 5, 6, $DB, "", "", "",1,0);
			
		break;
	case "ingresoprueba":
	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $cond  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
            $FB->llena_texto("Empleado:", 3, 4, $DB, "llega_sub1", "", "",2,1);
			$FB->llena_texto("Huella1", 8, 6, $DB, "", "", "",1,0);
			$FB->llena_texto("Huella2", 9, 6, $DB, "", "", "",1,0);	
			$FB->llena_texto("Huella3", 10, 6, $DB, "", "", "",1,0);		

	break;
case "documentosempresa":
// $param2=$_GET['param2'];

$carpeta=$_GET['condecion']; 
             
             $FB->llena_texto("Carpeta:",92,2,$DB,"( SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos`)", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$carpeta", 2, 0);


             $FB->llena_texto("Descripcion:",90, 1, $DB, "", "", "", 1, 0);

             // $FB->llena_texto("	Cargar link:",93, 1, $DB, "", "", "", 1, 0);
	
            $FB->llena_texto("Cargar documento:", 91,6, $DB, "llega_sub1", "", "",2,0);

            // $FB->llena_texto("Carpeta:",92,2,$DB,"( SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos`)", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$carpeta ", 2, 0);
			// $FB->llena_texto("Huella1", 8, 6, $DB, "", "", "",1,0);
			// $FB->llena_texto("Huella2", 9, 6, $DB, "", "", "",1,0);	
			// $FB->llena_texto("Huella3", 10, 6, $DB, "", "", "",1,0);	

			

            // $FB->llena_texto("Descripcion:",90, 1, $DB, "", "", "", 1, 0);
	
            // $FB->llena_texto("Cargar documento:", 91,6, $DB, "llega_sub1", "", "",2,1);

           
			// $FB->llena_texto("Huella1", 8, 6, $DB, "", "", "",1,0);
			// $FB->llena_texto("Huella2", 9, 6, $DB, "", "", "",1,0);	
			// $FB->llena_texto("Huella3", 10, 6, $DB, "", "", "",1,0);		


	break;
	case "documentosreglamento":

	$carpeta=$_GET['condecion'];

	        $FB->llena_texto("Carpeta:",92,2,$DB,"( SELECT `carpregla_id`, `carpregla_nombre` FROM `carpetasregla`)", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$carpeta", 2, 0);

            $FB->llena_texto("Descripcion:",90, 1, $DB, "", "", "", 1, 0);

            $FB->llena_texto("Cargar link:",93, 1, $DB, "", "", "", 1, 0);
	
            $FB->llena_texto("Cargar documento:", 91,6, $DB, "llega_sub1", "", "",2,0);

            

            // $FB->llena_texto("Carpeta:",92,2,$DB,"( SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos`)", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
			// $FB->llena_texto("Huella1", 8, 6, $DB, "", "", "",1,0);
			// $FB->llena_texto("Huella2", 9, 6, $DB, "", "", "",1,0);	
			// $FB->llena_texto("Huella3", 10, 6, $DB, "", "", "",1,0);		

	break;

case "carpetareglamento":
	
           $FB->llena_texto("Nombre:",1, 1, $DB, "", "", "", 1, 0);

           // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);

         	

	break;


case "carpetaempresa":
	
           $FB->llena_texto("Nombre:",1, 1, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);

           // $FB->llena_texto("1:",1, 1, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("2:",1, 2, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("3:",1, 3, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("4:",1, 4, $DB, "", "", "", 1, 0);
// $sql3=" SELECT `idroles`, `rol_nombre` FROM `roles` ";


// // $sql="SELECT `empre_id`, `empre_nombre`, `empre_descripcion`, `empre_per` FROM `documentos_empre` where nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal' $conde26 $conde27 $conde28 ORDER BY novid desc";
// $DB1->Execute($sql3); $va=0;
// while($rw3=mysqli_fetch_row($DB1->Consulta_ID))
// {

//            $FB->llena_texto("$rw3[1]","$rw3[0]", 5, $DB, "", "check(this.value,1,2)", "", 1, 0);

//        }
           // $FB->llena_texto("6:",1, 6, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("7:",1, 7, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("8:",1, 8, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("9:",1, 9, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("10:",1, 10, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("11:",1, 12, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("12:",1, 13, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("13:",1, 14, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("15:",1, 15, $DB, "", "", "", 1, 0);

            // $FB->llena_texto("Carpeta:",92,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $cond  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
			// $FB->llena_texto("Huella1", 8, 6, $DB, "", "", "",1,0);
			// $FB->llena_texto("Huella2", 9, 6, $DB, "", "", "",1,0);	
			// $FB->llena_texto("Huella3", 10, 6, $DB, "", "", "",1,0);		

	break;

case "capacitacion":
           	
           $FB->llena_texto("Nombre:",1, 1, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);

	break;

	case "ingresoempleados":
	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $cond  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
			$FB->llena_texto("Huella1", 8, 6, $DB, "", "", "",1,0);
			

	break;	

case "documentocapacitacion":
// $param2=$_GET['param2'];

$carpeta=$_GET['condecion'];

            // $FB->llena_texto("Descripcion:",90, 1, $DB, "", "", "", 1, 0);
	
            // $FB->llena_texto("Cargar documento:", 91,6, $DB, "llega_sub1", "", "",2,1);

            $FB->llena_texto("Carpeta actual :",92,2,$DB,"( SELECT `capaci_id`, `capaci_nombre` FROM `capacitacion`)", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$carpeta", 2, 0);

            // $FB->llena_texto("Carpeta a Consultar:",150,2,$DB,"( SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos`  )", "cambio_ajax2(this.value, 100, \"llega_sub1\", \"param151\", 1, 0)", "$param150", 2, 1);

            $FB->llena_texto("Descripcion:",95, 1, $DB, "", "", "", 1, 0);

            // $FB->llena_texto("Cargar link:",93, 1, $DB, "", "", "", 1, 0);


            $FB->llena_texto("Carpeta a Consultar:",70,2,$DB,"( SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos`)", "cambio_ajax2(this.value, 100, \"llega_sub1\", \"param71\", 1, 0)", "", 2, 0);
            $FB->llena_texto("Documento a Consultar:",71,4,$DB,"llega_sub1","","", 2, 0);

			// $FB->llena_texto("Huella1", 8, 6, $DB, "", "", "",1,0);
			// $FB->llena_texto("Huella2", 9, 6, $DB, "", "", "",1,0);	
			// $FB->llena_texto("Huella3", 10, 6, $DB, "", "", "",1,0);		

	break;

	case "Sedes":
// $param2=$_GET['param2'];

$carpeta=$_GET['condecion']; 
 
            $FB->llena_texto("Nombre:",90, 1, $DB, "", "", "", 1, 0);
			$FB->llena_texto("Telefono:",91, 1, $DB, "", "", "", 1, 0);
			$FB->llena_texto("Direccion:",92, 1, $DB, "", "", "", 1, 0);
             
            $FB->llena_texto("Empresa:",93,2,$DB,"( SELECT `empre_id`, `empre_nombre` FROM `empresa`)", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$carpeta", 2, 0);
            // $FB->llena_texto("Estado:", 94, 82, $DB, $estado_pro, "", "Activo", 4, 1);

           
	break;

	case "empresa":
	
		$FB->llena_texto("Nombre:",1, 1, $DB, "", "", "", 1, 0);
			

 break;

 case "proveedor":
	
	$FB->llena_texto("Nombre:",1, 1, $DB, "", "", "", 1, 0);
		

break;

	case "ingresopruebacovid":

		 $sql="SELECT preidusuario FROM `pre-operacional` where prefechaingreso like '$fechaactual%' and preidusuario='$id_usuario' and preestado='covid19'";
		$DB->Execute($sql); 
		$valorcovid=$DB->recogedato(0);
		if($valorcovid>0){
			$sql="Select seguimiento_user from seguimiento_user where seg_idusuario='$id_usuario' and seg_fechaalcohol='$fechaactual' ";
			$DB->Execute($sql); 
			$insertcovid=$DB->recogedato(0);
			if($insertcovid>0){
			$FB->llena_texto("Prueba de Alcohol:", 7, 82, $DB, $pruebaalcohol, "", "", 2, 1);
			$FB->llena_texto("Imagen", 8, 6, $DB, "", "", "",1,0);
			}else{
				echo '<tr bgcolor="#ff0000" class="tittle3"><td colspan="4" >Ya ha ingresado la Prueba de Alcolemia</td></tr>';
				$FB->llena_texto("param7", 1, 13, $DB, "", "", 0, 5, 0);
			}		

		}else{
			echo '<tr bgcolor="#ff0000" class="tittle3"><td colspan="4" >Debe Diligenciar Primero la encusta de COVID 19</td></tr>';
			$FB->llena_texto("param7", 1, 13, $DB, "", "", 0, 5, 0);
		}
		
		

break;	
case "GastosOperador":
if($nivel_acceso==1){
	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
	$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", "",2,1);
	$FB->llena_texto("Fecha de Ingreso:", 3, 10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Valor:",4, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Descripcion:", 6,1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Imagen", 7, 6, $DB, "", "", "",1,0);
}else{
	$FB->llena_texto("Valor:",4, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Descripcion:", 6,1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Imagen", 7, 6, $DB, "", "", "",1,0);
}
break;

case "novedades":

    $FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$id_sedes ", 2, 1);
	$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", "",2,1);
	$FB->llena_texto("Tipo de novedad:",8,2,$DB,"(SELECT `novt_id`,`novt_nombre` FROM tipo_novedades )", "", "$id_sedes ", 2, 1);
	$FB->llena_texto("Descripcion:",20,1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Fecha desde:", 5 ,10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Fecha hasta:", 6, 10, $DB, "", "", "$fechaactual", 2, 0);
    $FB->llena_texto("Hora inicial: (10:05)",101,1, $DB, "", "", "", 1, 0);
    $FB->llena_texto("Hora final: (14:50)",111,1, $DB, "", "", "", 1, 0);


	// echo"<tr><td>Hora inicial:</td>
	// <td><label>Hr</label><input id='param100' name='param100'>";

	// for ($i=1; $i < 24; $i++) { 
	// 	 if ($i>=0 and $i<10 ) {
 //        	$prinum=0;
 //        }else{
 //        	$prinum="";
 //        }
        
	// 	echo"<option value='".$prinum."".$i."'>".$prinum."".$i."</option>";

	// }
	// echo"</select > <label>min</label><select id='parma101'  name='parma101' type='number' >";
    
 //    for ($j=1; $j < 60; $j++) { 

 //        if ($j>=0 and $j<10 ) {
 //        	$prinum1=0;
 //        }else{$prinum1="";}
        
	// 	echo"<option value='".$prinum1."".$j."'>".$prinum1."".$j."</option>";

	// }

	// echo"</td>
	// </tr>";



	// 	echo"<tr><td>Hora inicial:</td>
	//  <td><label>Hr</label><input id='param102' name='param102' >";

	// for ($i=1; $i < 24; $i++) { 
	// 	 if ($i>=0 and $i<10 ) {
 //        	$prinum=0;
 //        }else{
 //        	$prinum="";
 //        }
        
	// 	echo"<option value='".$prinum."".$i."'>".$prinum."".$i."</option>";

	// }
	// echo"</select ><label>min</label><select id='param103'  name='param103' type='number'>";
    
 //    for ($j=1; $j < 60; $j++) { 

 //        if ($j>=0 and $j<10 ) {
 //        	$prinum1=0;
 //        }else{$prinum1="";}
        
	// 	echo"<option value='".$prinum1."".$j."'>".$prinum1."".$j."</option>";

	// }

	// echo"</td>
	// </tr>";

	$FB->llena_texto("Cargar documento", 7, 6, $DB, "", "", "",1,0);
    $FB->llena_texto("param3",9, 13, $DB, "", "$operador", 0, 5, 0);
	

break;


case "Solicitudes":

?>
<script type="text/javascript">
$("#param4").hide();
$("#param5").hide();
</script>
<?php
$FB->llena_texto("Tipo de solicitud:",1, 82, $DB, $tiposoli, "cambio_ajax200(this.value, 200, \"llega_sub1\", \"param71\", 1, 0)", "", 2, 1);
echo"<tr><td>Fecha inicio</td><td><input type='hidden' id='param4' name='param4' ></td></tr>";
echo"<tr><td>Fecha fin</td><td><input type='hidden' id='param5' name='param5'></td></tr>";
$FB->llena_texto("Descripcion:",2,1, $DB, "", "", "", 1, 0);
// $FB->llena_texto("Fecha de solicitud:",3, 10, $DB, "", "", "$fechaactual", 2, 0);
// $FB->llena_texto("Fecha inicio:",3, 10, $DB, "", "", "$fechaactual", 2, 0);
// $FB->llena_texto("Fecha fin:",3, 10, $DB, "", "", "$fechaactual", 2, 0);



// $FB->llena_texto("Carpeta a Consultar:",70,2,$DB,"", "cambio_ajax200(this.value, 200, \"llega_sub1\", \"param71\", 1, 0)", "", 2, 0);
// $FB->llena_texto("Documento a Consultar:",71,"llega_sub1",$DB,"","","", 2, 0);

break;

case "cargaarchivo":

	$carpeta=$_GET['condecion'];

    $FB->llena_texto("Fecha de Ingreso:",2, 10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Descripcion:",1,1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Selecion el archivo a cargar:", 3,6, $DB, "llega_sub1", "", "",2,0);
	
	$FB->llena_texto("Proveedor:",93,2,$DB,"( SELECT `id_prove`, `nom_prove` FROM `proveedor`)", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$carpeta", 2, 0);
    // $FB->llena_texto("Proveedor:", 4, 82, $DB, $proveedores, "", "", 2, 1);
break;
case "cajamenor":


if($nivel_acceso==1){ $cond=""; }  else { $cond="and idsedes=$id_sedes"; }


$FB->llena_texto("Sede Origen:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  $cond )", "", "$id_sedes", 2, 1);
$FB->llena_texto("Sede Destino:",2,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "", "", 2, 1);
$FB->llena_texto("Tipo de transaccion:", 3, 82, $DB, $transaccion, "", "", 2, 1);
$FB->llena_texto("Descripcion:", 4,1, $DB, "", "", "", 1, 0);
$FB->llena_texto("Valor:",5, 118, $DB, "", "", "", 2, 1);
$FB->llena_texto("Imagen", 6, 6, $DB, "", "", "",1,0);

break;

case "Remesas":


if($nivel_acceso==1){ $cond=""; }  else { $cond="and idsedes=$id_sedes"; }

$FB->llena_texto("Sede Origen:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  $cond )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param7\", 1, 0)", "$id_sedes", 2, 1);
$FB->llena_texto("Sede Destino:",2,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "", "", 2, 1);
$FB->llena_texto("Empresa TR:",  3,1, $DB, "", "", "", 1, 0);
$FB->llena_texto("# BUS:", 4,1, $DB, "", "", "", 1, 0);
$FB->llena_texto("Tel Conductor:", 5,1, $DB, "", "", "", 1, 0);
$FB->llena_texto("Pagar en:", 6, 82, $DB, $sedecobra, "", "", 2, 1);
if($nivel_acceso==3){
	$operador=$id_usuario=$_SESSION['usuario_id'];
	$FB->llena_texto("param7", 1, 13, $DB, "", "","$operador", 5, 0);
}else {
	$FB->llena_texto("Operario Remesa:", 7, 4, $DB, "llega_sub1", "","",2,1);
}

$FB->llena_texto("Descripcion:", 8,1, $DB, "", "", "", 1, 0);
$FB->llena_texto("Peso:",9, 118, $DB, "", "", "", 2, 1);
$FB->llena_texto("Piezas:",10, 118, $DB, "", "", "", 2, 1);
$FB->llena_texto("Valor:",11, 118, $DB, "", "", "", 2, 1);
$FB->llena_texto("Imagen", 12, 6, $DB, "", "", "",1,0);
break;

case "rel_crecli": 

$FB->llena_texto("Credito:",1,2,$DB,"(SELECT `idcreditos`, `cre_nombre` FROM `creditos`  ORDER BY cre_nombre)","","",2,1);
$FB->llena_texto("Tel Cliente:",2, 1, $DB, "", "", "",2,1);
echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarcliente(25);'  >Buscar Cliente</button></td></tr>";

$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);
break; 
case "Abonos": 

	
	$FB->llena_texto("Busqueda por:",3,82,$DB,$busqueda3,"",$param1,1,1);
	$FB->llena_texto("Numero",2, 1, $DB, "", "", "",2,1);
	echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(26);'  >Buscar </button></td></tr>";
	
	$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);
	break; 
case "Ciudad": 
	$FB->llena_texto("Departamento:",1,2,$DB,"(SELECT iddepartamentos, dep_nombre FROM departamentos order by dep_nombre)","","",2,1);
	$FB->llena_texto("Nombre Ciudad:",2, 1, $DB, "", "", "",2,1);
	break; 

case "Guias":
$FB->llena_texto("Mensajero:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles WHERE idroles!=0 $cond_rol ORDER BY rol_nombre", "cambio2(this.value,\"nuevo_admin.php\",\"Usuario\")", "$param1", 2, 1);
break; 

case "Clientes":

$FB->llena_texto("CC / Nit:",1, 1, $DB, "", "", $rw[1], 1, 1);
$FB->llena_texto("Nombre Del Cliente:", 2, 1, $DB, "", "", $rw[6], 1, 0);
$FB->llena_texto("Tel&eacute;fonos :",3, 121, $DB, "", "", $rw[2], 1, 1);
$FB->llena_texto("Ciudad Origen:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`)", "", "$param4", 1, 1);

	echo "<tr bgcolor='#FFFFFF' ><td>Direcci&oacute;n:</td>
	<td align='left' ><select class='trans'  name='param5' id='param5' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();'>
	</td></tr>
	";

	echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Recogida:</td>
	<td align='left' ><select class='trans'  name='param19' id='param19' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();'>
	</td></tr>";

$FB->llena_texto("Email:", 6, 111, $DB, "", "", $rw[3], 1, 0);	
$FB->llena_texto("Clasificaci&oacute;n:", 7, 213, $DB, "", "3",$rw[7], 1, 0);	

break; 

case "Usuario":

$FB->llena_texto("Rol:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles WHERE idroles!=0 $cond_rol ORDER BY rol_nombre", "cambio2(this.value,\"nuevo_admin.php\",\"Usuario\")", "$param1", 2, 1);
$FB->llena_texto("Nombre:",2, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Usuario:",3, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Contrase&ntilde;a:", 4, 3, $DB, "", "", "", 2, 1);
$FB->llena_texto("Email:", 5, 111, $DB, "", "", "", 2, 0);
$FB->llena_texto("Tipo De Identificaci&oacute:",6,2,$DB,"(SELECT iddocumento, tip_nombre FROM tipodocumento  ORDER BY iddocumento)", "", "", 2, 1);
$FB->llena_texto("Identificaci&oacute;n:",7, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Genero:", 8, 8, $DB, $sexo, "", "", 4, 1);

if($param1==6){
	$FB->llena_texto("param9", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("Cliente Credito:",10,2,$DB,"(SELECT `idcreditos`, `cre_nombre` FROM `creditos` )", "", "", 2, 1);
	$FB->llena_texto("Celular Vinculado al Cliente:", 11, 1, $DB, "", "", "", 2, 1);
	$FB->llena_texto("param12", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param13", 1, 13, $DB, "", "Cliente", 0, 5, 0);
	
 }else {
	// $FB->llena_texto("Fecha de nacimiento:", 9, 10, $DB, "", "", "", 2, 0);
	// $FB->llena_texto("Empresa:",10,2,$DB,"(SELECT empre_id, empre_nombre FROM empresa  ORDER BY empre_nombre)", "", "", 2, 1);
	// $FB->llena_texto("Sede de Trabajo:",10,2,$DB,"(SELECT idsedes, sed_nombre FROM sedes  ORDER BY sed_nombre)", "", "", 2, 1);
	
	$FB->llena_texto("Empresa:",10,2,$DB,"( SELECT `empre_id`, `empre_nombre` FROM `empresa`)", "cambio_ajax2(this.value, 101, \"llega_sub1\", \"param71\", 1, 0)", "", 2, 0);
	$FB->llena_texto("Sede de Trabajo:",71,4,$DB,"llega_sub1","","", 2, 0);
	// $FB->llena_texto("Tel&eacute;fono:", 11, 1, $DB, "", "", "", 2, 0);
	$FB->llena_texto("Celular:", 12, 1, $DB, "", "", "", 2, 0);
	// $FB->llena_texto("Profesi&oacute;n:", 13, 1, $DB, "", "", "", 2, 0);
}
 

if($param1==3){
$FB->llena_texto("Tipo de Operador:",18,82, $DB, $vehiculo, "", "", 2, 0);
$FB->llena_texto("Vehiculo:",19,2,$DB,"(SELECT `idvehiculos`, concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as vehiculo FROM vehiculos where veh_estado=1)", "", "", 2, 0);
$FB->llena_texto("Tipo licencia:", 20, 82, $DB, $tipolicencia, "", "", 4, 1);
$FB->llena_texto("Fecha de Vencimiento:", 21, 10, $DB, "", "", "", 2, 0);

}else {
	$FB->llena_texto("param18", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param19", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param20", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param21", 1, 13, $DB, "", "$fechaactual", 0, 5, 0);

}
if($param1!=6){
	// $FB->llena_texto("Tipo de Contrato:",22,82, $DB, $tipocontrato, "", "", 2, 0);
    $FB->llena_texto("Profesional acargo:",24,2,$DB,"(SELECT `idusuarios`, usu_nombre FROM usuarios where roles_idroles='13')", "", "", 2, 0);

}else{
	$FB->llena_texto("param22", 1, 13, $DB, "", "Cliente", 0, 5, 0);
}

$FB->llena_texto("Estado:", 14, 82, $DB, $estado_pro, "", "Activo", 4, 1);
// $FB->llena_texto("Firma/huella:", 15, 6, $DB, "", "", "",2, 0);	
// $FB->llena_texto("Foto:", 17, 6, $DB, "", "", "",2, 0);

break;
case "Vehiculos":

	$FB->llena_texto("Tipo Vehiculo:",1,82,$DB,$tipovehiculo,"","$param1",1,0);
	$FB->llena_texto("Marca:",2, 1, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Placa:",3, 1, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Modelo:",4, 1, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Color:",16, 1, $DB, "", "", "", 2, 1);			
	$FB->llena_texto("Tipo:",17, 1, $DB, "", "", "", 2, 1);			
	$FB->llena_texto("Due&ntilde;o:",5,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE (usu_estado=1 or usu_filtro=1) and roles_idroles in (1,3)", "", $param5, 1, 0);
	$FB->llena_texto("Fecha de Seguro(SOAT):", 6, 10, $DB, "", "", "", 2, 0);
	$FB->llena_texto("Foto Seguro:",21, 6, $DB, "", "", "",2, 0);
	$FB->llena_texto("Fecha de Tecnomec&aacute;nica:", 7, 10, $DB, "", "", "", 2, 0);
	$FB->llena_texto("Foto Tecnomec&aacute;nica:", 22, 6, $DB, "", "", "",2, 0);	
	$FB->llena_texto("Fecha de CambioAceite:", 8, 10, $DB, "", "", "", 2, 0);
	$FB->llena_texto("Km actual:",9, 1, $DB, "", "", "", 2, 1);	
	$FB->llena_texto("Km CambioAceite:",10, 1, $DB, "", "", "", 2, 1);	
	$FB->llena_texto("No CHASIS:",12, 1, $DB, "", "", "", 2, 1);	
	$FB->llena_texto("No MOTOR:",13, 1, $DB, "", "", "", 2, 1);	
	$FB->llena_texto("No CILINDRAJE:",14, 1, $DB, "", "", "", 2, 1);	
	$FB->llena_texto("USO DEL VEH&Iacute;CULO:",15, 1, $DB, "", "", "", 2, 1);	
	$FB->llena_texto("Estado:", 11, 8, $DB, $estado_pro, "", "Activo", 4, 1);
	$FB->llena_texto("ESPECIFICACIONES T&Eacute;CNICAS:",18, 9, $DB, "", "", "", 2, 0);
	$FB->llena_texto("CARA SUPERIOR:", 19, 6, $DB, "", "", "",2, 0);	
	$FB->llena_texto("CARA INFERIOR:",20, 6, $DB, "", "", "",2, 0);
	
	break;
case "Tipos de Datos": 

$FB->llena_texto("Tipo de Dato:",1, 1, $DB, "", "", "",2,1);
$FB->llena_texto("Prefijo de visualizaci&oacute;n de informaci&oacute;n:",2, 1, $DB, "", "", "",2,0);
$FB->llena_texto("Sufijo de visualizaci&oacute;n de informaci&oacute;n:",3, 1, $DB, "", "", "",2,0);
$FB->llena_texto("Consulta la base de datos:",4, 8, $DB, $sino, "", "",2,0);

break; 

case "Parametro": 

$FB->llena_texto("Tipo de dato:",1,2,$DB,"SELECT idtiposindicadores, int_nombre FROM tiposindicadores ORDER BY int_nombre", 

"cambio_ajax2(this.value, 9, \"llega_sub1\", \"param4\", 1, 0)","",2,1);

$FB->llena_texto("C&oacute;digo:",2, 1, $DB, "", "", "",2,1);
$FB->llena_texto("Nombre del par&aacute;metro:",3, 9, $DB, "", "", "",2,1);
$FB->llena_texto("Descripci&oacute;n:", 4, 4, $DB, "llega_sub1", "", "",2,0);
$FB->llena_texto("Niveles de desagregaci&oacute;n:",5, 9, $DB, "", "", "",2,0);
$FB->llena_texto("param6",6, 13, $DB, "", "", "2",2,0);

break; 

case "Campo de Cabezote de formularios": 

$FB->llena_texto("Tipo de dato:",1,2,$DB,"SELECT idtiposindicadores, int_nombre FROM tiposindicadores ORDER BY int_nombre", 
"cambio_ajax2(this.value, 9, \"llega_sub1\", \"param4\", 1, 0)","",2,1);
$FB->llena_texto("Orden:",2, 40, $DB, "SELECT ind_codigo FROM indicadores ORDER BY ind_codigo", "", "",2,1);
$FB->llena_texto("Nombre del grupo poblaci&oacute;n o instituci&oacute;n al que se le aplicara el formulario:",3, 9, $DB, "", "", "",2,1);
$FB->llena_texto("Descripci&oacute;n:", 4, 4, $DB, "llega_sub1", "", "",2,0);
$FB->llena_texto("Niveles de desagregaci&oacute;n - se deben separar por punto y coma (;):",5, 9, $DB, "", "", "",2,0);
$FB->llena_texto("param6",6, 13, $DB, "", "", "1",2,0);

break; 



case "Tipo de documento":

$FB->llena_texto("Tipo de documento:",1, 1, $DB, "", "", "",2,1);

break; 


case "Documento":

$FB->llena_texto("param1", 1, 13, $DB, "", "", $_SESSION["id_proyecto"], 5, 0);
$FB->llena_texto("Tipo de documento:", 2, 2, $DB, "SELECT idtipodocumentos, tid_nombre FROM tipodocumentos ORDER BY tid_nombre ", "", "", 2, 1);
$FB->llena_texto("Contrato:", 3, 23, $DB, "SELECT idcontratosproyectos, ent_nombre, cop_contrato FROM contratosproyectos  INNER JOIN entidades ON entidades_identidades=identidades AND proyectos_idproyectos='".$_SESSION["id_proyecto"]."' ORDER BY cop_contrato ", "", "", 2, 1);
$FB->llena_texto("Nombre:",4, 1, $DB, "", "", "", 2, 1);
$FB->llena_texto("Fecha:",5, 10, $DB, "", "", "", 2, 1);
$FB->llena_texto("Versi&oacute;n:",6, 112, $DB, "", "", "", 2, 1);
$FB->llena_texto("Observaciones:",7, 9, $DB, "", "", "", 2, 0);
$FB->llena_texto("Documento:", 8, 6, $DB, "", "", "", 2, 1);

break; 

case "Formulario": 

$FB->llena_texto("L&iacute;nea estrat&eacute;gica:",1,2,$DB,"SELECT idprogramas, prg_alias FROM programas ORDER BY prg_codigo","cambio_ajax2(this.value,133,\"llega_sub1\",\"param2\",3,0);","",2,1);
$FB->llena_texto("Proyecto:", 2, 4, $DB, "llega_sub1", "", $rw[2],2,0);
$FB->llena_texto("Nombre del formulario:",3, 1, $DB, "", "", "",2,1);
$FB->llena_texto("Cabezote del formulario:", 4, 4, $DB, "llega_sub2", "", "",2,0);
$FB->llena_texto("Tipo de captura:", 5, 8, $DB, $tformato, "", "",2,1);

include("testform.php");

?>

<tr><td>Cuantas preguntas requiere:</td><td align="right"><select id="preg1" name="preg1" class='form-control' 

onChange="cambio_ajax2(this.value, 24, 'llpr', param5.value, 1, param2.value);">

<?php for($i=0; $i<47; $i++){ echo "<option value='$i'>$i</option>"; } ?>

</td></tr><tr><td colspan="2"><div id="llpr"></div></td></tr>

<?php

break; 

case "Base de datos/Conusulta": 

$FB->llena_texto("L&iacute;nea estrat&eacute;gica:",1,2,$DB,"SELECT idprogramas, prg_alias FROM programas ORDER BY prg_codigo","cambio_ajax2(this.value,133,\"llega_sub1\",\"param2\",3,0);","",2,1);
$FB->llena_texto("Proyecto:", 2, 4, $DB, "llega_sub1", "", $rw[2],2,0);
$FB->llena_texto("Nombre del formulario:",3, 1, $DB, "", "", "",2,1);
$FB->llena_texto("Cabezote del formulario:", 4, 4, $DB, "llega_sub2", "", "",2,0);
$FB->llena_texto("Tipo de captura:", 5, 8, $DB, $tformato1, "", "",2,1);

?>

<tr><td>Cuantas preguntas requiere:</td><td align="right"><select id="preg1" name="preg1" class='form-control' 

onChange="cambio_ajax2(this.value,24,'llpr',param5.value,1,'');">

<?php for($i=0; $i<47; $i++){ echo "<option value='$i'>$i</option>"; } ?>

</td></tr><tr><td colspan="2"><div id="llpr"></div></td></tr>

<?php

break; 



} 

$FB->llena_texto("condecion", 1, 13, $DB, "", "","$condecion", 5, 0);
$FB->llena_texto("tabla", 1, 13, $DB, "", "", $tabla, 5, 0);
$FB->llena_texto("general", 1, 13, $DB, "", "", 0, 5, 0);
$FB->llena_texto("", 1, 14, $DB, "", "", 0, 1, 0);
$FB->cierra_form(); 

include("footer.php"); ?>

