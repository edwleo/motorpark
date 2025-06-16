<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../models/Modelo.php';
$modelo = new Modelo();

if (isset($_GET['operation'])){
  switch($_GET['operation']){
    case 'getAll':
      echo json_encode($modelo->getAllModelos($_GET['idmarca']));
      break;
    case 'getModelosByTipoMarca':
      echo json_encode($modelo->getModelosByTipoMarca($_GET['idmarca'], $_GET['idtipovehiculo']));
      break;
    case 'delete':
      echo json_encode(["rows" => $modelo->delete($_GET['idmarca'])]);
      break;
  }
}

if (isset($_POST['operation'])){
  switch($_POST['operation']){
    case 'create':
      $registro = [
        "idmarca"       => $_POST['idmarca'],
        "idtipovehiculo"=> $_POST['idtipovehiculo'],
        "modelo"        => $_POST['modelo'],
        "anio"          => $_POST['anio']
      ];
      $results = ["id" => $modelo->create($registro)];
      echo json_encode($results);
      break;
  }
}
