<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex align-items-center justify-content-start">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Concesionarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 text-end">
        <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/concesionarios/registrar"
          class="">Registrar</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-sm table-hover table-hover-yonda" id="tabla-concesionarios">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre comercial</th>
                <th>Razón social</th>
                <th>RUC</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {

      const tablaConcesionarios = document.querySelector("#tabla-concesionarios tbody")

      function obtenerConcecionarios() {
        fetch(`../../app/controllers/concesionario.c.php?operation=getAllConcesionarios`, { method: 'GET' })
          .then(response => response.json())
          .then(data => {
            if (data.length > 0){
              let numeroFila = 1
              tablaConcesionarios.innerHTML = ``
              data.forEach(element => {
                tablaConcesionarios.innerHTML += `
                  <tr>
                    <td class='align-middle'>${numeroFila}</td>
                    <td class='align-middle'>${element.nombrecomercial}</td>
                    <td class='align-middle'>${element.razonsocial}</td>
                    <td class='align-middle'>${element.ruc}</td>
                    <td>
                      <a href='#' title='Editar nombre comercial' data-idtienda='${element.idconcesionario}' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                      <a href='#' title='Eliminar' data-idtienda='${element.idconcesionario}' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                      <a href='registrar?ruc=${element.ruc}' title='Ver tiendas' data-idtienda='${element.idconcesionario}' class='btn btn-sm btn-outline-secondary'><i class="fa-solid fa-shop"></i></a>
                    </td>
                  </tr>
                `
                numeroFila++
              });
            }
          })
          .catch(error => console.error(error))
      }

      obtenerConcecionarios();
    });

  </script>

  <?php require_once "../partials/footer.php"; ?>