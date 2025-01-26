<?php 
require("login_autentica.php"); 
include("layout.php");

?>

<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param31').value;
	p2=document.getElementById('param32').value;
	//p5=document.getElementById('param35').value;
	p4=document.getElementById('param34').value;
	
	if(nivel==1){
	p5=document.getElementById('param35').value;
	}else{ p5=0; }
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_asignarx.php?p1="+p1+"&p2="+p2+"&p4="+p4;
		location.href=destino;
	}
	else {
		destino="detalle_asignar.php?param31="+p1+"&param32="+p2+"&param34="+p4+"&param35="+p5+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

  $(function () {
    $(document).on('change', '.borrar', function (event) {
		
		var valor = $(this).val();
		var descripcion=document.getElementById("des_"+$(this).attr('name')).value;
		var idservicio=document.getElementById("servicio_"+$(this).attr('name')).value;
		event.preventDefault();
		$(this).closest('tr').remove();
      	datos = {"tipoguia":"cancelar","servicio":idservicio,"descripcion":descripcion,"llego":valor};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				console.log(respuesta);
			});

    });
});

</script>
<body onLoad="llena_datos(0,<?php echo $nivel_acceso;?> , '', 'ASC'); ">
<?php 

$FB->titulo_azul1("Asignar Recogida",9,0,5);  
$FB->abre_form("form1","","post");
$posicion=1;

if($param35!=''){ $id_ciudad=$param35;  $conde2=" and cli_idciudad=$id_ciudad"; }   else {  $id_ciudad=0; }
if($nivel_acceso==1){
		$posicion=4;
	
$FB->llena_texto("Sede Origen:",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes  )", "", "$id_sedes", 17, 0);
}
else {
	
	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $conde2=" and  cli_idciudad in $idcidades "; 	
	}
	
}



$FB->llena_texto("Reasignar:",34,82,$DB,$reasignar,"",$param4,$posicion,0);
$FB->llena_texto("Busqueda por:",31,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 32, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",4,0);
echo "</table><table>";
$FB->div_valores("destino_vesr",6); 





include("footer.php");
?>