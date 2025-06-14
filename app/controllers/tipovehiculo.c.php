<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/TipoVehiculo.php';

$tipovehiculo = new TipoVehiculo();

if (isset($_GET['operation'])){
  switch($_GET['operation']){
    case 'getAll':
      echo json_encode($tipovehiculo->getAll());
      break;
    case 'getTipoVehiculoByMarca':
      echo json_encode($tipovehiculo->getTipoVehiculoByMarca($_GET['idmarca']));
      break;
  }
}