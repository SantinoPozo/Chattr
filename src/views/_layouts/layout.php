<?php
require_once __DIR__ . '/../../config/bootstrap.php'; # Acá linkea las configuraciones de bootstrap.php

# Si no estoy logueado, me saca
if (!isset($_SESSION['user'])) {
  header('Location: /src/controllers/auth/login.php');
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
  <script src=<?= '/assets/js/jquery.min.js' ?>></script>
  <title>Chattr</title>
</head>
<body>
  <div class="container-fluid text-bg-dark">
    <div class="row">
      <div id="menu-lateral" class="d-none d-sm-block col-4">
        <div class="sticky-top w-50 vh-100 p-2 float-end text-bg-dark">
          <nav class="text-white fs-5 pb-4">
            <div>
              <a href="/" class="text-white text-decoration-none fs-1">Chattr</a>
            </div>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="/src/views/posts/" class="nav-link link-btn text-white">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                      <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                    </svg>
                  </span>
                  Hogar
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link link-btn text-white">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                  </span>
                  Explorar
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link link-btn text-white">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                      <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                    </svg>
                  </span>
                  Notificaciones
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link link-btn text-white" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                  </span>
                  Cuenta
                </a>
                <div class="collapse" id="collapseExample">
                <div class="container-fluid">  
                <div class="row">
                    <div class="col-2 p-0">
                      <img src="<?= '/assets/img/users/'. $_SESSION['user']['pfp'] ?>" class="rounded-circle w-100" alt="Avatar">
                    </div>
                    <div class="col">
                      <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                          <a href="<?= '/src/views/user/index.php?id='. $_SESSION['user']['id'] ?>" class="nav-link"><?= $_SESSION['user']['name'] ?></a>
                        </li>
                        <li class="nav-item">
                          <a href="/src/controllers/auth/logout.php" class="nav-link">Cerrar sesion</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                </div>
              </li>
              </li>
            </ul>
          </nav>
          <button type="button" class="btn btn-primary w-100 fs-5" data-bs-toggle="modal" data-bs-target="#subirPost">
              <span class="post-subir">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
              </span>
              Nuevo Post
          </button>
        </div>
      </div>
      <div id="menu-busqueda" class="d-none d-sm-block col-4 order-5">
        <div class="sticky-top p-2 float-start">
          <input type="text" class="form-control mb-3" placeholder="Buscar">
        </div>
      </div>
      <?php include('post_modal.php')?>
    <!-- Acá se cargan los sitios, pueden modificar lo que gusten -->