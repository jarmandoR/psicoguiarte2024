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
     $sql = "SELECT * FROM `valoraInicial` WHERE id_valoracion='$idPareja' ";

		$DB1->Execute($sql);
		$rw = mysqli_fetch_row($DB1->Consulta_ID);
		$id_sedes = $rw[2];

		$sql2 = "SELECT   `car_Cargo`, `car_Salario`, `car_Auxilio`, `car_otros` FROM `cargo` WHERE idcargo='$rw[35]'";
		$DB->Execute($sql2);
		$cargosaldo = mysqli_fetch_row($DB->Consulta_ID);
		$cargosaldo[1];



		echo '<tr><td>
<div class="btn-group">';
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=Comportamiento&idPareja=$idPareja'\" >Comportamiento</button>";
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=Conciencia&idPareja=$idPareja'\" >Conciencia</button>";
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=Orientación&idPareja=$idPareja'\" >Orientación</button>";
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=Lenguaje&idPareja=$idPareja'\" >Lenguaje </button>";
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=Afectivo&idPareja=$idPareja'\" >Estado Afectivo </button>";
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=Actitudes&idPareja=$idPareja'\" >Actitudes y Tenencias Dominantes</button>";
        echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=Memoria&idPareja=$idPareja'\" >Memoria y Sociables</button>";
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=expectativas&idPareja=$idPareja'\" >Intereses y expectativas proyecto de vida </button>";
        echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=riesgo&idPareja=$idPareja'\" >Situaciones de riesgo</button>";
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='historiaValoracion.php?condecion=Observaciones&idPareja=$idPareja'\" >Observaciones</button>";
	echo '
</div>
<tr><td>';

		$sles = "SELECT doc_ruta FROM documentos WHERE doc_tabla='hojadevida' AND doc_idviene='$rw[0]' and doc_version=1 ORDER BY doc_fecha DESC ";
		$DB1->Execute($sles);
		$rutafoto = $DB1->recogedato(0);

		$id_p = $rw[0];
	}

	$FB->abre_form("form", "historiaValoracionOK.php", "post");

	$FB->titulo_azul1("Historial de valoracion", 10, 0, 7);
	if ($rutafoto != '') {
	
	}

	switch ($condecion) {

		case "Comportamiento":            
        	
        	$FB->titulo_azul1("<h4>Descripción del consultante </h4> (Examen mental).", 10, 0, 5);
			$FB->titulo_azul1( "1.	Apariencia General - Comportamiento .", 10, 0, 5);
	
			if ($rw[1] > 0 and $nivel_acceso != 1) {
				$habi = 2;
			} else {
				$habi = 1;
			}
			$FB->llena_texto("Nombre:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
			$FB->llena_texto("Fecha registro:", 2, 10, $DB, "", "", "$rw[2]", 4, 1);
         
			$FB->llena_texto("Vestimenta:",3, 82, $DB, $Vestimenta, "", "$rw[3]", 1, 0);		
			$FB->llena_texto("Cual:", 4, 1, $DB, "", "", "$rw[4]", 4, 0); 	
			        
            $FB->llena_texto("Higiene:", 5, 82, $DB, $Higiene, "", "$rw[5]", 1, 0);          
            $FB->llena_texto("Cual:", 6, 1, $DB, "", "", "$rw[6]", 4, 0); 

            $FB->llena_texto("Estado Nutricional Subjetivo:", 7, 82, $DB, $Nutricional, "", "$rw[7]", 1, 0);
            $FB->llena_texto("Cual:", 8, 1, $DB, "", "", "$rw[8]", 4, 0); 

            $FB->llena_texto("Expresion facial:", 9, 82, $DB, $Expresión, "", "$rw[9]", 1, 0);           
            $FB->llena_texto("Cual:", 10, 1, $DB, "", "", "$rw[10]", 4, 0);
           
            $FB->llena_texto("Comportamiento General:", 11, 82, $DB, $Comportamiento, "", "$rw[11]", 1, 0);           
            $FB->llena_texto("Cual:", 12, 1, $DB, "", "", "$rw[12]", 4, 0);
			$caso = 'Conciencia';
			$FB->cierra_tabla();
		break;

		case "Conciencia":
			$FB->titulo_azul1("<h5> 2. Atención y Conciencia <h5>", 10, 0, 5);			
            $FB->llena_texto("Tipo de Atencion:", 13, 82, $DB, $TAtención, "", "$rw[12]", 1, 0);
			$FB->llena_texto("Estado de conciencia:", 14, 82, $DB, $conciencia, "", "$rw[13]", 1, 0);							
			$caso = 'Orientación';
			$FB->cierra_tabla();
			break;

		case "Orientación":
			$FB->titulo_azul1("<h4>3 Orientación. </h4> ", 10, 0, 5);
			echo '</tr> ';
           $FB->titulo_azul1("<h4>Tiempo.</h4> ", 10, 0, 5);
		   $FB->llena_texto("Dia de la semana:", 1, 1, $DB, "", "", "$rw[15]", 1, 0);
		   $FB->llena_texto("Mes:", 2, 1, $DB, "", "", "$rw[16]", 1, 0);
		   $FB->llena_texto("Ano:", 3, 1, $DB, "", "", "$rw[17]", 1, 0);
		   $FB->llena_texto("Especificacion:", 4, 82, $DB, $orientacion, "", "$rw[18]", 1, 0);		   
		   echo '</tr> ';
           $FB->titulo_azul1("<h4>Espacio.</h4> ", 10, 0, 5);
		   $FB->llena_texto("En que lugar se encuentra?:", 6, 1, $DB, "", "", "$rw[19]", 1, 0);
		   $FB->llena_texto("Para que sirve este lugar?:", 7, 1, $DB, "", "", "$rw[20]", 1, 0);
		   $FB->llena_texto("En que ciudad se encuentra?:", 8, 1, $DB, "", "", "$rw[21]", 1, 0);
		   $FB->llena_texto("Especificacion:", 4, 82, $DB, $orientacion, "", "$rw[22]", 1, 0);
		   echo '</tr> ';
		   $FB->titulo_azul1("<h4>Persona.</h4> ", 10, 0, 5);
		   $FB->llena_texto("Cual es su nombre?:", 11, 1, $DB, "", "", "$rw[23]", 1, 0);
		   $FB->llena_texto("Que edad tiene?:", 12, 1, $DB, "", "", "$rw[24]", 1, 0);
		   $FB->llena_texto("Especificacion:", 4, 82, $DB, $orientacion, "", "$rw[25]", 1, 0);
		   $FB->cierra_tabla();
		   $caso = 'Lenguaje';
			break;
		case "Lenguaje":

			$FB->titulo_azul1("<h4>4. Lenguaje</h4>	", 10, 0, 5);
			 echo '</tr> ';			           
			$FB->llena_texto("Calidad:",1, 82, $DB, $lenguaje, "", "$rw[72]", 1, 0);           
            $FB->llena_texto("Tono de voz:", 6, 82, $DB, $tonoVoz, "", "$rw[77]", 1, 0);  
          	$FB->llena_texto("Velocidad:", 10, 82, $DB, $Velocidad, "", "$rw[81]", 1, 0);
            $FB->llena_texto("Cantidad:", 16, 82, $DB, $Cantidad, "", "$rw[87]", 1, 0);
            $FB->llena_texto("Curso :", 20, 82, $DB, $Curso, "", "$rw[91]", 1, 0);
         
           

		   
			$FB->cierra_tabla();
			$caso = 'Afectivo';
			break;

		case "Afectivo":

			$FB->titulo_azul1( " <h4> 5. Estado Afectivo </h4> 	",9,0,7);

			echo '</tr> ';
			
			$FB->titulo_azul1("Calidad .", 10, 0, 5);	           
			$FB->llena_texto("Claro:",1, 5, $DB, "", "", "$rw[98]", 1, 0);
            $FB->llena_texto("Comprensible  :",2, 5, $DB, "", "", "$rw[99]", 1 ,0);
            $FB->llena_texto("Incompresible :",3, 5, $DB, "", "", "$rw[100]", 1, 0);
            $FB->llena_texto("Confuso :", 4, 5, $DB, "", "", "$rw[101]", 1, 0);            
            $FB->llena_texto("No Valorable :", 5, 5, $DB, "", "", "$rw[102]", 1, 0);
			
            $FB->titulo_azul1("Tono de voz  .", 10, 0, 5);
            $FB->llena_texto("Tono de voz :", 6, 5, $DB, "", "", "$rw[103]", 1, 0);
            $FB->llena_texto("Elevado  :", 7, 5, $DB, "", "", "$rw[104]", 1, 0);
            $FB->llena_texto("Moderado:", 8, 5, $DB, "", "", "$rw[105]", 1, 0);
            $FB->llena_texto("No Valorable :", 9, 5, $DB, "", "", "$rw[106]", 1, 0);
                        
            $FB->titulo_azul1(" Ansiedad.", 10, 0, 5);
            $FB->llena_texto("Manifiesta Temor  :", 10, 5, $DB, "", "", "$rw[107]", 1, 0);
            $FB->llena_texto("Taquicardia  :", 11, 5, $DB, "", "", "$rw[108]", 1, 0);
            $FB->llena_texto("Diaforesis  :", 12, 5, $DB, "", "", "$rw[109]", 1, 0);
            $FB->llena_texto("Inquietud  :", 13, 5, $DB, "", "", "$rw[110]", 1, 0);
            $FB->llena_texto("No Valorable:", 14, 5, $DB, "", "", "$rw[111]", 1, 0);
            $FB->llena_texto("Ninguna :", 15, 5, $DB, "", "", "$rw[112]", 1, 0);
           
            $FB->titulo_azul1("Cantidad .", 16, 0, 5);
            $FB->llena_texto("Verbosidad  :", 17, 5, $DB, "", "", "$rw[113]", 1, 0);
            $FB->llena_texto("Laconismo :", 18, 5, $DB, "", "", "$rw[114]", 1, 0);
            $FB->llena_texto("Mutismo:", 19, 5, $DB, "", "", "$rw[115]", 1, 0);            
            $FB->llena_texto("No valorable :", 100, 5, $DB, "", "", "$rw[116]", 1, 0);
           
            
            $FB->titulo_azul1("Curso .", 10, 0, 5);
            $FB->llena_texto("Coherencia :", 20, 5, $DB, "", "", "$rw[117]", 1, 0);
            $FB->llena_texto("Bloqueo :", 21, 5, $DB, "", "", "$rw[118]", 1, 0);
            $FB->llena_texto("Perseverancia  :", 22, 5, $DB, "", "", "$rw[119]", 1, 0);
            $FB->llena_texto("Monotono :", 23, 5, $DB, "", "", "$rw[120]", 1, 0);
            $FB->llena_texto("Fluido :", 24, 5, $DB, "", "", "$rw[121]", 1, 0);
            $FB->llena_texto("Locuaz:", 25, 5, $DB, "", "", "$rw[122]", 1, 0);
            $FB->llena_texto("No Valorable  :", 26, 5, $DB, "", "", "$rw[123]", 1, 0);
		   
		   
			$FB->cierra_tabla();
			$caso = 'Actitudes';
			break;

		case "Actitudes":
            $FB->titulo_azul1( " <h4> Actitudes y Tenencias Dominantes </h4> 	",9,0,7);

			echo '</tr> ';

            echo '<td> <label> (El usuario se siente responsable <br>de su padecimiento).</label></td>';  		  		           
			$FB->llena_texto("Tenencia Pesimista :",1, 5, $DB, "", "", "$rw[124]", 4, 0);
            echo '<td> <label> (El usuario siempre se encuentra<br> pendiente de su salud, refiere se enferma
             frecuentemente).</label></td>';
            $FB->llena_texto("Tenencia Hipocondriaca:",2, 5, $DB, "", "", "$rw[125]", 4 ,0);
            echo '<td> <label> (El usuario no puede<br> esperar a concluir sus tratamientos, <br>
            se encuentra siempre bajo reloj).</label></td>';
            $FB->llena_texto("Tenencia Ansiosa :",3, 5, $DB, "", "", "$rw[126]", 4, 0);
            echo '<td> <label> (El usuario percibe que son <br>otros los que lo controlan y mantienen el <br>
            estado actual).</label></td>';
            $FB->llena_texto("Tenencia Paranoide :", 4, 5, $DB, "", "", "$rw[127]",4, 0);  
            echo '<td> <label> (El usuario necesita realizar<br> rituales de manera reiterada, 
            porta o mantiene amuletos).</label></td>';         
            $FB->llena_texto("Tenencia Obsesiva/Compulsiva  :", 5, 5, $DB, "", "", "$rw[128]", 4, 0);
			
            echo '<td> <label> (El usuario refiere poseer poderes<br> especiales o mágicos).</label></td>';
            $FB->llena_texto("Tenencia Delusiva :",6, 5, $DB, "", "", "$rw[129]", 4, 0);
            echo '<td> <label> (El usuario refiere miedos <br>constantes).</label></td>';
            $FB->llena_texto("Tenencia Fbica :",7, 5, $DB, "", "", "", 4, 0);
            $FB->llena_texto("No es posible valorarlo :", 8, 5, $DB, "", "", "$rw[130]", 4, 0);
            $FB->llena_texto("Sin Tenencia Reconocida  :", 9, 5, $DB, "", "", "$rw[131]", 4, 0);
                        
            

			$FB->cierra_tabla();
			$caso = 'Memoria';
			break;

		case "Memoria":
            $FB->titulo_azul1( " <h4> 6. Memoria y Sociables </h4> 	",9,0,7);

            echo '</tr> ';

			$FB->titulo_azul1("Memoria .", 1, 0, 5);	           
			$FB->llena_texto("Conservada :",1, 5, $DB, "", "", "$rw[133]", 1, 0);
            $FB->llena_texto("Fallas leves   :",2, 5, $DB, "", "", "$rw[134]", 1 ,0);
            $FB->llena_texto("Fallas Marcadas  :",3, 5, $DB, "", "", "$rw[135]", 1, 0);

            $FB->titulo_azul1("Sociabilidad  .", 10, 0, 5);	
            $FB->llena_texto("Empatico :", 4, 5, $DB, "", "", "$rw[136]",1, 0);            
            $FB->llena_texto("Carismatico  :", 5, 5, $DB, "", "$rw[137]", "", 1, 0);
            $FB->llena_texto("Manipulador  :",6, 5, $DB, "", "", "$rw[138]", 1, 0);
            $FB->llena_texto("Introvertido   :",7, 5, $DB, "", "", "$rw[139]", 1 ,0);
            $FB->llena_texto("Extrovertido  :",8, 5, $DB, "", "", "$rw[140]", 1, 0);
            $FB->llena_texto("Colaborador  :", 9, 5, $DB, "", "", "$rw[141]",1, 0);            
            $FB->llena_texto("No Valorable    :", 10, 5, $DB, "", "", "$rw[142]", 1, 0);
            $FB->llena_texto("Otro  :",11, 5, $DB, "", "", "$rw[143]", 1, 0);
            $FB->llena_texto("Cual:", 12, 1, $DB, "", "", "$rw[144]", 1, 0);
           

			$FB->cierra_tabla();
			$caso = 'expectativas';
			break;
		case "expectativas":

			$FB->titulo_azul1("<h5>7. Intereses y expectativas proyecto de vida .</h5> ", 10, 0, 5);
		    echo '</tr> ';
		   echo '<td><label>Actividades de interés :</label></td>';		 
		   echo '<td><textarea name="param1" id="param1" value="text4"  style="width:350px; height:150px; class="text" >'.$rw[145].'</textarea></td>';
		   
		   echo '<td><label>Expectativas a futuro :</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4"  style="width:350px; height:150px; class="text" >'.$rw[146].'</textarea></td>';

			$FB->cierra_tabla();
			$caso = 'riesgo';
			break;

		///INCAPACIDADES == NOVEDADES
		case "riesgo":

			$FB->titulo_azul1( " <h4> 8.Situaciones de riesgo </h4> 	",9,0,7);

            echo '</tr> ';

			           
			$FB->llena_texto("Relaciones Parentales conflictivas:",1, 5, $DB, "", "", "$rw[147]", 1, 0);
            $FB->llena_texto("Relaciones padres e hijos conflictivas:",2, 5, $DB, "", "", "$rw[148]", 4 ,0);
            $FB->llena_texto("Consumo de sustancias psicoactivas:",3, 5, $DB, "", "", "$rw[149]", 1, 0);
			$FB->llena_texto("Desescolarización:",4, 5, $DB, "", "", "$rw[150]", 4 ,0);
            $FB->llena_texto("No afiliación al sistema de salud:",5, 5, $DB, "", "", "$rw[151]", 1, 0);

			echo '</tr> ';
		   echo '<td><label>Reportado por niño, niña o adolescente:</label></td>';		 
		   echo '<td><textarea name="param6" id="param6" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[152].'</textarea></td>';

			$FB->cierra_tabla();
			$caso = 'Observaciones';

			break;
		case "Observaciones":

			$FB->titulo_azul1( " <h4> 9.Observaciones </h4> 	",9,0,7);

			echo '</tr> ';
		   echo '<td><label>Análisis General:</label></td>';		 
		   echo '<td><textarea name="param1" id="param1" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[153].'</textarea></td>';

		   $FB->titulo_azul1( " ¿considera que el usuario requiere valoración por otra área?, si la respuesta es afirmativa realizar remisión",9,0,7);

			$FB->llena_texto("Si, Cual?:",2, 5, $DB, "", "", "$rw[154]", 1, 0);
			$FB->llena_texto("No:",3, 5, $DB, "", "", "$rw[152]", 4, 0);
            $FB->llena_texto("Terapia Ocupacional :",4, 5, $DB, "", "", "$rw[155]", 1 ,0);
            $FB->llena_texto("Neuropsicologia :",5, 5, $DB, "", "", "$rw[155]", 1, 0);
			$FB->llena_texto("Psiquiatra :",6, 5, $DB, "", "", "$rw[156]", 1 ,0);
            $FB->llena_texto("Fonoaudiologia :",7, 5, $DB, "", "", "$rw[157]", 1, 0);
			$FB->llena_texto("Otra:",8, 5, $DB, "", "", "$rw[158]", 1, 0);

			echo '</tr> ';
		   echo '<td><label>Cual:</label></td>';		 
		   echo '<td><textarea name="param9" id="param9" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[159].'</textarea></td>';

		   echo '</tr> ';
		   

		   $FB->titulo_azul1( " La autoridad administrativa competente y su equipo interdisciplinario envía valoración inicial realizada por ellos:",9,0,7);

		   echo '</tr> ';
		   $FB->llena_texto("Si :",10, 5, $DB, "", "", "$rw[160]", 1, 0);
		   $FB->llena_texto("No:",11, 5, $DB, "", "", "$rw[161]", 1, 0);

		   $FB->titulo_azul1( " Si la respuesta es afirmativa, revisé las coincidencias en relación a su evaluación y su análisis general:",9,0,7);
		   echo '</tr> ';
		   echo '<td><textarea name="param12" id="param12" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[162].'</textarea></td>';

			$FB->cierra_tabla();
			$caso = 'Observaciones';

			break;
			case "Observaciones":

				$FB->titulo_azul1( " <h4> 9.Observaciones </h4> 	",9,0,7);
	
				echo '</tr> ';
			   echo '<td><label>Análisis General:</label></td>';		 
			   echo '<td><textarea name="param1" id="param1" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[153].'</textarea></td>';
	
			   $FB->titulo_azul1( " ¿considera que el usuario requiere valoración por otra área?, si la respuesta es afirmativa realizar remisión",9,0,7);
	
				$FB->llena_texto("Si, Cual?:",2, 5, $DB, "", "", "$rw[154]", 1, 0);
				$FB->llena_texto("No:",3, 5, $DB, "", "", "$rw[152]", 4, 0);
				$FB->llena_texto("Terapia Ocupacional :",4, 5, $DB, "", "", "$rw[155]", 1 ,0);
				$FB->llena_texto("Neuropsicologia :",5, 5, $DB, "", "", "$rw[155]", 1, 0);
				$FB->llena_texto("Psiquiatra :",6, 5, $DB, "", "", "$rw[156]", 1 ,0);
				$FB->llena_texto("Fonoaudiologia :",7, 5, $DB, "", "", "$rw[157]", 1, 0);
				$FB->llena_texto("Otra:",8, 5, $DB, "", "", "$rw[158]", 1, 0);
	
				echo '</tr> ';
			   echo '<td><label>Cual:</label></td>';		 
			   echo '<td><textarea name="param9" id="param9" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[159].'</textarea></td>';
	
			   echo '</tr> ';
			   
	
			   $FB->titulo_azul1( " La autoridad administrativa competente y su equipo interdisciplinario envía valoración inicial realizada por ellos:",9,0,7);
	
			   echo '</tr> ';
			   $FB->llena_texto("Si :",10, 5, $DB, "", "", "$rw[160]", 1, 0);
			   $FB->llena_texto("No:",11, 5, $DB, "", "", "$rw[161]", 1, 0);
	
			   $FB->titulo_azul1( " Si la respuesta es afirmativa, revisé las coincidencias en relación a su evaluación y su análisis general:",9,0,7);
			   echo '</tr> ';
			   echo '<td><textarea name="param12" id="param12" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[162].'</textarea></td>';
	
				$FB->cierra_tabla();
				$caso = 'sesiones';
	
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