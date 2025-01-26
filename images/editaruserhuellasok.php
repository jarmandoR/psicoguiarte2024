<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote3.php"); 
@$accion=$_REQUEST["accion"];
 $id_nombre=$_SESSION['usuario_nombre'];
 $DB = new DB_mssql;
 $DB->conectar();  
 
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<!-- <script src="js/jquery-2.1.0.min.js"></script>
 --><style>
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
@$idhojadevida=$_REQUEST["idhojadevida"];
@$id_param=$_REQUEST["id_param"];
//echo $condecion;
if($idhojadevida==''){
	$idhojadevida=$id_param;
}

if($accion!=1){

	
	 // $sql="SELECT `idhojadevida`, `hoj_fechaingreso`, `hoj_sede`, `hoj_nombre`, `hoj_apellido`, `hoj_fechanacimiento`, `hoj_cedula`,`hoj_celular`, `hoj_licencia`, `hoj_tipolicencia`,`hoj_tipovivienda`, `hoj_arrendador`, `hoj_direccion`, `hoj_telefono`,  `hoj_conyuge`, `hoj_profesion`, `hoj_celularconyuge`, '1','2','3', '4',  `hoj_eps`, `hoj_fechaeps`, `hoj_arl`, `hoj_fechaafi`, `hoj_pension`, `hoj_fechapen`,`hoj_cajacompensacion`,`hoj_fechacaja`,`hoj_fechacontrato`, `hoj_tipocontrato`,`hoj_fechatermino`, `hoj_entregapuesto`, `hoj_pazysalvo`,hoj_estado,hoj_cargo,`hoj_area`,`hoj_salario`,`hoj_turnos`,`hoj_horario`,`hoj_estaproceso`,`hoj_foto`,`hoj_hvdigital`,`hoj_fotocedula` FROM `hojadevida` where idhojadevida='$idhojadevida'";	


   $sql="SELECT  `id`, `documento`, `nombre_completo`, `ext` FROM `usuarios_huella` where id='".$id_param."'  ORDER BY  id ";
	
	$DB1->Execute($sql);
	$rw=mysqli_fetch_row($DB1->Consulta_ID);
	$id_sedes=$rw[2];

	 $sql2="SELECT  `idcargo`, `car_Cargo`, `car_Salario`, `car_Auxilio`, `car_otros` FROM `cargo` WHERE idcargo='$rw[35]'";		
	$DB->Execute($sql2);
	$cargosaldo=mysqli_fetch_row($DB->Consulta_ID);
	 $cargosaldo[1];
	
// echo '<tr><td>
// <div class="btn-group">';
//   echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datospersonales&idhojadevida=$idhojadevida'\" >Datos Personales</button>";

//    echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datoslaborales&idhojadevida=$idhojadevida'\" >Referencias Laboral</button>";

//     echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=examenesmedicos&idhojadevida=$idhojadevida'\" >Examenes medicos ocupacionales y epidemiologicos</button>";

//   echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datoscontrato&idhojadevida=$idhojadevida'\" >Contrato</button>";

   

//      echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datosfamiliares&idhojadevida=$idhojadevida'\" >Datos Familiares</button>";

//      echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datosconyuge&idhojadevida=$idhojadevida'\" >Conyuge</button>";

//      echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=saludafiliaciones&idhojadevida=$idhojadevida'\" >Beneficiarios y personal a cargo</button>";

//  echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datosestudios&idhojadevida=$idhojadevida'\" >Estudio/Cursos</button>";

//   echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datosvivienda&idhojadevida=$idhojadevida'\" >Vivienda</button>";

//   echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=datosvehiculo&idhojadevida=$idhojadevida'\" >Vehiculo</button>";

 
//   echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=dotacion&idhojadevida=$idhojadevida'\" >Dotacion y Elementos de Trabajo.</button>";

//   echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=Incapacidades&idhojadevida=$idhojadevida'\" >Novedades</button>";

//   echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=memorandos&idhojadevida=$idhojadevida'\" >Memorandos</button>";

//   echo "<button type='button' class='btn btn-primary'  onclick=\"window.location='new_hojadevida.php?condecion=terminacioncontrato&idhojadevida=$idhojadevida'\" >Terminacion Contracto</button>";
//  echo '
// </div>
// <tr><td>';


$sles="SELECT doc_ruta FROM documentos WHERE doc_tabla='hojadevida' AND doc_idviene='$rw[0]' and doc_version=1 ORDER BY doc_fecha DESC ";
$DB1->Execute($sles); 
$rutafoto=$DB1->recogedato(0);

$id_p=$rw[0];


//echo $LT->llenadocs3($DB1, "referenciasfamiliares",$id_p, 1, 35, 'Ver');
} 


//echo "wwwwwwwwwwwww".$rw[2];
$FB->abre_form("form","guardareditaruserhuella.php","post");

$FB->titulo_azul1("Editar datos Huella",10,0, 7);  


// switch ($condecion)
// {

// case "datospersonales":


	
// $FB->titulo_azul1("Datos Personales",10,0, 5);  
// if($rutafoto!=''){

// 	$edad=edad($rw[5]);

// 	echo "<tr><td><img src='imghojadevida/fotos/$rw[41]' class='img-circle' alt='User Image' style='background-color:#FF0000;width:80px;height:80px' /><td>
// 	<td>
// 	Nombre: $rw[3]". "<br>".
// 	"Edad: $edad
// 	</td>
// 	</tr>";

// }

$FB->llena_texto("Nombre:",2, 1, $DB, "", "", "$rw[2]", 1, 1);
$FB->llena_texto("Cedula:",5, 1, $DB, "", "", "$rw[1]", 1, 1);
$FB->llena_texto("Foto:", 101, 6, $DB, "", "", "",1, 0);
echo "<tr><td>Foto </td><td><a href='huella/imagenes/".$rw[3]."' target='_blank'>Ver</a>";
// echo "<td>Hoja de vida </td><td><a href='imghojadevida/hojadevidadigi/".$rw[42]."' target='_blank'>Ver</a></td></tr>";
if($rw[1]>0 and $nivel_acceso!=1){ $habi=2; }else{ $habi=1;}

// $FB->llena_texto("Fecha de ingreso:", 1, 10, $DB, "", "", "$rw[1]", 17,$habi);
// $FB->llena_texto("Nombre:",2, 1, $DB, "", "", "$rw[3]", 4, 1);
// $FB->llena_texto("Apellido:",3, 1, $DB, "", "", "$rw[4]", 1, 1);
// $FB->llena_texto("Fecha de nacimiento:", 4, 10, $DB, "", "", "$rw[5]", 4, 1);
// $FB->llena_texto("Cedula:",5, 1, $DB, "", "", "$rw[6]", 17, 1);
// $FB->llena_texto("Foto Cedula:", 103, 6, $DB, "", "", "",4, 0);
// $FB->llena_texto("Cargo:",35,2,$DB,"(SELECT `idcargo`, `car_Cargo` FROM `cargo`)", "", "$cargosaldo[0]", 1, 1);
// echo "<td>Foto Cedula</td><td><a href='imghojadevida/fotos/".$rw[43]."' target='_blank'>Ver</a></td></tr>";
// $FB->llena_texto("Celular:", 6, 1, $DB, "", "", "$rw[7]", 1, 0);
// $FB->llena_texto("Sede Trabajo:",7,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0)", "", "$id_sedes", 4, 1);
// $FB->llena_texto("Libreta Militar:", 108, 6, $DB, "", "", "",1, 0);
// echo $LT->llenadocs3($DB1, "hojadevida",$id_p, 8, 35, 'Descargar');
// $FB->llena_texto("Estado proceso:", 51, 82, $DB, $estadoproceso, "", "$rw[40]", 1, 1);
$caso='datoslaborales';



$FB->cierra_tabla(); 			
// break;
// case "datoscontrato":
// 	$FB->llena_texto("Tipo Contrato:", 39, 82, $DB, $tipocontrato, "", "$rw[30]", 1, 1);
// 	$FB->llena_texto("Foto Contrato:", 109, 6, $DB, "", "", "",4, 0);
// 	$FB->llena_texto("Area:", 41, 82, $DB, $area, "", "$rw[36]", 1, 1);
// 	echo "<td>Foto Contrato</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 9, 35, 'Ver')."</tr>";
// 	// $FB->llena_texto("Foto Pagare:", 105, 6, $DB, "", "", "",1, 0);
// 	$FB->llena_texto("Foto Funciones:", 110, 6, $DB, "", "", "",4, 0);
// 	// echo "<tr><td>Foto Pagare</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 5, 35, 'Ver');
// 	echo "<td>Foto  Funciones</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 10, 35, 'Ver')."</tr>";
// 	$FB->llena_texto("Fecha Inicio:",40, 10, $DB, "", "", "$rw[29]", 1, 1);
// 	$FB->llena_texto("Salario:",42, 118, $DB, "", "", "$cargosaldo[2]", 4, 2);
// 	$FB->llena_texto("AUXILIO:",42, 118, $DB, "", "", "$cargosaldo[3]", 17, 2);
// 	$FB->llena_texto("INGRESOS NO CONSTITUYENTES:",42, 118, $DB, "", "", "$cargosaldo[4]", 4, 2);
// 	$FB->llena_texto("Turnos de Trabajo:", 43, 82, $DB, $turnostrabajo, "", "$rw[38]", 1, 1);
// 	$FB->llena_texto("Foto Turnos:", 111, 6, $DB, "", "", "",4, 0);
// 	echo "<tr><td></td><td></td><td>Foto Turnos</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 11, 35, 'Ver');
// 	$FB->llena_texto("Horario:",50,2,$DB,"(SELECT `id_horarios`,`hora_descripcion` FROM horarios)", "", "$rw[39]", 1, 0);
// 	$caso='datosvehiculo';
// break;
// case "datosvehiculo":


// 	 $sql2="SELECT idusuarios,usu_nombre,preestado,prefechaingreso,idpreoperacinal,usu_tipocontrato,prevehiculo, concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as vehiculo,prefechaingreso FROM `pre-operacional` inner join usuarios on idusuarios=preidusuario inner join vehiculos on usu_vehiculo=idvehiculos WHERE usu_identificacion='$rw[6]' order by prefechaingreso limit 1";		
// 	$DB->Execute($sql2);
// 	$vehiculo=mysqli_fetch_row($DB->Consulta_ID);

// $FB->titulo_azul1("Datos del Vehiculo",10,0, 5);  
// $FB->llena_texto("Licencia de Conducir N:",10, 1, $DB, "", "", "$rw[8]", 1, 0);
// $FB->llena_texto("Tipo licencia:", 9, 82, $DB, $tipolicencia, "", "$rw[9]", 4, 0);
// $FB->llena_texto("Foto Licencia:", 104, 6, $DB, "", "", "",1, 0);
// echo "<td>Foto Licencia</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 4, 35, 'Ver');
// echo "</tr>";
// $FB->llena_texto("Imagen del Estado de la Vehiculo:", 106, 6, $DB, "", "", "",1, 0);
// $FB->llena_texto("Imagen de los documentos de la Vehiculo:", 107, 6, $DB, "", "", "",4, 0);
// echo "<tr><td>Imagen Vehiculo</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 6, 35, 'Ver');
// echo "<td>Imagen de los documentos de la Vehiculo</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 7, 35, 'Ver')."</tr>";
// if($vehiculo[0]>=1){
// 	$fecha=substr($vehiculo[8], 0, -9);
// 	echo "<tr><td>Vehiculo</td><td>".$vehiculo[7]."</td>";
// 	echo "<td>ultimo Preoperacional</td>"."<td><a id='link'  onclick='window.open(\"validaoperacional.php?iduser=$vehiculo[0]&fecha=$fecha&idvehiculo=$vehiculo[6]&campo=preencuesta\")';  title='Pre operacional' > Pre-Operacional"."</td></tr>";
// }

// 	include('entregavehiculo.php');

// $caso='datosvivienda';


// $FB->cierra_tabla(); 			
// break;
// case "datosvivienda":
// $FB->titulo_azul1("Datos de la Vivienda",10,0, 5); 
// $FB->llena_texto("Tipo de Vivienda:", 10, 82, $DB, $tipodevivienda, "", "$rw[10]", 1, 1);
// $FB->llena_texto("Nombre de Arrendador:",11, 1, $DB, "", "", "$rw[11]", 4, 1);
// $FB->llena_texto("Direccion:",12, 1, $DB, "", "", "$rw[12]", 1, 1);
// $FB->llena_texto("Tel&eacute;fono:", 13, 1, $DB, "", "", "$rw[13]", 4, 0);
// $FB->llena_texto("Imagen recibo Publico:", 113, 6, $DB, "", "", "",1, 0);
// $FB->llena_texto("Imagen Certificado de arrendamiento:", 114, 6, $DB, "", "", "",4, 0);
// echo "<tr><td>ver Imagen recibo Publico</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 13, 35, 'Ver');
// echo "<td>ver Imagen Certificado de arrendamiento</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 14, 35, 'Ver')."</tr>";

// $caso='datosconyuge';
// $FB->cierra_tabla(); 			
// break;
// case "datosconyuge":

// $FB->titulo_azul1("Datos del conyuge",10,0, 5); 
// $FB->llena_texto("Nombre de Esposa(o):",14, 1, $DB, "", "", "$rw[14]", 17, 1);
// $FB->llena_texto("Profesi&oacute;n, ocupaci&oacute;n u oficio:", 15, 1, $DB, "", "", "$rw[15]", 4, 0);
// $FB->llena_texto("Celular:",16, 1, $DB, "", "", "$rw[16]", 1, 1);
// $FB->llena_texto("Estado civil:", 17, 82, $DB, $estadocivil, "", "$rw[10]", 4, 1);

// $FB->cierra_tabla(); 	
// $caso='datosfamiliares';		
// break;
// case "datosfamiliares":

// include('referenciasfami.php');

// $FB->cierra_tabla(); 		
// $caso='datosestudios';		
// break;
// case "datosestudios":
// /* $FB->titulo_azul1("Estudios ",10,0, 5); 
// $FB->llena_texto("Tipo de Estudio:", 23, 82, $DB, $nivelaca, "", "$rw[17]", 17, 1);
// $FB->llena_texto("Institucion:",24, 1, $DB, "", "", "$rw[18]", 4, 1);
// $FB->llena_texto("Ciudad:",25, 1, $DB, "", "", "$rw[19]", 1, 1);
// $FB->llena_texto("Fecha Graduacion:",26, 10, $DB, "", "", "$rw[20]", 4, 1); */

// include('referenciasestudio.php');
// $FB->cierra_tabla(); 		
// $caso='datossalud';		

// break;
// case "datossalud":

// 	include('seguridadsocial.php');
// /* $FB->titulo_azul1("Salud ",10,0, 5); 
// $FB->llena_texto("EPS:",27, 1, $DB, "", "", "$rw[21]", 17, 1);
// $FB->llena_texto("Fecha de Afiliaci&oacute;n:", 28, 10, $DB, "", "", "$rw[22]", 4, 0);
// $FB->llena_texto("ARL:",29, 1, $DB, "", "", "$rw[23]", 1, 1);
// $FB->llena_texto("Fecha de Afiliaci&oacute;n:", 30, 10, $DB, "", "", "$rw[24]", 4, 0);
// $FB->llena_texto("Pension:",31, 1, $DB, "", ""," $rw[25]", 1, 1);
// $FB->llena_texto("Fecha de Afiliaci&oacute;n:", 32, 10, $DB, "", "", "$rw[26]", 4, 0);
// $FB->llena_texto("Caja de compensacion:",37, 1, $DB, "", "", "$rw[27]", 1, 1);
// $FB->llena_texto("Fecha de Afiliaci&oacute;n:", 38, 10, $DB, "", "", "$rw[28]", 4, 0);
// //$FB->llena_texto("Examenes Medicos:", 109, 6, $DB, "", "", "",1, 0);
// echo $LT->llenadocs3($DB1, "hojadevida",$id_p, 9, 35, 'Ver'); 
// $FB->cierra_tabla(); 	*/		
// break;
// case "saludafiliaciones":
// 	include('afiliacionessalud.php');
// break;
// case "examenesmedicos":
// 	include('examenesmedicos.php');
// break;
// case "datoslaborales":
// 	include('afiliacionempresa.php');
// break;
// case "dotacion":
// 	include('dotacion.php');
// break;
// case "Incapacidades":
// 	require_once('incapacidades.php');


// break;
// case "memorandos":
// 	require_once('memorandos.php');
// break;

// case "terminacioncontrato":
// 	include('terminacioncontrato.php');
// break;
// }

echo '
<input type="hidden" name="id_param" id="id_param" value="'.$id_param.'">';
// <input type="hidden" name="id_param0" id="id_param0" value="'.$rw[0].'">
// <input type="hidden" name="accion" id="accion" value="'.$accion.'">
// <input type="hidden" name="condecion" id="condecion" value="'.$condecion.'">
// <input type="hidden" name="idhojadevida" id="idhojadevida" value="'.$idhojadevida.'">
// </table>';
// echo '</div>';


	echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'>
			
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit'  name='enviar' value='Editar' style='width:190px;' >
 	<span class='spinner-border' role='status' aria-hidden='true'></span>
	</td></tr>";

// 	echo '<div class="preloader-wrapper big active">
// 	<div class="spinner-layer spinner-red-only">
// 	  <div class="circle-clipper left">
// 		<div class="circle"></div>
// 	  </div>
// 	  <div class="gap-patch">
// 		<div class="circle"></div>
// 	  </div>
// 	  <div class="circle-clipper right">
// 		<div class="circle"></div>
// 	  </div>
// 	</div>
//   </div>';

include("footer.php");
?>
