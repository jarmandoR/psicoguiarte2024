<script>
	
function validarguia(des)
{
	var valorguia= document.getElementById("param16").value;
	var precio2= document.getElementById("precio").value;
	var credito=document.getElementsByName("param28");
	var aconvenir=document.getElementById("param34").value;
	var memory=credito[1].checked;
	//console.log('joeeeedddd'+aconvenir);
	var guia="";
	var trueorfalse;	
		datos = {"vlores":valorguia,"tipo":"1","idguia":"0"};
		$.ajax({
				url: "validarguia.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
					if(result!=null && result!=""){
						guia= result.ser_guiare;
						if(guia!=''){			
							trueorfalse=1;
						}else {
							trueorfalse=3;
						}
					}else {
						trueorfalse=3;
					}	
				}
			});

			if(precio2==0 && memory==false && aconvenir!='1000'){ 	
				$("#enviarmensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor2");
							divvalor.innerHTML="<strong>Atencion!</strong> NO HAY PRECIOS CONFIGURADOS PARA EL ENVIO DE ESTAS CIUDADES </BR> COMUNIQUESE CON EL ADMINISTRADOR GRACIAS!</a>";
							return false;
			}else if(memory==true){
				var combocredito = document.getElementById("param113");
				var nomcredito = combocredito.options[combocredito.selectedIndex].text;
				console.log(nomcredito);
				var tipocredito=document.getElementById("param34").value;
				var ciudadori=document.getElementById("param4").value;
				var ciudaddes=document.getElementById("param11").value;

				datos = {"tipoguia":"validaprecios","nomcredito":nomcredito,"tipocredito":tipocredito,"ciudadori":ciudadori,"ciudaddes":ciudaddes};
				$.ajax({
					url: "guiasok.php",
					type: "POST",
					data: datos,
					async: false,
					success: function(respuesta) {				
						if(respuesta==2){
								trueorfalse=2;
						}else{
								trueorfalse=3;
							}
					}
				});	
			}
			console.log('ok');
			console.log(memory);
			if(trueorfalse==1){
				$("#enviarmensaje").modal("show"); 
				var divvalor= document.getElementById("mensajevalor2");
				divvalor.innerHTML="<strong>Atencion!</strong> EL NUMERO DE GUIA YA EXISTE: "+guia+" VERIFIQUE!</a>";
				return false;
		
			}else if(trueorfalse==2){
				$("#enviarmensaje").modal("show"); 
					var divvalor= document.getElementById("mensajevalor2");
					divvalor.innerHTML="<strong>Atencion!</strong> NO HAY PRECIOS DE CREDITOS CONFIGURADOS PARA ESTAS OPCIONES. </BR> COMUNIQUESE CON EL ADMINISTRADOR GRACIAS!</a>";
					return false;
			}
			else {			
				
			 	if(memory==false){
				console.log('ok22');
				var teldestino=document.getElementById("param8").value;
				var telremitente=document.getElementById("param2").value;
				var ciudadori=document.getElementById("param4").value;
				var ciudaddes=document.getElementById("param11").value;

				datos = {"tipoguia":"validarrepetidas","teldestino":teldestino,"telremitente":telremitente,"ciudadori":ciudadori,"ciudaddes":ciudaddes};
				$.ajax({
					url: "guiasok.php",
					type: "POST",
					data: datos,
					async: false,
					success: function(respuesta) {				
						if(respuesta>0){
							 console.log('respuesta'.respuesta);
								idservicio=respuesta;
								trueorfalse=4;
						}else{
								trueorfalse=0;
							}
					}
				});	
			} 	
			 if(trueorfalse==4){
				
				pop_dis5(idservicio,"Recogidas");
				 setTimeout(function(){ 
						var mensaje="YA HAY UNA SERVICIO CON ESTE MISMO DESTINO, IDSERVICIO. "+idservicio+"  Desea Continuar?";
						var opcion =confirm(mensaje);
						if (opcion == true) {
							console.log('Trueeeeeeeeee');
							var submitFormFunction = Object.getPrototypeOf(form1).submit;
										submitFormFunction.call(form1);
							
							return true;
						} else {
							console.log('falseee');
							return false;
						}
					}, 4000);	 


				}else{
					return true;
				}
				
			}
		return false;
}


timer =0;
function testtimeout(nombres){
clearTimeout(timer);
imer =setTimeout(buscar(nombres),2000);
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
					//document. getElementById("param1").value='';
					cambio_ajax2(1, 14, 'clientesdir', 'telefono', 1, '');
					document. getElementById("id_param1").value=0;
					document. getElementById("param2").value='';
					document. getElementById("param3").value='';
					document. getElementById("param4").value='';
					document.getElementById("param5").value='0';
					document.getElementById("param51").value='';
					document.getElementById("param19").value='0';
					document.getElementById("param20").value='';
					document.getElementById("param23").value='';
					document.getElementById("param6").value='';
					//document.getElementById("0").checked = true;
					
					document. getElementById("id_param").value='0';		
				}
				else {
					cambio_ajax2(documento, 14, 'clientesdir', 'documento', 1, respuesta.cli_nombre);	
					//document. getElementById("param1").value=respuesta.cli_iddocumento;
					document. getElementById("param2").value=respuesta.cli_telefono;
					document. getElementById("param3").value=respuesta.cli_email;
					//document. getElementById("param4").value=respuesta.cli_idciudad	
					document. getElementById("param4").value='';

					var res = respuesta.cli_direccion.split("&");
					if (typeof res[4] === 'undefined') { res[4]=''; }
					document.getElementById("param5").value=res[0];
					document.getElementById("param51").value=res[1];
					document.getElementById("param19").value=res[2];
					document.getElementById("param20").value=res[3];
					document.getElementById("param23").value=res[4];					
					document. getElementById("param6").value=respuesta.cli_nombre;
					//document. getElementById(respuesta.cli_clasificacion).checked = true;
					document. getElementById("id_param2").value=respuesta.idclientesdir;					
					document. getElementById("id_param").value=respuesta.idclientes;
					document. getElementById("id_param1").value=1;
					 
				}

				buscarservicio(document.getElementById("param4").value,document.getElementById("param11").value,document.getElementById("param113").value,"oficina"); 


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
					if(document. getElementById("id_param1").value!=1){
					cambio_ajax2(1, 14, 'clientesdir', 'telefono', 1,'');
					}

					document.getElementById("id_param").value='0';
					document.getElementById("param3").value='';
					document.getElementById("param6").value='';
					document.getElementById("param4").value='';
					document.getElementById("param5").value=0;
					document.getElementById("param51").value='';
					//document.getElementById("0").checked = true;
					document.getElementById("param7").checked = false; 
					document.getElementById("param19").value=0; 
					document.getElementById("param20").value=''; 
					document.getElementById("param23").value=''; 
				}
				else {
					//document. getElementById("param1").value=respuesta.cli_iddocumento;
					//document. getElementById("param2").value=respuesta.cli_telefono;
					cambio_ajax2(documento, 14, 'clientesdir', 'telefono', 1, respuesta.cli_nombre);
					document. getElementById("param3").value=respuesta.cli_email;
					document. getElementById("param4").value=respuesta.cli_idciudad;
					//document. getElementById("param4").value='';

					 var res = respuesta.cli_direccion.split("&");
					 if (typeof res[4] === 'undefined') { res[4]=''; }
					document. getElementById("param5").value=res[0];
					document. getElementById("param51").value=res[1];
					document. getElementById("param19").value=res[2];
					document. getElementById("param20").value=res[3];
					document. getElementById("param23").value=res[4]; 
					//document. getElementById("param6").value=respuesta.cli_nombre;
					
					document. getElementById("id_param2").value=respuesta.idclientesdir;
					document. getElementById("id_param").value=respuesta.idclientes;	
					if(respuesta.cli_clasificacion!=null){
						//document. getElementById(respuesta.cli_clasificacion).checked = true;
					}
				}
				
				buscarservicio(document.getElementById("param4").value,document.getElementById("param11").value,document.getElementById("param113").value,"oficina"); 

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

					document. getElementById("param4").value=respuesta.cli_idciudad;
					//document. getElementById("param4").value='';
	 				var res = respuesta.cli_direccion.split("&");
					if (typeof res[4] === 'undefined') { res[4]=''; }
					document. getElementById("param5").value=res[0];
					document. getElementById("param51").value=res[1];
					document. getElementById("param19").value=res[2];
					document. getElementById("param20").value=res[3];
					document. getElementById("param23").value=res[4]; 
					document. getElementById("param6").value=respuesta.cli_nombre;
					document. getElementById("id_param2").value=respuesta.idclientesdir;
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
					document. getElementById("id_param0").value=0;
					}

				else {
					document. getElementById("param9").value=respuesta.cli_nombre;
					var res = respuesta.cli_direccion.split("&");
					if (typeof res[4] === 'undefined') { res[4]=''; }
					document. getElementById("param10").value=res[0];
					document. getElementById("param101").value=res[1];
					document. getElementById("param21").value=res[2];
					document. getElementById("param22").value=res[3];
					document. getElementById("param24").value=res[4];
					document. getElementById("param11").value=respuesta.cli_idciudad;
					//document. getElementById("param11").value='';
					document. getElementById("id_param0").value=respuesta.idclientesdir;
				}

				buscarservicio(document.getElementById("param4").value,document.getElementById("param11").value,document.getElementById("param113").value,"oficina"); 


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
					//document. getElementById("param11").value='';
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
				//document. getElementById("param11").value='';
				 document. getElementById("id_param0").value=respuesta.idclientesdir;
			 }

			 buscarservicio(document.getElementById("param4").value,document.getElementById("param11").value,document.getElementById("param13").value,"oficina"); 

		 });

 }

}

}; 

</script>

<script type="text/javascript">

$("#modalAdd").click(function() {
	$("form1").submit();
});

function submitform()
        {
		   //document.form1.submit();
		   //document.getElementById("form1").submit();
		   $("form1").submit();
		  // return true;
        }




		function buscar_ajax(cadena){

			var palabra = cadena;
			var d = palabra.search("documento");
			var p = palabra.search("papel");
			var s = palabra.search("sobre");

			var D = palabra.search("DOCUMENTO");
			var P = palabra.search("PAPEL");
			var S = palabra.search("SOBRE");

			var Do = palabra.search("Documento");
			var Pa = palabra.search("Papel");
			var So = palabra.search("Sobre");

			if (d > -1 ) 
			{
				var nuevapal = palabra.replace('documento', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;
			}else if(p> -1  )
			{
				var nuevapal = palabra.replace('papel', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;
			}
			else if (s > -1 )
			{
				var nuevapal = palabra.replace('sobre', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;

			}else if ( D > -1) 
			{
				var nuevapal = palabra.replace('DOCUMENTO', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;
			}else if(P> -1  )
			{
				var nuevapal = palabra.replace('PAPEL', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;
			}
			else if (S > -1)
			{
				var nuevapal = palabra.replace('SOBRE', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;

			}else if ( Do > -1) 
			{
				var nuevapal = palabra.replace('DOocumento', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;
			}else if(Pa> -1  )
			{
				var nuevapal = palabra.replace('Papel', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;
			}
			else if (So > -1)
			{
				var nuevapal = palabra.replace('Sobre', 'archivo');
				// alert(nuevapal);
				var inputNombre = document.getElementById("param13");
				inputNombre.value = nuevapal;

			}
		}
</script>
<?php 
 $variableunica=date("Y").date("m").date("d").date("h").date("i").date("s").$id_usuario;
$tcampod=1;
$tcampot=121;

if($estadofactura=='verificacion'){
	$tcampod=1;
	$tcampot=121;	
}

else if($estadofactura=='recoleccion'){
	$tcampod=117;
	$tcampot=120;	
}

@$param4=$rw[4];
// echo $id_usuario;
//if($param4==''){  $param4=$id_ciudad; }  




if($nivel_acceso!=1){  $cond6=" WHERE inner_sedes='$id_sedes' and inner_estados=1"; }  else { $cond6="WHERE  inner_estados=1"; }
//$FB->abre_form("form1","recolecciondatosok.php","post");

$validacion=$_GET['tabla'];


$sql1="SELECT `infig_id`, `infig_Fecha`, `infig_horaInicio`, `infig_horaFin`, `infig_encuentroN`, `infig_paciente`, `infig_objTra`, `infig_estrategia`, `infig_resumEncue`, `infig_firmaProf`, `infig_proxEncuen` FROM `informeGestion` WHERE infig_id='$validacion'";		
$DB1->Execute($sql1);
$rw2=mysqli_fetch_row($DB1->Consulta_ID);
$idusuario=$rw2[1];


// if ($_GET['tabla']==3) 
// {
	echo '<form action="recolecciondatosok.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validarguia(this);" >';
$FB->titulo_azul1("Informe de gestion",10,0, 5);  
$FB->llena_texto("Fecha",1, 10, $DB, "", "", $rw2[1], 1, 0);
$FB->llena_texto("Hora inicio:", 2, 1, $DB, "", "", $rw2[2], 1, 0);	
$FB->llena_texto("Hora fin :", 3, 1, $DB, "", "", $rw2[3], 1, 0);	
$FB->llena_texto("Encuentro #", 4, 1, $DB, "", "", $rw2[4], 1, 0);
$FB->llena_texto("Paciente:",5,2,$DB,"(SELECT `usu_identificacion`,`usu_nombre` FROM `usuarios` WHERE roles_idroles='28')", "buscarservicio(this.value,param11.value,param,param113.value,\"oficina\");", "$rw2[5]", 1, 0);


echo "<tr>";
echo "<td><label>Objetivos trabajados:</label></td>";
echo "<td><textarea name='param6' id='param6' value='' style='width:600px; height:150px; class='text' >".$rw2[6]."</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><label>Estrategia:</label></td>";
echo "<td><textarea name='param7' id='param7' value='' style='width:600px; height:150px; class='text' >".$rw2[7]."</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><label>Resumen del encuentro:</label></td>";
echo "<td><textarea name='param8' id='param8' value='' style='width:600px; height:150px; class='text' >".$rw2[8]."</textarea></td>";
echo "</tr>";
$FB->titulo_azul1("Confirmacion",9,0,5); 
$sql2 = "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE idusuarios='$id_usuario'";
		$DB1->Execute($sql2);
		$nombre = mysqli_fetch_row($DB1->Consulta_ID);
		
echo"<input type='hidden'id='param9' name='param9' value='".$id_usuario."' >";	
$FB->llena_texto("Firma profecional", 9, 1, $DB, "", "", $nombre[1], 1, 0);


$FB->llena_texto("Fecha proximo encuentro",10,10, $DB, "", "","$rw2[10]", 1, 0);
echo '</div></td></tr></table>';
// }else
// {
// 	echo '<form action="recolecciondatosok.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validarguia(this);" >';
// 	$FB->titulo_azul1("Informe de gestion",10,0, 5);  
// 	$FB->llena_texto("Fecha",1, 10, $DB, "", "", $rw[1], 1, 0);
// 	$FB->llena_texto("Hora inicio:", 2, 1, $DB, "", "", $rw[3], 1, 0);	
// 	$FB->llena_texto("Hora fin :", 3, 1, $DB, "", "", $rw[3], 1, 0);	
// 	$FB->llena_texto("Encuentro #", 4, 1, $DB, "", "", $param23, 1, 0);
// 	$FB->llena_texto("Paciente:",5,2,$DB,"(SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE roles_idroles='28')", "buscarservicio(this.value,param11.value,param,param113.value,\"oficina\");", "$param4", 1, 0);
	
	
// 	echo "<tr>";
// 	echo "<td><label>Objetivos trabajados:</label></td>";
// 	echo "<td><textarea name='param6' disabled id='param6' value='' style='width:600px; height:150px; class='text' ></textarea></td>";
// 	echo "</tr>";
// 	echo "<tr>";
// 	echo "<td><label>Estrategia:</label></td>";
// 	echo "<td><textarea name='param7' disabled id='param7' value='' style='width:600px; height:150px; class='text' ></textarea></td>";
// 	echo "</tr>";
// 	echo "<tr>";
// 	echo "<td><label>Resumen del encuentro:</label></td>";
// 	echo "<td><textarea name='param8' disabled id='param8' value='' style='width:600px; height:150px; class='text' ></textarea></td>";
// 	echo "</tr>";
// 	$FB->titulo_azul1("Confirmacion",9,0,5); 
// 	$FB->llena_texto("Firma profecional", 9, 1, $DB, "", "", $param24, 1, 0);	
// 	$FB->llena_texto("Fecha proximo encuentro",10,10, $DB, "", "","", 1, 0);
// 	echo '</div></td></tr></table>';
// }



?> 