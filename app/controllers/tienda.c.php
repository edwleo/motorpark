<?php

header('Content-Type: application/json; charset=utf-8');

if (isset($_POST['operation'])){

  require_once '../models/Tienda.php';
  $tienda = new Tienda();

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