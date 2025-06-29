<?php require_once "../partials/header.php"; ?>



<div class="container-fluid">

    <div class="alert alert-info mt-2" role="alert">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Empresas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listar</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-end gap-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= $path ?>/views/clientes/">Clientes (Normales)</a></li>
                    </ol>
                </nav>
                <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/empresas/registrar">Registrar</a>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-hover-yonda" id="tabla-cliente-empresa">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ubicación</th>
                                    <th>Direccion</th>
                                    <th>Responsable</th>
                                    <th>Ruc</th>
                                    <th>Empresa</th>
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
    <div class="modal fade" id="modal-cliente-empresa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modal-cliente-empresa" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" autocomplete="off" id="formulario-cliente-empresa">
                <div class="modal-content">
                    <div class="modal-header bg-yonda">
                        <h1 class="modal-title fs-5">Actualizar Empresa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="razonsocial" placeholder="Razón Social"
                                        required>
                                    <label for="razonsocial">Razón Social</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombrecomercial"
                                        placeholder="Nombre Comercial">
                                    <label for="nombrecomercial">Nombre Comercial</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="ruc" placeholder="RUC" maxlength="12"
                                        required>
                                    <label for="ruc">RUC</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="representante" required
                                        placeholder="Representante Legal">
                                    <label for="representante">Representante</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email"
                                        placeholder="Correo electrónico">
                                    <label for="email">Correo electrónico</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="telprimario" maxlength="9"
                                        placeholder="Teléfono principal">
                                    <label for="telprimario">Teléfono</label>
                                </div>
                            </div>
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
            let idempresa = null;
            let responsableAnterior = null;

            const modalClienteEmpresa = new bootstrap.Modal(document.getElementById("modal-cliente-empresa"));
            const formClienteEmpresa = document.querySelector("#formulario-cliente-empresa");
            const tablaBody = document.querySelector("#tabla-cliente-empresa tbody");




            async function obtenerClienteEmpresas() {
                try {
                    const response = await fetch(`http://localhost/motorpark/app/controllers/empresa.c.php?operation=getAllEmpCliente`);
                    const data = await response.json();

                    tablaBody.innerHTML = "";
                    if (data.length > 0) {
                        let numeroFila = 1;
                        data.forEach(element => {
                            tablaBody.innerHTML += `
              <tr>
                <td class='align-middle'>${numeroFila++}</td>
                <td class='align-middle'>${element.ubicacion}</td>
                <td class='align-middle'>${element.direccion}</td>
                <td class='align-middle'>${element.responsable}</td>
                <td class='align-middle'>${element.ruc}</td>
                <td class='align-middle'>${element.nombrecomercial}</td>
                <td class='align-middle'>${element.email}</td>
                <td class='align-middle'>${element.telprimario}</td>
                <td class='align-middle'>
                <div class="d-flex gap-1">
                  <a href='#' class='btn btn-sm btn-outline-primary edit' 
                    data-idempresa='${element.idempresa}' 
                    title='Editar'><i class="fa-solid fa-pen"></i></a>

                  <a href='#' title='Eliminar' data-idcliente='${element.idcliente}' 
                    class='btn btn-sm btn-outline-danger delete'>
                    <i class="fa-solid fa-trash"></i>
                  </a>
                  </div>
                </td>
              </tr>
            `;
                        });
                    }
                } catch (error) {
                    console.error("Error al cargar locales:", error);
                }
            }

            async function deleteClienteEmpresa(idcliente) {
                const params = new URLSearchParams();
                params.append("operation", "delete");
                params.append("idcliente", idcliente);

                const response = await fetch(`http://localhost/motorpark/app/controllers/cliente.c.php?${params}`, {
                    method: "GET"
                });
                return await response.json();
            }



            tablaBody.addEventListener('click', async (e) => {
                const btnEdit = e.target.closest('.edit');
                const btnDelete = e.target.closest(".delete");
                const fila = e.target.closest("tr");
                if (btnEdit) {
                    e.preventDefault();
                    idempresa = btnEdit.dataset.idempresa;
                    try {
                        const res = await fetch(`../../app/controllers/empresa.c.php?operation=getDataEmpresa&idempresa=${idempresa}`);
                        const empresa = await res.json();

                        document.querySelector('#razonsocial').value = empresa.razonsocial;
                        document.querySelector('#nombrecomercial').value = empresa.nombrecomercial;
                        document.querySelector('#ruc').value = empresa.ruc;
                        document.querySelector('#representante').value = empresa.representante;
                        document.querySelector('#email').value = empresa.email;
                        document.querySelector('#telprimario').value = empresa.telprimario;




                        modalClienteEmpresa.show();

                    } catch (error) {
                        console.error("Error al obtener datos de empresa cliente:", error);
                    }
                }

                if (btnDelete) {
                    e.preventDefault();
                    idEliminar = btnDelete.dataset.idcliente;

                    if (confirm("¿Estás seguro de eliminar este cliente?")) {
                        const resultado = await deleteClienteEmpresa(idEliminar);

                        if (resultado.rows > 0) {
                            showToast("Cliente eliminado correctamente", "SUCCESS", 1500);
                            fila.remove();
                        } else {
                            showToast("No se pudo eliminar el cliente", "ERROR", 3000);
                        }
                    }
                }
            });



            formClienteEmpresa.addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = new FormData();
                formData.append("operation", "update");
                formData.append("idempresa", idempresa);
                formData.append("razonsocial", document.querySelector("#razonsocial").value.trim());
                formData.append("nombrecomercial", document.querySelector("#nombrecomercial").value.trim());
                formData.append("ruc", document.querySelector("#ruc").value);
                formData.append("representante", document.querySelector("#representante").value.trim());
                formData.append("email", document.querySelector("#email").value.trim() ?? null);
                formData.append("telprimario", document.querySelector("#telprimario").value.trim());


                try {
                    const response = await fetch("../../app/controllers/empresa.c.php", {
                        method: "POST",
                        body: formData
                    });

                    const result = await response.json();

                    if (result.rows > 0) {
                        showToast("Cliente actualizado correctamente", "SUCCESS", 1500);

                        modalClienteEmpresa.hide();
                        obtenerClienteEmpresas();
                    } else {
                        showToast("No se actualizó ningún dato", "WARNING", 3000);
                    }

                } catch (error) {
                    console.error("Error al actualizar cliente persona:", error);
                }
            });


            obtenerClienteEmpresas();



        });
    </script>


    <?php require_once "../partials/footer.php"; ?>