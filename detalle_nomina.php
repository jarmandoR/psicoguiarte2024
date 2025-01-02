<script type="text/javascript">

function holi(){
		alert("holi");
	}
</script>
<?php 

require("login_autentica.php");
include("cabezote3.php"); 

$_SESSION['usu_idempresa'];

error_reporting(0);


$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde5=" ";

if($param34!=''){ $fechaactual=$param34; }

if($param35!=''){ $id_sedes=$param35; 

	$conde4=" and usu_idsede=$id_sedes "; 	
}
if($param33!=''){ $conde="and `idusuarios`= '$param33' ";  }
if($param32!='' and $param32!=0){ $conde1="and `seg_motivo`= '$param33' ";  }
	
if($param34!=''){ $fechaactual=$param34." 00:00:00";  }
if($param36!=''){ $fechafinal=$param36." 23:59:59";  }
if($param38!=''){ $ano=$param38;   }

if($param36=='Primera'){
	$fechaactual=date($ano.'-'.$param34.'-01'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-15'.' 23:59:59');
}elseif($param36=='Segunda'){
	$fin = date("t");
	$fechaactual=date($ano.'-'.$param34.'-16'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-'.$fin.' 23:59:59');
}

 $fechafinal;
 $fechaactual;

if($param37!='0'){ $conde5=" and usu_tipocontrato='$param37'";  }

 $hoyf=date('Y-m-d h:i:s');

 if ($hoyf<=$fechafinal and $hoyf>=$fechaactual) {

 	$fechafinal=$hoyf;
 }

 $fechaComoEntero = strtotime($fechaactual);
 $fechaderegistro=$fechaComoEntero;

 $mesfiltrado=date('m',$fechaderegistro);
 $diafiltrado=date('d',$fechaderegistro);

if($nivel_acceso==1 or $nivel_acceso==18 or $nivel_acceso==26 or $nivel_acceso==58 or $nivel_acceso==53 ){
	
	
		$nombrearchivo="seguimiento de".$fechaactual." a ".$fechafinal."";
	
		echo'<a style="color:#000000;"   href="descargarlanomina.php?valor2='.$fechaactual.'&valor3='.$fechafinal.'&valor7= '.$nombrearchivo.'&param34= '.$param34.'&param36= '.$param36.'&param37= '.$param37.'&param38= '.$param38.'&param35= '.$param35.'">
				<img src="images/excel.png" style = "width:50px; height:40px; " hrf="reporteusuarios.php" title="Ver Reporte"/> Descargar 
			  </a>'; 
	
	
	// }
	}



$FB->titulo_azul1("Trabajador",1,0,5);
$FB->titulo_azul1("cedula",1,0,0); 
$FB->titulo_azul1("Cargo",1,0,0);  
$FB->titulo_azul1("Tipo Contrato",1,0,0); 
$FB->titulo_azul1("Sede",1,0,0); 
$FB->titulo_azul1("Salario base",1,0,0); 
$FB->titulo_azul1("Pecio hora",1,0,0);  
$FB->titulo_azul1("Dias laborados",1,0,0); 
$FB->titulo_azul1("Dias Sub Transporte",1,0,0); 


$FB->titulo_azul1("Salario ",1,0,0);  

$FB->titulo_azul1("Recargo nocturno ",1,0,0);  
$FB->titulo_azul1("Recargo Dom/Fes Diu ",1,0,0);  
$FB->titulo_azul1("Recargo Dom/Fes Nocturno",1,0,0);  
$FB->titulo_azul1("Total Recargos ",1,0,0); 


 $FB->titulo_azul1("Horas Ex. Diurno",1,0,0);
 $FB->titulo_azul1("Horas Ex. Noct",1,0,0); 
 $FB->titulo_azul1("Horas Ex. Diurno Dom/Fes",1,0,0);
 $FB->titulo_azul1("Horas Ex. Noct Dom/Fes",1,0,0); 
 $FB->titulo_azul1("Total Ho. Hex",1,0,0); 
 $FB->titulo_azul1("Total Sub Transporte",1,0,0); 
 $FB->titulo_azul1("DEVENGADO",1,0,0); 
 $FB->titulo_azul1("EPS",1,0,0); 
 $FB->titulo_azul1("Pension",1,0,0); 
 
 $FB->titulo_azul1("Total S/P",1,0,0);
 $FB->titulo_azul1("NETO A PAGAR QUINCENAL (CONSIGNAR)",1,0,0);
 $FB->titulo_azul1("BON. EXTRAL. MENSUAL. NO SALARIAL",1,0,0);
 $FB->titulo_azul1("TO. BON. EXTRAL. MENSUAL. NO SALARIAL",1,0,0);
 $FB->titulo_azul1("TOTAL A PAGAR",1,0,0);



 $FB->titulo_azul1("Desprendible",1,0,0);



 $sql11="SELECT `parame_id`, `parme_nombre`, `parme_valor` FROM `parametrizables` WHERE 1";

 $DB->Execute($sql11); $va=(($compag-1)*$CantidadMostrar); 
	 while($rw11=mysqli_fetch_row($DB->Consulta_ID))
	 {
if ($rw11[0]==1) {
	$salud=$rw11[2]/100;

}elseif ($rw11[0]==0) {
	

	$pension=$rw11[2]/100;

}elseif ($rw11[0]==3) {
	

	$subtransport=$rw11[2];

}elseif ($rw11[0]==4) {
	
	$salariominimo=$rw11[2]/100;


}elseif ($rw11[0]==5) {
	
	$horaregularlimite=$rw11[2];


}elseif ($rw11[0]==6) {
	
	$porrecargonocturno=$rw11[2]/100;


}elseif ($rw11[0]==7) {
	
	$porRecargoDomFesDiu=$rw11[2]/100;


}elseif ($rw11[0]==8) {
	
	$porHorasExDiurno=$rw11[2]/100;


}elseif ($rw11[0]==9) {
	

	$porHorasExNoct=$rw11[2]/100;

}elseif($rw11[0]==10){
	

	$porHorasExDiurnoDomFes=$rw11[2]/100;

}elseif($rw11[0]==11){
	

	$porHorasExNoctDomFes=$rw11[2]/100;

}elseif($rw11[0]==12){

	$porRecargoDomFesNocturno=$rw11[2]/100;
}elseif($rw11[0]==13){

	$horasestablecidasdia=$rw11[2];
}
	 }




//SUBSIDIO DE TRANSPORTE
$subtrans=$subtransport;
$subtransQ=$subtrans/2;
$subtransD=$subtrans/30;



// echo"año".$param34;
$conde3=""; 


//  $minseg=0; and usu_identificacion='1032363658'
 $horasDI=0;
$diaincom=0;
$domingos=0;
$fechaactual1=strtotime($fechaactual);
$fechafinal2=strtotime($fechafinal);



function saber_dia($nombredia){
$dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
$fecha = $dias[date('N', strtotime($nombredia))];


return $fecha;

}



// for($i=$fechaactual1; $i<=$fechafinal2; $i+=86400){
//      date("d-m-Y", $i)."<br>";


//    $hoyess="".saber_dia(date("d-m-Y",$i))."";




// if ($hoyess=="Domingo"){

// 	$domingoss=$domingoss+1;

// 	// $domingos=$domingos+1;
	
// }



// }
// echo'DOMINGOS DE LA 15NA'.$domingoss; ;)


function calculototaltiempo($minutosp){
$aux1=$minutosp*1/60;

//calcula decimal
$float = $aux1; 
 $dec = ltrim(($float - floor($float)),"0."); // result .3

$findecimal='0.'.$dec;

$finminutos=round($findecimal*60);

//calcula entero

$float1 = floor($aux1); 

// $horadfinal=$horas+$float1;
// $TOTALTIEMPO=$horadfinal.':'.$finminutos;
// return $horadfinal;  

return $array = array($float1,$finminutos);


}





$sql="SELECT  `usu_identificacion`,`roles_idroles`, `usu_nombre`, `usu_tipocontrato`,`usu_idsede`,`idusuarios`  FROM `usuarios`   where usu_estado=1  $conde4 $conde  order by usu_nombre  ";

// and usu_identificacion='1082160155'

  $DB->Execute($sql); 
	  while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	  {

		$conveminuaho=0;
		

		$totalfinhoex=0;
		$minutosextra=0;

		$valorsalariodia=0;
		$valorsalariohora=0;
		$valorsalariominuto=0;


		$vsrnocH=0;
		$vsrnocM=0;

		$valorhEXnoc=0;
        $valormEXnoc=0;
        $valortotalexnoc=0;

//valores salario con recargo domingo y festivo diurno

$vsrdomfesdiuH=0;
$vsrdomfesdiuM=0;

//valores salario con recargo domingo y festivo nocturno

$vsrdomfesnocH=0;
$vsrdomfesnocM=0;


//valores salario extr diurno

$vexdiurH=0;
$vexdiurM=0;

//valores salario extra nocturno

$vexnocH=0;
$vexnocM=0;

//valores salario extra nocturna domingos y festivos

$vsexnocdfH=0;
$vsexnocdfM=0;

//valores salario extra diurno domingos y festivos

$vsexdiurdfH=0;
$vsexdiurdfM=0;









$horasnocturnas=0;
$contdiastraba=0;
$horas1 = 0;
$minutos1 = 0;
$segundos1 = 0;
$contador = 0;

$minutosDomingo=0;

$horas2 = 0;
$minutos2 = 0;
$segundos2 = 0;
 $minutosDI=0;
  $horasDI=0;
$totahlextras=0;

$minuEXT=0;
$horasEXT=0;
$sql9="SELECT hoj_cargo,hoj_salario,hoj_salario, hoj_tipocontrato,hoj_auxilions,hoj_horario,hoj_area,hoj_nopension FROM `hojadevida` WHERE `hoj_cedula`='$rw1[0]'";
			$DB2->Execute($sql9);
			$rw6=mysqli_fetch_row($DB2->Consulta_ID);
			$idcargo =$rw6[0];
			$sinpension =$rw6[7];
			$sql4="SELECT `sed_nombre` FROM `sedes` WHERE `idsedes`='".$rw1[4]."'";
			$DB2->Execute($sql4);
			$rw4=mysqli_fetch_row($DB2->Consulta_ID);
			$nomsede =$rw4[0]; 


$sql10="SELECT rol_nombre FROM `roles` WHERE `idroles`='$rw6[0]'";
			$DB2->Execute($sql10);
			$rw8=mysqli_fetch_row($DB2->Consulta_ID);
			$nomcargo =$rw8[0];


			$sql11="SELECT hora_entrada,hora_salida FROM `horarios` WHERE `idhorarios`='$rw6[5]'";
			$DB2->Execute($sql11);
			$rw9=mysqli_fetch_row($DB2->Consulta_ID);
			$horarioentrada =$rw9[0];
			$horariosalida =$rw9[1];			


$horasDomingo=0;
// $Dsinfin= 0;



$valorsalariodia=$rw6[1]/30;
$valorsalariohora=$rw6[1]/240;
$valorsalariominuto=$rw6[1]/14400;

//valores salario con recargo nocturno
// echo"DR".$vsrnocD=$rw6[1]/30;
$vsrnocH=($porrecargonocturno*$valorsalariohora)+$valorsalariohora;
$vsrnocM=$rw6[1]/14400;

//valores salario con recargo domingo y festivo diurno
// echo"DR".$vsrdomfesdiuD=$rw6[1]/30;
$vsrdomfesdiuH=($porRecargoDomFesDiu*$valorsalariohora)+$valorsalariohora;;
$vsrdomfesdiuM=$rw6[1]/14400;

//valores salario con recargo domingo y festivo nocturno
// echo"DR".$vsrdomfesnocD=$rw6[1]/30;
$vsrdomfesnocH=($porRecargoDomFesNocturno*$valorsalariohora)+$valorsalariohora;;
$vsrdomfesnocM=$rw6[1]/14400;


//valores salario extr diurno
// echo"DR".$vexdiurD=$rw6[1]/30;
$vexdiurH=($porHorasExDiurno*$valorsalariohora)+$valorsalariohora;;
$vexdiurM=$rw6[1]/14400;

//valores salario extra nocturno
// echo"DR".$vsexnocD=$rw6[1]/30;
$vexnocH=($porHorasExNoct*$valorsalariohora)+$valorsalariohora;;
$vexnocM=$vexnocH/60;

//valores salario extra nocturna domingos y festivos
// echo"DR".$vsexnocdfD=$rw6[1]/30;
$vsexnocdfH=($porHorasExDiurnoDomFes*$valorsalariohora)+$valorsalariohora;;
$vsexnocdfM=$rw6[1]/14400;

//valores salario extra diurno domingos y festivos
// echo"DR".$vsexdiurdfD=$rw6[1]/30;
$vsexdiurdfH=($porHorasExNoctDomFes*$valorsalariohora)+$valorsalariohora;;
$vsexdiurdfM=$rw6[1]/14400;
$horasextra=0;
$minutosextrasuma=0;
$minualdia=0;
$horasaldia=0;
$horasextraini=0;
$minuextradia=0;
$PRE_MEX=0;

$sql8= "SELECT seg_horaingreso,seg_horaSalida,seg_ingresoAlmuerzo,seg_salioAlmuerzo,seg_fechaingreso FROM `seguimientousers`  where seg_iduser='".$rw1[0]."'and seg_fechaingreso>='".$fechaactual."' and seg_fechaingreso<='". $fechafinal."' order by seg_fechaingreso asc ";
	$DB1->Execute($sql8); 
			// $domingos=0;
			$va=0;
			$Dsinfin= 0;
	        $domingos=0;
		
			// echo$rw6[6];	

	        $tiemponocturno = 0;
			$horasnocturnas = 0;
			$minunocturnas = 0;

			$horasderecargonoc=0;
			$minutosderecargonoc=0;
			$horasdeextranoc=0;
			$minutosdeextranoc=0;
			$minuprecio=0;
	
	while($rw2=mysqli_fetch_row($DB1->Consulta_ID)){
		$condeenviar="and seg_fechaingreso>='".$fechaactual."' and seg_fechaingreso<='". $fechafinal."";
		
     
		$totalpreciominutosex=0;
		$horas1=0;
		$minutos1=0;
        $segundos1=0;
		$horas2=0;
		$minutos2=0;
		$segundos2=0;
		$segunaldia=0;
		$tiempo=0;
		$tiempo2=0;
		$TMEXP_PRE=0;
 		$TMEXP=0;

		////paraalmuerzo////
		$entrolmuerzo = 0;
		$saliodealmuerzo = 0;	
		$tiempoAl = 0;
		$horasfinAl= 0;
		$minutosfinAl= 0;
		$segunfinAl= 0;

		 


	 $horalimnoctcon=new DateTime($horaregularlimite);

			

		// if ($rw1[0]=="1000283626") {
		// 	echo$hoyes="".saber_dia($rw2[4])."";
		// }

		$hoyes="".saber_dia($rw2[4])."";
		$horacero="00:00:00";
		$horafinnormal="21:00:00";
		//para calcular primer tiempo del dia 
			$apertura = new DateTime($rw2[0]);

			if ($rw2[2]== $horacero) {
			$cierre = new DateTime($rw2[0]);	
			}else{
				$cierre = new DateTime($rw2[2]);
			}


		    $tiempo = $apertura->diff($cierre);
			
		$horas1 = $horas1 + $tiempo->format('%H');
		$minutos1 = $minutos1 +$tiempo->format('%i');
		$segundos1 = $segundos1 + $tiempo->format('%s');





		//para calcular segundo tiempo del dia
		$apertura2 = new DateTime($rw2[3]);

			if ($rw2[1]== $horacero) {
			$cierre2 = new DateTime($rw2[3]);	
			}else{
				$cierre2 = new DateTime($rw2[1]);
			}
		$tiempo2 = $apertura2->diff($cierre2);


		//*para extras despues de las hora limite diurno a nocturno
		if ($rw2[1]>=$horaregularlimite){

			$horalimnoctcon=new DateTime($horaregularlimite);

			$tiemponocturno = $cierre2->diff($horalimnoctcon);

			$horasnocturnas = $horasnocturnas+$tiemponocturno->format('%H');
			$minunocturnas = $minunocturnas+$tiemponocturno->format('%i');
			// echo"las horas nocturnas".$horasnocturnas;
			// echo"Trabajo con rcargos";
	
		}
		//*PARA RECARGOS Y HORAS EXTRA NOCTURNAS
		if($horariosalida>$horaregularlimite){
			$horasderecargonoc=$horasnocturnas;
			$minutosderecargonoc=$horasnocturnas;

		}else{

			$horasdeextranoc=$horasnocturnas;
			$minutosdeextranoc=$minunocturnas;
		}



		$horas2 = $horas2 + $tiempo2->format('%H');
		$minutos2 = $minutos2 +$tiempo2->format('%i');
		$segundos2 = $segundos2 + $tiempo2->format('%s');

		
///////////////para el tiempo de almuerzo///////////////////		
		$horacero="00:00:00";
		$entrolmuerzo = new DateTime($rw2[2]);

		if ($rw2[3]== $horacero) {
		$saliodealmuerzo = new DateTime($rw2[2]);	
		}else{
		$saliodealmuerzo = new DateTime($rw2[3]);
		}
		
		$tiempoAl = $entrolmuerzo->diff($saliodealmuerzo);
		$horasfinAl= $tiempoAl->format('%H');
		$minutosfinAl= $tiempoAl->format('%i');
		$segunfinAl= $tiempoAl->format('%s');


////////////////////////MENOS DE 35 MINITOS DE ALMUERZO/////////////////////////////		
		if ($minutosfinAl<35 or $horasfinAl>=1 ) {
			$faltapara35=35-$tiempoAl;
			$minutos1=$minutos1-$faltapara35;
			
		}else{

			
		}
//////////////////////////////////////////////////////////////


		if ($hoyes=="Domingo" ){

			$domingos=$domingos+1;
			
		}

		$horasaldia=$tiempo->format('%H')+ $tiempo2->format('%H');
		$minualdia=$tiempo->format('%i')+ $tiempo2->format('%i');
		$segunaldia=$tiempo->format('%s')+ $tiempo2->format('%s');
		
		
		
		
		//para calcular si son mas de 60 minutos pasa a ser una hora mas y se restan 60 minutos
		// if ($minualdia>=60) {

			
		// 	$horasaldia+1;
		// 	$minualdia=$minualdia-60;

		// 	echo"HORAS AL DIA".$horasaldia.":".$minualdia;

		// if ($segunaldia>=60) {
		// 	$minualdia+1;
		// 	$segunaldia=$segunaldia-60;

			
		// }


		// }
		list($minus,$segus) = calculototaltiempo($segunaldia);

		$minualdia=$minualdia+$minus;
		

		list($horasn,$minusn) = calculototaltiempo($minualdia);

		$horasaldia=$horasaldia+$horasn;
		$minualdia=$minusn;


		
		// echo"minutos al dia".$minualdia=$minusn;


			// echo"HORAS AL DIA".$horasaldia.":".$minualdia;
		// if ($rw1[0]=="1000283626") {

		// 	echo"H".$horasaldia;
		// 	echo"M".$minualdia;

		// }


		if ($horasaldia<$horasestablecidasdia and $hoyes=="Domingo" ){


				
			$Dsinfin=$Dsinfin;
		
		
	    }elseif( $horasaldia<$horasestablecidasdia and $hoyes=="Sabado" and $rw6[6]=="Administrativo"){

			$Dsinfin=$Dsinfin;

		       }elseif( $horasaldia<$horasestablecidasdia ){

				$Dsinfin= $Dsinfin+1;
	
				   }


		//*Para calcular los dias incompletos
		// if ($horasaldia<$horasestablecidasdia and $hoyes!="Domingo" and $hoyes!="Sabado" and $rw6[6]!="Administrativo"  ) {

		// 	//dias sin finalizar
		// 	// if ($rw1[0]=="1000283626") {
		// 	$Dsinfin= $Dsinfin+1;
		// // 	echo"incompleto";
		// // }
		// 	}elseif ($hoyes=="Domingo" ){


				
		// 			$Dsinfin=$Dsinfin;
				
				
		// 	}

		


			
			

		if ($horasaldia>=$horasestablecidasdia and $hoyes!="Domingo" ){

				// $horasbase=$horasaldia-8;
				// if ($rw1[0]=="1073711329") {
				$horasextraini=$horasaldia-$horasestablecidasdia;
				$minuextradia=$minualdia;
				// }

				// if ($rw1[0]=="1073711329"){
					$horasextra=$horasextra+$horasextraini;
					$minutosextrasuma=$minutosextrasuma+$minuextradia;
			    // }
				
                
			

				// if($rw2[0]!='00:00:00'){
					$contdiastraba=$contdiastraba+1; 
				// }
			
					
					$va=$val+1;
		
			
			
		}else if($hoyes=="Domingo"){


			$horasDomingo = $horasDomingo+$horasaldia;
			$minutosDomingo = $minutosDomingo+$minualdia;
			
			}elseif($hoyes=="Sabado" and $rw6[6]=="Administrativo" ){


				$contdiastraba=$contdiastraba+1; 

				
			
			}else{


				$horasDI = $horasaldia+$horasDI;

				$minutosDI=$minualdia+$minutosDI;
			
			}

				
			// if($hoyes=="Domingo"and){


			// 	}else{

				
			// 	}
			
	

    }


	$va++;
	// if ($rw1[0]=="1073711329"){
		// echo"total horas extra recogidas".$horasextra;
		// echo"total minutos extra recogidas".$minutosextrasuma;
	// }
	
	
	// echo"DOMINGOS".$domingos;
setlocale(LC_MONETARY, 'es_CO');



//*RESTANDO HORAS EXTRA NOCTURNAS A LAS HORS EXTRA TOTALES 
if($minutosdeextranoc>0 or $horasdeextranoc>0 ){
	$minutosextrasuma=$minutosextrasuma-$minutosdeextranoc;
	$horasextra=$horasextra-$horasdeextranoc;
  }
// }
//*PRECIO DE LAS HORAS EXTRAS NOCTURNAS TRABAJADAS
$valorhEXnoc=$horasdeextranoc*$vexnocH;
$valormEXnoc=$minutosdeextranoc*$vexnocM;
$valortotalexnoc=$valorhEXnoc+$valormEXnoc;



$VALORTOTALEXNOC=number_format($valortotalexnoc,0,".",".");;



 //*horas totales extra

 if ($minutosextrasuma>=60) {
	// $conveminuaho=calculototaltiempo($minuEXT);//funcion para convertir minutos a horas
	// $totalfinhoex=$horasEXT+$conveminuaho;
	// $minuEXT=0;


	list($uno,$dos) = calculototaltiempo($minutosextrasuma);

	// if ($rw1[0]=="1073711329"){
	
	
	

	//funcion para convertir minutos a horas
	$totalfinhoex=$horasextra+$uno;
	$minutosextra=$dos;
// }
 }else{

	$totalfinhoex=$horasextra;
	$minutosextra=$minutosextrasuma;
 }

//*TOTAL DE HORAS EXTRA PARA MOSTRAR







$totahlextras= $totalfinhoex.":".$minutosextra;

// if ($rw1[0]=="1000283626") {echo"extras".$totahlextras;}

$PRE_HEX=$vexdiurH;//para calcular el 25% del precio por hora
$PRE_MEX=$minuprecio*0.25;//para calcular el 25% del precio por minuto

////
 $THEXP_PRE=$totalfinhoex*$vexdiurH;   
 $THEXP=$minuEXT*$valorsalariohora;
 $totalpreciohorasex=$THEXP_PRE; //TOTAL precio HORA EXTRA Diurno
///             

///
 $TMEXP_PRE=$minutosextra*$PRE_MEX;
 $TMEXP=$minutosextra*$valorsalariominuto;
 $totalpreciominutosex=$TMEXP_PRE+$TMEXP;//TOTAL precio minuto EXTRA Diurno



 
///             

 




//DIURNO



//NOCTURNO



//*DOM/FES/DIUR
$precioexdf=$horasDomingo*$vsexdiurdfH;
$precioexdft=number_format($precioexdf,0,".",".");

//*DOM/FES/NOC


	
$THEXPQ= $totalpreciohorasex+$totalpreciominutosex+$valortotalexnoc+$precioexdf;

$THEXPQF=number_format($THEXPQ,0,".","."); //total valor horas extra trabajadas para mostrar



$horas = $horas1+$horas2;
$minutos = $minutos1+$minutos2;
$segundos = $segundos1+$segundos2;




$aux1=$minutos*1/60;

//calcula decimal
$float = $aux1; 
 $dec = ltrim(($float - floor($float)),"0."); // result .3

$findecimal='0.'.$dec;

$finminutos=round($findecimal*60);

//calcula entero

$float1 = floor($aux1); 

$horadfinal=$horas+$float1;
$TOTALTIEMPO=$horadfinal.':'.$finminutos;



  $tsegundos = gmdate('H:i:s', $segundos);
 $tminutos = gmdate('H:i:s', $minutos * 60);
 $thoras = gmdate('H:i:s', $horas*3600);



$falso1='08:30:02';
$falso2='08:30:01';



        $horaprecio = $rw6[2]/240;
       $minuprecio = $rw6[2]/14400;
        setlocale(LC_MONETARY, 'es_CO');
$preciohora= number_format($horaprecio,0,".",".");

$salariobasico= number_format($rw6[2],0,".",".");



 
		  echo "<tr class='text' bgcolor='#EFEFEF' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		 
		 
		  	if ($va<15) {

		  		
            // $diasneto=$va+1;
		  	 $diasneto=$va;

		  	 }


		  	 $diastraba=$va;
             
             // echo"HORAS DIAS INCOMPLETOS".$horasDI.""; ;)

             $vaenhorasnormales=$diastraba*8;

///*calculo de horas de dias incompletos
list($horasinco,$munitosinco)=calculototaltiempo($minutosDI);
            $horasdeminINC=$horasinco;

            $horasDI=$horasDI+$horasdeminINC;
             


             $horasacalcular=$vaenhorasnormales+$horasDI;
             
		  	 $saladia=$rw6[2]/30;
///calculo horas diurno DIAS
             $contdiastraba=$contdiastraba+$domingos;

			 ///febreros
			//  $febrero="02";
			// if (date('m')==$febrero and $param36=='Segunda' ) {
			// 	$contdiastraba=$contdiastraba+2;
			// }
			if ($mesfiltrado==2 and $diafiltrado>15 ) {
				$contdiastraba=$contdiastraba+2;
			}
			
			if (($mesfiltrado==2 or $mesfiltrado==3 or $mesfiltrado==5 or $mesfiltrado==7 or $mesfiltrado==8 or $mesfiltrado==10
			or $mesfiltrado==12) and $contdiastraba==16  ) {
				$contdiastraba=$contdiastraba-1;
			}

$salario15=$contdiastraba*$valorsalariodia;
///calculo horas extradomfest domingo diurno
		  	
		  	 $salario15DN=$horasDomingo*$horaprecio;


		  	 $salariorecargo15=$horaprecio*1;
             $salariorecargo15F=$salariorecargo15*$horasDomingo;
///calculo total precio extra domingos
             $salarioTRD=$salariorecargo15F+ $salario15DN;
             $salarioTRDM= number_format('0',0,".",".");


//total susbsidio de transporte quincenal

              if ($rw6[0]<2320000) {
              $diasconsubsitrans=$contdiastraba;
              }else{

              	$diasconsubsitrans=0;
              }
         



         $Totalsubtrans=$diasconsubsitrans*$subtransD;
         $TSTQ=number_format($Totalsubtrans,0,".",".");

 // echo'TOTAL TODAS H EXT'. $horasEXT.'/'.$minuEXT.'/'.$seguEXT;
         $salariobasetotal= number_format($salario15,0,".",".");

        //  $DEVENGADOprob=$salario15+$THEXPQ+$Totalsubtrans;

        //*  $DEVENGADO=money_format('%i',$DEVENGADOprob)."\n";

		
         
//total de salud y pension





$AUXTHSP1=$salario15+$THEXPQ;

if ($sinpension==2) {
	$AUXTHSP2=0;
	$THSPf1=0;
}else{
	$AUXTHSP2=$AUXTHSP1*$salud;
	$THSPf1=$AUXTHSP2+$AUXTHSP2;
}


$THSP=number_format($AUXTHSP2,0,".",".");        
$THSPf=number_format($THSPf1,0,".",".");
//*
$totaldeducciones=$AUXTHSP2+$AUXTHSP2;
$TOTALDEDUCCIONES=number_format($totaldeducciones,0,".",".");


$devengado=$salario15+$THEXPQ+$Totalsubtrans;


		$DEVENGADO=number_format($devengado,0,".",".");
		
		$totalapagarfinal=$devengado-$totaldeducciones;
		$totalapagarfinalredondeado=round($totalapagarfinal);
		$TOTALAPAGARFINAL=number_format($totalapagarfinalredondeado,0,".",".");
		



$bonoxtra1=$rw6[4]/30;
$bonoxtra2=$bonoxtra1*$contdiastraba;
$bonoxtra=number_format($bonoxtra2,0,".",".");

		  echo "<td>".$rw1[2]."</td>";//trabajador
		  echo "<td>".$rw1[0]."</td>";//cedula
		  echo "<td>".$nomcargo."</td>";//cargo
		  echo "<td>".$rw6[3]."</td>";//tipo contrato
		  echo "<td>".$nomsede."</td>";//sede
		  echo "<td>".$salariobasico."</td>";//salariobse
		  echo "<td>".$preciohora."</td>";//precio hora
		  if ($Dsinfin>0) {
         	
         	$colortd="#ff8000";
         }
          if ($horasDomingo==0) {
         	
         	$horasDomingo="00:00";
         }
         //Dias laborados
			echo "<td align='center'  >
				<a  onclick='pop_dis100(".$rw1[5].",\"verquincena\",0,\"$fechaactual\",\"$fechafinal\")';  style='cursor: pointer;' title='Confirmar' >". $contdiastraba." dias </a>";
				if ($Dsinfin>0) {
					echo"<br><mark>".$Dsinfin." incompletos</mark>";
				}
			echo"</td>";
        $diascontranspo=$contdiastraba;
		




          	echo"<td  >".$diascontranspo."</td>";// dis con subsidio de transporte
		  
		  
		 echo"<td  bgcolor='#a3cd52' >".$salariobasetotal."</td>";//salario
		 echo"<td>00:00</td>";//Recargo nocturno
		 echo"<td>00:00</td>";//Recargo Dom/Fes Diu
		 echo"<td>00:00</td>";//Recargo Dom/Fes Nocturno
		 echo"<td bgcolor='#a3cd52'>".$salarioTRDM."</td>";//Total Recargos

		  //Horas Ex. Diurno
		  echo"<td>".$totahlextras."</td>";//Horas Ex. Diurno
		  $horasextrasnoctur=$horasdeextranoc.":".$minutosdeextranoc;
		  echo"<td>".$horasextrasnoctur."</td>";//Horas Ex. Noct
		  echo"<td>". $horasDomingo.":00</td>";//Horas Ex. Diurno Dom/Fes
		  echo"<td>-</td>";//Horas Ex. Noct Dom/Fes
		  echo"<td bgcolor='#a3cd52' >". $THEXPQF."</td>";//Total Ho. Hex
		  echo"<td bgcolor='#a3cd52' >".$TSTQ."</td>";//Total Sub Transporte
		  echo"<td bgcolor='#7aff22' >". $DEVENGADO."</td>";//DEVENGADO
		  
		  
		
          
	      

		  if ($sinpension==2) {
			echo"<td  >0</td>";//salud
			echo"<td  >0</td>";//Pension
		}else{
			echo"<td  >".$THSP."</td>";//salud
			echo"<td>".$THSP."</td>";//Pension
		}

	      echo"<td bgcolor='#a3cd52' >".$THSPf."</td>";//Total S/P

//NETO A PAGAR = DEVENGADO MENOS SALUD Y PENSION
$netopagpquincenaprob=$DEVENGADOprob-$THSPf1;
$netopagpquincena=number_format($netopagpquincenaprob,0,".",".");

$bonoextrat=number_format($rw6[4],0,".","."); 

          echo"<td bgcolor='#7aff22' >".$TOTALAPAGARFINAL."</td>";//NETO A PAGAR QUINCENAL (CONSIGNAR)
		  echo"<td bgcolor='#a3cd52' >".$bonoextrat."</td>";//BON. EXTRAL. MENSUAL. NO SALARIAL
	      echo"<td bgcolor='#a3cd52' >".$bonoxtra."</td>";//TO. BON. EXTRAL. MENSUAL. NO SALARIAL


//TOTAL A PAGAR = NETO A PAGAR + AUXILIO BONO EXTRA
	      $TOTALAPAGARprob =$totalapagarfinalredondeado+$bonoxtra2;
          $TOTALAPAGARFINALCONAUX=number_format($TOTALAPAGARprob,0,".",".");

          echo"<td bgcolor='#7aff22' >".$TOTALAPAGARFINALCONAUX."</td>";//TOTAL A PAGAR


          echo "<td align='center' >
		  <a  onclick='pop_dis21(".$rw1[5].",\"Desprendible\",\"$param36\",\"$conde4\",\"$fechaactual\",\"$fechafinal\")';  style='cursor: pointer;' title='Confirmar' >Descargar</a></td>";//Desprendible
	      }

	     



	$FB->titulo_azul1(" Totales :",1,0,10); 
	// $FB->titulo_azul1(" $va",1,0,0); 
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
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	

include("footer.php");
?>