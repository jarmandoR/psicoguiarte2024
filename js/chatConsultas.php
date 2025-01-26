<?php 
require("login_autentica.php"); 
include("declara.php");


if($param5!=''){ $id_sedes=$param5;  $conde2=" "; }  
$idUserA=$_SESSION['usuario_id'];

$iduChat=$_POST['idPro'];



?>
<script>



</script>
<head>

  </head>
<body onload=" ">

<?php 


  $conde="and not_fecha like '$fechaactual%'"; 
 $conde1="and not_fecha like '$fechaactual%'"; 
 $conde2="and usu_nombre='$id_nombre'"; 
 $conde3="and roles_idroles = '$nivel_acceso'"; 
$conde4="and ((not_idDe = '$idUserA' and not_idusuario='$iduChat') or  (not_idDe = '$iduChat' and not_idusuario='$idUserA'))";
$conde5="and not_fecha like '$fechaactual%'";

$fechadosdias=date("Y-m-d H:i:s",strtotime($fecha_actual."- 1 days")); 

  $sql="SELECT idnoticia,  not_fecha,  usu_usuario, not_titulo, not_descripcion, not_expiracion,not_idrol,not_visto,not_respuesta,not_imagen , roles_idroles, not_idusuario, usu_nombre, not_userinsert,not_idDe, not_fechaVisto FROM noticia left join usuarios on idusuarios=not_idusuario where idnoticia>1 and not_fecha>=date('$fechadosdias') $conde4   ORDER BY 1 asc";
 // echo "$id_nombre";
$DB->Execute($sql); $va=0; 
  while($rw1=mysqli_fetch_row($DB->Consulta_ID))
  {
  
    $estado="";
    $id_p=$rw1[0];
    $va++; $p=$va%2;
    if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
    if($rw1[5]=='Confirmar' and $fechaultima<=$fechaactual){
        
         $color="#C72907";
      }
      else if($rw1[7]==''){
        $color="#2ECC71";
      }
    
              
        if ($rw1[11]==$idUserAor or $rw1[14]==$idUserA) {

                  echo "<div class='message-feed right'>
                        <div class='pull-right'>                    
                            <img src='imgUsuarios/userd.jpg' alt='' class='img-avatar' alt='' class='img-avatar'>
                        </div>
                        <small class='mf-date'><i class='fa fa-clock-o'></i> ".$rw1[1]."
                        </small>

                        <div class='media-body'>
                            <div class='mf-content'>";

            if ($rw1[9]!=''){

                echo "<a href='imgMensajes/".$rw1[9]."' target='_blank'><img src='imgMensajes/".$rw1[9]."' width='50'></a>";


            }
                echo "".$rw1[4]."</div>";
                    if ($rw1[7]=='si') {
                        echo"<small class='mf-date'></i> ".$rw1[15]."";
                         echo" ✔️</small>";
                    }
                echo "</div> </div>";
            
         }else{

           echo "<div class='message-feed media'>
                <div class='pull-left'>              
                    <img src='imgUsuarios/userd.jpg' alt='' class='img-avatar' alt='' class='img-avatar'>
                </div>
                <small class='mf-date'><i class='fa fa-clock-o'></i> ".$rw1[1]."</small>
                <div class='media-body'>    
                <div class='mf-content'>";

                if ($rw1[9]!=''){

                    echo" <a href='imgMensajes/".$rw1[9]."' target='_blank'><img src='imgMensajes/".$rw1[9]."' width='50'></a>";

                    }
                    echo"          
                        ".$rw1[4]."
                    </div>         
                    ";

                if ($rw1[7]=='si') {
                    echo"<small class='mf-date'></i> ".$rw1[15]."";
                 echo" ✔️</small>";
                }

            echo"
                </div>
            </div>
            ";
            


         }

       }   
?>