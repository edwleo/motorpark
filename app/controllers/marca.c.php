<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../models/Marca.php';
$marca = new Marca();

if (isset($_GET['operation'])){
  switch ($_GET['operation']){
    case 'getAll':
      echo json_encode($marca->getAllMarcas());
      break;
    case 'delete':
      $results = ["rows" => $marca->delete($_GET['idmarca'])];
      echo json_encode($results);
      break;
  }
}

if (isset($_POST['operation'])){
  switch($_POST['operation']){
    case 'create':
      $results = ["id" => $marca->create($_POST['marca'])];
      echo json_encode($results);
      break;
  }
}