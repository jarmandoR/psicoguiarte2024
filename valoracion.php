<?php 
require("login_autentica.php"); 
include("layout.php");

$FB->titulo_azul1("Valoracion Inicial",9,0,5);  
$FB->abre_form("form1","parejas.php","post");
$FB->nuevo7("historiaValoracion.php?condecion=Comportamiento&accion=1");

	if($param5!=''){  $conde2="and hoj_sede=$param5"; }  else { $conde2=""; }
$FB->llena_texto("Sede :",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$param5", 17, 0);
$FB->llena_texto("Paciente:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) and roles_idroles=28 $conde2", "", $param2, 4, 0);
$FB->llena_texto("Informe ICBF:",1,82,$DB,$tipocontrato,"",$param1,17,0);

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 



$FB->titulo_azul1("#",1,0,5); 
$FB->titulo_azul1("Nombre",1,0,0); 
$FB->titulo_azul1("Fecha ",1,0,0); 

$FB->titulo_azul1("Estado",1,0,0); 

$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
 $sql="SELECT id_valoracion, valo_nombre, valo_fecha FROM `valoraInicial` ORDER BY id_valoracion";


$DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
			
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		
		echo "
		<td>".$rw1[0]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>";	
		
		echo "<td><div id='inactivo$va'>"; 
		echo "<select name='param11' id='param11' class='form-control' onChange='cambio_ajax2(this.value,79, \"inactivo$va\", \"$va\", 1, $id_p)' required>";		
			
		$LT->llenaselect_ar22($rw1[22],$estadosac);
			echo "</select></div></td>";

		 $DB1->editar("historiaValoracion.php",$id_p, "historiaValoracion", 1,'Comportamiento');
	}




include("footer.php");

?>