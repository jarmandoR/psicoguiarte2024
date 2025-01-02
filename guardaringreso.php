<?php
require("login_autentica.php");
include("cabezote3.php"); 

;

$fechaHoraActual = date('Y-m-d H:i:s');

$fechaActual = date('Y-m-d');
$horaActual = date('H:i:s');





$idusu=$_POST['idusu'];


        // if ($tipo=="Basico") {
            echo$sql1="SELECT  count(*)  from seguimientousers where seg_iduser='$idusu' and seg_fechaingreso ='$fechaActual'";		
            $DB1->Execute($sql1);
            $rw1=mysqli_fetch_row($DB1->Consulta_ID);
            if ($rw1[0]>0) {
                
            }else{
                echo$sql="INSERT INTO `seguimientousers`(`seg_iduser`, `seg_fechaingreso`,seg_horaingreso) VALUES ('$idusu','$fechaActual','$horaActual')";
                $DB1->Execute($sql);
            }

?>