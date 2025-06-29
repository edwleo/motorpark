<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Cliente.php';

$cliente = new Cliente();

if (isset($_GET['operation'])) {

    switch ($_GET['operation']) {

        case 'delete':
            $output = ["rows" => $cliente->delete($_GET['idcliente'])];
            echo json_encode($output);

    }
}

if (isset($_POST['operation'])) {
    switch ($_POST['operation']) {

        case 'create':

            $registros = [
                'idpersona' => $_POST['idpersona'] ?? null,
                'idempresa' => $_POST['idempresa'] ?? null,
                'idcolregistra' => $_POST['idcolregistra'] ?? null,
                'idcolactualiza' => $_POST['idcolactualiza'] ?? null,
                'tipocliente' => $_POST['tipocliente']
            ];
            $results = ["id" => $cliente->create($registros)];
            echo json_encode($results);

            break;
    }
}
