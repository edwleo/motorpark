<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../models/Usuario.php';

$usuario = new Usuario();

//  ——— Procesamiento de POST para crear persona desde el modal ———
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['operation'] ?? '') === 'create') {
    // Llamamos al método del modelo y devolvemos la respuesta
    $resp = $usuario->createPersona([
        'tipodoc'        => $_POST['tipodoc'] ?? '',
        'nrodoc'         => $_POST['nrodoc'] ?? '',
        'apellidos'      => $_POST['apellidos'] ?? '',
        'nombres'        => $_POST['nombres'] ?? '',
        'genero'         => $_POST['genero'] ?? '',
        'fechanac'       => $_POST['fechanac'] ?? null,
        'estadocivil'    => $_POST['estadocivil'] ?? null,
        'email'          => $_POST['email'] ?? null,
        'iddistrito'     => intval($_POST['iddistrito'] ?? 0) ?: null,
        'direccion'      => $_POST['direccion'] ?? null,
        'referencia'     => $_POST['referencia'] ?? null,
        'telprimario'    => $_POST['telprimario'] ?? '',
        'telalternativo' => $_POST['telalternativo'] ?? null,
    ]);
    if ($resp['success']) {
        echo json_encode([
            'success'   => true,
            'idpersona' => $resp['idpersona']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => $resp['message']
        ]);
    }
    exit;
}

//  ——— Mantenemos el GET para áreas, cargos, usuarios… ———
if (isset($_GET['operation'])) {
  switch ($_GET['operation']) {
    case 'getAllUsuarios':
      echo json_encode($usuario->getAllUsuarios());
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
