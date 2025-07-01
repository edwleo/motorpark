<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

header('Content-Type: application/json; charset=utf-8');

// <-- rutas corregidas aquí:
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Usuario.php';

$usuario = new Usuario();

/**
 * Para iniciar sesion
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['operation'] ?? '') === 'login') {
  $nick = trim($_POST['usernick']  ?? '');
  $pwd  = trim($_POST['userpassword'] ?? '');

  if ($nick === '' || $pwd === '') {
    echo json_encode(['success' => false, 'message' => 'Faltan credenciales']);
    exit;
  }

  $resp = $usuario->authenticate($nick, $pwd);
  if ($resp['success']) {
    $_SESSION['user'] = [
      'idcolaborador' => $resp['idcolaborador'],
      'idpersona'     => $resp['idpersona'],
      'nombre'        => $resp['nombres'] . ' ' . $resp['apellidos'],
      'usernick'      => $nick
    ];
  }

  echo json_encode($resp);
  exit;
}


/**
 * POST para crear persona desde el modal
 */
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

/**
 * POST para registrar usuario completo
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['operation'] ?? '') === 'registerFull') {
  // Si ya vino idpersona, usamos esa persona; 
  if (!empty($_POST['idpersona'])) {
    $idPersona = intval($_POST['idpersona']);
  } else {
    $resp = $usuario->createPersona([
      'tipodoc'        => $_POST['tipodoc']      ?? 'DNI',
      'nrodoc'         => $_POST['nrodoc']       ?? '',
      'apellidos'      => $_POST['apellidos']    ?? '',
      'nombres'        => $_POST['nombres']      ?? '',
      'genero'         => $_POST['genero']       ?? 'M',
      'fechanac'       => $_POST['fechanac']     ?? null,
      'estadocivil'    => $_POST['estadocivil']  ?? null,
      'email'          => $_POST['email']        ?? null,
      'iddistrito'     => intval($_POST['iddistrito'] ?? 0) ?: null,
      'direccion'      => $_POST['direccion']    ?? null,
      'referencia'     => $_POST['referencia']   ?? null,
      'telprimario'    => $_POST['telprimario']  ?? '',
      'telalternativo' => $_POST['telalternativo'] ?? null,
    ]);
    if (!$resp['success']) {
      echo json_encode(['success' => false, 'message' => $resp['message']]);
      exit;
    }
    $idPersona = $resp['idpersona'];
  }

  // Ahora creamos CONTRATO y COLABORADOR en una sola transacción:
  $datosContr = [
    'cargo'        => intval($_POST['cargo'] ?? 0),
    'fecha_inicio' => $_POST['fecha_inicio'] ?? date('Y-m-d'),
    'fecha_fin'     => !empty($_POST['sin_fecha_fin'])
      ? null
      : ($_POST['fecha_fin'] ?? null),
    'tipo_contrato' => $_POST['tipo_contrato'] ?? 'P',
    'usuario'      => $_POST['usuario']      ?? '',
    'password1'    => $_POST['password1']    ?? '',
    'password2'    => $_POST['password2']    ?? '',
  ];

  // Llamamos a un nuevo método que solo inserta contrato+colaborador
  $res2 = $usuario->registerContractAndUser($idPersona, $datosContr);

  if ($res2['success']) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'message' => $res2['message']]);
  }
  exit;
}

/**
 * POST para registrar las contraseñas nuevas desde el modal
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['operation'] ?? '') === 'changePassword') {
  $id   = intval($_POST['idusuario']   ?? 0);
  $p1   = $_POST['password1'] ?? '';
  $p2   = $_POST['password2'] ?? '';
  if (!$id || !$p1 || $p1 !== $p2) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
    exit;
  }
  $res = $usuario->updatePassword($id, $p1);
  echo json_encode($res);
  exit;
}

/**
 * GET para mostrar:
 */
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
    case 'getPersonaByDNI':
      $dni = $_GET['dni'] ?? '';
      $persona = $usuario->getPersonaByDNI($dni);
      echo json_encode($persona);
      break;
    case 'getUsernickById':
      $id = intval($_GET['id'] ?? 0);
      if ($id > 0) {
        $res = $usuario->getUsernickById($id);
        echo json_encode($res);
      } else {
        echo json_encode([]);
      }
      break;
    case 'deleteUsuario':
      if (!isset($_GET['idcolaborador'])) {
        echo json_encode(['success' => false, 'message' => 'Falta idcolaborador']);
        exit;
      }
      $id = (int) $_GET['idcolaborador'];
      // Llama a tu método del modelo que haga el DELETE
      $res = $usuario->deleteById($id);
      if ($res['success']) {
        echo json_encode(['success' => true]);
      } else {
        echo json_encode(['success' => false, 'message' => $res['message']]);
      }
      exit;
  }
}
