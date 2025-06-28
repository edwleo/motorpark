<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Usuario.php';

$u = new Usuario();

// Reemplaza  (por ejemplo) 5 con tu verdadero idcolaborador
$idColaborador = 5;

$result = $u->updatePassword($idColaborador, 'Yamilet$arch0408');
var_dump($result);
