<?php

include_once("../../configuracion.php");
$session=new Session();

if($session->cerrar()){
 header('location:../ejercicios/login.php');

}else{
    header('location:../ejercicios/paginaSegura.php');
    echo "No se pudo cerrar sesion";
}


?>