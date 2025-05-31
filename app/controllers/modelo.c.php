<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../models/Modelo.php';
$modelo = new Modelo();

if (isset($_GET['operation'])){
  switch($_GET['operation']){
    case 'getAll':
      break;
  }
}
