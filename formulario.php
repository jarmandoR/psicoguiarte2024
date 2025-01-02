
<script src="js/jquery.flexslider.js"></script><!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
<meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="flexslider.css" type="text/css">
<style type="text/css">
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
		padding: 8px;
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

use Svg\Style;
require("login_autentica.php");
include("layout.php");
include("cabezote3.php");
@$accion = $_REQUEST["accion"];
$id_nombre = $_SESSION['usuario_nombre'];
$DB = new DB_mssql;
$DB->conectar();


echo '<div class="title-cards">
     </div>';
echo '<div class="container-card">';

echo '<div class="card">
  <figure>
    <img src="images/misional.jpeg">
  </figure>
  <div class="contenido-card">
    <h3> Centro de atención integral Psicoguiarte</h3>
	</br>';

echo "
		<a style='cursor: pointer;' title='' href='valoracion.php'>Valoracion Inicial.</a>
		<a style='cursor: pointer;' title='' href='historiasClinicas.php'>Historia de atención.</a>
		<a style='cursor: pointer;' title='' >Ficha de ingreso.</a>
		<a style='cursor: pointer;' title='' href='parejas.php'>Formulación pareja.</a>
		<a style='cursor: pointer;' title='' href='teraocu.php'>Valoración terapia ocupacional.</a>
		<a style='cursor: pointer;' title='' href='fonoadiologia.php'>Resumen evaluación y formato anamnesis.</a>";
echo '
  </div>
</div>';
echo '<div class="card">
  <figure>
    <img src="images/form1.png">
  </figure>
  <div class="contenido-card">
    <h3> Fundación Psicoguiarte</h3>
	</br>';
echo "
		<a   style='cursor: pointer;' title='' href='valoracion.php'>Valoración inicial.</a>
		<a   style='cursor: pointer;' title='' href='historiasClinicas.php'>Historia de atención.</a>
		<a   style='cursor: pointer;' title='' href='teraocu.php'>Valoración terapia ocupacional.</a>
		<a   style='cursor: pointer;' title='' >Resumen evaluación y formato anamnesis.</a>

  </div>
</div>";

echo "</div>";

?>