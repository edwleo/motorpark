<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/OrdenCompra.php';

$ordenCompra = new OrdenCompra();

if (isset($_POST['operation'])){
  switch ($_POST['operation']){
    case 'create':
      $registro = [
        "idtienda"      => $_POST['idtienda'],
        "idlogistica"   => 2,
        "moneda"        => $_POST['moneda'],
        "serie"         => "2025-00001",
        "numstock"      => $_POST['numstock'],
        "observaciones" => $_POST['observaciones']
      ];
      $results = ["id" => $ordenCompra->create($registro)];
      echo json_encode($results);
      break;
  }
}