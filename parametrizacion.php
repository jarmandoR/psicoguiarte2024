<style>

input[type=text],[type=file]{
	margin:20px 20px 0 0;
	width:230px;
	height:35px;
	font: 14px normal normal uppercase helvetica, arial, serif;  
}

textarea{
	width: 250px;
	height: 120px;
	font: 14px normal normal uppercase helvetica, arial, serif;
}
textarea[titulo]{
	width: 250px;
	height: 50px;
	font: 14px normal normal uppercase helvetica, arial, serif;
}

button{
	position:relative;
	width:100px;
	height:40px;
	border-radius:10px;
	margin-left: 0px;
	border:0px;
	color:white;
	background-color:#d90404;
	font: 14px normal normal uppercase helvetica, arial, serif;
}

p{
	text-shadow:0 1px 0 #fff;
	font-size:24px;
}

label{
	margin:25px 20px 0 0;
	font-size:16 px;
	color:black;
	text-transform: uppercase;
	text-shadow:0px 1px 0px #fff;
}



</style>


<script src="confi_inicio.js" type="text/javascript"></script>
<?php
require("login_autentica.php"); 
include("layout.php");


$nivel_acceso=$_SESSION['usuario_rol'];
$id_usuario=$_SESSION['usuario_id'];


$FB->titulo_azul1("Paramtros variables",9,0,5);  
$FB->abre_form("form1","hojadevida.php","post");
// $FB->nuevo7("new_hojadevida.php?condecion=datospersonales&accion=1");

	if($param5!=''){  $conde2="and hoj_sede=$param5"; }  else { $conde2=""; }
// $FB->llena_texto("Sede :",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$param5", 17, 0);
// $FB->llena_texto("Contrato:",1,82,$DB,$tipocontrato,"",$param1,4,0);
// $FB->llena_texto("Busqueda por:",3,82,$DB,$busqueda4,"",$param3,17,0);
// $FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);
// $FB->llena_texto("Estado:",4,82,$DB,$estadosac2,"",$param4,1,0);
// $FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
// $FB->cierra_form(); 

$conde1=""; 

  if($param2!="" and $param3!=""){ 
   $conde1="and $param3 like '%$param2%' "; 
	}else { $conde1="  "; } 


  if($param4!='0' and $param4!=''){
	  $cond5=" and hoj_estado='$param4'";
  }

  if($param1!='0' and $param1!=''){
	$cond3=" and hoj_tipocontrato='$param1'";
}

 $sql="SELECT COUNT(*) FROM `parame_id`, `parme_nombre`, `parme_valor` FROM `parametrizables` WHERE 1";
$DB->Execute($sql); 
$valor=$DB->recogedato(0);
if(isset($_REQUEST["CantidadMostrar"])){ $CantidadMostrar=$_REQUEST["CantidadMostrar"]; } else { $CantidadMostrar=50; } 
//$CantidadMostrar=5;
$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
$TotalRegistro  =ceil($valor/$CantidadMostrar);

//echo "<tr class='text'><td align='left'><b>Total Registros: $valor</b></td><td width='100px'  class='text'><b></td><td></tr> ";



if(isset($_REQUEST["ordby"])){ $ordby=$_REQUEST["ordby"]; } else { $ordby="hoj_nombre,hoj_apellido"; } 
if(@$_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } 	$asc2=""; if($asc=="ASC"){ $asc2="DESC";}
//$condlimit=$FB->llena_sigant($pagina, $ordby, $asc, $valor); 


$FB->titulo_azul1("#",1,0,7); 
$FB->titulo_azul1("Nombre",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
// $FB->titulo_azul1("Nombres",1,0,0); 
// $FB->titulo_azul1("Apellidos ",1,0,0); 
// $FB->titulo_azul1("Fecha Nacimiento ",1,0,0); 
// $FB->titulo_azul1("Cedula ",1,0,0); 
// $FB->titulo_azul1("Direcci&oacute;n",1,0,0);
// $FB->titulo_azul1("Telefono",1,0,0); 
// //$FB->titulo_azul1("Memorandos.",1,0,0); 
// $FB->titulo_azul1("Estado",1,0,0); 

$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);


   $sql="SELECT `parame_id`, `parme_nombre`, `parme_valor` FROM `parametrizables` WHERE 1";

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
		echo "
		<td>".$rw1[0]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
	
		";

	//	echo "<td>"."Pendiente"."</td>";
	
		
		// echo "<td><div id='inactivo$va'>"; 
		// echo "<select name='param11' id='param11' class='form-control' onChange='cambio_ajax2(this.value,79, \"inactivo$va\", \"$va\", 1, $id_p)' required>";		
			
		// $LT->llenaselect_ar22($rw1[22],$estadosac);
		// 	echo "</select></div></td>";

		if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==16 or $nivel_acceso==15 or $nivel_acceso==13){
			$DB->edites($id_p, "parametrizacion", 1, $condecion);
		//$DB->edites($id_p, "asignardinero", 1, $condecion);
		}
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







































































// if(isset($_REQUEST["param1"])){ if($param1!=""){  $conde1="and (gas_idciudadori='$param1' or gas_idciudaddes='$param1') ";  $id_sedes=$param1; } } 
// else {$param1="";  
// 	if($nivel_acceso==1){
// 		$conde1="";
// 	}else{
// 		$conde1="and (gas_idciudadori='$id_sedes' or gas_idciudaddes='$id_sedes') "; 

// 	}

// }
// $conde3='';
// if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.=" and asi_idpromotor='$param2'"; } } else {$param2="";  }
// if($param4!=''){ $conde1.="and date(gas_fecharegistro)>='$param5' and date(gas_fecharegistro)<='$param4'";  $fechaactual=$param4;    $fechainicio=$param5;    } 
// else { $conde1.=" and date(gas_fecharegistro)>='$fechainicio' and date(gas_fecharegistro)<='$fechaactual'";  }

// if(isset($_REQUEST["param3"]) and $_REQUEST["param3"]>0){ 

// 	if($param3=="1" or $param3==""){
// 		$conde3="and gas_usucom='' and gas_cantcom='' ";
// 	}elseif($param3=="2")
// 	{
// 		$conde3="and gas_usucom!='' and gas_cantcom!='' and gas_iduserrecoge<=0 ";
// 	}elseif($param3=="3")
// 	{
// 		$conde3="and gas_iduserrecoge>0  and gas_recogio<=0";

// 	}elseif($param3=="4")
// 	{
// 		$conde3="and gas_iduserrecoge>0  and gas_recogio=1";
// 	}elseif($param3=="5")
// 	{
// 		$conde3="and gas_usucom!='' and gas_iduserrecoge>0  and gas_recogio=2";
// 	}
// 	elseif($param3=="6")
// 	{
// 		$conde3="and gas_usucom!='' and gas_iduserrecoge>0  and gas_recogio=1 and gas_nomvalida!=''";
// 	}
	
// }else{
// 	$conde3="and gas_usucom='' and gas_cantcom='' ";
// }




// $FB->titulo_azul1("Modificacion de contenido",15,0,7);

		

// // $FB->llena_texto("Nombre Archivo:", 16, 82, $DB, $nombrearchivo, "", "", 2, 1);
// // $FB->llena_texto("Editar imagen #1  ", 8, 6, $DB, "", "", "",1,0);
	

// 	// $FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$fechaactual", 2, 1);
// 	// $FB->llena_texto("Proveedor:", 9, 82, $DB, $tiporeclamo, "", "", 2, 1);
// 	// echo "<td><button type='submit' class='btn btn-primary btn-lg'>Cagar Imagen </button></td>";
// 	echo'<a href="inicio.php" class="btn btn-light">Regresar</a>';
// 	// $FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "", 1, 1);
// 	// $FB->llena_texto("telefono:", 5, 1, $DB, "", "", "", 1, 1);
// 	// $FB->llena_texto("E-mail:", 6, 111, $DB, "", "", "", 1, 1);
// 	// $FB->llena_texto("Ciudad donde quiere recibir la notificacion:", 1, 1, $DB, "", "", "", 1, 1);
// 	// $FB->llena_texto("Direccion donde quiere recibir la notificacion:",9, 1, $DB, "", "", "", 1, 1);
// 	// $FB->llena_texto("Descripcion de Reclamo:<br> Por favor coloque una descripcion <br>del paquete y su contenido", 7,9, $DB, "", "", "", 2, 1);
// 	// $FB->llena_texto("Numero De Guia Completo<br> lo encontrara en la parte superior del recibo",2, 1, $DB, "", "", "",2,1);
// 	// $FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);



// 			// echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(29);'  >Validar Guia </button></td></tr>";	
//    //          $FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);

	

// 	// $FB->llena_texto("param10", 1, 13, $DB, "", "0", 0, 5, 0);	

// // echo'<div class="div-1"> <h3 ><center><a> Modificacion de Archivos </a></center></H3></div>';

// // if(isset($_POST['mensaje'])){ 

// //     $mensaje1 = $_POST["mensaje"]; 
// //     $img = $_POST["imagen"];
// //     echo'ok'.$titulo = $_POST["titulo"];
// //     $id = $_POST["id"];
// //     echo 'holi perra';



// if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
// 		if ($_FILES['imagen']['type']=='image/png' || $_FILES['imagen']['type']=='image/jpeg'){

// 			move_uploaded_file($_FILES["imagen"]["tmp_name"],"./confi_imagen/".$_FILES["imagen"]["name"]);

// 		// $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";
// 			$imagen = $_FILES["imagen"]["name"]; 

// 	}else{

// echo$sql15="SELECT `img_confi`,`contenido_confi` FROM `confi_inicio` WHERE `id_confi`='$id' ";
// 				$DB->Execute($sql15);
// 				$rw20=mysqli_fetch_row($DB->Consulta_ID);

// 		$imagen = $rw20[0]; 
// 	}

    
// //      if (isset($_POST['titulo'])) {
// //      	  echo $sql="UPDATE `confi_inicio` SET `img_confi`='$imagen',`titulo_confi`='$titulo',`contenido_confi`='$mensaje1' WHERE id_confi='$id'";
// //      $DB->Execute($sql);
// //      }elseif($titulo==''){


// //      	$sql="UPDATE `confi_inicio` SET `img_confi`='$imagen',`contenido_confi`='$mensaje1' WHERE id_confi='$id'";
// //      $DB->Execute($sql);

// //      // }

// // }	
// // if ($sql) {
// // 	echo '<script type="text/javascript">
// // 	confi();
// // 	</script>';
// // }


// }
// $sql5="SELECT `img_confi`,`contenido_confi` FROM `confi_inicio` WHERE `id_confi`='1' ";
// 				$DB->Execute($sql5);
// 				$rw=mysqli_fetch_row($DB->Consulta_ID);
// 				// $nombreuser=$DB->recogedato(1);

// $sql6="SELECT `img_confi`,`contenido_confi` FROM `confi_inicio` WHERE `id_confi`='2' ";
// 				$DB->Execute($sql6);
// 				$rw1=mysqli_fetch_row($DB->Consulta_ID);

// $sql7="SELECT `img_confi`,`contenido_confi` FROM `confi_inicio` WHERE `id_confi`='3' ";
// 				$DB->Execute($sql7);
// 				$rw2=mysqli_fetch_row($DB->Consulta_ID);

// $sql8="SELECT `img_confi`,`contenido_confi`,`titulo_confi` FROM `confi_inicio` WHERE `id_confi`='4' ";
// 				$DB->Execute($sql8);
// 				$rw3=mysqli_fetch_row($DB->Consulta_ID);

// $sql9="SELECT `img_confi`,`contenido_confi`,`titulo_confi` FROM `confi_inicio` WHERE `id_confi`='5' ";
// 				$DB->Execute($sql9);
// 				$rw4=mysqli_fetch_row($DB->Consulta_ID);

// $sql10="SELECT `img_confi`,`contenido_confi`,`titulo_confi` FROM `confi_inicio` WHERE `id_confi`='6' ";
// 				$DB->Execute($sql10);
// 				$rw5=mysqli_fetch_row($DB->Consulta_ID);																

// echo'<div class="form">';

// echo '<form >';
// // echo "<form method='POST' enctype='multipart/form-data' > ";


// echo '<tr><td>				
// 				<label for="nombre">Editar Imagen</label>			
// </td><td>';

// echo'
//         	<picture> <img src="confi_imagen/'.$rw[0].'" alt="test"  width="350px" height="100px" ></picture>
// </td><td>';

// echo'			

//                 <h5>Dimensiones recomendadas 1920 x 650</h5>
//                	<input type ="file" name="imagen" id="imagen" >
//                <br>
				
// 				<br>
// </td><td>';

// echo'

// 				<textarea name="Conteni" placeholder="Modificar Contenido" id="Conteni">'.$rw[1].'</textarea>

// </td><td>';

// echo '<input type ="hidden" name="id" value="1" id="id">';

// echo'
//                <br><br><br>	<br>
						
// 				 <input class="button" onclick="editar()" type="button" value="Guardar" />

				

// </td></form>';

// echo '</tr></div>';

// echo'<div class="form">';


//  echo "<form> ";


// echo '<tr><td>				
// 				<label for="nombre">Editar Imagen</label>			
// </td><td>';

// echo'
//         	<picture> <img src="confi_imagen/'.$rw1[0].'" alt="test"  width="350px" height="100px" ></picture>
// </td><td>';

// echo'			
//             	<h5>Dimensiones recomendadas 1920 x 650</h5>
//             	<input type="file" name="imagen1" id="imagen1" >
// 				<br>
				
				
// </td><td>';

// echo'
// 				<textarea name="Conteni" id="Conteni1" placeholder="Modificar Conteni">'.$rw1[1].'</textarea>

// </td><td>';
// echo '<input type ="hidden" name="id" id="id1" value="2">';
// echo'
//                <br><br><br>	<br>
// 				<input class="button" onclick="editar1()" type="button" value="Guardar" />

// </td></form>';

// echo '</tr></div>';

// echo'<div class="form">';


//  echo "<form  > ";


// echo '<tr><td>				
// 				<label for="nombre">Editar Imagen</label>			
// </td><td>';

// echo'
//         	<picture> <img src="confi_imagen/'.$rw2[0].'" alt="test"  width="350px" height="100px" ></picture>
// </td><td>';

// echo'			
//             	<h5>Dimensiones recomendadas 1920 x 650</h5>
//             	<input type="file" name="imagen2" id="imagen2">
// 				<br>
				
// </td><td>';

// echo'
// 				<textarea name="Conteni" id= "Conteni2" placeholder="Modificar Conteni" >'.$rw2[1].'</textarea>

// </td><td>';
// echo '<input type ="hidden" name="id" id="id2" value="3">';
// echo'
//                <br><br><br>	<br>
// 			<input class="button" onclick="editar2()" type="button" value="Guardar" />

// </td></form>';

// echo '</tr></div>';



		
// $FB->titulo_azul1("Modificacion de contenido noticias",15,0,7);


// echo'<div class="form">';
//  echo "<form > ";

//  // echo '<form action="guardar.php" method="POST">';


// echo '<tr><td>				
// 				<label for="nombre">Editar Imagen</label>			
// </td><td>';

// echo'
//         	<picture> <img src="confi_imagen/'.$rw3[0].'" alt="test"  width="350px" height="100px" ></picture>
// </td><td>';

// echo'			
//             	<h5>Dimensiones recomendadas 298 x 169</h5>
//             	<input type="file" name="imagen" id="imagen3">
// 				<br>
				
// </td><td>';

// echo'
//                 <textarea = titulo name="titulo" id="titu3" placeholder="Modificar Titulo" >'.$rw3[2].'</textarea>
//                 <br>
//                 <br>
// 				<textarea name="Conteni" id= "Conteni3" placeholder="Modificar Conteni">'.$rw3[1].'</textarea>
// 				<h5>Carga el documento</h5>
// 				<input type="file" name="docum3" id="docum3">


// </td><td>';
// echo '<input type ="hidden" name="id" id="id3" value="4">';
// echo'
//                <br><br><br>	<br>
// 				<input class="button" onclick="editar3()" type="button" value="Guardar" />
// </td></form>';

// echo '</tr></div>';

// echo'<div class="form">';


//  echo "<form > ";


// echo '<tr><td>				
// 				<label for="nombre">Editar Imagen</label>			
// </td><td>';

// echo'
//         	<picture> <img src="confi_imagen/'.$rw4[0].'" alt="test"  width="350px" height="100px" ></picture>
// </td><td>';

// echo'			
//             	<h5>Dimensiones recomendadas 298 x 169</h5>
//             	<input type="file" name="imagen" id="imagen4">
// 				<br>
				
// </td><td>';

// echo'
//                 <textarea = titulo name="titulo" id="titu4" placeholder="Modificar Titulo" >'.$rw4[2].'</textarea>
//                 <br>
//                 <br>
// 				<textarea name="Conteni" id= "Conteni4" placeholder="Modificar Conteni">'.$rw4[1].'</textarea>

// 				<h5>Carga el documento</h5>
// 				<input type="file" name="docum2" id="docum2">

// </td><td>';
// echo '<input type ="hidden" name="id"  id="id4" value="5">';
// echo'
//                <br><br><br>	<br>
// 				<input class="button" onclick="editar6()" type="button" value="Guardar" />

// </td></form>';

// echo '</tr></div>';


// echo'<div class="form">';


// echo "<form  > ";


// echo '<tr><td>				
// 				<label for="nombre">Editar Imagen</label>			
// </td><td>';

// echo'
//         	<picture> <img src="confi_imagen/'.$rw5[0].'" alt="test"  width="350px" height="100px" ></picture>
// </td><td>';

// echo'			
//             	<h5>Dimensiones recomendadas 298 x 169</h5>
//             	<input type="file" name="imagen" id="imagen5">
// 				<br>
				
// </td><td>';

// echo'
//                 <textarea = titulo name="titu5" id="titu5" placeholder="Modificar Titulo">'.$rw5[2].'</textarea>
//                 <br>
//                 <br>
// 				<textarea name="Conteni" id= "Conteni5" placeholder="Modificar Conteni">'.$rw5[1].'</textarea>


// 				<h5>Carga el documento</h5>
// 				<input type="file" name="docum" id="docum5">

// </td><td>';
// echo '<input type ="hidden" name="id" id="id5" value="6">';
// echo'
//                <br><br><br>	<br>
// 				<input class="button" onclick="editar5()" type="button" value="Guardar" />



// </td></form>';

// echo '</tr></div>';



// include("footer.php"); ?>


<!-- <div class="alert alert-warning alert-dismissable">

  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><h5>¡Descarga y lee!<h5/></strong> 
  	<a href="http://pruebas.transmillaslogin.com/uploaded/politicapdf6735738.pdf" target="_blank" class="btn btn-primary btn-lg">Descargar contrato Cliente  <span class="glyphicon glyphicon-download"></span></a>
</div> -->
 





