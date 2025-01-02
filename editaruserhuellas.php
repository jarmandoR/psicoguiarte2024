<?php 
require("login_autentica.php"); 
include("layout.php");
$sedesesion=$_SESSION['usu_idsede'];
$FB->titulo_azul1("Hojas de Vida",9,0,5);  
$FB->abre_form("form1","editaruserhuellas.php","post");
$FB->nuevo7("huella/index.php?sede=2?condecion=datospersonales&accion=1");

	if($param5!=''){  $conde2="and hoj_sede=$param5"; }  else { $conde2=""; }
$FB->llena_texto("Sede :",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$sedesesion", 17, 0);
$FB->llena_texto("Contrato:",1,82,$DB,$tipocontrato,"",$param1,4,0);
$FB->llena_texto("Busqueda por:",3,82,$DB,$busqueda4,"",$param3,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);
$FB->llena_texto("Estado:",4,82,$DB,$estadosac2,"",$param4,1,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 

$conde1=""; 



  if($param2!="" and $param3!=""){ 
   $conde1="and $param3 like '%$param2%' "; 
	}else { $conde1="  "; } 


  if($param4!='0' and $param4!=''){
	  $cond5=" and hoj_estado='$param4'";
  }

  if($param1!='0' and $param1!=''){
	$cond3=" and hoj_tipocontrato='$param1'";
}


$cond5="and usu_idsede='$sedesesion'"; 
if($param5!='0' and $param5!=''){
	  $cond5=" and usu_idsede='$param5'";
  }



$FB->titulo_azul1("Nombre",1,0,7); 
$FB->titulo_azul1("Documento",1,0,0); 
$FB->titulo_azul1("Sedes",1,0,0); 


$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);

$sql="SELECT  `id`, `documento`, `nombre_completo` FROM `usuarios_huella`  ORDER BY  id ";

    $DB->Execute($sql); 
 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		
		$id_p=$rw1[1];
		$va=$rw1[0];
		
			$color="#EFEFEF";



	


       $sql2="SELECT sed_nombre FROM `usuarios` inner join sedes on usu_idsede=idsedes  WHERE usu_identificacion='$rw1[1]' $cond5";		
	        $DB1->Execute($sql2);
	
	            $sede=$DB1->recogedato(0);

                   if ($sede!="") {
           	           # code...
          
					    echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
                        echo "
						<td>".$rw1[2]."</td>
						<td>".$rw1[1]."</td>
						<td>".$sede."</td>";
					    $DB1->editar("editaruserhuellasok.php",$id_p, "usuarios_huella", 1,'');

		            }

	}





include("footer.php");

?>