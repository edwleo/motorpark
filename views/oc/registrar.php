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
              <input type="text" class="form-control text-center" id="serie" maxlength="11" value="2025-0001254"
                disabled>
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
          <div class="col-md-3">
            <div class="form-floating">
              <input type="text" class="form-control" name="direccion" id="direccion" readonly>
              <label for="form-label">Dirección</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating">
              <input type="text" class="form-control" name="asesor" id="asesor" readonly>
              <label for="form-label">Asesor</label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="input-group">
              <div class="form-floating">
                <input type="text" class="form-control text-center" name="telefono" id="telefono" readonly>
                <label for="form-label">Teléfono</label>
              </div>
              <button class="btn btn-outline-success" type="button" id="abrir-wsp" title="Contactar por WhatsApp"><i
                  class="fa-brands fa-whatsapp"></i></button>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-floating">
              <input type="text" class="form-control text-center" name="stock" id="stock">
              <label for="form-label">Stock</label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-floating">
              <select name="moneda" id="moneda" class="form-select">
                <option value="USD">Dólares</option>
                <option value="PEN">Soles</option>
              </select>
              <label class="form-label" for="moneda">Moneda</label>
            </div>
          </div>
        </div> <!-- ./row -->

      </div> <!-- ./card-body -->
    </div><!-- ./card -->
  </form>

  <div class="card mb-2">
    <div class="card-body">
      <form action="">
        <div class="row">
          <div class="col-md-6 d-flex align-items-center justify-content-start">
            <strong class="me-2">Tipo de item:</strong>
            <div class="me-3">
              <input type="radio" class="form-check-input" name="tipo" id="tipo-vehiculo" checked>
              <label for="tipo-vehiculo" class="form-check-label">Vehículo</label>
            </div>
            <div class="">
              <input type="radio" class="form-check-input" name="tipo" id="tipo-accesorio">
              <label for="tipo-accesorio" class="form-check-label">Accesorio</label>
            </div>
          </div>
          <div class="col-md-6 text-end">
            <button class="btn btn-sm btn-success" id="agregar-item" type="button">Agregar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

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
      <button type="reset" class="btn btn-outline-secondary btn-sm">Cancelar</button>
      <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
    </div>
  </div>

  <!-- Zona de modales -->
  <div class="modal fade" id="modal-vehiculo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-vehiculo" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-yonda">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del vehículo a comprar</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-2">

          <!-- Formulario para datos generales de/los vehiculos -->
          <form action="" id="formulario-vehiculo" autocomplete="off">
            <div class="row g-2">
              <div class="col-md-2 mb-2">
                <div class="form-floating">
                  <input type="number" id="cantidad" value="1" min="1" max="20" class="form-control text-center">
                  <label for="cantidad">Cantidad</label>
                </div>
              </div>
              <div class="col-md-3 mb-2">
                <div class="form-floating">
                  <select name="marcas" id="marcas" class="form-select" required>
                    <option value="">Seleccione</option>
                    <option value="">KIA</option>
                    <option value="">HYUNDAI</option>
                  </select>
                  <label for="marcas" class="form-label">Marca <span class="text-danger">*</span></label>
                </div>
              </div>
              <div class="col-md-2 mb-2">
                <div class="form-floating">
                  <select name="tipos" id="tipos" class="form-select" required>
                    <option value="">Seleccione</option>
                    <option value="">SUV</option>
                    <option value="">Hatchback</option>
                    <option value="">Sedan</option>
                  </select>
                  <label for="tipos">Tipo de vehículo <span class="text-danger">*</span></label>
                </div>
              </div>
              <div class="col-md-3 mb-2">
                <div class="form-floating">
                  <select name="modelos" id="modelos" class="form-select" required>
                    <option value="">Modelos</option>
                    <option value="">Creta</option>
                    <option value="">Tucson</option>
                    <option value="">Santa Fe</option>
                  </select>
                  <label for="modelos">Modelos disponibles <span class="text-danger">*</span></label>
                </div>
              </div>
              <div class="col-md-2 mb-2">
                <div class="input-group">
                  <div class="form-floating">
                    <select name="anio" id="anio" class="form-select" required>
                      <option value="">Seleccione</option>
                      <option value="">2025</option>
                    </select>
                    <label for="anio">Año <span class="text-danger">*</span></label>
                  </div>
                  <button type="button" class="btn btn-outline-success"
                    title="Incrementa el año del modelo y lo guarda en la base de datos">+</button>
                </div>
              </div>
            </div>

            <div class="row g-2">
              <div class="col-md-2 mb-2">

                <!-- lista de versiones -->
                <div class="form-floating" id="bloque-version-lista">
                  <select name="version-ls" id="version-ls" class="form-select" required>
                    <option value="">Seleccione</option>
                    <optgroup label="Prestaciones">
                      <option value="Básico">Básico</option>
                      <option value="Semi Full">Semi Full</option>
                      <option value="Full">Full</option>
                      <option value="Tope de gama">Tope de gama</option>
                    </optgroup>
                    <optgroup label="Otro">
                      <option value="ESP">Especificar...</option>
                    </optgroup>
                  </select>
                  <label for="version-ls">Versión <span class="text-danger">*</span></label>
                </div>

                <!-- input de versión (especificada por el usuario) -->
                <div class="input-group d-none" id="bloque-version-input">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="version-in">
                    <label for="version-in">Describa la versión</label>
                  </div>
                  <button type="button" id="mostrar-version-ls" class="btn btn-outline-secondary"
                    title="Mostrar lista"><i class="fa-solid fa-bars-staggered"></i></button>
                </div>

              </div>
              <div class="col-md-3 mb-2">
                <div class="form-floating">
                  <select name="condicion" id="condicion" class="form-select" required>
                    <option value="nuevo" selected>Nuevo</option>
                    <option value="seminuevo">Seminuevo</option>
                  </select>
                  <label for="condicion">Condición <span class="text-danger">*</span></label>
                </div>
              </div>
              <div class="col-md-3 mb-2">
                <div class="form-floating">
                  <select name="combustible" id="combustible" class="form-select" required>
                    <option value="">Seleccione</option>
                    <option value="">Gasolina</option>
                    <option value="">Diesel</option>
                    <option value="">GLP</option>
                    <option value="">GNV</option>
                    <option value="">Dual: Gasolina, GLP</option>
                  </select>
                  <label for="combustible">Tipo de combustible <span class="text-danger">*</span></label>
                </div>
              </div>
              <div class="col-md-2 mb-2">
                <div class="form-floating">
                  <input type="text" id="color" class="form-control" placeholder="Color">
                  <label for="color">Color</label>
                </div>
              </div>
              <div class="col-md-2 mb-2">
                <div class="form-floating">
                  <input type="text" id="precio" class="form-control text-end" pattern="[0-9]+"
                    title="Solo se permiten números" placeholder="Precio" required>
                  <label for="precio">Precio <span class="text-danger">*</span></label>
                </div>
              </div>
            </div>
          </form>
          <!-- Fin formulario datos generales del vehículo -->

          <hr>

          <!-- Fila para agregar chasis, placa, placa rotativa y serie motor -->
          <div class="row g-2">

            <div class="row mt-2 g-2">
              <div class="col-md-1 text-center">#</div>
              <div class="col-md-4">Chasis</div>
              <div class="col-md-2">Placa</div>
              <div class="col-md-2">Placa rotativa</div>
              <div class="col-md-3">Serie</div>
            </div>

            <!-- Se van a generar inputs para agregar los datos de los vehículos -->
            <div class="content" id="inputs-dinamicos">
              <!-- Contenido generado de forma dinámica -->
            </div>

            <!-- Fila para leyenda de campos obligatorios -->
            <div class="row">
              <div class="col-md-12">
                <span class="fst-italic text-danger">* Campos obligatorios</span>
              </div>
            </div>

            </dv>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" form="formulario-vehiculo" id="registrar-vehiculo"
                class="btn btn-sm btn-primary">Agregar</button>
            </div>
          </div>
        </div> <!-- /.modal-dialog -->
      </div> <!-- ./modal -->
      <!-- Fin Zona de modales -->


      <script>
        document.addEventListener("DOMContentLoaded", () => {

          const modalVehiculo = new bootstrap.Modal(document.getElementById("modal-vehiculo"))
          const concesionarios = document.querySelector("#concesionarios")

          //input form datos de la OC
          const ruc = document.querySelector("#ruc")
          const tiendas = document.querySelector("#tiendas")
          const direccion = document.querySelector("#direccion")
          const telefono = document.querySelector("#telefono")
          const asesor = document.querySelector("#asesor")
          const moneda = document.querySelector("#moneda")

          //input form vehiculos (modal)
          const cantidad = document.querySelector("#cantidad")
          const tipos = document.querySelector("#tipos")
          const marcas = document.querySelector("#marcas")
          const modelos = document.querySelector("#modelos")
          const versionLS = document.querySelector("#version-ls")
          const versionIN = document.querySelector("#version-in")
          const mostrarVersionLS = document.querySelector("#mostrar-version-ls")
          const registrarVehiculo = document.querySelector("#registrar-vehiculo")

          //Formularios
          const formVehiculo = document.querySelector("#formulario-vehiculo")

          const abrirWsp = document.querySelector("#abrir-wsp")
          const agregarItem = document.querySelector("#agregar-item")

          let dataConcesionarios = []
          let dataTiendas = []
          let dataVehiculos = []

          function generadorInputsDinamicos(cantidad) {
            const inputsDinamicos = document.querySelector("#inputs-dinamicos")

            if (cantidad > 0) {
              inputsDinamicos.innerHTML = ``
              for (let i = 1; i <= cantidad; i++) {
                inputsDinamicos.innerHTML += `
                <div class="row g-2">
                  <div class="col-md-1 mb-2"><input type="text" class="form-control text-center" id="idvh${i}" value="${i}" disabled></div>
                  <div class="col-md-4 mb-2"><input type="text" class="form-control" id="chas${i}"></div>
                  <div class="col-md-2 mb-2"><input type="text" class="form-control" id="plac${i}"></div>
                  <div class="col-md-2 mb-2"><input type="text" class="form-control" id="plar${i}"></div>
                  <div class="col-md-3 mb-2"><input type="text" class="form-control" id="seri${i}"></div>
                </div>
                `;
              }
            }
          }

          //Se deberán generar input de forma dinámica para agregar: id, chasis, placa, placa rotativa, serie
          cantidad.addEventListener("change", function (event) {
            generadorInputsDinamicos(parseInt(this.value))
          })

          //Se deberán generar input de forma dinámica para agregar: id, chasis, placa, placa rotativa, serie
          cantidad.addEventListener("keyup", function (event) {
            if (this.value != "") {
              generadorInputsDinamicos(parseInt(this.value))
            }
          })

          //Abre Web WhatsApp con el número indicado
          abrirWsp.addEventListener("click", () => {
            if (telefono.value.length >= 9) {
              window.open(`https://web.whatsapp.com/send?phone=${telefono.value}`, '_blank')
            }
          })

          agregarItem.addEventListener("click", () => {
            modalVehiculo.show()
          })

          //Si elige VERSION (especificar...) debemos mostrar una caja de texto
          versionLS.addEventListener("change", (event) => {
            const opcion = event.target.value

            if (opcion == "ESP") {
              document.querySelector("#bloque-version-lista").classList.add("d-none")
              document.querySelector("#bloque-version-input").classList.remove("d-none")
              versionIN.value = ``
              versionIN.focus()
            } else {
              versionIN.value = versionLS.value
            }
          })

          //Cuando se especifica la VERSION manualmente (input) se puede volver a mostrar la lista
          mostrarVersionLS.addEventListener("click", () => {
            versionIN.value = ``;
            document.querySelector("#bloque-version-lista").classList.remove("d-none")
            document.querySelector("#bloque-version-input").classList.add("d-none")
            versionLS.value = ``
          })

          //Registra un vehículo (envía los datos a un arreglo)
          formVehiculo.addEventListener("submit", function (event) {
            event.preventDefault()
            const pregunta = (cantidad.value) == 1 ? "¿Agregamos este vehículo?" : "¿Agregamos los vehículos de la lista?"

            if (confirm(pregunta)) {

              for (let i = 1; i <= parseInt(cantidad.value); i++) {
                //Respaldamos la información ingresada en un objeto
                const vehiculo = {
                  idmodelo: idmodelo.value,
                  version: version.value,
                  condicion: condicion.value
                }
              }

            }
          })

          async function obtenerConcesionarios() {
            const response = await fetch(`../../app/controllers/concesionario.c.php?operation=getAllConcesionarios`, { method: 'GET' })
            const data = await response.json()
            return data
          }

          async function renderConcesionarios() {
            dataConcesionarios = await obtenerConcesionarios()
            if (dataConcesionarios.length > 0) {
              concesionarios.innerHTML = `<option value=''>Seleccione</option>`
              dataConcesionarios.forEach(element => {
                concesionarios.innerHTML += `<option value='${element.idconcesionario}'>${element.nombrecomercial}</option>`
              });
            }
          }

          //Obtiene las marcas desde una consulta asíncrona y lo renderiza en el control <select>
          async function listarMarcas(){
            const response = await fetch(`../../app/controllers/marca.c.php?operation=getAll`, { method: 'GET' })
            const data = await response.json()
            
            if (data.length > 0){
              marcas.innerHTML = `<option value=''>Seleccione</option>`
              data.forEach(element => {
                marcas.innerHTML += `<option value='${element.idmarca}'>${element.marca}</option>`
              });
            }else{
              marcas.innerHTML = `<option value=''>No hay datos</option>`
            }
          }

          async function obtenerTiendas(id) {
            const response = await fetch(`../../app/controllers/tienda.c.php?operation=getTiendasByIdConcesionario&idconcesionario=${id}`, { method: 'GET' })
            const data = await response.json()
            return data
          }

          function resetFormOC() {
            ruc.value = ""
            direccion.value = ""
            asesor.value = ""
            telefono.value = ""
            moneda.value = "USD"
          }

          //Al cambiar una marca de la lista, se recargan los tipo de vehiculos
          marcas.addEventListener("change", async function(event) {
            const idmarca = parseInt(this.value)
            const response = await fetch(`../../app/controllers/tipovehiculo.c.php?operation=getTipoVehiculoByMarca&idmarca=${idmarca}`, {method: 'GET'})
            const data = await response.json()

            if (data.length > 0){
              tipos.innerHTML = `<option value=''>Seleccione</option>`
              data.forEach(element => {
                tipos.innerHTML += `<option value='${element.idtipovehiculo}'>${element.tipovehiculo}</option>`
              });
              modelos.innerHTML = `<option value=''>Seleccione</option>`
            }else{
              tipos.innerHTML = `<option value=''>No hay  datos</option>`
              modelos.innerHTML = `<option value=''>No hay  datos</option>`
            }
          })

          tipos.addEventListener("change", async function (){
            const idmarca = parseInt(marcas.value)
            const idtipovehiculo = parseInt(tipos.value)
            const response = await fetch(`../../app/controllers/modelo.c.php?operation=getModelosByTipoMarca&idmarca=${idmarca}&idtipovehiculo=${idtipovehiculo}`, { method: 'GET' })
            const data = await response.json()

            if (data.length > 0){
              modelos.innerHTML = `<option value=''>Seleccione</option>`
              data.forEach(element => {
                modelos.innerHTML += `<option value='${element.idmodelo}'>${element.modelo}</option>`
              });
            }else{
              modelos.innerHTML = `<option value=''>No hay  datos</option>`
            }

          })

          //Al seleccionar un concesionario recuperamos el número de RUC
          concesionarios.addEventListener("change", async function (event) {

            //Reiniciando formulario
            ruc.value = ""
            direccion.value = ""
            asesor.value = ""
            telefono.value = ""
            moneda.value = "USD"

            const indice = event.target.selectedIndex
            if (indice > 0) {
              ruc.value = dataConcesionarios[indice - 1].ruc

              //Se debe mostrar las tiendas
              const idconcesionario = parseInt(this.value)
              dataTiendas = await obtenerTiendas(idconcesionario)
              if (dataTiendas.length == 0) {
                tiendas.innerHTML = `<option value=''>No hay tiendas registradas</option>`
              } else {
                tiendas.innerHTML = `<option value=''>Seleccione</option>`
                dataTiendas.forEach(element => {
                  tiendas.innerHTML += `<option value='${element.idtienda}'>${element.ubigeo}</option>`;
                });
              }
            } else {
              tiendas.innerHTML = `<option value=''>Seleccione</option>`
            }
          })

          //Al cambiar una tienda de la lista se debe mostrar la dirección, teléfono y el asesor
          tiendas.addEventListener("change", (event) => {
            const indice = event.target.selectedIndex
            if (indice == 0) {
              direccion.value = ``
              telefono.value = ``
              asesor.value = ``
            } else {
              direccion.value = dataTiendas[indice - 1].direccion
              telefono.value = dataTiendas[indice - 1].telefono
              asesor.value = dataTiendas[indice - 1].contacto
            }
          })

          renderConcesionarios()
          listarMarcas()
        });
      </script>

      <?php require_once "../partials/footer.php"; ?>