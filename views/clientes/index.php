<?php require_once "../partials/header.php"; ?>

<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

    <div class="alert alert-info mt-2" role="alert">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Clientes(Normales)</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listar</li>
                        <li class="breadcrumb-item"><a href="#">Jurúdicos(Empresas)</a></li>
                    </ol>
                </nav>
            </div>




            <div class="col-md-6 text-end">
                <a class="btn btn-sm btn-outline-primary" href="<?= $path ?>/views/clientes/registrar"
                    class="">Registrar</a>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
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
                        <div class="form-floating">
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
        document.addEventListener('DOMContentLoaded', async () => {

            const tablaBody = document.querySelector('#tabla-clientes-personas tbody');

            async function obtenerClientesPersonas() {

                try {

                    const response = await fetch(`../../app/controllers/cliente.c.php?operation=getAllClientes`);
                    const data = await response.json();

                    tablaBody.innerHTML = "";

                    if (data.length > 0) {
                        let numeroFila = 1;

                        data.forEach(element => {

                            tablaBody.innerHTML += `

                            <tr>
                                <td class='align-middle'>${numeroFila++}</td>
                                <td class='align-middle'>${element.ubicacion}</td>
                                <td class='align-middle'>${element.direccion} </td>
                                <td class='align-middle'>${element.nombrecompleto}</td>
                                <td class='align-middle'>${element.tipodoc}</td>
                                <td class='align-middle'>${element.nrodoc}</td>
                                <td class='align-middle'>${element.email}</td>
                                <td class='align-middle'>${element.telprimario}</td>
                                <td>
                                <a href='#' class='btn btn-sm btn-outline-primary edit' 
                                    data-idlocal='${element.idcliente}' 
                                    data-responsable='' 
                                    data-telefono=''
                                    title='Editar'><i class="fa-solid fa-pen"></i></a>

                                <a href='#' title='Eliminar' data-idcliente='${element.idcliente}' 
                                    class='btn btn-sm btn-outline-danger delete'>
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                </td>
                            </tr>
                            `;

                        });
                    }

                } catch (error) {
                    console.error('Error al cargar los clientes', error);
                }


            }

            obtenerClientesPersonas();

        });
    </script>







    <?php require_once "../partials/footer.php"; ?>