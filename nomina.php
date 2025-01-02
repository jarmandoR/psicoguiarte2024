
<script type="text/javascript">
	
	function novalido(){

		alert("Valor no prmitido");

	}

	function buscarerror(cadena,id,tipo,campo){



		// var cadena = 'Hola Mundo”;
      var horas  =  cadena.substring(0,2); // Resulta “Ho”

	//   var horasn = Number(«17»); 
if(horas>=25){

	alert("Valor no permitido");
}

		}


	function buscar_ajax(tiempoactual,id,tipo,campo){

		var tiemponuevo	= document.getElementById(campo).value;
        // alert("Estas seguro que deseas cambiar "+tiempoactual+" por "+tiemponuevo);

		var motivo = prompt("¿deseas cambiar "+tiempoactual+" por "+tiemponuevo+ "? Escribe el motivo", "");



		

		if (motivo != null ){
        // alert("Tu mascota favorita es " + motivo);

			$.ajax({
					type: 'GET',
					url: 'cambiohoras.php',
					data: 'cadena=' + tiemponuevo+'&id=' + id+'&tipo=' + tipo+'&motivo=' + motivo,
					success: function(respuesta) {
						//Copiamos el resultado en #mostrar
						$('#mostrar').html(respuesta);
				}
				});


		}else {
			alert("Debes ingresar el motivo");


			}

	
	
	}

	

function holi(){
		alert("holi");
	}


	// function calcularauxilio(auxilio){

	// 	var valorsueldo = document.getElementById("paramsueldo").value;

	// 	var totalmonto=parseInt(valorsueldo)+parseInt(auxilio);

		

 //        var cuarentaporc=parseInt(totalmonto)*40/100;

 //        if (auxilio>cuarentaporc) {

 //        	alert("A sobrepasado el 40% del monto total que es "+totalmonto);
 //        }else{

        	
 //        }

	
	// }


</script>



<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
$fechaactual=date("Y-m-d");
$empresausu=$_SESSION['usu_idempresa'];
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
	// p2=document.getElementById('param32').value;
	p2=document.getElementById('param31').value;
	p3=document.getElementById('param33').value;
	p4=document.getElementById('param34').value;
	p5=document.getElementById('param35').value;
	p6=document.getElementById('param36').value;
	p7=document.getElementById('param37').value;
	p8=document.getElementById('param38').value;
	//p7=document.getElementById('param37').value;
	var pagina=0; 
	if(ordby=="undefined"){ ordby="usu_nombre"; }else{ordby="usu_nombre";}
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_nominaxl.php?p1="+p1+"&p2="+p2+"&p4="+p4;
		location.href=destino;
	}
	else {
		destino="detalle_nomina.php?param32="+p2+"&param33="+p3+"&param34="+p4+"&param35="+p5+"&param36="+p6+"&param37="+p7+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc+"&param38="+p8;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

</script>
<?php 


$FB->titulo_azul1("Nomina de Empleados",9,0,7);  


if($nivel_acceso==1 or $nivel_acceso==12){
	if($param35!=''){   $conde2=""; }  

}
else {	
	$param35=$id_sedes;
	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}
$ano=date('Y');
$mes=date('m');
$dia=date('d');

if($dia>=1 and $dia<=16){
	
$quincena1='Primera';
}else{
	$quincena1='Segunda';
}


if ($nivel_acceso==1 ) {
	// $FB->llena_texto("Empresa:",3,2,$DB," SELECT `empre_id`, `empre_nombre` FROM `empresa`", "cambio3(param1.value,param2.value,this.value,\"adm_usuarios.php\",1);",$param3, 1, 0);
	$param5="";
}else{

	$param5="and sed_empresa ='$empresausu'";	
}



if ($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==26 or $nivel_acceso==58 or $nivel_acceso==53) {

	$FB->llena_texto("Empresa:",31,500,$DB,"SELECT `empre_id`, `empre_nombre` FROM `empresa`", "cambioo(this.value)",$empresausu, 1, 0);

}else{

	$param31="";	
}

$FB->llena_texto("A&ntilde;o:",38, 82, $DB, $años, "", "$ano", 1, 0);
$FB->llena_texto("Mes:", 34, 82, $DB, $mesd, "", "$mes", 1, 0);
$FB->llena_texto("Quincena", 36, 82, $DB, $quincena, "", "$quincena1", 4, 0);

$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $param5 order by sed_nombre asc )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param33\", 1, 0)", "$param35",1, 0);
$FB->llena_texto("Empleado:", 33, 444, $DB, "llega_sub1", "", "",4,0);
// $FB->llena_texto("Motivo Ingreso:", 32, 82, $DB, $motivoingreso, "", "", 1, 0);
$FB->llena_texto("Tipo de Contrato:",37,82, $DB, $tipocontrato, "", "", 4, 0);

$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",1,0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 



include("footer.php");

?>