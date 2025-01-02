<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 

$FB->titulo_azul1("Creditos",9,0,5);  
$FB->abre_form("form1","","post");
// $fechainicial=date("01/m/Y");
$fechados= date("d-m-Y",strtotime($fechaactual."- 2 week"));
?>
<script>
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	p3=document.getElementById('param3').value;	
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;

	if(ex==3){
		if(p3=='' || p3==null){
			alert('Por favor Seleccione un Cliente');
			exit;
		}
	}
	
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="creditos_excel.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		location.href=destino;
	}
	else if(ex==2){
		destino="detalle_facturascreditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		MostrarConsulta4(destino, "destino_vesr");
	}
	else if(ex==4){
		destino="creditos_excel.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		location.href=destino;
	}
	else {
		destino="detalle_creditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		MostrarConsulta4(destino, "destino_vesr");
	}
}



</script>
<?php 
	if($param4!=''){  $fechainicio=$param4;}
	if($param5!=''){  $fechaactual=$param5;}
	//echo $fechainicial;
	$FB->llena_texto("Fecha de Inicial:", 4, 10, $DB, "", "", "$fechainicio", 17, 0);
	$FB->llena_texto("Fecha de Final:", 5, 10, $DB, "", "", "$fechaactual", 4, 0);

$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("Cliente:",3, 2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "", "$param9",1,1);
$FB->llena_texto("Estado:",6,82,$DB,$estadofac,"","",1,0);
//$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
//$FB->llena_texto("Excel", 39, 150, $DB, "Exportar", "","llena_datos(1, $nivel_acceso, \"id_nombre\", \"ASC\");", 4, 0);
echo '<td align="right">Exportar a :<a href="#" onclick="llena_datos(1, 1, &quot;id_nombre&quot;, &quot;ASC&quot;);" target=""><img src="img/excel.jpg" width="30"></a></td>';
echo "<td><button type='button' class='btn btn-success' onclick='llena_datos(3, $nivel_acceso, \"id_nombre\", \"ASC\");'>Crear PRE-Factura</button></td></tr>";

echo "<tr><td><button type='button' class='btn btn-info' onclick='llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");'>Consultas Creditos</button></td>";
echo "<td><button type='button' class='btn btn-success' onclick='llena_datos(2, $nivel_acceso, \"id_nombre\", \"ASC\");'>Consultar Facturas</button></td></tr>";
//$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",1,0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");


?>