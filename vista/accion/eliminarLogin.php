<?php
include_once('../../configuracion.php');
include_once("../estructura/cabecera.php");

$datos = data_submitted();

$usuario = new ABMUsuario();

$filtro = [];
$filtro['idusuario'] = $datos['id'];
$objUsusario = $usuario->buscar($filtro);
$existeUsuario = false;
if(count($objUsusario)>0){
    $existeUsuario = true;
    $datos = [];
    $datos['idusuario'] = $filtro['idusuario'];
    $datos['usnombre'] = $objUsusario[0]->getUsnombre();
    $datos['uspass'] = $objUsusario[0]->getUspass();
    $datos['usmail'] = $objUsusario[0]->getUsmail();
    
}

if($existeUsuario){
    $datos['usdeshabilitado'] = date('Y-m-d H:i:s');
   
    if($usuario->modificacion($datos)){
        echo "se elimino el usuario";
    }else{
        echo "no se pudo eliminar el usuario";
    }
}else{
    echo "El usuario no existe!";
}
echo "<a href=../ejercicios/listarUsuario.php> VOLVER </a>";


include_once("../estructura/pie.php");
?>