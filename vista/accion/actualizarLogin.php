<?php
include_once("../estructura/cabecera.php");
include_once("../../configuracion.php");


$datos= data_submitted();
$usuario= new ABMUsuario();
$id=[];

$id['idusuario']=$datos['id'];

$encontrar= $usuario->buscar($id);
$usuarioLogin=$encontrar[0];

$buscarRol= new ABMUsuariorol();
$usuarioRol= $buscarRol->buscar($id);
$idrol=$usuarioRol[0];
$roldescript=$idrol->getObj_rol()->getRodescript();

?>
<div>
<h2>EDITAR USUARIO</h2>

        <form  method="post" class="needs-validation" action="../accion/loginActualizacion.php" novalidate>
            <div class="row">
                <div class="col py-3 px-lg-5  ">
                ID</div>
                <div class="col py-3 px-lg-5  ">
                    <input id="idusuario" readonly name ="idusuario" class="form-control" type="text" value="
                    <?php echo $usuarioLogin->getIdusuario();?>" required>
                 
                </div>
            </div>
            <div class="row">
                <div class="col py-3 px-lg-5  ">
                Nombre de Usuario
            </div>
                <div class="col py-3 px-lg-5  ">
                    <input id="usnombre" name ="usnombre" class="form-control" type="text" minlength="3"
                     value="<?php echo $usuarioLogin->getUsnombre();?>" required>
                    <div class="invalid-feedback">ingrese un nombre de usuario valido</div><br>
                </div>
            </div>
            <div class="row" style="display:none;">
                <div class="col py-3 px-lg-5  ">
                    Password
            </div>
            <div class="col py-3 px-lg-5  ">
                <input id="uspass" name ="uspass" class="form-control" type="text" minlength="3" 
                value="<?php echo $usuarioLogin->getUspass();?>" required>
                <div class="invalid-feedback">Ingrese un password correcto</div><br>
            </div>
            </div>
            <div class="row">
                <div class="col py-3 px-lg-5  ">
                    email
                </div>
                <div class="col py-3 px-lg-5  ">
                    <input id="usmail" name ="usmail" class="form-control" type="email" value="<?php echo $usuarioLogin->getUsmail();?>" required>
                    <div class="invalid-feedback">Ingrese un correo electronico</div><br>
                </div>
            </div>
            <div class="row">
                <div class="col py-3 px-lg-5  ">
                    ROL
                </div>
                <div class="col py-3 px-lg-5  ">
                <input class="form-control" id="rol" name="rol" type="text" value="<?php echo $roldescript;?>" required>
                <div class="invalid-feedback">edita el tipo de usuario</div><br>
                </div>
            </div>
            <div class="row" style="display:none;">
                <div class="col py-3 px-lg-5  ">
                    usdeshabilitado
                </div>
                <div class="col py-3 px-lg-5  ">
                <input class="form-control" id="usdehabilitado" name="usdeshabilitado" type="text" value="<?php echo $usuarioLogin->getUsdeshabilitado();?>" required>
                <div class="invalid-feedback">edita el tipo de usuario</div><br>
                </div>
            </div>
     
                <button class="btn btn-primary" type="submit">Guardar Cambios</button>
            </div>
        </form>







<?php

include_once("../estructura/pie.php");

?>