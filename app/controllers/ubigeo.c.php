<?php

header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['operation'])) {

  require_once '../models/Ubigeo.php';
  $ubigeo = new Ubigeo();

  switch ($_GET['operation']) {
    case 'getAllDepartamentos':
      echo json_encode($ubigeo->getAllDepartamentos());
      break;
    case 'getAllProvincias':
      echo json_encode($ubigeo->getAllProvincias($_GET['iddepartamento']));
      break;
    case 'getAllDistritos':
      echo json_encode($ubigeo->getAllDistritos($_GET['idprovincia']));
      break;
    case 'getAllDistritosAll':
      echo json_encode($ubigeo->getAllDistritosAll());
      break;
  }
}
