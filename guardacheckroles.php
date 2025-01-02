<?php
require("login_autentica.php");
include("declara.php");
$param1=$_POST["param1"];
$param2=$_POST["param2"];


$sql3="SELECT count(*) FROM  `subrol` WHERE idrol_subrol='$param2' and subrol_subrol = '$param1'";
        $DB->Execute($sql3);
	    $rw3=mysqli_fetch_row($DB->Consulta_ID);

echo$sql2="SELECT estado_subrol,id_subrol FROM  `subrol` WHERE idrol_subrol='$param2' and subrol_subrol = '$param1'";
        $DB->Execute($sql2);
	    $rw6=mysqli_fetch_row($DB->Consulta_ID);
         // $cant	=mysqli_num_rows($rw6);


	    if ($rw3[0]==""or$rw3[0]==0) {


          echo$sel="INSERT INTO `subrol`( `idrol_subrol`, `subrol_subrol`,`estado_subrol`) VALUES ('$param2','$param1',1)";
			$DB->Execute($sel);



	    	# code...
	    }else{


        if ($rw6[0]==1) {


         echo$sel="UPDATE `subrol` SET `estado_subrol`= '0' WHERE id_subrol ='$rw6[1]'";
			$DB->Execute($sel);

	    	# code...
	    }else if ($rw6[0]==0) {
	    	# code...

        $sel="UPDATE `subrol` SET `estado_subrol`= '1' WHERE id_subrol ='$rw6[1]'";
			$DB->Execute($sel);

	    }


	    } 
        echo$rw6[0];









   //          $sel="INSERT INTO `unicarpetas`( `unicar_idcarpeta`, `unicarp_idrol`,`unicar_estado`) VALUES ('$param2','$param1',1)";
			// $DB->Execute($sel);



			// $sel="UPDATE `unicarpetas` SET `unicar_id`='[value-1]',`unicar_idcarpeta`='[value-2]',`unicar_iddocumento`='[value-3]',`unicarp_idrol`='[value-4]' WHERE 1";
			// $DB->Execute($sel);
	
?>