<?php
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
	@$idhojadevida = $_REQUEST["idhojadevida"];
	@$id_param = $_REQUEST["id_param"];
	//echo $condecion;
	if ($idhojadevida == '') {
		$idhojadevida = $id_param;
	}

	if ($accion != 1) {




     $sql = "SELECT `hoj_fechaingreso`,`hoj_numsim`,`hoj_nombre`, `hoj_apellido`,`hoj_tipoIden`,`hoj_cedula`,`hoj_fechanacimiento`,`hoj_edad`,`hoj_sede`, `hoj_direccion`, `hoj_Ocupacion`, `hoj_Nivel _escolaridad`,`hoj_Requiere_acudiente`,`hoj_Nombre_acu`,`hoj_Apellido_acu`, `hoj_Parentesco_acu`,`hoj_Telefono_acu`,`hoj_Ocupacion_acu`,`hoj_Nivel_escolarida_acud`,
	`hoj_Email_acu`,`hoj_histo_edad`, `hoj_histo_dific`, `hoj_histo_trata`, `hoj_histo_compor`, `hoj_histo_atencion`, `hoj_histo_racademi`,
	`hoj_histo_pares`, `hoj_histo_autorid`, `hoj_histo_perdanos`, `hoj_histo_cuales`, `hoj_histo_desescol`, `hoj_histo_anos`,`hoj_histo_escoact`, `hoj_histo_gradact`, `hoj_histo_compact`, `hoj_histo_atenact`, `hoj_histo_rendact`,
	`hoj_histo_paresact`, `hoj_histo_autoact`,`hoj_emb_tipo`, `hoj_emb_num`, `hoj_emb_edadm`, `hoj_emb_edadp`, `hoj_emb_prenat`, `hoj_emb_alcohol`,
	`hoj_emb_cigarrillo`, `hoj_emb_spa`, `hoj_emb_medic`, `hoj_emb_clmedic`,`hoj_emb_obser`, `hoj_Sosten_cefalico_meses`, `hoj_Sentarse_solo_mese`, `hoj_Gateo`, `hoj_Meses`, `hoj_Bipedestacion`, `hoj_Camino`, `hoj_palabras`, 
	`hoj_Control_de_esfi_diu mes`, `hoj_Control_de_esfi_noc_mes`, `hoj_obseDesarrollo_psicomotor`,`hoj_nomgenograma`, `hoj_Preescolar`, `hoj_Escolar`, `hoj_adolecente`,`hoj_adultojoven`, `hoj_disolucion`, `hoj_VincularAmpliaDensa`, `hoj_VinculosClaros`, `hoj_EconomicaEstable`, `hoj_ParentalesArmoniosas`, 
	 `hoj_FamiliaArmoniosasEx`, `hoj_FamiliaresSuficientes`, `hoj_PertenenciaInclusion`, `hoj_ParejaArmoniosa`, `hoj_RelacionesFraternalesArmoniosas`,
	 `hoj_BuenaSituacionLaboral`, `hoj_otra`, `hoj_cual`, `hoj_RVCTR`, `hoj_RDPC`, `hoj_SEII`, `hoj_RPC`, `hoj_RFEC`, `hoj_evnexOtra`, `hoj_VCCD`, `hoj_CSCAE`,
	 `hoj_RFI`, `hoj_RFC`, `hoj_DESL`, `hoj_evnexCual`, `hoj_comprencaso`, `hoj_hipocaso`, `hoj_oapsicoespe`, `hoj_tecnicasinter`, `hoj_imprediagnos`,`hoj_ReportadoColsun`, `hoj_ReportadoAcomp`, `hoj_Negligencia`, `hoj_AbusoPsicologico`, `hoj_ConsumoSPA`, `hoj_IdeacionSuicida`, `hoj_VinculacionNegativo`, `hoj_PresuntoAbusoSexual`, `hoj_ConsumoAlcohol`, `hoj_TrabajoInfantil`, `hoj_DificultadesConyugales`, `hoj_DificultadesFamiliaExtensa`, `hoj_Abandono`, `hoj_ViolenciaIntrafamiliar`, `hoj_IdeasMuerte`, `hoj_ExposicionContenidoSexual`, `hoj_AbusoFisico`, `hoj_ConsumoCigarrillo`, `hoj_PermanenciaCalle`, `hoj_IntentosSuicidio`, `hoj_DificultadesFraternale`FROM `hojadevida` where idhojadevida='$idhojadevida'";


		$DB1->Execute($sql);
		$rw = mysqli_fetch_row($DB1->Consulta_ID);
		$id_sedes = $rw[2];

		$sql2 = "SELECT  `idcargo`, `car_Cargo`, `car_Salario`, `car_Auxilio`, `car_otros` FROM `cargo` WHERE idcargo='$rw[35]'";
		$DB->Execute($sql2);
		$cargosaldo = mysqli_fetch_row($DB->Consulta_ID);
		$cargosaldo[1];



		echo '<tr><td><div class="btn-group">';
		echo "<button type='button'  class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datospersonales&idhojadevida=$idhojadevida'\" >Datos Personales</button>";

		echo "<button type='button' class='btn btn-primary '  onclick=\"window.location='new_hojadevida.php?condecion=Motivoconsulta&idhojadevida=$idhojadevida'\" >Motivo consulta</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Posiblescausas&idhojadevida=$idhojadevida'\" >Posibles causas</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Historialescolar&idhojadevida=$idhojadevida'\" >Historial escolar</button>";



		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Historiadeldesarrollo&idhojadevida=$idhojadevida'\" >Historia del desarrollo  </button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Antecedentesmedicosypsiquiatricosfamiliaresypersonales&idhojadevida=$idhojadevida'\" >Antecedentes médicos y psiquiátricos familiares y personales</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=GenogramaDescripcionfamiliar&idhojadevida=$idhojadevida'\" >Genograma - Descripción familiar</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Ciclovitaldelafamilia&idhojadevida=$idhojadevida'\" >Ciclo vital de la familia (según la edad del hijo mayor)</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Eventosconsideradosfortalezas&idhojadevida=$idhojadevida'\" >Eventos considerados fortalezas (Generatividad): </button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Eventosestresantes&idhojadevida=$idhojadevida'\" >Eventos estresantes (Vulnerabilidad):</button>";


		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Comprensiondelcaso&idhojadevida=$idhojadevida'\" >Comprensión del caso</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Hipotesisdelcaso&idhojadevida=$idhojadevida'\" >Hipótesis del caso</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Objetivosdelacompañamientopsicológicoespecializado&idhojadevida=$idhojadevida'\" >Objetivos del acompañamiento psicológico especializado</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Estrategiasy/otecnicasdeintervencion&idhojadevida=$idhojadevida'\" >Estrategias y/o técnicas de intervención</button>";
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=ImpresionDiagnostica&idhojadevida=$idhojadevida'\" >Impresión Diagnostica</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=sesiones&idhojadevida=$idhojadevida'\" >Sesiones</button>";
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
	$FB->abre_form("form", "newhojadevidaok.php", "post");

	$FB->titulo_azul1("Fundaciòn Psicoguirte", 10, 0, 7);
	if ($rutafoto != '') {

		$edad = edad($rw[7]);

		echo "
	<td>
	Nombre: $rw[2]" . "<br>" .
			"Edad: $edad
	</td>
	</tr>";

	}

	switch ($condecion) {

		case "datospersonales":



			$FB->titulo_azul1("Datos Personales: Consultante.", 10, 0, 5);



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
			$FB->llena_texto("Fecha de ingreso:", 1, 10, $DB, "", "", "$rw[0]", 17, 1);
			$FB->llena_texto("Num.Sim:", 2, 1, $DB, "", "", "$rw[1]", 4, 0); 	
			$FB->llena_texto("Nombre:", 3, 1, $DB, "", "", "$rw[2]", 1, 1);
			$FB->llena_texto("Apellido:", 4, 1, $DB, "", "", "$rw[3]", 4, 1);
			$FB->llena_texto("Tipo De Identificaci&oacute:", 5, 2, $DB, "(SELECT iddocumento, tip_nombre FROM tipodocumento  ORDER BY iddocumento)", "", "$rw[4]", 1, 1);
			$FB->llena_texto("Documento:", 6, 1, $DB, "", "", "$rw[5]", 1, 1);
			$FB->llena_texto("Fecha de nacimiento:", 7, 10, $DB, "", "", "$rw[6]", 4, 1);
			$FB->llena_texto("Edad:", 8, 1, $DB, "", "", "$rw[7]", 1, 1);
			$FB->llena_texto("Sede:", 9, 2, $DB, "(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0)", "", "$rw[8]", 4, 1);
			$FB->llena_texto("Direccion:", 10, 1, $DB, "", "", "$rw[9]", 1, 1);
			$FB->llena_texto("Ocupacion:", 11, 1, $DB, "", "", "$rw[10]", 4, 1);
			$FB->llena_texto("Nivel Escolaridad:", 12, 1, $DB, "", "", "$rw[11]", 4, 1);
			$FB->llena_texto("Requiere acudiente: ", 13, 82, $DB, $estados, "", "$rw[12]", 1, 1);
			// echo '<input type="hidden" name="param8" id="param8" value="1">';
			// echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";


			// if ($rw[12] == 1) {
			$FB->titulo_azul1("Datos Personales: Acudiente.", 10, 0, 5);

			$FB->llena_texto("Nombre:", 14, 1, $DB, "", "", "$rw[13]", 1, 0);
			$FB->llena_texto("Apellido:", 15, 1, $DB, "", "", "$rw[14]", 4, 0);
			$FB->llena_texto("Parentesco:", 16, 1, $DB, "", "", "$rw[15]", 1, 0);
			$FB->llena_texto("Telefono:", 17, 1, $DB, "", "", "$rw[16]", 4, 0);
			$FB->llena_texto("Ocupacion:", 18, 1, $DB, "", "", "$rw[17]", 1, 0);
			$FB->llena_texto("Nivel Escolaridad:", 19, 1, $DB, "", "", "$rw[18]", 4, 0);
			$FB->llena_texto("E-mail:", 20, 1, $DB, "", "", "$rw[19]", 1, 0);
			// } else {
			
			// }

			$caso = 'Motivoconsulta';

			$FB->cierra_tabla();
		break;
			
			
		case "Motivoconsulta":

			include('afiliacionempresa.php');

			$caso = 'Posiblescausas';


			$FB->cierra_tabla();
			break;
		case "Posiblescausas":


				include('examenesmedicos.php');
	
				$caso = 'Historialescolar';
		break;

		case "Historialescolar":
			$FB->titulo_azul1("III.	Historia Escolar:", 10, 0, 5);
			$FB->llena_texto("Edad de inicio escolarizacion:", 21, 1, $DB, "", "", "$rw[20]", 1, 0);
			$FB->llena_texto("Dificultades en lectoescritura:", 22, 82, $DB, $estados, "", "$rw[21]", 1, 0);
			$FB->llena_texto("Tratamiento:", 23, 1, $DB, "", "", "$rw[22]", 4, 0);
			$FB->llena_texto("Comportamiento:", 24, 1, $DB, "", "", "$rw[23]", 1, 0);
			$FB->llena_texto("Atencion:", 25, 1, $DB, "", "", "$rw[24]", 4, 0);
			$FB->llena_texto("Rendimiento academico:", 26, 1, $DB, "", "", "$rw[25]", 1, 0);
			$FB->llena_texto("Relacion con pares:", 27, 1, $DB, "", "", "$rw[26]", 4, 0);
			$FB->llena_texto("Relacion con figuras de autoridad:", 28, 1, $DB, "", "", "$rw[27]", 1, 0);
			$FB->llena_texto("Ha perdido anos:", 29, 82, $DB, $estados, "", "$rw[28]", 1, 0);
			$FB->llena_texto("cuales y cuantas veces:", 30, 1, $DB, "", "", "$rw[29]", 4, 0);
			$FB->llena_texto("Ha estado desescolarizado:", 31, 82, $DB, $estados, "", "$rw[30]", 1, 0);
			$FB->llena_texto("Ano(s):", 32, 1, $DB, "", "", "$rw[31]", 4, 0);
			$FB->titulo_azul1("", 10, 0, 5);
			$FB->llena_texto("Escolarizacion actual:", 33, 1, $DB, "", "", "$rw[32]", 1, 0);
			$FB->llena_texto("Grado actual:", 34, 1, $DB, "", "", "$rw[33]", 4, 0);
			$FB->llena_texto("Comportamiento:", 35, 1, $DB, "", "", "$rw[34]", 1, 0);
			$FB->llena_texto("Atencion:", 36, 1, $DB, "", "", "$rw[35]", 4, 0);
			$FB->llena_texto("Rendimiento academico:", 37, 1, $DB, "", "", "$rw[36]", 1, 0);
			$FB->llena_texto("Relacion con pares:", 38, 1, $DB, "", "", "$rw[37]", 4, 0);
			$FB->llena_texto("Relacion con figuras de autoridad:", 39, 1, $DB, "", "", "$rw[38]", 1, 0);



			$caso = 'Historiadeldesarrollo';
			$FB->cierra_tabla();
			break;
		case "Historiadeldesarrollo":

			
			$FB->titulo_azul1("IV.	Historia del desarrollo ", 10, 0, 5);
			$FB->titulo_azul1("Historia del embarazo:", 10, 0, 5);
			$FB->llena_texto("Tipo de embarazo:", 40, 82, $DB, $embarazo, "", "$rw[39]", 1, 0);
			$FB->llena_texto("Numero de embarazo ", 41, 1, $DB, "", "", "$rw[40]", 4, 0);
			$FB->llena_texto("Edad de la madre: :", 42, 1, $DB, "", "", "$rw[41]", 1, 0);
			$FB->llena_texto("Edad del padre:", 43, 1, $DB, "", "", "$rw[42]", 4, 0);
			$FB->llena_texto("Asistio a controles prenatales: ", 44, 82, $DB, $estados, "", "$rw[43]", 1, 0);
			$FB->titulo_azul1("Historia de consumo:", 10, 0, 5);
			$FB->llena_texto("Alcohol:", 45, 5, $DB, "", "", "$rw[44]", 1, 0);
			$FB->llena_texto("Cigarrillo:", 46, 5, $DB, "", "", "$rw[45]", 4, 0);
			$FB->llena_texto("SPA:", 47, 5, $DB, "", "", "$rw[46]", 1, 0);
			$FB->llena_texto("Medicamentos:", 48, 5, $DB, "", "", "$rw[47]", 1, 0);
			$FB->llena_texto("Cuales Medicamentos:", 49, 1, $DB, "", "", "$rw[48]", 4, 0);
			echo "<td><label>Observaciones:</label></td>";
			echo "<td><textarea name='param50' id='param50' value='' style='width:350px; height:150px; class='text' >$rw[49]</textarea></td>";
			$FB->titulo_azul1("Desarrollo psicomotor:", 10, 0, 5);
			$FB->llena_texto("Sosten cefalico meses:", 51, 1, $DB, "", "", "$rw[50]", 1, 0);
			$FB->llena_texto("Sentarse solo mese:", 52, 1, $DB, "", "", "$rw[51]", 4, 0);
			$FB->llena_texto("Gateo: ", 53, 82, $DB, $estados, "", "$rw[52]", 1, 1);
			$FB->llena_texto("Meses:", 54, 1, $DB, "", "", "$rw[53]", 4, 0);
			$FB->llena_texto("Bipedestacion:", 55, 1, $DB, "", "", "$rw[54]", 1, 0);
			$FB->llena_texto("Camino:", 56, 1, $DB, "", "", "$rw[55]", 4, 0);
			$FB->llena_texto("palabras:", 57, 1, $DB, "", "", "$rw[56]", 1, 0);
			$FB->llena_texto("Control de esfinteres diurnos meses:", 58, 1, $DB, "", "", "$rw[57]", 4, 0);
			$FB->llena_texto("Control de esfinteres nocturnos meses:", 59, 1, $DB, "", "", "$rw[58]", 4, 0);
			echo "<td><label>Observaciones:</label></td>";
			echo "<td><textarea name='param60' id='param60' value='' style='width:350px; height:150px; class='text' >$rw[59]</textarea></td>";
			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
			
			// $FB->llena_texto("Estado civil:", 17, 82, $DB, $estadocivil, "", "$rw[10]", 17, 1);
// $FB->llena_texto("Nombre de Esposa(o):",14, 1, $DB, "", "", "$rw[14]", 4, 0);
// $FB->llena_texto("Profesi&oacute;n, ocupaci&oacute;n u oficio:", 15, 1, $DB, "", "", "$rw[15]", 17, 0);
// $FB->llena_texto("Celular:",16, 1, $DB, "", "", "$rw[16]", 4, 0);
	

			$FB->cierra_tabla();
			$caso = 'Antecedentesmedicosypsiquiatricosfamiliaresypersonales';
			break;
		case "Antecedentesmedicosypsiquiatricosfamiliaresypersonales":

			include('referenciasfami.php');

			$FB->cierra_tabla();
			$caso = 'GenogramaDescripcionfamiliar';
			break;

		case "GenogramaDescripcionfamiliar":

			// include('seguridadsocial.php');
			$FB->titulo_azul1("VI.	Genograma - Descripción familiar..",10,0,5);  

			$FB->llena_texto("Seleccione la imagen:",110, 6, $DB, "", "", "",1, 0);

			echo"<td><a href='imghistorial/$rw[60]'>Ver imagen</a></td>";

			// $FB->cierra_tabla();
			$caso = 'Ciclovitaldelafamilia';
			break;

		case "Ciclovitaldelafamilia":

			// include('afiliacionessalud.php');

			// $FB->cierra_tabla();
			$FB->titulo_azul1("VII.	Ciclo vital de la familia ",9,0,7);  
			echo "</tr>";
			
			$FB->llena_texto("Preescolar (0 a 5 anos):", 1, 5, $DB, $tipoexamen, "", "$rw[61]", 1, 0);
			$FB->llena_texto("Edad escolar (6 a 12 anos):", 2, 5, $DB, $tipoexamen, "", "$rw[62]", 1, 0);
			$FB->llena_texto("Adolescente:", 3, 5, $DB, $tipoexamen, "", "$rw[63]", 1, 0);
			$FB->llena_texto("Adultos Jovenes (19 a 30 anos):", 4, 5, $DB, $tipoexamen, "", "$rw[64]", 1, 0);
			$FB->llena_texto("Disolucion:", 5, 5, $DB, $tipoexamen, "", "$rw[65]", 1, 0);
			
			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';

			$caso = 'Eventosconsideradosfortalezas';
			break;

		case "Eventosconsideradosfortalezas":

			// include('entregavehiculo.php');

			// $FB->cierra_tabla();
			$FB->titulo_azul1("VIII.	Eventos considerados fortalezas (Generatividad): ",9,0,7);  
			echo "</tr>";
			
			$FB->llena_texto("Red Vincular amplia y densa:", 71, 5, $DB, $tipoexamen, "", "$rw[66]", 1, 0);
			$FB->llena_texto("Recursos familiares suficientes:", 76, 5, $DB, $tipoexamen, "", "$rw[71]", 4, 0);

			$FB->llena_texto("Vinculos claros- acuerdos (Autonomia):", 72, 5, $DB, $tipoexamen, "", "$rw[67]", 1, 0);
			$FB->llena_texto("Contexto socio cultural. Pertenencia/inclusion:", 77, 5, $DB, $tipoexamen, "", "$rw[72]", 4, 0);
			
			$FB->llena_texto("Situacion economica estable, suficiente:", 73, 5, $DB, $tipoexamen, "", "$rw[68]", 1, 0);
			$FB->llena_texto("Relacion de Pareja armoniosa:", 78, 5, $DB, $tipoexamen, "", "$rw[73]", 4, 0);
			
			$FB->llena_texto("Relaciones Parentales armoniosas:", 74, 5, $DB, $tipoexamen, "", "$rw[69]", 1, 0);
			$FB->llena_texto("Relaciones Fraternales armoniosas:", 79, 5, $DB, $tipoexamen, "", "$rw[74]", 4, 0);
			
			$FB->llena_texto("Relaciones familia extensa armoniosas:", 75, 5, $DB, $tipoexamen, "", "$rw[70]", 1, 0);
			$FB->llena_texto("Buena situacion laboral:", 80, 5, $DB, $tipoexamen, "", "$rw[75]", 4, 0);
			
			$FB->llena_texto("Otra:", 81, 5, $DB, $tipoexamen, "", "$rw[76]", 1, 0);
			$FB->llena_texto("Cual:",82, 1, $DB, "", "", "$rw[77]", 4, 0);
			
			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';



			$caso = 'Eventosestresantes';
			break;
		case "Eventosestresantes":

			// include('dotacion.php');

			// $FB->cierra_tabla();
			$FB->titulo_azul1("Eventos estresantes ",9,0,7);  
			echo "</tr>";
			
			$FB->llena_texto("Red Vincular con tamano reducido :", 10, 5, $DB, $tipoexamen, "", "$rw[78]", 1, 0);
			$FB->llena_texto("Vinculos confusos- conflictos (Dependencia):", 16, 5, $DB, $tipoexamen, "", "$rw[84]", 4, 0);

			$FB->llena_texto("Relacion de Pareja conflictiva:",11, 5, $DB, $tipoexamen, "", "$rw[79]", 1, 0);
			$FB->llena_texto("Contexto socio cultural. anonimato/exclusion:", 17, 5, $DB, $tipoexamen, "", "$rw[85]", 4, 0);
			
			$FB->llena_texto("Situacion economica inestable, insuficiente:", 12, 5, $DB, $tipoexamen, "", "$rw[80]", 1, 0);
			$FB->llena_texto("Recursos familiares Insuficientes:", 18, 5, $DB, $tipoexamen, "", "$rw[86]", 4, 0);
			
			$FB->llena_texto("Relaciones Parentales conflictivas:", 13, 5, $DB, $tipoexamen, "", "$rw[81]", 1, 0);
			$FB->llena_texto("Relaciones Fraternales conflictivas:", 19, 5, $DB, $tipoexamen, "", "$rw[87]", 4, 0);
			
			$FB->llena_texto("Relaciones familia extensa conflictivas:", 14, 5, $DB, $tipoexamen, "", "$rw[82]", 1, 0);
			$FB->llena_texto("Dificultades en situacion laboral:", 20, 5, $DB, $tipoexamen, "", "$rw[88]", 4, 0);
			
			$FB->llena_texto("Otra:", 15, 5, $DB, $tipoexamen, "", "$rw[83]", 1, 0);
			$FB->llena_texto("Cual:",21, 1, $DB, "", "", "$rw[89]", 4, 0);
			
			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';

			$caso = 'Comprensiondelcaso';
			break;

		///INCAPACIDADES == NOVEDADES
		case "Comprensiondelcaso":

			// require_once('incapacidades.php');

			// $FB->cierra_tabla();
			$FB->titulo_azul1("X. Comprensión del caso: ",9,0,7);  
			echo "</tr>";
			
			echo "<td><label>Comprensión del caso:</label></td>";
			echo "<td><textarea name='param10' id='param10' value='' style='width:600px; height:150px; class='text' >$rw[90]</textarea></td>";
			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
			
			

			$caso = 'Hipotesisdelcaso';

			break;
		case "Hipotesisdelcaso":

			// require_once('memorandos.php');

			$FB->titulo_azul1("XI.	Hipótesis del caso",9,0,7);  
			echo "</tr>";

			echo "<td><label>XI. Hipótesis del caso:</label></td>";
			echo "<td><textarea name='param11' id='param11' value='' style='width:600px; height:150px; class='text' >$rw[91]</textarea></td>";
			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';// $FB->cierra_tabla();

			$caso = 'Objetivosdelacompañamientopsicológicoespecializado';

			break;

		case "Objetivosdelacompañamientopsicológicoespecializado":

			// include('terminacioncontrato.php');

			// $FB->cierra_tabla();
			$FB->titulo_azul1("XII.	Objetivos del acompañamiento psicológico especializado: ",9,0,7);  
			echo "</tr>";
			
			echo "<td><label>XII. Objetivos del acompañamiento psicológico especializado:</label></td>";
			echo "<td><textarea name='param12' id='param12' value='' style='width:600px; height:150px; class='text' >$rw[92]</textarea></td>";
			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';

			$caso = 'Estrategiasy/otecnicasdeintervencion';

			break;
		case "Estrategiasy/otecnicasdeintervencion":



			$FB->titulo_azul1("XIII. Estrategias y/o técnicas de intervención: ",9,0,7);  
			echo "</tr>";

			echo "<td><label>XI. Estrategias y/o técnicas de intervención:</label></td>";
			echo "<td><textarea name='param13' id='param13' value='' style='width:600px; height:150px; class='text' >$rw[93]</textarea></td>";

			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
			// include('form1.php');

			// $FB->cierra_tabla();
			$caso = 'ImpresionDiagnostica';

			break;

		case "ImpresionDiagnostica":
			// include('form2.php');
			// $FB->cierra_tabla();

			$FB->titulo_azul1("Impresión Diagnostica: ",9,0,7);  
			echo "</tr>";
			
			echo "<td><label>XIV. Impresión Diagnostica:</label></td>";
			echo "<td><textarea name='param14' id='param14' value='' style='width:600px; height:150px; class='text' >$rw[94]</textarea></td>";
			
			echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';

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
<input type="hidden" name="idhojadevida" id="idhojadevida" value="' . $idhojadevida . '">
</table>';
	echo '</div>';


	echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'><input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='' 
	onClick='javascript:history.back();' value='Atras' style='width:190px;'>
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type=''  onclick=\"window.location='historiasClinicas.php?'\" value='Cerrar' style='width:190px;'>";
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
	


 