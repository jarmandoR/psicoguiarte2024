<script type="text/javascript">
function generarcodigo(dato)
{
    if(dato==1){
        p1=document.getElementById('id_param').value;
    }else{
        p1=dato;
    }	

	destino="phpqrcode/ticket3.php?codigoguia="+p1+"&modulo=2";

	window.location=destino;
	
}
function validaroper()
{
    var idoper= document.getElementById("param2").value;

    if(idoper==''){
        alert('Seleccione el operario');
        return false;
    }else{
        return true;
    }
}
function validarguia3()
{

var valorguia= document.getElementById("param34").value;
var idguia= document.getElementById("id_param2").value;
	var guia="";
	var trueorfalse = false;	
		datos = {"vlores":valorguia,"tipo":"1","idguia":idguia};
		$.ajax({
				url: "validarguia.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
					guia= result.ser_guiare;
					alert("EL NUMERO DE GUIA "+guia+" YA EXISTE");
					if(guia!=''){
					trueorfalse=false;
					}else {
						trueorfalse=true;
					}
				}
			});
			
			if(trueorfalse==false){
        		return false;
		
			}else {
				return trueorfalse;
			}
}
function validarguia2()
{
    return true;
}


function devolver(id){

	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub3");
}
function pop_dis(id, tabla){
	$("#myModal").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub3");
}
function pop_general(id, tabla,idparam){
	$("#myModal0").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&id_param2="+idparam, "llena_sub0");
}
function pop_general2(id, tabla,idparam){
	$("#myModal02").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&id_param2="+idparam, "llena_sub03");
}
function pop_dis1(id, tabla,dir){
	$("#myModal1").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&dir="+dir, "llena_sub2");
}
function pop_dis2(id, tabla){
	$("#myModal2").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub3");
}
function pop_dis3(id, tabla){
	
	$("#myModal3").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub4");
}
function pop_dis4(id, tabla){
	$("#myModal4").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub5");
}
function pop_dis5(id, tabla){
	$("#myModal5").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub7");
}
function pop_dis6(id, tabla, ide){
    $("#myModal6").modal("show");
    
	destino="detalle_pop.php?id_param="+id+"&tabla="+tabla+"&ide="+ide;
	MostrarConsulta(destino, "llena_sub6");
}
function pop_dis16(id, tabla, ide){
    $("#myModal").modal("show");
	destino="detalle_pop.php?id_param="+id+"&tabla="+tabla+"&ide="+ide;
	MostrarConsulta(destino, "llena_sub1");
}
function pop_dis17(id, tabla, ide){
    $("#myModal01").modal("show");
	destino="detalle_pop.php?id_param="+id+"&tabla="+tabla+"&ide="+ide;
	MostrarConsulta(destino, "llena_sub33");
}
function pop_dis7(id, tabla, ide, iee){
	$("#myModal6").modal("show");
	destino="detalle_pop.php?id_param="+id+"&tabla="+tabla+"&ide="+ide+"&iee="+iee;
	MostrarConsulta(destino, "llena_sub6");
}
function pop_dis81(id, sql){
	$("#myModal3").modal("show");
	destino="detalle_pop.php?id_param="+id+"&tabla=Actividad&"+"&sql="+sql;
	MostrarConsulta(destino, "llena_sub4");
}
function pop_dis8(id, tabla,idciudad){
	$("#myModal8").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad, "llena_sub8");
}
function pop_dis9(id, tabla){
//	$("#myModal9").modal("show");
//	MostrarConsulta2("resultados1.php?cond=60&id_param="+id, "comentario");
//	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub9");
}
function pop_dis10(id, tabla,idciudad){
	$("#myModal23").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad, "llena_sub11");
}

function pop_dis100(id,tabla,idciudad,param1,param2){
   
//   var tablas =  tabla;
  $("#myModal23").modal("show"); 

  if (tabla=="verquincena") {
    $('#guardarcam').hide();
  }
  
  
//   alert("holi");
  MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad+"&param1="+param1+"&param2="+param2, "llena_sub11");
}
function pop_dis111(id, tabla,idciudad,param1,param2){
  $("#myModal111").modal("show"); 
  MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad+"&param1="+param1+"&param2="+param2, "llena_sub11");
}
function pop_dis101(id, tabla,idciudad,param1,param2,param3,param4){
  $("#myModal23").modal("show"); 
  MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad+"&param1="+param1+"&param2="+param2+"&param3="+param3+"&param4="+param4, "llena_sub11");
}
function pop_dis11(id, tabla,dir,pagina,param=0){
	$("#myModal7").modal("show"); 
    document.forms['form16'].action = pagina;
    //form16.setAttribute('action', dir);
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&dir="+dir+"&id_param2="+param, "llena_general");
}
function pop_dis55(id, tabla){
	$("#cotizar").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub55");
}
function pop_dis56(id, tabla){
	$("#pantallacel").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub56");
}
function pop_dis57(id, tabla){
	$("#cuentas").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub57");
}
function pop_dis13(id, tabla){
	
	$("#myModa23").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub4");
}

function pop_dis21(id, tabla,param1,param2,param3,param4){
	$("#myModal21").modal("show"); 
	destino="detalle_pop.php?id_param="+id+"&tabla="+tabla+"&param1="+param1+"&param2="+param2+"&param3="+param3+"&param4="+param4;
	window.open(destino,"frame1");
}

function pop_dis22(id, tabla){
	$("#myModal22").modal("show"); 
	destino="detalle_pop1.php?id_param="+id+"&tabla="+tabla;
	window.open(destino,"frame2");
}
function pop_dis24(id, tabla,idciudad){
	$("#myModal2").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad, "llena_sub3");
}
function pop_dis25(id, tabla,idciudad,valordos){

	var valordos2 = JSON.stringify(valordos);
	var fecharecierre = document.getElementById('param4').value;
    console.log(idciudad);
	$("#myModal66").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad+"&valordos="+valordos2+"&fecharecierre="+fecharecierre, "llena_sub31");
}
function pop_dis26(id, tabla,idciudad,valordos,varcal){

var valordos2 = JSON.stringify(valordos);
var varcal2 = JSON.stringify(varcal);
var fecharecierre = document.getElementById('param4').value;
$("#myModal66").modal("show"); 
MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad+"&valordos="+valordos2+"&fecharecierre="+fecharecierre+"&varcal="+varcal2,"llena_sub31");
}
function pop_dis27(id, tabla,idciudad,url){
	$("#myModal2").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&idciudad="+idciudad+"&url="+url, "llena_sub3");
}
function pop_dis133(id, tabla){

	$("#myModa24").modal("show"); 
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub44");
}


function pop_ver(id, tabla){
	$('#popup').fadeIn('slow');
	$('.popup-overlay').fadeIn('slow');
	$('.popup-overlay').height($(window).height());
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla, "llena_sub");
}
function pop_ver1(id, tabla, valor, condecion){
	$('#popup').fadeIn('slow');
	$('.popup-overlay').fadeIn('slow');
	$('.popup-overlay').height($(window).height());
	MostrarConsulta("detalle_pop.php?id_param="+id+"&tabla="+tabla+"&valor="+valor+"&condecion="+condecion, "llena_sub");
}
function pop_close(){
	$('#popup').fadeOut('slow');
	$('.popup-overlay').fadeOut('slow');
}

</script>

<style type="text/css">
/*
Full screen Modal 
*/
.fullscreen-modal .modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
}
@media (min-width: 768px) {
  .fullscreen-modal .modal-dialog {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .fullscreen-modal .modal-dialog {
    width: 970px;
  }
}
@media (min-width: 1200px) {
  .fullscreen-modal .modal-dialog {
     width: 1170px;
  }
}



 </style>
 <style type="text/css">
 
 /* El tooltip */
.cssToolTip span {
    background: rgba(20,20,20,0.9) url('img/info.gif') center left 5px no-repeat; 
    border: 2px solid #87cefa;
    border-radius: 5px;
    box-shadow: 5px 5px 5px #333;
    color: #87cefa;
    display: none; /* El tooltip por defecto estara oculto */
    font-size: 0.8em;
    padding: 10px 10px 10px 35px;
    max-width: 6000px;
    position: absolute; /* El tooltip se posiciona de forma absoluta para no modificar el aspezto del resto de la pagina */
    top: 15px; /* Posicion apartir de la parte superior del primer elemento padre con posicion relativa */
    left: 100px; /* Posicion apartir de la parte izquierda del primer elemento padre con posicion relativa */
    z-index: 100; /* Poner un z-index alto para que aparezca por encima del resto de elementos */
}

/* El tooltip cuando se muestra */
.cssToolTip:hover span {
    display: inline; /* Para mostrarlo simplemente usamos display block por ejemplo */
}
 </style>

<div id="validarvalor" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
      <!-- dialog buttons -->
	  <div id="mensajevalor" class="alert alert-danger"  >HA SOBRE PASADO EL CUPO DEL PRESTAMO, POR FAVOR VERIFIQUE LAS CUENTAS DEL CLIENTE</div>
      <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>
<div id="mensaje" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
      <!-- dialog buttons -->
	  <div id="mensajevalor3" class="alert alert-success"  >Alerta</div>
      <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>
<div id="enviarmensaje" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
      <!-- dialog buttons -->
	  <div id="mensajevalor2" class="alert alert-danger"  >Alerta</div>
      <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>

<div id="popup" style="display: none;">
    <div class="content-popup">
    <div class="close"><a href="#" id="close" onClick="pop_close();"><img src="img/close.png"/></a></div>
	<div id="llena_sub"></div>
    </div>
</div>
<div class="popup-overlay"></div>

<div id="myModal6" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub6"></div></div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" >
	<form name='form12' id='form12' method='post' action='nuevo_adminok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
       <div class="modal-content" style="width:1000px; left:-15%">
            <div class="modal-body"><div id="llena_sub1"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>
    </form>
</div>

<div id="myModal01" class="modal fade" >
	<form name='form11' id='form11' method='post' action='newhojadevidaok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
       <div class="modal-content" style="width:1000px; left:-15%">
            <div class="modal-body"><div id="llena_sub33"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" >Guardar Cambios</button>
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal23" class="modal fade" >
	<form name='form22' id='form22' method='post' action='confirmarok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
       <div class="modal-content" style="width:1000px; left:-15%">
            <div class="modal-body"><div id="llena_sub11"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="guardarcam" class="btn btn-primary" onclick="form22.submit();">Guardar Cambios</button>
            </div>
        </div>
    </div>
    </form>
</div>

<div id="myModal111" class="modal fade" >
	<form name='form22' id='form22' method='post' action='confirmarok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
       <div class="modal-content" style="width:1000px; left:-15%">
            <div class="modal-body"><div id="llena_sub11"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" onclick="form22.submit();">Guardar Cambios</button>
            </div>
        </div>
    </div>
    </form>
</div>

<div id="myModal0" class="modal fullscreen-modal fade" >
	<form name='form3' id='form3' method='post' action='pesarok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-body"><div id="llena_sub0"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" ><i class="fa fa-check"></i> GUARDAR</button>
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal02" class="modal fullscreen-modal fade" >
	<form name='form03' id='form03' method='post' action='pesarok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-body"><div id="llena_sub03"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" onclick="form3.submit();"><i class="fa fa-check"></i> GUARDAR E IMPRIMIR</button>
<!--                 <button type="submit" class="btn btn-primary  pull-left" onclick="generarcodigo(1);"><i class="fa fa-check"></i> CODIGO BARRAS</button>
 --> 
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal1" class="modal fade" >
	<form name='form4' id='form4' method='post' action='verificacionok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub2"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" ><i class="fa fa-check"></i> Verificado</button>

 
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal2" class="modal fade" >
	<form name='form5' id='form5' method='post' action='asignarok.php' enctype='multipart/form-data' onsubmit='return validaroper();'>
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub3"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" ><i class="fa fa-check"></i> Asignar</button>

            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal66" class="modal fade" >
	<form name='form15' id='form15' method='post' action='nuevo_adminok.php' enctype='multipart/form-data'>
	
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub31"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" onclick="form15.submit();"><i class="fa fa-check"></i> Asignar</button>

            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal7" class="modal fullscreen-modal fade" >
	<form name='form16' id='form16' method='post' action='#' enctype='multipart/form-data' onsubmit='return validarguia3();' >
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-body"><div id="llena_general"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" ><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal8" class="modal fade" >
	<form name='form6' id='form6' method='post' action='reasignarok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub8"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" onclick="form6.submit();"><i class="fa fa-check"></i> Reasignar</button>

            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModa23" class="modal fullscreen-modal fade" >
	<form name='form7' id='form7' method='post' action='recogerok.php' enctype='multipart/form-data' >
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-body"><div id="llena_sub4"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" id="cerrar" class="btn btn-primary  pull-left" ><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModa24" class="modal fullscreen-modal fade" >
	<form name='form12' id='form12' method='post' action='recogerok.php' enctype='multipart/form-data'  onsubmit='return validarguia2();'  >
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-body"><div id="llena_sub44"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" ><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal3" class="modal fade" >
	<form name='form77' id='form77' method='post' action='recogerok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%" >
            <div class="modal-body"><div id="llena_sub4"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" ><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal4" class="modal fade" >
	<form name='form8' id='form8'  enctype='multipart/form-data'>
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub5"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary  pull-left" onclick="javascript:mi_funcion();"><i class="fa fa-check"></i> Imprimir</button>

            </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal5" class="modal fade" >
	<form name='form9' id='form9' method='post' action='' enctype='multipart/form-data'>
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub7"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
               </div>
        </div>
    </div>
    </form>
</div>
<div id="myModal21" class="modal fade" >
	<form name='form10' id='form10' method='post' action='cambio_adminok.php' enctype='multipart/form-data'>
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content" style="width:100%; left:0%">
        	<div class="modal-body">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>&nbsp;&nbsp;
            <iframe id="frame1" name="frame1" height="460px" width="100%" frameborder="0"></iframe></div>
            <div class="modal-footer"><button type="button" id="cerrar" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
        </div>
    </div>
    </form>
</div>
<div id="myModal22" class="modal fade" >
	<form name='form11' id='form11' method='post' action='cambio_adminok.php' enctype='multipart/form-data'>
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content" style="width:100%; left:0%">
        	<div class="modal-body">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>&nbsp;&nbsp;
            <iframe id="frame2" name="frame2" height="460px" width="100%" frameborder="0"></iframe></div>
            <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
        </div>
    </div>
    </form>
</div>

<div id="myModal44" class="modal fade" >
	<form name='form14' id='form14' method='post' action='cambio_adminok.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub66"></div></div>
            <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
        </div>
    </div>
    </form>
</div>
<div id="myModal55" class="modal fade" >
	<form name='form13' id='form13' method='post' action='detalle_resultados61x.php' enctype='multipart/form-data'>
    <div class="modal-dialog">
       <div class="modal-content" style="width:800px; left:0%">
            <div class="modal-body"><div id="llena_sub5"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" onclick="form13.submit();">Exportar</button>
            </div>
        </div>
    </div>
   </form>
</div>

<div id="myModalinicio" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
      <!-- dialog buttons -->

     <!--banner flotante -->
             <!-- <img src="img/credito.png" width="100%" height="170%"> -->

      <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>
<div id="cotizar" class="modal fullscreen-modal fade">
  <div class="modal-dialog">
  <div class="modal-content" style="width:800px; left:0%">
      <!-- dialog buttons -->
      <div class="modal-body"><div id="llena_sub55"></div></div>
      <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>

<div id="cuentas" class="modal fullscreen-modal fade">
  <div class="modal-dialog">
  <div class="modal-content" style="width:800px; left:0%">
      <!-- dialog buttons -->
      <div class="modal-body"><div id="llena_sub57"></div></div>
      <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>
<div id="pantallacel" class="modal fullscreen-modal fade">
<!-- 
 -->
  <div class="modal-dialog">
  <div class="modal-content" style="width:300px; left:0%">
      <!-- dialog buttons -->
      <form name='form23' id='form23' method='post' action='nuevo_adminok.php' enctype='multipart/form-data'>
      <div class="modal-body"><div id="llena_sub56"></div></div>
     
      <div class="modal-footer"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" onclick="form23.submit();">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>




