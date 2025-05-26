<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex align-items-center justify-content-start">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Marcas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 text-end">
        <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/compras/registrar" class="">Registrar</a>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Marcas -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          Lista de marcas
        </div>
        <div class="card-body">
          <table class="table table-sm">
            <colgroup>
              <col style="width: 75%;">
              <col style="width: 25%;">
            </colgroup>
            <thead>
              <tr>
                <th>Nombre marca</th>
                <th class="text-center">Op</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class='align-middle'>BMW</td>
                <td>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td class='align-middle'>KIA</td>
                <td>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i
                      class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i
                      class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td class='align-middle'>CHEVROLET</td>
                <td>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i
                      class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i
                      class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td class='align-middle'>DFSK</td>
                <td>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i
                      class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i
                      class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td class='align-middle'>GEELY</td>
                <td>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i
                      class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i
                      class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Fin marcas -->
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
              Tipos modelos y años
            </div>
            <div class="col-md-6 text-end">
              <a class="" href="#" class="">[ Agregar ]</a>
            </div>
          </div>
        </div> <!-- ./card-header -->
        <div class="card-body">
          <table class="table table-sm table-hover table-hover-yonda">
            <colgroup>
              <col style="width: 10%;">
              <col style="width: 30%;">
              <col style="width: 30%;">
              <col style="width: 10%;">
              <col style="width: 20%;">
            </colgroup>
            <thead>
              <tr>
                <th>#</th>
                <th>Tipo</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Operaciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class='align-middle'>1</td>
                <td class='align-middle'>Sedan</td>
                <td class='align-middle'>All new K3</td>
                <td class='align-middle'>2025</td>
                <td>
                  <a href='#' title='Vista previa' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-camera"></i></a>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td class='align-middle'>2</td>
                <td class='align-middle'>Sedan</td>
                <td class='align-middle'>Soluto</td>
                <td class='align-middle'>2025</td>
                <td>
                  <a href='#' title='Vista previa' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-camera"></i></a>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td class='align-middle'>3</td>
                <td class='align-middle'>SUV</td>
                <td class='align-middle'>Sorento</td>
                <td class='align-middle'>2025</td>
                <td>
                  <a href='#' title='Vista previa' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-camera"></i></a>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!--
      <form action="" autocapitalize="off">
        <div class="row g-2">
          <div class="col-md-3">
            <div class="form-floating">
              <input type="text" class="form-control" value="CHEVROLET">
              <label for="">Marca activa</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <select name="" id="" class="form-select">
                <option value="">Seleccione</option>
                <option value="">Sedan</option>
              </select>
              <label for="">Tipo vehículo</label>
            </div>
          </div>
        </div>
      </form>
      -->
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {

    });

  </script>

  <?php require_once "../partials/footer.php"; ?>