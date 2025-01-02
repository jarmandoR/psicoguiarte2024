<?php 
require("login_autentica.php"); 
include("layout.php");
/* include("cabezote1.php"); 
include("cabezote4.php");  */
?>
<script src="js/jquery-2.1.0.min.js"></script>

	<script type="text/javascript">
	
 var version3 = jQuery.noConflict(); 	
 
 version3(document).ready(function(){
	//alert('joseee');

    var maxField = 10; //Input fields increment limitation
    var addButton = version3('.add_button'); //Add button selector
    var wrapper = version3('.field_wrapper'); //Input field wrapper
	var x = document.getElementById("campos").value;
	//alert(x);
    version3(addButton).click(function(){ //Once add button is clicked

	p=x%2;
	if(p==1){ color="#FFFFFF";  } else{  color="#F3F3F3"; }
	
	
	
	var field$html  = '<table width=100% ><tr bgcolor='+color+' class="trans">';
	var field$html  = field$html  + '<td>Ciudad:<select  name="param3'+x+'"  id="param3'+x+'" aling="right" ><option  value=0>Seleccione...</option>';
	var field$html  = field$html  + "<?php $sql="SELECT `idciudades`,`ciu_nombre` FROM `ciudades` "; $LT->llenaselect($sql,0,1, $para, $DB);?>";  	
	var field$html  = field$html  + '</select></td><td>Direcci&oacute;n:<select  name="param4'+x+'"  id="param4'+x+'"  ><option  value=0>Seleccione...</option>';
	var field$html  = field$html  + "<?php $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` "; $LT->llenaselect($sql,1,1, $para, $DB);?>";  	
	var field$html  = field$html  + '</select><input  type="text" name="param5'+x+'" id="param5'+x+'" value=""/></td>';
	var field$html  = field$html  +'<td>Lugar de Recogida:<select  name="param6'+x+'"  id="param6'+x+'"  ><option  value=0>Seleccione...</option>';
	var field$html  = field$html  + "<?php $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar` "; $LT->llenaselect($sql,1,1, $para, $DB);?>";  	
	var field$html  = field$html  + '</select><input type="text" name="param7'+x+'" id="param7'+x+'" value=""/></td>';
	var field$html  = field$html  +'</tr><tr bgcolor='+color+' class="trans2"><td>Barrio:<input type="text" name="param8'+x+'" id="param8'+x+'" value="" aling="right"/></td>';
	var field$html  = field$html  +'<td>Tel&eacutefono:<input type="text" name="param9'+x+'" id="param9'+x+'" value=""aling="right" /></td>'
	+'<td>Cliente:<input type="text" name="param10'+x+'" id="param10'+x+'" aling="right" value=""/></td>'
	+'</tr><tr bgcolor='+color+' class="trans2"><td>AU:<input type="text" name="param11'+x+'" id="param11'+x+'" value=""/></td>'
	+'<td>AC:<input type="text" name="param12'+x+'" id="param12'+x+'" value=""/></td>'
	+'</tr></table>'; //New input field $html  
       
	   if(x < maxField){ //Check maximum number of input fields
		    x++;  //Increment field counter
			document.getElementById("campos").value=x;//envia el numero de campos
            $(wrapper).append(field$html ); // Add field $html 
        }
    });


});


	
timer =0;
function testtimeout(nombres){
clearTimeout(timer);
imer =setTimeout(buscar(nombres),3000);
}

 function buscar(nombre) {
			
			var telefono = $("input#param2").val();
			variable = telefono.length; 

			if (variable >= 7) {
				//alert('holaaaa');
				datos = {"vlores":telefono,"tipo":"telefono"};

				$.ajax({
					url: "buscarclientes.php",
					type: "POST",
					data: datos
				}).done(function(respuesta){

					if (respuesta === null) {
						
						
					}	else {
						
						var idcliente=respuesta.idclientes;
						
						var mensaje="EL Cliente con el telefono: "+telefono+" ya Existe";
						alert(mensaje);	
						
						location.href="new_cliente.php?id_param="+idcliente+"&tabla=Clientes&condecion=2";
						
					}				
				});			
			}	
		
	}
</script>

<?php 
//echo $condecion;
if($condecion==2){
	 $sql="SELECT `idclientesdir`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`,  `cli_nombre`,`cli_clasificacion`, `cli_tipo`,cli_principal, `cli_valoraprobado`, `cli_fecharegistro`,cli_au,cli_ac,`cli_whatsap` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes WHERE  idclientes=$id_param and cli_principal=1 $cond ";		
	$DB1->Execute($sql);
	$rw=mysqli_fetch_row($DB1->Consulta_ID);
} else {
	$condecion=1;
}
//echo "wwwwwwwwwwwww".$rw[2];
$FB->abre_form("form1","newclienteok.php","post");
$FB->titulo_azul1("Destinatario",10,0, 5);  

$FB->llena_texto("CC / Nit:",1, 1, $DB, "", "", $rw[1], 1, 0);
$FB->llena_texto("Tel&eacute;fonos :",2, 120, $DB, "", "", $rw[2], 4, 1);
$FB->llena_texto("Whatsapp:",14, 121, $DB, "", "",$rw[14], 1, 1);
$FB->llena_texto("Nombre Del Cliente:", 6, 1, $DB, "", "", $rw[6], 1, 0);
$FB->llena_texto("Ciudad:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`)", "", "$rw[4]", 4, 1);
//$FB->llena_texto("Direccion:",5, 1, $DB, "", "", $rw[5], 1, 0);

@$direcc=explode("&",$rw[5]);
@$param5=$direcc[0];
@$param51=$direcc[1];
@$param19=$direcc[2];
@$param20=$direcc[3];
@$param23=$direcc[4];

	echo "<tr bgcolor='#FFFFFF' ><td>Direcci&oacute;n:</td>
	<td align='right' ><select class='trans'  name='param5' id='param5'  class='form-control' type='number' style='line-height:10px;' required>";
	echo "<option  value=''>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();'>
	</td>";

	echo "<td>Lugar de Recogida:</td>
	<td align='right' ><select class='trans'  name='param19' id='param19' >";
	echo "<option  value=''>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();'>
	</td>
	</tr>";

$FB->llena_texto("Barrio:", 23, 1, $DB, "", "",$param23, 17, 0);	
$FB->llena_texto("Email:", 3, 111, $DB, "", "", $rw[3], 4, 0);	
if($nivel_acceso==1){
$FB->llena_texto("Valor Autorizado:",25, 118, $DB, "", "", $rw[10], 1, 0);
}else{
	$FB->llena_texto("param25",1, 13, $DB, "", "", $rw[10],2,0);
}

$FB->llena_texto("&#191;Credito?:", 7, 212, $DB, "", "3",$rw[7], 4, 0);	
$FB->llena_texto("AU:",26, 1, $DB, "", "", $rw[12], 17, 0);
$FB->llena_texto("AC:",27, 1, $DB, "", "", $rw[13], 4, 0);
//$FB->llena_texto("¿Servicio con Retorno?:", 24, 212, $DB, "", "3",$rw[7],4, 0);	
$FB->cierra_tabla(); 	
	
echo '<div class="field_wrapper">
	<a href="javascript:void(0);" class="add_button" title="Add field"><img src="img/agregar.jpg"/>AGREGAR</a>';
	echo"<table width='100%'  ><tr bgcolor='#074F91' class=''><td colspan='8' width='' align='center'   style='color:#FFFFFF' >AGREGAR DIRECCI&Oacute;N</td></tr>";
	
	$campos=1;
	if($condecion==2){
	 $sql="SELECT `idclientesdir`,`cli_idciudad`,  `cli_direccion`,  `cli_telefono`,  `cli_nombre`,  `cli_au`,  `cli_ac` FROM  clientesdir  WHERE  cli_idclientes=$id_param and cli_principal=0 ";		
	$DB1->Execute($sql);
	$va=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
		 $id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#EFEFEF";} else{$color="#FFFFFF";}
		
		@$direcc=explode("&",$rw1[2]);
		@$param4=$direcc[0];
		@$param5=$direcc[1];
		@$param6=$direcc[2];
		@$param7=$direcc[3];
		@$param8=$direcc[4];
		
		echo  '<tr bgcolor='.$color.' class="trans">';
		echo "<td>Ciudad:<select name='param3$va'  id='param3$va'  ><option  value=0>Seleccione...</option>";
		$sql="SELECT `idciudades`,`ciu_nombre` FROM `ciudades` "; 
		$LT->llenaselect($sql,0,1, $rw1[1], $DB);  	
		echo '</select></td><td>Direcci&oacute;n:<select  name="param4'.$va.'"  id="param4'.$va.'"  ><option  value=0>Seleccione...</option>';
		$sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` "; 
		$LT->llenaselect($sql,1,1, $param4, $DB); 	
		echo '</select><input  type="text" name="param5'.$va.'" id="param5'.$va.'" value="'.$param5.'"/></td>';
		echo '<td>Lugar de Recogida:<select  name="param6'.$va.'"  id="param6'.$va.'"  ><option  value=0>Seleccione...</option>';
		$sql="SELECT `idlugar`, `lug_nombre` FROM `lugar` "; 
		$LT->llenaselect($sql,1,1, $param6, $DB);  	
		echo '</select><input type="text" name="param7'.$va.'" id="param7'.$va.'" value="'.$param7.'"/></td>';
		echo '</tr><tr bgcolor='.$color.' class="trans2"><td>Barrio:<input type="text" name="param8'.$va.'" id="param8'.$va.'" value="'.$param8.'"/></td>';
		echo '<td>Tel&eacutefono:<input type="text" name="param9'.$va.'" id="param9'.$va.'" value="'.$rw1[3].'"/></td>
		<td>Cliente:<input type="text" name="param10'.$va.'" id="param10'.$va.'" value="'.$rw1[4].'"/></td>
		</tr><tr bgcolor='.$color.' class="trans"><td>AU:<input type="text" name="param11'.$va.'" id="param11'.$va.'" value="'.$rw1[5].'"/></td>
		<td>AC:<input type="text" name="param12'.$va.'" id="param12'.$va.'" value="'.$rw1[6].'"/></td>
		<input type="hidden" name="paramid'.$va.'" id="paramid" value="'.$id_p.'">
		</tr>'; //New input field $html  
		
		}
	
	$campos=$va;
	$campos++;
	}
	
	echo '<input type="hidden" name="campos" id="campos" value="'.$campos.'">
			<input type="hidden" name="inserta" id="inserta" value="'.$va.'">
		 <input type="hidden" name="id_param" id="id_param" value="'.$id_param.'">
		 <input type="hidden" name="id_param0" id="id_param0" value="'.$rw[0].'">
		<input type="hidden" name="condecion" id="condecion" value="'.$condecion.'">
		</table>';
	echo '</div>';

echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'>
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip'  onClick='javascript:history.back();' value='Cerrar' style='width:190px;' > 
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit' id='enviar' name='enviar' value='GUARDAR' style='width:190px;' >
	</td>
	</tr>";

	
include("footer.php");
?>