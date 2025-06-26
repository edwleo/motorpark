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

<script>
document.addEventListener("DOMContentLoaded", () => {
  const tablaUsuarios = document.querySelector("#tabla-usuarios tbody");
  const urlController = "../../app/controllers/Usuario.controller.php?operation=getAllUsuarios";

  //Obteniendo usuarios activos
  async function obtenerUsuarios() {
    try {
      const res = await fetch(urlController, { method: 'GET' });
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
            ${u.fecha_fin 
              ? new Date(u.fecha_fin).toLocaleDateString('es-PE') 
              : ''}
          </td>
          <td class="align-middle">${u.usuario}</td>
          <td class="align-middle">
            <a href="<?= $path ?>/views/usuarios/editar/${u.id}" 
               class="btn btn-sm btn-outline-primary" title="Editar">
              <i class="fa-solid fa-pen"></i>
            </a>
            <button data-id="${u.id}" 
                    class="btn btn-sm btn-outline-danger btn-borrar" 
                    title="Eliminar">
              <i class="fa-solid fa-trash"></i>
            </button>
          </td>
        `;
        tablaUsuarios.appendChild(tr);
      });

      // 2) Asigna el evento de borrado tras pintar las filas
      tablaUsuarios.querySelectorAll(".btn-borrar").forEach(btn => {
        btn.addEventListener("click", async (e) => {
          const id = btn.getAttribute("data-id");
          if (!confirm("¿Estás seguro de eliminar este usuario?")) return;
          try {
            const delRes = await fetch(
              `../../app/controllers/Usuario.controller.php?operation=deleteUsuario&id=${encodeURIComponent(id)}`,
              { method: 'GET' }
            );
            const delJson = await delRes.json();
            if (delJson.success) {
              // recarga la tabla
              await obtenerUsuarios();
              showToast?.('Usuario eliminado', 'SUCCESS', 1500);
            } else {
              alert(delJson.message || "No se pudo eliminar");
            }
          } catch (err) {
            console.error(err);
            alert("Error al eliminar el usuario.");
          }
        });
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