<?php
require("login_autentica.php");
include("declara.php");
$param1=$_POST["param1"];
$param2=$_POST["param2"];
$param3=$_POST["param3"];


// $sql3="SELECT count(*) FROM  `unicapaci` WHERE unicapaci_idcarpeta='$param3' and unicapaci_idrol = '$param1'";
//         $DB->Execute($sql3);
// 	    $rw3=mysqli_fetch_row($DB->Consulta_ID);

echo$sql2="SELECT unicapaci_estado,unicapaci_id  FROM  `unicapaci` WHERE unicapaci_iddocum='$param2' and unicapaci_idrol = '$param1'";
        $DB->Execute($sql2);
	    $rw6=mysqli_fetch_row($DB->Consulta_ID);
         // $cant	=mysqli_num_rows($rw6);


		 if ($rw6[0]==1) {


			echo$sel="UPDATE `unicapaci` SET `unicapaci_estado`= '0' WHERE unicapaci_id ='$rw6[1]'";
			   $DB->Execute($sel);
   
			   # code...
		   }elseif ($rw6[0]==0 and $rw6[1]!=0) {
			   # code...
   
		   echo$sel="UPDATE `unicapaci` SET `unicapaci_estado`= '1' WHERE unicapaci_id ='$rw6[1]'";
			   $DB->Execute($sel);
   
		   }elseif ($rw6[0]==0 and $rw6[1]==0) {


          echo$sel="INSERT INTO `unicapaci`( `unicapaci_iddocum`, `unicapaci_idrol`,`unicapaci_estado`) VALUES ('$param2','$param1',1)";
			$DB->Execute($sel);



	    	# code...
	    }
        echo$rw6[0];









   //          $sel="INSERT INTO `unicarpetas`( `unicar_idcarpeta`, `unicarp_idrol`,`unicar_estado`) VALUES ('$param2','$param1',1)";
			// $DB->Execute($sel);



			// $sel="UPDATE `unicarpetas` SET `unicar_id`='[value-1]',`unicar_idcarpeta`='[value-2]',`unicar_iddocumento`='[value-3]',`unicarp_idrol`='[value-4]' WHERE 1";
			// $DB->Execute($sel);
	
?>