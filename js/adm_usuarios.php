<?php 
require("login_autentica.php"); 
include("layout.php");

$empresausu=$_SESSION['usu_idempresa'];
$FB->titulo_azul1("Usuarios",9,0,7);  
$FB->abre_form("form1","","post");

if ($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==26 or $nivel_acceso==58 or $nivel_acceso==53) {
	$FB->llena_texto("Empresa:",3,2,$DB," SELECT `empre_id`, `empre_nombre` FROM `empresa`", "cambio3(param1.value,param2.value,this.value,\"adm_usuarios.php\",1);",$param3, 1, 0);

}else{

	$param3="";	
}

$FB->llena_texto("Roles:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","cambio3(this.value,param2.value,0,\"adm_usuarios.php\",1);",$param1,1,0);

// $FB->llena_texto("Roles:",1,2,$DB,"SELECT idsedes, sed_nombre FROM sedes ORDER BY sed_nombre","cambio3(this.value,param2.value,0,\"adm_usuarios.php\",1);",$param1,1,0);
$FB->llena_texto("Estado:",2,8,$DB,$estado_pro,"cambio3(param1.value,this.value,0,\"adm_usuarios.php\", 1);",$param2,1,0);

$FB->cierra_form(); 
if($rcrear==1) { $FB->nuevo("Usuario", $condecion, "configuracion.php?idmen=138"); } 
$FB->titulo_azul1("Rol",1,0,5); 
$FB->titulo_azul1("sede",1,0,0); 
$FB->titulo_azul1("Nombre",1,0,0); 
$FB->titulo_azul1("CC",1,100,0); 
$FB->titulo_azul1("Usuario",1,100,0); 
// $FB->titulo_azul1("Profesion",1,0,0); 
// $FB->titulo_azul1("Firma/Huella",1,0,0);
$FB->titulo_azul1("Foto",1,0,0);
$FB->titulo_azul1("Contrato",1,0,0);
$FB->titulo_azul1("Estado",1,0,0);
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
//echo $param2;
$conde1=""; if($param2!=""){ if($param2=="Activo") { $conde1=" AND usu_estado='1' "; } else { $conde1=" AND usu_estado='0' "; } }  
if($param1!="0" and $param1!=""){ $conde=" AND idroles='$param1' "; } else { $conde="";} 

if($param3!="0" and $param3!=""){ $conde3=" AND usu_idempresa='$param3' "; } else { $conde3="";} 
//if($param3!="0" and $param3!=""){ $conde2=" AND entidades_identidades IN (SELECT identidades FROM contratosproyectos INNER JOIN entidades ON entidades_identidades=identidades AND proyectos_idproyectos='$param3')"; } else { $conde2="";} 

$param3;
 //$sql="SELECT `idusuarios`, `rol_nombre` , `usu_nombre` , `usu_mail` , `usu_usuario` ,`usu_nivelacademico` ,`usu_identificacion` , `usu_estado` , `idroles`  FROM usuarios INNER JOIN roles ON roles_idroles=idroles and idusuarios!=1 $conde $conde1 $conde2 GROUP BY usu_nombre ORDER BY usu_nombre $asc ";
$sql="SELECT `idusuarios`, `rol_nombre` , `usu_nombre` , `usu_mail`, `usu_usuario` ,`usu_nivelacademico` ,`usu_identificacion`, `usu_estado` , `idroles`,`usu_tipocontrato`,`usu_filtro`, `usu_pass`, `sed_nombre` FROM usuarios INNER JOIN roles ON roles_idroles=idroles INNER JOIN sedes on usu_idsede=idsedes and idusuarios!=1 $conde $conde1 $conde2 $conde3 ORDER BY usu_nombre $asc";

 $DB->Execute($sql); 
$va=0; 
while($rw=mysqli_fetch_row($DB->Consulta_ID)){
	$va++; $p=$va%2; $id_p=$rw[0];
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	echo "<tr bgcolor='$color' class='text' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td onclick='pop_dis(\"$rw[3]\", \"Usuarios-Roles\");' style='cursor: pointer;' title='Haga click aqui para asignar roles al usuario'>$rw[1]</td>
	<td align='center'>$rw[12]</td>
	<td onclick='pop_dis2(\"$rw[0]\", \"Detalle Usuario\");' style='cursor: pointer;' title='Haga click aqui para detalles del usuario'>$rw[2]</td>";
    
	// echo"<td align='center'>$rw[12]</td>";
	echo "<td align='center'>$rw[6]</td>
	<td align='center'>$rw[4]</td>
	";
	// echo"<td align='center'>$rw[5]</td>";
	$sql1="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_p' AND doc_tabla='Usuario' and doc_version=1 ORDER BY doc_fecha DESC ";
	$DB1->Execute($sql1);
	$ruta=$DB1->recogedato(0);

	$sql1="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_p' AND doc_tabla='Usuario' and doc_version=2 ORDER BY doc_fecha DESC ";
	$DB1->Execute($sql1);
	@$firma=$DB1->recogedato(0);	

	
	echo "<td align='center'><a href='$ruta' target='_blank'><img src='$ruta' width='50'></a></td>";
	// echo"<td align='center'><a href='$firma' target='_blank'><img src='$firma' width='50'></a></td>";
	if($rw[9]==''){
		$rw[9]='Actualizar';
	}
	echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"tipocontrato\",\"$rw[9]\")';  title='contrato' >$rw[9]</td>";
	
	echo "<td><div id='inactivo$va'>"; if($rw[7]==1){ $st="Activo"; } else { $st="Inactivo"; } 
	echo "<select name='param14' id='param14' class='form-control' onChange='cambio_ajax2(this.value, 65, \"inactivo$va\", \"$va\", 1, $id_p)' required>";

	$LT->llenaselect_ar($st,$estado_pro);
	// echo "</select></div></td>";

	// echo "<td><div id='inactivo$va'>"; if($rw[10]==1){ $st="Activo"; } else { $st="Inactivo"; } 
	// echo "<select name='param15' id='param15' class='form-control' onChange='cambio_ajax2(this.value, 80, \"inactivo$va\", \"$va\", 1, $id_p)' required>";
	// $LT->llenaselect_ar($st,$estado_pro);
	echo "</select></div></td>";

	$DB->edites($id_p, "Usuario", $param_edicion, $condecion);
	echo "</tr>";
}
include("footer.php");
?>