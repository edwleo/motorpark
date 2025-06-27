<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Local.php';
$local = new Local();
if (isset($_GET['operation'])) {


    switch ($_GET['operation']) {
        case 'getAll':
            echo json_encode($local->getAllLocales());
            break;

        case 'getDateEdit':
            echo json_encode($local->getTelResponsableById($_GET['idlocal']));
            break;
        case 'getMotorPark':
            echo json_encode($local->getMotorPark());
            break;
        case 'delete':
            $output = ["rows" => $local->delete($_GET['idlocal'])];
            echo json_encode($output);
    }
}

if (isset($_POST['operation'])) {
    switch ($_POST['operation']) {
        case 'create':
            $registro = [
                "tienda" => $_POST['tienda'],
                "iddistrito" => $_POST['iddistrito'],
                "idmotorpark" => $_POST['idmotorpark'],
                "principal" => $_POST['principal'],
                "responsable" => $_POST['responsable'],
                "correo" => $_POST['correo'] ?? null,
                "direccion" => $_POST['direccion'] ?? null,
                "telefono" => $_POST['telefono'] ?? null,
                "longitud" => $_POST['longitud'] ?? null,
                "latitud" => $_POST['latitud'] ?? null
            ];
            $results = ["id" => $local->create($registro)];
            echo json_encode($results);
            break;

        case 'update':
            $datos = [
                "responsable" => $_POST['responsable'],
                "telefono" => $_POST['telefono'],
                "idlocal" => $_POST['idlocal']
            ];
            $results = ["rows" => $local->update($datos)];
            echo json_encode($results);
            break;
    }
}
