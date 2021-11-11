<?php
include_once("../../configuracion.php");

$objSess = new Session();
if (!$objSess->activa()) {
  header('location:../ejercicios/login.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap/bootstrapValidator.min.css">
  <link rel="stylesheet" href="../css/fontawesome/all.min.css">
  <script src="../js/jquery/jquery-3.5.1.slim.min.js"></script>
  <script src="../js/popper/popper.min.js"></script>
  <script src="../js/bootstrap/bootstrap.min.js"></script>
  <script src="../js/bootstrap/bootstrapValidator.min.js"></script>
  <title><?php $Titulo ?></title>
  <style type="text/css">
    .sidebar li {
      margin: 0;
      padding: 0;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    label {
      font-weight: bold;
    }

    .sidebar .nav-link {
      font-weight: 500;
      color: var(--bs-dark);
    }

    .sidebar .nav-link:hover {
      color: var(--bs-primary);
    }

    small.help-block {
      color: #F44336 !important;
      font-weight: bold;
    }

    html {
      min-height: 100%;
      position: relative;
    }

    body {
      margin: 0;
      margin-bottom: 40px;
    }

    footer {
      background-color: black;
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 40px;
      color: white;
    }
  </style>
</head>

<body class="bg-light">
  <header class="p-3 bg-dark text-white">
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

  <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../Inicio/index.php" class="nav-link px-2 text-secondary"><b>INICIO</b></a></li>
        </ul>

        <div class="text-end">
          <?php
          $uss = $objSess->getUsuario();
          $objSess->getRol();
          $roles = $objSess->getRol();
          $strRol = "";
          foreach ($roles as $rol) {
            $strRol = $strRol . $rol->getDescripcionRol() . " - ";
          }
          echo '<p align="right"><b>Usuario: </b> ' . $uss->getUsNombre() . ' <b>Rol:</b> ' . $strRol . '</p>';
          ?>
          <a href="../accion/cerrarSesion.php"> <button class="btn btn-dark m-0 p-0">Cerrar Sesión</button> </a>
        </div>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <section class="section-content py-3">
      <div class="row">
        <aside class="col-lg-3">
          <nav class="sidebar card py-2 mb-4">
            <ul class="nav flex-column" id="nav_accordion">
              <li class="nav-item">
                <a class="nav-link" href="#"></a>
              </li>
              <li class="nav-item has-submenu">
                <a class="nav-link" href="../Inicio/index.php">Trabajo Práctico 5 </a>
                <ul>
                  <li><a class="nav-link" href="../ejercicios/listarUsuarios.php">Ejercicio 1</a></li>
                  <li><a class="nav-link" href="../ejercicios/login.php">Ejercicio 2</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </aside>
        <main class="col-lg-9">