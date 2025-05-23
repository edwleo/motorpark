<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex">
        <nav
          style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
          aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Compras</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 text-end">
        <a href="<?= $path ?>/views/compras/registrar" class="">[ Registrar ]</a>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="tabla-compras">
      <thead>
        <tr>
          <th>#</th>
          <th>Proveedor</th>
          <th>Solicitado</th>
          <th>Enviado</th>
          <th>Recepcionado</th>
          <th>Importe</th>
          <th>Estado</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Autos Perú</td>
          <td>15-02-2025</td>
          <td>10-03-2025</td>
          <td>08-04-2025</td>
          <td>85000</td>
          <td>Pendiente</td>
          <td>
            <a href="#">Agregar</a>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>Autos Perú</td>
          <td>15-02-2025</td>
          <td>10-03-2025</td>
          <td>08-04-2025</td>
          <td>8000</td>
          <td>Pendiente</td>
          <td>
            <a href="#">Agregar</a>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>Autos Perú</td>
          <td>15-02-2025</td>
          <td>10-03-2025</td>
          <td>08-04-2025</td>
          <td>85000</td>
          <td>Pendiente</td>
          <td>
            <a href="#">Agregar</a>
          </td>
        </tr>

        <tr>
          <td>1</td>
          <td>Autos Perú</td>
          <td>15-02-2025</td>
          <td>10-03-2025</td>
          <td>08-04-2025</td>
          <td>85000</td>
          <td>Pendiente</td>
          <td>
            <a href="#">Agregar</a>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>Autos Perú</td>
          <td>15-02-2025</td>
          <td>10-03-2025</td>
          <td>08-04-2025</td>
          <td>85000</td>
          <td>Pendiente</td>
          <td>
            <a href="#">Agregar</a>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>Autos Perú</td>
          <td>15-02-2025</td>
          <td>10-03-2025</td>
          <td>08-04-2025</td>
          <td>85000</td>
          <td>Pendiente</td>
          <td>
            <a href="#">Agregar</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    let table = new DataTable('#tabla-compras', {
      language: { url: '../../public/js/datable-es-ES.json' }
    });
  });

</script>

<?php require_once "../partials/footer.php"; ?>