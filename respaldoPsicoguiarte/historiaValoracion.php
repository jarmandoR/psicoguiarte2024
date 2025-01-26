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




     $sql = "SELECT `valo_nombre`, `valo_fecha`, `valo_valorable`, `valo_adecuada`, `valo_deseadavesti`, `valo_inadecuadavesti`, `valo_otravesti`, `valo_cualvesti`, `valo_valorablehigi`, `valo_obsesivohigi`, `valo_limpiohigi`, `valo_desaseadohigi`, `valo_otrahigi`, `valo_cualhigi`, `valo_nutrinutrido`, `valo_nutrisobrepeso`, `valo_nutridesnutrido`, `valo_nutriobesidad`, `valo_nutrivalorable`, `valo_nutriotra`, `valo_nutricual`, `valo_facialsereno`, `valo_fasialtranquilo`, `valo_facialagresivo`, `valo_facialmolesto`, `valo_facialtriste`, `valo_facialvalorable`, `valo_facialotra`, `valo_facialcual`, `valo_alerta`, `valo_neutral`, `valo_hostil`, `valo_colaborador`, `valo_irritable`, `valo_amable`, `valo_dependiente`, `valo_evasivo`, `valo_preocupado`, `valo_desconfianza`, `valo_respetuoso`, `valo_temeroso`, `valo_triste`, `valo_comunicativo`, `valo_indiferente`, `valo_novalorable`, `valo_generalotra`, `valo_generalcual`,  `val_ateSelec`, `val_ateDisper`, `val_ateHipoate`, `val_ateconfusa`, `val_ateHiperate`, `val_ateNoSelectiva`, `val_consiConsiente`, `val_consiInconsciente`, `val_consiEstiupo`, `val_consisomno`, `val_consiInsom`, `valo_tiemDisem`, `valo_tiemMes`, `valo_tiemAno`, `valo_tiemConcreto`, `valo_tiemInconcre`, `valo_espaLugarEncu`, `valo_espaSirveLugar`, `valo_espaCiudad`, `valo_espaConcreto`, `valo_espaInconcre`, `valo_persoNombre`, `valo_persoEdad`, `valo_persoConcreto`, `valo_persoInconcre`, `val_calClaro`, `val_calComprensi`, `val_calIncompre`, `val_calConfuso`, `val_calNoValorable`, `val_vozTono`, `val_vozElevado`, `val_vozModerado`, `val_vozNoValorable`, `val_velLento`, `val_velTaqui`, `val_velDiafo`, `val_velInquie`, `val_velNoValora`, `val_velNinguna`, `val_cantiVerbo`, `val_cantiLaconismo`, `val_cantiMutismo`, `val_cantiNoValo`, `val_cursoCoherencia`, `val_cursoBloqueo`, `val_cursoPerseve`, `val_cursoMonoto`, `val_cursoFluido`, `val_cursolocuas`, `val_cursoNoValora`,, `valo_calClaro`, `valo_calComprensi`, `valo_calIncompre`, `valo_calConfuso`, `valo_calNoValorable`, `valo_vozTono`, `valo_vozElevado`, `valo_vozModerado`, `valo_vozNoValorable`, `valo_velLento`, `valo_velTaqui`, `valo_velDiafo`, `valo_velInquie`, `valo_velNoValora`, `valo_velNinguna`, `valo_cantiVerbo`, `valo_cantiLaconismo`, `valo_cantiMutismo`, `valo_cantiNoValo`, `valo_cursoCoherencia`, `valo_cursoBloqueo`, `valo_cursoPerseve`, `valo_cursoMonoto`, `valo_cursoFluido`, `valo_cursolocuas`, `valo_cursoNoValora` FROM `valoraInicial` WHERE id_valoracion='$idPareja' ";
// where id_valoracion='$idPareja'

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


		//echo $LT->llenadocs3($DB1, "referenciasfamiliares",$id_p, 1, 35, 'Ver');
	}


	//echo "wwwwwwwwwwwww".$rw[2];
	$FB->abre_form("form", "historiaValoracionOK.php", "post");

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

	switch ($condecion) {

		case "Comportamiento":            
        	
        	$FB->titulo_azul1("<h4>Descripción del consultante </h4> (Examen mental).", 10, 0, 5);
			$FB->titulo_azul1( "1.	Apariencia General - Comportamiento .", 10, 0, 5);
			// $FB->llena_texto("Foto:", 101, 6, $DB, "", "", "",1, 0);
// $FB->llena_texto("Hoja de Vida:", 102, 6, $DB, "", "", "",4, 0);
// echo"<label> <h2>hola</h2></label>";
// echo "<tr><td>Foto </td><td><a href='imghojadevida/fotos/".$rw[41]."' target='_blank'>Ver</a>";
// echo "<td>Hoja de vida </td><td><a href='imghojadevida/hojadevidadigi/".$rw[42]."' target='_blank'>Ver</a></td></tr>";
			if ($rw[1] > 0 and $nivel_acceso != 1) {
				$habi = 2;
			} else {
				$habi = 1;
			}
			$FB->llena_texto("Nombre:", 1, 1, $DB, "", "", "$rw[0]", 1, 0); 	
			$FB->llena_texto("Fecha registro:", 2, 10, $DB, "", "", "$rw[1]", 4, 1);
            $FB->titulo_azul1("Vestimenta.", 10, 0, 5);
			$FB->llena_texto("No Valorable:",3, 5, $DB, "", "", "$rw[2]", 1, 0);
            $FB->llena_texto("Adecuada:",4, 5, $DB, "", "", "$rw[3]", 1 ,0);
            $FB->llena_texto("Desaseada :",5, 5, $DB, "", "", "$rw[4]", 1, 0);
            $FB->llena_texto("Inadecuada:", 6, 5, $DB, "", "", "$rw[5]",1, 0);            
            $FB->llena_texto("otra:", 7, 5, $DB, "", "", "$rw[6]", 1, 0);
			$FB->llena_texto("Cual:", 8, 1, $DB, "", "", "$rw[7]", 1, 0); 	

            $FB->titulo_azul1("Higiene .", 10, 0, 5);
            $FB->llena_texto("No Valorable:", 9, 5, $DB, "", "", "$rw[8]", 1, 0);
            $FB->llena_texto("Obsesivo :", 10, 5, $DB, "", "", "$rw[9]", 1, 0);
            $FB->llena_texto("Limpio:", 11, 5, $DB, "", "", "$rw[10]", 1, 0);
            $FB->llena_texto("Desaseado:", 12, 5, $DB, "", "", "$rw[11]", 1, 0);
            $FB->llena_texto("Otra:", 13, 5, $DB, "", "", "$rw[12]", 1, 0);
            $FB->llena_texto("Cual:", 14, 1, $DB, "", "", "$rw[13]", 1, 0); 
            
            $FB->titulo_azul1("Estado Nutricional Subjetivo.", 10, 0, 5);
            $FB->llena_texto("Nutrido:", 15, 5, $DB, "", "", "$rw[14]", 1, 0);
            $FB->llena_texto("Sobrepeso:", 16, 5, $DB, "", "", "$rw[15]", 1, 0);
            $FB->llena_texto("Desnutrido:", 17, 5, $DB, "", "", "$rw[16]", 1, 0);
            $FB->llena_texto("Obesidad:", 18, 5, $DB, "", "", "$rw[17]", 1, 0);
            $FB->llena_texto("No Valorable:", 19, 5, $DB, "", "", "$rw[18]", 1, 0);
            $FB->llena_texto("Otra:", 20, 5, $DB, "", "", "$rw[19]", 1, 0);
            $FB->llena_texto("Cual:", 21, 1, $DB, "", "", "$rw[20]", 1, 0); 

            $FB->titulo_azul1("Expresión facial.", 10, 0, 5);
            $FB->llena_texto("Sereno(a) :", 22, 5, $DB, "", "", "$rw[21]", 1, 0);
            $FB->llena_texto("tranquilo(a):", 23, 5, $DB, "", "", "$rw[22]", 1, 0);
            $FB->llena_texto("Agresivo(a):", 24, 5, $DB, "", "", "$rw[23]", 1, 0);
            $FB->llena_texto("Molesto(a):", 25, 5, $DB, "", "", "$rw[24]", 1, 0);
            $FB->llena_texto("Triste:", 26, 5, $DB, "", "", "$rw[25]", 1, 0);
            $FB->llena_texto("No valorable :", 27, 5, $DB, "", "", "$rw[26]", 1, 0);
            $FB->llena_texto("Otra:", 28, 5, $DB, "", "", "$rw[27]", 1, 0);            
            $FB->llena_texto("Cual:", 29, 1, $DB, "", "", "$rw[28]", 1, 0);
            
            $FB->titulo_azul1("Comportamiento General .", 10, 0, 5);
            $FB->llena_texto("Alerta:", 30, 5, $DB, "", "", "$rw[29]", 1, 0);
            $FB->llena_texto("Neutral:", 31, 5, $DB, "", "", "$rw[30]", 1, 0);
            $FB->llena_texto("Hostil:", 32, 5, $DB, "", "", "$rw[31]", 1, 0);
            $FB->llena_texto("Colaborador:", 33, 5, $DB, "", "", "$rw[32]", 1, 0);
            $FB->llena_texto("Irritable:", 34, 5, $DB, "", "", "$rw[33]", 1, 0);
            $FB->llena_texto("Amable:", 35, 5, $DB, "", "", "$rw[34]", 1, 0);
            $FB->llena_texto("Dependiente:", 36, 5, $DB, "", "", "$rw[35]", 1, 0);
            $FB->llena_texto("Evasivo:", 37, 5, $DB, "", "", "$rw[36]", 1, 0); 
            $FB->llena_texto("Preocupado :", 38, 5, $DB, "", "", "$rw[37]", 1, 0);
            $FB->llena_texto("Desconfianza :", 39, 5, $DB, "", "", "$rw[38]", 1, 0);
            $FB->llena_texto("Respetuoso:", 40, 5, $DB, "", "", "$rw[39]", 1, 0);
            $FB->llena_texto("Temeroso :", 41, 5, $DB, "", "", "$rw[40]", 1, 0);
            $FB->llena_texto("Triste:", 42, 5, $DB, "", "", "$rw[41]", 1, 0);
            $FB->llena_texto("Comunicativo  :", 43, 5, $DB, "", "", "$rw[42]", 1, 0);
            $FB->llena_texto("Indiferente :", 44, 5, $DB, "", "", "$rw[43]", 1, 0);
            $FB->llena_texto("No valorable :", 45, 5, $DB, "", "", "$rw[44]", 1, 0);
            $FB->llena_texto("Otra:", 46, 5, $DB, "", "", "$rw[45]", 1, 0);           
            $FB->llena_texto("Cual:", 47, 1, $DB, "", "", "$rw[46]", 1, 0);


			$caso = 'Conciencia';
			$FB->cierra_tabla();
		break;

		case "Conciencia":

			$FB->titulo_azul1("<h5> 2. Atención y Conciencia <h5>", 10, 0, 5);
			
			$FB->titulo_azul1("Tipo de Atención.", 1, 0, 5);
            $FB->llena_texto("Selectiva :", 1, 5, $DB, "", "", "$rw[47]", 1, 0);
            $FB->llena_texto("Dispersa:", 2, 5, $DB, "", "", "$rw[48]", 1, 0);
            $FB->llena_texto("Hipoatencion  :", 3, 5, $DB, "", "", "$rw[49]", 1, 0);
            $FB->llena_texto("Confusa:", 4, 5, $DB, "", "", "$rw[50]", 1, 0);
            $FB->llena_texto("Hiperatencion  :", 5, 5, $DB, "", "", "$rw[51]", 1, 0);
            $FB->llena_texto("No selectiva :", 6, 5, $DB, "", "", "$rw[52]", 1, 0);

            $FB->titulo_azul1("Estado de conciencia.", 10, 0, 5);
            $FB->llena_texto("Consiente :", 7, 5, $DB, "", "", "$rw[53]", 1, 0);
            $FB->llena_texto("inconsciente:", 8, 5, $DB, "", "", "$rw[54]", 1, 0); 
            $FB->llena_texto("Estuporoso :", 9, 5, $DB, "", "", "$rw[55]", 1, 0);
            $FB->llena_texto("Somnoliento  :", 10, 5, $DB, "", "", "$rw[56]", 1, 0);
            $FB->llena_texto("Insomnio :", 11, 5, $DB, "", "", "$rw[57]", 1, 0);
                

			$caso = 'Orientación';
			$FB->cierra_tabla();
			break;
		case "Orientación":

			$FB->titulo_azul1("<h4>3 Orientación. </h4> ", 10, 0, 5);

			echo '</tr> ';
           $FB->titulo_azul1("<h4>3 Tiempo. </h4> ", 10, 0, 5);
		   $FB->llena_texto("Dia de la semana:", 1, 1, $DB, "", "", "$rw[58]", 1, 0);
		   $FB->llena_texto("Mes:", 2, 1, $DB, "", "", "$rw[59]", 1, 0);
		   $FB->llena_texto("Ano:", 3, 1, $DB, "", "", "$rw[60]", 1, 0);
		   $FB->llena_texto("Concreto   :", 4, 5, $DB, "", "", "$rw[61]", 1, 0);
           $FB->llena_texto("Inconcreto  :", 5, 5, $DB, "", "", "$rw[62]", 1, 0);
		   
		   echo '</tr> ';
           $FB->titulo_azul1("<h4>3 Espacio. </h4> ", 10, 0, 5);
		   $FB->llena_texto("En que lugar se encuentra?:", 6, 1, $DB, "", "", "$rw[63]", 1, 0);
		   $FB->llena_texto("Para que sirve este lugar?:", 7, 1, $DB, "", "", "$rw[64]", 1, 0);
		   $FB->llena_texto("En que ciudad se encuentra?:", 8, 1, $DB, "", "", "$rw[65]", 1, 0);
		   $FB->llena_texto("Concreto   :", 9, 5, $DB, "", "", "$rw[66]", 1, 0);
           $FB->llena_texto("Inconcreto  :", 10, 5, $DB, "", "", "$rw[67]", 1, 0);
		   echo '</tr> ';
		   $FB->titulo_azul1("<h4>3 Persona. </h4> ", 10, 0, 5);
		   $FB->llena_texto("Cual es su nombre?:", 11, 1, $DB, "", "", "$rw[68]", 1, 0);
		   $FB->llena_texto("Que edad tiene?:", 12, 1, $DB, "", "", "$rw[69]", 1, 0);
		   $FB->llena_texto("Concreto   :", 13, 5, $DB, "", "", "$rw[70]", 1, 0);
           $FB->llena_texto("Inconcreto  :", 14, 5, $DB, "", "", "$rw[71]", 1, 0);

		   
			

			$FB->cierra_tabla();
			$caso = 'Lenguaje';
			break;
		case "Lenguaje":

			$FB->titulo_azul1("<h4>4. Lenguaje</h4>	", 10, 0, 5);

			 echo '</tr> ';
			$FB->titulo_azul1("Calidad .", 10, 0, 5);	           
			$FB->llena_texto("Claro:",1, 5, $DB, "", "", "$rw[72]", 1, 0);
            $FB->llena_texto("Comprensible  :",2, 5, $DB, "", "", "$rw[73]", 1 ,0);
            $FB->llena_texto("Incompresible :",3, 5, $DB, "", "", "$rw[74]", 1, 0);
            $FB->llena_texto("Confuso :", 4, 5, $DB, "", "", "$rw[75]",1, 0);            
            $FB->llena_texto("No Valorable :", 5, 5, $DB, "", "", "$rw[76]", 1, 0);
			
            $FB->titulo_azul1("Tono de voz  .", 10, 0, 5);
            $FB->llena_texto("Tono de voz :", 6, 5, $DB, "", "", "$rw[77]", 1, 0);
            $FB->llena_texto("Elevado  :", 7, 5, $DB, "", "", "$rw[78]", 1, 0);
            $FB->llena_texto("Moderado:", 8, 5, $DB, "", "", "$rw[79]", 1, 0);
            $FB->llena_texto("No Valorable :", 9, 5, $DB, "", "", "$rw[80]", 1, 0);
                        
            $FB->titulo_azul1("Velocidad .", 10, 0, 5);
            $FB->llena_texto("Lento :", 10, 5, $DB, "", "", "$rw[81]", 1, 0);
            $FB->llena_texto("Taquicardia :", 11, 5, $DB, "", "", "$rw[82]", 1, 0);
            $FB->llena_texto("Diaforesis :", 12, 5, $DB, "", "", "$rw[83]", 1, 0);
            $FB->llena_texto("Inquietud Ninguna :", 13, 5, $DB, "", "", "$rw[84]", 1, 0);
            $FB->llena_texto("No Valorable:", 14, 5, $DB, "", "", "$rw[85]", 1, 0);
            $FB->llena_texto("Ninguna :", 15, 5, $DB, "", "", "$rw[86]", 1, 0);
           
            $FB->titulo_azul1("Cantidad .", 10, 0, 5);
            $FB->llena_texto("Verbosidad  :", 16, 5, $DB, "", "", "$rw[87]", 1, 0);
            $FB->llena_texto("Laconismo :", 17, 5, $DB, "", "", "$rw[88]", 1, 0);
            $FB->llena_texto("Mutismo:", 18, 5, $DB, "", "", "$rw[88]", 1, 0);            
            $FB->llena_texto("No valorable :", 19, 5, $DB, "", "", "$rw[90]", 1, 0);
           
            
            $FB->titulo_azul1("Curso .", 10, 0, 5);
            $FB->llena_texto("Coherencia :", 20, 5, $DB, "", "", "$rw[91]", 1, 0);
            $FB->llena_texto("Bloqueo :",21, 5, $DB, "", "", "$rw[92]", 1, 0);
            $FB->llena_texto("Perseverancia  :", 22, 5, $DB, "", "", "$rw[93]", 1, 0);
            $FB->llena_texto("Monotono :", 23, 5, $DB, "", "", "$rw[94]", 1, 0);
            $FB->llena_texto("Fluido :", 24, 5, $DB, "", "", "$rw[95]", 1, 0);
            $FB->llena_texto("Locuaz:", 25, 5, $DB, "", "", "$rw[96]", 1, 0);
            $FB->llena_texto("No Valorable  :", 26, 5, $DB, "", "", "$rw[97]", 1, 0);
           

		   
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
            $FB->llena_texto("No Valorable :", 4, 5, $DB, "", "", "$rw[102]", 1, 0);
			
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
            $FB->titulo_azul1( " <h4> 5. Estado Afectivo </h4> 	",9,0,7);

			echo '</tr> ';

            echo '<td> <label> (El usuario se siente responsable <br>de su padecimiento).</label></td>';  		  		           
			$FB->llena_texto("Tenencia Pesimista :",82, 5, $DB, "", "", "", 4, 0);
            echo '<td> <label> (El usuario siempre se encuentra<br> pendiente de su salud, refiere se enferma
             frecuentemente).</label></td>';
            $FB->llena_texto("Tenencia Hipocondriaca:",83, 5, $DB, "", "", "", 4 ,0);
            echo '<td> <label> (El usuario no puede<br> esperar a concluir sus tratamientos, <br>
            se encuentra siempre bajo reloj).</label></td>';
            $FB->llena_texto("Tenencia Ansiosa :",84, 5, $DB, "", "", "", 4, 0);
            echo '<td> <label> (El usuario percibe que son <br>otros los que lo controlan y mantienen el <br>
            estado actual).</label></td>';
            $FB->llena_texto("Tenencia Paranoide :", 85, 5, $DB, "", "", "",4, 0);  
            echo '<td> <label> (El usuario necesita realizar<br> rituales de manera reiterada, 
            porta o mantiene amuletos).</label></td>';         
            $FB->llena_texto("Tenencia Obsesiva/Compulsiva  :", 86, 5, $DB, "", "", "", 4, 0);
			
            echo '<td> <label> (El usuario refiere poseer poderes<br> especiales o mágicos).</label></td>';
            $FB->llena_texto("Tenencia Delusiva :", 87, 5, $DB, "", "", "", 4, 0);
            echo '<td> <label> (El usuario refiere miedos <br>constantes).</label></td>';
            $FB->llena_texto("Tenencia Fbica :", 88, 5, $DB, "", "", "", 4, 0);
            $FB->llena_texto("No es posible valorarlo :", 89, 5, $DB, "", "", "", 4, 0);
            $FB->llena_texto("Sin Tenencia Reconocida  :", 90, 5, $DB, "", "", "", 4, 0);
                        
            

			$FB->cierra_tabla();
			$caso = 'Memoria';
			break;

		case "Memoria":
            $FB->titulo_azul1( " <h4> 6. Memoria y Sociables </h4> 	",9,0,7);

            echo '</tr> ';

			$FB->titulo_azul1("Memoria .", 10, 0, 5);	           
			$FB->llena_texto("Conservada :",82, 5, $DB, "", "", "", 1, 0);
            $FB->llena_texto("Fallas leves   :",83, 5, $DB, "", "", "", 1 ,0);
            $FB->llena_texto("Fallas Marcadas  :",84, 5, $DB, "", "", "", 1, 0);

            $FB->titulo_azul1("Sociabilidad  .", 10, 0, 5);	
            $FB->llena_texto("Empatico :", 85, 5, $DB, "", "", "",1, 0);            
            $FB->llena_texto("Carismatico  :", 86, 5, $DB, "", "", "", 1, 0);
            $FB->llena_texto("Manipulador  :",82, 5, $DB, "", "", "", 1, 0);
            $FB->llena_texto("Introvertido   :",83, 5, $DB, "", "", "", 1 ,0);
            $FB->llena_texto("Extrovertido  :",84, 5, $DB, "", "", "", 1, 0);
            $FB->llena_texto("Colaborador  :", 85, 5, $DB, "", "", "",1, 0);            
            $FB->llena_texto("No Valorable    :", 86, 5, $DB, "", "", "", 1, 0);
            $FB->llena_texto("Otro  :",82, 5, $DB, "", "", "", 1, 0);
            $FB->llena_texto("Cual:", 29, 1, $DB, "", "", "$rw[3]", 1, 0);
           

			$FB->cierra_tabla();
			$caso = 'expectativas';
			break;
		case "expectativas":

			$FB->titulo_azul1("<h5>7. Intereses y expectativas proyecto de vida .</h5> ", 10, 0, 5);
		    echo '</tr> ';
		   echo '<td><label>Actividades de interés :</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';
		   
		   echo '<td><label>Expectativas a futuro :</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

			$FB->cierra_tabla();
			$caso = 'riesgo';
			break;

		///INCAPACIDADES == NOVEDADES
		case "riesgo":

			$FB->titulo_azul1( " <h4> 8.Situaciones de riesgo </h4> 	",9,0,7);

            echo '</tr> ';

			           
			$FB->llena_texto("Relaciones Parentales conflictivas:",82, 5, $DB, "", "", "", 1, 0);
            $FB->llena_texto("Relaciones padres e hijos conflictivas:",83, 5, $DB, "", "", "", 4 ,0);
            $FB->llena_texto("Consumo de sustancias psicoactivas:",84, 5, $DB, "", "", "", 1, 0);
			$FB->llena_texto("Desescolarización:",83, 5, $DB, "", "", "", 4 ,0);
            $FB->llena_texto("No afiliación al sistema de salud:",84, 5, $DB, "", "", "", 1, 0);

			echo '</tr> ';
		   echo '<td><label>Reportado por niño, niña o adolescente:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

			$FB->cierra_tabla();
			$caso = 'Observaciones';

			break;
		case "Observaciones":

			$FB->titulo_azul1( " <h4> 9.Observaciones </h4> 	",9,0,7);

			echo '</tr> ';
		   echo '<td><label>Análisis General:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		   $FB->titulo_azul1( " ¿considera que el usuario requiere valoración por otra área?, si la respuesta es afirmativa realizar remisión",9,0,7);

		   $FB->llena_texto("Si, Cual?:",82, 5, $DB, "", "", "", 1, 0);
		   $FB->llena_texto("No:",84, 5, $DB, "", "", "", 4, 0);
            $FB->llena_texto("Terapia Ocupacional :",83, 5, $DB, "", "", "", 1 ,0);
            $FB->llena_texto("Neuropsicologia :",84, 5, $DB, "", "", "", 1, 0);
			$FB->llena_texto("Psiquiatra :",83, 5, $DB, "", "", "", 1 ,0);
            $FB->llena_texto("Fonoaudiologia :",84, 5, $DB, "", "", "", 1, 0);
			$FB->llena_texto("Otra:",84, 5, $DB, "", "", "", 1, 0);

			echo '</tr> ';
		   echo '<td><label>Cual:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

		   echo '</tr> ';
		   

		   $FB->titulo_azul1( " La autoridad administrativa competente y su equipo interdisciplinario envía valoración inicial realizada por ellos:",9,0,7);

		   echo '</tr> ';
		   $FB->llena_texto("Si :",84, 5, $DB, "", "", "", 1, 0);
		   $FB->llena_texto("No:",84, 5, $DB, "", "", "", 1, 0);

		   $FB->titulo_azul1( " Si la respuesta es afirmativa, revisé las coincidencias en relación a su evaluación y su análisis general:",9,0,7);
		   echo '</tr> ';
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[27].'</textarea></td>';

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