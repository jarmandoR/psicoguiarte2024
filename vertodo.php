<?php 
require("login_autentica.php");
include("cabezote1.php"); 
include("cabezote4.php"); 
 
$date=date("Y-m-d");
$ultimo="";
$tablas="";

if($condecion>0){
 $sql="SELECT `idmatriz`, `mat_nombre`, `mat_valor`, `mat_tipomatriz`, 
 `mat_fecha` FROM `matizlaboratorio` WHERE mat_ididentificador='$consecutivo' order by idmatriz  ";
$DB1->Execute($sql); $va=1; 
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		 $rw[$va]=$rw1[2];
		
		$va++;
	}
	
}else {
  $sql="SELECT `idfactura`, `fac_fecha`, `tipodocumento_idtipodocumento`, `fac_iddocumento`, `fac_nombre`,`fac_edad`  FROM `facturacion` where idfactura='$id_param' ";	
$DB1->Execute($sql); 
$rw=mysqli_fetch_row($DB1->Consulta_ID); 
}

$FB->abre_form("form1","matrizpdf.php","post");

$FB->titulo_azul1("MATRIZ LABORATORIO",12,0, 5); 

$FB->llena_texto("Fecha:", 1, 10, $DB, "", "",@$rw[1], 1, 0);
$FB->llena_texto("Tipo Documento:",2,2,$DB,"SELECT `iddocumento`, `tip_nombre` FROM `tipodocumento` ORDER BY iddocumento","",$rw[2],6,0);
$FB->llena_texto("Documento:", 3, 115, $DB, "", "",@$rw[3],4,0);
$FB->llena_texto("Nombre Del Paciente:",4, 1, $DB, "", "",@$rw[4], 1, 0);
$FB->llena_texto("Fecha de Nacimiento:", 5, 10, $DB, "", "",@$rw[5], 6, 0);
$FB->llena_texto("# Ingreso:", 6, 1, $DB, "", "",@$rw[6], 4, 0);



		$FB->titulo_azul1("PARCIAL DE ORINA",18,0, 5); 
		
		$FB->titulo_azul1("Examen macroscopico",18,0, 5);
		 
		$FB->llena_texto("Glucosa:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Aspecto:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 6, 0);
		$FB->llena_texto("Cetonas:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Densidad:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("pH:",$param=$param+1, 1, $DB, "", "",@$rw[$param],6, 0);
		$FB->llena_texto("Leucocitos:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Nitritos:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Urobilinogeno:",$param=$param+1, 1, $DB, "", "",@$rw[$param],6, 0);
		$FB->llena_texto("Sangre:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Prote&iacute;nas:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Cetonas:",$param=$param+1, 1, $DB, "", "",@$rw[$param],6, 0);
		$FB->llena_texto("Bilirrubinas:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);

		$FB->titulo_azul1("Examen microsc&oacute;pico:",18,0, 5); 

		$FB->llena_texto("C&eacute;lulas Epiteliales:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Bacterias:",$param=$param+1, 1, $DB, "", "",@$rw[$param],6, 0);
		$FB->llena_texto("Leucocitos:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Moco:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Cristales de Uratos Amorfos:",$param=$param+1, 1, $DB, "", "",@$rw[$param],6, 0);
		$FB->llena_texto("Hemat&iacute;es:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->cierra_tabla(); 


		
		$FB->titulo_azul1("COPROLOGICO",18,0, 5);	
		$FB->titulo_azul1("COPROSCOPICO",18,0, 5); 	
		$FB->titulo_azul1("Examen macrosc&oacute;pico",18,0, 5);
		 
		$FB->llena_texto("Consistencia:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Color:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 6, 0);

		$FB->titulo_azul1("Examen microsc&oacute;pico:",18,0, 5); 

		$FB->llena_texto("Microbiota:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Grasas Neutras:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Almidones:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Fibras vegetales:",$param=$param+1, 1, $DB, "", "",@$rw[$param],6, 0);
		$FB->llena_texto("Levaduras:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Celulosa:",$param=$param+1, 1, $DB, "", "",@$rw[$param],6, 0);
		$FB->llena_texto("Micelios:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Parasitos:",$param=$param+1,82, $DB,$Parasitos, "",@$rw[$param],6, 1);
		//$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda2,"",$param1,1,17);
		
		$FB->titulo_azul1("CUADRO HEMATICO COMPLETO",18,0, 5); 	
		$FB->titulo_azul1("CUADRO HEMATICO",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hematocrito: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>%</td>
				<td>39 - 51</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hemoglobina: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>g/dL</td>
				<td>13 - 17</td></tr>";
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Leucocitos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>Leu/mm3</td>
				<td>5,000 - 10,000</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";		
				echo "<td>Plaquetas: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>Plaq/mm3</td>
				<td>5,000 - 10,000</td></tr>";	
				echo "</table>";

				
		$FB->titulo_azul1("LEUCOCITOS DIFERENCIAL",1,0,5); 
		$FB->titulo_azul1("Valor relativo",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 		
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Neutr&oacute;filos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>55 - 68%</td>
				</tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Linfocitos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>28 - 45%</td>
				</tr>";		
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Monocitos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>0 - 3%</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Eosin&oacute;filos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>0 - 3%</td>
				</tr>";	
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Basofilos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>0 - 1%</td>
				</tr>";			
				echo "</table>";
		$FB->titulo_azul1("HEMATOLOGIA",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		echo "<tr class='text' bgcolor='#F3F3F3'>";		
				echo "<td>Plaquetas: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>mm/1H</td>
				<td>Hasta 10</td></tr>";	
				echo "</table>";		
		

		/* $FB->titulo_azul1("SEROLOGIA VDRL",18,0, 5); 	
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
				
				echo "<tr class='text' bgcolor='#F3F3F3'>";		
				echo "<td>Plaquetas: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>Plaq/mm3</td>
				<td>5,000 - 10,000</td></tr>";	
				echo "</table>";

		 */

		$FB->titulo_azul1("EOSINOFILOS EN MOCO NASAL",18,0, 5); 
		$FB->titulo_azul1("EOSINOFILOS EN SANGRE",18,0, 5); 	

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Eosin&oacute;filos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>%</td>
				<td></td>
				<td>%</td>
				</tr>";	
				echo "</table>";		
		

		$FB->titulo_azul1("GAMA GLUTAMIL TRANSFERASA",18,0, 5); 	

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Gama glutamil transferasa: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>U/L</td>
				<td></td>
				<td>Enzim&aacute;tico U.V.</td>
				</tr>";	
				echo "</table>";		
		

		$FB->titulo_azul1("HEMOGRAMA TIPO III",18,0, 5); 	
				
		$FB->titulo_azul1("LEUCOCITOS DIFERENCIAL",1,0,5); 
		$FB->titulo_azul1("Valor relativo",2,1,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 	

				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Leucocitos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>X10^9/L</td>
				<td>5-10</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Linfocitos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>%</td>
				<td>35 - 45%</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Mid: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>%</td>
				<td>0 - 3%</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Granulocitos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>%</td>
				<td>45 - 55%</td>
				</tr>";					
				echo "</table>";
			

				$FB->titulo_azul1("RECUENTO DE LEUCOCITOS",1,0,5); 
				$FB->titulo_azul1("Valor relativo",2,1,0); 
				$FB->titulo_azul1("Referencia",1,0,0); 	

				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Linfocitos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>X10^9/L</td>
				<td>0,9-4,1</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Mid: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>X10^9/L</td>
				<td>0,1-1,8</td>
				</tr>";				
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Granulocitos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>X10^9/L</td>
				<td>2-7,8</td>
				</tr>";
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>RBC: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>X10^9/L</td>
				<td>3,5-5,0</td>
				</tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hemoglobina: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>g/dL</td>
				<td>13 - 17</td>
				</tr>";
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hematocrito: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>%</td>
				<td>39 - 51</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>MCV: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>Fl</td>
				<td>82-92</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>MCH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>pg</td>
				<td>27-31</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>MCHC: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>g/dL</td>
				<td>32-36</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>RDW_CV: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>%</td>
				<td>11,5-14,5</td>
				</tr>";	
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>RDW_SD: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>Fl</td>
				<td>37-54</td>
				</tr>";		
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Plaquetas: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>X10^9/L</td>
				<td>150-450</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>MPV: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>Fl</td>
				<td>7,4-10,4</td>
				</tr>";		
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>PDW: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>Fl</td>
				<td>10-14</td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>PCT: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>%</td>
				<td>0,10-0,28</td>
				</tr>";				
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>P_LCR: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>%</td>
				<td>13-43</td>
				</tr>";				
				
				echo "</table>";
		
		$FB->titulo_azul1("FROTIS SECRECION VAGINAL",18,0, 5); 	

		$FB->titulo_azul1("Examen Macrosc&oacute;pico",18,0, 5);
		$FB->llena_texto("Color:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Aspecto:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 4, 0);

		$FB->titulo_azul1("Examen Qu&iacute;mico",18,0, 5);
		 $FB->llena_texto("Test de aminas:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("pH:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);

		$FB->titulo_azul1("Examen en fresco",18,0, 5);
		$FB->llena_texto("C&eacute;lulas epiteliales:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Bacterias:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 4, 0);
		$FB->llena_texto("Leucocitos:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Levaduras:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Trichomonas:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Celulas gu&iacute;a:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);

		$FB->titulo_azul1("Coloraci&oacute;n de Gram",18,0, 5);
		$FB->llena_texto("Reacci&oacute;n PMN:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Celulas gu&iacute;a:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Levaduras:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Coco Bacilo Gram Variable:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Pseudomicelios:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Bacilo Gram Positivo:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Coco Gram Positivo:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Bacilo Gram Negativo:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Coco Gram Negativo:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Diplococo Gram negativo	Intracelular:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Diplococo Gram negativo	Extracelular:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("DIAGNOSTICO:",$param=$param+1, 9, $DB, "", "",@$rw[$param] ,4, 0);

		
		$FB->titulo_azul1("BACILOSCOPIA",18,0, 5); 
			$FB->titulo_azul1("BACILOSCOPIA SERIADA",1,0,5); 
				$FB->titulo_azul1("Fecha",1,1,0); 
				$FB->titulo_azul1("Resultado",1,0,0); 	

				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>BK 1: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='$date' ></td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' ></td>

				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>BK 2: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='$date' ></td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' ></td>
				</tr>";			
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>BK 3: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='$date' ></td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' ></td>
				</tr>";		
			echo "</table>";
		

		$FB->titulo_azul1("FROTIS SECRECION URETRAL",18,0, 5); 	
		$FB->titulo_azul1("Coloraci&oacute;n de Gram",18,0, 5);
		$FB->llena_texto("Reacci&oacute;n PMN:",$param=$param+1, 1, $DB, "", "2",@$rw[1],19, 0);
		$FB->llena_texto("C&eacute;lulas gu&iacute;a::",$param=$param+1, 1, $DB, "", "",@$rw[2], 17, 0);
		$FB->llena_texto("Levaduras:",$param=$param+1, 1, $DB, "", "",@$rw[3],4, 0);

		$FB->llena_texto("Coco Bacilo Gram Variable:",$param=$param+1, 1, $DB, "", "2", @$rw[4],19, 0);

		$FB->llena_texto("Bacilo Gram Positivo:",$param=$param+1, 1, $DB, "", "",@$rw[5],1, 0);
		$FB->llena_texto("Coco Gram Positivo:",$param=$param+1, 1, $DB, "", "",@$rw[6], 4, 0);
		$FB->llena_texto("Diplococo Gram negativo Intracelular:",$param=$param+1, 1, $DB, "", "2",@$rw[$param],19, 0);
		$FB->llena_texto("Diplococo Gram negativo Extracelular:",$param=$param+1, 1, $DB, "", "2",@$rw[$param],19, 0);
		$FB->llena_texto("Observaciones:",$param=$param+1, 1, $DB, "", "2",@$rw[$param],19, 0);
		
		$FB->titulo_azul1("TIEMPO DE SANGRIA",18,0, 5); 	
		$FB->titulo_azul1("TIEMPO DE SANGRIA-TIEMPO DE QUICK",17,0, 5);
		$FB->llena_texto("METODO MANUAL:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("VALOR DE REFERENCIA:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 1, 0);
		
		$FB->titulo_azul1("TIEMPO DE COAGULACION",18,0, 5); 	
		$FB->titulo_azul1("METODO LEE WHITE",18,0, 5);
		$FB->llena_texto("VALOR DE REFERENCIA:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		//$FB->llena_texto("VALOR DE REFERENCIA:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 6, 0);
		
		$FB->titulo_azul1("HEMOCLASIFICACION",18,0, 5); 	
		$FB->titulo_azul1("METODO LEE WHITE",18,0, 5);
		$FB->llena_texto("GRUPO SANGU&Iacute;NEO:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("FACTOR RH:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 1, 0);
		
		$FB->titulo_azul1("FROTIS SANGRE PERIFERICA",18,0, 5); 	
		$FB->titulo_azul1("METODO LEE WHITE",18,0, 5);
		$FB->llena_texto("Gl&oacute;bulos Rojos:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Gl&oacute;bulos Blancos:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 4, 0);

		$FB->llena_texto("Plaquetas:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Recuento Manual:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Recuento Manual:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Referencia:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		//$FB->llena_texto("Levaduras:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		
		$FB->titulo_azul1("SEROLOGIA VDRL",18,0, 5); 	
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>SEROLOGIA: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>N/A</td>
				<td>NO REACTIVA</td>
				<td>VDRL</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
						echo "</table>";

		
		$FB->titulo_azul1("KOH",18,0, 5); 	
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>KOH DE UÑAS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>N/A</td>
				<td>N/A</td>
				<td>N/A</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
						echo "</table>";

		

		$FB->titulo_azul1("PROTEINA C REACTIVA",18,0, 5); 	
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 	
		echo "<tr class='text' bgcolor='#FFFFFF'>";	
				echo "<td>PCR: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>mg/L</td>
				<td>Menor de 6</td>
				<td>Aglutinacion de l&aacute;tex</td></tr>";
				echo "<tr class='text' bgcolor='#FFFFFF'>";
						echo "</table>";

		
			$FB->titulo_azul1("R.A. TEST",18,0, 5); 	
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0);
		echo "<tr class='text' bgcolor='#FFFFFF'>"; 
				echo "<td>RA TEST: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>UI/ml</td>
				<td>Menor de 8</td>
				<td>Aglutinacion de l&aacute;tex</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";		
				echo "</table>";

		
		$FB->titulo_azul1("INMUNOLOGIA ASTOS",18,0, 5); 	
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>ASTOS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>UI/ml</td>
				<td>Menor de 200</td>
				<td>Aglutinacion de l&aacute;tex</td></tr>";	
				echo "</table>";

		
		$FB->titulo_azul1("PRUEBA DE EMBARAZO EN SANGRE",18,0, 5); 	
		$FB->titulo_azul1("PRUEBA DE EMBARAZO",18,0, 5);
		$FB->llena_texto("Sensibilidad-mUI/mL:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("T&eacute;cnica:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 4, 0);
		$FB->llena_texto("Muestra:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Resultado:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		
		$FB->titulo_azul1("ANTIGENO DE SUPERFICIE HBsAg",18,0, 5); 	
		$FB->titulo_azul1("HEPATITIS B ANTIGENO DE SUPERFICIE",18,0, 5);
		$FB->llena_texto("Muestra:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Sensibilidad relativa:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 4, 0);
		$FB->llena_texto("Sensibilidad espec&iacute;fica:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Concordancia general:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("RESULTADO:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		
		$FB->titulo_azul1("ANTICUERPOS HIV I - II",18,0, 5); 	
		$FB->titulo_azul1("ANTICUERPOS HIV I - II",18,0, 5);
		$FB->llena_texto("Muestra:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Sensibilidad relativa:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 4, 0);
		$FB->llena_texto("Sensibilidad espec&iacute;fica:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Concordancia general:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("RESULTADO:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		
		$FB->titulo_azul1("TOXOPLASMA IgG E.L.I.S.A",18,0, 5); 	
		$FB->titulo_azul1("TOXOPLASMA Ig G",1,0,5); 
		$FB->titulo_azul1("UNIDADES",2,0,0); 

		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>RESULTADO: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>UI/mL</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Valor de referencia: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>UI/mL</td></tr>";
				echo "</table>";

		
		$FB->titulo_azul1("ESPERMOGRAMA",18,0, 5); 	
		$FB->titulo_azul1("ESPERMOGRAMA",18,0, 5);
		$FB->llena_texto("DIAS DE ABSTINENCIA:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("HORA DE RECOLECCION:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 4, 0);
		$FB->llena_texto("VOLUMEN:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("ASPECTO:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("COLOR:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("PH:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("VISCOCIDAD:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("LICUEFACCION:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->titulo_azul1("ESTUDIO MICROSCOPICO",3,0,5); 
		$FB->titulo_azul1("MOTILIDAD",3,0,5); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>PROGRESIVA RAPIDA: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>PROGRESIVA LENTA: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";		
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>MOVIL IN SITU: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>INMOVIL: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";		
				echo "</table>";
		$FB->titulo_azul1("VITALIDAD",3,0,5); 
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>VIVOS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>MUERTOS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "</table>";
				
		$FB->titulo_azul1("MORFOLOGIA CABEZA",3,0,5); 
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>NORMAL: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>ELONGADA: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>MICROCEFALOS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>MACROCEFALOS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";			
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>BICEFALOS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "</table>";
				$FB->titulo_azul1("SEGMENTO INTERMEDIO",3,0,5); 
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>NORMAL: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "</table>";
				$FB->titulo_azul1("MORFOLOGIA COLA",3,0,5); 
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>NORMAL: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>ENROLLADA: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";	
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>CORTA: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";			
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>LARGA: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				</tr>";			

				$FB->llena_texto("RECUENTO ESPERMATICO:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
				$FB->llena_texto("LEUCOCITOS:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
				$FB->llena_texto("CELULAS GERMINALES:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
				$FB->llena_texto("HEMATIES:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
				$FB->llena_texto("COLORACION DE GRAM:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);		
		
		$FB->titulo_azul1("ANTIGENO PROSTATICO ESPECIFICO MICROELISA",18,0, 5); 	

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Antigeno Prostatico Especifico: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>ng/mL</td>
				<td>0,0-4,0</td>
				<td>Inmunofluorescencia</td></tr>";
				
				echo "</table>";

		
				
		$FB->titulo_azul1("HEMATOCRITO",18,0, 5); 	

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
				
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hematocrito: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>%</td>
				<td>39 - 51</td>
				<td></td>
				</tr>";
				echo "</table>";
		

		$FB->titulo_azul1("HORMONA TIROESTIMUlANTE tsh",18,0, 5); 	

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
				
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td></td>
				<td>Inmunofluorescencia</td></tr>";

				echo "</table>";

				
		$FB->titulo_azul1("INMUNOQUIMICA",18,0, 5); 	
		$FB->llena_texto("TECNICA:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
				
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>0,0-4,0</td>
				<td>Inmunofluorescencia</td></tr>";
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Adultos 20- 54 a&ntilde;os: 0,4 - 4,2</td>
				<td>Inmunofluorescencia</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Adultos 55-87 a&ntilde;os:0,5 - 8,9</td>
				<td>Inmunofluorescencia</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Jovenes: 4 - 19 a&ntilde;os: 0,4 - 6,2</td>
				<td>Inmunofluorescencia</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Embarazadas: 1 trimestres:0,3 - 4,5</td>
				<td>Inmunofluorescencia</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Embarazadas: 2 trimestres: 0,5 - 4,6</td>
				<td>Inmunofluorescencia</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Embarazadas: 3 trimestres: 0,8 - 5,2</td>
				<td>Inmunofluorescencia</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Ni&ntilde;os.3 A&ntilde;os:0,3 - 6,7</td>
				<td>Inmunofluorescencia</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Ni&ntilde;os 2 A&ntilde;os:0,4 - 7,6</td>
				<td>Inmunofluorescencia</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Ni&ntilde;os 1 A&ntilde;o:0,4 - 8,6</td>
				<td>Inmunofluorescencia</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Ni&ntilde;os 5 d&iacute;as:1,7 -9,1</td>
				<td>Inmunofluorescencia</td></tr>";
				echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td>Ni&ntilde;os 0 d&iacute;as:1,0 - 39</td>
				<td>Inmunofluorescencia</td></tr>";
				echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Hormona Estimulante de Tiroides -TSH: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>&#181;UI/mL</td>
				<td></td>
				<td>Inmunofluorescencia</td></tr>";

				echo "</table>";

		

		$FB->titulo_azul1("FTA-TP.PA (SERODIA)",18,0, 5); 
		$FB->titulo_azul1("ANTICUERPOS IGG - IGM e IGA anti Helicobacter pylori",18,0, 5);
		$FB->llena_texto("Muestra:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Sensibilidad relativa:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 1, 0);
		$FB->llena_texto("Concordancia general:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("RESULTADO:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("TECNICA:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);


		
		$FB->titulo_azul1("ANTICUERPOS Treponema",18,0, 5); 
		$FB->titulo_azul1("ANTICUERPOS IgA-IgG e IgM anti Treponema pallidum",18,0, 5);
		$FB->llena_texto("Muestra:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Sensibilidad relativa:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 1, 0);
		$FB->llena_texto("Concordancia general:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("RESULTADO:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("TECNICA:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		
		$FB->titulo_azul1("FROTIS GARGANTA",18,0, 5); 
		$FB->titulo_azul1("FROTIS FARINGEO",18,0, 5);
		$FB->llena_texto("Reacci&oacute;n PMN:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("C&eacute;lulas Epiteliales:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 4, 0);
		$FB->llena_texto("Bacilo Gram Positivo:",$param=$param+1, 1, $DB, "", "",@$rw[$param],17, 0);
		$FB->llena_texto("Coco Gram Positivo:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		$FB->llena_texto("Bacilo Gram Negativo:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("Coco Gram Negativo:",$param=$param+1, 1, $DB, "", "",@$rw[$param],4, 0);
		


		$FB->titulo_azul1("GLICEMIA PREPRANDIAL",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#F3F3F3'>";
		echo "<td>Glicemia Pre Prandial	</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>60-110</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";

		echo "</table>";
		

		$FB->titulo_azul1("GLICEMIA PRE Y POSPRANDIAL",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Glicemia Post Desayuno 2 Horas</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 140</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<td>Glicemia Pre Prandial	</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>60-110</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";

		echo "</table>";
		


		$FB->titulo_azul1("CURVA DE GLICEMIA  7 MUESTRAS",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#FFFFFF'>";echo "<td>Glicemia Pre Prandial	</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>60-110</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Glicemia Post Desayuno 2 Horas</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 140</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Glicemia Post Carga 75 30 minutos</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 180</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Glicemia Post Carga 75  1Hora</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 155</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Glicemia Post Carga 75 2 Hora</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 140</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Glicemia Post  Carga 75  3 Hora</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 100</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Glicemia Post Carga 75  4 Hora</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td></td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";

		echo "</table>";
		

		$FB->titulo_azul1("CURVA DE GLICEMIA  5 MUESTRAS",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#FFFFFF'>";echo "<td>Glicemia Pre Prandial	</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>60-110</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Glicemia Post Desayuno 2 Horas</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 140</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Glicemia Post Carga 75 30 minutos</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 180</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Glicemia Post Carga 75  1Hora</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 155</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Glicemia Post Carga 75 2 Hora</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>MENOR DE 140</td><td>Enzim&aacute;tico colorim&eacute;trico</td></tr>";
		echo "</table>";
		


		$FB->titulo_azul1("COLESTEROL",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Colesterol Total</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>Menor de 200</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";
		echo "</table>";
		
		$FB->titulo_azul1("TRIGLICERIDOS",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Triglic&eacute;ridos</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>Menor de 150</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";
		echo "</table>";
		

		$FB->titulo_azul1("UREA",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>UREA</td>
		<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'>
		</td><td>mg/dL</td><td>10-58</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";
		echo "</table>";
		

		$FB->titulo_azul1("COLESTEROL HDL",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Colesterol HDL</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>35-55</td><td>Precipitacion</td></tr>";
		echo "</table>";
		
		$FB->titulo_azul1("COLESTEROL LDL",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Colesterol LDL</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>Menor de 129</td><td>C&aacute;lculo</td></tr>";
		echo "</table>";
		
		$FB->titulo_azul1("COLESTEROL VLDL",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Colesterol  VLDL</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>2-30</td><td>C&aacute;lculo</td></tr>";
		echo "</table>";
		
		$FB->titulo_azul1("INDICE ARTERIAL",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>&Iacute;ndice arterial</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td></td><td>Menor de 5</td><td></td></tr>";
		echo "</table>";
		


		$FB->titulo_azul1("ACIDO URICO",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Ácido Úrico</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>H: 3,5 - 7,2  M: 2,6 - 6,0</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";

		echo "</table>";
		


		$FB->titulo_azul1("NITROGENO UREICO",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>BUN</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>5 - 24</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";

		echo "</table>";
		


		$FB->titulo_azul1("CREATININA",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Creatinina</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>0,4-1,4</td><td>Cin&eacute;tica - colorim&eacute;trica</td></tr>";
		echo "</table>";
		


		$FB->titulo_azul1("CREATININA EN ORINA",18,0, 5); 

		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Creatinina</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td></td><td></td></tr>";
		echo "</table>";
		


		$FB->titulo_azul1("FOSFATASA ALCALINA",18,0, 5); 
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Fosfatasa Alcalina</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>U/L</td><td>Ni&ntilde;os hasta 800</td><td>Colorim&eacute;trica</td></tr>";

		echo "</table>";
		

		$FB->titulo_azul1("TRANSAMINASAS",18,0, 5); 
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		//echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td></td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td></td><td>Adultos hasta 270</td><td></td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>TGO - AST</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>U/L</td><td>Hasta 40</td><td>Enzim&aacute;tico U.V.</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>TGP - ALT</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>U/L</td><td>Hasta 40</td><td>Enzim&aacute;tico U.V.</td></tr>";

		echo "</table>";
		

		$FB->titulo_azul1("BILIRRUBINA",18,0, 5); 
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Bilirrubina Total</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>Hasta1,0</td><td>Colorim&eacute;trica</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Bilirrubina Directa</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>Hasta 0,2</td><td>Colorim&eacute;trica</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Bilirrubina Indirecta</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>mg/dL</td><td>Hasta 0,8</td><td>Colorim&eacute;trica</td></tr>";

		echo "</table>";
		

		$FB->titulo_azul1("PROTEINAS",18,0, 5); 
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Proteinas Totales</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>g/dL</td><td>6,2 - 8,5</td><td>Colorim&eacute;trica</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Albumina</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>g/dL</td><td>3,5-5,3</td><td>Colorim&eacute;trica</td></tr>";
		echo "<tr class='text' bgcolor='#F3F3F3'>";	echo "<td>Globulina</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>g/dL</td><td>2,7-3,6</td><td>Colorim&eacute;trica</td></tr>";
		echo "<tr class='text' bgcolor='#FFFFFF'>";	echo "<td>Amilasa</td><td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td><td>U/L</td><td>Menor a 86</td><td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";


		echo "</table>";
		

		$FB->titulo_azul1("ANTIESTREPTOLISINAS",18,0, 5); 
		$FB->titulo_azul1("EXAMEN",1,0,5); 
		$FB->titulo_azul1("Resultado",1,0,0); 
		$FB->titulo_azul1("Unidad",1,0,0); 
		$FB->titulo_azul1("Referencia",1,0,0); 
		$FB->titulo_azul1("T&eacute;cnica",1,0,0); 

		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>ASTOS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>mg/dL</td>
				<td>Menor de 200</td>
				<td>Aglutinacion de l&aacute;tex</td></tr>";
						echo "</table>";
			
		



		$FB->titulo_azul1("TIEMPO DE PROTROMBINA",18,0, 5); 

		$FB->llena_texto("TIEMPO DE PROTROMBINA:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("CONTROL DEL DIA:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 1, 0);
		$FB->llena_texto("INR:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		

		$FB->titulo_azul1("TIEMPO PARCIAL DE TROMBOPLASTINA",18,0, 5); 
		$FB->llena_texto("TIEMPO DE PROTROMBINA - PT:",$param=$param+1, 1, $DB, "", "",@$rw[$param],1, 0);
		$FB->llena_texto("CONTROL DEL DIA:",$param=$param+1, 1, $DB, "", "",@$rw[$param], 1, 0);

		$FB->titulo_azul1("",5,0,5); 
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>Colesterol Total: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>mg/dL</td>
				<td>Menor de 200</td>
				<td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";
				
		echo "<tr class='text' bgcolor='#F3F3F3'>";
				echo "<td>Triglic&eacute;ridos: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>mg/dL</td>
				<td>Menor de 150</td>
				<td>Enzim&aacute;tica colorim&eacute;trica</td></tr>";
				
		echo "<tr class='text' bgcolor='#FFFFFF'>";
				echo "<td>ASTOS: </td>
				<td><input name='$param=$param+1' id='$param' class='form-control'  type='text' value='".@$rw[$param]."' onkeypress='return noenter();'></td>
				<td>mg/dL</td>
				<td>Menor de 200</td>
				<td>Aglutinacion de l&aacute;tex</td></tr>";
						echo "</table>";
			


if($nivel_acceso==6 or $nivel_acceso==7){ $cond="and idusuarios=$id_usuario";  } else { $cond=""; }
$FB->llena_texto("Medico:",$param=$param+1,2,$DB,"(SELECT idusuarios, usu_nombre FROM usuarios where roles_idroles in (6,7) $cond ORDER BY usu_nombre)", "", @$rw[$param], 1, 1);
$FB->titulo_azul1("OBSERVACIONES",18,0, 5);

$FB->llena_texto("",$param=$param+1,9, $DB, "", "",@$rw[$param], 1, 0);




$FB->cierra_form(); 
?>