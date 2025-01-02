<?php 
require("login_autentica.php"); 
include("layout.php");
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <!--CSS-->    
    <link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="media/font-awesome/css/font-awesome.css">
    <!--Javascript-->    
    <script src="media/js/jquery.dataTables.min.js"></script>
    <script src="media/js/dataTables.bootstrap.min.js"></script>          
    <script src="media/js/lenguajeusuario.js"></script>     
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
    </script>   
</head>

<body>
<div class="col-md-8 col-md-offset-2">
    <h1>Usuarios
        <a href="registrousuario.php" class="btn btn-primary pull-right menu"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo usuario</a>
    </h1>  
</div>
<div class="col-md-8 col-md-offset-2">    
    <table id="clientes" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Idusuarios</th>
            <th>Esuario</th>
            <th>Nombre</th>
            <th>Email</th>               
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        <tr>
            <th>Idusuarios</th>
            <th>Esuario</th>
            <th>Nombre</th>
            <th>Email</th>               
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
    </table>        
</div>
</body>
</html>
