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

    .sidebar .nav-link {
      font-weight: 500;
      color: var(--bs-dark);
    }

    label {
      font-weight: bold;
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

  

    <div class="container">
     
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../Inicio/index.php" class="nav-link px-2 text-secondary"><b>INICIO</b></a></li>
        </ul>
        
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../Inicio/index.php" class="nav-link px-2 text-secondary"><b>INICIO</b></a></li>
        </ul>

        <div class="text-end">
          <?php echo "Fecha <br>" . date('d-m-Y');    ?>
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