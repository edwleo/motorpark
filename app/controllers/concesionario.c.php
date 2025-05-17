<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Concesionario.php';

if (isset($_GET['operation'])){
  $concesionario = new Concesionario();

  switch ($_GET['operation']){
    case 'getConcesionarioByRUC':
      $results = $concesionario->getConcesionarioByRUC($_GET['ruc']);
      echo json_encode($results);
      break;
    case 'getAllConcesionarios':
      echo json_encode($concesionario->getAllConcesionarios());
      break;
    case 'getOC':
      $output = ["rows" => $concesionario->getOC($_GET['idconcesionario'])];
      echo json_encode($output);
      break;
    case 'delete':
      $output = ["rows" => $concesionario->delete($_GET['idconcesionario'])];
      echo json_encode($output);
      break;
  }
}

if (isset($_POST['operation'])){
  $concesionario = new Concesionario();

  switch ($_POST['operation']){
    case 'create':
      $registro = [
        "ruc"             => $_POST['ruc'],
        "razonsocial"     => $_POST['razonsocial'],
        "nombrecomercial" => $_POST['nombrecomercial']
      ];
      $results = ["id" => $concesionario->create($registro)];
      echo json_encode($results);
      break;
    case 'update':
      $datos = [
        "nombrecomercial" => $_POST['nombrecomercial'],
        "idconcesionario" => $_POST['idconcesionario']
      ];
      $results = ["rows" => $concesionario->update($datos)];
      echo json_encode($results);
      break;
  }

}