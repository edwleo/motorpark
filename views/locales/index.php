<?php require_once "../partials/header.php"; ?>



<div class="container-fluid">

    <div class="alert alert-info mt-2" role="alert">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Locales</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listar</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/locales/registrar"
                    class="">Registrar</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-sm table-hover table-hover-yonda" id="tabla-locales">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tienda</th>
                                <th>Ubicación</th>
                                <th>Direccion</th>
                                <th>Responsable</th>
                                <th>Correo</th>
                                <th>Telefono</th>
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
    </div>

    <!-- Zona modales -->
    <div class="modal fade" id="modal-locales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modal-locales" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" autocomplete="off" id="formulario-locales">
                <input type="hidden" id="idlocal">
                <div class="modal-content">
                    <div class="modal-header bg-yonda">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar local</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="responsable" placeholder="Responsable" required>
                            <label for="nombre-comercial">Responsable</label>
                        </div>
                        <div class="form-floating mt-2">
                            <input type="text" class="form-control" id="telefono" placeholder="Telefóno" required>
                            <label for="nombre-comercial">Telefóno</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let idlocal = null;
            let responsableAnterior = null;

            const modalLocal = new bootstrap.Modal(document.getElementById("modal-locales"));
            const formulario = document.querySelector("#formulario-locales");
            const tablaBody = document.querySelector("#tabla-locales tbody");
            const inputResponsable = document.querySelector("#responsable");
            const inputTelefono = document.querySelector("#telefono");

            // Cargar locales en tabla
            async function obtenerLocales() {
                try {
                    const response = await fetch(`http://localhost/motorpark/app/controllers/local.c.php?operation=getAll`);
                    const data = await response.json();

                    tablaBody.innerHTML = "";
                    if (data.length > 0) {
                        let numeroFila = 1;
                        data.forEach(element => {
                            tablaBody.innerHTML += `
              <tr>
                <td class='align-middle'>${numeroFila++}</td>
                <td class='align-middle'>${element.tienda}</td>
                <td class='align-middle'>${element.departamento} / ${element.provincia} / ${element.distrito}</td>
                <td class='align-middle'>${element.direccion}</td>
                <td class='align-middle'>${element.responsable}</td>
                <td class='align-middle'>${element.correo}</td>
                <td class='align-middle'>${element.telefono}</td>
                <td>
                  <a href='#' class='btn btn-sm btn-outline-primary edit' 
                    data-idlocal='${element.idlocal}' 
                    data-responsable='${element.responsable}' 
                    data-telefono='${element.telefono}'
                    title='Editar'><i class="fa-solid fa-pen"></i></a>

                  <a href='#' title='Eliminar' data-idlocal='${element.idlocal}' 
                    class='btn btn-sm btn-outline-danger delete'>
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </td>
              </tr>
            `;
                        });
                    }
                } catch (error) {
                    console.error("Error al cargar locales:", error);
                }
            }

            // Eliminar local
            async function eliminarLocal(idlocal) {
                const params = new URLSearchParams();
                params.append("operation", "delete");
                params.append("idlocal", idlocal);

                const response = await fetch(`http://localhost/motorpark/app/controllers/local.c.php?${params}`, {
                    method: "GET"
                });
                return await response.json();
            }

            // Delegar eventos de edición y eliminación
            tablaBody.addEventListener("click", async e => {
                const btnEdit = e.target.closest(".edit"); //  Busca el elemento más cercano con clase .edit
                const btnDelete = e.target.closest(".delete"); //  Busca el elemento más cercano con clase .delete
                const fila = e.target.closest("tr");

                if (btnEdit) {
                    e.preventDefault();

                    idlocal = btnEdit.dataset.idlocal;
                    const responsable = btnEdit.dataset.responsable;
                    const telefono = btnEdit.dataset.telefono;

                    responsableAnterior = responsable;

                    inputResponsable.value = responsable;
                    inputTelefono.value = telefono;

                    modalLocal.show();
                }

                if (btnDelete) {
                    e.preventDefault();

                    const idEliminar = btnDelete.dataset.idlocal;

                    if (confirm("¿Estás seguro de eliminar este local?")) {
                        const resultado = await eliminarLocal(idEliminar);

                        if (resultado.rows > 0) {
                            showToast("Local eliminado correctamente", "SUCCESS", 1500);
                            fila.remove();
                        } else {
                            showToast("No se pudo eliminar el local", "ERROR", 3000);
                        }
                    }
                }
            });

            // Actualizar local
            formulario.addEventListener("submit", async (e) => {
                e.preventDefault();

                const nuevoResponsable = inputResponsable.value.trim();
                const nuevoTelefono = inputTelefono.value.trim();

                if (nuevoResponsable === responsableAnterior) {
                    alert("No se realizaron cambios.");
                    modalLocal.hide();
                    return;
                }

                const formData = new FormData();
                formData.append("operation", "update");
                formData.append("idlocal", idlocal);
                formData.append("responsable", nuevoResponsable);
                formData.append("telefono", nuevoTelefono);

                try {
                    const response = await fetch(`http://localhost/motorpark/app/controllers/local.c.php`, {
                        method: "POST",
                        body: formData
                    });

                    const result = await response.json();

                    if (result.rows > 0) {
                        showToast("Local actualizado correctamente", "SUCCESS", 1500);
                        modalLocal.hide();
                        obtenerLocales();
                    } else {
                        showToast("No se actualizó ningún dato", "WARNING", 3000);
                    }
                } catch (error) {
                    console.error("Error al actualizar:", error);
                }
            });

            obtenerLocales();
        });
    </script>


    <?php require_once "../partials/footer.php"; ?>