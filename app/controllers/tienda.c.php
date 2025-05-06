<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Tienda.php';
$tienda = new Tienda();

if (isset($_POST['operation'])){

  switch ($_POST['operation']){
    case 'create':
      $registro = [
        "iddistrito"       => $_POST['iddistrito'],
        "idconcesionario"  => $_POST['idconcesionario'],
        "direccion"        => $_POST['direccion'],
        "email"            => $_POST['email'],
        "telefono"         => $_POST['telefono'],
        "contacto"         => $_POST['contacto']
      ];
      $results = ["id" => $tienda->create($registro)];
      echo json_encode($results);
      break;
  }
}

if (isset($_GET['operation'])){

  switch ($_GET['operation']){
    case 'getTiendasByIdConcesionario':
      echo json_encode($tienda->getTiendasByIdConcesionario($_GET['idconcesionario']));
      break;
  }
}