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
    <form action="" id="form-registro-concesionario" autocomplete="off">
      <div class="card mb-0">
        <div class="card-header">Complete la información solicitada</div>
        <div class="card-body">
          <div class="row g-2">
            <div class="col-md-3">
              <div class="input-group">
                <div class="form-floating">
                  <input type="text" id="ruc" class="form-control text-center" pattern="[0-9]+"
                    title="Solo se permiten números" maxlength="11" minlength="11" placeholder="RUC" 
                    autofocus required>
                  <label for="ruc" class="form-label">RUC</label>
                </div>
                <button type="button" id="btn-buscar-concesionario" class="btn btn-success"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating">
                <input type="text" class="form-control" id="nombrecomercial" placeholder="Nombre comercial" required>
                <label for="nombrecomercial" class="form-label">Nombre comercial</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="razonsocial" placeholder="Razon social" readonly required>
                <label for="razonsocial" class="form-label">Razon social</label>
              </div>
            </div>
          </div> <!-- ./row -->
        </div> <!-- ./card-body -->
        <div class="card-footer text-end">
          <button type="reset" id="btn-cancelar-registro" class="btn btn-sm btn-outline-secondary">Cancelar</button>
          <button type="submit" id="btn-registrar-concesionario" class="btn btn-sm btn-primary">Guardar</button>
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
          <button type="button" id="btn-modal-tiendas" class="btn btn-sm btn-outline-primary">Agregar</button>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="row g-2">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-sm" id="tabla-tiendas">
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
      <form action="" autocomplete="off" id="form-registro-tienda">
        <div class="modal-content">
          <div class="modal-header bg-yonda">
            <h5 class="modal-title">Agregar tienda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-floating mb-2">
              <select name="departamentos" id="departamentos" class="form-select" required>
                <option value="">Seleccione</option>
              </select>
              <label for="">Departamentos</label>
            </div>
            <div class="form-floating mb-2">
              <select name="provincias" id="provincias" class="form-select" required>
                <option value="">Seleccione</option>
              </select>
              <label for="">Provincias</label>
            </div>
            <div class="form-floating mb-2">
              <select name="distritos" id="distritos" class="form-select" required>
                <option value="">Seleccione</option>
              </select>
              <label for="">Distritos</label>
            </div>
            <div class="mb-2">
              <textarea name="direccion" id="direccion" rows="3" class="form-control" placeholder="Dirección"
                required></textarea>
            </div>

            <div class="row g-2">
              <div class="col-md-4">
                <div class="form-floating mb-2">
                  <input type="text" id="telefono" name="telefono" maxlength="12" minlength="9" pattern="[0-9]+"
                    title="Solo se permiten números" class="form-control" placeholder="Teléfono" required>
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
              <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
              <label for="email" class="form-label">Email</label>
            </div>

          </div> <!-- ./modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-sm btn-primary" id="btn-agregar-tienda">Guardar</button>
          </div>
        </div> <!-- ./modal-content -->
      </form>
    </div> <!-- ./modal-dialog -->
  </div> <!-- ./modal -->
  <!-- Fin de Zona de modales -->


  <script>
    document.addEventListener("DOMContentLoaded", () => {

      let idtiendaActualizar = null
      let idconcesionario = null
      let filaRemover = null
      let datosNuevos = true

      const modalTienda = new bootstrap.Modal(document.getElementById("modal-tiendas"))
      const ruc = document.querySelector("#ruc")
      const nombreComercial = document.querySelector("#nombrecomercial")
      const razonSocial = document.querySelector("#razonsocial")
      const btnBuscarConcesionario = document.querySelector("#btn-buscar-concesionario")
      const departamentos = document.querySelector("#departamentos")
      const provincias = document.querySelector("#provincias")
      const distritos = document.querySelector("#distritos")
      const direccion = document.querySelector("#direccion")
      const email = document.querySelector("#email")
      const contacto = document.querySelector("#contacto")
      const telefono = document.querySelector("#telefono")
      const formRegistroTienda = document.querySelector("#form-registro-tienda")
      const formRegistroConcesionario = document.querySelector("#form-registro-concesionario")
      const btnRegistrarConcesionario = document.querySelector("#btn-registrar-concesionario")
      const btnCancelarRegistro = document.querySelector("#btn-cancelar-registro")
      const btnModalTiendas = document.querySelector("#btn-modal-tiendas")
      const tablaTiendas = document.querySelector("#tabla-tiendas tbody") //Cuerpo de la tabla

      //Obtiene los datos del concesionario utilizando una fuente externa API
      async function obtenerDatosConcesionario() {
        razonSocial.value = "Buscando..."
        if (ruc.value.length == 11) {
          await fetch(`../../app/api/ruc.api.php?ruc=${ruc.value}`)
            .then(response => response.json())
            .then(data => {
              if (data.razonSocial !== undefined){
                razonSocial.value = data.razonSocial
                nombreComercial.value = ``
                nombreComercial.focus()
              }else{
                showToast('No existe la empresa', 'WARNING', 2000)
                razonSocial.value = ""
                nombreComercial.value = ""
                ruc.focus()
              }
            })
            .catch(error => {
              console.error(error)
            });
        } else {
          showToast("Se requiere 11 dígitos", 'WARNING', 1500);
        }
      }

      function getAllDepartamentos() {
        const params = new URLSearchParams();
        params.append("operation", 'getAllDepartamentos');

        fetch(`../../app/controllers/ubigeo.c.php?${params}`)
          .then(response => response.json())
          .then(data => {

            departamentos.innerHTML = `<option value='' selected>Seleccione</option>`;

            if (data.length > 0) {
              data.forEach(element => {
                departamentos.innerHTML += `
                  <option value='${element.iddepartamento}'>${element.departamento}</option>
                `;
              });
            }
          })
          .catch(e => { console.log(e) });
      }

      async function getAllProvincias(iddepartamento = null, idprovinciaDefault = null) {
        const params = new URLSearchParams();
        params.append("operation", 'getAllProvincias');
        params.append("iddepartamento", parseInt(iddepartamento));

        await fetch(`../../app/controllers/ubigeo.c.php?${params}`)
          .then(response => response.json())
          .then(data => {
            provincias.innerHTML = `<option value='' selected>Seleccione</option>`;
            distritos.innerHTML = `<option value='' selected>Seleccione</option>`;
            if (data.length > 0) {
              data.forEach(element => {
                provincias.innerHTML += `
                  <option value='${element.idprovincia}'>${element.provincia}</option>
                `;
              });
            }
          })
          .then(() => {
            if (idprovinciaDefault != null) {
              provincias.value = idprovinciaDefault
            }
          })
          .catch(e => { console.log(e) });
      }

      async function getAllDistritos(idprovincia = null, iddistritoDefault = null) {
        const params = new URLSearchParams();
        params.append("operation", 'getAllDistritos');
        params.append("idprovincia", parseInt(idprovincia));

        await fetch(`../../app/controllers/ubigeo.c.php?${params}`)
          .then(response => response.json())
          .then(data => {
            distritos.innerHTML = `<option value='' selected>Seleccione</option>`;
            if (data.length > 0) {
              data.forEach(element => {
                distritos.innerHTML += `
                  <option value='${element.iddistrito}'>${element.distrito}</option>
                `;
              });
            }
          })
          .then(() => {
            //Valor predeterminado
            if (iddistritoDefault != null) {
              distritos.value = iddistritoDefault
            }
          })
          .catch(e => { console.log(e) });
      }

      //Busca al concesionario en la BD de la empresa
      function buscarConcesionario() {
        const params = new URLSearchParams()
        params.append("operation", "getConcesionarioByRUC")
        params.append("ruc", ruc.value)

        if (ruc.value.length == 11) {
          fetch(`../../app/controllers/consesionario.c.php?${params}`).
            then(response => response.json()).
            then(data => {
              if (data.length == 0) {
                //Procedemos a buscarlo con el API
                btnRegistrarConcesionario.removeAttribute("disabled");
                btnCancelarRegistro.removeAttribute("disabled");
                idconcesionario = null;
                obtenerDatosConcesionario();
              } else {
                //Existe en la BD
                idconcesionario = data[0].idconcesionario;
                nombreComercial.value = data[0].nombrecomercial;
                razonSocial.value = data[0].razonsocial;
                btnCancelarRegistro.setAttribute("disabled", true);
                btnRegistrarConcesionario.setAttribute("disabled", true);
                obtenerTiendas();
              }
            }).
            catch(error => { console.error(error) });
        } else {
          showToast("Se requiere 11 dígitos", "WARNING", 1500);
        }
      }

      function obtenerTiendas() {
        const params = new URLSearchParams()
        params.append("operation", "getTiendasByIdConcesionario")
        params.append("idconcesionario", idconcesionario)

        fetch(`../../app/controllers/tienda.c.php?${params}`)
          .then(response => response.json())
          .then(data => {
            if (data.length == 0) {
              tablaTiendas.innerHTML = `
                <tr>
                  <td colspan="7" class="text-center mt-2 mb-2">No hay tiendas registradas</td>
                </tr>
              `;
            } else {
              tablaTiendas.innerHTML = ``;
              let numFila = 1;
              data.forEach(tienda => {
                tablaTiendas.innerHTML += `
                  <tr>
                    <td>${numFila}</td>
                    <td>${tienda.ubigeo}</td>
                    <td>${tienda.direccion}</td>
                    <td>${tienda.telefono}</td>
                    <td>${tienda.email}</td>
                    <td>${tienda.contacto}</td>
                    <td>
                      <a href='#' title='Editar' data-idtienda='${tienda.idtienda}' class='edit'><i class="fa-solid fa-pen"></i></a>
                      <a href='#' title='Eliminar' data-idtienda='${tienda.idtienda}' class='t-red delete'><i class="fa-solid fa-trash"></i></a>
                    </td>
                  </tr>
                `;
                numFila++;
              });
            }
          })
          .catch(error => console.error(error))
      }

      function eliminarTienda(id) {
        const params = new FormData()
        params.append("operation", "delete")
        params.append("id", id)

        fetch(`../../app/controllers/tienda.c.php`, {
          method: 'POST',
          body: params
        })
          .then(response => response.json())
          .then(data => {
            switch (data.filasAfectadas) {
              case -1: showToast('El proceso ha generado un error', 'DANGER', 1500); break;
              case 0: showToast('No se pudo concretar la eliminación', 'WARNING', 1500); break;
              case 1:
                showToast('Eliminado correctamente', 'SUCCESS', 1500);
                filaRemover.remove();
                filaRemover = null;
                break;
            }
          })
          .catch(error => { console.log(data) })
      }

      //Esta función permite registrar o actualizar datos
      async function guardarTienda() {

        //datosNuevos cambia en función de CREACIÓN / EDICIÓN
        const operation = (datosNuevos) ? 'create' : 'update'
        const params = new FormData()

        params.append("operation", operation)
        params.append("idtienda", idtiendaActualizar)
        params.append("iddistrito", distritos.value)
        params.append("idconcesionario", idconcesionario)
        params.append("direccion", direccion.value)
        params.append("email", email.value)
        params.append("telefono", telefono.value)
        params.append("contacto", contacto.value)

        await fetch(`../../app/controllers/tienda.c.php`, {
          method: 'POST',
          body: params
        })
          .then(response => response.json())
          .then(data => {

            //El mensaje de confirmación está en relación al tipo de proceso (registro - actualización)
            //y el valor obtenido en el id (cantidad de registros afectados)
            if (datosNuevos){
              if (data.id > 0){
                showToast("Guardado correctamente", "SUCCESS", 2000);
                obtenerTiendas();
                modalTienda.hide();
              }else{
                showToast("Verifique los datos", "WARNING", 1500);
              }
            }else{
              if (data.id > 0){
                showToast("Actualizado correctamente", "SUCCESS", 1500);
                obtenerTiendas();
              }else{
                showToast("No hubo cambios", "INFO", 1500);
              }
              modalTienda.hide();
            }
          })
          .catch(error => { console.log(error) });
      }

      async function setIdDepartamento(id) {
        departamentos.value = id
      }

      //Muestra los datos en el formulario contenido en el modal previo a su actualización
      async function mostrarRegistroTienda(id) {
        const response = await fetch(`../../app/controllers/tienda.c.php?operation=getTiendasById&idtienda=${id}`)
        const data = await response.json()

        if (data.length > 0) {
          datosNuevos = false //Actualizará el registro

          //Enviando en orden asíncrono los datos
          await setIdDepartamento(data[0].iddepartamento)
          await getAllProvincias(data[0].iddepartamento, data[0].idprovincia)
          await getAllDistritos(data[0].idprovincia, data[0].iddistrito)

          //Asigando valores restantes
          idtiendaActualizar = parseInt(data[0].idtienda)
          direccion.value = data[0].direccion
          telefono.value = data[0].telefono
          email.value = data[0].email
          contacto.value = data[0].contacto

          document.querySelector('#modal-tiendas .modal-title').innerHTML = 'Actualizar tienda'
        }
      }

      //Eventos
      departamentos.addEventListener("change", () => { getAllProvincias(departamentos.value); })
      provincias.addEventListener("change", () => { getAllDistritos(provincias.value); })
      distritos.addEventListener("change", () => { direccion.focus(); })

      //Botón para abrir el modal de registro/edición de tiendas
      btnModalTiendas.addEventListener("click", () => {
        if (idconcesionario === null) {
          showToast("Primero indicar la tienda", "INFO", 1500)
          ruc.focus()
        } else {
          distritos.innerHTML = `<option value='' selected>Seleccione</option>`
          provincias.innerHTML = `<option value='' selected>Seleccione</option>`
          departamentos.value = ''
          document.querySelector('#modal-tiendas .modal-title').innerHTML = 'Registrar tienda'
          datosNuevos = true
          modalTienda.show()
        }
      })

      document.querySelector("#modal-tiendas").addEventListener("hidden.bs.modal", (event) => { formRegistroTienda.reset(); })
      btnBuscarConcesionario.addEventListener("click", () => { buscarConcesionario(); })

      ruc.addEventListener("keypress", (event) => { if (event.keyCode == 13) buscarConcesionario() })

      formRegistroConcesionario.addEventListener("submit", (event) => {
        event.preventDefault();

        if (confirm("¿Desea registrar este concesionario?")) {
          const params = new FormData();
          params.append("operation", "create");
          params.append("ruc", ruc.value);
          params.append("razonsocial", razonSocial.value);
          params.append("nombrecomercial", nombreComercial.value);

          fetch(`../../app/controllers/consesionario.c.php`, {
            method: 'POST',
            body: params
          })
            .then(response => response.json())
            .then(data => {
              if (data.id > 0) {
                idconcesionario = data.id
                showToast("Nuevo concesionario", "SUCCESS", 1500);
                btnCancelarRegistro.setAttribute("disabled", true);
                btnRegistrarConcesionario.setAttribute("disabled", true);
              } else {
                idconcesionario = null;
              }
            })
            .catch(error => { console.error(error) });
        }
      })

      formRegistroTienda.addEventListener("submit", async (event) => {
        event.preventDefault();

        if (confirm("¿Está seguro de continuar?")) {
          await guardarTienda()
        }
      });

      //Evento clic para boton de edición - eliminación
      document.querySelector("#tabla-tiendas tbody").addEventListener("click", async function (event) {
        const enlaceDelete = event.target.closest('.delete')
        const enlaceEdit = event.target.closest('.edit')

        //Si el proceso de eliminación retorna 1, entonces ya se tiene identificada la fila que deberá eliminarse
        filaRemover = event.target.closest('tr')

        if (enlaceEdit) {
          event.preventDefault()
          const idtienda = parseInt(enlaceEdit.getAttribute('data-idtienda'))
          await modalTienda.show()
          await mostrarRegistroTienda(idtienda)
        }

        if (enlaceDelete) {
          event.preventDefault()
          if (confirm("¿Está seguro de eliminar el registro?")) {
            const idtienda = parseInt(enlaceDelete.getAttribute('data-idtienda'))
            eliminarTienda(idtienda)
          }
        }
      });

      //Funciones que inician
      getAllDepartamentos();
    });

  </script>

  <?php require_once "../partials/footer.php"; ?>