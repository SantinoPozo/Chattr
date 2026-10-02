<?php
require_once __DIR__ . '/../../config/bootstrap.php'; # Acá linkea las configuraciones de bootstrap.php

# Si no estoy logueado, me saca
if (!isset($_SESSION['user'])) {
  header('Location: /src/views/auth/login.php');
  exit;
}

function logout() {
  session_destroy();
  header('Location: /src/views/auth/login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href=<?= '/assets/css/bootstrap.min.css' ?> >
  <script src=<?= '/assets/js/bootstrap.min.js' ?>></script>
  <title>Chattr</title>
</head>
<body>
  <div class="container-fluid text-bg-dark">
    <div class="row">
      <div id="menu-lateral" class="d-none d-sm-block col-3">
        <div class="sticky-top text-bg-dark p-2">
          <nav class="text-white vh-100">
            <div>
              <a href="/" class="text-white text-decoration-none fs-2">Chattr</a>
            </div>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="#" class="nav-link active">Hogar</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link text-white">Explorar</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link text-white">Notificaciones</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-primary d-flex" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Cuenta
                </a>
                <div class="collapse" id="collapseExample">
                  
                  <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="/src/controllers/auth/logout.php" class="nav-link active">Cerrar sesion</a>
              </li>
</ul>
                  
                </div>
              </li>
              </li>
            </ul>
            <a class="btn btn-primary" href="/src/controllers/posts/form.php">Crear Post</a>
          </nav>
        </div>
      </div>
      <div id="menu-busqueda" class="d-none d-sm-block col-3 order-5">
        <div class="sticky-top p-2">
          <input type="text" class="form-control mb-3" placeholder="Buscar">
        </div>
      </div>
      <div id="contenido-principal" class="col p-2 order-1">
    <!-- Acá se cargan los sitios, pueden modificar lo que gusten -->