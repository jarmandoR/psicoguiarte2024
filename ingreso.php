<head>

<style>
        .container{
            float: left;
            margin-right: 10px;
			display: flex;
            align-items: center;
        }
		.archivo-button {
         margin-right: 10px; /* Espacio entre el input y el botón */
        }
        .email-button {
            display: inline-flex;
            align-items: center;
            background-color: #2196F3; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
			margin-right: 10px; /* Espacio entre el input y el botón */
        }

        .file-button {
            display: inline-flex;
            align-items: center;
            background-color: #4CAF50; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
			margin-right: 10px; /* Espacio entre el input y el botón */
        }
        .email-button i {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }

        .file-button i {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }



        .file-button {
            background-color: #4CAF50;
        }
	
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

	</head>
<?php
require("login_autentica.php"); 
include("layout.php");

echo'<a href="seguimientouser.php" class="btn btn-light">Volver</a>';
$FB->titulo_azul1("Ingreso",9,0,5);  

$FB->llena_texto("Documento de identidad",2, 1, $DB, "", "","",1,0);

echo "<tr><td colspan='4'>

<div  class='container'>

<button type='button' class='icon-button file-button' onclick='Guardaingreso()'><i class='fas fa-file'></i>Ingresar</button>
</div></td></tr></table>";


$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 


?>
<script>
    

    function Guardaingreso(){
        var  idusu = document.getElementById('param2').value;

        datos = {"idusu":idusu};
			$.ajax({
					url: "guardaringreso.php",
					type: "POST",
					data: datos
				}).done(function(respuesta){
					
                    alert('¡Igreso exitoso!');

				});
    }
</script>