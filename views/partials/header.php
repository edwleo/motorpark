<!DOCTYPE html>

<?php

//Variables para rutas absolutas
$path = "http://localhost/motorpark";

?>

<html lang="es" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Motorpark Yonda</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/3.0.0/css/select.bootstrap5.css">

  <link rel="stylesheet" href="<?= $path ?>/public/css/style-dashboard.css">
</head>

<body>

  <div class="wrapper">

    <aside id="sidebar" class="js-sidebar">
      <!-- Content For Sidebar -->
      <div class="h-100 sticky-top">
        <div class="sidebar-logo">
          <a href="<?= $path ?>/views">
            <img src="<?= $path ?>/public/images/motoropark-logo-blanco.png" class="img-fluid" alt="">
          </a>
        </div>
        <ul class="sidebar-nav">
          <li class="sidebar-header">
            Módulos
          </li>
          <li class="sidebar-item">
            <a href="<?= $path ?>/views/oc" class="sidebar-link">
              <i class="fa-solid fa-list pe-2"></i>
              OC
            </a>
          </li>
          <li class="sidebar-item">
            <a href="<?= $path ?>/views/compras" class="sidebar-link">
              <i class="fa-solid fa-list pe-2"></i>
              Compras
            </a>
          </li>
          <li class="sidebar-item">
            <a href="<?= $path ?>/views/vehiculos" class="sidebar-link">
              <i class="fa-solid fa-list pe-2"></i>
              Vehículos
            </a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
              aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
              Pages
            </a>
            <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Page 1</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Page 2</a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
              aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
              Posts
            </a>
            <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Post 1</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Post 2</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Post 3</a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
              aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
              Auth
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Login</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Register</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Forgot Password</a>
              </li>
            </ul>
          </li>
          <li class="sidebar-header">
            Multi Level Menu
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse"
              aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>
              Multi Dropdown
            </a>
            <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1" data-bs-toggle="collapse"
                  aria-expanded="false">Level 1</a>
                <ul id="level-1" class="sidebar-dropdown list-unstyled collapse">
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Level 1.1</a>
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Level 1.2</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </aside>

    <div class="main">

      <nav class="navbar navbar-expand px-3 border-bottom">
        <button class="btn" id="sidebar-toggle" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                <img src="http://localhost/motorpark/public/images/profile.jpg" class="avatar img-fluid rounded" alt="">
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="#" class="dropdown-item">Perfil</a>
                <a href="#" class="dropdown-item">Configuración</a>
                <a href="#" class="dropdown-item">Cerrar sesión</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <main class="content px-3 py-2">