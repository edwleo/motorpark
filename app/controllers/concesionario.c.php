<?php

header('Content-Type: application/json; charset=utf-8');
$input = json_decode(file_get_contents('php://input'), true);
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['operation'])) {
        switch ($input['operation']) {
            case 'create':
                $registro = [
                    "responsable" => $input['responsable'],
                    "telefono" => $input['telefono'] ?? null
                ];
                $results = ["id" => $local->create($registro)];
                echo json_encode($results);
                break;

            case 'update':
                $datos = [
                    "responsable" => $input['responsable'],
                    "telefono" => $input['telefono'],
                    "idlocal" => $input['idlocal']
                ];
                $results = ["rows" => $local->update($datos)];
                echo json_encode($results);
                break;
        }
    } else {
        echo json_encode(["error" => "No se especificó la operación POST"]);
    }


}