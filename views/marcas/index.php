<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex align-items-center justify-content-start">
        <nav
          aria-label="breadcrumb">
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

  <div>
    <!-- Contenido aquí -->
  </div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    
  });

</script>

<?php require_once "../partials/footer.php"; ?>