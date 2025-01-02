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




     $sql = "SELECT `idterocu`, `teOcu_param1`, `teOcu_param2`, `teOcu_param3`, `teOcu_param4`, `teOcu_param5`, `teOcu_param6`, `teOcu_param7`, `teOcu_param8`, `teOcu_param9`, `teOcu_param10`, `teOcu_param11`, `teOcu_param12`, `teOcu_param13`, `teOcu_param14`, `teOcu_param15`, `teOcu_param16`, `teOcu_param17`, `teOcu_param18`, `teOcu_param19`, `teOcu_param20`, `teOcu_param21`, `teOcu_param22`, `teOcu_param23`, `teOcu_param24`, `teOcu_param25`, `teOcu_param26`, `teOcu_param27`, `teOcu_param28`, `teOcu_param29`, `teOcu_param30`, `teOcu_param31`, `teOcu_param32`, `teOcu_param33`, `teOcu_param34`, `teOcu_param35`, `teOcu_param36`, `teOcu_param37`, `teOcu_param38`, `teOcu_param39`, `teOcu_param40`, `teOcu_param41`, `teOcu_param42`, `teOcu_param43`, `teOcu_param44`, `teOcu_param45`, `teOcu_param46`, `teOcu_param47`, `teOcu_param48`, `teOcu_param49`, `teOcu_param50`, `teOcu_param51`, `teOcu_param52`, `teOcu_param53`, `teOcu_param54`, `teOcu_param55`, `teOcu_param56`, `teOcu_param57`, `teOcu_param58`, `teOcu_param59`, `teOcu_param60`, `teOcu_param61`, `teOcu_param62`, `teOcu_param63`, `teOcu_param64`, `teOcu_param65`, `teOcu_param66`, `teOcu_param67`, `teOcu_param68`, `teOcu_param69`, `teOcu_param70`, `teOcu_param71`, `teOcu_param72`, `teOcu_param73`, `teOcu_param74`, `teOcu_param75`, `teOcu_param76`, `teOcu_param77`, `teOcu_param78`, `teOcu_param79`, `teOcu_param80`, `teOcu_param81`, `teOcu_param82`, `teOcu_param83`, `teOcu_param84`, `teOcu_param85`, `teOcu_param86`, `teOcu_param87`, `teOcu_param88`, `teOcu_param89`, `teOcu_param90`, `teOcu_param91`, `teOcu_param92`, `teOcu_param93`, `teOcu_param94`, `teOcu_param95`, `teOcu_param96`, `teOcu_param97`, `teOcu_param98`, `teOcu_param99`, `teOcu_param100`, `teOcu_param101`, `teOcu_param102`, `teOcu_param103`, `teOcu_param104`, `teOcu_param105`, `teOcu_param106`, `teOcu_param107`, `teOcu_param108`, `teOcu_param109`, `teOcu_param110`, `teOcu_param111`, `teOcu_param112`, `teOcu_param113`, `teOcu_param114`, `teOcu_param115`, `teOcu_param116`, `teOcu_param117`, `teOcu_param118`, `teOcu_param119`, `teOcu_param120`, `teOcu_param121`, `teOcu_param122`, `teOcu_param123`, `teOcu_param124`, `teOcu_param125`, `teOcu_param126`, `teOcu_param127`, `teOcu_param128`, `teOcu_param129`, `teOcu_param130`, `teOcu_param131`, `teOcu_param132`, `teOcu_param133`, `teOcu_param134`, `teOcu_param135`, `teOcu_param136`, `teOcu_param137`, `teOcu_param138`, `teOcu_param139`, `teOcu_param140`, `teOcu_param141`, `teOcu_param142`, `teOcu_param143`, `teOcu_param144`, `teOcu_param145`, `teOcu_param146`, `teOcu_param147`, `teOcu_param148`, `teOcu_param149`, `teOcu_param150`, `teOcu_param151`, `teOcu_param152`, `teOcu_param153`, `teOcu_param154`, `teOcu_param155`, `teOcu_param156`, `teOcu_param157`, `teOcu_param158`, `teOcu_param159`, `teOcu_param160`, `teOcu_param161`, `teOcu_param162`, `teOcu_param163`, `teOcu_param164`, `teOcu_param165`, `teOcu_param166`, `teOcu_param167`, `teOcu_param168`, `teOcu_param169`, `teOcu_param170`, `teOcu_param171`, `teOcu_param172`, `teOcu_param173`, `teOcu_param174`, `teOcu_param175`, `teOcu_param176`, `teOcu_param177`, `teOcu_param178`, `teOcu_param179`, `teOcu_param180`, `teOcu_param181`, `teOcu_param182`, `teOcu_param183`, `teOcu_param184`, `teOcu_param185`, `teOcu_param186`, `teOcu_param187`, `teOcu_param188`, `teOcu_param189`, `teOcu_param190`, `teOcu_param191`, `teOcu_param192`, `teOcu_param193`, `teOcu_param194`, `teOcu_param195`, `teOcu_param196`, `teOcu_param197`, `teOcu_param198`, `teOcu_param199`, `teOcu_param200`, `teOcu_param201`, `teOcu_param202`, `teOcu_param203`, `teOcu_param204`, `teOcu_param205`, `teOcu_param206`, `teOcu_param207`, `teOcu_param208`, `teOcu_param209`, `teOcu_param210`, `teOcu_param211`, `teOcu_param212`, `teOcu_param213`, `teOcu_param214`, `teOcu_param215`, `teOcu_param216`, `teOcu_param217`, `teOcu_param218`, `teOcu_param219`, `teOcu_param220`, `teOcu_param221`, `teOcu_param222`, `teOcu_param223`, `teOcu_param224`, `teOcu_param225`, `teOcu_param226`, `teOcu_param227`, `teOcu_param228`, `teOcu_param229`, `teOcu_param230`, `teOcu_param231`, `teOcu_param232`, `teOcu_param233`, `teOcu_param234`, `teOcu_param235`, `teOcu_param236`, `teOcu_param237`, `teOcu_param238`, `teOcu_param239`, `teOcu_param240`, `teOcu_param241`, `teOcu_param242`, `teOcu_param243`, `teOcu_param244`, `teOcu_param245`, `teOcu_param246`, `teOcu_param247`, `teOcu_param248`, `teOcu_param249`, `teOcu_param250`, `teOcu_param251`, `teOcu_param252`, `teOcu_param253`, `teOcu_param254`, `teOcu_param255`, `teOcu_param256`, `teOcu_param257`, `teOcu_param258`, `teOcu_param259`, `teOcu_param260`, `teOcu_param261`, `teOcu_param262`, `teOcu_param263`, `teOcu_param264`, `teOcu_param265` FROM `terapiaOcupacional` WHERE idterocu='$idPareja'";


		$DB1->Execute($sql);
		$rw = mysqli_fetch_row($DB1->Consulta_ID);
		$id_sedes = $rw[2];

		// $sql2 = "SELECT  `idcargo`, `car_Cargo`, `car_Salario`, `car_Auxilio`, `car_otros` FROM `cargo` WHERE idcargo='$rw[35]'";
		// $DB->Execute($sql2);
		// $cargosaldo = mysqli_fetch_row($DB->Consulta_ID);
		// $cargosaldo[1];



		echo '<tr><td>
<div class="btn-group">';
		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='terapiaOcupacion.php?condecion=datosocupacional&idPareja=$idPareja'\" >Datos</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='terapiaOcupacion.php?condecion=Neuromuscular&idPareja=$idPareja'\" >Componente Neuromuscular</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='terapiaOcupacion.php?condecion=Amplitud&idPareja=$idPareja'\" >Componente Neuromuscular</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='terapiaOcupacion.php?condecion=Coordinacion&idPareja=$idPareja'\" >Habilidades motoras gruesas</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='terapiaOcupacion.php?condecion=sensorio&idPareja=$idPareja'\" >Habilidades sensorio</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='terapiaOcupacion.php?condecion=Procesos&idPareja=$idPareja'\" >Procesos superiores</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='terapiaOcupacion.php?condecion=Autocuidado&idPareja=$idPareja'\" >Autocuidado</button>";

		echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='terapiaOcupacion.php?condecion=Procesamiento&idPareja=$idPareja'\" >Habilidades de procesamiento sensorial
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
	$FB->abre_form("form", "terapiaOcupacionOk.php", "post");

	$FB->titulo_azul1("Fundaciòn Psicoguirte", 10, 0, 7);
	if ($rutafoto != '') {

	// 	$edad = edad($rw[5]);

	// 	echo "<tr><td><img src='imghojadevida/fotos/$rw[41]' class='img-circle' alt='User Image' style='background-color:#FF0000;width:80px;height:80px' /><td>
	// <td>
	// Nombre: $rw[2]" . "<br>" .
	// 		"Edad: $edad
	// </td>
	// </tr>";

	}
	$condecion;
	switch ($condecion) {

		case "datosocupacional":    
        
        	$FB->titulo_azul1("<h4>TERAPIA OCUPACIONAL.</h4>", 10, 0, 5);
			$FB->titulo_azul1( "1.FORMATO DE VALORACION.", 10, 0, 5);



			if ($rw[1] > 0 and $nivel_acceso != 1) {
				$habi = 2;
			} else {
				$habi = 1;
			}
			$FB->llena_texto("Nombre:", 1, 1, $DB, "", "", "$rw[1]", 1, 0); 	
			$FB->llena_texto("H.C:", 2, 1, $DB, "", "", "$rw[2]", 4, 0);
			$FB->llena_texto("Edad:", 3, 1, $DB, "", "", "$rw[3]", 1, 0);
            $FB->llena_texto("F.N:", 4, 1, $DB, "", "", "$rw[4]", 4, 0); 	
			$FB->llena_texto("Escolaridad:", 5, 1, $DB, "", "", "$rw[5]", 1, 0);
			$FB->llena_texto("Dominancia:", 6, 1, $DB, "", "", "$rw[6]", 4, 0);
			$FB->llena_texto("Diagnostico:", 7, 1, $DB, "", "", "$rw[7]", 1, 0);
			$FB->llena_texto("Incapacidad:", 8, 1, $DB, "", "", "$rw[8]", 4, 0);
			$FB->llena_texto("Fecha de evaluacion:", 9, 10, $DB, "", "", "$rw[9]", 1, 0);

            $caso = 'Neuromuscular';
			$FB->cierra_tabla();
		break;

		case "Neuromuscular":

			$FB->titulo_azul1("<h4> Componente Neuromuscular.<h4><h5> Tono muscular.<h5> ", 10, 0, 5);
			
			$FB->titulo_azul1("Flacidez. ", 10, 0, 7);			
		   echo '</tr> ';
		   echo '<td><label> MMSS:</label></td>'; 
		   $FB->llena_texto("Derecho:", 1, 1, $DB, "", "", "$rw[10]", 1, 0);
		   $FB->llena_texto("Izquierdo:",2, 1, $DB, "", "", "$rw[11]", 4, 0);		   

		   echo '<td><label> MM:</label></td>'; 
		   $FB->llena_texto("Derecho:", 3, 1, $DB, "", "", "$rw[12]", 1, 0);
		   $FB->llena_texto("Izquierdo:",4, 1, $DB, "", "", "$rw[13]", 4, 0);	

		   $FB->titulo_azul1("Espasticidad.", 10, 0, 7);	
		   echo '</tr> ';
		   echo '<td><label> MMSS:</label></td>'; 
		   $FB->llena_texto("Derecho:",5, 1, $DB, "", "", "$rw[14]", 1, 0);
		   $FB->llena_texto("Izquierdo:",6, 1, $DB, "", "", "$rw[15]", 4, 0);		   

		   echo '<td><label> MM:</label></td>'; 
		   $FB->llena_texto("Derecho:", 7, 1, $DB, "", "", "$rw[16]", 1, 0);
		   $FB->llena_texto("Izquierdo:",8, 1, $DB, "", "", "$rw[17]", 4, 0);	

		   $FB->titulo_azul1("Normal.", 10, 0, 7);	  
		   echo '</tr> ';
		   echo '<td><label> MMSS:</label></td>'; 
		   $FB->llena_texto("Derecho:", 9, 1, $DB, "", "", "$rw[18]", 1, 0);
		   $FB->llena_texto("Izquierdo:", 10, 1, $DB, "", "", "$rw[19]", 4, 0);		   

		   echo '<td><label> MM:</label></td>'; 
		   $FB->llena_texto("Derecho:",11, 1, $DB, "", "", "$rw[20]", 1, 0);
		   $FB->llena_texto("Izquierdo:",12, 1, $DB, "", "", "$rw[21]", 4, 0);	

		   echo "<tr>";

		   echo '<td><label>Observaciones:</label></td>';  
		 
		 echo '<td><textarea name="param13" id="param13" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[22].'</textarea></td>';
          
		 echo "<tr>";
		 $FB->titulo_azul1("<h5> Fuerza Muscular. Defina del 0 al 5 cada Item.<h5> ", 10, 0, 5);

		 echo "<tr>";
		   echo '<td><label>0: No movimiento.</label></td>'; 
		   echo "<tr>";
		   echo '<td><label>1: Inicia movimiento.</label></td>';
		   echo "<tr>";
		   echo '<td><label>2: Mitad de movimiento.</label></td>';
		   echo "<tr>";
		   echo '<td><label>3: Movimiento completo con gravedad.</label></td>';
		   echo "<tr>";
		   echo '<td><label>4: Movimiento completo contra gravedad ligera resistencia.</label></td>';
		   echo "<tr>";
		   echo '<td><label>5: Movimiento completo contra gravedad con máxima resistencia.</label></td>';

		   $FB->titulo_azul1("Evaluación de la escapula. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",14, 1, $DB, "", "", "$rw[23]", 1, 0);
		   $FB->llena_texto("MSI:",15, 1, $DB, "", "", "$rw[24]", 4, 0);		   

		   $FB->titulo_azul1("Depresión escapula. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",16, 1, $DB, "", "", "$rw[25]", 1, 0);
		   $FB->llena_texto("MSI:",17, 1, $DB, "", "", "$rw[26]", 4, 0);	

		   $FB->titulo_azul1("Protracción de escapula. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",18, 1, $DB, "", "", "$rw[27]", 1, 0);
		   $FB->llena_texto("MSI:",19, 1, $DB, "", "", "$rw[28]", 4, 0);		   

		   $FB->titulo_azul1("Flexión de hombro. ", 10, 0, 7);	
		   echo '</tr> '; 
		   $FB->llena_texto("MSD:",20, 1, $DB, "", "", "$rw[29]", 1, 0);
		   $FB->llena_texto("MSI:",21, 1, $DB, "", "", "$rw[30]", 4, 0);	

		   $FB->titulo_azul1("Extensión de hombro. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",22, 1, $DB, "", "", "$rw[31]", 1, 0);
		   $FB->llena_texto("MSI:",23, 1, $DB, "", "", "$rw[32]", 4, 0);		   

		   $FB->titulo_azul1("Abducción de hombro. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",24, 1, $DB, "", "", "$rw[33]", 1, 0);
		   $FB->llena_texto("MSI:",25, 1, $DB, "", "", "$rw[34]", 4, 0);
		   
		   $FB->titulo_azul1("Aducción de hombro. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",26, 1, $DB, "", "", "$rw[35]", 1, 0);
		   $FB->llena_texto("MSI:",27, 1, $DB, "", "", "$rw[36]", 4, 0);

		   $FB->titulo_azul1("Rotación interna de hombro. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",28, 1, $DB, "", "", "$rw[37]", 1, 0);
		   $FB->llena_texto("MSI:",29, 1, $DB, "", "", "$rw[38]", 4, 0);		   

		   $FB->titulo_azul1("Rotación externa de hombro ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",30, 1, $DB, "", "", "$rw[39]", 1, 0);
		   $FB->llena_texto("MSI:",31, 1, $DB, "", "", "$rw[40]", 4, 0);	

		   $FB->titulo_azul1("Flexión de codo. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",32, 1, $DB, "", "", "$rw[41]", 1, 0);
		   $FB->llena_texto("MSI:",33, 1, $DB, "", "", "$rw[42]", 4, 0);		   

		   $FB->titulo_azul1("Extensión de codo. ", 10, 0, 7);	
		   echo '</tr> '; 
		   $FB->llena_texto("MSD:",34, 1, $DB, "", "", "$rw[43]", 1, 0);
		   $FB->llena_texto("MSI:",35, 1, $DB, "", "", "$rw[44]", 4, 0);	

		   $FB->titulo_azul1("Pronación de antebrazo. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",36, 1, $DB, "", "", "$rw[45]", 1, 0);
		   $FB->llena_texto("MSI:",37, 1, $DB, "", "", "$rw[46]", 4, 0);		   

		   $FB->titulo_azul1("Supinación de antebrazo. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",38, 1, $DB, "", "", "$rw[47]", 1, 0);
		   $FB->llena_texto("MSI:",39, 1, $DB, "", "", "$rw[48]", 4, 0);	

		   $FB->titulo_azul1("Flexión de muñeca. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",40, 1, $DB, "", "", "$rw[49]", 1, 0);
		   $FB->llena_texto("MSI:",41, 1, $DB, "", "", "$rw[50]", 4, 0);		   

		   $FB->titulo_azul1("Extensión de muñeca. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:",42, 1, $DB, "", "", "$rw[51]", 1, 0);
		   $FB->llena_texto("MSI:",43, 1, $DB, "", "", "$rw[52]", 4, 0);

		   $FB->titulo_azul1("Abducción de dedos. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 44, 1, $DB, "", "", "$rw[53]", 1, 0);
		   $FB->llena_texto("MSI:", 45, 1, $DB, "", "", "$rw[54]", 4, 0);		   

		   $FB->titulo_azul1("Aducción de dedos. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 46, 1, $DB, "", "", "$rw[55]", 1, 0);
		   $FB->llena_texto("MSI:", 47, 1, $DB, "", "", "$rw[56]", 4, 0);	

		   $FB->titulo_azul1("Add. cadera. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 48, 1, $DB, "", "", "$rw[57]", 1, 0);
		   $FB->llena_texto("MSI:", 49, 1, $DB, "", "", "$rw[58]", 4, 0);		   

		   $FB->titulo_azul1("Rotación interna de cadera. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 50, 1, $DB, "", "", "$rw[59]", 1, 0);
		   $FB->llena_texto("MSI:", 51, 1, $DB, "", "", "$rw[60]", 4, 0);

		   $FB->titulo_azul1("Rotación externa de cadera. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 52, 1, $DB, "", "", "$rw[61]", 1, 0);
		   $FB->llena_texto("MSI:", 53, 1, $DB, "", "", "$rw[62]", 4, 0);

		   $FB->titulo_azul1("Flexión de rodilla. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 54, 1, $DB, "", "", "$rw[63]", 1, 0);
		   $FB->llena_texto("MSI:", 55, 1, $DB, "", "", "$rw[64]", 4, 0);		   

		   $FB->titulo_azul1("Inversión de rodilla. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 56, 1, $DB, "", "", "$rw[65]", 1, 0);
		   $FB->llena_texto("MSI:", 57, 1, $DB, "", "", "$rw[66]", 4, 0);	

		   $FB->titulo_azul1("Inversión de tobillo. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 58, 1, $DB, "", "", "$rw[67]", 1, 0);
		   $FB->llena_texto("MSI:", 59, 1, $DB, "", "", "$rw[68]", 4, 0);		   

		   $FB->titulo_azul1("Eversión de tobillo. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 60, 1, $DB, "", "", "$rw[69]", 1, 0);
		   $FB->llena_texto("MSI:", 61, 1, $DB, "", "", "$rw[70]", 4, 0);

		   $FB->titulo_azul1("Flexión plantar. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 62, 1, $DB, "", "", "$rw[71]", 1, 0);
		   $FB->llena_texto("MSI:", 63, 1, $DB, "", "", "$rw[72]", 4, 0);		   

		   $FB->titulo_azul1("Extensión de dedos. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 64, 1, $DB, "", "", "$rw[73]", 1, 0);
		   $FB->llena_texto("MSI:", 65, 1, $DB, "", "", "$rw[74]", 4, 0);	

		   $FB->titulo_azul1("Flexión dedos del pie. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 66, 1, $DB, "", "", "$rw[75]", 1, 0);
		   $FB->llena_texto("MSI:", 67, 1, $DB, "", "", "$rw[76]", 4, 0);		   

		   $FB->titulo_azul1("Flexión Hallux. ", 10, 0, 7);	
		   echo '</tr> ';
		   $FB->llena_texto("MSD:", 68, 1, $DB, "", "", "$rw[77]", 1, 0);
		   $FB->llena_texto("MSI:", 69, 1, $DB, "", "", "$rw[78]", 4, 0);

		   echo "<tr>";

		   echo '<td><label>Observaciones:</label></td>';  
		 
		 echo '<td><textarea name="param79" id="param79" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[77].'</textarea></td>';

			$caso = 'Amplitud';
			$FB->cierra_tabla();
			break;

		case "Amplitud":
            $FB->titulo_azul1("<h4> 2.Componente Neuromuscular.<h4><h5>Amplitud Articular.<h5> ", 10, 0, 5);
			$FB->titulo_azul1("Tipos de movimiento. ", 10, 0, 7);	
			echo '</tr> ';
			
		   echo '<td><label>Activo.</label></td>'; 
		   echo "<tr>";
		   echo '<td><label>Pasivo.</label></td>';
		   echo "<tr>";
		   echo '<td><label>Activo - Pasivo.</label></td>';
		   echo "<tr>";
		   echo '<td><label>Activo - asistido.</label></td>';
		   echo "<tr>";		   
		   
		   $FB->titulo_azul1("Hombro.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 1, 82, $DB, $Articular, "", "$rw[78]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 2, 82, $DB, $Articular, "", "$rw[79]", 1, 0);

		   $FB->titulo_azul1("Codo.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 3, 82, $DB, $Articular, "", "$rw[80]", 1, 0);
		   $FB->llena_texto("Izquierdo: ",4, 82, $DB, $Articular, "", "$rw[81]", 1, 0);

		   $FB->titulo_azul1("Antebrazo.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 5, 82, $DB, $Articular, "", "$rw[82]", 1, 0);
		   $FB->llena_texto("Izquierdo: ",6, 82, $DB, $Articular, "", "$rw[83]", 1, 0);

		   $FB->titulo_azul1("Muñeca.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 7, 82, $DB, $Articular, "", "$rw[84]", 1, 0);
		   $FB->llena_texto("Izquierdo: ",8, 82, $DB, $Articular, "", "$rw[85]", 1, 0);

		   $FB->titulo_azul1("Dedos.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 9, 82, $DB, $Articular, "", "$rw[86]", 1, 0);
		   $FB->llena_texto("Izquierdo: ",10, 82, $DB, $Articular, "", "$rw[87]", 1, 0);

		   $FB->titulo_azul1("Cadera.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 11, 82, $DB, $Articular, "", "$rw[88]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 12, 82, $DB, $Articular, "", "$rw[89]", 1, 0);

		   $FB->titulo_azul1("Rodilla.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 13, 82, $DB, $Articular, "", "$rw[90]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 14, 82, $DB, $Articular, "", "$rw[91]", 1, 0);

		   $FB->titulo_azul1("Cuello del pie.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 15, 82, $DB, $Articular, "", "$rw[92]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 16, 82, $DB, $Articular, "", "$rw[93]", 1, 0);
	
		   $FB->titulo_azul1("Dedos del pie.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 17, 82, $DB, $Articular, "", "$rw[94]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 18, 82, $DB, $Articular, "", "$rw[95]", 1, 0);

		   echo '<br>';
		   echo '<br>';
		   $FB->titulo_azul1("<h4>Patrones de la Mano.<h4><h5>Amplitud Articular.<h5> ", 10, 0, 5);
			echo '</tr> ';

			$FB->titulo_azul1("Mano – Cabeza.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 19, 82, $DB, $Patrones, "", "$rw[96]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 20, 82, $DB, $Patrones, "", "$rw[97]", 1, 0);
	
		   $FB->titulo_azul1("Mano – Nuca.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 21, 82, $DB, $Patrones, "", "$rw[98]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 22, 82, $DB, $Patrones, "", "$rw[99]", 1, 0);

		   $FB->titulo_azul1("Mano – Cuello.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 23, 82, $DB, $Patrones, "", "$rw[100]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 24, 82, $DB, $Patrones, "", "$rw[101]", 1, 0);
	
		   $FB->titulo_azul1("Mano – Hombro homolateral.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 25, 82, $DB, $Patrones, "", "$rw[102]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 26, 82, $DB, $Patrones, "", "$rw[103]", 1, 0);

		   $FB->titulo_azul1("Mano – Hombro contralateral.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 27, 82, $DB, $Patrones, "", "$rw[104]", 1, 0);
		   $FB->llena_texto("Izquierdo: ",28, 82, $DB, $Patrones, "", "$rw[105]", 1, 0);
	
		   $FB->titulo_azul1("Mano – Espalda.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 29, 82, $DB, $Patrones, "", "$rw[106]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 30, 82, $DB, $Patrones, "", "$rw[107]", 1, 0);

		   $FB->titulo_azul1("Mano – Cintura.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 31, 82, $DB, $Patrones, "", "$rw[108]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 32, 82, $DB, $Patrones, "", "$rw[109]", 1, 0);
	
		   $FB->titulo_azul1("Mano – periné.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 33, 82, $DB, $Patrones, "", "$rw[110]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 34, 82, $DB, $Patrones, "", "$rw[111]", 1, 0);

		   $FB->titulo_azul1("Mano – Rodilla.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 35, 82, $DB, $Patrones, "", "$rw[112]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 36, 82, $DB, $Patrones, "", "$rw[113]", 1, 0);
	
		   $FB->titulo_azul1("Mano – Pie.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 37, 82, $DB, $Patrones, "", "$rw[114]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 38, 82, $DB, $Patrones, "", "$rw[115]", 1, 0);

		   echo '</tr> ';
		   echo '<td><label>Observaciones:</label></td>';		 
		   echo '<td><textarea name="param76" id="param76" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[153].'</textarea></td>';
		   echo '</tr> ';

		   $FB->titulo_azul1("Agarres.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 39, 82, $DB, $Patrones, "", "$rw[116]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 40, 82, $DB, $Patrones, "", "$rw[117]", 1, 0);
   
		  $FB->titulo_azul1("Agarre digito palmar.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 41, 82, $DB, $Patrones, "", "$rw[118]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 42, 82, $DB, $Patrones, "", "$rw[119]", 1, 0);

		  $FB->titulo_azul1("Agarre interdigital.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 43, 82, $DB, $Patrones, "", "$rw[120]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 44, 82, $DB, $Patrones, "", "$rw[121]", 1, 0);
   
		  $FB->titulo_azul1("Enganche.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 45, 82, $DB, $Patrones, "", "$rw[122]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 46, 82, $DB, $Patrones, "", "$rw[123]", 1, 0);

		  $FB->titulo_azul1("Pinza fina.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 47, 82, $DB, $Patrones, "", "$rw[124]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 48, 82, $DB, $Patrones, "", "$rw[125]", 1, 0);
   
		  $FB->titulo_azul1("Pinza trípode.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 49, 82, $DB, $Patrones, "", "$rw[126]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 50, 82, $DB, $Patrones, "", "$rw[127]", 1, 0);

		  $FB->titulo_azul1("Pinza lateral.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 51, 82, $DB, $Patrones, "", "$rw[128]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 52, 82, $DB, $Patrones, "", "$rw[129]", 1, 0);
   
		  $FB->titulo_azul1("Alcanzar.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 53, 82, $DB, $Patrones, "", "$rw[130]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 54, 82, $DB, $Patrones, "", "$rw[131]", 1, 0);

		  $FB->titulo_azul1("Arriba.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 55, 82, $DB, $Patrones, "", "$rw[132]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 56, 82, $DB, $Patrones, "", "$rw[133]", 1, 0);
   
		  $FB->titulo_azul1("Adelante.", 10, 0, 7);	  
		  echo '</tr> ';
		  $FB->llena_texto("Derecho: ", 57, 82, $DB, $Patrones, "", "$rw[134]", 1, 0);
		  $FB->llena_texto("Izquierdo: ", 58, 82, $DB, $Patrones, "", "$rw[135]", 1, 0);

		  echo '</tr> ';

			$FB->titulo_azul1("Atrás.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 59, 82, $DB, $Patrones, "", "$rw[136]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 60, 82, $DB, $Patrones, "", "$rw[137]", 1, 0);
	
		   $FB->titulo_azul1("Al lado.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 61, 82, $DB, $Patrones, "", "$rw[138]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 62, 82, $DB, $Patrones, "", "$rw[139]", 1, 0);

		   $FB->titulo_azul1("Lanzar.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 63, 82, $DB, $Patrones, "", "$rw[140]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 64, 82, $DB, $Patrones, "", "$rw[141]", 1, 0);
	
		   $FB->titulo_azul1("Rudimentario.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 65, 82, $DB, $Patrones, "", "$rw[142]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 66, 82, $DB, $Patrones, "", "$rw[143]", 1, 0);

		   $FB->titulo_azul1("Con propulsión.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 67, 82, $DB, $Patrones, "", "$rw[144]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 68, 82, $DB, $Patrones, "", "$rw[145]", 1, 0);
	
		   $FB->titulo_azul1("Soltar.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 69, 82, $DB, $Patrones, "", "$rw[146]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 70, 82, $DB, $Patrones, "", "$rw[147]", 1, 0);

		   $FB->titulo_azul1("Rudimentario.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 71, 82, $DB, $Patrones, "", "$rw[148]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 72, 82, $DB, $Patrones, "", "$rw[149]", 1, 0);
	
		   $FB->titulo_azul1("Con propulsión.", 10, 0, 7);	  
		   echo '</tr> ';
		   $FB->llena_texto("Derecho: ", 73, 82, $DB, $Patrones, "", "$rw[150]", 1, 0);
		   $FB->llena_texto("Izquierdo: ", 74, 82, $DB, $Patrones, "", "$rw[151]", 1, 0);

		   echo '</tr> ';
		   echo '<td><label>Observaciones:</label></td>';		 
		   echo '<td><textarea name="param75" id="param75" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[152].'</textarea></td>';

			$FB->cierra_tabla();
			$caso = 'Coordinacion';
			break;
		case "Coordinacion":

			$FB->titulo_azul1("<h4> Habilidades motoras gruesas </h4> Coordinación general", 10, 0, 5);
			echo '</tr> ';
			 
			echo '<td><label>Marcha:</label></td>';		 
			echo '<td><textarea name="param1" id="param1" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[154].'</textarea></td>';

		    echo '<td><label>Equilibrio estático:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[155].'</textarea></td>';

		   echo '</tr> ';
		   echo '<td><label>Equilibrio dinámico:</label></td>';		 
		   echo '<td><textarea name="param3" id="param3" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[156].'</textarea></td>';

		   $FB->titulo_azul1("Coordinación motora gruesa", 10, 0, 7);
			echo '</tr> ';
			 
			echo '<td><label>Adopción de diferentes posturas (colchoneta):</label></td>';		 
			echo '<td><textarea name="param4" id="param4" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[157].'</textarea></td>';

		   echo '<td><label>Reacciones de equilibrio en todas las posturas:</label></td>';		 
		   echo '<td><textarea name="param5" id="param5" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[158].'</textarea></td>';

		   echo '</tr> ';
		   echo '<td><label>Área de lateralidad:</label></td>';		 
		   echo '<td><textarea name="param6" id="param6" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[159].'</textarea></td>';


		   $FB->titulo_azul1("Coordinación dinámica manual", 10, 0, 7);
		   $FB->titulo_azul1("Según ejecución", 10, 0, 7);
		   echo '</tr> ';
			
		   echo '<td><label>Simultaneas:</label></td>';		 
		   echo '<td><textarea name="param7" id="param7" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[160].'</textarea></td>';

		  echo '<td><label>Alternos:</label></td>';		 
		  echo '<td><textarea name="param8" id="param8" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[161].'</textarea></td>';
		  
		  echo '</tr> ';
		  echo '<td><label>Disociados:</label></td>';		 
		  echo '<td><textarea name="param9" id="param9" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[162].'</textarea></td>';
		  
		  $FB->titulo_azul1("Según dinamismo", 10, 0, 7);

		  echo '</tr> ';
			
		   echo '<td><label>Manipuleos:</label></td>';		 
		   echo '<td><textarea name="param10" id="param10" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[163].'</textarea></td>';

		  echo '<td><label>Digitales puros::</label></td>';		 
		  echo '<td><textarea name="param11" id="param11" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[164].'</textarea></td>';
		  
		  echo '</tr> ';
		  echo '<td><label>Gestuales:</label></td>';		 
		  echo '<td><textarea name="param12" id="param12" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[165].'</textarea></td>';

		  $FB->titulo_azul1("<h5>Coordinación visomotriz.</h5> ", 10, 0, 5);
		    echo '</tr> ';
		   echo '<td><label>Ojo - mano:</label></td>';		 
		   echo '<td><textarea name="param13" id="param13" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[166].'</textarea></td>';
		   
		   echo '<td><label>Dedo - nariz:</label></td>';		 
		   echo '<td><textarea name="param14" id="param14" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[167].'</textarea></td>';

		   

		   
			$FB->cierra_tabla();
			$caso = 'sensorio';
			break;

		case "sensorio":

			$FB->titulo_azul1("<h4>Habilidades sensorio – integrativas</h4><h5>Percepción visual </h5>",9,0,7);

			echo '</tr> ';
		   $FB->llena_texto("Percepcion del color: ", 1, 82, $DB, $sensorio, "", "$rw[168]", 1, 0);
		   $FB->llena_texto("Primario: ", 2, 82, $DB, $sensorio, "", "$rw[169]", 4, 0);
		   $FB->llena_texto("Secundarios: ",3, 82, $DB, $sensorio, "", "$rw[170]", 1, 0);
		   $FB->llena_texto("Terciarios: ",4, 82, $DB, $sensorio, "", "$rw[171]", 4, 0);
		   echo '<br> ';		     
		   echo '</tr> ';
		   $FB->llena_texto("Percepcion de formas: ", 5, 82, $DB, $sensorio, "", "$rw[172]", 1, 0);
		   $FB->llena_texto("Primario: ", 6, 82, $DB, $sensorio, "", "$rw[173]", 4, 0);	
		   $FB->llena_texto("Secundarios: ", 7, 82, $DB, $sensorio, "", "$rw[174]", 1, 0);
		   echo '<br> ';		     
		   echo '</tr> ';
		   $FB->llena_texto("Percepcion de tamano: ",8, 82, $DB, $sensorio, "", "$rw[175]", 1, 0);
		   $FB->llena_texto("Grande: ",9, 82, $DB, $sensorio, "", "$rw[176]", 4, 0);	
		   $FB->llena_texto("Mediano: ",10, 82, $DB, $sensorio, "", "$rw[177]", 1, 0);
		   $FB->llena_texto("Pequeno: ",11, 82, $DB, $sensorio, "", "$rw[178]", 4, 0);

		   echo '</tr> ';
		   echo '<td><label>Observaciones:</label></td>';		 
		   echo '<td><textarea name="param12" id="param12" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[179].'</textarea></td>';
		   echo '<td><label>Informacion adicional:</label></td>';
		   echo '<td><textarea name="param13" id="param13" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[180].'</textarea></td>';
		   
		   $FB->titulo_azul1("<h4>Esquema corporal</h4>",9,0,7);

			echo '</tr> ';
		   $FB->llena_texto("Imagen corporal: ", 14, 82, $DB, $corporal, "", "$rw[181]", 1, 0);
		   $FB->llena_texto("Concepto corporal: ", 15, 82, $DB, $corporal, "", "$rw[182]", 4, 0);
		   $FB->llena_texto("Conciencia corporal: ", 16, 82, $DB, $corporal, "", "$rw[183]", 1, 0);

		   echo '</tr> ';
		   echo '<td><label>Observaciones:</label></td>';		 
		   echo '<td><textarea name="param17" id="param17" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[184].'</textarea></td>';

		   echo '<td><label>Informacion adicional:</label></td>';
		   echo '<td><textarea name="param18" id="param18" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[185].'</textarea></td>';
		   
		   
		   $FB->titulo_azul1("<h4>Percepciones temporoespacial</h4>",9,0,7);		     
		   echo '</tr> ';
		   $FB->llena_texto("Dia  Noche: ", 19, 82, $DB, $Percepciones, "", "$rw[186]", 1, 0);
		   $FB->llena_texto("Dias de la semana: ", 20, 82, $DB, $Percepciones, "", "$rw[187]", 4, 0);	
		   $FB->llena_texto("Meses: ", 21, 82, $DB, $Percepciones, "", "$rw[188]", 1, 0);
		  
		   $FB->titulo_azul1("<h4>Relaciones espaciales</h4>",9,0,7);
		   echo '</tr> ';
		   $FB->llena_texto("Arriba:", 23, 82, $DB, $Relaciones, "", "$rw[189]", 1, 0);
		   $FB->llena_texto("Abajo:", 24, 82, $DB, $Relaciones, "", "$rw[190]", 4, 0);	
		   $FB->llena_texto("Adelante:",25, 82, $DB, $Relaciones, "", "$rw[191]", 1, 0);
		   $FB->llena_texto("Atras:", 26, 82, $DB, $Relaciones, "", "$rw[192]", 4, 0);
		   $FB->llena_texto("Adentro:", 27, 82, $DB, $Relaciones, "", "$rw[193]", 1, 0);
		   $FB->llena_texto("Afuera:", 28, 82, $DB, $Relaciones, "", "$rw[194]", 4, 0);	
		   $FB->llena_texto("Encima:", 29, 82, $DB, $Relaciones, "", "$rw[195]", 1, 0);
		   $FB->llena_texto("Debajo:", 30, 82, $DB, $Relaciones, "", "$rw[196]", 4, 0);
		   $FB->llena_texto("Al lado derecho:", 31, 82, $DB, $Relaciones, "", "$rw[197]", 1, 0);
		   $FB->llena_texto("Al lado izquierdo: ", 32, 82, $DB, $Relaciones, "", "$rw[198]", 4, 0);	
		  
		   $FB->titulo_azul1("<h4>Percepción de dimensiones</h4>",9,0,7);
		   echo '</tr> ';
		   $FB->llena_texto("Largo  corto:", 33, 82, $DB, $Relaciones, "", "$rw[199]", 1, 0);
		   $FB->llena_texto("Ancho  delgado:", 34, 82, $DB, $Relaciones, "", "$rw[200]", 4, 0);	
		   $FB->llena_texto("Alto  bajo:", 35, 82, $DB, $Relaciones, "", "$rw[201]", 1, 0);
		   $FB->llena_texto("Gordo  pequeno:", 36, 82, $DB, $Relaciones, "", "$rw[202]", 4, 0);
		   $FB->llena_texto("Lleno  vacio:", 37, 82, $DB, $Relaciones, "", "$rw[203]", 1, 0);
		   $FB->llena_texto("Grande  pequeno:", 38, 82, $DB, $Relaciones, "", "$rw[204]", 4, 0);	
		   $FB->llena_texto("Mucho  poco:", 39, 82, $DB, $Relaciones, "", "$rw[205]", 1, 0);

		   $FB->titulo_azul1("<h4>Área de sensibilidad</h4>",9,0,7);
		   echo '</tr> ';
		   $FB->llena_texto("Sensibilidad superficial:", 13, 82, $DB, $Sensibilidad, "", "$rw[206]", 1, 0);
		   $FB->llena_texto("Termico:", 40, 82, $DB, $Sensibilidad, "", "$rw[207]", 4, 0);	
		   $FB->llena_texto("Dolor:", 41, 82, $DB, $Sensibilidad, "", "$rw[208]", 1, 0);
		   $FB->llena_texto("Tacto suave:", 42, 82, $DB, $Sensibilidad, "", "$rw[209]", 4, 0);
		   $FB->llena_texto("Sensibilidad profunda:", 43, 82, $DB, $Sensibilidad, "", "$rw[210]", 1, 0);
		   $FB->llena_texto("Barognosia:", 44, 82, $DB, $Sensibilidad, "", "$rw[211]", 4, 0);	
		   $FB->llena_texto("Nogsias digitales:", 45, 82, $DB, $Sensibilidad, "", "$rw[212]", 1, 0);
		   $FB->llena_texto("Batiestesia:", 46, 82, $DB, $Sensibilidad, "", "$rw[213]", 4, 0);

		   echo '</tr> ';
		   echo '<td><label>Observaciones:</label></td>';		 
		   echo '<td><textarea name="param47" id="param47" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[214].'</textarea></td>';
		   echo '<td><label>Prueba de moberg:</label></td>';
		   echo '<td><textarea name="param48" id="param48" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[215].'</textarea></td>';
		   
			$FB->cierra_tabla();
			$caso = 'Procesos';
			break;

		case "Procesos":

			$FB->titulo_azul1("<h4> Procesos superiores </h4>", 10, 0, 5);
			echo '</tr> ';
			 
			echo '<td><label>Atención:</label></td>';		 
			echo '<td><textarea name="param1" id="param1" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[216].'</textarea></td>';

		    echo '<td><label>Memoria:</label></td>';		 
		   echo '<td><textarea name="param2" id="param2" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[217].'</textarea></td>';

		   echo '</tr> ';
		   echo '<td><label>Compresión:</label></td>';		 
		   echo '<td><textarea name="param3" id="param3" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[218].'</textarea></td>';

		   echo '<td><label>Concentración:</label></td>';		 
		   echo '<td><textarea name="param4" id="param4" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[219].'</textarea></td>';

		   echo '</tr> ';
		   echo '<td><label>Habilidades cognitivas:</label></td>';		 
		   echo '<td><textarea name="param5" id="param5" value="text4" placeholder="s (describa como se muestra)" style="width:350px; height:150px; class="text" >'.$rw[220].'</textarea></td>';

		   $FB->titulo_azul1("<h4>Habilidades de comunicación  interacción </h4>", 10, 0, 5);
			echo '</tr> ';
			 
			echo '<td><label>Establece relaciones interpersonales:</label></td>';		 
			echo '<td><textarea name="param6" id="param6" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[221].'</textarea></td>';

		    echo '<td><label>Manipula objetos:</label></td>';		 
		   echo '<td><textarea name="param7" id="param7" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[223].'</textarea></td>';

		   echo '</tr> ';
		   echo '<td><label>Explora el medio:</label></td>';		 
		   echo '<td><textarea name="param8" id="param8" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[224].'</textarea></td>';

		 
		   echo '<td><label>Presencia de alteraciones del lenguaje:</label></td>';		 
		   echo '<td><textarea name="param9" id="param9" value="text4" placeholder="(expresivo  compresivo)" style="width:350px; height:150px; class="text" >'.$rw[225].'</textarea></td>';
		   

			$FB->cierra_tabla();
			$caso = 'Autocuidado';
			break;

		case "Autocuidado":

			$FB->titulo_azul1("<h4>Autocuidado</h4>",9,0,7);		 
			$FB->titulo_azul1("<h4>Higiene mayor</h4>",9,0,7);		     
		   echo '</tr> ';
		   $FB->llena_texto("Baño: ", 1, 82, $DB, $Autocuidado, "", "$rw[226]", 1, 0);
		   $FB->llena_texto("Observaciones:", 2, 1, $DB, "", "", "$rw[1]", 4, 0); 
		   $FB->llena_texto("Lavar la cabeza: ", 3, 82, $DB, $Autocuidado, "", "$rw[227]", 1, 0);	
		   $FB->llena_texto("Observaciones:", 4, 1, $DB, "", "", "$rw[228]", 4, 0); 
		   $FB->llena_texto("Secar cuerpo: ", 5, 82, $DB, $Autocuidado, "", "$rw[229]", 1, 0);
		   $FB->llena_texto("Observaciones:", 6, 1, $DB, "", "", "$rw[230]", 4, 0); 
		  
		   $FB->titulo_azul1("<h4>Higiene menor</h4>",9,0,7);
		   echo '</tr> ';
		   $FB->llena_texto("Lavar cara:", 7, 82, $DB, $Autocuidado, "", "$rw[231]", 1, 0);
		   $FB->llena_texto("Observaciones:", 8, 1, $DB, "", "", "$rw[233]", 4, 0); 
		   $FB->llena_texto("Lavar dientes:", 9, 82, $DB, $Autocuidado, "", "$rw[234]", 1, 0);
		   $FB->llena_texto("Observaciones:", 10, 1, $DB, "", "", "$rw[235]", 4, 0); 	
		   $FB->llena_texto("Afeitarse:", 11, 82, $DB, $Autocuidado, "", "$rw[236]", 1, 0);
		   $FB->llena_texto("Observaciones:", 12, 1, $DB, "", "", "$rw[237]", 4, 0); 
		   $FB->llena_texto("Peinarse:", 13, 82, $DB, $Autocuidado, "", "$rw[238]", 4, 0);
		   $FB->llena_texto("Observaciones:", 14, 1, $DB, "", "", "$rw[239]", 4, 0); 
		   $FB->llena_texto("Aseo genitales:", 15, 82, $DB, $Autocuidado, "", "$rw[240]", 1, 0);
		   $FB->llena_texto("Observaciones:", 16, 1, $DB, "", "", "$rw[241]", 4, 0); 		    	
		  
		   $FB->titulo_azul1("<h4>Vestido.</h4>",9,0,7);
		   echo '</tr> ';
		   $FB->llena_texto("Vestido MMSS:", 17, 82, $DB, $Autocuidado, "", "$rw[242]", 1, 0);
		   $FB->llena_texto("Observaciones:", 18, 1, $DB, "", "", "$rw[243]", 4, 0); 
		   $FB->llena_texto("Vestido MMII:", 19, 82, $DB, $Autocuidado, "", "$rw[244]", 1, 0);
		   $FB->llena_texto("Observaciones:", 20, 1, $DB, "", "", "$rw[245]", 4, 0); 	
		   
		   $FB->titulo_azul1("<h4>Alimentación.</h4>",9,0,7);
		   echo '</tr> ';
		   $FB->llena_texto("Llevar alimento a la boca con la mano o utensilior: ", 13, 82, $DB, $Autocuidado, "", "$rw[246]", 1, 0);
		   $FB->llena_texto("Observaciones:", 21, 1, $DB, "", "", "$rw[247]", 4, 0);
		   $FB->llena_texto("Partir alimentos: ", 22, 82, $DB, $Autocuidado, "", "$rw[248]", 1, 0);	
		   $FB->llena_texto("Observaciones:", 23, 1, $DB, "", "", "$rw[249]", 4, 0);
		   $FB->llena_texto("Preparar alimentos: ", 24, 82, $DB, $Autocuidado, "", "$rw[250]", 1, 0);
		   $FB->llena_texto("Observaciones:", 25, 1, $DB, "", "", "$rw[251]", 4, 0);
		  
		
			$FB->cierra_tabla();
			$caso = 'Procesamiento';
			break;
		case "Procesamiento":

			$FB->titulo_azul1("<h4>Habilidades de procesamiento sensorial</h4>",9,0,7);
			echo '</tr> ';
			$FB->llena_texto("Vestibular:", 1, 82, $DB, $Sistema, "", "$rw[252]", 1, 0);
			$FB->llena_texto("Conductas Observadas:", 2, 1, $DB, "", "", "$rw[253]", 4, 0);
			$FB->llena_texto("Propioceptivo:", 3, 82, $DB, $Sistema, "", "$rw[254]", 1, 0);	
			$FB->llena_texto("Conductas Observadas:", 4, 1, $DB, "", "", "$rw[255]", 4, 0);
			$FB->llena_texto("Táctil:", 5, 82, $DB, $Sistema, "", "$rw[256]", 1, 0);
			$FB->llena_texto("Conductas Observadas:", 6, 1, $DB, "", "", "$rw[257]", 4, 0);
			$FB->llena_texto("Auditivo:", 7, 82, $DB, $Sistema, "", "$rw[258]", 1, 0);
			$FB->llena_texto("Conductas Observadas:", 8, 1, $DB, "", "", "$rw[259]", 4, 0);
			$FB->llena_texto("Visual:", 9, 82, $DB, $Sistema, "", "$rw[260]", 1, 0);
			$FB->llena_texto("Conductas Observadas:", 10, 1, $DB, "", "", "$rw[261]", 4, 0);
		   
			echo '</tr> ';
			 
			echo '<td><label>Observaciones:</label></td>';		 
			echo '<td><textarea name="param11" id="param11" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[262].'</textarea></td>';

		    echo '<td><label>Laboral:</label></td>';		 
		   echo '<td><textarea name="param12" id="param12" value="text4" placeholder=" (anamnesis ocupacional)" style="width:350px; height:150px; class="text" >'.$rw[263].'</textarea></td>';

		   echo '</tr> ';
		   echo '<td><label>Actividades de tiempo libre:</label></td>';		 
		   echo '<td><textarea name="param13" id="param13" value="text4" placeholder="" style="width:350px; height:150px; class="text" >'.$rw[264].'</textarea></td>';

		 
		   echo '<td><label>Observaciones generales:</label></td>';		 
		   echo '<td><textarea name="param14" id="param14" value="text4" placeholder="(expresivo  compresivo)" style="width:350px; height:150px; class="text" >'.$rw[265].'</textarea></td>';

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