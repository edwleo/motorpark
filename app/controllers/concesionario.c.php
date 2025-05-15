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
  }

}