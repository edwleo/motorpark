<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">
    <div class="alert alert-info mt-2" role="alert">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Clientes(Normales)</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Registrar</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/clientes/" class="">Mostrar
                    lista</a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-yonda text-white">
                <h5 class="mb-0">Registrar Cliente(Normal)</h5>
            </div>
            <div class="card-body">
                <form action="" id="form-registro-cliente" autocomplete="off">
                    <input type="hidden" name="idcliente" id="idcliente">


                    <div class="row g-3 mt-1 mb-3">


                        <div class="col-md-3">
                            <div class="form-floating">
                                <select name="tipodocumento" id="tipodocumento" class="form-select" required>
                                    <option value="DNI" selected>DNI</option>
                                    <option value="CEX">Carnet de extranjeria</option>
                                    <option value="PAS">Pasaporte</option>

                                </select>
                                <label for="tipodocumento">Tipo documento</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="nrodoc" id="ndocumento" class="form-control"
                                    placeholder="Ingrese el N° de documento" required>
                                <label for="ndocumento">N° documento</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" id="apellidos" name="apellidos" maxlength="12"
                                    class="form-control" placeholder="Ingrese los apellidos" required>
                                <label for="apellidos">Apellidos</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="nombres" id="nombres" class="form-control"
                                    placeholder="Ingrese los nombres" required>
                                <label for="nombres">Nombres</label>
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









                    <!-- DATOS ESTADO DE LA PERSONA Y NACIMIENTO -->


                    <div class="row g-3 mt-1">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="genero" id="genero" class="form-select" required>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                                <label for="genero">Género</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="estadocivil" id="estadocivil" class="form-select" required>
                                    <option value="SOL">Soltero</option>
                                    <option value="CAS">Casado</option>
                                    <option value="VDO">Viudo</option>
                                    <option value="DVC">Divorciado</option>
                                    <option value="CNV">Conviviente</option>
                                </select>
                                <label for="estadocivil">Estado civil</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" name="fechanac" id="fechanacimiento" class="form-control"
                                    placeholder="Fecha nacimiento" required>
                                <label for="fechanacimiento">Fecha nacimiento</label>
                            </div>

                        </div>


                    </div>

                    <div class="row g-3 mt-1">


                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="exmaple@gmail.com">
                                <label for="email">Correo</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="tel" name="telprimario" id="telprimario" class="form-control" maxlength="12" pattern="[0-9]+"
                                    placeholder="N° telefóno" required>
                                <label for="telprimario">Telefóno</label>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="tel" name="telalternativo" id="telalternativo" class="form-control" maxlength="12" pattern="[0-9]+"
                                    placeholder="N° telefóno">
                                <label for="telalternativo">Telefóno 2 (Opcional)</label>
                            </div>

                        </div>

                    </div>



                    <div class="row g-3 mt-1">

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                    placeholder="Ingrese una dirección">
                                <label for="direccion">Direccion(Opcional)</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="referencia" id="referencia" class="form-control"
                                    placeholder="Ingrese una dirección">
                                <label for="referencia">Referencia(Opcional)</label>
                            </div>
                        </div>
                    </div>




                    <!-- LATITUD Y LONGITUD -->


                    <!-- Responsable y nombre del local -->
                    <div class="row g-3 mt-1">
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" name="latitud" id="latitud" class="form-control"
                                    placeholder="Latitud">
                                <label for="latitud">Latitud</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" name="longitud" id="longitud" class="form-control" maxlength="40"
                                    placeholder="Longitud" >
                                <label for="longitud">Longitud</label>
                            </div>
                        </div>

                        <div class="col-md-3">

                            <button type="button" class="btn btn-sm btn-success" id="btn-mapa">Ver mapa</button>
                        </div>
                    </div>



                    <!-- Botón -->
                    <div class="text-end mt-4">
                        <button type="reset" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal" id="btn-cancelar">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="btn-registrar">Guardar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const form = document.querySelector('#form-registro-cliente');
        const btnRegistrarCliente = document.querySelector('#btn-registrar');
        const btnCancelarRegistro = document.querySelector('#btn-cancelar');

        // Campos persona
        const tipodocumento = document.querySelector('#tipodocumento');
        const ndocumento = document.querySelector('#ndocumento');
        const apellidos = document.querySelector('#apellidos');
        const nombres = document.querySelector('#nombres');
        const genero = document.querySelector('#genero');
        const estadoCivil = document.querySelector('#estadocivil');
        const fechaNacimiento = document.querySelector('#fechanacimiento');
        const email = document.querySelector('#email');
        const telPrimario = document.querySelector('#telprimario');
        const telAlternativo = document.querySelector('#telalternativo');
        const departamentos = document.querySelector('#departamento');
        const provincias = document.querySelector('#provincia');
        const distritos = document.querySelector('#distrito');
        const direccion = document.querySelector('#direccion');
        const referencia = document.querySelector('#referencia');
        const latitud = document.querySelector('#latitud');
        const longitud = document.querySelector('#longitud');

        const tipocliente = 'P';

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

        // Submit: crear persona y luego cliente
        form.addEventListener('submit', async e => {
            e.preventDefault();
            if (!confirm('¿Desea guardar este cliente?')) return;

            // 1) Crear persona
            const personaFD = new FormData();
            personaFD.append('operation', 'create');
            personaFD.append('apellidos', apellidos.value);
            personaFD.append('nombres', nombres.value);
            personaFD.append('tipodoc', tipodocumento.value);
            personaFD.append('nrodoc', ndocumento.value);
            personaFD.append('genero', genero.value);
            personaFD.append('fechanac', fechaNacimiento.value);
            personaFD.append('estadocivil', estadoCivil.value);
            personaFD.append('email', email.value || null);
            personaFD.append('iddistrito', distritos.value);
            personaFD.append('direccion', direccion.value || null);
            personaFD.append('referencia', referencia.value || null);
            personaFD.append('telprimario', telPrimario.value);
            personaFD.append('telalternativo', telAlternativo.value || null);
            personaFD.append('latitud', latitud.value || null);
            personaFD.append('longitud', longitud.value || null);

            try {
                const respPersona = await fetch('../../app/controllers/persona.c.php', {
                    method: 'POST',
                    body: personaFD
                });
                const dataPersona = await respPersona.json();

                if (!dataPersona.id || dataPersona.id < 1) {
                    showToast('Error al crear persona', 'ERROR', 3000);
                    return;
                }

                // 2) Crear cliente
                const clienteFD = new FormData();
                clienteFD.append('operation', 'create');
                clienteFD.append('idpersona', dataPersona.id);
                clienteFD.append('tipocliente', tipocliente);

                console.log(clienteFD);

                const respCliente = await fetch('../../app/controllers/cliente.c.php', {
                    method: 'POST',
                    body: clienteFD
                });
                const dataCliente = await respCliente.json();

                if (dataCliente.id && dataCliente.id > 0) {
                    showToast('Cliente creado', 'SUCCESS', 2000);
                    btnRegistrarCliente.setAttribute('disabled', true);
                    btnCancelarRegistro.setAttribute('disabled', true);
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