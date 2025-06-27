<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Cliente.php';

$cliente = new Cliente();

if (isset($_GET['operation'])) {

    switch ($_GET['operation']) {

        case 'getAllClientes':
            echo json_encode($cliente->getAllClientes());
            break;
    }
}

if (isset($_POST['operation'])) {
    switch ($_POST['operation']) {

        case 'create':

            $registros = [
                'idpersona' => $_POST['idpersona'],
                'idcolregistra' => $_POST['idcolregistra'] ?? null,
                'idcolactualiza' => $_POST['idcolactualiza'] ?? null,
                'tipocliente' => $_POST['tipocliente']
            ];
            $results = ["id" => $cliente->create($registros)];
            echo json_encode($results);

            break;
    }
}
