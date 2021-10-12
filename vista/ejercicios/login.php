<?php
include_once("../estructura/cabecera.php");

?>

 
<style>
form {
  display: flex;
  justify-content: center;
}
</style>
<form class="needs-validation" name="form" id="form" method="post" action="../accion/verificarLogin.php" novalidate>
    <div class="">
    <div class="row  mb-3" style="text-align: center;">
        <h4 class="text-center" >Login</h4>
    </div>    
    <div class="row">
        <div class="col">
            <label for="staticEmail2" class="visually-hidden">Usuario</label>
            <input type="text" name="usnombre" class="form-control" id="usnombre" placeholder="Nombre" required>
            <div class="invalid-feedback">Nombre de Usuario invalido</div>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col">
            <label for="inputPassword2" class="visually-hidden">Password</label>
            <input type="password" name="uspass" class="form-control" id="uspass" placeholder="Password" minlength="8" required>
            <div class="invalid-feedback">Contraseña invalida</div>
        </div>
    </div>
    <div class="pt-2">
        <div class="col">
            <button type="submit" class="btn btn-success container-md">Entrar</button>
        </div>
    </div>
    </div>
</form>
       
    

    <?php



include_once("../estructura/pie.php");


?>