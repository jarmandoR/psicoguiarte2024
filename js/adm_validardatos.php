<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
//echo $_SESSION['usuario_rol'];
$fechainicial=date('Y-m-01');
$fechainicial=date("Y-m-d",strtotime($fechainicial."- 3 month")); 
?>

<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param31').value;
	//if(document.getElementById('param2')){ p2=document.getElementById('param2').value; } else { p2=0;} 
	p2=document.getElementById('param32').value;
	p3=document.getElementById('param33').value;
	p4=document.getElementById('param34').value;
	
	if(nivel==1){
	p5=document.getElementById('param35').value;
	}else{ p5=0; }
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_validardatosx.php?p1="+p1+"&p2="+p2+"&p3="+p3;
		location.href=destino;
	}
	else {
		destino="detalle_validardatos.php?param31="+p1+"&param32="+p2+"&param33="+p3+"&param34="+p4+"&param35="+p5+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
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

//timer =setTimeout(mostrarAviso(),5000);
/* function mostrarAviso(){
	var obj = document.getElementById("submit");
	alert('jose');
	if (obj){
	   obj.click();   
	}
} */
</script>
<body onLoad="llena_datos(0,<?php echo $nivel_acceso;?> , '', 'ASC'); ">
<?php 

$FB->titulo_azul1("Validar Datos del Cliente",9,0,5);  
$FB->abre_form("form1","","post");


if($nivel_acceso==1){
	if($param35!=''){ $id_ciudad=$param35;  }  else {  $id_ciudad=""; }
$FB->llena_texto("Ciudad Origen:",35,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where idciudades>0 )", "", "$id_ciudad", 17, 0);
$FB->llena_texto("Fecha de inicio:", 33, 10, $DB, "", "", "$fechainicial", 17, 0);
$FB->llena_texto("Fecha de Final:", 34, 10, $DB, "", "", "$fechaactual", 4, 0);
}else {
   $FB->llena_texto("Fecha de inicio:", 33, 10, $DB, "", "", "$fechainicial", 17, 0);
   $FB->llena_texto("Fecha de Final:", 34, 10, $DB, "", "", "$fechaactual", 4, 0);
	
}

	

$FB->llena_texto("Busqueda por:",31,82,$DB,$busqueda,"",$param31,1,0);
$FB->llena_texto("Dato:", 32, 1, $DB, "", "","$param32", 4,0);
$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",4,0);
echo "</table><table>";
$FB->div_valores("destino_vesr",6); 




include("footer.php");
?>