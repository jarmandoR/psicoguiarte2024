


<script type="text/javascript">
	
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

	function check1(param1,param2,param3){




    var ruta="param1="+param1+"&param2="+param2+"&param3="+param3;

    $.ajax({
    
    url: 'guardacheckroles.php',
    type: 'Post',
    data: ruta,
    }).done(function(res){
    

     // recarga(param1,param2,param3);

     // location.reload();
     alert("Se han actulizado los subroles")
 
    });
    // alert("ok");
   
}

function check2(param1,param2,param3){




    var ruta="param1="+param1+"&param2="+param2+"&param3="+param3;

    $.ajax({
    
    url: 'guardacheckcapaci.php',
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
$id_param=$_REQUEST["id_param"];
if(isset($_REQUEST["id_param"])){$id_param=$_REQUEST["id_param"];}

$FB->abre_form("form1","cambio_adminok.php","post");
$FB->titulo_azul1("Editar $tabla","2","0", 4); 

$tabla1=$tabla;
if($condecion=='general'){  $tabla='General'; }else {

$valores=$LT->devuelvecampos($tabla, 0, "");
//echo $valores[1];
$rw=$QL->select($valores[0], $valores[1], $valores[3], $id_param, $DB, $valores[7]);
}
?>
<body onLoad="
<?php 
switch ($tabla)
{
	case "Dependencia":
	echo "cambio_ajax2('$rw[1]', 11, 'llega_sub2', 'param4', 1, 0)";
	break;
	case "Campo de Cabezote de formularios":
	echo "cambio_ajax2('$rw[1]', 9, 'llega_sub1', 'param4', 1, '$rw[4]')";
	break;
	case "Parametro":
	echo "cambio_ajax2('$rw[1]', 9, 'llega_sub1', 'param4', 1, '$rw[4]')";
	break;
	case "Permiso":
	echo "cambio_ajax2('$rw[1]', 5, 'llega_sub1', 'param2', 1, '$rw[2]');  ";
	break;
	case "Usuario":
	echo "cambio_ajax2('$rw[12]', 1, 'llega_sub1', 'param13', 1, '0'); ";

	break;
	case "asignardinero":
	echo "cambio_ajax2('$rw[5]',15,'llega_sub1','param2',3,'$rw[1]'); ";
	break;
	case "transpasodinero":
	echo "cambio_ajax2('$rw[5]',15,'llega_sub1','param2',3,'$rw[1]'); ";
	break;
	case "deudaspro":
	echo "cambio_ajax2('$rw[5]',15,'llega_sub1','param2',3,'$rw[1]'); ";
	break;
	default:
	break;
}
?>">
<?php


switch ($tabla)
{
	case "General": 

//$sql1="Select * FROM $tabla1 where `id$tabla1`=$id_param";
// $sql1=devuelve_consulta($tabla1,$id_param,$DB); 
$sql1="Select * FROM $tabla1 where `id$tabla1`=$id_param";
$DB->Execute($sql1);  
$rw=mysqli_fetch_row($DB->Consulta_ID);
	$sql="SHOW COLUMNS FROM $tabla1";
$DB->Execute($sql); $va=1; $va2=0; 


	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		if($va2!=0){	
		$dato=explode("_",$rw1[0]);
		
		if($dato[0]=="val"){
			$FB->llena_texto("Valor $dato[1]:",$va2, 118, $DB, "", "", "$rw[$va2]",1, 1);
		}else if($dato[0]=="inner"){
			if($dato[2]!=''){
				$nombretable=$dato[1]."_".$dato[2];
			}else{
				$nombretable=$dato[1];
			}
			$FB->llena_texto("$dato[1]:",$va2,2,$DB,"(Select * FROM $nombretable ORDER BY 2)", "",$rw[$va2], 2, 1);
			
		}
		else {
			$FB->llena_texto("$dato[1]:",$va2, 1, $DB, "", "", "$rw[$va2]",1, 0);	
		}
		
		}
		$va2++;
	}
	$tabla=$tabla1;
	$condecion='general';
break;
	
case "Rol": 
echo "<div class='pull-left btn btn-default'><a href='adm_roles.php'><div style='color:#000'>Volver </div></a></div>";
$FB->llena_texto("Nombre Rol:", 200, 1, $DB, "", "", $rw[1], 2, 1);

$sql4="SELECT `idroles`, `rol_nombre` FROM `roles` where idroles='$id_param' ";
$DB1->Execute($sql4);
$rw7=mysqli_fetch_row($DB1->Consulta_ID);	

           // $FB->llena_texto("Nombre:",110, 1, $DB, "", "", "$rw7[1]", 1, 0);
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

//         $sql2="SELECT estado_subrol,id_subrol ,idrol_subrol FROM  `subrol` WHERE idrol_subrol='$id_param' and subrol_subrol = '$rw3[0]'";
//         $DB->Execute($sql2);
// 	    $rw6=mysqli_fetch_row($DB->Consulta_ID);



// if ($rw6[0]==1) {
// 	$FB->llena_texto("$rw3[1]","$rw3[0]", 5, $DB, "", "check1($rw3[0],$id_param,2)", "checked", 1, 0);
// }else{
//            $FB->llena_texto("$rw3[1]","$rw3[0]", 5, $DB, "", "check1($rw3[0],$id_param,2)", "", 1, 0);

//        }
//        }

break; 

case "Usuario": 

$sql2="SELECT usu_pass, usu_idempresa FROM  `usuarios` WHERE idusuarios='$id_param' ";
        $DB->Execute($sql2);
	    $rw11=mysqli_fetch_row($DB->Consulta_ID);
$traspass=md5($rw11[0]);

$FB->llena_texto("Rol:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles WHERE idroles!=0 $cond_rol ORDER BY rol_nombre", "", "$rw[1]", 2, 1);


$FB->llena_texto("Nombre:",2, 1, $DB, "", "", $rw[2], 2, 1);
$FB->llena_texto("Usuario:",3, 1, $DB, "", "", $rw[3], 2, 1);
// $FB->llena_texto("contre:",4, 3, $DB, "", "", $rw11[0], 2, 1);
// echo "<input name='' id='' value = '".$rw11[0]."' tip class='form-control' type='password' $req >";
$FB->llena_texto("Contrase&ntilde;a:", 4, 3, $DB, "", "",$traspass, 2, 1);
$FB->llena_texto("Email:", 5, 111, $DB, "", "", $rw[5], 2, 0);
$FB->llena_texto("Tipo De Identificaci&oacute:",6,2,$DB,"(SELECT iddocumento, tip_nombre FROM tipodocumento  ORDER BY iddocumento)", "",$rw[6], 2, 1);
$FB->llena_texto("Identificaci&oacute;n:",7, 1, $DB, "", "", $rw[7], 2, 1);
$FB->llena_texto("Genero:", 8, 8, $DB, $sexo, "", $rw[8], 4, 1);


if($rw[1]==6){
	$FB->llena_texto("param9", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param10", 1, 13, $DB, "", "1", 0, 5, 0);
	$FB->llena_texto("Cliente Credito:",23,2,$DB,"(SELECT `idcreditos`, `cre_nombre` FROM `creditos` )", "", $rw[20], 2, 1);
	$FB->llena_texto("Celular Vinculado al Cliente:", 11, 1, $DB, "", "", "$rw[11]", 2, 1);
	$FB->llena_texto("param12", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param13", 1, 13, $DB, "", "Cliente", 0, 5, 0);
 }else {
	
	// $FB->llena_texto("Fecha de nacimiento:", 9, 10, $DB, "", "", $rw[9], 2, 0);
	$FB->llena_texto("param23", 1, 13, $DB, "", "0", 0, 5, 0);
	$FB->llena_texto("Empresa:",71,2,$DB,"( SELECT `empre_id`, `empre_nombre` FROM `empresa`)", "cambio_ajax2(this.value, 101, \"llega_sub1\", \"param71\", 1, 0)", $rw11[1], 2, 0);
	// $FB->llena_texto("Sede de Trabajo:",71,4,$DB,"llega_sub1","",$rw[10], 2, 0);
	$FB->llena_texto("Sede de Trabajo:",10,2,$DB,"(SELECT idsedes, sed_nombre FROM sedes  ORDER BY sed_nombre)", "", $rw[10], 2, 1);
	// $FB->llena_texto("Tel&eacute;fono:", 11, 1, $DB, "", "", $rw[11], 2, 0);
	$FB->llena_texto("Celular:", 12, 1, $DB, "", "", $rw[12], 2, 0);
	// $FB->llena_texto("Profesi&oacute;n:", 13, 1, $DB, "", "", $rw[13], 2, 0);
}

if($rw[1]==3){
$FB->llena_texto("Tipo de Operador:",18,82, $DB, $vehiculo, "", $rw[14], 2, 0);
$FB->llena_texto("Vehiculo:",19,2,$DB,"(SELECT `idvehiculos`, concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as vehiculo FROM vehiculos where veh_estado=1)", "", "$rw[15]", 2, 0);
$FB->llena_texto("Tipo licencia: $rw[16]", 20, 82, $DB, $tipolicencia, "", "$rw[16]", 2, 1);
$FB->llena_texto("Fecha de Vencimiento:", 21, 10, $DB, "", "", "$rw[17]", 2, 0);
}else {
	$FB->llena_texto("param18", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param19", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param20", 1, 13, $DB, "", "", 0, 5, 0);
	$FB->llena_texto("param21", 1, 13, $DB, "", "$fechaactual", 0, 5, 0);
}
if($rw[19]==1){
	$estado=1;
}else{
	$estado=0;
}
if($rw[1]!=6){
	$FB->llena_texto("Tipo de Contrato:",22,82, $DB, $tipocontrato, "", "$rw[18]", 2, 0);
}else{
	$FB->llena_texto("param22", 1, 13, $DB, "", "Cliente", 0, 5, 0);
}

$FB->llena_texto("Estado:", 14, 82, $DB, $estado_pro, "",$estado, 4, 1);
// $FB->llena_texto("Firma/huella:", 15, 6, $DB, "", "", "",2, 0);
// $FB->llena_texto("Foto:", 16, 6, $DB,"" ,"", "",2, 0);



break;
case "Vehiculos":

	$FB->llena_texto("Tipo Vehiculo:",1,82,$DB,$tipovehiculo,"","$rw[1]",1,0);
	$FB->llena_texto("Marca:",2, 1, $DB, "", "", "$rw[2]", 2, 1);
	$FB->llena_texto("Placa:",3, 1, $DB, "", "", "$rw[3]", 2, 1);
	$FB->llena_texto("Modelo:",4, 1, $DB, "", "", "$rw[4]", 2, 1);
	$FB->llena_texto("Color:",12, 1, $DB, "", "", "$rw[12]", 2, 1);			
	$FB->llena_texto("Tipo:",13, 1, $DB, "", "", "$rw[13]", 2, 1);		
	$FB->llena_texto("Due&ntilde;o:",5,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE (usu_estado=1 or usu_filtro=1) and roles_idroles in (1,3)", "", "$rw[5]", 1, 1);
	$FB->llena_texto("Fecha de Seguro:", 6, 10, $DB, "", "", "$rw[6]", 2, 0);
	$FB->llena_texto("Foto Seguro:",21, 6, $DB, "", "", "",2, 0);
	$FB->llena_texto("Fecha de Tecnomec&aacute;nica:", 7, 10, $DB, "", "", "$rw[7]", 2, 0);
	$FB->llena_texto("Foto Tecnomec&aacute;nica:", 22, 6, $DB, "", "", "",2, 0);	
	$FB->llena_texto("Fecha de CambioAceite:", 8, 10, $DB, "", "", "$rw[8]", 2, 0);

	
	$FB->llena_texto("Km actual:",9, 1, $DB, "", "", "$rw[9]", 2, 1);	
	$FB->llena_texto("Km CambioAceite:",10, 1, $DB, "", "", "$rw[10]", 2, 1);	
	$FB->llena_texto("No CHASIS:",14, 1, $DB, "", "", "$rw[14]", 2, 1);	
	$FB->llena_texto("No MOTOR:",15, 1, $DB, "", "", "$rw[15]", 2, 1);	
	$FB->llena_texto("No CILINDRAJE:",16, 1, $DB, "", "", "$rw[16]", 2, 1);	
	$FB->llena_texto("USO DEL VEH&Iacute;CULO:",17, 1, $DB, "", "", "$rw[17]", 2, 1);	
	$FB->llena_texto("Estado:", 11, 8, $DB, $estado_pro, "", "Activo", 4, 1);
	$FB->llena_texto("ESPECIFICACIONES T&Eacute;CNICAS:",18, 9, $DB, "", "", "$rw[18]", 2, 0);
	$FB->llena_texto("CARA SUPERIOR:", 19, 6, $DB, "", "", "",2, 0);	
	$FB->llena_texto("CARA INFERIOR:",20, 6, $DB, "", "", "",2, 0);
	break;
case "Clientes":

$FB->llena_texto("CC / Nit:",1, 1, $DB, "", "", $rw[1], 1, 1);
$FB->llena_texto("Nombre Del Cliente:", 2, 1, $DB, "", "", $rw[2], 1, 0);
$FB->llena_texto("Tel&eacute;fonos :",3, 121, $DB, "", "", $rw[3], 1, 1);

$FB->llena_texto("Ciudad Origen:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`)", "", $rw[4], 1, 1);

@$direcc=explode("&",$rw[5]);
@$param5=$direcc[0];
@$param51=$direcc[1];
@$param19=$direcc[2];
@$param20=$direcc[3];

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

	
$FB->llena_texto("Email:", 6, 111, $DB, "", "", $rw[6], 1, 0);	
$FB->llena_texto("Clasificaci&oacute;n:", 7, 213, $DB, "", "3",$rw[7], 1, 0);	
//$FB->llena_texto("param6",6, 13, $DB, "", "", "2",2,0);

break; 

case "Pais": 
$FB->llena_texto("Nombre:",1, 1, $DB, "", "", $rw[1],2,1);
$FB->llena_texto("C&oacute;digo:",2, 1, $DB, "", "", $rw[2],2,1);
break; 
case "Region": 
$FB->llena_texto("Pa&iacute;s:",1,2,$DB,"(SELECT idpaises, pai_nombre FROM paises WHERE pai_nombre='COLOMBIA') UNION (SELECT idpaises, pai_nombre FROM paises WHERE pai_nombre!='COLOMBIA' ORDER BY pai_nombre)","",$rw[1],2,1);
$FB->llena_texto("Nombre regi&oacute;n:",2, 1, $DB, "", "", $rw[2],2,1);
break; 
case "Departamento":
$FB->llena_texto("Nombre departamento:",1, 1, $DB, "", "", $rw[1],2,1);
break;
case "Menu":
$FB->llena_texto("Nombre Men&uacute;:",1, 1, $DB, "", "", $rw[1],2,1);
$FB->llena_texto("URL destino:",2, 1, $DB, "", "", $rw[2],2,1);
$FB->llena_texto("Categor&iacute;a jer&aacute;rquica a la que pertenece?",3,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE (men_predecesor=0 or men_principal=1) ORDER BY men_predecesor, men_nombre","",$rw[3],2,0);
$FB->llena_texto("Orden:",4, 112, $DB, "", "", $rw[4], 2, 1);
$FB->llena_texto("Principal:", 5, 5, $DB, "", "", $rw[5], 2, 0);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
$FB->llena_texto("&Iacute;cono", 7, 6, $DB, $tabla, 1, $rw[0], 1, 0);
break; 
case "asignardinero":

$rw[2]=number_format($rw[2],0,".",".");
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$rw[5]", 2, 1);
$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
$FB->llena_texto("Fecha de Busqueda:", 3, 10, $DB, "", "", "$rw[3]", 2, 0);
$FB->llena_texto("Tipo de transaccion:", 4, 82, $DB, $transaccionoper, "", $rw[7], 2, 1);
$FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
break;

case "parametrizacion":

	$sql2="SELECT `parame_id`, `parme_nombre`, `parme_valor` FROM `parametrizables` WHERE  `parame_id`='$id_param'";
	$DB->Execute($sql2);
	$rw6=mysqli_fetch_row($DB->Consulta_ID);
	$idcargo =$rw6[0];	
	
    $FB->llena_texto("Nombre:",4, 1, $DB, "", "", "$rw6[1]", 2, 0);
	$FB->llena_texto("Valor:",5, 1, $DB, "", "", "$rw6[2]", 2, 0);
	break;
case "novedades":




$sql2="SELECT `novid`,`nov_tipo`,`nov_descripcion`,nov_estado, `nov_idusuario`,  `nov_fechadesde`, `nov_fechahasta`,`nov_quienregistro`,`nov_fechaingresonov`,`nov_quienregistro`,`nov_imagen`,`nov_fechadesde`,`nov_sede`,`nov_horainicio`,`nov_horafin` FROM  `novedades` WHERE `novid`='$id_param'";
			$DB->Execute($sql2);
			$rw6=mysqli_fetch_row($DB->Consulta_ID);
			$idcargo =$rw6[0];

// $sql="SELECT `novid`,`nov_tipo`,`nov_descripcion`,nov_estado, `nov_idusuario`,  `nov_fechadesde`, `nov_fechahasta`,`nov_quienregistro`,`nov_fechaingresonov`,`nov_quienregistro`,`nov_imagen` FROM `novedades` where nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal' $conde26 $conde27 $conde28 ORDER BY novid desc";
// $DB1->Execute($sql); $va=0;
// while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
// {}

$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$rw6[12]", 2, 1);
	$FB->llena_texto("Operario:", 2, 2, $DB, "(SELECT `idusuarios`,`usu_nombre` FROM usuarios )", "", "$rw6[4]",2,1);
	$FB->llena_texto("Tipo de novedad:",8,2,$DB,"(SELECT `novt_id`,`novt_nombre` FROM tipo_novedades )", "", "$rw6[1]", 2, 1);
	$FB->llena_texto("Descripcion:",20,1, $DB, "", "", "$rw6[2]", 1, 0);
	$FB->llena_texto("Fecha desde:", 5 ,10, $DB, "", "", "$rw6[5]", 2, 0);
	$FB->llena_texto("Fecha hasta:", 6, 10, $DB, "", "", "$rw6[6]", 2, 0);
    $FB->llena_texto("Hora inicial: (10:05)",101,1, $DB, "", "", "$rw6[13]", 1, 0);
    $FB->llena_texto("Hora final: (14:50)",111,1, $DB, "", "", "$rw6[14]", 1, 0);
    $FB->llena_texto("Cargar documento", 7, 6, $DB, "", "", "",1,0);

// $rw[2]=number_format($rw[2],0,".",".");
// $FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$rw[5]", 2, 1);
// $FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
// $FB->llena_texto("Fecha de Busqueda:", 3, 10, $DB, "", "", "$rw[3]", 2, 0);
// $FB->llena_texto("Tipo de transaccion:", 4, 82, $DB, $transaccionoper, "", $rw[7], 2, 1);
// $FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
// $FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
break;

case "Carpetasempresa":

$sql4="SELECT `carp_id`, `carp_nombre` FROM `carpetasdocumentos` where carp_id='$id_param' ";
$DB1->Execute($sql4);
$rw7=mysqli_fetch_row($DB1->Consulta_ID);	

           $FB->llena_texto("Nombre:",110, 1, $DB, "", "", "$rw7[1]", 1, 0);
           // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);

           // $FB->llena_texto("1:",1, 1, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("2:",1, 2, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("3:",1, 3, $DB, "", "", "", 1, 0);
           // $FB->llena_texto("4:",1, 4, $DB, "", "", "", 1, 0);
$sql3=" SELECT `idroles`, `rol_nombre` FROM `roles` ";


// $sql="SELECT `empre_id`, `empre_nombre`, `empre_descripcion`, `empre_per` FROM `documentos_empre` where nov_fechaingresonov >='$fechaactual' and nov_fechaingresonov <='$fechafinal' $conde26 $conde27 $conde28 ORDER BY novid desc";
$DB1->Execute($sql3); $va=0;
while($rw3=mysqli_fetch_row($DB1->Consulta_ID))
{

        $sql2="SELECT unicar_estado,unicar_id ,unicarp_idrol FROM  `unicarpetas` WHERE unicar_idcarpeta='$id_param' and unicarp_idrol = '$rw3[0]'";
        $DB->Execute($sql2);
	    $rw6=mysqli_fetch_row($DB->Consulta_ID);



if ($rw6[0]==1) {
	$FB->llena_texto("$rw3[1]","$rw3[0]", 5, $DB, "", "check($rw3[0],$id_param,2)", "checked", 1, 0);
}else{
           $FB->llena_texto("$rw3[1]","$rw3[0]", 5, $DB, "", "check($rw3[0],$id_param,2)", "", 1, 0);

       }
       }
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

case "documentosempre":
	
$carpeta=$_GET['condecion']; 

	$sql4="SELECT `empre_id`, `empre_nombre`, `empre_descripcion`, `empre_usuario`, `empre_carpeta` FROM `documentos_empre` where empre_id='$id_param' ";
	$DB1->Execute($sql4);
	$rw7=mysqli_fetch_row($DB1->Consulta_ID);	
	
			$FB->llena_texto("Descripcion:",111, 1, $DB, "", "", "$rw7[2]", 1, 0);	
			$FB->llena_texto("Nombre :",110, 1, $DB, "", "", "$rw7[1]", 1, 0);	
			$FB->llena_texto("Cargar documento nuevo", 7, 6, $DB, "", "", "",1,0);
		// $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);

		
break;
		

case "carpetascapacitacion":

$sql4="SELECT `capaci_id`, `capaci_nombre` FROM `capacitacion` where capaci_id='$id_param' ";
$DB1->Execute($sql4);
$rw7=mysqli_fetch_row($DB1->Consulta_ID);	

           $FB->llena_texto("Descripcion:",110, 1, $DB, "", "", "$rw7[1]", 1, 0);
           // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);
		

	break;

case "documentocapacitacion":


$sql3=" SELECT `idroles`, `rol_nombre` FROM `roles` ";

$DB1->Execute($sql3); $va=0;
while($rw3=mysqli_fetch_row($DB1->Consulta_ID))
{

       $sql2="SELECT unicapaci_estado,unicapaci_id ,unicapaci_idrol FROM  `unicapaci` WHERE unicapaci_iddocum='$id_param' and unicapaci_idrol = '$rw3[0]'";
        $DB->Execute($sql2);
	    $rw6=mysqli_fetch_row($DB->Consulta_ID);



if ($rw6[0]==1) {
	$FB->llena_texto("$rw3[1]","$rw3[0]", 5, $DB, "", "check2($rw3[0],$id_param,2)", "checked", 1, 0);
}else{
           $FB->llena_texto("$rw3[1]","$rw3[0]", 5, $DB, "", "check2($rw3[0],$id_param,2)", "", 1, 0);

       }
       }		

	break;



case "Carpetasreglamento":

$sql4="SELECT `carpregla_id`, `carpregla_nombre` FROM `carpetasregla` where carpregla_id='$id_param' ";
$DB1->Execute($sql4);
$rw7=mysqli_fetch_row($DB1->Consulta_ID);	

           $FB->llena_texto("Nombre:",110, 1, $DB, "", "", "$rw7[1]", 1, 0);
           // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);

           		

	break;

case "documentosreglamento":
	
	$carpeta=$_GET['condecion']; 
		
		$sql4="SELECT `regla_id`, `regla_nombre`, `regla_descrip`, `regla_usuario`, `regla_carpeta`, `regla_link` FROM `documentos_regla` where regla_id='$id_param' ";
		$DB1->Execute($sql4);
		$rw7=mysqli_fetch_row($DB1->Consulta_ID);	
			
			$FB->llena_texto("Descripcion:",111, 1, $DB, "", "", "$rw7[2]", 1, 0);	
			$FB->llena_texto("link:",112, 1, $DB, "", "", "$rw7[5]", 1, 0);
			$FB->llena_texto("Nombre :",110, 1, $DB, "", "", "$rw7[1]", 1, 0);	
			$FB->llena_texto("Cargar documento nuevo", 7, 6, $DB, "", "", "",1,0);
				// $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);
				
break;

case "Sedes":

	$sql4="SELECT `idsedes`, `sed_nombre`,`sed_telefono`,`sed_direccion` FROM `sedes` where idsedes='$id_param' ";
	$DB1->Execute($sql4);
	$rw7=mysqli_fetch_row($DB1->Consulta_ID);	
	
			$FB->llena_texto("Nombre:",113, 1, $DB, "", "", "$rw7[1]", 1, 0);
			$FB->llena_texto("Telefono:",112, 1, $DB, "", "", "$rw7[2]", 1, 0);
			$FB->llena_texto("Direccion :",110, 1, $DB, "", "", "$rw7[3]", 1, 0);	
			   // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);   
	
break;

case "empresa":

		$sql4="SELECT `empre_id`, `empre_nombre` FROM `empresa` where empre_id='$id_param' ";
		$DB1->Execute($sql4);
		$rw7=mysqli_fetch_row($DB1->Consulta_ID);	
		
				   $FB->llena_texto("Nombre:",110, 1, $DB, "", "", "$rw7[1]", 1, 0);
				   // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);
		
						   
		
		break;

case "proveedor":

		$sql4="SELECT `id_prove`, `nom_prove` FROM `proveedor` where id_prove='$id_param' ";
		$DB1->Execute($sql4);
		$rw7=mysqli_fetch_row($DB1->Consulta_ID);	
			
				   $FB->llena_texto("Nombre:",110, 1, $DB, "", "", "$rw7[1]", 1, 0);
					   // $FB->llena_texto("PERMISOS:",92,2,$DB,"( SELECT `idroles`, `rol_nombre` FROM `roles`)", "", "", 2, 1);
			
		break;		

case "transpasodinero":
if($nivel_acceso==1 or $nivel_acceso==5){

	$rw[2]=number_format($rw[2],0,".",".");
	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$rw[5]", 2, 1);
	$FB->llena_texto("Asignar a:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
	$FB->llena_texto("Fecha :", 3, 10, $DB, "", "", "$rw[3]", 2, 0);
	$FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
	$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
	$FB->llena_texto("Imagen", 6, 6, $DB, "", "", "",1,0);
	$FB->llena_texto("param4",1, 13, $DB, "", "", "Asignar Dinero",2,0);
}else{

	$rw[2]=number_format($rw[2],0,".",".");
$FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
$FB->llena_texto("Asignar a:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
$FB->llena_texto("Imagen", 6, 6, $DB, "", "", "",1,0);
$FB->llena_texto("param4",1, 13, $DB, "", "", "Asignar Dinero",2,0);

}



break;
case "reclamos":

		$FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$rw[2]", 2, 0);
		$FB->llena_texto("Tipo Reclamo:", 9, 82, $DB, $tiporeclamo, "", "$rw[4]", 2, 1);
		$FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "$rw[11]", 1, 0);
		$FB->llena_texto("telefono:", 5, 1, $DB, "", "", "$rw[12]", 1, 0);
		$FB->llena_texto("E-mail:", 6, 1, $DB, "", "", "$rw[13]", 1, 0);	
		$FB->llena_texto("Ciudad donde quiere recibir la notificacion:", 1, 1, $DB, "", "", "$rw[16]", 1, 1);
		$FB->llena_texto("Direccion donde quiere recibir la notificacion:",11, 1, $DB, "", "", "$rw[17]", 1, 1);
		$FB->llena_texto("Descripcion de Reclamo:", 7,9, $DB, "", "", "$rw[5]", 2, 0);
/* 		$FB->llena_texto("Numero De Guia Completo",2, 1, $DB, "", "", "$rw[9]",2,1);
		$FB->llena_texto("param10", 1, 13, $DB, "", "$rw[10]", 0, 5, 0);
		$FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);
		echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(29);'  >Validar Guia </button></td></tr>";	 */	
		$FB->llena_texto("Foto Guia", 8, 6, $DB, "", "", "",1,0);
	//	$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);

	break;

case "deudaspro":
$rw[2]=number_format($rw[2],0,".",".");
$rw[3] = date("Y-m-d", strtotime($rw[3]));
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where idciudades>0 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param2\", 1, 0)", "$rw[5]", 2, 1);
$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", $rw[1],2,1);
$FB->llena_texto("Fecha de Busqueda:", 3, 10, $DB, "", "",$rw[3], 2, 0);
$FB->llena_texto("Tipo de transaccion:", 4, 82, $DB, $deudaoper, "", $rw[7], 2, 1);
$FB->llena_texto("Valor:",5, 118, $DB, "", "", "$rw[2]", 2, 1);
$FB->llena_texto("Descripci&oacute;n:",6, 9, $DB, "", "", $rw[6], 2, 0);
$FB->llena_texto("Imagen", 7, 6, $DB, "", "", "",1,0);

break;

case "Precios": 
$FB->llena_texto("Ciudad Origen:",1,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades` ", "","$rw[1]",2,1);
$FB->llena_texto("Ciudad Destino:",2,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades` ", "","$rw[2]",2,1);
$FB->llena_texto("Precio Kilo:",3, 123, $DB, "", "", "$rw[3]", 2, 1);
$FB->llena_texto("Precio Adicional:",4, 123, $DB, "", "","$rw[4]",2,1);
break;
case "Precios credito": 
$FB->llena_texto("Credito:",1,2,$DB,"SELECT `idcreditos`, `cre_nombre` FROM `creditos` ", "","$rw[1]",2,1);
$FB->llena_texto("Ciudad Origen:",2,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades` ", "","$rw[2]",2,1);
$FB->llena_texto("Ciudad Destino:",3,2,$DB,"SELECT  `idciudades`, `ciu_nombre` FROM `ciudades` ", "","$rw[3]",2,1);
$FB->llena_texto("Precio Kilo:",4, 123, $DB, "", "", "$rw[4]", 2, 1);
$FB->llena_texto("Precio Adicional:",5, 123, $DB, "", "","$rw[5]",2,1);
$FB->llena_texto("Servicio:",6,279,$DB,"SELECT `idtiposervicio`, `tip_nom` FROM `tiposervicio`  ", "","$rw[6]",2,0);

break;
case "Permiso": 
$FB->llena_texto("Item del Men&uacute;:",1,2,$DB,"SELECT idmenu, men_nombre FROM menu WHERE idmenu='$rw[1]'", "",$rw[1],2,1);
$FB->llena_texto("Rol:",2,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","",$rw[2],2,1);
$FB->llena_texto("Crear:", 3, 5, $DB, "", "", $rw[3], 2, 0);
$FB->llena_texto("Editar:", 4, 5, $DB, "", "", $rw[4], 2, 0);
$FB->llena_texto("Eliminar:", 5, 5, $DB, "", "", $rw[5], 2, 0);
$FB->llena_texto("Visible en el men&uacute;:", 6, 5, $DB, "", "", $rw[6],2, 0);
break; 

case "Ciudad": 
$FB->llena_texto("Departamento:",1,2,$DB,"(SELECT iddepartamentos, dep_nombre FROM departamentos order by dep_nombre)","",$rw[1],2,1);
$FB->llena_texto("Nombre Ciudad:",2,1, $DB, "", "", $rw[2],2,1);
break; 


case "Tipos de Datos": 
$FB->llena_texto("Tipo de dato:",1, 1, $DB, "", "", $rw[1],2,1);
$FB->llena_texto("Prefijo de visualizaci&oacute;n de informaci&oacute;n:",2, 1, $DB, "", "", $rw[2],2,0);
$FB->llena_texto("Sufijo de visualizaci&oacute;n de informaci&oacute;n:",3, 1, $DB, "", "", $rw[3],2,0);
$FB->llena_texto("Consulta la base de datos:",4, 8, $DB, $sino, "", $rw[4],2,0);
break; 
case "Parametro": 
$FB->llena_texto("Tipo de dato:",1,2,$DB,"SELECT idtiposindicadores, int_nombre FROM tiposindicadores ORDER BY int_nombre", 
"cambio_ajax2(this.value, 9, \"llega_sub1\", \"param4\", 1, 0)",$rw[1],2,1);
$FB->llena_texto("C&oacute;digo:",2, 1, $DB, "", "", $rw[2],2,1);
$FB->llena_texto("Nombre del Par&aacute;metro:",3, 9, $DB, "", "", $rw[3],2,1);
$FB->llena_texto("Descripci&oacute;n:", 4, 4, $DB, "llega_sub1", "", $rw[4],2,0);
$FB->llena_texto("Niveles de desagregaci&oacute;n:",5, 9, $DB, "", "", $rw[5],2,0);
$FB->llena_texto("param6",6, 13, $DB, "", "", "2",2,0);
break; 
case "Campo de Cabezote de formularios": 
$FB->llena_texto("Tipo de dato:",1,2,$DB,"SELECT idtiposindicadores, int_nombre FROM tiposindicadores ORDER BY int_nombre", 
"cambio_ajax2(this.value, 9, \"llega_sub1\", \"param4\", 1, 0)",$rw[1],2,1);
$FB->llena_texto("Orden:",2, 40, $DB, "SELECT ind_codigo FROM indicadores WHERE ind_codigo NOT IN ($rw[2]) ORDER BY ind_codigo", "", $rw[2],2,1);
$FB->llena_texto("Nombre del grupo poblaci&oacute;n o instituci&oacute;n al que se le aplicara el formulario:",3, 9, $DB, "", "", $rw[3],2,1);
$FB->llena_texto("Descripci&oacute;n:", 4, 4, $DB, "llega_sub1", "", $rw[4],2,0);
$FB->llena_texto("Niveles de desagregaci&oacute;n - se deben separar por punto y coma (;):",5, 9, $DB, "", "", $rw[5],2,0);
$FB->llena_texto("param6",6, 13, $DB, "", "", "1",2,0);
break; 

case "Documento":
$condecion=explode("_zzz_",$condecion);
$condecion=$condecion[0];
$FB->llena_texto("param1", 1, 13, $DB, "", "", $rw[1], 5, 0);
$FB->llena_texto("Tipo de documento:", 2, 2, $DB, "SELECT idtipodocumentos, tid_nombre FROM tipodocumentos ", "", $rw[2], 2, 1);
$FB->llena_texto("Contrato:", 3, 23, $DB, "SELECT idcontratosproyectos, ent_nombre, cop_contrato FROM contratosproyectos  INNER JOIN entidades ON entidades_identidades=identidades AND proyectos_idproyectos='".$_SESSION["id_proyecto"]."' ORDER BY cop_contrato ", "", $rw[3], 2, 1);
$FB->llena_texto("Nombre:",4, 1, $DB, "", "", $rw[4], 2, 1);
$FB->llena_texto("Fecha:",5, 10, $DB, "", "", $rw[5], 2, 1);
$FB->llena_texto("Versi&oacute;n:",6, 112, $DB, "", "", $rw[6], 2, 1);
$FB->llena_texto("Observaciones:",7, 9, $DB, "", "", $rw[7], 2, 0);
$FB->llena_texto("Documento:", 8, 6, $DB, $tabla, 1, $rw[0], 2, 0);
break; 

} 
$FB->llena_texto("condecion", 1, 13, $DB, "", "", $condecion, 5, 0);
$FB->llena_texto("tabla", 1, 13, $DB, "", "", $tabla, 5, 0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
  if($tabla== "documentocapacitacion"){
     
      }else{
      $FB->llena_texto("", 1, 14, $DB, "", "", 0, 1, 0);
	}
$FB->cierra_form(); 
include("footer.php"); ?>