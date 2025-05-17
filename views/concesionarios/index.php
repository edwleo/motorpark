<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex align-items-center justify-content-start">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Concesionarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 text-end">
        <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/concesionarios/registrar"
          class="">Registrar</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-sm table-hover table-hover-yonda" id="tabla-concesionarios">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre comercial</th>
                <th>Razón social</th>
                <th>RUC</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Zona modales -->
  <div class="modal fade" id="modal-concesionario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-concesionario" aria-hidden="true">
    <div class="modal-dialog">
      <form action="" autocomplete="off" id="formulario-concesionario">
        <div class="modal-content">
          <div class="modal-header bg-yonda">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar concesionario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-floating">
              <input type="text" class="form-control" id="nombre-comercial" placeholder="Nombre comercial" required>
              <label for="nombre-comercial">Nombre comercial</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Fin Zona modales -->

  <script>
    document.addEventListener("DOMContentLoaded", () => {

      let idconcesionario = null
      let nombreLeido = null
      const formulario = document.querySelector("#formulario-concesionario")
      const modalConcesionario = new bootstrap.Modal(document.getElementById("modal-concesionario"))
      const tablaConcesionarios = document.querySelector("#tabla-concesionarios tbody")
      const nombrecomercial = document.querySelector("#nombre-comercial")

      async function obtenerConcecionarios() {
        await fetch(`../../app/controllers/concesionario.c.php?operation=getAllConcesionarios`, { method: 'GET' })
          .then(response => response.json())
          .then(data => {
            if (data.length > 0) {
              let numeroFila = 1
              tablaConcesionarios.innerHTML = ``
              data.forEach(element => {
                tablaConcesionarios.innerHTML += `
                  <tr>
                    <td class='align-middle'>${numeroFila}</td>
                    <td class='align-middle'>${element.nombrecomercial}</td>
                    <td class='align-middle'>${element.razonsocial}</td>
                    <td class='align-middle'>${element.ruc}</td>
                    <td>
                      <a href='#' title='Editar nombre comercial' data-idconcesionario='${element.idconcesionario}' data-nombrecomercial='${element.nombrecomercial}' class='btn btn-sm btn-outline-primary edit'><i class="fa-solid fa-pen"></i></a>
                      <a href='#' title='Eliminar' data-idconcesionario='${element.idconcesionario}' class='btn btn-sm btn-outline-danger delete'><i class="fa-solid fa-trash"></i></a>
                      <a href='registrar?ruc=${element.ruc}' title='Ver tiendas' data-idtienda='${element.idconcesionario}' class='btn btn-sm btn-outline-secondary'><i class="fa-solid fa-shop"></i></a>
                    </td>
                  </tr>
                `
                numeroFila++
              });
            }
          })
          .catch(error => console.error(error))
      }

      //Retorna el número de ordenes de compra asociado al concesionario
      async function getOC(idconcesionario) {
        const params = new URLSearchParams()
        params.append('operation', 'getOC')
        params.append('idconcesionario', idconcesionario)
        const rows = await fetch(`../../app/controllers/concesionario.c.php?${params}`)
        return await rows.json()
      }

      async function eliminarConcesionario(idconcesionario) {
        const params = new URLSearchParams()
        params.append('operation', 'delete')
        params.append('idconcesionario', idconcesionario)
        const results = await fetch(`../../app/controllers/concesionario.c.php?${params}`, { method: 'GET' })
        return await results.json()
      }

      //Los datos requeridos están definidos a nivel general
      async function actualizarNombreComercial(){
        const params = new FormData()
        params.append("operation", "update")
        params.append("nombrecomercial", nombrecomercial.value)
        params.append("idconcesionario", idconcesionario)

        const results = await fetch(`../../app/controllers/concesionario.c.php`, { method: 'POST', body: params })
        return await results.json()
      }

      //Eliminación / edición
      document.querySelector("#tabla-concesionarios tbody").addEventListener("click", async function (event) {
        const enlaceDelete = event.target.closest('.delete')
        const enlaceEdit = event.target.closest('.edit')
        const filaRemover = event.target.closest('tr')

        if (enlaceDelete) {
          event.preventDefault()
          idconcesionario = parseInt(enlaceDelete.getAttribute('data-idconcesionario'))
          if (confirm("¿Está seguro de eliminar el registro?")) {
            //Validar cuántas OC se han generado
            const respuesta = await getOC(idconcesionario)
            if (respuesta.rows > 0) {
              showToast('Este concesionario tiene OC asociados, no se puede eliminar', 'WARNING', '3000')
            } else {
              const registros = await eliminarConcesionario(idconcesionario)
              console.log(registros)

              if (registros.rows > 0) {
                filaRemover.remove()
                showToast('Eliminado correctamente', 'SUCCESS', 1500)
              }

            }
          }
        } //enlaceDelete

        if (enlaceEdit){
          event.preventDefault()
          idconcesionario = parseInt(enlaceEdit.getAttribute('data-idconcesionario'))
          nombreLeido = enlaceEdit.getAttribute('data-nombrecomercial')
          nombrecomercial.value = nombreLeido
          modalConcesionario.show()
        }

      })

      //Eventos del modal
      document.getElementById('modal-concesionario').addEventListener('shown.bs.modal', event => {
        nombrecomercial.focus()
      })

      //Actualización del nombrecomercial
      formulario.addEventListener('submit', async (event) => {
        event.preventDefault()

        if (nombreLeido == nombrecomercial.value){
          showToast('No hay cambios', 'INFO', 1500)
          modalConcesionario.hide()
        }else{
          if (confirm("¿Desea actualizar el nombre comercial?")){
            const result = await actualizarNombreComercial()
            if (result.rows > 0){
              showToast('Actualizado correctamente', 'SUCCESS', 1500)
              await obtenerConcecionarios()
              modalConcesionario.hide()
            }
          }
        }
      })

      obtenerConcecionarios();
    });

  </script>

  <?php require_once "../partials/footer.php"; ?>