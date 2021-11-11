<?php
include_once("../../configuracion.php");
include_once("../estructura/header.php");

$abmUs = new AbmUsuario();
$colUsuarios = $abmUs->buscar(null);
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card border rounded shadow p-3">
                <h2>Lista de usuarios</h2><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($colUsuarios) > 0) {
                            foreach ($colUsuarios as $us) {
                                if ($us->getUsDeshabilitado() == NUll || $us->getUsDeshabilitado() == "0000-00-00 00:00:00") {
                        ?>
                                    <tr>
                                        <td><?php echo $us->getIdUsuario() ?></td>
                                        <td><?php echo $us->getUsNombre() ?></td>
                                        <td><?php echo $us->getUsMail() ?></td>
                                        <td><a class="btn btn-primary" href="../accion/actualizarLogin.php?idUsuario=<?php echo $us->getIdUsuario() ?>&seg=false">editar</a>
                                            <a class="btn btn-warning" href="../accion/eliminarLogin.php?idUsuario=<?php echo $us->getIdUsuario() ?>&seg=false">borrar</a>
                                        </td>
                                    </tr>

                        <?php }
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-4">
            <p> <br>
                Crear un script Vista/listarUsuario.php que liste los usuario registrados y permita actualizar sus datos o
                realizar un borrado lógico. Las acciones que se van a poder invocar son:
                accion/actualizarLogin.php y accion/eliminarLogin.php

            </p>
        </div>
    </div>
</div>
<?php
include_once("../estructura/footer.php");
?>