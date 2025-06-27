<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex">
        <nav
          style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
          aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Usuario</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registrar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 text-end">
        <a href="<?= $path ?>/views/usuarios" class="">[ Mostrar lista ]</a>
      </div>
    </div>
  </div>

  <!-- Campos -->
  <div class="mb-2">
    <form action="" autocomplete="off">

      <!-- PASO 1 - DATOS DE LA EMPRESA -->
      <div class="card mb-4">
        <div class="card-header bg-info">
          <strong>Paso 1:</strong> <span class="fst-italic">
            Datos de la persona
          </span>
        </div>
        <div class="card-body">

          <div class="row g-2">
            <!-- CAMPO DE DNI -->
            <div class="col-md-2 mb-2">
              <div class="input-group">
                <!-- form-floating con flex-grow para que ocupe todo el espacio -->
                <div class="form-floating flex-grow-1">
                  <input type="text" id="dni" class="form-control text-center">
                  <label for="dni">DNI</label>
                </div>
                <button type="button" class="btn btn-primary" title="Administrar" data-bs-toggle="modal"
                  data-bs-target="#modalRegistrarPersona">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
              </div>
            </div>

            <!-- CAMPO DE APELLIDOS Y NOMBRES -->
            <div class="col-md-5">
              <div class="form-floating">
                <input type="text" id="apellidos" name="apellidos" class="form-control">
                <label for="form-label">Apellidos</label>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-floating">
                <input type="text" id="nombres" name="nombres" class="form-control">
                <label for="form-label">Nombres</label>
              </div>
            </div>
          </div>

        </div> <!-- ./card-body -->
      </div><!-- ./card -->

      <!-- PASO 2 - AREA Y CARGOS -->
      <div class="card mb-4">
        <div class="card-header bg-info">
          <strong>Paso 2:</strong> <span class="fst-italic">
            Datos del contrato
          </span>
        </div>
        <div class="card-body">
          <div class="row g-2">
            <!-- Campo de área -->
            <div class="col-md-3 mb-2">
              <div class="form-floating">
                <select name="area" id="area" class="form-select" required>
                  <option value="">Seleccione</option>
                </select>
                <label for="area">Áreas</label>
              </div>
            </div>
            <!-- Campo de cargos -->
            <div class="col-md-4 mb-2">
              <div class="form-floating">
                <select name="cargo" id="cargo" class="form-select" required>
                  <option value="">Seleccione</option>
                </select>
                <label for="cargo">Cargo</label>
              </div>
            </div>
            <!-- Fecha inicio -->
            <div class="col-md-2 mb-2">
              <div class="form-floating">
                <input type="date" class="form-control" id="fecha-inicio" name="fecha_inicio">
                <label for="fecha-inicio">Fecha Inicio</label>
              </div>
            </div>
            <!-- Fecha fin -->
            <div class="col-md-2 mb-2">
              <div class="form-floating">
                <input type="date" class="form-control" id="fecha-fin" name="fecha_fin">
                <label for="fecha-fin">Fecha Fin</label>
              </div>
            </div>
            <!-- Checkbox al final -->
            <div class="col-md-1 mb-2 d-flex align-items-center">
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="" id="sin-fecha-fin" name="sin_fecha_fin">
                <label class="form-check-label" for="sin-fecha-fin">
                  Sin fecha
                </label>
              </div>
            </div>

          </div>
        </div> <!-- ./card-body -->
      </div><!-- ./card -->

      <!-- PASO 3 - PARA CUENTA -->
      <div class="card mb-2">
        <div class="card-header bg-info">
          <strong>Paso 3:</strong> <span class="fst-italic">
            Crear cuenta
          </span>
        </div>
        <div class="card-body">
          <div class="row g-2">

            <!-- CAMPO DE USER AND PASSWORD -->
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control">
                <label for="form-label">Nombre de usuario</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control">
                <label for="form-label">Contraseña 1</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control">
                <label for="form-label">Contraseña 2</label>
              </div>
            </div>
          </div>


        </div> <!-- ./card-body -->
      </div><!-- ./card -->

      <div class="card">
        <div class="card-footer text-end">
          <button type="reset" id="btn-cancelar-registro" class="btn btn-sm btn-outline-secondary">Cancelar</button>
          <button type="submit" class="btn btn-primary btn-sm btnGuardarUsuario">Registrar</button>
        </div>
      </div>
    </form>
  </div>

</div>

<!-- 2) Estructura del modal -->
<div class="modal fade" id="modalRegistrarPersona" tabindex="-1" aria-labelledby="modalRegistrarPersonaLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegistrarPersonaLabel">Datos de la Persona</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="formRegistrarPersona" autocomplete="off">
          <div class="row g-1">
            <!-- Tipo y número de doc -->
            <div class="col-md-3 form-floating">
              <select class="form-select" id="modal-tipodoc" name="tipodoc">
                <option value="DNI">DNI</option>
                <option value="CEX">CEX</option>
                <option value="PAS">PAS</option>
              </select>
              <label for="modal-tipodoc">Tipo Doc</label>
            </div>
            <div class="col-md-3 form-floating">
              <input type="text" class="form-control" id="modal-nrodoc" name="nrodoc" required>
              <label for="modal-nrodoc">N° Documento</label>
            </div>

            <!-- Apellidos / Nombres -->
            <div class="col-md-3 form-floating">
              <input type="text" class="form-control" id="modal-apellidos" name="apellidos" required>
              <label for="modal-apellidos">Apellidos</label>
            </div>
            <div class="col-md-3 form-floating">
              <input type="text" class="form-control" id="modal-nombres" name="nombres" required>
              <label for="modal-nombres">Nombres</label>
            </div>

            <!-- Género / Fecha Nac. / Estado Civil -->
            <div class="col-md-2 form-floating">
              <select class="form-select" id="modal-genero" name="genero">
                <option value="M">M</option>
                <option value="F">F</option>
              </select>
              <label for="modal-genero">Género</label>
            </div>
            <div class="col-md-4 form-floating">
              <input type="date" class="form-control" id="modal-fechanac" name="fechanac">
              <label for="modal-fechanac">F. Nacimiento</label>
            </div>
            <div class="col-md-6 form-floating">
              <select class="form-select" id="modal-estadocivil" name="estadocivil">
                <option value="">--</option>
                <option value="SOL">Soltero</option>
                <option value="CAS">Casado</option>
                <option value="VDO">Viudo</option>
                <option value="DVC">Divorciado</option>
                <option value="CNV">Conviviente</option>
              </select>
              <label for="modal-estadocivil">Estado Civil</label>
            </div>

            <!-- Email / Distrito -->
            <div class="col-md-6 form-floating">
              <input type="email" class="form-control" id="modal-email" name="email">
              <label for="modal-email">Email</label>
            </div>
            <div class="col-md-6 form-floating">
              <select class="form-select" id="modal-iddistrito" name="iddistrito">
                <option value="">Seleccione Distrito</option>
                <!-- cargar vía JS -->
              </select>
              <label for="modal-iddistrito">Distrito</label>
            </div>

            <!-- Dirección / Referencia -->
            <div class="col-md-8 form-floating">
              <input type="text" class="form-control" id="modal-direccion" name="direccion">
              <label for="modal-direccion">Dirección</label>
            </div>
            <div class="col-md-4 form-floating">
              <input type="text" class="form-control" id="modal-referencia" name="referencia">
              <label for="modal-referencia">Referencia</label>
            </div>

            <!-- Teléfonos -->
            <div class="col-md-6 form-floating">
              <input type="text" class="form-control" id="modal-telprimario" name="telprimario" maxlength="9" required>
              <label for="modal-telprimario">Teléfono Primario</label>
            </div>
            <div class="col-md-6 form-floating">
              <input type="text" class="form-control" id="modal-telalternativo" name="telalternativo" maxlength="9">
              <label for="modal-telalternativo">Teléfono Alternativo</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
          Cancelar
        </button>
        <button type="button" class="btn btn-primary btn-sm" id="btnGuardarPersona">
          Guardar
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const areaSelect = document.getElementById('area');
    const cargoSelect = document.getElementById('cargo');

    function poblarSelect(selectElem, items, placeholder = 'Seleccione') {
      selectElem.innerHTML = `<option value="">${placeholder}</option>`;
      items.forEach(item => {
        const opt = document.createElement('option');
        opt.value = item.idarea ?? item.idcargo;
        opt.text = item.area ?? item.cargo;
        selectElem.appendChild(opt);
      });
      selectElem.disabled = items.length === 0;
    }

    // 1) Obtener todas las áreas al cargar la página
    fetch(`../../app/controllers/Usuario.controller.php?operation=getAllAreas`)
      .then(res => res.json())
      .then(data => {
        poblarSelect(areaSelect, data, 'Seleccione un área');
      })
      .catch(err => console.error('Error cargando áreas:', err));

    areaSelect.addEventListener('change', () => {
      const idarea = areaSelect.value;
      if (!idarea) {
        poblarSelect(cargoSelect, [], 'Seleccione un cargo');
        return;
      }
      fetch(`../../app/controllers/Usuario.controller.php?operation=getCargosByArea&idarea=${encodeURIComponent(idarea)}`)
        .then(res => res.json())
        .then(data => {
          poblarSelect(cargoSelect, data, 'Seleccione un cargo');
        })
        .catch(err => console.error('Error cargando cargos:', err));
    });

    //  —— cargar TODOS los distritos al abrir el modal ——
    const selDist = document.getElementById('modal-iddistrito');
    const urlUbigeo = '../../app/controllers/Ubigeo.c.php';

    document.getElementById('modalRegistrarPersona')
      .addEventListener('show.bs.modal', () => {
        fetch(`${urlUbigeo}?operation=getAllDistritosAll`)
          .then(r => r.json())
          .then(list => {
            selDist.innerHTML = '<option value="">Seleccione Distrito</option>';
            list.forEach(d => {
              const opt = document.createElement('option');
              opt.value = d.iddistrito;
              opt.text = d.distrito;
              selDist.append(opt);
            });
            selDist.disabled = list.length === 0;
          })
          .catch(err => console.error('Error cargando distritos:', err));
      });

    document.getElementById('btnGuardarPersona').addEventListener('click', () => {
      const formModal = document.getElementById('formRegistrarPersona');
      const data = new FormData(formModal);
      data.append('operation', 'create');

      fetch('../../app/controllers/Usuario.controller.php', {
        method: 'POST',
        body: data
      })
        .then(res => res.json())
        .then(resp => {
          if (!resp.success) {
            return alert('Error: ' + resp.message);
          }

          // 1) Cierra el modal
          const modalEl = document.getElementById('modalRegistrarPersona');
          const bsModal = bootstrap.Modal.getInstance(modalEl);
          bsModal.hide();

          // 2) Captura los valores directamente de los inputs del modal
          const nuevoDni = document.getElementById('modal-nrodoc').value;
          const nuevosApellidos = document.getElementById('modal-apellidos').value;
          const nuevosNombres = document.getElementById('modal-nombres').value;

          // 3) Asígnalos a los campos del formulario principal
          document.getElementById('dni').value = nuevoDni;
          document.getElementById('apellidos').value = nuevosApellidos;
          document.getElementById('nombres').value = nuevosNombres;

          // 4) Guarda el idpersona si lo necesitas
          let hidden = document.getElementById('idpersona');
          if (!hidden) {
            hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.id = 'idpersona';
            hidden.name = 'idpersona';
            document.querySelector('form[autocomplete="off"]').appendChild(hidden);
          }
          hidden.value = resp.idpersona;

          alert('¡Persona registrada con ID ' + resp.idpersona + '!');
        })
        .catch(() => alert('No se pudo conectar con el servidor.'));
    });
  });
</script>

<?php require_once "../partials/footer.php"; ?>