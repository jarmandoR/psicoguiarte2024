<?php 
error_reporting(0);
include("cabezote1.php"); 
include("cabezote4.php"); 
$id_sedes=$_SESSION['usu_idsede'];
$conde1="";
if(isset($_REQUEST["ord"])){ $ord=$_REQUEST["ord"]; } else { $ord="1"; } 
if(isset($_REQUEST["asc"])){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } $asc2="ASC"; if($asc=="ASC"){ $asc2="DESC";}
?>
	<style type="text/css">
			
	 	* {
				margin:0px;
				padding:0px;
			}
			
			#header {
				margin:auto;
				width:500px;
				font-family:Arial, Helvetica, sans-serif;
			}
			
			ul, ol {
				list-style:none;
			}
			
			.nav > li {
				float:left;
			}
			
			.nav li a {
				background-color:#ecedef;
				text-decoration:none;
				padding:10px 12px;
				display:block;
			}
            .nav li a:hover {
				background-color:#f0f0f0;
			}
						
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
			}
			
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-140px;
				top:0px;
			}		 
             
		</style>
<script language="javascript">

function llena_datosord(ord, asc)
{
	destino="<?php echo $_SERVER['PHP_SELF']; ?>?ord="+ord+"&asc="+asc;
	location.href=destino;
}
function llena_datosord2(ord, asc,tabla)
{
	destino="<?php echo $_SERVER['PHP_SELF']; ?>?ord="+ord+"&asc="+asc+"&tabla="+tabla;
	location.href=destino;
}
function  buscarnotificaciones(tipo){
    datos = {"tipo":tipo};
    var numerogastos;
		$.ajax({
				url: "notificaciones.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
					//alert(result);
					if(result!=null){
    
						numerogastos= result.gastossede;
						numeroperador= result.gastosoperador;
						numeroremesas= result.gastosremesas;
						cierrecaja= result.cierrecaja;
						seguimiento= result.seguimiento;
						pendientes= result.pendientes;
					//	alert(numerogastos);
                    if(pendientes!='' && pendientes>0 ){
							var divvalor= document.getElementById("notif26");
				            divvalor.innerHTML='<i class="img-circle" style="background-color:#FF0000;width:40px;height:40px" >_ '+pendientes+'_ </i>';
						}
                    if(seguimiento!='' && seguimiento>0 ){
							var divvalor= document.getElementById("notif25");
				            divvalor.innerHTML='<i class="img-circle" style="background-color:#FF0000;width:40px;height:40px" >_ '+seguimiento+'_ </i>';
						}
						if(numerogastos!='' && numerogastos>0 ){
							var divvalor= document.getElementById("notif");
				            divvalor.innerHTML='<i class="img-circle" style="background-color:#FF0000;width:40px;height:40px" > -'+numerogastos+' -</i>';
						}

                        if(numeroperador!='' && numeroperador>0 ){
							var divvalor2= document.getElementById("notif22");
				            divvalor2.innerHTML='<i class="img-circle" style="background-color:#FF0000;width:40px;height:40px" > -'+numeroperador+' -</i>';
                        }
                        
                        if(numeroremesas!='' && numeroremesas>0 ){
							var divvalor3= document.getElementById("notif23");
				            divvalor3.innerHTML='<i class="img-circle" style="background-color:#FF0000;width:40px;height:40px" > -'+numeroremesas+' -</i>';
						}
                        console.log(cierrecaja);
                        if(cierrecaja!='' && cierrecaja>0 ){
							var divvalor4= document.getElementById("notif24");
				            divvalor4.innerHTML='<i class="img-circle" style="background-color:#FF0000;width:40px;height:40px" > -'+cierrecaja+' -</i>';
						}

                        trueorfalse=false;

					}else {
						trueorfalse=true;
					}	
				}
            });
           // console.log('josee111');
            clearTimeout(timer2);
    timer2=setTimeout(function(){buscarnotificaciones(tipo)},1200000); // 3000ms = 3s

}
</script>
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title"><i class="fa fa-user"></i> Edita tu perfil</h4>
                    </div>
                   <?php 
					$sql="SELECT usu_nombre, usu_mail FROM usuarios WHERE idusuarios='$id_usuario' ";
					$DB->Execute($sql); 
					$rw1=mysqli_fetch_row($DB->Consulta_ID);
					?>
					<form name='form2' id='form2' method='post' action='nuevo_adminok.php' enctype='multipart/form-data'>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre:</span>
                                    <input name="paramc1" id="paramc1" type="text" class="form-control" placeholder="Nombre" value="<?php echo $rw1[0]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Email:</span>
                                    <input name="paramc2" id="paramc2" type="email" class="form-control" placeholder="Ingrese email" value="<?php echo $rw1[1]; ?>">
                                </div>
                            </div>
                            <div class="form-group"><p>Si quiere modificar su contrase&ntilde;a llene los siguientes campos.</p></div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Contrase&ntilde;a Actual:</span>
                                    <input name="paramc33" id="paramc33" type="password" class="form-control" placeholder="*****">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Contrase&ntilde;a Nueva:</span>
                                    <input name="paramc3" id="paramc3" type="password" class="form-control" placeholder="******">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Foto de perf&iacute;l
                                    <input type="file" name="paramc4" />
                                </div>
                                <p class="help-block">Tama&ntilde;o: 215px x 215px</p>
                            </div>
                        </div>
                        <div class="modal-footer clearfix">
                           <?php $FB->llena_texto("tabla", 1, 13, $DB, "", "", "Edita tu perfil", 5, 0); ?>
                           <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Descartar</button>
                           <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Guardar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    <body class="skin-blue">

        <header class="header">
            <a href="inicio.php" class="logo">Inicio</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                    <?php 
                    if($nivel_acceso==1){
                        $DB_m = new DB_mssql;
                        $DB_m->conectar();
                        $DB_m1 = new DB_mssql;
                        $DB_m1->conectar();

                       $numerocomfirmar=0;
                        $gatoscomfirmar=0;
                        $remesascomfirmar=0;
                        $cierrecaja=0;
                        if($gatoscomfirmar>=1){
                            $colornoti2='background-color:#FF0000';
                        }else{
                            $colornoti2='';
                        }

                        
                        ?>
                          <!-- <li >
                            <a href="pesopendiente.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Pendientes 
                                <i id='notif26'>
                                        <?=$pendientes?>
                                </i>
                                </span>
                            </a>
                         </li>
                         <li >
                            <a href="reporteoper.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Seguimiento 
                                <i id='notif25'>
                                        <?=$seguimiento?>
                                </i>
                                </span>
                            </a>
                         </li>
                          <li >
                                <a href="cierrecaja.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Cierre 
                                    <i id='notif24'>
                                            <?=$cierrecaja?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                           <li >
                                <a href="gastos.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Remesas 
                                    <i id='notif23'>
                                            <?=$remesascomfirmar?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                            <li >
                                <a href="gastosoperador.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Gatos 
                                    <i id='notif22'>
                                            <?=$gatoscomfirmar?>
                                    </i>
                                    </span>
                                </a>
                             </li>

                                <li >
                                    <a href="cajamenor.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Confirmar 
                                        <i id='notif' >
                                                        <?=$numerocomfirmar?>
                                        </i>
                                        </span>
                                    </a>
                                </li> -->
                        
  
                        <?php 
                        }elseif($nivel_acceso==2 or $nivel_acceso==12 or $nivel_acceso==5){
                            ?>
                          <!--   <li >
                            <a href="pesopendiente.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Pendientes 
                                <i id='notif26'>
                                        <?=$pendientes?>
                                </i>
                                </span>
                            </a>
                         </li>
                            <li >
                            <a href="reporteoper.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Seguimiento 
                                <i id='notif25'>
                                        <?=$seguimiento?>
                                </i>
                                </span>
                            </a>
                         </li>

                         <?php 
                         } elseif($nivel_acceso==10){
                            
                            ?>
                             <li >
                                <a href="cierrecaja.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Cierre 
                                    <i id='notif24'>
                                            <?=$cierrecaja?>
                                    </i>
                                    </span>
                                </a>
                             </li> -->
                         <?php 
                         }                  
                           // echo '<li><a >Estado '.$estado.'<i class="caret"></a></i>
                           //          <ul>
                                        
                           //              <li><a href="cambio_adminok.php?tabla=cambioestado&condecion=almuerzo">Almorzando</a></li>
                           //              <li><a href="cambio_adminok.php?tabla=cambioestado&condecion=regreso">Regreso Almuerzo</a></li>
                           //              <li><a href="cambio_adminok.php?tabla=cambioestado&condecion=regresooficina">Regreso Oficina</a></li>';
                           //            echo "<li><a onclick='pop_dis56(1, \"Temperatura\")'; >Temperatura</a></li>";
                                        
                           //       echo '</ul>
                           //       </li>';
                            // echo "<li>";
                            // echo "<a  onclick='pop_dis55(1, \"Cotizar\")'; > Cotizar</a>";
                            //  echo "</li>";
                             if($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==10){

                                 // echo "<li>";
                                 //     echo "<a  onclick='pop_dis57(1, \"Cuentas\")'; > Cuentas</a>";
                                 // echo "</li>";

                             }elseif($id_sedes==1 and $nivel_acceso==2){

                                // echo "<li>";
                                //      echo "<a  onclick='pop_dis57(1, \"Cuentas\")'; > Cuentas</a>";
                                // echo "</li>";
                             }
                        ?>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i><span>Perfil <i class="caret"></i></span></a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
<?php 
$DB_m = new DB_mssql;
$DB_m->conectar();
$DB_m1 = new DB_mssql;
$DB_m1->conectar();
$sles="SELECT doc_ruta FROM documentos WHERE doc_tabla='Usuario' AND doc_idviene='$id_usuario' ORDER BY doc_fecha DESC ";
$DB_m->Execute($sles); 
$imagenusu=$DB_m->recogedato(0);
$nombre=explode(" ",$id_nombre);
?>
<img src="<?php echo $imagenusu; ?>" class="img-circle" alt="User Image" />
<p><?php print $id_nombre; ?><small><?php echo $rol_nombre; ?></small></p>

                                </li>                                
                                <li class="user-footer">
                                    <div class="pull-left">
                                    	<a class="btn btn-default btn-flat" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Editar Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="salir.php" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
            <aside class="left-side sidebar-offcanvas" style="min-height:550px;">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image"><img src="<?php echo $imagenusu; ?>" class="img-circle" alt="User Image" /></div>
                        <div class="pull-left info"><p>Hola, <?php print $nombre[0]." ".$nombre[1];   ?></p>
						 <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a></div>
                    </div>
                    <ul class="sidebar-menu">
<?php
 $sql="SELECT men_nombre, men_url, idmenu, men_descripcion FROM menu INNER JOIN permisos ON idmenu=menu_idmenu AND men_predecesor=0 AND roles_idroles='$nivel_acceso' AND men_orden!=0 AND per_consultar=1 ORDER BY men_orden ";
$DB_m->Execute($sql); $va=0;
while($rw_m=mysqli_fetch_row($DB_m->Consulta_ID))
{
	$id_menu=$rw_m[2]; if($rw_m[1]=="configuracion.php") { $link="#"; $class="treeview"; } else { $link=$rw_m[1];  $class="sidebar-menu"; } 
	echo "<li class='$class'><a href='$link' title='$rw_m[3]'>";
	$LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
	echo "<span> $rw_m[0]</span></a>";
    echo "<ul class='treeview-menu'>";
	 $sql="SELECT men_nombre, men_url, idmenu, men_descripcion FROM menu INNER JOIN permisos ON idmenu=menu_idmenu AND men_predecesor='$id_menu' AND 
	roles_idroles='$nivel_acceso' AND men_orden!=0 AND per_consultar=1 ORDER BY men_orden ";
	$DB_m1->Execute($sql); 
	while($rw_m1=mysqli_fetch_row($DB_m1->Consulta_ID))
	{
		if(strlen($rw_m1[0])>22){ $texts=substr($rw_m1[0],0,22)."...";  } else { $texts=$rw_m1[0]; } 
	
		if($rw_m1[1]=="adm_general.php"){ 
		echo "<li><a href='$rw_m1[1]?idmen=$rw_m1[2]&tabla=$rw_m1[0]' title='$rw_m1[0]'><i class='fa fa-angle-double-right'></i>$texts</a></li>"; 
		}
		else{
			echo "<li><a href='$rw_m1[1]?idmen=$rw_m1[2]' title='$rw_m1[0]'><i class='fa fa-angle-double-right'></i>$texts</a></li>"; 
		}
	
	} 
	echo "</ul></li>";
	$va++;
} 
?>
</ul></section></aside>
<aside class="right-side" style="min-height:550px;"> 
<?php
    if($nivel_acceso==1 or $nivel_acceso==2 or $nivel_acceso==10  or $nivel_acceso==12 or $nivel_acceso==5 ){
    ?>
<script language="javascript">
    timer2=0;
    clearTimeout(timer2);
     buscarnotificaciones(1); // 3000ms = 3s
    </script>
    <?php
    } 

    
    ?>
