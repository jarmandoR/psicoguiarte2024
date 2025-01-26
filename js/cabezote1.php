<?php
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$rol_nombre=$_SESSION['rol_nombre'];
$id_sedes=$_SESSION['usu_idsede'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;
$param_edicion=1; $rcrear=1;  

?>
<!DOCTYPE html>
<html>
<head>


<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/paginar.css" rel="stylesheet" type="text/css" />
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> 

<script language="JavaScript" type="text/javascript" src="js/ajax.js"></script>
<script language="JavaScript" type="text/javascript" src="js/consultas_js.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.min.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/bootstrap.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/AdminLTE/app.js"></script> 

<!-- <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script language="JavaScript" type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> 
<script language="JavaScript" type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script> 
 -->
<link href="dist/css/select2.min.css" rel="stylesheet" />
<link href="dist/css/select2-bootstrap.css" rel="stylesheet">
<script src="dist/js/select2.min.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
  </script>
<script>expanded = false;</script>
<script type="text/javascript">



function popup (URL){ window.open(URL,"ventana1","width=1000, height=600, scrollbars=yes, menubar=no, location=no, resizable=no") } 
function popup2 (URL){ window.open(URL,"ventana1","width=1200, height=650, scrollbars=yes, menubar=no, location=no, resizable=no") } 
</script>	
<link rel="shortcut icon" href="images/fondo4.png" />
<title>Bermudas intranet</title >
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head><body>


