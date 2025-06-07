<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex align-items-center justify-content-start">
        <nav
          style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
          aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Órdenes de compra</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 d-flex align-items-center justify-content-end">
        <a href="<?= $path ?>/views/oc/registrar" class="btn btn-outline-primary btn-sm">Registrar</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="btn-group" id="botones-filtro">
        <!-- 'emitido', 'aprobado', 'presentado', 'anulado', 'pagado' -->
        <button class="btn btn-sm btn-outline-primary"
          title="El área de logística generó una nueva OC que aun gerencia no autoriza">Emitido</button>
        <button class="btn btn-sm btn-outline-primary"
          title="Gerencia aprobó la OC deberá envíarsela al concesionario">Aprobado</button>
        <button class="btn btn-sm btn-outline-primary"
          title="La OC fue enviada al concesionario, se deben realizar los pagos correspondientes">En proceso</button>
        <button class="btn btn-sm btn-outline-primary" title="OC anulada, deberá indicar los motivos">Anulado</button>
        <button class="btn btn-sm btn-outline-primary"
          title="OC pagada completamente, verifique factura">Pagado</button>
      </div>
    </div>
    <div class="card-body" id="lista-oc">
      <div class="table-responsive">
        <table class="table table-sm" id="tabla-oc">
          <thead>
            <tr>
              <th>#</th>
              <th>Número</th>
              <th>Concesionario</th>
              <th>Fecha</th>
              <th>Moneda</th>
              <th>Total</th>
              <th>Amortización</th>
              <th>Saldo</th>
              <th>Operaciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>2025-00001</td>
              <td>AUTONIZA PERU S.A.C.</td>
              <td>25/04/2025</td>
              <td>USD</td>
              <td>151788.00</td>
              <td>50000</td>
              <td>101788</td>
              <td>
                <a href="#" class="show-details">Detalle</a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>2025-00002</td>
              <td>AUTONIZA PERU S.A.C.</td>
              <td>25/04/2025</td>
              <td>USD</td>
              <td>151788.00</td>
              <td>50000</td>
              <td>101788</td>
              <td>
                <a href="#" class="show-details">Detalle</a>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>2025-00003</td>
              <td>AUTONIZA PERU S.A.C.</td>
              <td>25/04/2025</td>
              <td>USD</td>
              <td>151788.00</td>
              <td>50000</td>
              <td>101788</td>
              <td>
                <a href="#" class="show-details">Detalle</a>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>2025-00004</td>
              <td>AUTONIZA PERU S.A.C.</td>
              <td>25/04/2025</td>
              <td>USD</td>
              <td>151788.00</td>
              <td>50000</td>
              <td>101788</td>
              <td>
                <a href="#" class="show-details">Detalle</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div> <!-- ./table-responsive -->
    </div> <!-- ./card-body -->

    <div class="card-footer" id="detalle-oc" style="display: none;">
      <div class="row">
        <div class="col-md-6">
          <div style="padding: 1rem;">
            <h3>AUTONIZA PERU S.A.C.</h3>
            <h5>2025-00001, 25 abril 2025 | USD 15178.00</h5>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-end" style="padding-right: 1.5rem;">
          <button type="button" id="btn-volver" class="btn btn-outline-primary btn-sm">Volver</button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-sm" id="tabla-detalles">
          <thead>
            <tr>
              <th>#</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Versión</th>
              <th>Combustible</th>
              <th>Año</th>
              <th>Chasis</th>
              <th>Serie</th>
              <th>Color</th>
              <th>Moneda</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Hyundai</td>
              <td>Grand i10</td>
              <td>Confort</td>
              <td>Gasolina</td>
              <td>2025</td>
              <td>JIKAS8821144</td>
              <td>1454987498798</td>
              <td>Blanco</td>
              <td>USD</td>
              <td>11676.00</td>
            </tr>
          </tbody>
        </table>
      </div> <!-- ./table-responsive -->
    </div> <!-- ./card-footer -->
  </div> <!-- ./card -->

  <script>
    document.addEventListener("DOMContentLoaded", () => {

      const botonesFiltro = document.querySelectorAll("#botones-filtro .btn")
      const enlacesDetalle = document.querySelectorAll(".show-details")
      const botonVolver = document.querySelector("#btn-volver")
      const speedAnimation = 750;

      let tableOC = new DataTable('#tabla-oc', {
        language: { url: '../../public/js/datable-es-ES.json' }
      });

      let tableDetails = new DataTable('#tabla-detalles', {
        language: { url: '../../public/js/datable-es-ES.json' }
      });

      botonVolver.addEventListener("click", () => {
        $("#detalle-oc").slideUp(speedAnimation);
        $("#lista-oc").slideDown(speedAnimation);
      })

      //Comportamiento para botones de filtrado
      botonesFiltro.forEach(boton => {
        boton.addEventListener("click", () => {
          botonesFiltro.forEach(btn => btn.classList.remove("active"));
          boton.classList.add("active");
        })
      });

      //Detalle = mostrar los vehiculos solicitados en la OC
      enlacesDetalle.forEach(enlace => {
        enlace.addEventListener("click", (event) => {
          event.preventDefault();
          $("#detalle-oc").slideDown(speedAnimation);
          $("#lista-oc").slideUp(speedAnimation);
        });
      });

    });

  </script>

  <?php require_once "../partials/footer.php"; ?>