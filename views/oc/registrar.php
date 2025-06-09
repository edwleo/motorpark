<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex align-items-center justify-content-start">
        <!-- <nav aria-label="breadcrumb"> -->
        <nav
          style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
          aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Órdenes de compra</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registrar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 d-flex align-items-center justify-content-end">
        <a href="<?= $path ?>/views/oc" class="btn btn-sm btn-outline-primary">Mostrar lista</a>
      </div>
    </div>
  </div>

  <form action="" autocomplete="off">
    <div class="card mb-2">
      <div class="card-body">
        
        <div class="row g-2">
          <div class="col-md-2 mb-2">
            <div class="form-floating">
              <input type="text" class="form-control text-center" id="serie" maxlength="11" value="2025-0001254" disabled>
              <label for="form-label">Serie</label>
            </div>
          </div>
          <div class="col-md-2 mb-2">
            <div class="form-floating">
              <input type="date" class="form-control text-center" id="fechaemision">
              <label for="form-label">Fecha emisión</label>
            </div>
          </div>
          <div class="col-md-3 mb-2">
            <div class="form-floating">
              <select name="concesionarios" id="concesionarios" class="form-select">
                <option value="">Seleccione</option>
              </select>
              <label for="form-label">Concesionario</label>
            </div>
          </div>
          <div class="col-md-2 mb-2">
            <div class="form-floating">
              <input type="text" class="form-control text-center" name="ruc" id="ruc" maxlength="11" readonly>
              <label for="form-label">RUC</label>
            </div>
          </div>
          <div class="col-md-3 mb-2">
            <div class="form-floating">
              <select name="tiendas" id="tiendas" class="form-select">
                <option value="">Seleccione</option>
              </select>
              <label for="form-label">Tienda</label>
            </div>
          </div>
          
        </div> <!-- ./row -->

        <div class="row g-2">
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" name="direccion" id="direccion">
              <label for="form-label">Dirección</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" name="asesor" id="asesor" value="Ricardo Pachas Prado">
              <label for="form-label">Asesor</label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-floating">
              <input type="text" class="form-control text-center" name="telefono" id="telefono" value="956834565">
              <label for="form-label">Teléfono</label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-floating">
              <select name="moneda" id="moneda" class="form-select">
                <option value="PEN">Soles</option>
                <option value="USD">Dólares</option>
              </select>
              <label class="form-label" for="moneda">Moneda</label>
            </div>
          </div>
        </div> <!-- ./row -->

      </div> <!-- ./card-body -->
    </div><!-- ./card -->

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>#</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                
                <th>Precio</th>
                <th>Descuento</th>
                <th>Importe</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>
                  <a href=""><i class="fa-solid fa-trash"></i></a> ::
                  Kia SUV Seltos blanco 2025/ Full equipo / Chasis 77A855455A
                </td>
                <td>1</td>
               
                <td>18000</td>
                <td>0</td>
                <td>18000</td>
              </tr>
              <tr>
                <td>1</td>
                <td>
                  <a href=""><i class="fa-solid fa-trash"></i></a> ::
                  Kia SUV Seltos blanco 2025/ Full equipo / Chasis 77A855455A
                </td>
                <td>1</td>
               
                <td>18000</td>
                <td>0</td>
                <td>18000</td>
              </tr>
              <tr>
                <td>1</td>
                <td>
                  <a href=""><i class="fa-solid fa-trash"></i></a> ::
                  Kia SUV Seltos blanco 2025/ Full equipo / Chasis 77A855455A
                </td>
                <td>1</td>
               
                <td>18000</td>
                <td>0</td>
                <td>18000</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
        <button type="reset" class="btn btn-secondary btn-sm">Cancelar</button>
      </div>
    </div>
  </form>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const concesionarios = document.querySelector("#concesionarios")
      const ruc = document.querySelector("#ruc")
      let dataConcesionarios = []

      async function obtenerConcesionarios(){
        const response = await fetch(`../../app/controllers/concesionario.c.php?operation=getAllConcesionarios`, { method: 'GET' } )
        const data = await response.json()
        return data
      }

      async function renderConcesionarios(){
        dataConcesionarios = await obtenerConcesionarios()
        if (dataConcesionarios.length > 0){
          concesionarios.innerHTML = `<option value=''>Seleccione</option>`
          dataConcesionarios.forEach(element => {
            concesionarios.innerHTML += `<option value='${element.idconcesionario}'>${element.nombrecomercial}</option>`
          }); 
        }
      }

      async function obtenerTiendas(id){
        const response = await fetch(`../../app/controllers/tienda.c.php?operation=getTiendasByIdConcesionario&idconcesionario=${id}`, { method: 'GET'} )
        const data = await response.json()
        return data
      }

      //Al seleccionar un concesionario recuperamos el número de RUC
      concesionarios.addEventListener("change", function(event) {
        const indice = event.target.selectedIndex
        if (indice > 0 ) {
          ruc.value = dataConcesionarios[indice - 1].ruc 

          //Se debe mostrar las tiendas
          const idconcesionario = parseInt(this.value)
          console.log(idconcesionario)
        }else{
          ruc.value = ""
        }
      })

      renderConcesionarios()
    });
  </script>

  <?php require_once "../partials/footer.php"; ?>