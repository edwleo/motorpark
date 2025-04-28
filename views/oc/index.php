<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex">
        <nav
          style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
          aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Órdenes de compra</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 text-end">
        <a href="<?= $path ?>/views/compras/registrar" class="">[ Registrar ]</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="btn-group" id="botones-filtro">
        <!-- 'emitido', 'aprobado', 'presentado', 'anulado', 'pagado' -->
        <button class="btn btn-sm btn-outline-primary" title="El área de logística generó una nueva OC que aun gerencia no autoriza">Emitido</button>
        <button class="btn btn-sm btn-outline-primary active" title="Gerencia aprobó la OC deberá envíarsela al concesionario">Aprobado</button>
        <button class="btn btn-sm btn-outline-primary" title="La OC fue enviada al concesionario, se deben realizar los pagos correspondientes">En proceso</button>
        <button class="btn btn-sm btn-outline-primary" title="OC anulada, deberá indicar los motivos">Anulado</button>
        <button class="btn btn-sm btn-outline-primary" title="OC pagada completamente, verifique factura">Pagado</button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped" id="tabla-oc">
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
                <a href="#">Detalle</a>
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
                <a href="#">Detalle</a>
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
                <a href="#">Detalle</a>
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
                <a href="#">Detalle</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div> <!-- ./table-responsive -->
    </div> <!-- ./card-body -->
    <div class="card-footer">

      <div class="table-responsive">
        <table class="table table-sm table-striped">
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
      </div>
    </div>
  </div> <!-- ./card -->

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      
      const botonesFiltro = document.querySelectorAll("#botones-filtro btn")

      let table = new DataTable('#tabla-oc', {
        language: { url: '../../public/js/datable-es-ES.json' }
      });

      botonesFiltro.forEach(boton => {
        //Se quita la clase active a todos
        boton.classList.remove("active");
        boton.addEventListener("click", (event) => {
          event.target.classList.add("active");
        });
      });
      
    });

  </script>

  <?php require_once "../partials/footer.php"; ?>