<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">
    <div class="alert alert-info mt-2" role="alert">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Locales</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Registrar</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/locales/" class="">Mostrar
                    lista</a>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-yonda text-white">
                <h5 class="mb-0">Registrar Local</h5>
            </div>
            <div class="card-body">
                <form action="" id="form-registro-tienda" autocomplete="off">
                    <input type="hidden" name="idlocal" id="idlocal">

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

                    <!-- Datos de tienda -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="idmotorpark" id="idmotorpark" class="form-select" required>
                                    <option value="">Seleccione</option>
                                </select>
                                <label for="idmotorpark">Tienda</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="principal" id="principal" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    <option value="S">Sí</option>
                                    <option value="N">No</option>
                                </select>
                                <label for="principal">¿Es principal?</label>
                            </div>
                        </div>
                    </div>


                    <!-- Contacto -->
                    <div class="row g-3 mt-1">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" id="telefono" name="telefono" maxlength="12" pattern="[0-9]+"
                                    class="form-control" placeholder="Teléfono" required>
                                <label for="telefono">Teléfono</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="email" name="correo" id="correo" class="form-control"
                                    placeholder="Correo electrónico" required>
                                <label for="correo">Correo electrónico</label>
                            </div>
                        </div>
                    </div>

                    <!-- Responsable y nombre del local -->
                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="responsable" id="responsable" class="form-control"
                                    maxlength="100" placeholder="Responsable" required>
                                <label for="responsable">Responsable</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="tienda" id="tienda" class="form-control" maxlength="40"
                                    placeholder="Nombre del local" required>
                                <label for="tienda">Nombre del Local</label>
                            </div>
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="mt-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea name="direccion" id="direccion" rows="3" class="form-control" maxlength="300"
                            placeholder="Dirección" required></textarea>
                    </div>



                    <!-- Botón -->
                    <div class="text-end mt-4">
                        <button type="reset" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary">Guardar Local</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {

        const departamentos = document.querySelector('#departamento');
        const provincias = document.querySelector('#provincia');
        const distritos = document.querySelector('#distrito');
        const formRegistroTienda = document.querySelector('#form-registro-tienda');
        const selectTienda = document.querySelector('#idmotorpark');
        const selectPrincipal = document.querySelector('#principal');
        const telefono = document.querySelector('#telefono');
        const correo = document.querySelector("#correo");
        const responsable = document.querySelector("#responsable");
        const nombreLocal = document.querySelector('#tienda');
        const direccion = document.querySelector("#direccion");
        const latitud = null;
        const longitud = null;



        async function getAllDepartamentos() {
            const params = new URLSearchParams();
            params.append("operation", 'getAllDepartamentos');

            await fetch(`../../app/controllers/ubigeo.c.php?${params}`)
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
                .catch(e => {
                    console.log(e)
                });
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
                .catch(e => {
                    console.log(e)
                });
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
                .catch(e => {
                    console.log(e)
                });
        }

        async function getTiendas() {
            const params = new URLSearchParams();
            params.append('operation', 'getMotorPark');

            await fetch(`../../app/controllers/local.c.php?${params}`)
                .then(response => response.json())
                .then(data => {

                    if (data.length > 0) {
                        data.forEach(element => {
                            selectTienda.innerHTML += `
                  <option value='${element.idmotorpark}'>${element.nombrecomercial}</option> `
                        })
                    }

                    ;
                })
                .catch(e => {
                    console.log(e)
                });

        }

        //Eventos
        departamentos.addEventListener("change", () => {
            getAllProvincias(departamentos.value);
        })
        provincias.addEventListener("change", () => {
            getAllDistritos(provincias.value);
        })
        distritos.addEventListener("change", () => {
            //direccion.focus();
        })

        getTiendas();




        formRegistroTienda.addEventListener("submit", (event) => {
            event.preventDefault();

            if (confirm("¿Desea registrar este local?")) {
                const params = new FormData();
                params.append("operation", "create");
                params.append("tienda", nombreLocal.value);
                params.append("iddistrito", distritos.value);
                params.append("idmotorpark", selectTienda.value);
                params.append("principal", selectPrincipal.value);
                params.append("responsable", responsable.value);
                params.append("correo", correo.value ?? null);
                params.append("direccion", direccion.value ?? null);
                params.append("telefono", telefono.value ?? null);
                params.append("longitud", longitud ?? null);
                params.append("latitud", latitud ?? null);


                fetch(`../../app/controllers/local.c.php`, {
                    method: 'POST',
                    body: params
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.id > 0) {
                            idconcesionario = data.id
                            showToast("Nuevo local agregado", "SUCCESS", 1500);
                            btnCancelarRegistro.setAttribute("disabled", true);
                            btnRegistrarConcesionario.setAttribute("disabled", true);
                        } else {
                            idconcesionario = null;
                        }
                    })
                    .catch(error => {
                        console.error(error)
                    });
            }
        })


        getAllDepartamentos()

    });
</script>

<?php require_once "../partials/footer.php"; ?>