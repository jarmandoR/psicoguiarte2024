<?php 
if(@$actuliza=="si"){
?>
 <script>


timer =0;
function testtimeout(nombres){
clearTimeout(timer);
timer =setTimeout(buscar(nombres),2000);
}



 function cambiar() {
	// alert(document.getElementById("param16").value);
	  if(document.getElementById("param16").value==''){
		 document.getElementById("param17").required=false; 
	  }
	 else {
		 document.getElementById("param17").required=true;
	 } 
	 
 }


 function buscar(nombre) {

 

 if(nombre=='param1'){
	var documento = $("input#param1").val();
	variable = documento.length; 
	var telefono = $("input#param2").val();
	variable2 = telefono.length; 

	if (variable >= 7) {
		datos = {"vlores":documento,"tipo":"documento"};
		
			
		$.ajax({
				url: "buscarclientes.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
				if (respuesta === null) {
					
					//console.log(JSON.stringify(respuesta));
					//document.getElementById("param1").value='';
					cambio_ajax2(1, 14, 'clientesdir', 'telefono', 1, '');
					
					document.getElementById("id_param1").value=0;
					document.getElementById("param2").value='';
					document.getElementById("param3").value='';
					document.getElementById("param4").value='';
					document.getElementById("param5").value='0';
					document.getElementById("param51").value='';
					document.getElementById("param19").value='0';
					document.getElementById("param20").value='';
					document.getElementById("param23").value='';
					document.getElementById("param6").value='';
					document.getElementById("0").checked = true;
					document.getElementById("id_param").value=0;
					document.getElementById("id_param1").value=0;
					document.getElementById("id_param2").value=0;
					
				}
				else {
					
					cambio_ajax2(documento, 14, 'clientesdir', 'documento', 1, respuesta.cli_nombre);
					
					//document.getElementById("param1").value=respuesta.cli_iddocumento;
					document.getElementById("param2").value=respuesta.cli_telefono;
					document.getElementById("param3").value=respuesta.cli_email;
					document.getElementById("param4").value=respuesta.cli_idciudad;
					var res = respuesta.cli_direccion.split("&");
					document.getElementById("param5").value=res[0];
					document.getElementById("param51").value=res[1];
					document.getElementById("param19").value=res[2];
					document.getElementById("param20").value=res[3];
					document.getElementById("param23").value=res[4];
					document.getElementById("param6").value=respuesta.cli_nombre;
					//document.getElementById(respuesta.cli_clasificacion).checked = true;
					document.getElementById("id_param2").value=respuesta.idclientesdir;					
					document.getElementById("id_param").value=respuesta.idclientes;
					document.getElementById("id_param1").value=1;
					 //document.getElementById('id_del_input').checked  document.form1.param7[7].value
				}
			});
					
	}	
	
 } else  if(nombre=='param2'){
	 
	 var telefono = $("input#param2").val();
	variable2 = telefono.length; 
	

	if (variable2 >= 7) {
		datos = {"vlores":telefono,"tipo":"telefono"};
	
		$.ajax({
				url: "buscarclientes.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
				if (respuesta === null) {
					
					if(document.getElementById("id_param1").value!=1){
					cambio_ajax2(1, 14, 'clientesdir', 'telefono', 1,'');
					}
					document.getElementById("id_param").value=0;
					//alert('mm');
					//document.getElementById("param2").value='';
					//document.getElementById("param1").value='';
					document.getElementById("param3").value='';
					document.getElementById("param6").value='';
					document.getElementById("param4").value='';
					document.getElementById("param5").value=0;
					document.getElementById("param51").value='';
					document.getElementById("0").checked = true;
					//document.getElementById("param7").checked = false; 
					document.getElementById("param19").value=0; 
					document.getElementById("param20").value=''; 
					document.getElementById("param23").value=''; 
					
					document.getElementById("id_param1").value=0;
					document.getElementById("id_param2").value=0;
				}
				else {
					//document.getElementById("param1").value=respuesta.cli_iddocumento;
					//document.getElementById("param2").value=respuesta.cli_telefono;
					
					cambio_ajax2(documento, 14, 'clientesdir', 'telefono', 1, respuesta.cli_nombre);
					
					document.getElementById("param3").value=respuesta.cli_email;
					document.getElementById("param4").value=respuesta.cli_idciudad;
					var res = respuesta.cli_direccion.split("&");
					//alert(res[0]);
					document.getElementById("param5").value=res[0];
					document.getElementById("param51").value=res[1];
					document.getElementById("param19").value=res[2];
					document.getElementById("param20").value=res[3];
					document.getElementById("param23").value=res[4];
					//document.getElementById("param6").value=respuesta.cli_nombre;

					document.getElementById("id_param2").value=respuesta.idclientesdir;
					document.getElementById("id_param").value=respuesta.idclientes;
					/* if(respuesta.cli_clasificacion!=null){
						document. getElementById(respuesta.cli_clasificacion).checked = true;
					} */
					
				}
			});
					
	}
 } else  if(nombre=='param6'){	
 
		var idclinte = document.getElementById("param61").value;

		datos = {"vlores":idclinte,"tipo":"cliente"};
	
		$.ajax({
				url: "buscarclientes.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
					document.getElementById("param4").value=respuesta.cli_idciudad;
					var res = respuesta.cli_direccion.split("&");
					document.getElementById("param5").value=res[0];
					document.getElementById("param51").value=res[1];
					document.getElementById("param19").value=res[2];
					document.getElementById("param20").value=res[3];
					document.getElementById("param23").value=res[4];
					document.getElementById("param6").value=respuesta.cli_nombre;
					document.getElementById("id_param2").value=respuesta.idclientesdir;
	
				
			});
  
 } else  if(nombre=='param8'){
	 
	 var telefono = $("input#param8").val();
	variable2 = telefono.length; 
	

	if (variable2 >= 7) {
		datos = {"vlores":telefono,"tipo":"telefono"};
		
		$.ajax({
				url: "buscarclientes.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
				if (respuesta === null) {
					
					document. getElementById("param9").value='';
					
					document. getElementById("param10").value=0;
					document. getElementById("param101").value='';
					document. getElementById("param21").value=0;
					document. getElementById("param22").value='';
					document. getElementById("param24").value='';
					document. getElementById("param11").value='';
					 var el = document.getElementById('cupo'); //se define la variable "el" igual a nuestro div
						el.style.display = 'none';
						
					}
				else {
					
					document.getElementById("id_param3").value=respuesta.idclientes;
					document.getElementById("param9").value=respuesta.cli_nombre;
					var   a = 0;
					   if (isNaN(parseInt(respuesta.cli_valorprestado))){ a=0; } else { a=parseInt(respuesta.cli_valorprestado);  }			 
					var  b = parseInt(respuesta.cli_valoraprobado);
					var disponible = b - a;
					var res = respuesta.cli_direccion.split("&");
					document.getElementById("param10").value=res[0];
					document.getElementById("param101").value=res[1];
					document.getElementById("param21").value=res[2];
					document.getElementById("param22").value=res[3];
					document.getElementById("param24").value=res[4];
					document.getElementById("param30").value=disponible;
					document.getElementById("param26").value=respuesta.cli_valoraprobado;
					document.getElementById("param11").value=respuesta.cli_idciudad;
					//document.getElementById("id_param2").value=respuesta.idclientesdir;
					if(disponible>0){
					
						var el = document.getElementById('cupo'); //se define la variable "el" igual a nuestro div
						el.style.display = (el.style.display == 'none') ? 'block' : 'none';
						el.innerHTML="<strong>Atencion!</strong> El cupo disponible para este Cliente es de: "+disponible+" y el valor aprobado es de: "+respuesta.cli_valoraprobado+"</a>";
					}else {
						
						 var el = document.getElementById('cupo'); //se define la variable "el" igual a nuestro div
							el.style.display = 'none';
					}
				}
			});
					
	}
	 
 } else  if(nombre=='param9'){	

var idclinte = document.getElementById("param71").value;
datos = {"vlores":idclinte,"tipo":"cliente"};
$.ajax({

		url: "buscarclientes.php",
		type: "POST",
		data: datos
	}).done(function(respuesta){

					cambio_ajax2(documento, 19, 'clientesdir2', 'documento', 1, respuesta.cli_nombre);
					var res = respuesta.cli_direccion.split("&");
					if (typeof res[4] === 'undefined') { res[4]=''; }
					document. getElementById("param10").value=res[0];
					document. getElementById("param101").value=res[1];
					document. getElementById("param21").value=res[2];
					document. getElementById("param22").value=res[3];
					document. getElementById("param24").value=res[4];
					document. getElementById("param11").value=respuesta.cli_idciudad;
					document. getElementById("id_param0").value=respuesta.idclientesdir;
				
	});

} 
 else  if(nombre=='param7'){

	var documento = $("input#param7").val();
	variable = documento.length; 
	var telefono = $("input#param8").val();
	variable2 = telefono.length; 

	if (variable >= 7) {
		datos = {"vlores":documento,"tipo":"documento"};

	 $.ajax({

			 url: "buscarclientes.php",
			 type: "POST",
			 data: datos

		 }).done(function(respuesta){

			 if (respuesta === null) {
				//cambio_ajax2(1, 19, 'clientesdir2', 'telefono', 1, '');
				 document. getElementById("param9").value='';
				 document. getElementById("param10").value=0;
				 document. getElementById("param101").value='';
				 document. getElementById("param21").value=0;
				 document. getElementById("param22").value='';
				 document. getElementById("param24").value='';
				 document. getElementById("param11").value='';
				 document. getElementById("id_param0").value=0;
			 }
			 else {
				cambio_ajax2(documento, 19, 'clientesdir2', 'documento', 1, respuesta.cli_nombre);
				document. getElementById("param8").value=respuesta.cli_telefono;
				 document. getElementById("param9").value=respuesta.cli_nombre;
				 var res = respuesta.cli_direccion.split("&");
				 if (typeof res[4] === 'undefined') { res[4]=''; }
				 document. getElementById("param10").value=res[0];
				 document. getElementById("param101").value=res[1];
				 document. getElementById("param21").value=res[2];
				 document. getElementById("param22").value=res[3];
				 document. getElementById("param24").value=res[4];
				 document. getElementById("param11").value=respuesta.cli_idciudad;
				 document. getElementById("id_param0").value=respuesta.idclientesdir;
			 }

		 });

 }

}
				
} 

</script>
<?php 
}
//include("cabezote1.php"); 
$tcampod=1;
$tcampot=121;
if(@$estadofactura=='verificacion'){
$tcampod=1;
$tcampot=121;	
}
else if(@$estadofactura=='recoleccion'){
	
$tcampod=117;
$tcampot=120;	
}
@$param4=$rw[4];
//if($param4==''){  $param4=$id_ciudad; }  
if($nivel_acceso!=1){  $cond6=" WHERE inner_sedes='$id_sedes'"; }  else { $cond6=""; }
//$FB->abre_form("form1","recoleccionok.php","post");
echo '<form action="recoleccionok.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validar_repuesta();" >';

$FB->titulo_azul1("Destinatario",9,0,5); 


$FB->llena_texto("CC / Nit:",7, $tcampod, $DB, "", "", $rw[7], 1, 0);
$FB->llena_texto("Tel&eacute;fono De Contacto:",8, $tcampot, $DB, "", "", $rw[8], 4, 1);
//$FB->llena_texto("Nombre Destinatario:",9, 1, $DB, "", "", $rw[9], 4, 1);

echo  "<tr bgcolor='#F3F3F3' ><td>Nombre:</td><td colspan=1><div id='clientesdir2'>";
echo ' <select class="trans"  name="param71"  id="param71" ><option  value=0>--Clientes--</option></select>';
echo " <input name='param9' id='param9' class='trans'  type='text' value='$rw[9]' onkeypress='return noenter();'>
</div></td>";

$FB->llena_texto("Ciudad:",11,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`)", "", "$rw[11]", 4, 1);

//$FB->llena_texto("Direccion del Contacto:",10, 1, $DB, "", "", $rw[10], 4, 1);

@$direcc2=explode("&",$rw[10]);
@$param10=$direcc2[0];
@$param101=$direcc2[1];
@$param21=$direcc2[2];
@$param22=$direcc2[3];
@$param24=$direcc2[4];

	echo "<tr bgcolor='#FFFFFF' ><td>Direcci&oacute;n del Contacto:</td>
	<td align='left' ><select class='trans'  name='param10' id='param10' >";
	echo "<option  value=''>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param10, $DB);

    echo "</select>
	<input name='param101' id='param101' class='trans'  type='text' value='$param101' onkeypress='return noenter();'>
	</td>";

	echo "<td>Lugar de Entrega:</td>
	<td align='left' ><select class='trans'  name='param21' id='param21' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param21, $DB);
    echo "</select>
	<input name='param22' id='param22' class='trans'  type='text' value='$param22' onkeypress='return noenter();'>
	</td></tr>
	";

$FB->llena_texto("Barrio:", 24, 1, $DB, "", "", $param24, 1, 0);		




$FB->titulo_azul1("Lugar de la Compra",10,0, 5); 

$FB->llena_texto("CC / Nit:",1, $tcampod, $DB, "", "", $rw[1], 1, 0);
$FB->llena_texto("Tel&eacute;fonos :",2, $tcampot, $DB, "", "", $rw[2], 4, 0);
//$FB->llena_texto("Nombre Del Cliente:", 6, 1, $DB, "", "", $rw[6], 1, 0);

	echo  "<tr bgcolor='#F3F3F3' ><td>Remitente:</td><td colspan=1><div id='clientesdir'>";
	echo ' <select class="trans"  name="param61"  id="param61" ><option  value=0>--Nuevo--</option></select>';
	echo " <input name='param6' id='param6' class='trans'  type='text' value='$rw[6]' onkeypress='return noenter();'>
	</div></td>";
	

$FB->llena_texto("Ciudad:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`)", "", "$param4", 4, 1);
//$FB->llena_texto("Direccion:",5, 1, $DB, "", "", $rw[5], 1, 0);

@$direcc=explode("&",$rw[5]);
@$param5=$direcc[0];
@$param51=$direcc[1];
@$param19=$direcc[2];
@$param20=$direcc[3];
@$param23=$direcc[4];

	echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Recogida:</td>
	<td align='left' ><select class='trans'  name='param5' id='param5' >";
	echo "<option  value=''>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();'>
	</td>";

	echo "<td></td>
	<td align='left' ><select class='trans'  name='param19' id='param19' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();'>
	</td>
	
	</tr>";

$FB->llena_texto("Barrio:", 23, 1, $DB, "", "", $param23, 17, 0);	
$FB->llena_texto("Hora de Recogida:", 14, 1, $DB, "", "", $rw[14], 4, 0);
$FB->llena_texto("Email:", 3, 111, $DB, "", "", $rw[3], 1, 0);	

$FB->titulo_azul1("Servicio",9,0,5); 

$FB->llena_texto("Tipo de paquete:",12,82, $DB, $paquete, "",@$rw[12], 1, 0);
$FB->llena_texto("Dice contener:",13, 1, $DB, "", "", $rw[13], 4, 0);
//$FB->llena_texto("Servicio:",15,82, $DB, $Servicio, "",@$rw[15],1, 1);

$FB->llena_texto("Valor de Prestamo:",16, 118, $DB, "", "", $rw[16],17, 0);
$FB->llena_texto("param30", 1, 13, $DB, "", "", "0", 5, 0); //valor disponible
$FB->llena_texto("param26", 1, 13, $DB, "", "", "0", 5, 0); //valor valor aprobado

if($id_sedes!=1 or $nivel_acceso==1){
	$FB->llena_texto("Abono:",17, 118, $DB, "", "", $rw[17],4,0);
}else{
	
	$FB->llena_texto("Abono:",29, 118, $DB, "", "", $rw[17], 4,2);
	$FB->llena_texto("param17", 1, 13, $DB, "", "", "$rw[17]", 5, 0); 
}
 if(@$rw[18]==''){
	$seguro='50000';
} else{
	$seguro=$rw[18];
}

$FB->llena_texto("Seguro:",18, 126, $DB, "", "50000", $seguro, 1, 1);
$FB->llena_texto("&iquest;Servicio con Retorno?:", 25, 212, $DB, "", "3","$rw[20]",4, 0);	
$valortservicio=0;
if($id_param!=''){

	 $sql21="select gui_tiposervicio from guias where gui_idservicio=$id_param";
	$DB->Execute($sql21);
	$valortservicio=$DB->recogedato(0);

	$sql5="SELECT `rel_nom_credito` FROM `rel_sercre` WHERE `idservicio`=$id_param";
	$DB->Execute($sql5);
	$nombrecredito=$DB->recogedato(0);
}

$FB->llena_texto("Tipo de Servicio:",27,279, $DB, "(SELECT `idtiposervicio`,`tip_nom` FROM `tiposervicio`)", "","$valortservicio", 1, 1);

if($rw[24]=='' or $rw[24]==NULL or $rw[24]==0){ $creditos=3; } else { $creditos=1; }
$FB->llena_texto("&iquest;Credito?:", 28, 216, $DB, "3","habilitarcredito(this.value,24,\"llega_sub2\",\"total valor\",1,0)", "$creditos", 4, 0);	
//$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);

echo "<td><div id='llega_sub2' >";
if($creditos==1){
	$FB->titulo_azul1("Credito	",8,0,5);  
	$FB->llena_texto("Cliente:",113,2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "", "$nombrecredito", 1, 1);
}
echo '</td></div>';


$FB->llena_texto("param15", 1, 13, $DB, "", "", "$param15", 5, 0); 
$FB->llena_texto("id_param", 1, 13, $DB, "", "", "$rw[0]", 5, 0); //idclientes
$FB->llena_texto("id_param3", 1, 13, $DB, "", "", "$rw[0]", 5, 0); //idclientes destinatarios
$FB->llena_texto("id_param0", 1, 13, $DB, "", "", "$rw[19]", 5, 0); //idservicio
$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "0", 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "$rw[21]", 5, 0); //idclientesdir
	
echo '<div id="cupo" class="alert alert-danger" style="display:none;"  > </div>';
$FB->cierra_tabla(); 

if($boton=='si'){
	$FB->llena_texto("", 1, 142, $DB, "Guardar", "", 0, 12, 0);
}
//echo "<a  onclick='verificar_datos()';  style='cursor: pointer;' class='btn btn-primary btn-lg' title='Recoger Paquete' role='button' >probarrr</a>";

?> 
<script>

function validar_repuesta(my_callback)
{
	var carga=0;
	var credito=document.getElementsByName("param28");
	var memory=credito[0].checked;
	//alert(credito);
	if(memory==true){
		var nomcredito=document.getElementById("param113").value;
		var tipocredito=document.getElementById("param27").value;
		var ciudadori=document.getElementById("param4").value;
		var ciudaddes=document.getElementById("param11").value;

		datos = {"tipoguia":"validaprecios","nomcredito":nomcredito,"tipocredito":tipocredito,"ciudadori":ciudadori,"ciudaddes":ciudaddes};
	$.ajax({
			url: "guiasok.php",
			type: "POST",
			data: datos
		}).done(function(respuesta){
			
			if(respuesta==2){
				 alert("No Tiene Precios de Creditos  configurados para estas opciones.");
				// my_callback(1); 
			}else{
				var valap= document.getElementById("param26").value;
					if(valap!=''){
								var valdis=document.getElementById("param30").value;
								var valor1=document.getElementById("param16").value;
								var valor2=document.getElementById("param17").value; 
								valor2=valor2.split('.').join('');
								var resvalor=valor1.split('.').join('');
								
								if (isNaN(parseInt(resvalor))){ valpres=0; } else { valpres=parseInt(resvalor);  }
								if (isNaN(parseInt(valor2))){ valabono=0; } else { valabono=parseInt(valor2);  }
								var saldofinal=valdis-valpres+valabono; 

							if(saldofinal<0){
									alert("No Tiene cupo disponible para este Cliente, su cupo es de: "+valdis+" y el valor aprobado es de: "+valap);

									var r = confirm("Desea continuar?");
									if (r == true) {
										submitFormFunction.call(form1);
									} else {
									//txt = "You pressed Cancel!";
									}

								}   else {
									var submitFormFunction = Object.getPrototypeOf(form1).submit;
									submitFormFunction.call(form1);
								}
					}
			}
	});
		

}else{

	var valap= document.getElementById("param26").value;
					if(valap!='' && valap>0){
								var valdis=document.getElementById("param30").value;
								var valor1=document.getElementById("param16").value;
								var valor2=document.getElementById("param17").value; 
								valor2=valor2.split('.').join('');
								var resvalor=valor1.split('.').join('');
								if (isNaN(parseInt(resvalor))){ valpres=0; } else { valpres=parseInt(resvalor);  }
								if (isNaN(parseInt(valor2))){ valabono=0; } else { valabono=parseInt(valor2);  }
								var saldofinal=valdis-valpres+valabono; 
							if(saldofinal<0){
									alert("No Tiene cupo disponible para este Cliente, su cupo es de: "+valdis+" y el valor aprobado es de: "+valap);
									var r = confirm("Desea continuar?");
									if (r == true) {
										submitFormFunction.call(form1);
									} else {
									//txt = "You pressed Cancel!";
									}
								}   else {
									var submitFormFunction = Object.getPrototypeOf(form1).submit;
									submitFormFunction.call(form1);
								}
					}else{
							var submitFormFunction = Object.getPrototypeOf(form1).submit;
							submitFormFunction.call(form1);
					}
}
 return false;

}

/* function validar_repuesta2(resp){
	alert(resp);
		if(resp==2){
			var submitFormFunction = Object.getPrototypeOf(form1).submit;
   			 submitFormFunction.call(form1);
			}
} */

	</script>