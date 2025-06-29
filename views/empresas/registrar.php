<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">
    <div class="alert alert-info mt-2" role="alert">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Empresas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Registrar</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/empresas/" class="">Mostrar
                    lista</a>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-yonda text-white">
                <h5 class="mb-0">Registrar Cliente (Empresa)</h5>
            </div>
            <div class="card-body">
                <form action="" id="form-registro-cliente-empresa" autocomplete="off">

                    <div class="row g-3 mt-1 mb-3">


                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="ruc" id="ruc" class="form-control"
                                    placeholder="Ingrese el N° de RUC" maxlength="12" required>
                                <label for="ruc">N° RUC</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" id="razonsocial" name="razonsocial" class="form-control"
                                    placeholder="Ingrese la razón social" required>
                                <label for="razonsocial">Razón social</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="nombrecomercial" id="nombrecomercial" class="form-control"
                                    placeholder="Ingrese el nombre comercial" required>
                                <label for="nombrecomercial">Nombre comercial</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="representante" id="representante" class="form-control"
                                    placeholder="Ingrese el nombre del representante" required>
                                <label for="representante">Representante</label>
                            </div>
                        </div>


                    </div>
                    <!-- Ubicación -->
                    <div class="row g-3">
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
                    </div>



                    <div class="row g-3 mt-1">


                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="exmple@gmail.com">
                                <label for="email">Correo</label>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="tel" name="telprimario" id="telprimario" class="form-control"
                                    placeholder="Número de telefóno" maxlength="9" pattern="[0-9]+" required>
                                <label for="telprimario">Telefóno</label>
                            </div>

                        </div>


                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="tel" name="telsecundario" id="telsecundario" class="form-control"
                                    placeholder="Número de telefóno" maxlength="0" pattern="[0-9]+">
                                <label for="telsecundario">Telefóno 2 (Opcional)</label>
                            </div>

                        </div>


                    </div>

                    <div class="row g-3 mt-1">

                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                    placeholder="Ingrese una dirección">
                                <label for="direccion">Direccion(Opcional)</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="referencia" id="referencia" class="form-control"
                                    placeholder="Ingrese una dirección">
                                <label for="referencia">Referencia(Opcional)</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" name="latitud" id="latitud" class="form-control"
                                    placeholder="Ingrese la latitud">
                                <label for="latitud">Latitud</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" name="longitud" id="longitud" class="form-control"
                                    placeholder="Ingrese la longitud">
                                <label for="longitud">Longitud</label>
                            </div>
                        </div>

                        <div class="col-md-2">

                            <button type="button" class="btn btn-sm btn-success" id="btn-mapa">Ver mapa</button>
                        </div>
                    </div>



                    <!-- Botón -->
                    <div class="text-end mt-4">
                        <button type="reset" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"
                            id="btn-cancelar">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="btn-registrar">Guardar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const form = document.querySelector('#form-registro-cliente-empresa');
        const btnRegistrarCliente = document.querySelector('#btn-registrar');
        const btnCancelarRegistro = document.querySelector('#btn-cancelar');

        // Campos empresa
        const ruc = document.querySelector('#ruc');
        const razonSocial = document.querySelector('#razonsocial');
        const nombreComercial = document.querySelector('#nombrecomercial');
        const representante = document.querySelector('#representante');
        const departamentos = document.querySelector('#departamento');
        const provincias = document.querySelector('#provincia');
        const distritos = document.querySelector('#distrito');
        const email = document.querySelector('#email');
        const telPrimario = document.querySelector('#telprimario');
        const telSecundario = document.querySelector('#telsecundario');
        const direccion = document.querySelector('#direccion');
        const referencia = document.querySelector('#referencia');
        const latitud = document.querySelector('#latitud');
        const longitud = document.querySelector('#longitud');

        const tipocliente = 'E'; // Por defecto es de tipo empresa


        // function normalize(value) {
        //     return value === "" || value === "null" ? null : value;
        // }

        // Carga de ubigeo en cascada
        async function getAllDepartamentos() {
            const params = new URLSearchParams({
                operation: 'getAllDepartamentos'
            });
            const resp = await fetch(`../../app/controllers/ubigeo.c.php?${params}`);
            const data = await resp.json();
            departamentos.innerHTML = `<option value="">Seleccione</option>`;
            data.forEach(d => {
                departamentos.innerHTML += `<option value="${d.iddepartamento}">${d.departamento}</option>`;
            });
        }

        async function getAllProvincias(iddepartamento) {
            const params = new URLSearchParams({
                operation: 'getAllProvincias',
                iddepartamento
            });
            const resp = await fetch(`../../app/controllers/ubigeo.c.php?${params}`);
            const data = await resp.json();
            provincias.innerHTML = `<option value="">Seleccione</option>`;
            distritos.innerHTML = `<option value="">Seleccione</option>`;
            data.forEach(p => {
                provincias.innerHTML += `<option value="${p.idprovincia}">${p.provincia}</option>`;
            });
        }

        async function getAllDistritos(idprovincia) {
            const params = new URLSearchParams({
                operation: 'getAllDistritos',
                idprovincia
            });
            const resp = await fetch(`../../app/controllers/ubigeo.c.php?${params}`);
            const data = await resp.json();
            distritos.innerHTML = `<option value="">Seleccione</option>`;
            data.forEach(d => {
                distritos.innerHTML += `<option value="${d.iddistrito}">${d.distrito}</option>`;
            });
        }

        departamentos.addEventListener('change', () => getAllProvincias(departamentos.value));
        provincias.addEventListener('change', () => getAllDistritos(provincias.value));

        getAllDepartamentos();

        // Submit: crear empresa y luego cliente
        form.addEventListener('submit', async e => {
            e.preventDefault();
            if (!confirm('¿Desea guardar este cliente?')) return;

            // 1) Crear empresa
            const empresaFD = new FormData();
            empresaFD.append('operation', 'create');
            empresaFD.append('iddistrito', distritos.value);
            empresaFD.append('razonsocial', razonSocial.value);
            empresaFD.append('nombrecomercial', nombreComercial.value);
            empresaFD.append('ruc', ruc.value);
            empresaFD.append('representante', representante.value);
            empresaFD.append('email', email.value);
            empresaFD.append('direccion', direccion.value);
            empresaFD.append('referencia', referencia.value);
            empresaFD.append('latitud', latitud.value);
            empresaFD.append('longitud', longitud.value);
            empresaFD.append('telprimario', telPrimario.value);
            empresaFD.append('telsecundario', telSecundario.value);

            console.log(Object.fromEntries(empresaFD.entries()));


            try {
                const respEmpresa = await fetch('../../app/controllers/empresa.c.php', {
                    method: 'POST',
                    body: empresaFD
                });
                const dataEmpresa = await respEmpresa.json();

                if (!dataEmpresa.id || dataEmpresa.id < 1) {
                    showToast('Error al crear la empresa', 'ERROR', 3000);
                    return;
                }

                // 2) Crear clietnte
                const clienteFD = new FormData();
                clienteFD.append('operation', 'create');
                clienteFD.append('idempresa', dataEmpresa.id);
                clienteFD.append('tipocliente', tipocliente);

                console.log(clienteFD);

                const respCliente = await fetch('../../app/controllers/cliente.c.php', {
                    method: 'POST',
                    body: clienteFD
                });
                const dataCliente = await respCliente.json();

                if (dataCliente.id && dataCliente.id > 0) {
                    showToast('Cliente creado', 'SUCCESS', 2000);

                    // btnRegistrarCliente.setAttribute('disabled', true);
                    form.reset();
                    getAllDepartamentos();
                    // btnCancelarRegistro.setAttribute('disabled', true);
                } else {
                    showToast('Error al crear cliente', 'ERROR', 3000);
                }

            } catch (err) {
                console.error(err);
                showToast('Error en la petición', 'ERROR', 3000);
            }
        });

    });
</script>

<?php require_once "../partials/footer.php"; ?>