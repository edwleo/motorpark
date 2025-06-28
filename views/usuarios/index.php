<?php require_once "../partials/header.php"; ?>

<div class="container-fluid">

  <div class="alert alert-info mt-2" role="alert">
    <div class="row">
      <div class="col-md-6 d-flex">
        <nav
          style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
          aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listar</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 text-end">
        <a href="<?= $path ?>/views/usuarios/registrar" class="">[ Registrar ]</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-sm table-hover table-hover-yonda" id="tabla-usuarios">
            <thead>
              <tr>
                <th>#</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Area</th>
                <th>Cargo</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Usuario</th>
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

<div class="modal fade" id="modalCambiarClave" tabindex="-1" aria-labelledby="modalCambiarClaveLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-yonda">
        <h5 class="modal-title" id="modalCambiarClaveLabel">Cambiar contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="formCambiarClave" autocomplete="off">
          <input type="hidden" id="cc-idusuario" name="idusuario">

          <div class="col-12 form-floating mb-3">
            <input
              type="text"
              class="form-control"
              id="cc-usuario"
              name="usuario"
              readonly>
            <label for="cc-usuario">Usuario</label>
          </div>

          <div class="col-12 form-floating mb-3">
            <input
              type="password"
              class="form-control"
              id="cc-password1"
              name="password1"
              pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$"
              title="Mínimo 8 caracteres: incluye letra, número y símbolo"
              required>
            <label for="cc-password1">Nueva contraseña</label>
          </div>
          <div class="col-12 form-floating mb-3">
            <input
              type="password"
              class="form-control"
              id="cc-password2"
              name="password2"
              required>
            <label for="cc-password2">Repetir contraseña</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-sm btn-primary" id="btnAceptarCambiarClave">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const tablaUsuarios = document.querySelector("#tabla-usuarios tbody");
    const urlController = "../../app/controllers/Usuario.controller.php?operation=getAllUsuarios";

    //Obteniendo usuarios activos
    async function obtenerUsuarios() {
      try {
        const res = await fetch(urlController, {
          method: 'GET'
        });
        if (!res.ok) throw new Error("Error en la respuesta del servidor");
        const data = await res.json();
        tablaUsuarios.innerHTML = "";
        if (!Array.isArray(data) || data.length === 0) {
          tablaUsuarios.innerHTML = `
          <tr>
            <td colspan="9" class="text-center text-muted">
              No hay usuarios registrados.
            </td>
          </tr>`;
          return;
        }

        // Recorre los usuarios y crea filas
        let numeroFila = 1;
        data.forEach(u => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
          <td class="align-middle">${numeroFila++}</td>
          <td class="align-middle">${u.apellidos}</td>
          <td class="align-middle">${u.nombres}</td>
          <td class="align-middle">${u.area}</td>
          <td class="align-middle">${u.cargo}</td>
          <td class="align-middle">
            ${u.fecha_inicio 
              ? new Date(u.fecha_inicio).toLocaleDateString('es-PE') 
              : ''}
          </td>
          <td class="align-middle">
            ${
              u.fecha_fin === 'Indeterminado'
                ? 'Indeterminado'
                : (u.fecha_fin
                    ? new Date(u.fecha_fin).toLocaleDateString('es-PE')
                    : '')
            }
          </td>
          <td class="align-middle">${u.usuario}</td>
          <td class="align-middle text-center">
            <a href="<?= $path ?>/views/usuarios/editar/${u.id}" 
               class="btn btn-sm btn-outline-primary" title="Editar">
              <i class="fa-solid fa-pen"></i>
            </a>
            <button
              type="button"
              class="btn btn-sm btn-outline-warning mx-1 btn-cambiar-clave"
              title="Cambiar contraseña"
              data-bs-toggle="modal"
              data-bs-target="#modalCambiarClave"
              data-id="${u.idcolaborador}"
              data-username="${u.usuario}"
            >
              <i class="fa-solid fa-key"></i>
            </button>
            <button data-id="${u.idcolaborador}" 
                    class="text-center btn btn-sm btn-outline-danger btn-borrar" 
                    title="Eliminar">
              <i class="fa-solid fa-trash"></i>
            </button>
          </td>
        `;
          tablaUsuarios.appendChild(tr);
        });

        // 2) Asigna el evento de borrado tras pintar las filas
        tablaUsuarios.querySelectorAll(".btn-borrar").forEach(btn => {
          btn.addEventListener("click", async () => {
            const id = btn.getAttribute("data-id");
            if (!confirm("¿Estás seguro de eliminar este usuario?")) return;
            try {
              const delRes = await fetch(
                `../../app/controllers/Usuario.controller.php?operation=deleteUsuario&idcolaborador=${encodeURIComponent(id)}`
              );
              if (!delRes.ok) throw new Error("Status " + delRes.status);
              const delJson = await delRes.json();
              if (delJson.success) {
                await obtenerUsuarios();
                showToast('Usuario eliminado', 'SUCCESS', 1500);
              } else {
                showToast(delJson.message || "No se pudo eliminar");
              }
            } catch (err) {
              console.error(err);
              showToast("Error al eliminar el usuario.");
            }
          });
        });
        tablaUsuarios.querySelectorAll(".btn-cambiar-clave").forEach(btn => {
          btn.addEventListener('click', async () => {
            const idcol = btn.dataset.id;
            /* limpia y muestra modal */
            document.getElementById('cc-idusuario').value = idcol;
            document.getElementById('cc-usuario').value = '';
            document.getElementById('cc-password1').value = '';
            document.getElementById('cc-password2').value = '';

            try {
              const res = await fetch(`../../app/controllers/Usuario.controller.php?operation=getUsernickById&id=${encodeURIComponent(idcol)}`);
              const json = await res.json();
              document.getElementById('cc-usuario').value = json.usernick || '';
            } catch (err) {
              console.error('Error cargando usuario:', err);
            }
          });
        });
        document.getElementById('btnAceptarCambiarClave').addEventListener('click', async () => {
          const form = document.getElementById('formCambiarClave');
          const pwd1 = document.getElementById('cc-password1');
          const pwd2 = document.getElementById('cc-password2');
          const idCol = document.getElementById('cc-idusuario').value;

          // 1) Validación HTML5: patrón y required
          if (!pwd1.reportValidity()) {
            return;
          }

          // 2) Contraseñas coincidentes
          if (pwd1.value !== pwd2.value) {
            showToast('Las contraseñas no coinciden.', 'ERROR', 3000);
            return;
          }

          // 3) Enviar al servidor
          const data = new FormData(form);
          data.set('operation', 'changePassword');

          try {
            const res = await fetch('../../app/controllers/Usuario.controller.php', {
              method: 'POST',
              body: data
            });
            const json = await res.json();

            if (json.success) {
              // Cerrar modal y mostrar toast
              bootstrap.Modal.getInstance(
                document.getElementById('modalCambiarClave')
              ).hide();
              showToast?.('Contraseña actualizada', 'SUCCESS', 1500);
            } else {
              alert('Error: ' + (json.message || 'No se pudo cambiar'));
            }
          } catch (err) {
            console.error(err);
            alert('Error de conexión');
          }
        });

      } catch (err) {
        console.error(err);
        tablaUsuarios.innerHTML = `
        <tr>
          <td colspan="9" class="text-center text-danger">
            Error al cargar usuarios.
          </td>
        </tr>`;
      }
    }

    // Lanza la carga inicial
    obtenerUsuarios();
  });
</script>

<?php require_once "../partials/footer.php"; ?>