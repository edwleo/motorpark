<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Usuario.php';

if (isset($_GET['operation'])) {
  $usuario = new Usuario();

  switch ($_GET['operation']) {

    case 'getAllUsuarios':
      $results = $usuario->getAllUsuarios();
      echo json_encode($results);
      break;

    case 'getAllAreas':
      echo json_encode($usuario->getAllAreas());
      break;

    case 'getCargosByArea':
      $idArea = intval($_GET['idarea'] ?? 0);
      echo json_encode($usuario->getCargosByArea($idArea));
      break;
  }
}

if (isset($_POST['operation'])) {
  switch ($_POST['operation']) {
    case 'create':
      // Parámetros enviados desde el modal
      $params = [
        'tipodoc'        => $_POST['tipodoc']        ?? '',
        'nrodoc'         => $_POST['nrodoc']         ?? '',
        'apellidos'      => $_POST['apellidos']      ?? '',
        'nombres'        => $_POST['nombres']        ?? '',
        'genero'         => $_POST['genero']         ?? '',
        'fechanac'       => $_POST['fechanac']       ?? null,
        'estadocivil'    => $_POST['estadocivil']    ?? null,
        'email'          => $_POST['email']          ?? null,
        'iddistrito'     => intval($_POST['iddistrito'] ?? 0),
        'direccion'      => $_POST['direccion']      ?? null,
        'referencia'     => $_POST['referencia']     ?? null,
        'telprimario'    => $_POST['telprimario']    ?? '',
        'telalternativo' => $_POST['telalternativo'] ?? null
      ];

      // Llamada al método create (usa el SPU)
      $newId = $usuario->create($params);

      // Responder al AJAX del modal
      echo json_encode([
        'success'   => $newId > 0,
        'idpersona' => $newId > 0 ? $newId : null,
        'message'   => $newId > 0 ? 'Persona registrada' : 'Error al crear persona'
      ]);
      break;
  }
}
