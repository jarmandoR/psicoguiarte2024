<?php
require("login_autentica.php");
include("declara.php");
@$accion = $_REQUEST["accion"];
$fechatiempo = date("Y-m-d H:i:s");
$fecha = date("Y-m-d");







function subirimagen($var, $tipo)
{

	if ($var != '') {

		move_uploaded_file($var["tmp_name"], "./imghojadevida/" . $tipo . "/" . $var["name"]);

		// $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";
		$imagen = $var["name"];

	} else {

		$imagen = "";
	}
	return $imagen;

}

if ($accion == 1) {



	if ($_FILES["param101"] != '') {

		subirimagen($_FILES["param101"], "fotos");
		// $QL->addDocumento1($_FILES["param101"], 1, "hojadevida", $vinculo, "hojadevida", $DB);// foto
	}
	if ($_FILES["param102"] != '') {

		if (is_uploaded_file($_FILES['param102']['tmp_name'])) {
			// $imagen1 = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";

			move_uploaded_file($_FILES['param102']['tmp_name'], "./imghojadevida/hojadevidadigi/" . $imagen1);

			$imagen1 = $_FILES['param102'];

		} else {
			$imagen1 = "";
		}


		// $QL->addDocumento1($_FILES["param102"], 2, "hojadevida", $vinculo, "hojadevida", $DB);//hoja de vida
	}
	if ($_FILES["param103"] != '') {
		$QL->addDocumento1($_FILES["param103"], 3, "parejas", $vinculo, "parejas", $DB); //celular
	}

    $sql1 = "INSERT INTO `historiaPareja`( `nombrePareja1`, `edadPareja1`, `ocupacionPareja1`, 
	`nombrePareja2`, `edadPareja2`, `ocupacionPareja2`, `terapeutaPareja`, `superPareja`, `montivoPareja1`,
    `motivoPareja2`, `familiarPareja1`, `familarPareja2`, `parejaPareja1`, `parejaPareja2`, `socialPareja1`, 
	`socialPareja2`, `estudioPareja1`, `estudioPareja2`, `saludPareja1`, `saludPareja2`, `espiritualidadPareja1`, 
	`espiritualidadPareja2`, `ocioPareja1`, `ocioPareja2`, `afectacionPareja1`, `afectacionPareja2`) 
	VALUES ('$param1','$param2','$param3','$param4','$param5','$param6','$param7','$param8','$text0',
	 '$text1', '$param9','$param10','$param11','$param12','$param13','$param14','$param15','$param16',
	 '$param17', '$param18','$param19','$param20','$param21','$param22','$text2','$text3')";
	$vinculo = $DB->Executeid($sql1);



	$caso = 'problemas';
	$idPareja = $vinculo;


} else {

	@$idPareja = $_REQUEST["idPareja"];


	$sql = "SELECT `hoj_estaproceso`,`hoj_foto`,`hoj_hvdigital`,`hoj_fotocedula` FROM `hojadevida` where idhojadevida='$idhojadevida'";
	$DB1->Execute($sql);
	$rw = mysqli_fetch_row($DB1->Consulta_ID);
	$id_sedes = $rw[2];

	switch ($condecion) {
		case "datosparejas":



			if ($_FILES["param101"] != '') {

				$foto = subirimagen($_FILES["param101"], "fotos");

				// $QL->addDocumento1($_FILES["param101"], 1, "hojadevida", $idhojadevida, "hojadevida", $DB);// foto

			} else {

				$foto = $rw[1];
			}

			if ($_FILES["param102"] != '') {

				$hojadigtal = subirimagen($_FILES["param102"], "hojadevidadigi");

				// $QL->addDocumento1($_FILES["param102"], 2, "hojadevida", $idhojadevida, "hojadevida", $DB);//hoja de vida
			}
			if ($_FILES["param103"] != '') {

				$fotocedula = subirimagen($_FILES["param103"], "fotos");
				// $QL->addDocumento1($_FILES["param103"], 3, "hojadevida", $idhojadevida, "hojadevida", $DB); //cedula
			}
			// if($_FILES["param108"]!=''){
			// 	$QL->addDocumento1($_FILES["param108"], 8, "hojadevida", $idhojadevida, "hojadevida", $DB); //libreta militar
			// }


		
			$sql1 = "UPDATE hojadevida set `hoj_fechaingreso`='$param1',`hoj_numsim`='$param2', `hoj_nombre`='$param3', `hoj_apellido`='$param4', `hoj_tipoIden`='$param5',`hoj_cedula`='$param6', `hoj_fechanacimiento`='$param7', `hoj_edad`='$param8', `hoj_sede`='$param9', `hoj_direccion`='$param10', `hoj_Ocupacion`='$param11', `hoj_Nivel _escolaridad`='$param12',`hoj_Requiere_acudiente`='$param13', `hoj_Nombre_acu`='$param14', `hoj_Apellido_acu`='$param15',`hoj_Parentesco_acu`='$param16',`hoj_Telefono_acu`='$param17', `hoj_Ocupacion_acu`='$param18',`hoj_Nivel_escolarida_acud`='$param19', `hoj_Email_acu`='$param20' where idhojadevida='$idhojadevida' ";
			$DB1->Execute($sql1);


			$caso = 'problemas';
			break;
		case "problemas":

			echo$sql1 = "UPDATE `historiaPareja` SET `problemaafectavinculo1`='$param2',`problemaafectavinculo2`='$param3',`problemasvinculodesc`='$param4' where idPareja='$idPareja' ";
			$DB1->Execute($sql1);


			$caso = 'predisposicion';
			break;
		case "predisposicion":

			// // if ($param8 == 2) {

			// 	$sql1 = "INSERT INTO `entregavehiculo`(`hoj_histo_edad`='$param21',`hoj_histo_dific`='$param22',`hoj_histo_trata`='$param23',`hoj_histo_compor`='$param24',`hoj_histo_atencion`='$param25',`hoj_histo_racademi`='$param26',`hoj_histo_pares`='$param27',`hoj_histo_autorid`='$param28',`hoj_histo_perdanos`='$param29',`hoj_histo_cuales`='$param30',`hoj_histo_desescol`='$param31',`hoj_histo_anos`='$param32',`hoj_histo_escoact`='$param33',`hoj_histo_gradact`='$param34',`hoj_histo_compact`='$param35',`hoj_histo_atenact`='$param36',`hoj_histo_rendact`='$param37',`hoj_histo_paresact`='$param38',`hoj_histo_autoact`='$param39') VALUES('$param21','$param22','$param23','$param24','$param25','$param26','$param27','$param28','$param29','$param30','$param31','$param32','$param33','$param34','$param35','$param36','$param37','$param38','$param39')";
			// 	$DB->Execute($sql1);

			// 	$caso = 'datosvehiculo';

			// // } else {
				echo$sql1 = "UPDATE historiaPareja set `predisponentes1`='$param22',`predisponentes2`='$param23',`precipitantes1`='$param24',`precipitantes2`='$param25',`preFactoresvínculo`='$param1',`Condicionaclasico1`='$param26',`Condicionaclasico2`='$param27',`CondicionaVinculo`='$param28',`Condopera1`='$param29',`Condopera2`='$param30',`CondoperaVinculo`='$param31',`Modelamiento1`='$param32',`Modelamiento2`='$param33',`ModelamientoVinculo`='$param34',`instruccional1`='$param35',`instruccional2`='$param36',`instruccionalVinculo`='$param37',`Explicación1`='$param38',`Explicación2`='$param39',`ExplicaciónVínculo`='$param2' where idPareja='$idPareja' ";
				$DB->Execute($sql1);
			// 	if ($_FILES["param104"] != '') {
			// 		$QL->addDocumento1($_FILES["param104"], 4, "hojadevida", $idhojadevida, "hojadevida", $DB); //licencia
			// 	}
			// 	if ($_FILES["param105"] != '') {
			// 		$QL->addDocumento1($_FILES["param105"], 5, "hojadevida", $idhojadevida, "hojadevida", $DB); //pagare
			// 	}
			// 	if ($_FILES["param106"] != '') {
			// 		$QL->addDocumento1($_FILES["param106"], 6, "hojadevida", $idhojadevida, "hojadevida", $DB); //estado del vehiculo
			// 	}
			// 	if ($_FILES["param107"] != '') {
			// 		$QL->addDocumento1($_FILES["param107"], 7, "hojadevida", $idhojadevida, "hojadevida", $DB); //documentos del vehiculo
			// 	}
				$caso = 'Mantenimiento';
			// }


		break;
		case "Mantenimiento":
			$sql1 = "UPDATE historiaPareja set  `Condicionamiento1`='$param40',`Condicionamiento2`='$param41',`CondicionamientoVinculo`='$param42',`Regulacion1`='$param43',`Regulacion2`='$param44',`RegulacionVinculo`='$param45',`ExplicacionMant1`='$param46',`ExplicacionMant2`='$param47',`ExplicacionMantVinculo`='$param7' WHERE idPareja='$idPareja'  ";
			$DB->Execute($sql1);
			
			
            // `hoj_emb_tipo`='$param40',`hoj_emb_num`='$param41',`hoj_emb_edadm`='$param42',`hoj_emb_edadp`='$param43',`hoj_emb_prenat`='$param44',`hoj_emb_alcohol`='$param45',`hoj_emb_cigarrillo`='$param46',`hoj_emb_spa`='$param47',`hoj_emb_medic`='$param48',`hoj_emb_clmedic`='$param49',`hoj_emb_obser`='$param50'


			// if ($_FILES["param113"] != '') {

			// 	$QL->addDocumento1($_FILES["param113"], 13, "hojadevida", $idhojadevida, "hojadevida", $DB); // recibo

			// }
			// if ($_FILES["param114"] != '') {

			// 	$QL->addDocumento1($_FILES["param114"], 14, "hojadevida", $idhojadevida, "hojadevida", $DB); // arriendo

			// }
			$caso = 'Intervencion';
			break;
		case "Intervencion":
			$sql1 = "UPDATE historiaPareja set  `ObjetivosConsultante1`='$param48',`ObjetivosConsultante2`='$param49',`ObjetivosConsultanteVinculo`='$param50',`Recursos1`='$param51',`Recursos2`='$param52',`RecursosVinculo`='$param53',`CantidadSesiones1`='$param54',`CantidadSesiones2`='$param55',`CantidadSesionesVinculo`='$param56',`EstratejiaEva1`='$param57',`EstratejiaEva2`='$param58',`EstratejiaEvaVinculo`='$param59' WHERE idPareja='$idPareja' ";
			$DB->Execute($sql1);
			$caso = 'final';
			break;
		/* 	case "datosfamiliares":
		$sql1="UPDATE hojadevida set `hoj_namepadre`='$param17', `hoj_ocupacionp`='$param18', `hoj_telp`='$param19', `hoj_namemadre`='$param20', `hoj_ocupacionm`='$param21', `hoj_telm`='$param22'  where idhojadevida='$idhojadevida' ";
		$DB->Execute($sql1);
		$caso='datosestudios';	
		break; */
		case "Ciclovitaldelafamilia":


			// if ($param8 == 2) {
				echo$sql2 = "INSERT INTO `AntecedentesFP`( `fp_idhistoclinica`, `fp_Trastornos_neurologicosA`, `fp_Quien_la_padeceA`, `fp_Caracteristicas_relevantesA`, `fp_Discapacidad_fisicaB`, `fp_Quien_la_padeceB`, `fp_Caracteresticas_relevantesB`, `fp_Discapacidad_CognitivaC`, `fp_Quien_padeceC`, `fp_Caracteresticas_relevantesC`, `fp_Trastornos_mentalesD`, `fp_Quien_adeceD`, `fp_Caracteresticas_relevantesD`, `fp_Alteraciones_conductualesE`, `fp_Quien_padeceE`, `fp_Caracteristicas_relevantesE`, `fp_Consumo_alcoholF`, `fp_Quien_padeceF`, `fp_Caracteresticas_relevantesF`, `fp_Consumo_cigarrilloG`, `fp_Quien_padeceG`, `fp_Caracteresticas_relevantesG`, `fp_Consumo_SPAH`, `fp_Quien_padeceH`, `fp_Caracteresticas_relevantesH`, `fp_OtraJ`, `fp_CualJ`, `fp_Quien_padeceJ`, `fp_Caracteresticas_relevantesJ`, `fp_Convulsiones`, `fp_a_queEdadconvul`, `fp_Tratamiento_convul`, `fp_Caidas_golpes`, `fp_Edad_caidas_golp`, `fp_Tratamiento_caida_golp`, `fp_Cirugias`, `fp_Edad_cirujia`, `fp_Motivo_cirujia`, `fp_Otras_enfer`, `fp_valor_Terapia_ocup`, `fp_valor_Neuropsicologia`, `fp_valor_Psiquiatra`, `fp_valor_Fonoaudiologiara`, `fp_valor_Otra`, `fp_valor_Cual`, `fp_otra_Motivo`, `fp_otra_Tiempo`, `fp_Toma_medicamento`, `fp_medica_Cual`, `fp_medica_Por_que`) VALUES ('$param50','$param1','$param2','$param3','$param4','$param5','$param6','$param7','$param8','$param9','$param10','$param11','$param12','$param13','$param14','$param15','$param16','$param17','$param18','$param19','$param20','$param21','$param22','$param23','$param24','$param25','$param26','$param27','$param28','$param29','$param30','$param31','$param32','$param33','$param34','$param35','$param36','$param37','$param38','$param39','$param40','$param41','$param42','$param43','$param44','$param45','$param46','$param47','$param48','$param49')";
				$vinculo = $DB->Executeid($sql2);
				// if ($_FILES["param109"] != '') {

				// 	$QL->addDocumento1($_FILES["param109"], 1, "referenciasfamiliares", $vinculo, "referenciasfamiliares", $DB); // referencias

				// }
				$caso = 'Eventosconsideradosfortalezas';


			// } else {
			// 	$caso = 'datosconyuge';
			// }

			break;
		case "Eventosconsideradosfortalezas":
			/* $sql1="UPDATE hojadevida set  `hoj_tipoestudio`='$param23', `hoj_institucion`='$param24', `hoj_ciudades`='$param25', `hoj_fechagrado`='$param26'  where idhojadevida='$idhojadevida' ";
			$DB->Execute($sql1);
			*/


			$file = $_FILES['param110'];
			$nombre = $file['name'];
			$tipo = $file['type'];
			$ruta_temporal = $file['tmp_name'];
			$tamaño = $file['size'];
			
			// para guardar en servidor
			$direccion_de_guardado = 'imghistorial/' . $nombre;
			move_uploaded_file($ruta_temporal, $direccion_de_guardado);
			
			// para guardar en base de datos
			$contenido = file_get_contents($ruta_temporal);

			$sql1 = "UPDATE hojadevida set  `hoj_nomgenograma`='$nombre'  where idhojadevida='$idhojadevida' ";
			$DB->Execute($sql1);


			// if ($param8 == 2) {
			// 	if ($param1 == 'Otros Cursos') {
			// 		$param1 = $param9;
			// 	}
			// 	$sql2 = "INSERT INTO `referenciasestudio`(`ref_grado`, `ref_institucion`, `ref_ciudad`, `ref_fehcainicio`, `ref_fechaterminacion`, `ref_userregistra`, `ref_fechaingreso`, `ref_idhojavida`) VALUES ('$param1','$param2','$param3','$param4','$param5','$id_nombre','$fechatiempo','$param7')";
			// 	$vinculo = $DB->Executeid($sql2);
			// 	if ($_FILES["param110"] != '') {

			// 		$QL->addDocumento1($_FILES["param110"], 1, "referenciasestudio", $vinculo, "referenciasestudio", $DB); // referencias

			// 	}
			// 	$caso = 'datosestudios';

			// } else {
				$caso = 'Ciclovitaldelafamilia';
			// }

			break;
		case "datossalud":
			/* 	$sql1="UPDATE hojadevida set `hoj_eps`='$param27' , `hoj_fechaeps`='$param28' ,  `hoj_arl`='$param29', `hoj_fechaafi`='$param30' , `hoj_pension`='$param31', `hoj_fechapen`='$param32', `hoj_cajacompensacion`='$param37', `hoj_fechacaja`='$param38'   where idhojadevida='$idhojadevida' ";
			$DB->Execute($sql1); */
			if ($param8 == 2) {
				$sql2 = "INSERT INTO `seguridadsocial`(`seg_nombre`,`seg_entidad`,`seg_fechaentrega`, `seg_tipodocumento`,  `seg_idhojavida`,`seg_useringresa`,`seg_fechaingreso`) 
			VALUES ('$param2','$param3','$param4','$param5','$param7','$id_nombre','$fechatiempo')";
				$vinculo = $DB->Executeid($sql2);

				if ($_FILES["param112"] != '') {

					$QL->addDocumento1($_FILES["param112"], 1, "seguridadsocial", $vinculo, "seguridadsocial", $DB); // seguridadsocial

				}
				$caso = 'datossalud';
			} else {

				$caso = 'saludafiliaciones';
			}



			break;
		case "saludafiliaciones":
			//SELECT `idrefenciassalud`, `ref_nombre`, `ref_parentesco`, `ref_vinculadoa`,`ref_ocupacion`, `ref_telefono`,  `ref_fechavinculacion`, `ref_idhojavida`, `ref_usuregistra`, `ref_fecharegistra` FROM `referenciassalud`
			if ($param8 == 2) {
				$sql2 = "INSERT INTO `referenciassalud`(`ref_nombre`, `ref_parentesco`,`ref_vinculadoa`,`ref_ocupacion`, `ref_telefono`,`ref_fechavinculacion`, `ref_idhojavida`, `ref_usuregistra`, `ref_fecharegistra`,`ref_tipodocumento`)
		VALUES ('$param1','$param2','$param3','$param4','$param5','$param6','$param7','$id_nombre','$fechatiempo','$param9')";
				$vinculo = $DB->Executeid($sql2);
				if ($_FILES["param110"] != '') {

					$QL->addDocumento1($_FILES["param110"], 1, "referenciassalud", $vinculo, "referenciassalud", $DB); // referencias

				}
				$caso = 'saludafiliaciones';

			} else {
				$caso = 'Motivoconsulta';
			}

			break;
		case "Motivoconsulta":

			if ($param8 == 2) {
				$sql2 = "INSERT INTO `referenciaslaborales`(`ref_consultante`, `ref_acompañante`, `ref_idhojavida`) 
		VALUES ('$motivo','$motivo1','$param')";
				$vinculo = $DB->Executeid($sql2);
				if ($_FILES["param111"] != '') {

					$QL->addDocumento1($_FILES["param111"], 1, "referenciaslaborales", $vinculo, "referenciaslaborales", $DB); // referenciaslaborales

				}
				$caso = 'examenesmedicos';


			} else {

				$caso = 'examenesmedicos';
			}


			break;
		case "examenesmedicos":

			if ($param8 == 2) {
				$sql2 = "INSERT INTO `examenesmedicos`(`exa_nombre`,`exa_serie`, `exa_idhojavida`,`exa_fechaentrega`, `exa_useringresa`,`exa_fechaingreso`,`exa_tipo`) 
		VALUES ('$param1','$param2','$param7','$param3','$id_nombre','$fechatiempo','$param39')";
				$vinculo = $DB->Executeid($sql2);

				if ($_FILES["param112"] != '') {

					$QL->addDocumento1($_FILES["param112"], 1, "examenesmedicos", $vinculo, "examenesmedicos", $DB); // examenesmedicos

				}

				$caso = 'examenesmedicos';

			} else {
				$caso = 'datoscontrato';


			}


			break;
		case "dotacion":
			if ($param8 == 2) {
				$sql2 = "INSERT INTO `elementostrabajo`(`ele_nombre`,`ele_serie`, `ele_idhojavida`,`ele_fechaentrega`, `ele_useringresa`,`ele_fechaingreso`) 
				VALUES ('$param1','$param2','$param7','$param3','$id_nombre','$fechatiempo')";
				$vinculo = $DB->Executeid($sql2);

				if ($_FILES["param112"] != '') {

					$QL->addDocumento1($_FILES["param112"], 1, "elementostrabajo", $vinculo, "referenciaslaborales", $DB); // referenciaslaborales

				}

				$caso = 'dotacion';


			} else {

				$caso = 'Incapacidades';
			}


			break;
		case "Incapacidades":
			if ($param8 == 2) {
				$sql2 = "INSERT INTO `incapacidades`(`ref_fehcainicio`, `ref_fechaterminacion`, `ref_dias`, `ref_tipodeincapacidad`, `ref_userregistra`, `ref_fechaingreso`, `ref_idhojavida`)
					VALUES ('$param1','$param2','$param3','$param4','$id_nombre','$fechatiempo','$param7')";
				$vinculo = $DB->Executeid($sql2);

				if ($_FILES["param5"] != '') {

					$QL->addDocumento1($_FILES["param5"], 1, "incapacidades", $vinculo, "incapacidades", $DB); // incapacidades

				}

				$caso = 'Incapacidades';


			} else {

				$caso = 'memorandos';
			}
			break;
		case "RegistrarPago":
			$idincapacidades = $_REQUEST["idincapacidades"];
			$sql = "UPDATE `incapacidades` SET `ref_fechapagoincapacidad`='$param1',`ref_valorpagado`='$param2',`ref_validadopago`='$id_nombre',`ref_fechavalidacion`='$date'  WHERE `idincapacidades`='$idincapacidades' ";
			$DB->Execute($sql);


			if ($_FILES["param112"] != '') {

				$QL->addDocumento1($_FILES["param112"], 1, "RegistrarPago", $idincapacidades, "RegistrarPago", $DB); // examenesmedicos

			}

			$caso = 'Incapacidades';
			break;
		case "memorandos":
			if ($param8 == 2) {
				$sql2 = "INSERT INTO `memorandos`(`mem_fecha`, `mem_tipomemorando`,  `mem_descripcion`, `mem_tipodocumento`,`mem_idhojavida`, `mem_userregistra`, `mem_fecharegistro`) 
					VALUES ('$param1','$param2','$param3','$param4','$param7','$id_nombre','$fechatiempo')";
				$vinculo = $DB->Executeid($sql2);

				if ($_FILES["param110"] != '') {

					$QL->addDocumento1($_FILES["param110"], 1, "memorandos", $vinculo, "memorandos", $DB); // memorandos

				}

				$caso = 'memorandos';


			} else {

				$caso = 'terminacioncontrato';
			}
			break;
		case "terminacioncontrato":

			$sql1 = "UPDATE hojadevida set `hoj_fechatermino`='$param1' , `hoj_entregapuesto`='$param2' ,  `hoj_pazysalvo`='$param3', `hoj_estado`='$param4'   where idhojadevida='$idhojadevida' ";
			$DB->Execute($sql1);

			if ($_FILES["param111"] != '') {
				$QL->addDocumento1($_FILES["param111"], 11, "hojadevida", $idhojadevida, "hojadevida", $DB); // Foto Paz y Salvo
			}
			$caso = 'final';


			break;
		default:

			break;
	}


}


if ($caso == 'final') {
	header("Location:parejas.php");
} else {

	header("Location:HistoriaParejas.php?bandera=1&condecion=$caso&idPareja=$idPareja");
}



?>