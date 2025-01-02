<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde5=" ";

if($param34!=''){ $fechaactual=$param34; }


if($param33!='0'){ $conde=" and `rec_tipo`= '$param33' ";  }
if($param34!='0'){ $conde1=" and `rec_estado`= '$param34' ";  }
	
$FB->titulo_azul1("Numero Reclamo",1,0,7); 
$FB->titulo_azul1("Fecha Ingreso",1,0,0); 
$FB->titulo_azul1("Fecha Envio",1,0,0); 
$FB->titulo_azul1("Tipo Reclamo",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Nombre",1,0,0); 
$FB->titulo_azul1("Telefomo",1,0,0); 
$FB->titulo_azul1("Confirmar Reclamo",1,0,0); 
$FB->titulo_azul1("Correo",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Direccion",1,0,0); 
$FB->titulo_azul1("Guia",1,0,0); 
$FB->titulo_azul1("Foto Guia",1,0,0); 
$FB->titulo_azul1("Valor Seguro",1,'5%',0); 
$FB->titulo_azul1("Generar Acuerdo",1,'5%',0); 
$FB->titulo_azul1("Fecha Acuerdo",1,'5%',0); 
$FB->titulo_azul1("Valor Acuerdo",1,'5%',0); 
$FB->titulo_azul1("Foto Acuerdo",1,'5%',0); 
$FB->titulo_azul1("Agregar Pago",1,'5%',0); 
$FB->titulo_azul1("Foto Pago",1,'5%',0); 

if($nivel_acceso=='1'){
$FB->titulo_azul1("Eliminar",2,'5%',0); 
}else{
	$FB->titulo_azul1("Eliminar",1,'5%',0); 	
}



$conde3=""; 

if($param37!='0'){ $conde5=" and usu_tipocontrato='$param37'";  }

  $sql="SELECT `idreclamos`, `rec_numero`, `rec_fechaingreso`, `rec_fechaenvio`, `rec_tipo`,`rec_estado`,`rec_nombre`, `rec_telefono`, `rec_correo`,`rec_guia`,ser_valorseguro, `rec_fechaacuerdo`,`rec_valoracuerdo`,`rec_descripcion`, `rec_acuerdo`, `rec_idservicio`, `rec_ciudadenvio`,  `rec_direccion` FROM `reclamos` inner join servicios on rec_idservicio=idservicios WHERE  idreclamos>0 $conde  $conde1  $conde4  ORDER BY idreclamos  asc ";
$DB1->Execute($sql); 
$va=0; 
$totalasignadas=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{	
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			$verguia="Ver Foto Guia";
			$veracuerdo="Ver Foto Acuerdo";
			$verpago="Ver Foto Pago";
			//if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){}else{ $color="#ff5f42"; }
			$fecha=$rw1[2];
			$fechabd= date("Y-m-d H:i:s",strtotime($fecha."+ 48 hour")); 
			$fechaultima= strtotime($fechabd);
			$fechaactual=strtotime("now");

			if($rw1[5]=='Confirmar' and $fechaultima<=$fechaactual){
				
				 $color="#C72907";
			}
			else if($rw1[5]=='Confirmar'){
				$color="#2FB80D";
			}


			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

			echo "<td>".$rw1[1]."</td>";
			echo "<td>".$rw1[2]."</td>";
			echo "<td>".$rw1[3]."</td>";
			echo "<td>".$rw1[4]."</td>";
			echo "<td>".$rw1[5]."</td>";
			echo "<td>".$rw1[6]."</td>";
			echo "<td>".$rw1[7]."</td>";
			if($rw1[5]=='Confirmar'){

				echo "<td align='center' >";
				echo "	<a  onclick='pop_dis16($id_p, \"LlamarReclamos\",\"$rw1[15]\")';  style='cursor: pointer;' title='Confirmar Reclamo' ><img src='img/validar.png'></a></td>";

			}else{
					
				echo "<td align='center' >";
				echo "	<a  onclick='pop_dis16($id_p, \"LlamarReclamos\",\"$rw1[15]\")';  style='cursor: pointer;' title='Confirmar Reclamo' >Confirmado</td>";

			}

		

			echo "<td>".$rw1[8]."</td>";
			echo "<td>".$rw1[16]."</td>";
			echo "<td>".$rw1[17]."</td>";
			
			echo "<td align='center' ><a  onclick='pop_dis5($rw1[15],\"Recogidas\")';  style='cursor: pointer;' title='Detalle Guia' >$rw1[9]</td>";
			echo $LT->llenadocs3($DB, "reclamos",$rw1[0], 1, 35, 'Ver Foto Guia');
			echo "<td>".$rw1[10]."</td>";
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$rw1[0]\",\"acuerdo\",\"$param34\")';  title='Acordar Pago' > Acordar Pago</td>";
			echo "<td>".$rw1[11]."</td>";
			echo "<td>".$rw1[12]."</td>";
			echo $LT->llenadocs3($DB, "reclamos", $rw1[0], 2, 35, 'Ver Foto Acuerdo');
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$rw1[0]\",\"pagoreclamo\",\"$param34\")';  title='Pago Reclamo' > Pago Reclamo</td>";

			echo $LT->llenadocs3($DB, "reclamos", $rw1[0], 3, 35, 'Ver Foto Pago');

			if($nivel_acceso=='1'){
				$DB->edites($rw1[0], "reclamos", 1,"delete");
			}else{
				$DB->edites($rw1[0], "reclamos", 3,"delete");
			}
		
	}
	


	$FB->titulo_azul1(" Totales :",1,0,10); 
	$FB->titulo_azul1(" $va",1,0,0); 

	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 

	/* $FB->titulo_azul1("$ $totalalcobro",1,0,0); 
	$FB->titulo_azul1("$ $totalprestamos",1,0,0);  */

include("footer.php");
?>