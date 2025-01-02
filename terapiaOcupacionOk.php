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



	// if ($_FILES["param101"] != '') {

	// 	subirimagen($_FILES["param101"], "fotos");
	// 	// $QL->addDocumento1($_FILES["param101"], 1, "hojadevida", $vinculo, "hojadevida", $DB);// foto
	// }
	// if ($_FILES["param102"] != '') {

	// 	if (is_uploaded_file($_FILES['param102']['tmp_name'])) {
	// 		// $imagen1 = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";

	// 		move_uploaded_file($_FILES['param102']['tmp_name'], "./imghojadevida/hojadevidadigi/" . $imagen1);

	// 		$imagen1 = $_FILES['param102'];

	// 	} else {
	// 		$imagen1 = "";
	// 	}


	// 	$QL->addDocumento1($_FILES["param102"], 2, "hojadevida", $vinculo, "hojadevida", $DB);//hoja de vida
	// }
	// if ($_FILES["param103"] != '') {
	// 	$QL->addDocumento1($_FILES["param103"], 3, "parejas", $vinculo, "parejas", $DB); //celular
	// }

    $sql1 = "INSERT INTO `terapiaOcupacional`(`teOcu_param1`, `teOcu_param2`, `teOcu_param3`, `teOcu_param4`, `teOcu_param5`, `teOcu_param6`, `teOcu_param7`, `teOcu_param8`, `teOcu_param9`) VALUES ('$param1','$param2'	,'$param3'	,'$param4'	,'$param5'	,'$param6'	,'$param7'	,'$param8'	,'$param9')";
	$vinculo = $DB->Executeid($sql1);



	$caso = 'Neuromuscular';
	$idPareja = $vinculo;


} else {

	@$idPareja = $_REQUEST["idPareja"];


	echo$sql = "SELECT `hoj_estaproceso`,`hoj_foto`,`hoj_hvdigital`,`hoj_fotocedula` FROM `hojadevida` where idhojadevida='$idhojadevida'";
	$DB1->Execute($sql);
	$rw = mysqli_fetch_row($DB1->Consulta_ID);
	$id_sedes = $rw[2];

	switch ($condecion) {
		case "datosocupacional":

		
			$sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
			$DB1->Execute($sql1);


			$caso = 'Neuromuscular';
			break;
		case "Neuromuscular":

			$sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param10`='$param1',`teOcu_param11`='$param2',`teOcu_param12`='$param3',`teOcu_param13`='$param4',`teOcu_param14`='$param5',`teOcu_param15`='$param6',`teOcu_param16`='$param7',`teOcu_param17`='$param8',`teOcu_param18`='$param9',`teOcu_param19`='$param10',`teOcu_param20`='$param11',`teOcu_param21`='$param12',`teOcu_param22`='$param13',`teOcu_param23`='$param14',`teOcu_param24`='$param15',`teOcu_param25`='$param16',`teOcu_param26`='$param17',`teOcu_param27`='$param18',`teOcu_param28`='$param19',`teOcu_param29`='$param20',`teOcu_param30`='$param21',`teOcu_param31`='$param22',`teOcu_param32`='$param23',`teOcu_param33`='$param24',`teOcu_param34`='$param25',`teOcu_param35`='$param26',`teOcu_param36`='$param27',`teOcu_param37`='$param28',`teOcu_param38`='$param29',`teOcu_param39`='$param30',`teOcu_param40`='$param31',`teOcu_param41`='$param32',`teOcu_param42`='$param33',`teOcu_param43`='$param34',`teOcu_param44`='$param35',`teOcu_param45`='$param36',`teOcu_param46`='$param37',`teOcu_param47`='$param38',`teOcu_param48`='$param39',`teOcu_param49`='$param40',`teOcu_param50`='$param41',`teOcu_param51`='$param42',`teOcu_param52`='$param43',`teOcu_param53`='$param44',`teOcu_param54`='$param45',`teOcu_param55`='$param46',`teOcu_param56`='$param47',`teOcu_param57`='$param48',`teOcu_param58`='$param49',`teOcu_param59`='$param50',`teOcu_param60`='$param51',`teOcu_param61`='$param52',`teOcu_param62`='$param53',`teOcu_param63`='$param54',`teOcu_param64`='$param55',`teOcu_param65`='$param56',`teOcu_param66`='$param57',`teOcu_param67`='$param58',`teOcu_param68`='$param59',`teOcu_param69`='$param60',`teOcu_param70`='$param61',`teOcu_param71`='$param62',`teOcu_param72`='$param63',`teOcu_param73`='$param64',`teOcu_param74`='$param65',`teOcu_param75`='$param66',`teOcu_param76`='$param67',`teOcu_param77`='$param68',`teOcu_param78`='$param69',`teOcu_param79`='$param70' WHERE idterocu='$idPareja' ";
			$DB1->Execute($sql1);

			$caso = 'Amplitud';
			break;
		case "Amplitud":

            $sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
			$DB1->Execute($sql1);
	
				$caso = 'Coordinacion';
			


		break;
		case "Coordinacion":
			$sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
			$DB1->Execute($sql1);
			
			$caso = 'sensorio';
			break;
		case "sensorio":
			$sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
			$DB1->Execute($sql1);
			$caso = 'Procesos';
			break;
		
		case "Procesos":
			$sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
			$DB1->Execute($sql1);
			$caso = 'Autocuidado';
			break;
		case "Autocuidado":
			$sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
			$DB1->Execute($sql1);
			$caso = 'Procesamiento';

			break;
			case "Procesamiento":
                $sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
                $DB1->Execute($sql1);
				$caso = 'final';
				break;
			
			case "riesgo":
                $sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
                $DB1->Execute($sql1);
				$caso = 'Observaciones';
				break;
			case "Observaciones":
                $sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
                $DB1->Execute($sql1);
				$caso = 'Observaciones';
	
				break;
				
				case "Observaciones":
					$sql1 = "UPDATE `terapiaOcupacional` SET `teOcu_param1`='$param1',`teOcu_param2`='$param2',`teOcu_param3`='$param3',`teOcu_param4`='$param4',`teOcu_param5`='$param5',`teOcu_param6`='$param6',`teOcu_param7`='$param7',`teOcu_param8`='$param8',`teOcu_param9`='$param9' WHERE idterocu='$idPareja' ";
			$DB1->Execute($sql1);
					$caso = 'final';
		
					break;



		default:

			break;
	}


}


if ($caso == 'final') {
	header("Location:valoracion.php");
} else {

	header("Location:terapiaOcupacion.php?bandera=1&condecion=$caso&idPareja=$idPareja");
}



?>