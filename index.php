<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Motorpark</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous"> -->
</head>

<body>

  <style>
    .yonda {
      background-color: #FF5F00;
    }
  </style>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img" style="background-image: url('./public/images/motorpark-login.jpg');">
            </div>
            <div class="login-wrap p-4 p-md-5">
              <div class="d-flex">
                <div class="w-100">
                  <h3 class="mb-4">Motorpark App 1.0</h3>
                </div>
              </div>
              <form action="#" class="signin-form" id="formulario-login">
                <input type="hidden" name="operation" value="login">
                <div class="form-group mb-3">
                  <label class="label" for="usernick">Nombre de usuario</label>
                  <input type="text" name="usernick" id="usernick" class="form-control" placeholder="Nombre de usuario" autofocus required>
                </div>

                <div class="form-group mb-3">
                  <label class="label" for="userpassword">Contraseña</label>
                  <input type="password" name="userpassword" id="userpassword" class="form-control" placeholder="Contraseña" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control btn yonda text-light rounded submit px-3">Acceder</button>
                </div>
                <div class="form-group d-md-flex">
                  <div class="w-50 text-left">
                    <label class="checkbox-wrap checkbox-primary mb-0">Recordar
                      <input type="checkbox" checked>
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="w-50 text-md-right">
                    <a href="#">Recuperar contraseña</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const formulario = document.querySelector("#formulario-login");
      formulario.addEventListener("submit", async (event) => {
        event.preventDefault();
        const data = new FormData(formulario);
        try {
          const resp = await fetch('app/controllers/Usuario.controller.php', { method: 'POST', body: data });
          // imprime el HTML/JSON que venga del servidor
          const text = await resp.text();
          console.log("RESPUESTA CRUDA:", text);

          // intenta luego parsear
          let json;
          try {
            json = JSON.parse(text);
          } catch (e) {
            console.error("JSON inválido:", e);
            return alert("Respuesta no es JSON. Mira la consola.");
          }

          if (json.success) {
            window.location.href = 'views/index.php';
          } else {
            alert(json.message);
          }
        } catch (err) {
          console.error(err);
          alert('Error de red en el servidor');
        }
      });
    });
  </script>

</body>

</html>