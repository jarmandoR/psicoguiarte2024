<?php 
require("login_autentica.php"); 
include("layout.php");

$FB->titulo_azul1("Historias clinicas",9,0,5);  
$FB->abre_form("form1","historiasClinicas.php","post");
$FB->nuevo7("new_hojadevida.php?condecion=datospersonales&accion=1");

if($param5!=''){  $conde2="and hoj_sede=$param5"; }  else { $conde2=""; }
$FB->llena_texto("Sede :",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$param1", 1, 0);
$FB->llena_texto("Empresa:",2,2,$DB,"SELECT `empre_id`, `empre_nombre` FROM `empresa`", "cambioo(this.value)","$param2", 4, 0);

$FB->llena_texto("Paciente:",3,1, $DB, "", "", $param3, 1, 0);

// $FB->llena_texto("...:",3,82,$DB,$busqueda4,"",$param3,4,0);
// $FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);
// $FB->llena_texto("Estado:",4,82,$DB,$estadosac2,"",$param4,1,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 

$conde1=""; 

if($param1!="" ){ 

	$conde1="and idsedes='$param1'"; 
}else {
	$conde1=""; } 


if($param2!=''){
	  $cond2="and usu_idempresa='".$param2."'";
	  
}

if($param3!=''){
	$cond3=" and hoj_nombre like '%$param3%'";
}

 $sql="SELECT COUNT(*) FROM `hojadevida` inner join sedes on hoj_sede=idsedes $conde1 $conde2 $cond5 $cond3";
$DB->Execute($sql); 
$valor=$DB->recogedato(0);
if(isset($_REQUEST["CantidadMostrar"])){ $CantidadMostrar=$_REQUEST["CantidadMostrar"]; } else { $CantidadMostrar=50; } 

$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
$TotalRegistro  =ceil($valor/$CantidadMostrar);




if(isset($_REQUEST["ordby"])){ $ordby=$_REQUEST["ordby"]; } else { $ordby="hoj_nombre,hoj_apellido"; } 
if(@$_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } 	$asc2=""; if($asc=="ASC"){ $asc2="DESC";}


$FB->titulo_azul1("#",1,0,7); 
$FB->titulo_azul1("Fecha Ingreso",1,0,0); 
$FB->titulo_azul1("Sede",1,0,0); 
$FB->titulo_azul1("Nombres",1,0,0); 
$FB->titulo_azul1("Apellidos ",1,0,0); 
$FB->titulo_azul1("Fecha Primer ",1,0,0); 
$FB->titulo_azul1("Cedula ",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0);
$FB->titulo_azul1("Telefono",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Reporte",1,0,0); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);



   $sql="SELECT  `idhojadevida`, `hoj_fechaingreso`, `sed_nombre`, `hoj_nombre`, `hoj_apellido`,
    `hoj_fechanacimiento`, `hoj_cedula`,`hoj_direccion`, `hoj_celular`,`hoj_tipoIden`, `hoj_celular`,
    `hoj_estado` FROM `hojadevida` inner join sedes on hoj_sede=idsedes inner join usuarios on hoj_cedula=usu_identificacion   where idhojadevida>0  $conde1 $cond2 $cond3 ORDER BY  hoj_nombre asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;

$DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$aux="candidato";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($rw1[23]==$aux){$color="#F7DC6F";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[5]=str_replace("&"," ", $rw1[5]);
		$rw1[7]=@$clasificacion[$rw1[7]];
		echo "<td>".$va."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[8]."</td>
		";
	
		echo "<td><div id='inactivo$va'>"; 
		echo "<select name='param11' id='param11' class='form-control' onChange='cambio_ajax2(this.value,79, \"inactivo$va\", \"$va\", 1, $id_p)' required>";		
			
		$LT->llenaselect_ar22($rw1[22],$estadosac);
			echo "</select></div></td>";
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"Descargar reporte\",\"$rw1[1]\")';  title='Ingreso de Usuario' >Descargar</td>";

		 $DB1->editar("new_hojadevida.php",$id_p, "hojadevida", 1,'datospersonales');
	}

 //Operacion matematica para boton siguiente y atras 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
 // onchange=location.href='http://www.dominio/pagina.php?ref='+this.value
 $selec200="";
 $selec50="";
 $selec100="";
 $selec10000="";
 if($CantidadMostrar==50){ $selec50="Selected";} else if($CantidadMostrar==100){ $selec100="Selected";} else if($CantidadMostrar==200){ $selec100="Selected";} else if($CantidadMostrar==10000){ $selec10000="Selected";}
	echo "<section class='paginacion'><ul ><li>Mostrar <select onchange=location.href=\"?CantidadMostrar=\"+this.value ><option value='50' $selec50 >50</option><option value='100' $selec100>100</option><option value='200' $selec200>200</option><option value='10000' $selec10000>Todos..</option></select></li><li><a>Total Registros: $valor </a></li><li ><a href=\"?pag=".$DecrementNum."\" >&#171;&#171;</a></li>";
    //Se resta y suma con el numero de pag actual con el cantidad de 
    //numeros  a mostrar
     $Desde=$compag-(ceil($CantidadMostrar/2)-1);
     $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
     //Se valida
     $Desde=($Desde<1)?1: $Desde;
     $Hasta=(($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta)/10;
     //Se muestra los numeros de paginas
     for($i=$Desde; $i<=$Hasta;$i++){
     	//Se valida la paginacion total
     	//de registros
     	if($i<=$TotalRegistro){
     		//Validamos la pag activo
     	  if($i==$compag){

           echo "<li><a href=\"?pag=".$i."\" class=\"active\">".$i."</a></li>";

     	  }else {

     	  	echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";

     	  }     		

     	}

     }

	echo "<li class=\"active\"><a href=\"?pag=".$IncrimentNum."\">&#187;&#187;</a></li></ul>";



include("footer.php");

?>