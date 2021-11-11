<?php
include_once("../../configuracion.php");
$datos = data_submitted();
//print_r($datos);
if ($datos["seg"] == true) {
    include_once("../estructura/headerSeg.php");
} else {
    include_once("../estructura/header.php");
}
$abmUs = new AbmUsuario();
$objUs = NULL;
//  print_r($datos);
if (isset($datos['idUsuario'])) {
    $lista = $abmUs->buscar($datos);
    if (count($lista) > 0) {
        $objUs = $lista[0];
        $datos["usNombre"] = $objUs->getUsNombre();
        $datos["usPass"] = $objUs->getUsPass();
        $datos["usMail"] = $objUs->getUsMail();
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card border p-1 rounded shadow p-4">
                <h4 class="title m-0">Habilitar Sesión</h4>
                <hr>
                <?php

                if ($objUs != null) {
                    $datos["usDeshabilitado"] = NULL;
                    $exito = $abmUs->modificacion($datos);
                } else {
                    echo "La persona ingresada no se encontro";
                ?>

                <?php }
                if ($exito) {
                    echo "Habilitación Exitosa";
                } else {
                    echo "No se pudo realizar la habilitación";
                }
                ?>
                <a href="../ejercicios/paginaSegura.php"><button type="button" class="btn btn-outline-primary mt-3">Volver</button></a>
            </div>
        </div>
    </div>
</div>
<?php
include_once("../../vista/estructura/footer.php");
?>