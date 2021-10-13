<?php

include_once("../estructura/cabecera.php");
include_once("../../configuracion.php");

$datos = data_submitted();

$session= new Session();

$verificar= $session->validar($datos);


if($verificar){
    header('location:../ejercicios/paginaSegura.php');
    

}else{
    $session->cerrar();
    $errorsession= "Nombre de usuario y/o password incorrecto";
    include_once('../ejercicios/login.php');
    
   
    

}



include_once("../estructura/pie.php");
?>
