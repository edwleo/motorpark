<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Persona.php';
$persona = new Persona();


if (isset($_GET['operation'])) {

    switch ($_GET['operation']) {


        case 'getAllPersonsClient':
            echo json_encode($persona->getPersonasCliente());
            break;

        case 'getDataPersona':
            echo json_encode($persona->getDatosPersona($_GET['idpersona']));
            break;

    }
}

if (isset($_POST['operation'])) {


    switch ($_POST['operation']) {

        case 'create':
            $registro = [
                "apellidos" => $_POST['apellidos'],
                "nombres" => $_POST['nombres'],
                "tipodoc" => $_POST['tipodoc'],
                "nrodoc" => $_POST['nrodoc'],
                "genero" => $_POST['genero'],
                "fechanac" => $_POST['fechanac'],
                "estadocivil" => $_POST['estadocivil'],
                "email" => $_POST['email'] !== '' ? $_POST['email'] : null,
                "iddistrito" => $_POST['iddistrito'],
                "direccion" => $_POST['direccion'] !== '' ? $_POST['direccion'] : null,
                "referencia" => $_POST['referencia'] !== '' ? $_POST['referencia'] : null,
                "telprimario" => $_POST['telprimario'],
                "telalternativo" => $_POST['telalternativo'] !== '' ? $_POST['telalternativo'] : null,
                "latitud" => $_POST['latitud'] !== '' ? $_POST['latitud'] : null,
                "longitud" => $_POST['longitud'] !== '' ? $_POST['longitud'] : null
            ];

            $results = ["id" => $persona->create($registro)];

            echo json_encode($results);
            break;

        case 'update':
            $registro = [
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'estadocivil' => $_POST['estadocivil'],
                'email' => $_POST['email'] !== '' ? $_POST['email'] : null,
                'direccion' => $_POST['direccion'] !== '' ? $_POST['direccion'] : null,
                'telprimario' => $_POST['telprimario'],
                'latitud' => $_POST['latitud'] !== '' ? $_POST['latitud'] : null,
                'longitud' => $_POST['longitud'] !== '' ? $_POST['longitud'] : null,
                'iddistrito' => $_POST['iddistrito'] !== '' ? $_POST['iddistrito'] : null,
                'idpersona' => $_POST['idpersona']
            ];


            $results = ['rows' => $persona->update($registro)];
            echo json_encode($results);
            break;
    }
}
