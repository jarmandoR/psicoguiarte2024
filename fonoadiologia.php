<?php
use Svg\Style;
require("login_autentica.php");
include("layout.php");
include("cabezote3.php");
@$accion = $_REQUEST["accion"];
$id_nombre = $_SESSION['usuario_nombre'];
$DB = new DB_mssql;
$DB->conectar();

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript">

  function enviar_formulario(){
      document. getElementById("param8").value='2';
       document.form1.submit()
    }

	function monedaChange(cif = 3, dec = 2) {



		// tomamos el valor que tiene el input
		let inputNum = document.getElementById('monedaInput').value

		let tdigitos = parseInt(inputNum.length);
		if (tdigitos >= 3) {
			// Lo convertimos en texto
			inputNum = inputNum.toString()
			// separamos en un array los valores antes y después del punto
			inputNum = inputNum.split('.')
			// evaluamos si existen decimales
			if (!inputNum[1]) {
				inputNum[1] = '00'
			}

			let separados
			// se calcula la longitud de la cadena
			if (inputNum[0].length > cif) {
				let uno = inputNum[0].length % cif
				if (uno === 0) {
					separados = []
				} else {
					separados = [inputNum[0].substring(0, uno)]
				}
				let posiciones = parseInt(inputNum[0].length / cif)
				for (let i = 0; i < posiciones; i++) {
					let pos = ((i * cif) + uno)
					console.log(uno, pos)
					separados.push(inputNum[0].substring(pos, (pos + 3)))
				}
			} else {
				separados = [inputNum[0]]
			}

			document.getElementById('monedaInput').value = '$' + separados.join(',') + '.' + inputNum[1]

		}
	};




	function buscar_ajax(cadena, id, tipo) {



		$.ajax({
			type: 'GET',
			url: 'calsueltotal.php',
			data: 'cadena=' + cadena + '&param21=' + id + '&tipo=' + tipo,
			success: function (respuesta) {
				//Copiamos el resultado en #mostrar
				$('#mostrar').html(respuesta);
			}
		});
	}

	function calcularauxilio(auxilio, id, tipo) {


		$.ajax({
			type: 'GET',
			url: 'calsueltotal.php',
			data: 'cadena=' + auxilio + '&param21=' + id + '&tipo=' + tipo,
			success: function (respuesta) {
				//Copiamos el resultado en #mostrar
				$('#mostrar').html(respuesta);
			}
		});

		var valorsueldo = document.getElementById("paramsueldo").value;

		var totalmonto = parseInt(valorsueldo) + parseInt(auxilio);



		var cuarentaporc = parseInt(totalmonto) * 40 / 100;

		if (auxilio > cuarentaporc) {

			alert("El monto total es: $" + totalmonto + ", el ingreso no constituyente supera el limite del 40% ¿desea continuar?");
		} else {


		}




	}


</script>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
	<!-- <script src="js/jquery-2.1.0.min.js"></script>
 -->
	<style>
		input[type="submit"] {
			background: #d81921;
			color: #fff;
			display: block;
			margin: 0 auto;
			padding: 10px 0;
			width: 200px;
			border: none;
			border-radius: .5rem;
		}

		span.spinner-border {
			position: absolute;
			top: 5px;
			left: 260px;
		}
	</style>
	<?php
	@$idPareja = $_REQUEST["idPareja"];
	@$id_param = $_REQUEST["id_param"];
	//echo $condecion;
	if ($idPareja == '') {
		$idPareja = $id_param;
	}

	if ($accion != 1) {




     $sql = "SELECT `idPareja`, `nombrePareja1`, `edadPareja1`, `ocupacionPareja1`, `nombrePareja2`, `edadPareja2`, `ocupacionPareja2`, `terapeutaPareja`, `superPareja`, `montivoPareja1`, `motivoPareja2`, `familiarPareja1`, `familarPareja2`, `parejaPareja1`, `parejaPareja2`, `socialPareja1`, `socialPareja2`, `estudioPareja1`, `estudioPareja2`, `saludPareja1`, `saludPareja2`, `espiritualidadPareja1`, `espiritualidadPareja2`, `ocioPareja1`, `ocioPareja2`, `afectacionPareja1`, `afectacionPareja2`, `problemaafectavinculo1`, `problemaafectavinculo2`, `problemasvinculodesc`,  `predisponentes1`, `predisponentes2`, `precipitantes1`, `precipitantes2`, `preFactoresvínculo`, `Condicionaclasico1`, `Condicionaclasico2`, `CondicionaVinculo`, `Condopera1`, `Condopera2`, `CondoperaVinculo`, `Modelamiento1`, `Modelamiento2`, `ModelamientoVinculo`, `instruccional1`, `instruccional2`, `instruccionalVinculo`, `Explicación1`, `Explicación2`, `ExplicaciónVínculo`, `Condicionamiento1`, `Condicionamiento2`, `CondicionamientoVinculo`, `Regulacion1`, `Regulacion2`, `RegulacionVinculo`, `ExplicacionMant1`, `ExplicacionMant2`, `ExplicacionMantVinculo`, `ObjetivosConsultante1`, `ObjetivosConsultante2`, `ObjetivosConsultanteVinculo`, `Recursos1`, `Recursos2`, `RecursosVinculo`, `CantidadSesiones1`, `CantidadSesiones2`, `CantidadSesionesVinculo`, `EstratejiaEva1`, `EstratejiaEva2`, `EstratejiaEvaVinculo` FROM `historiaPareja` WHERE idPareja='$idPareja'";


		$DB1->Execute($sql);
		$rw = mysqli_fetch_row($DB1->Consulta_ID);
		$id_sedes = $rw[2];

		$sql2 = "SELECT  `idcargo`, `car_Cargo`, `car_Salario`, `car_Auxilio`, `car_otros` FROM `cargo` WHERE idcargo='$rw[35]'";
		$DB->Execute($sql2);
		$cargosaldo = mysqli_fetch_row($DB->Consulta_ID);
		$cargosaldo[1];



		echo '<tr><td>
<div class="btn-group">';
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='fonoadiologia.php?condecion=datosfono&idPareja=$idPareja'\" >Datos</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='fonoadiologia.php?condecion=evaluacion&idPareja=$idPareja'\" >Resultados de evaluaciòn 1</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='fonoadiologia.php?condecion=segundaEvaluacion&idPareja=$idPareja'\" >Resultados de evaluaciòn 2</button>

		
		</button>";

	echo '
</div>
<tr><td>';


		$sles = "SELECT doc_ruta FROM documentos WHERE doc_tabla='hojadevida' AND doc_idviene='$rw[0]' and doc_version=1 ORDER BY doc_fecha DESC ";
		$DB1->Execute($sles);
		$rutafoto = $DB1->recogedato(0);

		$id_p = $rw[0];


		//echo $LT->llenadocs3($DB1, "referenciasfamiliares",$id_p, 1, 35, 'Ver');
	}


	//echo "wwwwwwwwwwwww".$rw[2];
	$FB->abre_form("form", "historiaParejasOK.php", "post");

	$FB->titulo_azul1("Fundaciòn Psicoguirte", 10, 0, 7);
	if ($rutafoto != '') {

		$edad = edad($rw[5]);

		echo "<tr><td><img src='imghojadevida/fotos/$rw[41]' class='img-circle' alt='User Image' style='background-color:#FF0000;width:80px;height:80px' /><td>
	<td>
	Nombre: $rw[2]" . "<br>" .
			"Edad: $edad
	</td>
	</tr>";

	}
	$condecion;
	switch ($condecion) {

		case "datosfono":    
        
        	
        	$FB->titulo_azul1("<h4>Anamnesis de lenguaje, habla, voz aprendizaje y procesos de alimentación.</h4>", 10, 0, 5);
			

			
			$FB->llena_texto("Fecha:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
			$FB->llena_texto("Nombre:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
			$FB->llena_texto("Fecha de nacimiento:", 3, 1, $DB, "", "", "$rw[3]", 1, 0);
            $FB->llena_texto("Edad cronologica:", 4, 1, $DB, "", "", "$rw[4]", 4, 0); 	
			$FB->llena_texto("Nombre del padre:", 5, 1, $DB, "", "", "$rw[5]", 1, 0);
			$FB->llena_texto("NOMBRE DE LA MADRE:", 6, 1, $DB, "", "", "$rw[6]", 4, 0);
			$FB->llena_texto("DIRECCION:", 7, 1, $DB, "", "", "$rw[7]", 1, 0);
			$FB->llena_texto("TELEFONO:", 8, 1, $DB, "", "", "$rw[8]", 4, 0);

            echo'</br>';

          			 
			echo '<td><label>MOTIVO DE CONSULTA:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>CONFORMACION FAMILIAR:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		   echo '</tr> ';
		   echo '<td><label>CUIDADOR DEL NIÑO(A):</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';


           $FB->titulo_azul1("<h5>Antecedentes prenatales.</h5> ", 10, 0, 5);	
            echo '</tr> ';		
			echo'</br>';
                   			 
			echo '<td><label>Familiares:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Gestación:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

           $FB->titulo_azul1("<h5>Antecedentes natales.</h5> ", 10, 0, 5);	
           echo '</tr> ';		
           echo'</br>';
           

           echo '<td><label>Parto:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Duración:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

           $FB->titulo_azul1("<h5>Antecedentes postnatales.</h5> ", 10, 0, 5);		
           echo '</tr> ';	
           echo'</br>';
          

           echo '<td><label>Lactancia:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Biberón:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';
           
           echo '</tr> ';
           echo '<td><label>Come toda textura de alimentos:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Desarrollo Motor:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

           echo '</tr> ';
           echo '<td><label>Desarrollo del lenguaje:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Enfermedades:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

           echo '</tr> ';
           echo '<td><label>Emocional:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Juego:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

           echo '</tr> ';
           echo '<td><label>Escolaridad:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Otros:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

           echo '</tr> ';
           echo '<td><label>En que ocupa su tiempo libre:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Independiente en AVD:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';
			
           echo '</tr> ';
           echo '<td><label>Que esperan de la terapia:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		    echo '<td><label>Recomendaciones:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';
		   
			$caso = 'evalucion';
			$FB->cierra_tabla();
		break;

		case "evaluacion":

			$FB->titulo_azul1("<h5>Resultados de evaluaciòn 1.</h5> ", 10, 0, 5);	
			$FB->llena_texto("Fecha:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
			$FB->llena_texto("Nombre:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
			$FB->llena_texto("Fecha de nacimiento:", 3, 1, $DB, "", "", "$rw[3]", 1, 0);
            $FB->llena_texto("Edad cronologica:", 4, 1, $DB, "", "", "$rw[4]", 4, 0); 

			$FB->titulo_azul1("<h5>Nivel de lenguaje:.</h5>", 10, 0, 5);
				
			$FB->llena_texto("Comprensivo:", 5, 1, $DB, "", "", "$rw[5]", 1, 0);
			$FB->llena_texto("Expresivo:", 6, 1, $DB, "", "", "$rw[6]", 4, 0);
			$FB->llena_texto("Juego simbolico:", 7, 1, $DB, "", "", "$rw[7]", 1, 0);

            
			$FB->titulo_azul1("<h5>Características de habla:.</h5>", 10, 0, 5);
				
			$FB->llena_texto("Espontanea:", 5, 1, $DB, "", "", "$rw[5]", 1, 0);
			$FB->llena_texto("Por repeticion:", 6, 1, $DB, "", "", "$rw[6]", 4, 0);
			echo '<td><label>Ritmo:</label></td>';
			$FB->llena_texto("Adecuada:", 45, 5, $DB, "", "", "$rw[44]", 1, 0);
			$FB->llena_texto("Inadecuada:", 46, 5, $DB, "", "", "$rw[45]", 4, 0);
			echo '<td><label>Fluidez:</label></td>';
			$FB->llena_texto("Adecuada:", 45, 5, $DB, "", "", "$rw[44]", 1, 0);
			$FB->llena_texto("Inadecuada:", 46, 5, $DB, "", "", "$rw[45]", 4, 0);
			echo '<td><label>Dislalias:</label></td>';
			$FB->llena_texto("Adecuada:", 45, 5, $DB, "", "", "$rw[44]", 1, 0);
			$FB->llena_texto("Inadecuada:", 46, 5, $DB, "", "", "$rw[45]", 4, 0);
     

			
           $FB->titulo_azul1("<h5>Características de voz.</h5> ", 10, 0, 5);		                

    		$FB->llena_texto("Tono:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
			$FB->llena_texto("Timbre:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
			$FB->llena_texto("Intensidad:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);

			$FB->titulo_azul1("<h5>características proceso lectoescrito.</h5> ", 10, 0, 5);		                
			echo '<td><label>Lectura:</label></td>';
    		$FB->llena_texto("Oral :", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
			$FB->llena_texto("Mental    :", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
			$FB->llena_texto("Comprension y analisis del Texto:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
			echo '</tr> ';
		   echo '<td><label>Observaciones:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		   echo '<td><label>Escritura:</label></td>';
		   $FB->llena_texto("Copia:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
		   $FB->llena_texto("Dictado:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
		   $FB->llena_texto("Espontanea:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
		   $FB->llena_texto("Redaccion:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
		   $FB->llena_texto("Calculo:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
		 
		   $FB->titulo_azul1("<h5>Dispositivos básicos de Aprendizaje.</h5> ", 10, 0, 5);	              
		   $FB->llena_texto("Memoria :", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
		   $FB->llena_texto("Concentracion:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
		   $FB->llena_texto("Atencion:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);		  
		  $FB->llena_texto("Praxias:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
		  $FB->llena_texto("Gnosias:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);

		  echo '<td><label>Audición:</label></td>';
    		$FB->llena_texto("examen :", 1, 1, $DB, "", "", "$rw[1]", 1, 0);
			echo '</tr> '; 	
			echo '<td><label>Observaciones:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';
 
			$FB->titulo_azul1("<h5>Fonoaudiológica.</h5> ", 10, 0, 5);	              
			echo '</tr> '; 	
			echo '<td><label>Recomendaciones:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>'; 	
			echo '</tr> '; 	
			echo '<td><label>Plan De Tratamiento:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';
            
			$caso = 'segundaEvaluacion';
			$FB->cierra_tabla();
		break;

		case "segundaEvaluacion":

			$FB->titulo_azul1("<h4> Informe  de  evolución.<h5> ", 10, 0, 5);
			$FB->llena_texto("Fecha:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 
			echo '</tr> '; 	
			echo '<td><label>Evoluciòn:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';
            
			$FB->llena_texto("Fecha:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 
			echo '</tr> '; 	
			echo '<td><label>Evoluciòn:</label></td>';		 
			echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';


				
			$caso = 'Amplitud';
			$FB->cierra_tabla();
			break;

		case "Amplitud":
           

			$FB->cierra_tabla();
			$caso = 'Coordinacion';
			break;
				

		case "sesiones":

			include('sesiones.php');

			$caso = '';


			$FB->cierra_tabla();

	}

	echo '
<input type="hidden" name="id_param" id="id_param" value="' . $id_param . '">
<input type="hidden" name="id_param0" id="id_param0" value="' . $rw[0] . '">
<input type="hidden" name="accion" id="accion" value="' . $accion . '">
<input type="hidden" name="condecion" id="condecion" value="' . $condecion . '">
<input type="hidden" name="idPareja" id="idPareja" value="' . $idPareja . '">
</table>';
	echo '</div>';


	echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'><input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='' 
	onClick='javascript:history.back();' value='Atras' style='width:190px;'>
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type=''  onclick=\"window.location='parejas.php?'\" value='Cerrar' style='width:190px;'>";
	if ($condecion != "sesiones") {
		echo "<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit'  name='enviar' value='Guardar-Siguiente' style='width:190px;' >";

	}
	echo "<span class='spinner-border' role='status' aria-hidden='true'></span>
	</td></tr>";

	echo '<div class="preloader-wrapper big active">
	<div class="spinner-layer spinner-red-only">
	  <div class="circle-clipper left">
		<div class="circle"></div>
	  </div>
	  <div class="gap-patch">
		<div class="circle"></div>
	  </div>
	  <div class="circle-clipper right">
		<div class="circle"></div>
	  </div>
	</div>
  </div>';

	include("footer.php");
	?>
	<button id="miBoton" onclick="marcarBoton()">Haz clic aquí</button>

	<script>
		function marcarBoton() {
			var boton = document.getElementById("miBoton");
			boton.classList.add("active");
		}
	</script>

	<style>
		button.active {
			background-color: blue;
			color: white;
		}
	</style>