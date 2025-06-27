<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Persona.php';
$persona = new Persona();

if (isset($_POST['operation'])) {
    switch ($_POST['operation']) {

        case 'create':
            $registro  = [
                "apellidos" => $_POST['apellidos'],
                "nombres" => $_POST['nombres'],
                "tipodoc" => $_POST['tipodoc'],
                "nrodoc" => $_POST['nrodoc'],
                "genero" => $_POST['genero'],
                "fechanac" => $_POST['fechanac'],
                "estadocivil" => $_POST['estadocivil'],
                "email" => $_POST['email'] ?? null,
                "iddistrito" => $_POST['iddistrito'],
                "direccion" => $_POST['direccion'] ?? null,
                "referencia" => $_POST['referencia'] ?? null,
                "telprimario" => $_POST['telprimario'],
                "telalternativo" => $_POST['telalternativo'] ?? null,
                "latitud" => $_POST['latitud'] ?? null,
                "longitud" => $_POST['longitud'] ?? null
            ];
            $results = ["id" => $persona->create($registro)];

            echo json_encode($results);
            break;
    }
}
