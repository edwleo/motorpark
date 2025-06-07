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
        <!-- <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/compras/registrar" class="">Registrar</a> -->
         <span>Desde este módulo podrá gestionar marcas, tipos y modelos</span>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Marcas -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">Lista de marcas</div>
            <div class="col text-end"><a href="#" id="lnk-agregar-marca">[ Agregar ]</a></div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-sm table-hover table-hover-yonda" id="tabla-marcas">
            <colgroup>
              <col style="width: 65%;">
              <col style="width: 10%;">
              <col style="width: 25%;">
            </colgroup>
            <thead>
              <tr>
                <th>Nombre marca</th>
                <th>#</th>
                <th class="text-center">Op</th>
              </tr>
            </thead>
            <tbody>
              <!-- datos asíncronos -->
            </tbody>
          </table>
          <div class="text-end">
            <span style="font-style: italic;">Seleccione un elemento</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin marcas -->
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
              <strong id="marca-activa">SIN ESPECIFICAR</strong>
            </div>
            <div class="col-md-6 text-end">
              <a href="#" id="lnk-agregar-modelo">[ Agregar ]</a>
            </div>
          </div>
        </div> <!-- ./card-header -->
        <div class="card-body">
          <table class="table table-sm table-hover table-hover-yonda" id="tabla-modelos">
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
                <td colspan="5" class="text-center">Seleccione una marca para continuar</td>
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

  <!-- Zona de modales -->
  <div class="modal fade" id="modal-marcas" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modalMarcas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form autocomplete="off" id="formulario-marcas">
          <div class="modal-header bg-yonda">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Marcas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-floating">
              <input type="text" class="form-control" id="marca" maxlength="30" placeholder="Nueva marca" required>
              <label for="marca" class="form-label">Nueva marca</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
          </div>
        </form>
      </div> <!-- ./model-content -->
    </div>
  </div>

  <div class="modal fade" id="modal-modelos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modalModelos" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <form autocomplete="off" id="formulario-modelos">
          <div class="modal-header bg-yonda">
            <h1 class="modal-title fs-5" id="modal-modelos-titulo">MODELO</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="row g-2">
              <div class="col-md-5">
                <div class="form-floating mb-2">
                  <select name="tipo" id="tipo-vehiculo" class="form-select" required>
                    <option value="">Seleccione</option>
                  </select>
                  <label for="tipo">Tipo vehículo</label>
                </div>
              </div>

              <div class="col-md-5">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="modelo" required>
                  <label for="modelo">Modelo</label>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control" maxlength="4" pattern="[0-9]+" title="Solo se permiten números" id="anio" required>
                  <label for="anio">Año</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <input type="file" id="imagen" class="form-control">
              </div>
            </div>

            <div class="row">
              <img src="../../public/images/vehiculos/model-cars.jpg" class="img-fluid">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
          </div>
        </form>
      </div> <!-- ./model-content -->
    </div>
  </div>
  <!-- Fin zona de modales -->

  <script>
    document.addEventListener("DOMContentLoaded", async () => {
      
      const tablaMarcas = document.querySelector("#tabla-marcas tbody")
      const tablaModelos = document.querySelector("#tabla-modelos tbody")
      const tipoVehiculo = document.querySelector("#tipo-vehiculo")
      const modelo = document.querySelector("#modelo")
      const anio = document.querySelector("#anio")
      const modalMarca = new bootstrap.Modal(document.getElementById("modal-marcas"))
      const modalModelo = new bootstrap.Modal(document.getElementById("modal-modelos"))
      const lnkAgregarMarca = document.querySelector("#lnk-agregar-marca")
      const lnkAgregarModelo = document.querySelector("#lnk-agregar-modelo")
      const formularioMarcas = document.querySelector("#formulario-marcas")
      const formularioModelos = document.querySelector("#formulario-modelos")
      const marca = document.querySelector("#marca")

      let idmarcaSeleccionada = -1;
      let listaMarcas = [] //Es una lista de marca que obtenemos del backend

      lnkAgregarMarca.addEventListener("click", () => {
        modalMarca.show()
      })

      lnkAgregarModelo.addEventListener("click", () => {
        modalModelo.show()
      })

      //Evento al ingresar al modal marcas
      document.getElementById("modal-marcas").addEventListener('shown.bs.modal', () => {
        marca.focus()
      })

      //Evento al salir al modal marcas
      document.getElementById("modal-marcas").addEventListener('hidden.bs.modal', () => {
        formularioMarcas.reset()
      })

      //Evento al ingresar al modal modelos
      document.getElementById("modal-modelos").addEventListener('shown.bs.modal', () => {
        tipoVehiculo.focus()
      })

      //Evento al salir del modal modelos
      document.getElementById("modal-modelos").addEventListener('hidden.bs.modal', () => {
        formularioModelos.reset()
      })

      /**
       * Verifica si una marca existe en el arreglo listaMarcas
       * @param {string} nombreMarca - La cadena que representa el nombre de marca a buscar
       * @returns {boolean} - true si la marca existe, false caso contrario
       */ 
      function existeMarca(nombreMarca){
        const marcaBuscadaMayusc = nombreMarca.toUpperCase()
        return listaMarcas.some(item => item.marca.toUpperCase() === marcaBuscadaMayusc)
      }

      //Controla el evento guardar del formulario marcas
      formularioMarcas.addEventListener("submit", async (event) => {
        event.preventDefault()
        
        if (existeMarca(marca.value)){
          showToast("Esta marca ya está registrada", "WARNING", 2000);
          return
        }

        if (confirm("¿Registramos la marca?")){
          const params = new FormData()
          params.append("operation", "create")
          params.append("marca", marca.value)

          await fetch(`../../app/controllers/marca.c.php`, {
            method: 'POST',
            body: params
          })
            .then(response => response.json())
            .then(data => {
              if (data.id > 0){
                showToast("Guardado correctamente", "SUCCESS", 2000);
                listarMarcas()
              }else{
                showToast("No se pudo concretar el proceso", "INFO", 2500);
              }
              modalMarca.hide()
            })
        }
      })

      formularioModelos.addEventListener("submit", async (event) => {
        event.preventDefault()

        if (confirm("¿Registramos el nuevo modelo?")){
          const params = new FormData()
          params.append("operation", "create")
          params.append("idmarca", idmarcaSeleccionada)
          params.append("idtipovehiculo", tipoVehiculo.value)
          params.append("modelo", modelo.value)
          params.append("anio", anio.value)

          await fetch(`../../app/controllers/modelo.c.php`, {
            method: 'POST',
            body: params
          })
            .then(response => response.json())
            .then(data => {
              if (data.id > 0){
                showToast("Guardado correctamente", "SUCCESS", 2000)
                listarMarcas()
                listarModelos()
              }else{
                showToast("No se pudo concretar el proceso", "INFO", 2500)
              }
              modalModelo.hide()
            })
        }
      })

      async function obtenerMarcas(){
        const request = await fetch('../../app/controllers/marca.c.php?operation=getAll', {method: 'GET'})
        const data = await request.json()
        return data
      }

      async function listarMarcas(){
        listaMarcas = await obtenerMarcas()
        if (listaMarcas.length > 0){
          tablaMarcas.innerHTML = ``
          listaMarcas.forEach(element => {
            tablaMarcas.innerHTML += `
              <tr>
                <td class='align-middle'>
                  <a href='#' class='title' data-idmarca='${element.idmarca}'>
                    ${element.marca}
                  </a>
                </td>
                <td>${element.modelos}</td>
                <td>
                  <a href='#' title='Editar' data-idmarca='${element.idmarca}' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' data-idmarca='${element.idmarca}' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            `
          });
        }
      }

      async function obtenerModelos(idmarca){
        const request = await fetch(`../../app/controllers/modelo.c.php?operation=getAll&idmarca=${idmarca}`, { method: 'GET' })
        const data = await request.json()
        return data
      }

      /**
       * Renderiza la lista de modelos de una determinada marca en el card del lado derecho
       */ 
      async function listarModelos(){
        const listaModelos = await obtenerModelos(idmarcaSeleccionada)

        if (listaModelos.length == 0){
          tablaModelos.innerHTML = `
          <tr>
            <td colspan='5' class='text-center'>No hay modelos registrados</td>
          </tr>
          `;
        }

        if (listaModelos.length > 0){
          tablaModelos.innerHTML = ``;
          let contador = 1;
          listaModelos.forEach(element => {
            tablaModelos.innerHTML += `
             <tr>
              <td class='align-middle'>${contador}</td>
              <td class='align-middle'>${element.tipovehiculo}</td>
              <td class='align-middle'>${element.modelo}</td>
              <td class='align-middle'>${element.anio}</td>
              <td>
                <a href='#' title='Vista previa' class='btn btn-sm btn-outline-primary view'><i class="fa-solid fa-camera"></i></a>
                <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                <a href='#' title='Eliminar' data-idmodelo='${element.idmodelo}' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
            `
            contador++
          });
        }
      }

      async function obtenerTipoVehiculos(){
        const request = await fetch(`../../app/controllers/tipovehiculo.c.php?operation=getAll`, { method: 'GET' })
        const data = await request.json()
        return data
      }

      async function listarTipoVehiculos(){
        const listaVehiculos = await obtenerTipoVehiculos();
        
        if (listaVehiculos.length > 0){
          listaVehiculos.forEach(element => {
            tipoVehiculo.innerHTML += `
            <option value='${element.idtipovehiculo}'>${element.tipovehiculo}</option>
            `
          });
        }
      }    

      //Al seleccionar un tipo de vehículo el enfoque va hacia la caja del modelo
      tipoVehiculo.addEventListener("change", () => { modelo.focus(); })

      //Evento editar - eliminar marca
      tablaMarcas.addEventListener("click", async (event) => {
        const enlaceTitle = event.target.closest('.title')
        const enlaceDelete = event.target.closest('.delete')
        
        if (enlaceTitle){
          //console.log(enlaceTitle.innerHTML, enlaceTitle.getAttribute('data-idmarca'))
          idmarcaSeleccionada = parseInt(enlaceTitle.getAttribute('data-idmarca'))
          document.getElementById("modal-modelos-titulo").innerHTML = `${enlaceTitle.innerHTML} - nuevo modelo`
          document.getElementById("marca-activa").innerHTML = enlaceTitle.innerHTML
          listarModelos()
        }

        if (enlaceDelete){
          const idEliminar = parseInt(enlaceDelete.getAttribute("data-idmarca"))
          
          if (confirm("¿Eliminamos esta marca?")){
            await fetch(`../../app/controllers/marca.c.php?operation=delete&idmarca=${idEliminar}`, { method: 'GET'})
              .then(response => response.json())
              .then(data => {
                if (data.rows > 0){
                  showToast("Eliminado correctamente", "SUCCESS", 2000)
                  listarMarcas()
                }else{
                  showToast("No se pudo concretar el proceso", "INFO", 2500)
                }
              })
          }
        }
      })

      //Eventos ver foto - editar - eliminar MODELOS
      tablaModelos.addEventListener("click", async(event) => {
        const enlaceDelete = event.target.closest('.delete')

        if (enlaceDelete){
          const idEliminar = parseInt(enlaceDelete.getAttribute("data-idmodelo"))
          
          if (confirm("¿Eliminamos este modelo?")){
            await fetch(`../../app/controllers/modelo.c.php?operation=delete&idmarca=${idEliminar}`, { method: 'GET' })
              .then(response => response.json())
              .then(data => {
                if (data.rows > 0){
                  console.log(data) //REVISAR
                  showToast("Eliminado correctamente", "SUCCESS", 2000)
                  listarModelos()
                  listarMarcas()
                }else{
                  showToast("No se pudo concretar el proceso", "INFO", 2500)
                }
              })
          }
        }
      })

      listarMarcas()
      listarTipoVehiculos()

    });

  </script>

  <?php require_once "../partials/footer.php"; ?>