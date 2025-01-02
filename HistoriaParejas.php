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
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='HistoriaParejas.php?condecion=datosparejas&idPareja=$idPareja'\" >Contextualización</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='HistoriaParejas.php?condecion=problemas&idPareja=$idPareja'\" >Listado de problemas</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='HistoriaParejas.php?condecion=predisposicion&idPareja=$idPareja'\" >Predisposicion Y Adquisicion </button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='HistoriaParejas.php?condecion=Mantenimiento&idPareja=$idPareja'\" >Mantenimiento</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='HistoriaParejas.php?condecion=Intervencion&idPareja=$idPareja'\" >Intervencion</button>";

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

		case "datosparejas":    
        
        	$FB->titulo_azul1("<h4>Formulación clínica de casos de pareja</h4> (con base en Farmer y Chapman, 2016).", 10, 0, 5);
			$FB->titulo_azul1( "1.	FASE DESCRIPTIVA (contextualización).", 10, 0, 5);



			if ($rw[1] > 0 and $nivel_acceso != 1) {
				$habi = 2;
			} else {
				$habi = 1;
			}
			$FB->llena_texto("Nombre del(a) consultante 1:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
			$FB->llena_texto("Edad:", 2, 1, $DB, "", "", "$rw[2]", 4, 1);
			$FB->llena_texto("Ocupacion:", 3, 1, $DB, "", "", "$rw[3]", 4, 1);
            $FB->llena_texto("Nombre del(a) consultante 2:", 4, 1, $DB, "", "", "$rw[4]", 1, 0); 	
			$FB->llena_texto("Edad:", 5, 1, $DB, "", "", "$rw[5]", 4, 1);
			$FB->llena_texto("Ocupacion:", 6, 1, $DB, "", "", "$rw[6]", 4, 1);
			$FB->llena_texto("Nombre del(a) terapeuta:", 7, 1, $DB, "", "", "$rw[7]", 1, 1);
			$FB->llena_texto("Nombre del(a) supervisor(a):", 8, 1, $DB, "", "", "$rw[8]", 4, 1);

            $FB->titulo_azul1( "<h5>Incluir: (1) Motivo de consulta del consultante o de la fuente de remisión 
            (expresado textualmente e indicando de quien proviene. Por ejemplo, el consultante, 
            los padres, la pareja, el docente, el medico tratante, etc.) y descripcion de detalles 
            del mismo que se consideren relevantes.</h5>",9,0,7);

            echo '</tr> ';
            
echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> <label>Consultante 1:</label></td>';  

echo '<td><textarea name="text0" id="text0" value="text0" placeholder="  Motivo de consulta sobre el vínculo y (si hay) sobre aspectos personales que afectan la relación. Expectativas al iniciar el proceso:" style="width:350px; height:150px; class="text" >'.$rw[9].'</textarea></td>';

echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> <label>Consultante 2:</label></td>';  

echo '<td><textarea name="text1" id="text1" value="text1" placeholder=" Motivo de consulta sobre el vínculo y (si hay) sobre aspectos personales que afectan la relación. Expectativas al iniciar el proceso:" style="width:350px; height:150px; class="text" >'.$rw[10].'</textarea></td>';
            

			$FB->titulo_azul1( " <h5>Establecimiento de afectación en áreas de ajuste para cada miembro de la pareja 
			(identificándolos como 1 y 2). Identificar las áreas afectadas, indicar el modo en que se encuentran 
			afectadas y valorar el nivel de afectación a través de la siguiente escala: (0) Ninguna afectación; (1)
			Afectación mínima; (2)Afectación leve; (3) Afectación moderada; (4) Afectación alta; (5) Afectación 
			extrema. Describir la afectación en cada área que aplique en orden del nivel de afectación escribiendo
			un número entre 1 y 5 en el paréntesis correspondiente. Las áreas en “cero” no se describen.</h5>
			",9,0,7);

			echo '</tr> ';
			
			echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-heart" viewBox="0 0 16 16">
			<path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.309 8 6.982Z"/>
			<path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.707L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.646a.5.5 0 0 0 .708-.707L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
		  </svg> <label> Familiar:</label></td>';  
		   $FB->llena_texto("consultante 1:", 9, 1, $DB, "", "", "$rw[11]", 1, 0);
		   $FB->llena_texto("consultante 2:", 10, 1, $DB, "", "", "$rw[12]", 4, 0);		   

		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-hearts" viewBox="0 0 16 16">
		   <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566ZM9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z"/>
		 </svg> <label> Pareja:</label></td>';  
		   $FB->llena_texto("consultante 1:", 11, 1, $DB, "", "", "$rw[13]", 1, 0);
		   $FB->llena_texto("consultante 2:", 12, 1, $DB, "", "", "$rw[14]", 4, 0);

		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wechat" viewBox="0 0 16 16">
		   <path d="M11.176 14.429c-2.665 0-4.826-1.8-4.826-4.018 0-2.22 2.159-4.02 4.824-4.02S16 8.191 16 10.411c0 1.21-.65 2.301-1.666 3.036a.324.324 0 0 0-.12.366l.218.81a.616.616 0 0 1 .029.117.166.166 0 0 1-.162.162.177.177 0 0 1-.092-.03l-1.057-.61a.519.519 0 0 0-.256-.074.509.509 0 0 0-.142.021 5.668 5.668 0 0 1-1.576.22ZM9.064 9.542a.647.647 0 1 0 .557-1 .645.645 0 0 0-.646.647.615.615 0 0 0 .09.353Zm3.232.001a.646.646 0 1 0 .546-1 .645.645 0 0 0-.644.644.627.627 0 0 0 .098.356Z"/>
		   <path d="M0 6.826c0 1.455.781 2.765 2.001 3.656a.385.385 0 0 1 .143.439l-.161.6-.1.373a.499.499 0 0 0-.032.14.192.192 0 0 0 .193.193c.039 0 .077-.01.111-.029l1.268-.733a.622.622 0 0 1 .308-.088c.058 0 .116.009.171.025a6.83 6.83 0 0 0 1.625.26 4.45 4.45 0 0 1-.177-1.251c0-2.936 2.785-5.02 5.824-5.02.05 0 .1 0 .15.002C10.587 3.429 8.392 2 5.796 2 2.596 2 0 4.16 0 6.826Zm4.632-1.555a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0Zm3.875 0a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0Z"/>
		 </svg> <label> Red de soporte social (amigos, conocidos):</label></td>';  
		   $FB->llena_texto("consultante 1:", 13, 1, $DB, "", "", "$rw[15]", 1, 0);
		   $FB->llena_texto("consultante 2:", 14, 1, $DB, "", "", "$rw[16]", 4, 0);

		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
		   <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
		   <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
		 </svg> <label> Ocupación (estudio, trabajo):</label></td>';  
		   $FB->llena_texto("consultante 1:", 15, 1, $DB, "", "", "$rw[17]", 1, 0);
		   $FB->llena_texto("consultante 2:", 16, 1, $DB, "", "", "$rw[18]", 4, 0);
		   
		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-pulse-fill" viewBox="0 0 16 16">
		   <path d="M1.475 9C2.702 10.84 4.779 12.871 8 15c3.221-2.129 5.298-4.16 6.525-6H12a.5.5 0 0 1-.464-.314l-1.457-3.642-1.598 5.593a.5.5 0 0 1-.945.049L5.889 6.568l-1.473 2.21A.5.5 0 0 1 4 9H1.475Z"/>
		   <path d="M.88 8C-2.427 1.68 4.41-2 7.823 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C11.59-2 18.426 1.68 15.12 8h-2.783l-1.874-4.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.88Z"/>
		 </svg> <label> Salud, cuidado personal:</label></td>';  
		  $FB->llena_texto("consultante 1:", 17, 1, $DB, "", "", "$rw[19]", 1, 0);
		  $FB->llena_texto("consultante 2:", 18, 1, $DB, "", "", "$rw[20]", 4, 0);

		  echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
		  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
		  <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
		</svg> <label> Espiritualidad:</label></td>';  
		  $FB->llena_texto("consultante 1:", 19, 1, $DB, "", "", "$rw[21]", 1, 0);
		  $FB->llena_texto("consultante 2:", 20, 1, $DB, "", "", "$rw[22]", 4, 0);

		  echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-xbox" viewBox="0 0 16 16">
		  <path d="M7.202 15.967a7.987 7.987 0 0 1-3.552-1.26c-.898-.585-1.101-.826-1.101-1.306 0-.965 1.062-2.656 2.879-4.583C6.459 7.723 7.897 6.44 8.052 6.475c.302.068 2.718 2.423 3.622 3.531 1.43 1.753 2.088 3.189 1.754 3.829-.254.486-1.83 1.437-2.987 1.802-.954.301-2.207.429-3.239.33Zm-5.866-3.57C.589 11.253.212 10.127.03 8.497c-.06-.539-.038-.846.137-1.95.218-1.377 1.002-2.97 1.945-3.95.401-.417.437-.427.926-.263.595.2 1.23.638 2.213 1.528l.574.519-.313.385C4.056 6.553 2.52 9.086 1.94 10.653c-.315.852-.442 1.707-.306 2.063.091.24.007.15-.3-.319Zm13.101.195c.074-.36-.019-1.02-.238-1.687-.473-1.443-2.055-4.128-3.508-5.953l-.457-.575.494-.454c.646-.593 1.095-.948 1.58-1.25.381-.237.927-.448 1.161-.448.145 0 .654.528 1.065 1.104a8.372 8.372 0 0 1 1.343 3.102c.153.728.166 2.286.024 3.012a9.495 9.495 0 0 1-.6 1.893c-.179.393-.624 1.156-.82 1.404-.1.128-.1.127-.043-.148ZM7.335 1.952c-.67-.34-1.704-.705-2.276-.803a4.171 4.171 0 0 0-.759-.043c-.471.024-.45 0 .306-.358A7.778 7.778 0 0 1 6.47.128c.8-.169 2.306-.17 3.094-.005.85.18 1.853.552 2.418.9l.168.103-.385-.02c-.766-.038-1.88.27-3.078.853-.361.176-.676.316-.699.312a12.246 12.246 0 0 1-.654-.319Z"/>
		</svg> <label> Ocio:</label></td>';  
		  $FB->llena_texto("consultante 1:", 21, 1, $DB, "", "", "$rw[23]", 1, 0);
		  $FB->llena_texto("consultante 2:", 22, 1, $DB, "", "", "$rw[24]", 4, 0);
			

		  $FB->titulo_azul1( " <h5>Especificar el tipo de afectación en cada área calificada entre 1 y 5,
		   empezando por la más afectada.</h5>
		  ",9,0,7);

		  echo '</tr> ';

		  echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
		  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
		  </svg> <label>Consultante 1:</label></td>';  
		  
		  echo '<td><textarea name="text2" id="text2" value="text2" placeholder="  Descripcion:" style="width:350px; height:150px; class="text" >'.$rw[25].'</textarea></td>';
		  
		  echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
		  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
		  </svg> <label>Consultante 2:</label></td>';  
		  
		  echo '<td><textarea name="text3" id="text3" value="text3" placeholder=" Descripcion:" style="width:350px; height:150px; class="text" >'.$rw[26].'</textarea></td>';

			$caso = 'problemas';
			$FB->cierra_tabla();
		break;

		case "problemas":

			$FB->titulo_azul1("<h5> 2. FASE DESCRIPTIVA (listado de problemas/identificación de clases funcionales
			de respuesta) ¿Cuáles son los problemas (clases funcionales de respuesta) que se presentan?<h5>", 10, 0, 5);
			
			echo "<tr>";

			echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
		  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
		  </svg> <label>Consultante 1:</label></td>';  
		  
		  echo '<td><textarea name="param2" id="param2" value="text4" placeholder="  Problemas que afectan el vínculo:" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';
		  
		  echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
		  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
		  </svg> <label>Consultante 2:</label></td>';  
		  
		  echo '<td><textarea name="param3" id="param3" value="text5" placeholder=" Problemas que afectan el vínculo:" style="width:350px; height:150px; class="text" >'.$rw[28].'</textarea></td>';

		  echo "<tr>";

		  echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
		  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
		</svg> <label>Problemas del vínculo:</label></td>';  

		echo '<td><textarea name="param4" id="param4" value="text6" placeholder=" Descripcion:" style="width:450px; height:200px; class="text" >'.$rw[29].'</textarea></td>';


			$caso = 'predisposicion';
			$FB->cierra_tabla();
			break;
		case "predisposicion":

			$FB->titulo_azul1("<h4>3.	FASE EXPLICATIVA (PREDISPOSICIÓN Y ADQUISICIÓN)</h4>
			¿Cómo y por qué comenzaron estos problemas? <br>
			¿Cuáles son los mecanismos explicativos del origen de estos problemas? <br>
			A través de texto o esquemas identificar y explicar cómo los factores de adquisición 
			contribuyeron a la aparición de los problemas identificados. ", 10, 0, 5);

			echo '</tr> ';
			
			echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
			<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
		  </svg> <label> Factores predisponentes :</label></td>';  
		   $FB->llena_texto("consultante 1:", 22, 1, $DB, "", "", "$rw[30]", 1, 0);
		   $FB->llena_texto("consultante 2:", 23, 1, $DB, "", "", "$rw[31]", 4, 0);		   

		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
		   <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
		   <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
		 </svg> <label> Factores precipitantes:</label></td>';  
		   $FB->llena_texto("consultante 1:", 24, 1, $DB, "", "", "$rw[32]", 1, 0);
		   $FB->llena_texto("consultante 2:", 25, 1, $DB, "", "", "$rw[33]", 4, 0);

		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
		  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
		</svg> <label>Factores del vínculo:</label></td>';  

		echo '<td><textarea name="param1" id="param1" value="param125" placeholder=" Descripcion:" style="width:450px; height:200px; class="text" >'.$rw[34].'</textarea></td>';


		$FB->titulo_azul1("<h5>Explicación sobre la adquisición: Indicar cuál(es) modelo(s) aplica(n) escribiendo un número 
		entre 1 y 4 junto al ícono y presentando la explicación en el espacio correspondiente.</h5> ", 10, 0, 5);

			echo '</tr> ';

			echo '<td><img src="img/iman1.PNG"> <br><label> Condicionamiento clásico:</label></td>'; 			
			$FB->llena_texto("consultante 1:", 26, 1, $DB, "", "", "$rw[35]", 1, 0);
		   $FB->llena_texto("consultante 2:", 27, 1, $DB, "", "", "$rw[36]", 4, 0);
		   $FB->llena_texto("Vinculo:", 28, 1, $DB, "", "", "$rw[37]", 1, 0);
		   echo '</tr> ';
		   echo '<td><img src="img/iman2.PNG"> <br><label> Condicionamiento operante <br>(selección por contingencias):</label></td>'; 			
			$FB->llena_texto("consultante 1:", 29, 1, $DB, "", "", "$rw[38]", 1, 0);
		   $FB->llena_texto("consultante 2:", 30, 1, $DB, "", "", "$rw[39]", 4, 0);
		   $FB->llena_texto("Vinculo:", 31, 1, $DB, "", "", "$rw[40]", 1, 0);
		   echo '</tr> ';
		   echo '<td><img src="img/iman3.PNG"> <br><label> Modelamiento <br>(modelos inadecuados o insuficientes, déficit en repertorios):</label></td>'; 			
			$FB->llena_texto("consultante 1:", 32, 1, $DB, "", "", "$rw[41]", 1, 0);
		   $FB->llena_texto("consultante 2:", 33, 1, $DB, "", "", "$rw[42]", 4, 0);
		   $FB->llena_texto("Vinculo:", 34, 1, $DB, "", "", "$rw[43]", 1, 0);
		   echo '</tr> ';
		   echo '<td><img src="img/iman4.PNG"> <br><label> Aprendizaje instruccional <br>(reglas, creencias):</label></td>'; 			
			$FB->llena_texto("consultante 1:", 35, 1, $DB, "", "", "$rw[44]", 1, 0);
		   $FB->llena_texto("consultante 2:", 36, 1, $DB, "", "", "$rw[45]", 4, 0);
		   $FB->llena_texto("Vinculo:", 37, 1, $DB, "", "", "$rw[46]", 1, 0);
		   
		   $FB->titulo_azul1("<h5>Explicación.</h5> ", 10, 0, 5);

		   echo '</tr> ';

		   $FB->llena_texto("consultante 1:", 38, 1, $DB, "", "", "$rw[47]", 1, 0);
		   $FB->llena_texto("consultante 2:", 39, 1, $DB, "", "", "$rw[48]", 4, 0);

		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
		  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
		</svg> <label>Factores del vínculo:</label></td>';  

		echo '<td><textarea name="param2" id="param2" value="text8" placeholder=" Descripcion:" style="width:450px; height:200px; class="text" >'.$rw[49].'</textarea></td>';

			// $FB->llena_texto("Estado civil:", 17, 82, $DB, $estadocivil, "", "$rw[10]", 17, 1);
// $FB->llena_texto("Nombre de Esposa(o):",14, 1, $DB, "", "", "$rw[14]", 4, 0);
// $FB->llena_texto("Profesi&oacute;n, ocupaci&oacute;n u oficio:", 15, 1, $DB, "", "", "$rw[15]", 17, 0);
// $FB->llena_texto("Celular:",16, 1, $DB, "", "", "$rw[16]", 4, 0);
	

			$FB->cierra_tabla();
			$caso = 'Mantenimiento';
			break;
		case "Mantenimiento":

			$FB->titulo_azul1("<h4>4. FASE EXPLICATIVA (MANTENIMIENTO)</h4>
			¿Cómo y por qué se mantienen estos problemas?<br>
			¿Cuáles son los mecanismos explicativos del mantenimiento de estos problemas?<br> 
			(incluir ejemplos de análisis funcionales desarrollados)<br> A través de texto o esquemas
			 identificar y explicar cómo los factores de mantenimiento contribuyen en los problemas identificados.
			 ", 10, 0, 5);

			 $FB->titulo_azul1("<h5>Explicación sobre el mantenimiento: Indicar cuál(es) modelo(s)  aplica(n) escribiendo un 
			 número entre 1 y 2 junto al ícono y presentando la explicación en el espacio correspondienten.</h5> ", 10, 0, 5);

			 echo '</tr> ';
			 
			 echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-emoji-laughing" viewBox="0 0 16 16">
			 <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
			 <path d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zM7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z"/>
		   </svg>  </td><td><label> Condicionamiento operante (ref +/- ) (   ) <br>
		   Nota: esta explicación requiere el diligenciamiento<br> del formato de análisis funcional:</label></td>';  
		   $FB->llena_texto("consultante 1:", 40, 1, $DB, "", "", "$rw[49]", 1, 0);
		   $FB->llena_texto("consultante 2:", 41, 1, $DB, "", "", "$rw[50]", 4, 0);
		   $FB->llena_texto("Vinculo:", 42, 1, $DB, "", "", "$rw[51]", 1, 0);

		   echo '</tr> ';

		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
		   <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
		 </svg>  </td><td><label> Regulación verbal (RFT)/Creencias o distorsiones </label></td>';  
		   $FB->llena_texto("consultante 1:", 43, 1, $DB, "", "", "$rw[52]", 1, 0);
		   $FB->llena_texto("consultante 2:", 44, 1, $DB, "", "", "$rw[53]", 4, 0);
		   $FB->llena_texto("Vinculo:", 45, 1, $DB, "", "", "$rw[54]", 1, 0);

		   $FB->titulo_azul1("<h5>Explicación.</h5> ", 10, 0, 5);

		   echo '</tr> ';

		   $FB->llena_texto("consultante 1:", 46, 1, $DB, "", "", "$rw[55]", 1, 0);
		   $FB->llena_texto("consultante 2:", 47, 1, $DB, "", "", "$rw[56]", 4, 0);

		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
		  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
		</svg> <label>Factores del vínculo:</label></td>';  

		echo '<td><textarea name="param7" id="param7" value="text9" placeholder=" Descripcion:" style="width:450px; height:200px; class="text" >'.$rw[57].'</textarea></td>';

		   
			$FB->cierra_tabla();
			$caso = 'Intervencion';
			break;

		case "Intervencion":

			$FB->titulo_azul1( " <h4> 5. FASE DE VERIFICACIÓN (INTERVENCIÓN)</h4> <h5>
			¿Cómo se pueden modificar las variables mantenedoras para lograr los objetivos terapéuticos?
			</h5>
			",9,0,7);

			echo '</tr> ';
			
			echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
		  </svg> </td>
		  <td><label> Objetivos para el consultante:</label></td>';  
		   $FB->llena_texto("consultante 1:", 48, 1, $DB, "", "", "$rw[57]", 1, 0);
		   $FB->llena_texto("consultante 2:", 49, 1, $DB, "", "", "$rw[58]", 4, 0);
		   $FB->llena_texto("Vinculo:", 50, 1, $DB, "", "", "$rw[60]", 1, 0);		   
		   echo '</tr> ';
		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
		   <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
		 </svg></td>
		 <td> <label> Recursos y factores de protección con los que cuenta el <br>consultante y que podrían incluirse en la intervención:</label></td>';  
		   $FB->llena_texto("consultante 1:", 51, 1, $DB, "", "", "$rw[59]", 1, 0);
		   $FB->llena_texto("consultante 2:", 52, 1, $DB, "", "", "$rw[60]", 4, 0);
		   $FB->llena_texto("Vinculo:", 53, 1, $DB, "", "", "$rw[63]", 1, 0);		      
		   echo '</tr> ';
		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
		   <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
		 </svg> </td>
		 <td><label> Actividades clínicas a realizar (cantidad de sesiones estimadas):</label></td>';  
		   $FB->llena_texto("consultante 1:", 54, 1, $DB, "", "", "$rw[61]", 1, 0);
		   $FB->llena_texto("consultante 2:", 55, 1, $DB, "", "", "$rw[62]", 4, 0);
		   $FB->llena_texto("Vinculo:", 56, 1, $DB, "", "", "$rw[63]", 1, 0);		   

		   echo '</tr> ';
		   echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
		   <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/>
		 </svg> </td>
		 <td><label> Estrategias de evaluación de la intervención:</label></td>';  
		   $FB->llena_texto("consultante 1:", 57, 1, $DB, "", "", "$rw[64]", 1, 0);
		   $FB->llena_texto("consultante 2:", 58, 1, $DB, "", "", "$rw[65]", 4, 0);
		   $FB->llena_texto("Vinculo:", 59, 1, $DB, "", "", "$rw[66]", 1, 0);		   

		   
		   
			$FB->cierra_tabla();
			$caso = 'Ciclovitaldelafamilia';
			break;

		case "Ciclovitaldelafamilia":

			include('afiliacionessalud.php');

			$FB->cierra_tabla();
			$caso = 'Eventosconsideradosfortalezas';
			break;

		case "Eventosconsideradosfortalezas":

			include('entregavehiculo.php');

			$FB->cierra_tabla();
			$caso = 'Eventosestresantes';
			break;
		case "Eventosestresantes":

			include('dotacion.php');

			$FB->cierra_tabla();
			$caso = 'Comprensiondelcaso';
			break;

		///INCAPACIDADES == NOVEDADES
		case "Comprensiondelcaso":

			require_once('incapacidades.php');

			$FB->cierra_tabla();
			$caso = 'Hipotesisdelcaso';

			break;
		case "Hipotesisdelcaso":

			require_once('memorandos.php');

			$FB->cierra_tabla();
			$caso = 'Objetivosdelacompañamientopsicológicoespecializado';

			break;

		case "Objetivosdelacompañamientopsicológicoespecializado":

			include('terminacioncontrato.php');

			$FB->cierra_tabla();
			$caso = 'Estrategiasy/otecnicasdeintervencion';

			break;
		case "Estrategiasy/otecnicasdeintervencion":

			include('form1.php');

			$FB->cierra_tabla();
			$caso = 'ImpresionDiagnostica';

			break;

		case "ImpresionDiagnostica":
			include('form2.php');
			$FB->cierra_tabla();
			break;

		case "ImpresionDiagnostica":
			include('form2.php');
			$FB->cierra_tabla();
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