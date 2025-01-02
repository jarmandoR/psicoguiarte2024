

<script type="text/javascript">

	function red(){
  
   window.location.href='editaruserhuellas.php';

   // window.alert("Hello world!");
   }

red();

</script>

<?php
require("login_autentica.php");
include("declara.php");
@$accion=$_REQUEST["accion"];
$fechatiempo=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");


 function subirimagen($var,$tipo){

 if ($var!=''){

            $carpeta="$tipo";

			move_uploaded_file($var["tmp_name"],"./".$carpeta."/".$var["name"]);

		// $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";
			$imagen = $var["name"]; 

	    }else{

        $imagen = ""; 
	    }
	     return $imagen;

}


 

// function subirimagen($var,$tipo){

//  // if ($var!=''){

// 			move_uploaded_file($var["tmp_name"],"./huella/imagenes/".$tipo."/".$var["name"]);

// 		// $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";
// 			$imagen = $var["name"]; 

// 	    // }else{

             

//      // 	$imagen = ""; 

         
// 	    // }
// 	     return $imagen;

// }

// if($accion==1){
$sles="SELECT  `ext` FROM `usuarios_huella` where id ='$id_param' ";
	    	// $sles="SELECT doc_ruta FROM documentos WHERE doc_tabla='hojadevida' AND doc_idviene='$rw[0]' and doc_version=1 ORDER BY doc_fecha DESC ";


		$DB1->Execute($sles); 
		$fotoactual=$DB1->recogedato(0);  

	
// if($_FILES["param101"]["name"]!=""){

		
			// $QL->addDocumento1($_FILES["param101"], 1, "hojadevida", $vinculo, "hojadevida", $DB);// foto

$foto=subirimagen($_FILES["param101"],"huella/imagenes");
         // echo"si llego foto";
		
		// }else{

        
  //        $foto=$fotoactual; 
	 // // echo"no llego foto";
	
        
		// }
	


		echo$sql1="UPDATE usuarios_huella set `documento`='$param5',`nombre_completo`='$param2', `ext`='".$foto."' where id= '$id_param' ";
			$DB1->Execute($sql1);

		// $vinculo=$DB->Executeid($sql1);

	
       
       // header ("editaruserhuellas.php");
       if($sql1) {
       	echo'<script type="text/javascript" > red(); </scrpt>';
       }
		

		 // $caso='datoslaborales';	
		
       ?> 



