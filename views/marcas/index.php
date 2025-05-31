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
              <col style="width: 75%;">
              <col style="width: 25%;">
            </colgroup>
            <thead>
              <tr>
                <th>Nombre marca</th>
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
              <a class="" href="#" class="">[ Agregar ]</a>
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
              <!--
              <tr>
                <td class='align-middle'>1</td>
                <td class='align-middle'>Sedan</td>
                <td class='align-middle'>All new K3</td>
                <td class='align-middle'>2025</td>
                <td>
                  <a href='#' title='Vista previa' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-camera"></i></a>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
              -->

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
  <!-- Fin zona de modales -->

  <script>
    document.addEventListener("DOMContentLoaded", async () => {
      
      const tablaMarcas = document.querySelector("#tabla-marcas tbody")
      const tablaModelos = document.querySelector("#tabla-modelos tbody")
      const modalMarca = new bootstrap.Modal(document.getElementById("modal-marcas"))
      const lnkAgregarMarca = document.querySelector("#lnk-agregar-marca")
      const formularioMarcas = document.querySelector("#formulario-marcas")
      const marca = document.querySelector("#marca")

      let idmarcaSeleccionada = -1;
      let listaMarcas = [] //Es una lista de marca que obtenemos del backend

      lnkAgregarMarca.addEventListener("click", () => {
        modalMarca.show()
      })

      //Eventos al ingresar del modal marcas
      document.getElementById("modal-marcas").addEventListener('shown.bs.modal', () => {
        marca.focus()
      })

      //Eventos al salir del modal marcas
      document.getElementById("modal-marcas").addEventListener('hidden.bs.modal', () => {
        formularioMarcas.reset()
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
                  <a href='#' class='title' data-idmarca='${element.idmarca}'>${element.marca}</a>
                </td>
                <td>
                  <a href='#' title='Editar' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                  <a href='#' title='Eliminar' data-idmarca='${element.idmarca}' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            `
          });
        }
      }

      async function obtenerModelos(idmarca){
        const request = await fetch(`../../app/controllers/marca.c.php`)
      }

      //Evento editar - eliminar marca
      tablaMarcas.addEventListener("click", async (event) => {
        const enlaceTitle = event.target.closest('.title')
        const enlaceDelete = event.target.closest('.delete')
        
        if (enlaceTitle){
          //console.log(enlaceTitle.innerHTML, enlaceTitle.getAttribute('data-idmarca'))
          idmarcaSeleccionada = parseInt(enlaceTitle.getAttribute('data-idmarca'))
          document.getElementById("marca-activa").innerHTML = enlaceTitle.innerHTML
        }

        if (enlaceDelete){
          console.log('Eliminando...')
        }
      })

      listarMarcas()

    });

  </script>

  <?php require_once "../partials/footer.php"; ?>