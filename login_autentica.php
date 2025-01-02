<?php
require("connection/conectarse.php");
require("connection/arrays.php");
require("connection/funciones.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
require("connection/PasswordHash.php");
require("definirvar.php");
date_default_timezone_set("America/Bogota");

if (isset($_POST["user"]) && isset($_POST["pass"])) 
{
	
	$DBss = new DB_mssql;
	$DBss->conectar();
	

	$passw=md5($_POST["pass"]);
 	$usuario=mysqli_real_escape_string($DBss->Conexion_ID,$_POST['user']);
	if($usuario==''){
			$usuario=$_POST['user'];
	} 

	 //echo $_POST['user'];
 	  $query = "SELECT idusuarios, idroles, usu_usuario,usu_usuario, usu_pass, usu_nombre, rol_nombre,usu_idsede FROM usuarios INNER JOIN roles ON roles_idroles=idroles AND usu_usuario='$usuario' AND 
	usu_pass='$passw' AND usu_estado=1";
	$DBss->Execute($query); 
	/* printf("Errormessage: %s\n", $DBss->Execute($query));
	$row = mysqli_fetch_array($DBss->Consulta_ID); 
	echo "joseli".$row["rol_nombre"]; */
	 $numusu=$DBss->numregistros();            
	
	if($numusu>0){

		$row = mysqli_fetch_array($DBss->Consulta_ID); 
		$storedPassword = $row['usu_pass'];
		$salt = "citas2344fsdfd";
		$postedPassword=mysqli_real_escape_string($DBss->Conexion_ID,md5($_POST['pass']));
		$saltedPostedPassword = $salt . $postedPassword;
		$hasher = new PasswordHash(8,false);
		$saltedPostedPassword = $hasher->HashPassword($saltedPostedPassword);
		$pass=md5($_POST['pass']);
		$check = $hasher->CheckPassword($saltedPostedPassword, $storedPassword);
		//header ("Location: seleccionar_destino.php");
//		if($pass==$storedPassword){
//		if($check){
	

			session_name("projecst2344fsdfd");
			session_start(); 
			$id_ses=session_id();		
			session_cache_limiter('nocache,private');
			$_SESSION['usuario_rol']=$row["idroles"];
			$_SESSION['usuario_login']=$_POST['user'];
			$_SESSION['token'] = md5(rand().$_SESSION['usuario_login']);
			$_SESSION['usuario_nombre']=$row["usu_nombre"];
			$_SESSION['usuario_id']=$row["idusuarios"];
			$_SESSION['rol_nombre']=$row["rol_nombre"];
			$_SESSION['usu_idsede']=$row["usu_idsede"];
			$_SESSION['inicio']='1';
			$act="UPDATE usuarios SET usu_token='".$_SESSION['token']."' WHERE usu_usuario='".$_SESSION['usuario_login']."'";
			$DBss->Execute($act);
			$DBss->cerrarconsulta();
			//if($numusu>1){ 
				//header ("Location: seleccionar_rol.php"); }
			//else {
				
				header ("Location: seleccionar_destino.php"); 
				//}
//		}
	}
	else{ 
		//echo "dos";
		header ("Location: index.php?error_login=2");
	}
}	
else 
{

	session_name("projecst2344fsdfd");
	session_start();
	if(!empty($_SESSION['usuario_login']) && !empty($_SESSION['token'])) {
		$DBss = new DB_mssql;
		$DBss->conectar();
		$_SESSION['usuario_login']=mysqli_real_escape_string($DBss->Conexion_ID,$_SESSION['usuario_login']);
		$_SESSION['token']=mysqli_real_escape_string($DBss->Conexion_ID,$_SESSION['token']);
		$query="SELECT idusuarios FROM usuarios WHERE usu_usuario='".$_SESSION['usuario_login']."' AND usu_token='".$_SESSION['token']."'";
		$DBss->execute($query);
		if($DBss->numregistros()<20){
			$_SESSION['token']= md5(rand().$_SESSION['usuario_login']);
			$act="UPDATE usuarios SET usu_token='".$_SESSION['token']."' WHERE usu_usuario='".$_SESSION['usuario_login']."'";
			$DBss->Execute($act);
			$DBss->cerrarconsulta();
		} else {
			$DBss->cerrarconsulta();
			session_destroy();
			header("Location:index.php?error_login=8");
			exit;
		}
	}
	else {		
		session_destroy();
		header("Location:index.php?error_login=8");
		exit;
	}
}
?>