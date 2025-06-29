<?php require_once "../partials/header.php"; ?>



<div class="container-fluid">

    <div class="alert alert-info mt-2" role="alert">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Clientes (Normales)</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listar</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-end gap-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= $path ?>/views/empresas/">Jurídicas (Empresas)</a></li>
                    </ol>
                </nav>
                <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/clientes/registrar">Registrar</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-hover-yonda" id="tabla-clientes-personas">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ubicación</th>
                                    <th>Direccion</th>
                                    <th>Nombre completo</th>
                                    <th>Tipo documento</th>
                                    <th>N° documento</th>
                                    <th>Correo</th>
                                    <th>Telefóno</th>
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
    <div class="modal fade" id="modal-cliente-personas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modal-cliente-personas" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" autocomplete="off" id="formulario-cliente-personas">

                <div class="modal-content">
                    <div class="modal-header bg-yonda">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Cliente (Persona)</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="apellidos" placeholder="Apellidos"
                                        required>
                                    <label for="apellidos">Apellidos</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombres" placeholder="Nombres" required>
                                    <label for="nombres">Nombres</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="estadocivil" id="estadocivil" class="form-select" required>
                                        <option value="">Seleccione</option>
                                        <option value="SOL">Solter@</option>
                                        <option value="CAS">Casad@</option>
                                        <option value="VDO">Viud@</option>
                                        <option value="DVC">Divorciad@</option>
                                        <option value="CNV">Conviviente</option>
                                    </select>
                                    <label for="estadocivil">Estado civil</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Correo">
                                    <label for="email">Correo</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select name="departamento" id="departamento" class="form-select" required>
                                        <option value="">Seleccione</option>
                                    </select>
                                    <label for="departamento">Departamento</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select name="provincia" id="provincia" class="form-select" required>
                                        <option value="">Seleccione</option>
                                    </select>
                                    <label for="provincia">Provincia</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select name="distrito" id="distrito" class="form-select" required>
                                        <option value="">Seleccione</option>
                                    </select>
                                    <label for="distrito">Distrito</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="direccion" placeholder="Dirección">
                                    <label for="direccion">Dirección</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="telprimario" placeholder="Teléfono"
                                        maxlength="9" pattern="[0-9]+" required>
                                    <label for="telprimario">Teléfono</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="latitud" placeholder="Latitud">
                                    <label for="latitud">Latitud</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="longitud" placeholder="Longitud">
                                    <label for="longitud">Longitud</label>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <button type="button" class="btn btn-sm btn-success" id="btn-mapa">Ver mapa</button>
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
</div>


<script>
    let idpersona = null;
    let idcliente = null;

    document.addEventListener('DOMContentLoaded', async () => {

        const tablaBody = document.querySelector('#tabla-clientes-personas tbody');
        const formularioClientePersona = document.querySelector("#formulario-cliente-personas");


    


        async function cargarDepartamentos() {
            const res = await fetch('../../app/controllers/ubigeo.c.php?operation=getAllDepartamentos');
            const data = await res.json();
            const select = document.querySelector('#departamento');
            select.innerHTML = '<option value="">Seleccione</option>';
            data.forEach(item => {
                select.innerHTML += `<option value="${item.iddepartamento}">${item.departamento}</option>`;
            });
        }

        async function cargarProvincias(iddepartamento) {
            const res = await fetch(`../../app/controllers/ubigeo.c.php?operation=getAllProvincias&iddepartamento=${iddepartamento}`);
            const data = await res.json();
            const select = document.querySelector('#provincia');
            select.innerHTML = '<option value="">Seleccione</option>';
            data.forEach(item => {
                select.innerHTML += `<option value="${item.idprovincia}">${item.provincia}</option>`;
            });
        }

        async function cargarDistritos(idprovincia) {
            const res = await fetch(`../../app/controllers/ubigeo.c.php?operation=getAllDistritos&idprovincia=${idprovincia}`);
            const data = await res.json();
            const select = document.querySelector('#distrito');
            select.innerHTML = '<option value="">Seleccione</option>';
            data.forEach(item => {
                select.innerHTML += `<option value="${item.iddistrito}">${item.distrito}</option>`;
            });
        }

        async function obtenerClientesPersonas() {
            try {
                const response = await fetch(`../../app/controllers/persona.c.php?operation=getAllPersonsClient`);
                const data = await response.json();
                tablaBody.innerHTML = "";
                let numeroFila = 1;
                data.forEach(element => {
                    tablaBody.innerHTML += `
                        <tr>
                            <td class='align-middle'>${numeroFila++}</td>
                            <td class='align-middle'>${element.ubicacion}</td>
                            <td class='align-middle'>${element.direccion}</td>
                            <td class='align-middle'>${element.nombrecompleto}</td>
                            <td class='align-middle'>${element.tipodoc}</td>
                            <td class='align-middle'>${element.nrodoc}</td>
                            <td class='align-middle'>${element.email}</td>
                            <td class='align-middle'>${element.telprimario}</td>
                            <td class="align-middle">
                                <div class="d-flex gap-1">
                                    <a href='#' class='btn btn-sm btn-outline-primary edit' 
                                        data-idpersona='${element.idpersona}' title='Editar'>
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href='#' title='Eliminar' data-idcliente='${element.idcliente}' 
                                        class='btn btn-sm btn-outline-danger delete'>
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>`;
                });
            } catch (error) {
                console.error('Error al cargar los clientes', error);
            }
        }

        async function deleteClientePersona(idcliente) {
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
                idpersona = btnEdit.dataset.idpersona;
                try {
                    const res = await fetch(`../../app/controllers/persona.c.php?operation=getDataPersona&idpersona=${idpersona}`);
                    const persona = await res.json();

                    document.querySelector('#nombres').value = persona.nombres;
                    document.querySelector('#apellidos').value = persona.apellidos;
                    document.querySelector('#estadocivil').value = persona.estadocivil;
                    document.querySelector('#email').value = persona.email;
                    document.querySelector('#direccion').value = persona.direccion;
                    document.querySelector('#telprimario').value = persona.telprimario;
                    document.querySelector('#latitud').value = persona.latitud ?? '';
                    document.querySelector('#longitud').value = persona.longitud ?? '';

                    await cargarDepartamentos();
                    document.querySelector('#departamento').value = persona.iddepartamento;

                    await cargarProvincias(persona.iddepartamento);
                    document.querySelector('#provincia').value = persona.idprovincia;

                    await cargarDistritos(persona.idprovincia);
                    document.querySelector('#distrito').value = persona.iddistrito;

                    const modal = new bootstrap.Modal(document.getElementById('modal-cliente-personas'));
                    modal.show();

                } catch (error) {
                    console.error("Error al obtener datos de persona cliente:", error);
                }
            }

            if (btnDelete) {
                e.preventDefault();
                idEliminar = btnDelete.dataset.idcliente;

                if (confirm("¿Estás seguro de eliminar este cliente?")) {
                    const resultado = await deleteClientePersona(idEliminar);

                    if (resultado.rows > 0) {
                        showToast("Cliente eliminado correctamente", "SUCCESS", 1500);
                        fila.remove();
                    } else {
                        showToast("No se pudo eliminar el cliente", "ERROR", 3000);
                    }
                }
            }
        });

        formularioClientePersona.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData();
            formData.append("operation", "update");
            formData.append("idpersona", idpersona);
            formData.append("nombres", document.querySelector("#nombres").value.trim());
            formData.append("apellidos", document.querySelector("#apellidos").value.trim());
            formData.append("estadocivil", document.querySelector("#estadocivil").value);
            formData.append("email", document.querySelector("#email").value.trim() ?? null);
            formData.append("direccion", document.querySelector("#direccion").value.trim() ?? null);
            formData.append("telprimario", document.querySelector("#telprimario").value.trim());
            formData.append("latitud", document.querySelector("#latitud").value.trim() ?? null);
            formData.append("longitud", document.querySelector("#longitud").value.trim() ?? null);
            formData.append("iddistrito", document.querySelector("#distrito").value);

            try {
                const response = await fetch("../../app/controllers/persona.c.php", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();

                if (result.rows > 0) {
                    showToast("Cliente actualizado correctamente", "SUCCESS", 1500);
                    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-cliente-personas"));
                    modal.hide();
                    obtenerClientesPersonas();
                } else {
                    showToast("No se actualizó ningún dato", "WARNING", 3000);
                }

            } catch (error) {
                console.error("Error al actualizar cliente persona:", error);
            }
        });

        document.querySelector('#departamento').addEventListener('change', async function () {
            await cargarProvincias(this.value);
            document.querySelector('#distrito').innerHTML = '<option value="">Seleccione</option>';
        });

        document.querySelector('#provincia').addEventListener('change', async function () {
            await cargarDistritos(this.value);
        });

        obtenerClientesPersonas();
    });
</script>



<?php require_once "../partials/footer.php"; ?>