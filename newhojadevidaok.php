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
		$QL->addDocumento1($_FILES["param103"], 3, "hojadevida", $vinculo, "hojadevida", $DB); //celular
	}


	$sql1 = "INSERT INTO `hojadevida`(`hoj_fechaingreso`,`hoj_numsim`,`hoj_nombre`, `hoj_apellido`,
		 `hoj_tipoIden`,`hoj_cedula`,`hoj_fechanacimiento`,`hoj_edad`,`hoj_sede`, `hoj_direccion`,
		 `hoj_Ocupacion`, `hoj_Nivel _escolaridad`,`hoj_Requiere_acudiente`,`hoj_Nombre_acu`,`hoj_Apellido_acu`,
		 `hoj_Parentesco_acu`,`hoj_Telefono_acu`,`hoj_Ocupacion_acu`,`hoj_Nivel_escolarida_acud`,`hoj_Email_acu`) 
		VALUES ('$param1','$param2','$param3','$param4','$param5','$param6','$param7','$param8','$param9',
		'$param10', '$param11','$param12','$param13','$param14','$param15','$param16','$param17','$param18',
		'$param19','$param20')";
	$vinculo = $DB->Executeid($sql1);

	// $sql="INSERT INTO `usuarios`(roles_idroles, usu_nombre, usu_usuario,usu_pass,usu_mail,usu_idtipodocumento,usu_identificacion, usu_genero,  usu_idsede, usu_idempresa,  usu_celular,usu_tipovehiculo,usu_vehiculo,usu_licencia,usu_fechalicencia,usu_tipocontrato,usu_estado,usu_idcredito) VALUES 
	// ('28','$param3','$param3','$param6','','','$param6','','','','','','','','','','1','')";


	$vinculo1 = $DB->Executeid($sql);
	$caso = 'datoslaborales';
	$idhojadevida = $vinculo;


} else {

	@$idhojadevida = $_REQUEST["idhojadevida"];


	// echo$sql = "SELECT `hoj_estaproceso`,`hoj_foto`,`hoj_hvdigital`,`hoj_fotocedula` FROM `hojadevida` where idhojadevida='$idhojadevida'";
	// $DB1->Execute($sql);
	// $rw = mysqli_fetch_row($DB1->Consulta_ID);
	// $id_sedes = $rw[2];

	switch ($condecion) {
		case "datospersonales":



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


		
			echo$sql1 = "UPDATE hojadevida set `hoj_fechaingreso`='$param1',`hoj_numsim`='$param2', `hoj_nombre`='$param3', `hoj_apellido`='$param4', `hoj_tipoIden`='$param5',`hoj_cedula`='$param6', `hoj_fechanacimiento`='$param7', `hoj_edad`='$param8', `hoj_sede`='$param9', `hoj_direccion`='$param10', `hoj_Ocupacion`='$param11', `hoj_Nivel _escolaridad`='$param12',`hoj_Requiere_acudiente`='$param13', `hoj_Nombre_acu`='$param14', `hoj_Apellido_acu`='$param15',`hoj_Parentesco_acu`='$param16',`hoj_Telefono_acu`='$param17', `hoj_Ocupacion_acu`='$param18',`hoj_Nivel_escolarida_acud`='$param19', `hoj_Email_acu`='$param20' where idhojadevida='$idhojadevida' ";
			$DB1->Execute($sql1);


			$caso = 'Motivoconsulta';
			break;
		case "Motivoconsulta":

			echo$sql1 = "UPDATE hojadevida set `hoj_ReportadoColsun`='$param10',`hoj_ReportadoAcomp`='$param11' where idhojadevida='$idhojadevida' ";
			$DB1->Execute($sql1);


			$caso = 'Posiblescausas';
			break;
			case "Posiblescausas":

				echo$sql1 = "UPDATE hojadevida set `hoj_Negligencia`='$param21',`hoj_AbusoPsicologico`='$param22',`hoj_ConsumoSPA`='$param23',`hoj_IdeacionSuicida`='$param24',`hoj_VinculacionNegativo`='$param25',`hoj_PresuntoAbusoSexual`='$param26',`hoj_ConsumoAlcohol`='$param27',`hoj_TrabajoInfantil`='$param28',`hoj_DificultadesConyugales`='$param29',`hoj_DificultadesFamiliaExtensa`='$param30',`hoj_Abandono`='$param31',`hoj_ViolenciaIntrafamiliar`='$param32',`hoj_IdeasMuerte`='$param33',`hoj_ExposicionContenidoSexual`='$param34',`hoj_AbusoFisico`='$param35',`hoj_ConsumoCigarrillo`='$param36',`hoj_PermanenciaCalle`='$param37',`hoj_IntentosSuicidio`='$param38',`hoj_DificultadesFraternale`='$param39' where idhojadevida='$idhojadevida' ";
				$DB1->Execute($sql1);
	
	
				$caso = 'Historialescolar';
				break;
		case "Historialescolar":

			// // if ($param8 == 2) {

			// 	$sql1 = "INSERT INTO `entregavehiculo`(`hoj_histo_edad`='$param21',`hoj_histo_dific`='$param22',`hoj_histo_trata`='$param23',`hoj_histo_compor`='$param24',`hoj_histo_atencion`='$param25',`hoj_histo_racademi`='$param26',`hoj_histo_pares`='$param27',`hoj_histo_autorid`='$param28',`hoj_histo_perdanos`='$param29',`hoj_histo_cuales`='$param30',`hoj_histo_desescol`='$param31',`hoj_histo_anos`='$param32',`hoj_histo_escoact`='$param33',`hoj_histo_gradact`='$param34',`hoj_histo_compact`='$param35',`hoj_histo_atenact`='$param36',`hoj_histo_rendact`='$param37',`hoj_histo_paresact`='$param38',`hoj_histo_autoact`='$param39') VALUES('$param21','$param22','$param23','$param24','$param25','$param26','$param27','$param28','$param29','$param30','$param31','$param32','$param33','$param34','$param35','$param36','$param37','$param38','$param39')";
			// 	$DB->Execute($sql1);

			// 	$caso = 'datosvehiculo';

			// // } else {
				echo$sql1 = "UPDATE hojadevida set `hoj_histo_edad`='$param21',`hoj_histo_dific`='$param22',`hoj_histo_trata`='$param23',`hoj_histo_compor`='$param24',`hoj_histo_atencion`='$param25',`hoj_histo_racademi`='$param26',`hoj_histo_pares`='$param27',`hoj_histo_autorid`='$param28',`hoj_histo_perdanos`='$param29',`hoj_histo_cuales`='$param30',`hoj_histo_desescol`='$param31',`hoj_histo_anos`='$param32',`hoj_histo_escoact`='$param33',`hoj_histo_gradact`='$param34',`hoj_histo_compact`='$param35',`hoj_histo_atenact`='$param36',`hoj_histo_rendact`='$param37',`hoj_histo_paresact`='$param38',`hoj_histo_autoact`='$param39' where idhojadevida='$idhojadevida' ";
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
				$caso = 'Historiadeldesarrollo';
			// }


		break;
		case "Historiadeldesarrollo":
			echo$sql1 = "UPDATE hojadevida set  `hoj_emb_tipo`='$param40',`hoj_emb_num`='$param41',`hoj_emb_edadm`='$param42',`hoj_emb_edadp`='$param43',`hoj_emb_prenat`='$param44',`hoj_emb_alcohol`='$param45',`hoj_emb_cigarrillo`='$param46',`hoj_emb_spa`='$param47',`hoj_emb_medic`='$param48',`hoj_emb_clmedic`='$param49',`hoj_emb_obser`='$param50',`hoj_Sosten_cefalico_meses`='$param51',`hoj_Sentarse_solo_mese`='$param52',`hoj_Gateo`='$param53',`hoj_Meses`='$param54',`hoj_Bipedestacion`='$param55',`hoj_Camino`='$param56',`hoj_palabras`='$param57',`hoj_Control_de_esfi_diu mes`='$param58',`hoj_Control_de_esfi_noc_mes`='$param59',`hoj_obseDesarrollo_psicomotor`='$param60' where idhojadevida='$param7' ";
			$DB->Execute($sql1);
			
			
            // `hoj_emb_tipo`='$param40',`hoj_emb_num`='$param41',`hoj_emb_edadm`='$param42',`hoj_emb_edadp`='$param43',`hoj_emb_prenat`='$param44',`hoj_emb_alcohol`='$param45',`hoj_emb_cigarrillo`='$param46',`hoj_emb_spa`='$param47',`hoj_emb_medic`='$param48',`hoj_emb_clmedic`='$param49',`hoj_emb_obser`='$param50'


			// if ($_FILES["param113"] != '') {

			// 	$QL->addDocumento1($_FILES["param113"], 13, "hojadevida", $idhojadevida, "hojadevida", $DB); // recibo

			// }
			// if ($_FILES["param114"] != '') {

			// 	$QL->addDocumento1($_FILES["param114"], 14, "hojadevida", $idhojadevida, "hojadevida", $DB); // arriendo

			// }
			$caso = 'Antecedentesmedicosypsiquiatricosfamiliaresypersonales';
			break;
		case "datosconyuge":
			echo$sql1 = "UPDATE hojadevida set  `hoj_conyuge`='$param14', `hoj_profesion`='$param15',`hoj_celularconyuge`='$param16'  where idhojadevida='$idhojadevida' ";
			$DB->Execute($sql1);
			$caso = 'saludafiliaciones';
			break;
		/* 	case "datosfamiliares":
		$sql1="UPDATE hojadevida set `hoj_namepadre`='$param17', `hoj_ocupacionp`='$param18', `hoj_telp`='$param19', `hoj_namemadre`='$param20', `hoj_ocupacionm`='$param21', `hoj_telm`='$param22'  where idhojadevida='$idhojadevida' ";
		$DB->Execute($sql1);
		$caso='datosestudios';	
		break; */
		case "Antecedentesmedicosypsiquiatricosfamiliaresypersonales":


			if ($param51 == "") {


				echo$sql2 = "INSERT INTO `AntecedentesFP`( `fp_idhistoclinica`, `fp_Trastornos_neurologicosA`, `fp_Quien_la_padeceA`, `fp_Caracteristicas_relevantesA`, `fp_Discapacidad_fisicaB`, `fp_Quien_la_padeceB`, `fp_Caracteresticas_relevantesB`, `fp_Discapacidad_CognitivaC`, `fp_Quien_padeceC`, `fp_Caracteresticas_relevantesC`, `fp_Trastornos_mentalesD`, `fp_Quien_adeceD`, `fp_Caracteresticas_relevantesD`, `fp_Alteraciones_conductualesE`, `fp_Quien_padeceE`, `fp_Caracteristicas_relevantesE`, `fp_Consumo_alcoholF`, `fp_Quien_padeceF`, `fp_Caracteresticas_relevantesF`, `fp_Consumo_cigarrilloG`, `fp_Quien_padeceG`, `fp_Caracteresticas_relevantesG`, `fp_Consumo_SPAH`, `fp_Quien_padeceH`, `fp_Caracteresticas_relevantesH`, `fp_OtraJ`, `fp_CualJ`, `fp_Quien_padeceJ`, `fp_Caracteresticas_relevantesJ`, `fp_Convulsiones`, `fp_a_queEdadconvul`, `fp_Tratamiento_convul`, `fp_Caidas_golpes`, `fp_Edad_caidas_golp`, `fp_Tratamiento_caida_golp`, `fp_Cirugias`, `fp_Edad_cirujia`, `fp_Motivo_cirujia`, `fp_Otras_enfer`, `fp_valor_Terapia_ocup`, `fp_valor_Neuropsicologia`, `fp_valor_Psiquiatra`, `fp_valor_Fonoaudiologiara`, `fp_valor_Otra`, `fp_valor_Cual`, `fp_otra_Motivo`, `fp_otra_Tiempo`, `fp_Toma_medicamento`, `fp_medica_Cual`, `fp_medica_Por_que`) VALUES ('$param50','$param1','$param2','$param3','$param4','$param5','$param6','$param7','$param8','$param9','$param10','$param11','$param12','$param13','$param14','$param15','$param16','$param17','$param18','$param19','$param20','$param21','$param22','$param23','$param24','$param25','$param26','$param27','$param28','$param29','$param30','$param31','$param32','$param33','$param34','$param35','$param36','$param37','$param38','$param39','$param40','$param41','$param42','$param43','$param44','$param45','$param46','$param47','$param48','$param49')";
				$vinculo = $DB->Executeid($sql2);
				// if ($_FILES["param109"] != '') {

				// 	$QL->addDocumento1($_FILES["param109"], 1, "referenciasfamiliares", $vinculo, "referenciasfamiliares", $DB); // referencias

				}else{


					echo$sql2 ="UPDATE `AntecedentesFP` SET `fp_Trastornos_neurologicosA`='$param1',`fp_Quien_la_padeceA`='$param2',`fp_Caracteristicas_relevantesA`='$param3',`fp_Discapacidad_fisicaB`='$param4',`fp_Quien_la_padeceB`='$param5',`fp_Caracteresticas_relevantesB`='$param6',`fp_Discapacidad_CognitivaC`='$param7',`fp_Quien_padeceC`='$param8',`fp_Caracteresticas_relevantesC`='$param8',`fp_Trastornos_mentalesD`='$param9',`fp_Quien_adeceD`='$param10',`fp_Caracteresticas_relevantesD`='$param11',`fp_Alteraciones_conductualesE`='$param12',`fp_Quien_padeceE`='$param13',`fp_Caracteristicas_relevantesE`='$param14',`fp_Consumo_alcoholF`='$param15',`fp_Quien_padeceF`='$param16',`fp_Caracteresticas_relevantesF`='$param17',`fp_Consumo_cigarrilloG`='$param18',`fp_Quien_padeceG`='$param19',`fp_Caracteresticas_relevantesG`='$param20',`fp_Consumo_SPAH`='$param21',`fp_Quien_padeceH`='$param22',`fp_Caracteresticas_relevantesH`='$param23',`fp_OtraJ`='$param24',`fp_CualJ`='$param25',`fp_Quien_padeceJ`='$param26',`fp_Caracteresticas_relevantesJ`='$param27',`fp_Convulsiones`='$param28',`fp_a_queEdadconvul`='$param29',`fp_Tratamiento_convul`='$param30',`fp_Caidas_golpes`='$param31',`fp_Edad_caidas_golp`='$param32',`fp_Tratamiento_caida_golp`='$param33',`fp_Cirugias`='$param34',`fp_Edad_cirujia`='$param35',`fp_Motivo_cirujia`='$param36',`fp_Otras_enfer`='$param37',`fp_valor_Terapia_ocup`='$param38',`fp_valor_Neuropsicologia`='$param39',`fp_valor_Psiquiatra`='$param40',`fp_valor_Fonoaudiologiara`='$param41',`fp_valor_Otra`='$param42',`fp_valor_Cual`='$param43',`fp_otra_Motivo`='$param44',`fp_otra_Tiempo`='$param45',`fp_Toma_medicamento`='$param46',`fp_medica_Cual`='$param47',`fp_medica_Por_que`='$param48' WHERE fp_idhistoclinica ='$param50'";
					$vinculo = $DB->Executeid($sql2);
				}
				$caso = 'GenogramaDescripcionfamiliar';


			// } else {
			// 	$caso = 'datosconyuge';
			// }

			break;
		case "GenogramaDescripcionfamiliar":
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

			echo$sql1 = "UPDATE hojadevida set  `hoj_nomgenograma`='$nombre'  where idhojadevida='$idhojadevida' ";
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
			case "Ciclovitaldelafamilia":
				/* 	$sql1="UPDATE hojadevida set `hoj_eps`='$param27' , `hoj_fechaeps`='$param28' ,  `hoj_arl`='$param29', `hoj_fechaafi`='$param30' , `hoj_pension`='$param31', `hoj_fechapen`='$param32', `hoj_cajacompensacion`='$param37', `hoj_fechacaja`='$param38'   where idhojadevida='$idhojadevida' ";
				$DB->Execute($sql1); */
	
				echo$sql1 = "UPDATE hojadevida set  `hoj_Preescolar`='$param1',`hoj_Escolar`='$param2',`hoj_adolecente`='$param3',`hoj_adultojoven`='$param4',`hoj_disolucion`='$param5' where idhojadevida='$param7' ";
				$DB->Execute($sql1);
	
	
				// if ($param8 == 2) {
				// 	$sql2 = "INSERT INTO `seguridadsocial`(`seg_nombre`,`seg_entidad`,`seg_fechaentrega`, `seg_tipodocumento`,  `seg_idhojavida`,`seg_useringresa`,`seg_fechaingreso`) 
				// VALUES ('$param2','$param3','$param4','$param5','$param7','$id_nombre','$fechatiempo')";
				// 	$vinculo = $DB->Executeid($sql2);
	
				// 	if ($_FILES["param112"] != '') {
	
				// 		$QL->addDocumento1($_FILES["param112"], 1, "seguridadsocial", $vinculo, "seguridadsocial", $DB); // seguridadsocial
	
				// 	}
				// 	$caso = 'datossalud';
				// } else {
	
					$caso = 'Eventosconsideradosfortalezas';
				// }
	
	
	
				break;
		case "Eventosconsideradosfortalezas":
	
			echo$sql1 = "UPDATE hojadevida set  `hoj_VincularAmpliaDensa`='$param71',`hoj_VinculosClaros`='$param72',`hoj_EconomicaEstable`='$param73',`hoj_ParentalesArmoniosas`='$param74',`hoj_FamiliaArmoniosasEx`='$param75',`hoj_FamiliaresSuficientes`='$param76',`hoj_PertenenciaInclusion`='$param77',`hoj_ParejaArmoniosa`='$param78',`hoj_RelacionesFraternalesArmoniosas`='$param79',`hoj_BuenaSituacionLaboral`='$param80',`hoj_otra`='$param81',`hoj_cual`='$param82' where idhojadevida='$param7' ";
			$DB->Execute($sql1);


				$caso = 'Eventosestresantes';
			

			break;

			case "Eventosestresantes":

				echo$sql1 = "UPDATE hojadevida set  `hoj_RVCTR`='$param10',`hoj_RDPC`='$param11',`hoj_SEII`='$param12',`hoj_RPC`='$param13',`hoj_RFEC`='$param14',`hoj_evnexOtra`='$param15',`hoj_VCCD`='$param16',`hoj_CSCAE`='$param17',`hoj_RFI`='$param18',`hoj_RFC`='$param19',`hoj_DESL`='$param20',`hoj_evnexCual`='$param21' where idhojadevida='$param7' ";
				$DB->Execute($sql1);
	
	
					$caso = 'Comprensiondelcaso';
				// }
	
	
	
	
	
			
	
	
				break;
		case "Comprensiondelcaso":
			echo$sql1 = "UPDATE hojadevida set  `hoj_comprencaso`='$param10' where idhojadevida='$param7' ";
				$DB->Execute($sql1);

			$caso = 'Hipotesisdelcaso';
			break;
		case "Hipotesisdelcaso":

			echo$sql1 = "UPDATE hojadevida set `hoj_hipocaso`='$param11' where idhojadevida='$param7' ";
				$DB->Execute($sql1);
	
			$caso = 'Objetivosdelacompañamientopsicológicoespecializado';
			break;
		
		case "Objetivosdelacompañamientopsicológicoespecializado":
		
			echo$sql1 = "UPDATE hojadevida set  `hoj_oapsicoespe`='$param12' where idhojadevida='$param7' ";
				$DB->Execute($sql1);
			$caso = 'Estrategiasy/otecnicasdeintervencion';
			break;
		case "Estrategiasy/otecnicasdeintervencion":
		

			echo$sql1 = "UPDATE hojadevida set  `hoj_tecnicasinter`='$param13' where idhojadevida='$param7' ";
				$DB->Execute($sql1);

			$caso = 'ImpresionDiagnostica';
			break;
		case "ImpresionDiagnostica":
			

			echo$sql1 = "UPDATE hojadevida set  `hoj_imprediagnos`='$param14' where idhojadevida='$param7' ";
				$DB->Execute($sql1);

			$caso = 'terminacioncontrato';
			break;
		case "terminacioncontrato":

			$caso = 'Hipotesisdelcaso';
		

			break;
		default:

			break;
	}


}


if ($caso == 'final') {
	header("Location:hojadevida.php");
} else {

	header("Location:new_hojadevida.php?bandera=1&condecion=$caso&idhojadevida=$idhojadevida");
}



?>