<?php

include_once("../estructura/cabecera.php");
include_once("../../configuracion.php");

$datos = data_submitted();

$abmusuario = new ABMUsuario();

if($abmusuario->modificacion($datos)){
echo "datos modificados correctamente";

}else{

    echo "no se pudo modificar los datos";
}

?>

<br><a href="#" onClick="history.go(-1)">Volver</a><br>
<?php


include_once("../estructura/pie.php");
?>
























