<?php 
require("login_autentica.php"); 
include("layout.php");

$FB->titulo_azul1("Valoracion Inicial",9,0,5);  
$FB->abre_form("form1","parejas.php","post");
$FB->nuevo7("terapiaOcupacion.php?condecion=datosocupacional&accion=1");

if($param5!=''){  $conde2="and hoj_sede=$param5"; }  else { $conde2=""; }
$FB->llena_texto("Sede :",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$param5", 17, 0);
$FB->llena_texto("Paciente:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) and roles_idroles=28 $conde2", "", $param2, 4, 0);
$FB->llena_texto("Informe ICBF:",1,82,$DB,$tipocontrato,"",$param1,17,0);

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 

// $conde1=""; 

//   if($param2!="" ){ 
// //    $conde1="and $param3 like '%$param2%' "; 
// $conde1="  "; 
// 	}else { $conde1="  "; } 


//   if($param4!='0' and $param4!=''){
// 	  $cond5=" and hoj_estado='$param4'";
//   }

//   if($param1!='0' and $param1!=''){
// 	$cond3=" and hoj_tipocontrato='$param1'";
// }

// echo $sql="SELECT COUNT(*) FROM `hojadevida` inner join sedes on hoj_sede=idsedes $conde1 $conde2 $cond5 $cond3";
// $DB->Execute($sql); 
// $valor=$DB->recogedato(0);
// if(isset($_REQUEST["CantidadMostrar"])){ $CantidadMostrar=$_REQUEST["CantidadMostrar"]; } else { $CantidadMostrar=50; } 
// //$CantidadMostrar=5;
// $compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
// $TotalRegistro  =ceil($valor/$CantidadMostrar);

// //echo "<tr class='text'><td align='left'><b>Total Registros: $valor</b></td><td width='100px'  class='text'><b></td><td></tr> ";



// if(isset($_REQUEST["ordby"])){ $ordby=$_REQUEST["ordby"]; } else { $ordby="hoj_nombre,hoj_apellido"; } 
// if(@$_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } 	$asc2=""; if($asc=="ASC"){ $asc2="DESC";}
// //$condlimit=$FB->llena_sigant($pagina, $ordby, $asc, $valor); 


$FB->titulo_azul1("#",1,0,5); 
// $FB->titulo_azul1("Fecha Ingreso",1,0,0); 
// $FB->titulo_azul1("Sede",1,0,0); 
$FB->titulo_azul1("Nombre",1,0,0); 
$FB->titulo_azul1("Fecha ",1,0,0); 
// $FB->titulo_azul1("Fecha Primer ",1,0,0); 
// $FB->titulo_azul1("Cedula ",1,0,0); 
// $FB->titulo_azul1("Direcci&oacute;n",1,0,0);
// $FB->titulo_azul1("Telefono",1,0,0); 
//$FB->titulo_azul1("Memorandos.",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 

$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);


//    echo $sql="SELECT  `idPareja`, `hoj_fechaingreso`, `nombrePareja1`, `nombrePareja2` FROM `historiaPareja` inner join sedes on hoj_sede=idsedes   where idPareja>0  $conde1 $conde2 $cond5 $cond3 ORDER BY  nombrePareja1 asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;

 $sql="SELECT idterocu, teOcu_param1, teOcu_param9 FROM `terapiaOcupacional` ORDER BY idterocu";


$DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
			
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		
		echo "
		<td>".$rw1[0]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>";

// 		// <td>".$rw1[3]."</td>
// 		// <td>".$rw1[4]."</td>
// 		// <td>".$rw1[5]."</td>
// 		// <td>".$rw1[6]."</td>
// 		// <td>".$rw1[7]."</td>
// 		// <td>".$rw1[8]."</td>	
		

// 	//	echo "<td>"."Pendiente"."</td>";
	
		
		echo "<td><div id='inactivo$va'>"; 
		echo "<select name='param11' id='param11' class='form-control' onChange='cambio_ajax2(this.value,79, \"inactivo$va\", \"$va\", 1, $id_p)' required>";		
			
		$LT->llenaselect_ar22($rw1[22],$estadosac);
			echo "</select></div></td>";

		 $DB1->editar("terapiaOcupacion.php",$id_p, "historiaValoracion", 1,'datosocupacional');
	}




include("footer.php");

?>