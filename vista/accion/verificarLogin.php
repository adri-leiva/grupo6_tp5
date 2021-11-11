<?php
include_once("../../configuracion.php");
include_once("../estructura/header.php");
$datos = data_submitted();
$objSess = new Session();
if ($objSess->iniciar($datos['usNombre'], $datos['usPass'])) {
	header('location:../ejercicios/paginaSegura.php');
}else {
	header('location:../ejercicios/login.php?errorcred=0');
}
?>