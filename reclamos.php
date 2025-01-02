<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
$fechaactual=date("Y-m-d");
?>
<head>

	</head>
<body onLoad="llena_datos(0,<?php echo $nivel_acceso;?> , '', 'ASC'); 
 cambio_ajax2(<?php echo $id_sedes;?>, 16, 'llega_sub1', 'param33', 1, 0); 
">
<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
//	p1=document.getElementById('param31').value;
//	
	p1=0;
	p3=document.getElementById('param33').value;
	p4=document.getElementById('param34').value;
	//p5=document.getElementById('param35').value;

	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_reclamosxl.php?p1="+p1+"&p2="+p2+"&p4="+p4;
		location.href=destino;
	}
	else {
		destino="detalle_reclamos.php?param33="+p3+"&param34="+p4+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}


$(document).ready(function() {
    $('#datatable').DataTable();
} );
</script>
<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
 if($nivel_acceso==1 or $nivel_acceso==12){
	 
//	if($rcrear==1) { $FB->nuevoname("reclamos", $condecion, "Inasistencia"); }
}
if($rcrear==1) { $FB->nuevoname("reclamos", $condecion, "Ingrese el Reclamo"); }
$FB->titulo_azul1("Reclamos",9,0,5);  


//$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "", "$param35",1, 0);
$FB->llena_texto("Estado de Reclamo:", 34, 82, $DB, $estadoreclamo, "", "", 1, 0);
$FB->llena_texto("Tipo de Reclamo:",33,82, $DB, $tiporeclamo, "", "", 4, 0);

$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",1,0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");

?>