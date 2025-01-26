<?php 
require("login_autentica.php"); 
include("layout.php");


$empresausu=$_SESSION['usu_idempresa'];

$FB->titulo_azul1("Roles",9,0,7);
$FB->abre_form("form1","","post");

if ($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==26 or $nivel_acceso==58 or $nivel_acceso==53) {
	$FB->llena_texto("Empresa:",3,2,$DB," SELECT `empre_id`, `empre_nombre` FROM `empresa`", "cambio3(1,1,this.value,\"adm_roles.php\",1);",$param3, 1, 0);

}else{

	$param3="";	
}
$FB->cierra_form(); $FB->cierra_form(); 

if($param3!="0" and $param3!=""){ $conde3=" AND rol_empresa='$param3' "; } else { $conde3="";} 
if($rcrear==1) { $FB->nuevo("Rol", $condecion, "configuracion.php?idmen=138"); }
// $FB->nuevoname("sub_rol", $condecion, "Asignar");
if($ord==1){ $ord="rol_nombre"; }
$FB->titulo_azul1("Empresa",1,0,5,"empre_nombre",$asc2); 
$FB->titulo_azul1("Rol",1,0,0,"rol_nombre",$asc2); 
$FB->titulo_azul1("Acciones",2,0,2,$param_edicion);
$sql="SELECT idroles, rol_nombre, empre_nombre FROM roles INNER JOIN empresa ON rol_empresa= empre_id where 1 $conde3 ORDER BY $ord $asc ";
// $LT->llenatabla($sql,2, "Rol",$condecion,"","","","","","", $param_edicion, $DB, $DB1);

 $DB->Execute($sql); 
$va=0; 
while($rw=mysqli_fetch_row($DB->Consulta_ID)){
	$va++; $p=$va%2; $id_p=$rw[0];
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	echo "<tr bgcolor='$color' class='text' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	    
	// echo"<td align='center'>$rw[12]</td>";
	echo "<td>$rw[2]</td>
	<td>$rw[1]</td>
	";
	// echo"<td align='center'>$rw[5]</td>";
	$DB->edites($id_p, "Rol", $param_edicion, $condecion);
	echo "</tr>";
}
include("footer.php"); ?>