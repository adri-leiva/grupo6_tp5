<?php
include_once("../../configuracion.php");
include_once("../estructura/header.php");
$datos = data_submitted();
$respRol=false;
$abmUs = new AbmUsuario();
$abmUR = new AbmUsuarioRol();

if (isset($datos['idUsuario'])) {
    $userRol = $abmUR->buscar(["idUsuario" => $datos["idUsuario"]]);
    $arrRoles = array();
    $objUs = $abmUs->buscar(["idUsuario" => $datos["idUsuario"]]);
    $datos["usPass"] = $objUs[0]->getUsPass();
    $datos["usDeshabilitado"] = $objUs[0]->getUsDeshabilitado();
    $resp=$abmUs->modificacion($datos);
    if ($resp|| isset($datos["roles"])) {
        if (count($userRol) > 0) {
            foreach ($userRol as $rol) {
                array_push($arrRoles, $rol->getObjRol()->getIdRol());
            }
            foreach ($arrRoles as $idRol) {
                if (!in_array($idRol, $datos['roles'])) {
                    $abmUR->baja(['idUsuario' => $datos['idUsuario'], 'idRol' => $idRol]);
                    $respRol=true;
                }
            }
        }
        if (isset($datos["roles"])) {
            foreach ($datos['roles'] as $idRol) {
                if (!in_array($idRol, $arrRoles)) {
                    $abmUR->alta(['idUsuario' => $datos['idUsuario'], 'idRol' => $idRol]);
                    $respRol=true;
                }
            }
        }
    }
    if ($resp || $respRol) {
        $mensaje = "La modificación se realizo correctamente.";
    } else{
        $mensaje = "La modificación no pudo concretarse.";
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card border p-1 rounded shadow p-4">
                <?php
                echo $mensaje;
                if ($datos["accion"] == "seg") { ?>
                    <a href="../ejercicios/paginaSegura.php"><button type="button" class="btn btn-outline-primary mt-3">Volver</button></a>
                <?php } else { ?>
                    <a href="../ejercicios/listarUsuarios.php"><button type="button" class="btn btn-outline-primary mt-3">Volver</button></a>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>
<html>
<?php
include_once("../../vista/estructura/footer.php");
?>