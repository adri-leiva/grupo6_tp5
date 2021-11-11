<?php
include_once("../../configuracion.php");
include_once("../estructura/header.php");
$objSession = new Session();
if ($objSession->activa()) {
    header('location:paginaSegura.php');
    exit();
}
$data = data_submitted();
?>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card border rounded shadow p-3">
                <div class="card-body ">
                    <form class="ms-2" id="login" name="login" method="POST" action="../accion/verificarLogin.php" data-toggle="validator" novalidate>
                        <h4 class="tittle text-center">Sesión</h4>
                        <div class="form-group my-4">
                            <div class="input-group">
                                <span class="input-group-text p-3"><i class="fas fa-user"></i></span>
                                <input id="usNombre" class="form-control" type="text" placeholder="Nombre Usuario" name="usNombre" >
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text p-3"><i class="fas fa-lock"></i></span>
                                <input id="usPass" class="form-control" type="password" placeholder="Contraseña" name="usPass" >
                            </div>
                        </div>
                        <?php
                            if(isset($data['errorcred'])){
                                echo "<div class='m-2 text-center'>
                                        <label style='color:red'>Usuario y/o contraseña inválidos.</label>
                                    </div>";
                            }
                        ?>
                        <div class="form-group mb-4">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-md btn-block w-100" type="submit">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <p><br>
                Crear Un script Vista/login.php que invoque al script accion/verificarLogin.php el cual redirecciona al
                script Vista/paginaSegura.php si los datos ingresados se corresponden con un usuario/pass
                registrados. Caso contrario se redirecciona nuevamente al script Vista/login.php</p>
        </div>
    </div>
</div>
<?php
include_once("../estructura/footer.php");
?>