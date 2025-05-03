<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex align-items-center justify-content-start">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Concesionarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registrar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 text-end">
        <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/concesionarios/" class="">Mostrar lista</a>
      </div>
    </div>
  </div>

  <div class="mb-2">
    <form action="" autocomplete="off">
      <div class="card mb-0">
        <div class="card-header">Complete la información solicitada</div>
        <div class="card-body">
          <div class="row g-2">
            <div class="col-md-3">
              <div class="input-group">
                <div class="form-floating">
                  <input type="text" id="ruc" class="form-control text-center" maxlength="11" minlength="11"
                    placeholder="RUC" autofocus required>
                  <label for="ruc" class="form-label">RUC</label>
                </div>
                <button class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i></button>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating">
                <input type="text" class="form-control" id="nombrecomercial" placeholder="Nombre comercial">
                <label for="nombrecomercial" class="form-label">Nombre comercial</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="nombrecomercial" placeholder="Nombre comercial">
                <label for="nombrecomercial" class="form-label">Nombre comercial</label>
              </div>
            </div>
          </div> <!-- ./row -->
        </div> <!-- ./card-body -->
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-outline-secondary">Cancelar</button>
          <button class="btn btn-sm btn-primary">Guardar</button>
        </div> <!-- ./card-footer -->
      </div> <!-- ./card -->
    </form>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6 d-flex align-items-center justify-content-start">
          <span>Lista de tiendas</span>
        </div>
        <div class="col-md-6 text-end">
          <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
            data-bs-target="#modal-tiendas">Agregar</a>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="row g-2">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Ubigeo</th>
                  <th>Dirección</th>
                  <th>Teléfono</th>
                  <th>Email</th>
                  <th>Contacto</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="7" class="text-center mt-2 mb-2">No hay tiendas registradas</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Zona de modales -->
  <div class="modal fade" id="modal-tiendas" tabindex="-1" aria-labelledby="Modal tiendas" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-yonda">
          <h5 class="modal-title">Agregar tienda</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" autocomplete="off" id="form-registro-tienda">
            <div class="form-floating mb-2">
              <select name="departamentos" id="departamentos" class="form-select">
                <option value="">Seleccione</option>
              </select>
              <label for="">Departamentos</label>
            </div>
            <div class="form-floating mb-2">
              <select name="provincias" id="provincias" class="form-select">
                <option value="">Seleccione</option>
              </select>
              <label for="">Provincias</label>
            </div>
            <div class="form-floating mb-2">
              <select name="distritos" id="distritos" class="form-select">
                <option value="">Seleccione</option>
              </select>
              <label for="">Distritos</label>
            </div>
            <div class="mb-2">
              <textarea name="" id="" rows="3" class="form-control" placeholder="Dirección"></textarea>
            </div>

            <div class="row g-2">
              <div class="col-md-4">
                <div class="form-floating mb-2">
                  <input type="text" id="telefono" name="telefono" maxlength="12" minlength="9" pattern="[0-9]+"
                    title="Solo se permiten números" class="form-control" placeholder="Teléfono">
                  <label for="telefono">Teléfono</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-floating">
                  <input type="text" name="contacto" id="contacto" class="form-control" placeholder="Contacto" required>
                  <label for="contacto" class="form-label">Contacto</label>
                </div>
              </div>
            </div>
            <div class="form-floating mb-2">
              <input type="email" name="email" id="email" class="form-control" placeholder="Email">
              <label for="email" class="form-label">Email</label>
            </div>


          </form>
        </div> <!-- ./modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-sm btn-primary">Agregar</button>
        </div>
      </div> <!-- ./modal-content -->
    </div> <!-- ./modal-dialog -->
  </div> <!-- ./modal -->
  <!-- Fin de Zona de modales -->


  <script>
    document.addEventListener("DOMContentLoaded", () => {
      
      const departamentos = document.querySelector("#departamentos");
      const provincias = document.querySelector("#provincias");
      const distritos = document.querySelector("#distritos");
      
      function getAllDepartamentos(){
        const params = new URLSearchParams();
        params.append("operation", 'getAllDepartamentos');

        fetch(`../../app/controllers/ubigeo.c.php?${params}`)
          .then(response => response.json() )
          .then(data => {
            
            departamentos.innerHTML = `<option value='' selected>Seleccione</option>`;
            if (data.length > 0){
              data.forEach(element => {
                departamentos.innerHTML += `
                  <option value='${element.iddepartamento}'>${element.departamento}</option>
                `;
              });
            }
          })
          .catch(e => { console.log(e) });
      }

      function getAllProvincias(){
        const params = new URLSearchParams();
        params.append("operation", 'getAllProvincias');
        params.append("iddepartamento", parseInt(departamentos.value));

        fetch(`../../app/controllers/ubigeo.c.php?${params}`)
          .then(response => response.json() )
          .then(data => {
            provincias.innerHTML = `<option value='' selected>Seleccione</option>`;
            if (data.length > 0){
              data.forEach(element => {
                provincias.innerHTML += `
                  <option value='${element.idprovincia}'>${element.provincia}</option>
                `;
              });
            }
          })
          .catch(e => { console.log(e) });
      }

      function getAllDistritos(){
        const params = new URLSearchParams();
        params.append("operation", 'getAllDistritos');
        params.append("idprovincia", parseInt(provincias.value));

        fetch(`../../app/controllers/ubigeo.c.php?${params}`)
          .then(response => response.json() )
          .then(data => {
            distritos.innerHTML = `<option value='' selected>Seleccione</option>`;
            if (data.length > 0){
              data.forEach(element => {
                distritos.innerHTML += `
                  <option value='${element.iddistrito}'>${element.distrito}</option>
                `;
              });
            }
          })
          .catch(e => { console.log(e) });
      }

      departamentos.addEventListener("change", () => {
        getAllProvincias();
      })

      provincias.addEventListener("change", () => {
        getAllDistritos();
      })

      getAllDepartamentos();
    });

  </script>

  <?php require_once "../partials/footer.php"; ?>