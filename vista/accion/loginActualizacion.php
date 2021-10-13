<?php

include_once("../estructura/cabecera.php");
include_once("../../configuracion.php");




$datos = data_submitted();

$abmusuario = new ABMUsuario();
$Objusdes = $abmusuario->buscar($datos['idusuario']);
$usdeshabilitado = $Objusdes[0]->getUsdeshabilitado();

$datos['usdeshabilitado']=$usdeshabilitado;

$listaRol=$datos['listarol'];
$array=array();
$abmUsuarioRol= new ABMUsuariorol();

foreach($listaRol as $rol){
    $array=['idusuario'=>$datos['idusuario'],'idrol'=>$rol];
    $roltrue=$abmUsuarioRol->baja($array);
}
foreach($listaRol as $rol){
    $array=['idusuario'=>$datos['idusuario'],'idrol'=>$rol];
    $roltrue=$abmUsuarioRol->alta($array);
}


if($abmusuario->modificacion($datos) ||$roltrue){
echo "datos modificados correctamente";

}else{

    echo "no se pudo modificar los datos";
}

?>

<br><a href="#" onClick="history.go(-1)">Volver</a><br>
<?php

  
include_once("../estructura/pie.php");
?>
























