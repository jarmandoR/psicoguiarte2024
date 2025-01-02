<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
?>
<head>

	</head>
<body onLoad="llena_datos(0,<?php echo $nivel_acceso;?> , '', 'ASC'); 
 cambio_ajax2(0, 16, 'llega_sub1', 'param33', 1, <?php echo $param33;?>);
">
<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param31').value;
	p2=document.getElementById('param32').value;
	p3=document.getElementById('param33').value;
	p4=document.getElementById('param34').value;
	p5=document.getElementById('param35').value;
	p7=document.getElementById('param37').value;
	
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_recogerx.php?p1="+p1+"&p2="+p2+"&p4="+p4;
		location.href=destino;
	}
	else {
		destino="detalle_recoger.php?param31="+p1+"&param32="+p2+"&param33="+p3+"&param34="+p4+"&param35="+p5+"&param37="+p7+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

function buscarsede(dato)
{


	p3=document.getElementById('param33').value;
	p6=document.getElementById('param34').value;

	 if(dato==3){
		destino="ticketfacturatodos2.php?param33="+p3+"&param34="+p6;
	
	}
	else if(dato==4){
		destino="phpqrcode/ticket3.php?param33="+p3+"&param34="+p6+"&modulo=3";
	}

	

	window.location=destino;
	
}

</script>
<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Reporte Operadores",9,0,5);  
$FB->abre_form("form1","","post");


if($nivel_acceso==1 or $nivel_acceso==12){
	if($param35!=''){   $conde2=""; }  

}
else {	

	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}
$FB->llena_texto("Fecha de Busqueda:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param33\", 1, 0)", "$param35",4, 0);
$FB->llena_texto("Operario:", 33, 444, $DB, "llega_sub1", "", "",1,0);
$FB->llena_texto("Estado:",37,82,$DB,$estadosguias,"","$param37",4,0); 
$FB->llena_texto("Busqueda por:",31,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 32, 1, $DB, "", "","$param32", 4,0);

echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede(4);'>Imprimir Codigos</button></td>";
//echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede(3);'>Imprimir todas</button></td>";

$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",4,0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");
?>