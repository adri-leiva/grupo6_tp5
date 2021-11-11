<?php
include_once("../../configuracion.php");
include_once("../estructura/header.php");
$objSess = new Session();
?>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<div class="card border p-1 rounded shadow p-4">
				<?php
				if ($objSess->cerrar()) {
					header('location:../ejercicios/login.php');
					exit();
				} else {
					echo "Hubo un error al cerrar la sesion"; ?>
					<a href="../ejercicios/paginaSegura.php"><button type="button" class="btn btn-outline-primary mt-3">Volver</button></a>
				<?php
				}
				?>
				
			</div>
		</div>
	</div>
</div>
<?php
include_once("../../vista/estructura/footer.php");
?>