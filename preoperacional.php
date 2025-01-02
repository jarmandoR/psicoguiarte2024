<!-- <link rel="stylesheet" href="css/estilos2.css">
<link rel="stylesheet" href="css/font-awesome2.css"> -->

<!-- <script src="js/jquery-3.1.0.min1.js"></script>
  <script src="js/main1.js"></script> -->

<script src="js/jquery.flexslider.js"></script><!-- 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
<meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="flexslider.css" type="text/css">
<style type="text/css">
	#link {
		font-family: 'Source Sans Pro', sans-serif;
		font-weight: 400;
	}

	#link li {
		display: inline;
	}


	#link a {
		/*outline: none;*/
		text-decoration: none;
		display: inline-block;
		width: 30.5%;
		margin-right: 3.025%;
		text-align: center;
		line-height: 2;
		color: white;
		font-size: xx-large;

	}

	#link a {
		border-color: #D5D8DC;
		border-width: 2px;
		border-style: solid;
	}

	#link li:last-child a {
		margin-right: 0;

	}

	#link a:link,
	a:visited,
	a:focus {
		background: #41BBC6;
	}

	#link a:hover {
		background: #FADBD8;
	}

	#link a:active {
		background: white;
		color: black;
	}

	@import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');

	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: 'Montserrat', sans-serif;
	}

	/*Cards*/
	.container-card {
		width: 100%;
		display: flex;
		max-width: 1100px;
		margin: auto;
	}

	.title-cards {
		width: 100%;
		max-width: 1080px;
		margin: auto;
		padding: 20px;
		margin-top: 20px;
		text-align: center;
		color: #7a7a7a;
	}

	.card {
		width: 100%;
		margin: 20px;
		border-radius: 6px;
		overflow: hidden;
		background: #fff;
		box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.2);
		transition: all 400ms ease-out;
		cursor: default;
	}

	.card:hover {
		box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.4);
		transform: translateY(-3%);
	}

	.card img {
		width: 100%;
		height: 210px;
	}

	.card .contenido-card {
		padding: 15px;
		text-align: center;
	}

	.card .contenido-card h3 {
		margin-bottom: 15px;
		color: #7a7a7a;
	}

	.card .contenido-card p {
		line-height: 1.8;
		color: #6a6a6a;
		font-size: 14px;
		margin-bottom: 5px;
	}

	.card .contenido-card a {
		display: inline-block;
		padding: 10px;
		margin-top: 10px;
		text-decoration: none;
		color: #41BBC6;
		border: 1px solid #41BBC6;
		border-radius: 4px;
		transition: all 400ms ease;
		margin-bottom: 5px;
	}

	.card .contenido-card a:hover {
		background: #2fb4cc;
		color: #fff;
	}

	@media only screen and (min-width:320px) and (max-width:768px) {
		.container-card {
			flex-wrap: wrap;
		}

		.card {
			margin: 15px;
		}
	}
</style>


<?php
/* require("login_autentica.php"); 
include("layout.php");  */
$DB2 = new DB_mssql;
$DB2->conectar();
$nivel_acceso = $_SESSION['usuario_rol'];
$id_usuario = $_SESSION['usuario_id'];
if ($param4 == 'ingresado') {
	$id_usuario = $iduser;
}
?>

<script>

	function asignar() {
		var conver = '';
		var obj;
		var chkdatos = document.getElementsByClassName("obtener");

		for (i = 0; i < chkdatos.length; i++) {
			if (chkdatos[i].checked) {
				conver = conver + '"' + chkdatos[i].name + '"' + ":" + '"' + chkdatos[i].value + '",';
			}
		}
		data = conver.substring(0, conver.length - 1);
		data = '{' + data + '}';
		obj = data;
		console.log(obj);
		document.getElementById("data").value = obj;

		return true;
	}

	$(window).load(function () {
		$('.flexslider').flexslider({
			touch: true,
			pauseOnAction: false,
			pauseOnHover: false,
		});
	});

</script>
<?php

if ($param4 == 'covid19') {

	echo '<form action="nuevo_adminok.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return asignar();" >';
	echo '<div id="contenedor1" style="display:flex;">';
	echo '<div id="primero" style="width: 100%; float:left;">';

	echo '<table class="table table-hover"><tr bgcolor="" class="tittle3">';

	// echo'<picture> <img src="img/bermudas.jpg" alt="test"  width="1090px" height="50%" ></picture>';

	echo '<br>';


	$sql5 = "SELECT `img_confi`,`contenido_confi` FROM `confi_inicio` WHERE `id_confi`='1' ";
	$DB->Execute($sql5);
	$rw = mysqli_fetch_row($DB->Consulta_ID);
	// $nombreuser=$DB->recogedato(1);

	$sql6 = "SELECT `img_confi`,`contenido_confi` FROM `confi_inicio` WHERE `id_confi`='2' ";
	$DB->Execute($sql6);
	$rw1 = mysqli_fetch_row($DB->Consulta_ID);

	$sql7 = "SELECT `img_confi`,`contenido_confi` FROM `confi_inicio` WHERE `id_confi`='3' ";
	$DB->Execute($sql7);
	$rw2 = mysqli_fetch_row($DB->Consulta_ID);

	echo '<div class="flexslider">
		<ul class="slides">
			<li>
				<img src="confi_imagen/' . $rw[0] . '" alt="">
				<section class="flex-caption">
					<p>' . $rw[1] . '</p>
				</section>
			</li>
			<li>
				<img src="confi_imagen/' . $rw1[0] . '" alt="">
				<section class="flex-caption">
					<p>' . $rw1[1] . '</p>
				</section>
			</li>
			<li>
				<img src="confi_imagen/' . $rw2[0] . '" alt="">
				<section class="flex-caption">
					<p>' . $rw2[1] . '</p>
				</section>
			</li>

		</ul>
	</div>';


	echo '</td></tr><tr>';

	echo '<br>';


	echo '<div id="link"><li><a href="misional.php">Misional</a></li> <li><a href="documentoregla.php">Reglamento</a></li> <li><a href = "documentosempre.php">Documentación</a> </li></div>';




	echo '<td></td';

	echo '<br>';
	echo '<br>';


	echo '</tr> <tr>';

	$sql8 = "SELECT `img_confi`,`contenido_confi`,`titulo_confi` ,`confi_enlace` FROM `confi_inicio` WHERE `id_confi`='4' ";
	$DB->Execute($sql8);
	$rw3 = mysqli_fetch_row($DB->Consulta_ID);
	// $nombreuser=$DB->recogedato(1);

	$sql9 = "SELECT `img_confi`,`contenido_confi`,`titulo_confi`,`confi_enlace` FROM `confi_inicio` WHERE `id_confi`='5' ";
	$DB->Execute($sql9);
	$rw4 = mysqli_fetch_row($DB->Consulta_ID);

	$sql10 = "SELECT `img_confi`,`contenido_confi` ,`titulo_confi`,`confi_enlace` FROM `confi_inicio` WHERE `id_confi`='6' ";
	$DB->Execute($sql10);
	$rw5 = mysqli_fetch_row($DB->Consulta_ID);



	echo '<div class="title-cards">
    <h2>Noticias</h2>
  </div>';
	echo '<div class="container-card">';

	echo '<div class="card">
  <figure>
    <img src="confi_imagen/' . $rw3[0] . '">
  </figure>
  <div class="contenido-card">
    <h3>' . $rw3[2] . '</h3>
    <p>' . $rw3[1] . '.</p>';
	// <a href="confi_imagen/'.$rw3[3].'">Leer Màs</a>

	echo "
		<a  onclick='pop_dis21(\"" . $rw3[3] . "\",\"verinfo\",\"cedula cara2.pdf\",0)';  style='cursor: pointer;' title='Confirmar' >Leer Màs</a>";
	echo '
  </div>
</div>';
	echo '<div class="card">
  <figure>
    <img src="confi_imagen/' . $rw4[0] . '">
  </figure>
  <div class="contenido-card">
    <h3>' . $rw4[2] . '</h3>
    <p>' . $rw4[1] . '</p>';
	// <a href="confi_imagen/'.$rw4[3].'">Leer Màs</a>
	echo "
		<a  onclick='pop_dis21(\"" . $rw4[3] . "\",\"verinfo\",\"cedula cara2.pdf\",0)';  style='cursor: pointer;' title='Confirmar' >Leer Màs</a>

  </div>
</div>";
	echo '<div class="card">
  <figure>
    <img src="confi_imagen/' . $rw5[0] . '">
  </figure>
  <div class="contenido-card">
    <h3>' . $rw5[2] . '</h3>
    <p>' . $rw5[1] . '</p>';
	// <a href="confi_imagen/'.$rw5[3].'">Leer Màs</a>
	echo "
		<a  onclick='pop_dis21(\"" . $rw5[3] . "\",\"verinfo\",\"cedula cara2.pdf\",0)';  style='cursor: pointer;' title='Confirmar' >Leer Màs</a>
  </div>
</div>
</div>";

	echo '</tr>';



	// echo '<tr bgcolor="#074F91" class="tittle3"><td colspan="2" width="4" align="center">TEST DE REPORTE DIARIO DE SINTOMATOLOGIA  </td><td colspan="1" width="4" align="center">SI</td><td colspan="1" width="4" align="center">NO</td></tr>';
	// echo "<tr bgcolor='$color' class='text' id='covid1910'>";
	// echo "<td colspan='2'>Ha sentido fatiga los últimos dos días?</td><td><input type='radio' name='covid191'  class='obtener'   value='1' required></td><td><input type='radio' name='covid191'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='covid1920'>";
	// echo "<td colspan='2'>Ha tenido fiebre mayor a 37,3?</td><td><input type='radio' name='covid192'  class='obtener'   value='1' required></td><td><input type='radio' name='covid192'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='covid1930'>";
	// echo "<td colspan='2'>Ha presentado tos seca?</td><td><input type='radio' name='covid193'  class='obtener'   value='1' required></td><td><input type='radio' name='covid193'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='covid1940'>";
	// echo "<td colspan='2'>Ha presentado dificultad para respirar?</td><td><input type='radio' name='covid194'  class='obtener'   value='1' required></td><td><input type='radio' name='covid194'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='covid1950'>";
	// echo "<td colspan='2'>Tiene dolor o molestia?</td><td><input type='radio' name='covid195'  class='obtener'   value='1' required></td><td><input type='radio' name='covid195'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='covid1960'>";
	// echo "<td colspan='2'>Tiene abundante secreción nasal?</td><td><input type='radio' name='covid196'  class='obtener'   value='1' required></td><td><input type='radio' name='covid196'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='covid1970'>";
	// echo "<td colspan='2'>Ha presentado dolor de garganta?</td><td><input type='radio' name='covid197'  class='obtener'   value='1' required></td><td><input type='radio' name='covid197'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='covid1980'>";
	// echo "<td colspan='2'>Realizo cambio de ropa de trabajo y esta se encuentra limpia?</td><td><input type='radio' name='covid198'  class='obtener'   value='1' required></td><td><input type='radio' name='covid198'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='covid1990'>";
	// echo "<td colspan='2'>realizo cambio de tapabocas convencional lavable suministrado por la empresa y este se encuentra limpio?</td><td><input type='radio' name='covid199'  class='obtener'   value='1' required></td><td><input type='radio' name='covid199'  class='obtener'  value='2'></td>";
	// echo "</tr>";
	// echo "<tr bgcolor='$color' class='text' id='temperatura'>";
	// echo "<td colspan='4'>Temperarura:<input  name='param19' id='param19' value='$rw2[8]' style='width:395px'; class='text' ></td>";
	// echo "</tr>";

	// $FB->llena_texto("Imagen Temperatura:",20, 6, $DB, "", "", "",2, 0); 


	if ($nivel_acceso == 3 or $mostrarpreguntas == 1) {

		echo '<tr bgcolor="#074F91" class="tittle3"><td colspan="2" width="4" align="center">IMPLEMENTOS DE TRABAJO  </td><td colspan="1" width="4" align="center">SI</td><td colspan="1" width="4" align="center">NO</td></tr>';
		echo '<tr bgcolor="#074F91" class="tittle3"><td colspan="2" width="4" align="center">CELULAR</td><td colspan="1" width="4" align="center">SI</td><td colspan="1" width="4" align="center">NO</td></tr>';
		echo "<tr bgcolor='$color' class='text' id='implementos10'>";
		echo "<td colspan='2'>Cuenta con celular con acceso a Internet?</td><td><input type='radio' name='implementos1'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos1'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos20'>";
		echo "<td colspan='2'>La bateria de su Celular se encuentra Cargada?</td><td><input type='radio' name='implementos2'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos2'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos30'>";
		echo "<td colspan='2'>Su celular cuenta con datos y minutos?</td><td><input type='radio' name='implementos3'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos3'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos40'>";
		echo "<td colspan='2'>Tiene usted el cargador de su Celular?</td><td><input type='radio' name='implementos4'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos4'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo '<tr bgcolor="#074F91" class="tittle3"><td colspan="2" width="4" align="center">IMPRESORA</td><td colspan="1" width="4" align="center">SI</td><td colspan="1" width="4" align="center">NO</td></tr>';
		echo "<tr bgcolor='$color' class='text' id='implementos50'>";
		echo "<td colspan='2'>Cuenta con impresora suministrada por la Empresa?</td><td><input type='radio' name='implementos5'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos5'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='codigoimpresora'>";
		echo "<td colspan='4'>Cual es el Codigo de su Impresora:<input  name='param20' id='param20' value='$rw2[10]' style='width:395px'; class='text' ></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos60'>";
		echo "<td colspan='2'>La impresora se encuentra cargadal?</td><td><input type='radio' name='implementos6'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos6'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos70'>";
		echo "<td colspan='2'>Cuenta con suficiente papel para la impresora?</td><td><input type='radio' name='implementos7'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos7'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos80'>";
		echo "<td colspan='2'>Cuneta con el cargador de la Impresora?</td><td><input type='radio' name='implementos8'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos8'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos90'>";
		echo "<td colspan='2'>Verifico que la Impresora este configurada con su celular?</td><td><input type='radio' name='implementos9'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos9'  class='obtener'  value='2'></td>";
		echo "</tr>";

		echo '<tr bgcolor="#074F91" class="tittle3"><td colspan="2" width="4" align="center">PESA</td><td colspan="1" width="4" align="center">SI</td><td colspan="1" width="4" align="center">NO</td></tr>';
		echo "<tr bgcolor='$color' class='text' id='implementos100'>";
		echo "<td colspan='2'>Cuenta con Pesa?</td><td><input type='radio' name='implementos10'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos10'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos110'>";
		echo "<td colspan='2'>Su Pesa cuenta con Bateria?</td><td><input type='radio' name='implementos11'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos11'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos120'>";
		echo "<td colspan='2'>Verifico que su Pesa cuente con bateria?</td><td><input type='radio' name='implementos12'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos12'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos130'>";
		echo "<td colspan='2'>Verifico que su Pesa este funcionando Perfectamente?</td><td><input type='radio' name='implementos13'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos13'  class='obtener'  value='2'></td>";
		echo "</tr>";

		echo '<tr bgcolor="#074F91" class="tittle3"><td colspan="2" width="4" align="center">MALETA</td><td colspan="1" width="4" align="center">SI</td><td colspan="1" width="4" align="center">NO</td></tr>';
		echo "<tr bgcolor='$color' class='text' id='implementos140'>";
		echo "<td colspan='2'>Cuenta con Maleta?</td><td><input type='radio' name='implementos14'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos14'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='maleta'>";
		echo "<td colspan='4'>Ultima vez que desinfecto la maleta:<input  name='param21' id='param21' value='$rw2[11]' style='width:395px'; class='text' ></td>";
		echo "</tr>";

		echo '<tr bgcolor="#074F91" class="tittle3"><td colspan="2" width="4" align="center">CARNET Y CARTA DE MOVILIDAD</td><td colspan="1" width="4" align="center">SI</td><td colspan="1" width="4" align="center">NO</td></tr>';
		echo "<tr bgcolor='$color' class='text' id='implementos160'>";
		echo "<td colspan='2'>Cuenta con Carnet?</td><td><input type='radio' name='implementos16'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos16'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos170'>";
		echo "<td colspan='2'>Cuenta con carta de movilidad?</td><td><input type='radio' name='implementos17'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos17'  class='obtener'  value='2'></td>";
		echo "</tr>";

		echo '<tr bgcolor="#074F91" class="tittle3"><td colspan="2" width="4" align="center">PARAFISCALES O COPIA DE AFILIACION DE ARL</td><td colspan="1" width="4" align="center">SI</td><td colspan="1" width="4" align="center">NO</td></tr>';
		echo "<tr bgcolor='$color' class='text' id='implementos180'>";
		echo "<td colspan='2'>Tiene copia de pago de parafiscales?</td><td><input type='radio' name='implementos18'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos18'  class='obtener'  value='2'></td>";
		echo "</tr>";
		echo "<tr bgcolor='$color' class='text' id='implementos190'>";
		echo "<td colspan='2'>Tiene copia de Afiliacion ARL(Peronal Nuevo)?</td><td><input type='radio' name='implementos19'  class='obtener'   value='1' required></td><td><input type='radio' name='implementos19'  class='obtener'  value='2'></td>";
		echo "</tr>";

	}

	// echo '<tr bgcolor="#878787" class="tittle3"><td colspan="4" ><p align="center">YO COMO TRABAJADOR DE LA EMPRESA TRANSMILLAS ME COMPROMETO A: 
	// **Reportar mis síntomas en caso de presentar y asi mismo a las Entidades a las que haya lugar. </p><br>
	// <p align="left">
	// Al salir de la vivienda<br>
	// 1. Estar atento a las indicaciones de la autoridad local sobre restricciones a la movilidad y acceso a lugares públicos.  <br>
	// 2. Visitar solamente aquellos lugares estrictamente necesarios y evitar conglomeraciones de personas.  <br>
	// 3. Asignar un adulto para hacer las compras, que no pertenezca a ningún grupo de alto riesgo.  <br>
	// 4. Restringir las visitas a familiares y amigos y si alguno presenta cuadro respiratorio. <br>
	// 5. Evitar saludar con besos, abrazos o de mano.  <br>
	// 6. Utilizar tapabocas en áreas de afluencia masiva de personas, en el transporte público, supermercados, bancos, entre otros, así como en los casos de sintomatología respiratoria o si es persona en grupo de riesgo.  
	// <br>Al regresar a la vivienda<br>
	// 1. Retirar los zapatos a la entrada y lavar la suela con agua y jabón.  <br>
	// 2. Lavar las manos de acuerdo a los protocolos del Ministerio de Salud y Protección Social.  <br>
	// 3. Evitar saludar con beso, abrazo y dar la mano y buscar mantener siempre la distancia de más de dos metros entre personas. <br>
	// 4. Antes de tener contacto con los miembros de familia, cambiarse de ropa. <br>
	// 5. Mantener separada la ropa de trabajo de las prendas personales. <br>
	// 6. La ropa debe lavarse en la lavadora a más de 60 grados centígrados o a mano con agua caliente que no queme las manos y jabón, y secar por completo. No reutilizar ropa sin antes lavarla. <br>
	// 7. Bañarse con abundante agua y jabón. <br>
	// 8. Desinfectar con alcohol o lavar con agua y jabón los elementos que han sido manipulados al exterior de la vivienda. <br>
	// 9. Mantener la casa ventilada, limpiar y desinfectar áreas, superficies y objetos de manera regular. <br>
	// 10. Si hay alguna persona con síntomas de gripa en la casa, tanto la persona con síntomas de gripa como quienes cuidan de ella deben utilizar tapabocas de manera constante en el hogar. <br>
	// <br>Al convivir con una persona de alto riesgo
	//  Si el trabajador convive con personas mayores de 60 años, con enfermedades preexistentes de alto riesgo para el COVID-19, o con personal de servicios de salud, debe: <br>
	// 1. Mantener la distancia siempre mayor a dos metros. <br>
	// 2. Utilizar tapabocas en casa, especialmente al encontrarse en un mismo espacio que la persona a riesgo y al cocinar y servir la comida. <br>
	// 3. Aumentar la ventilación del hogar. <br>
	// 4. Asignar un baño y habitación individual para la persona que tiene riesgo, si es posible. Si no lo es, aumentar ventilación, limpieza y desinfección de superficies. <br>
	// 5. Cumplir a cabalidad con las recomendaciones de lavado de manos e higiene respiratoria impartidas por el Ministerio de Salud y Protección Social</p>
	// </td></tr>';

	// echo '<tr bgcolor="#ff0000" class="tittle3"><td colspan="4" >Declaro que toda la información suministrada en el test anterior es verídica, de caso contrario puede acarrear sanciones disciplinarias y su correspondiente aviso a las autoridades competentes que haya lugar.</td></tr>';

	if ($param5 == 'valida') {

		$validatitulo = 'COVID 19';

		echo '<tr  bgcolor="#868A08" class="tittle3"><td colspan="4" width="4" align="center">VALIDA ' . $validatitulo . '</td></tr>';
		echo "<tr bgcolor='$color' class='text' id='validapreopera'>";
		echo "<td colspan='4'><textarea colspan='4' name='param10' id='param10' value='' style='width:395px'; class='text' >$rw2[3]</textarea></td>";
		echo "</tr>";
	}

} 



$FB->llena_texto("data", 1, 13, $DB, "", "", "", 5, 0);
$FB->llena_texto("tabla", 1, 13, $DB, "", "", "$preoperacional", 5, 0);
$FB->llena_texto("param11", 1, 13, $DB, "", "", "$rw2[4]", 5, 0);
$FB->llena_texto("idvehiculo", 1, 13, $DB, "", "", "$id_p", 5, 0);
$FB->llena_texto("param1", 1, 13, $DB, "", "", "$id_p", 5, 0);
$FB->llena_texto("param2", 1, 13, $DB, "", "", "$tipovehiculo", 5, 0);
$FB->llena_texto("param3", 1, 13, $DB, "", "", "$tipovehiculo", 5, 0);
$FB->llena_texto("estado", 1, 13, $DB, "", "", "$param4", 5, 0);
$FB->llena_texto("fecha", 1, 13, $DB, "", "", "$fecha", 5, 0);
$FB->llena_texto("user", 1, 13, $DB, "", "", "$iduser", 5, 0);
$FB->llena_texto("campo", 1, 13, $DB, "", "", "$campo", 5, 0);

//  $FB->llena_texto("", 1, 142, $DB, "Guardar", "", 0, 12, 0);
// require("footer.php");
?>
<script type="text/javascript">
	var valida = document.getElementById("estado").value;
	var iduser = document.getElementById("user").value;
	var fecha = document.getElementById("fecha").value;
	var campo = document.getElementById("campo").value;
	var tipovehiculo = document.getElementById("param3").value;

	if (valida == 'ingresado' || valida == 'covid19') {
		if (tipovehiculo == 'MOTO') {
			var valoresmoto = new Array();
			valoresmoto['llantas1'] = '2';
			valoresmoto['llantas2'] = '2';
			valoresmoto['llantas3'] = '2';
			valoresmoto['llantas4'] = '2';
			valoresmoto['llantas5'] = '1';
			valoresmoto['llantas6'] = '1';
			valoresmoto['transmision1'] = '2';
			valoresmoto['transmision2'] = '2';
			valoresmoto['Luces1'] = '1';
			valoresmoto['Luces2'] = '1';
			valoresmoto['Luces3'] = '1';
			valoresmoto['fugas1'] = '2';
			valoresmoto['fugas2'] = '2';
			valoresmoto['fugas3'] = '2';
			valoresmoto['fugas4'] = '2';
			valoresmoto['fugas5'] = '2';
			valoresmoto['fugas6'] = '2';
			valoresmoto['mandos1'] = '2';
			valoresmoto['mandos2'] = '1';
			valoresmoto['entorno1'] = '1';
			valoresmoto['entorno2'] = '2';
			valoresmoto['entorno3'] = '1';
			valoresmoto['elementos1'] = '1';
			valoresmoto['elementos2'] = '1';
			valoresmoto['elementos3'] = '1';
			valoresmoto['elementos4'] = '1';
			valoresmoto['elementos5'] = '1';
			valoresmoto['elementos6'] = '1';
		}
		datos = { "user": iduser, "fecha": fecha, "campo": campo };
		$.ajax({
			url: "buscarpreoperacional.php",
			type: "POST",
			data: datos
		}).done(function (respuesta) {
			var obj = JSON.parse(respuesta);
			console.log(obj);
			if (respuesta != null) {

				for (var i in obj) {
					value = obj[i];

					var tamano = document.getElementsByName(i);
					//console.log(i+'0');

					for (b = 0; b < tamano.length; b++) {
						var valor = tamano[b].value
						if (valor == value) {
							//	colort.style.backgroundColor="#66ff33";
							if (tipovehiculo == 'CARRO') {
								if (tamano.length == 2) {

									var implementos = i.substring(0, 11);

									if (i == 'covid198' || i == 'covid199' || implementos == 'implementos') {
										if (value != 1) {
											document.getElementById(i + '0').style.backgroundColor = "#e4605e";
										}
									} else if (value != 2) {
										document.getElementById(i + '0').style.backgroundColor = "#e4605e";
									}

									var implementos = i.substring(1, 11);

									if (i == 'covid198' || i == 'covid199') {

									}

								} else if (value != 1) {
									document.getElementById(i + '0').style.backgroundColor = "#e4605e";
								}
							}

							if (valida == 'covid19') {
								var implementos = i.substring(0, 11);
								if (i == 'covid198' || i == 'covid199' || implementos == 'implementos') {
									if (value != 1) {
										document.getElementById(i + '0').style.backgroundColor = "#e4605e";
									}
								} else if (value != 2) {
									document.getElementById(i + '0').style.backgroundColor = "#e4605e";
								}
							}

							if (tipovehiculo == 'MOTO') {

								if (tamano.length == 2) {
									var implementos = i.substring(0, 11);

									if (i == 'covid198' || i == 'covid199' || implementos == 'implementos') {
										if (value != 1) {
											document.getElementById(i + '0').style.backgroundColor = "#e4605e";
										}
									} else if (value != 2) {
										document.getElementById(i + '0').style.backgroundColor = "#e4605e";
									}

								} else if (value != valoresmoto[i]) {
									document.getElementById(i + '0').style.backgroundColor = "#e4605e";
								}
							}

							tamano[b].checked = true;
						}
					}

				}

			}
		});
	}

</script>