<?php 

// $nombre = $_GET['valor7'];
error_reporting(0);//oculta errores
$trabajador= $_GET['trabajador'];
// $rw1[2]
$quincena= $_GET['quincena'];

$cedula= $_GET['cedula'];

$fechaderegistro= $_GET['fechaderegistro'];

// $rw1[0] fechaderegistro
$nomarchivo="".$trabajador." ".$cedula."".$quincena." del ".date('m',$fechaderegistro)." del ".date('Y',$fechaderegistro)." ";

header('Content-type:application/xls');
header('Content-Disposition: attachment; filename='.$nomarchivo.'.xls');
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";



$salbase= $_GET['salbase'];
// $salariobasico

$subtrans= $_GET['subtrans'];
// $TSTQ

$sede= $_GET['sede'];
//$nomsede

$diaslaborados= $_GET['diaslaborados'];
// $contdiastraba

$salbasetotal= $_GET['salbasetotal'];
// $salariobasetotal

$HEDO= $_GET['HEDO'];
// $THEXPQF

$HoraENocOr= $_GET['HoraENocOr'];
// $VALORTOTALEXNOC

$HoraExDiuDoFe= $_GET['HoraExDiuDoFe'];	
// $precioexdft

$Subtrans= $_GET['Subtrans'];	
// $TSTQ

$AuxExNosal= $_GET['AuxExNosal'];
// $bonoxtra

$Aportesalud= $_GET['Aportesalud'];
// $THSP

$Aportepension= $_GET['Aportepension'];
// $THSP



$TOTALDEVENGADO= $_GET['TOTALDEVENGADO'];
// $DEVENGADO

$TOTALDEDUCCIONES= $_GET['TOTALDEDUCCIONES'];
// $TOTALDEDUCCIONES


$NETOPAGAR= $_GET['NETOPAGAR'];
// $TOTALAPAGARFINAL

$VALORLETRAS= $_GET['VALORLETRAS'];
// $valorenletras;



error_reporting(0);


setlocale(LC_MONETARY, 'es_CO');
$VALOCERO=money_format('%i',0) . "\n";

  if($bonoxtra>$VALOCERO){

	 


  }

echo'<table border="1">';



		echo "<tr class='text' bgcolor='#EFEFEF'>" ;
	

			
            echo "<th colspan='1'  align='center' bgcolor='#F08080'><strong>EMPRESA:</strong></th>";
            echo "<td colspan='2'  align='center'>BERMUDAS S.A.S. </td>";
			echo "<td colspan='3'  align='center' bgcolor='#F08080'><strong>NIT:</strong></td>";
			echo "<td colspan='2'  align='center'>901.169.262-8</td>";
			// echo "<td colspan='1'  align='center' >-</td>";
			// echo "<td colspan='1'  align='center' bgcolor='#F08080' ><strong>CÓDIGO</strong></td>";

			// echo "<td colspan='2'  align='center' >1</td>";
			
			



		echo"</tr>";
	

	

echo "<tr  bgcolor='#EFEFEF'>" ;
 echo "<td colspan='1'  align='center' bgcolor='#F08080' ><strong>TRABAJADOR:</strong></td>";
            echo "<td   align='center' colspan='4'>".$trabajador."</td>";
			echo "<td colspan='1'  align='center' bgcolor='#F08080' ><strong>C.C.</strong></td>";
			echo "<td colspan='2'  align='center'>".$cedula."</td>";
		
		
echo"</tr>";




echo "<tr  bgcolor='#EFEFEF'>" ;
 echo "<td colspan='1'  align='center' bgcolor='#F08080'><strong>SALARIO B&Agrave;SICO</strong></td>";
            echo "<td colspan='1'  align='center'>".$salbase."</td>";
			echo "<td colspan='1'  align='center' bgcolor='#F08080' ><strong>SUB DE TRANS</strong></td>";
			echo "<td colspan='1'  align='center'>".$subtrans."</td>";
			echo "<td colspan='1'  align='center' bgcolor='#F08080' ><strong>SEDE</strong></td>";
			echo "<td colspan='1'  align='center'>".$sede."</td>";

			echo "<td colspan='1'  align='center' bgcolor='#F08080' ><strong>MEDIO DE PAGO</strong></td>";
			echo "<td colspan='1'  align='center' >--</td>";
			// echo "<td colspan='1'  align='center' bgcolor='#F08080' >MEDIO DE PAGO</td>";
			// echo "<td colspan='1'  align='center' >--</td>";
echo"</tr>";


echo "<tr  bgcolor='#EFEFEF'>" ;
 echo "<td colspan='1'  align='center' bgcolor='#F08080' ><strong>PER&Iacute;ODO DE PAGO:</strong></td>";
            echo "<td colspan='1'  align='center'>".$quincena."</td>";
			echo "<td colspan='1'  align='center'><strong>Mes</strong></td>";
			echo "<td colspan='1'  align='center'>".date('m',$fechaderegistro)."</td>";
			echo "<td colspan='1'  align='center' ><strong>A&ntilde;o</strong></td>";
			echo "<td colspan='1'  align='center'>".date('Y',$fechaderegistro)."</td>";

			echo "<td colspan='1'  align='center' bgcolor='#F08080' ><strong>D&Iacute;AS LABORADOS</strong></td>";
			echo "<td colspan='1'  align='center' >". $diaslaborados."</td>";
			// echo "<td colspan='1'  align='center' >-</td>";
			// echo "<td colspan='1'  align='center' >--</td>";
echo"</tr>";

echo "<tr bgcolor='#EFEFEF'>" ;
 echo "<td colspan='3' align='center' bgcolor='#F08080' ><strong>DESCRIPCION:</strong></td>";
			echo "<td colspan='3' align='center' bgcolor='#F08080' ><strong>PAGOS:</strong></td>";
			echo "<td colspan='2' align='center' bgcolor='#F08080' ><strong>DESCUENTOS</strong></td>";
			
			
echo"</tr>";

echo "<tr  bgcolor='#EFEFEF'>" ;
 echo "<td colspan='3'   ><strong>salario devengado</strong></td>";
           
			echo "<td colspan='3'  align='center'>".$salbasetotal."</td>";

			echo "<td colspan='2'  align='center' bgcolor='#F08080' ><strong>$0</strong></td>";
			
			
echo"</tr>";







$recarnnoctor=0;	
if($recarnnoctor!=0){
echo "<tr  bgcolor='#EFEFEF'>" ;
            echo "<td colspan='3'  >Recargo nocturno ordinario</td>";
			echo "<td colspan='3'  align='center'><strong>$0</strong></td>";
			echo "<td colspan='2'  align='center' ><strong>$0</strong></td>";
	        
		
echo"</tr>";	
}

$recardomfesdiurn=0;	
if($recardomfesdiurn!=0){
echo "<tr  bgcolor='#EFEFEF'>" ;
            echo "<td colspan='3'  >Recargo dom./fest. diurna	</td>";
            echo "<td colspan='3'  align='center'>$0</td>";
			echo "<td colspan='2'  align='center'><strong>$0</strong></td>";
			
			
echo"</tr>";	
}


$recardomfesnoct=0;	
if($recardomfesnoct!=0){
echo "<tr  bgcolor='#EFEFEF'>" ;
            echo "<td colspan='3'  >Recargo dom./fest. noct.</td>";
            echo "<td colspan='3'  align='center'>$0</td>";
			echo "<td colspan='2'  align='center'><strong>$0</strong></td>";
		
			
echo"</tr>";	
}

if($HEDO>$VALOCERO){
	echo "<tr  bgcolor='#EFEFEF'>" ;
	echo "<td colspan='3'  >Hora Extra Diurna Ordinaria	</td>";
   echo "<td colspan='3'  align='center'>".$HEDO."</td>";
   echo "<td colspan='2'  align='center'><strong>$0</strong></td>";
   

echo"</tr>";
	 


}

	
if($HoraENocOr>$VALOCERO){
echo "<tr  bgcolor='#EFEFEF'>" ;
 			echo "<td colspan='3'  >Hora Extra Nocturna Ordinaria</td>";
            echo "<td colspan='3'  align='center'>".$HoraENocOr."</td>";
			echo "<td colspan='2'  align='center'><strong>$0</strong></td>";
			
			
			// echo "<td colspan='1'  align='center' >$0</td>";
echo"</tr>";	
}

if($HoraExDiuDoFe>$VALOCERO){
echo "<tr  bgcolor='#EFEFEF'>" ;
 			echo "<td colspan='3'  >Hora Extra Diurna Dom/Fest	</td>";
            echo "<td colspan='3'  align='center'>".$HoraExDiuDoFe."</td>";
			echo "<td colspan='2'  align='center'><strong>$0</strong></td>";
			
			
			// echo "<td colspan='1'  align='center' >$0</td>";
echo"</tr>";	
}

echo "<tr  bgcolor='#EFEFEF'>" ;
 			echo "<td colspan='3'  >Hora Extra Nocturna Dom/Fest</td>";
            echo "<td colspan='3'  align='center'>$0</td>";
			echo "<td colspan='2'  align='center'><strong>$0</strong></td>";
			
			
echo"</tr>";	

if($Subtrans>$VALOCERO){
echo "<tr  bgcolor='#EFEFEF'>" ;
 echo "<td colspan='3'  >Subsidio de transporte	</td>";
            echo "<td colspan='3'  align='center'>".$Subtrans."</td>";
			echo "<td colspan='2'  align='center'><strong>$0</strong></td>";
			
			
echo"</tr>";	
}
if($AuxExNosal>$VALOCERO){
echo "<tr  bgcolor='#EFEFEF'>" ;
 echo "<td colspan='3'  >Auxilio Extralegal (No salarial)</td>";
            echo "<td colspan='3'  align='center'>".$AuxExNosal."</td>";
			echo "<td colspan='2'  align='center'><strong>$0</strong></td>";
			
			
echo"</tr>";	
}
echo "<tr  bgcolor='#EFEFEF'>" ;
echo "<td colspan='3'   ><strong>Aporte a salud</strong></td>";
echo "<td colspan='3'  align='center'>$0</td>";
			echo "<td colspan='2'  align='center' >".$Aportesalud."</td>";
	
echo"</tr>";	

echo "<tr  bgcolor='#EFEFEF'>" ;
echo "<td colspan='3'   ><strong>Aporte a pension</strong></td>";
echo "<td colspan='3'  align='center'>$0</td>";
echo "<td colspan='2'  align='center' >".$Aportepension."</td>";
echo"</tr>";	



echo "<tr  bgcolor='#EFEFEF'>";
 echo "<td colspan='2'  align='center' bgcolor='#F08080'>TOTAL DEVENGADO:</td>";
            echo "<td colspan='2'  align='center'>".$TOTALDEVENGADO."</td>";
			echo "<td colspan='2'  align='center' bgcolor='#F08080'><strong>TOTAL DEDUCCIONES:</strong></td>";
			echo "<td colspan='2'  align='center'>".$TOTALDEDUCCIONES."</td>";
		

// $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);

			
			// echo "<td colspan='1'  align='center' >--</td>";
echo"</tr>";

echo "<tr  bgcolor='#EFEFEF'>";
 echo "<td colspan='2'  align='center' bgcolor='#F08080'>NETO A PAGAR:</td>";
            echo "<td colspan='2'  align='center'>".$NETOPAGAR."</td>";
			echo "<td colspan='2'  align='center' bgcolor='#F08080'><strong>VALOR LETRAS:</strong></td>";
			echo "<td colspan='2'  align='center'><strong>".$VALORLETRAS."  pesos moneda legal corriente</strong></td>";
			
			// echo "<td colspan='1'  align='center' >-</td>";
			
echo"</tr>";
		
		
	
	
	
		
	
	
	
		
		
		
	



	


?>
</table>