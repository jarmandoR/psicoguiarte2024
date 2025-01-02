<?php
require("login_autentica.php"); 
include("layout.php");
$nivel_acceso=$_SESSION['usuario_rol'];
$id_usuario=$_SESSION['usuario_id'];

echo'<br>';

  echo '<div>';
	echo'<input type="button" onclick="history.back()" name="volver atrás" value="Regresar">';

     echo '</div>';


$FB->titulo_azul1("Incursionando",9,0,7);  
$FB->abre_form("form1","","post");


	echo "<div = class 'misi'>";
		echo "<tr><td>";
		echo"<br>";
		echo"<br>";
		


		echo'<picture> <img src="images/misional.jpeg" alt="test"  width="530px" height="50%" ></picture>';
		

		echo "</td> <td>";
		echo"<br>";
		echo"<br>";
		

		echo"<p><h1><center> Acerca de Nosotros </center></h1></p>";
		echo"<br>";
		
		

		echo" <h4><p> PSICOGUIARTE CENTRO DE TERAPIA INTEGRAL S.A.S.  nace en el 2022, con el propósito profesional de contribuir a la salud mental de la sociedad.</p></h4>";
   
        
		echo "</td></div>";

		$FB->titulo_azul1("Nosotros ",9,0,7);  
$FB->abre_form("form1","","post");

echo "<div >";
		echo "<tr><td>";

		echo"<br>";
	
		

		echo"<p><h1><center> Misión </center></h1></p>";
		
		echo" <h4><p> Aportar al bienestar emocional y mental de los  consultantes, desarrollando y potencializando  sus capacidades, mediante terapias basadas en la evidencia e  investigación constante que permitan  brindar  servicios  novedosos y de alta calidad.</p></h4>";
		echo"<br>";

		echo"<p><h1><center> Visión </center></h1></p>";

        echo"<h4><p>Ser reconocidos como el centro de psicología líder a nivel nacional e internacional, ofreciendo profesionalidad y calidad en el proceso terapéutico, así como en el diseño y aplicación de programas para otros contextos como empresas, centros educativos o programas de formación para población general y profesionales de la psicología.</p></h4>";
	


		

		echo "</td> <td>";

		

		echo'<picture> <img src="img/mision.png" alt="test"  width="530px" height="50%" ></picture>';
		

		echo "</td></div>";

      $FB->titulo_azul1(" Conocemos  ",9,0,7);  
     $FB->abre_form("form1","","post");
      

	echo "<div>";
		echo "<tr><td>";

		echo"<br>";
		echo"<br>";
		echo"<br>";
		echo"<br>";
		
		
		echo'<picture> <img src="img/vision.jpg" alt="test"  width="530px" height="50%" ></picture>';
		

		echo "</td> <td>";
		echo"<br>";
		echo"<br>";
		

		echo"<p><h1><center> ¿Quiénes Somos? </center></h1></p>";
		

		echo" <h4><p>Centro de atención psicológica conformado por un equipo interdisciplinario de especialistas en salud mental que cuentan con una extensa experiencia y conocimiento desde un enfoque basado en la evidencia, en la identificación, diagnóstico y tratamiento de diversas problemáticas afectivas, cognitivas, emocionales, comportamentales, dificultades académicas y de aprendizaje en niños, niñas, adolescentes y adultos, haciendo intervención individual, familiar y grupal. </p></h4>";

		echo"<p><h1><center> ¿Qué ofrecemos? </center></h1></p>";
		

		echo" <h4><p>Innovación en la intervención terapéutica basada en la evidencia, brindando estrategias y herramientas acordes a la necesidad del contexto, en el cual se genere la problemática a intervenir, teniendo como principal objetivo la promoción y prevención de la salud mental aportando de esta forma bienestar físico y psíquico de nuestra sociedad.  </p></h4>";


		echo "</td></div>";

		echo "</tr>";


   





		// echo"<td>".$rw[1]."</td>
		// <td>".$rw1[4]."</td>
		// <td>".$rw1[5]."</td>
		// <td>".$rw1[6]."</td>
		// <td>".$rw1[7]."</td>
		
		

		// ";
		
		// if($nivel_acceso==1){
		// 	echo "<td align='center' >
		// 	<a  onclick='pop_dis10($id_p,\"Aprobar\",1)';  style='cursor: pointer;' title='Aprobar' ><img src='img/Confirmar1.png'></a></td>";
		// }else if($rw1[16]<=0){
		// 	echo "<td align='center' >Pendiente por Aprobar
		// 	</td>";
		// }else {
		// 	echo "<td align='center' >Solicitud  Aprobada
		// 	</td>";
		// }
		
		// echo "<td>".$rw1[15]."</td>
		// <td>".$rw1[16]."</td>
		// <td>".$rw1[17]."</td>
		// ";
		// if($nivel_acceso!=3){  

		// 	if($rw1[15]!=''){
		// 		echo "<td align='center' >";
		// 		echo "<a  onclick='pop_dis24($id_p,\"asignar remesa\",$rw1[18])';  style='cursor: pointer;' title='Asignar Remesa' ><img src='img/paquete.png'></a></td>";
		// 	}else{
		// 		echo "<td align='center' >Pendiente por Aprobar
		// 	</td>";
		// 	}

		// 		$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[19]' ";
		// 		$DB->Execute($sql5);
		// 		$nombreuser=$DB->recogedato(1);
				
		// 		echo "<td>".$rw1[22]."</td>";
		// 		echo "<td>".$nombreuser."</td>";
		// 		if($rw1[20]==0){
		// 			$recogio='Sin Recoger';

		// 		}else if($rw1[20]==1){
		// 			$recogio='Si';

		// 		} else if($rw1[20]==2){
		// 			$recogio='Devuelto';
		// 		}
		// }
// 		echo "<td>".$recogio."</td>
// 		<td>".$rw1[24]."</td>
// 		<td>".$rw1[23]."</td>
// 		<td>".$rw1[25]."</td>
// 		";
// 		$LT->llenadocs2($DB, "gastos", $id_p, 2, 35, 1);
// 	if($nivel_acceso==1){
// 		$DB->edites($id_p, "remesas", 2, $condecion);
// 	}

// }
include("footer.php"); ?>