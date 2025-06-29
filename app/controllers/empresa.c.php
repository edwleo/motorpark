<?php

header('Content-Type: application/json; charset=utf-8');
require_once '../models/Empresa.php';
$empresa = new Empresa();

if (isset($_GET['operation'])) {


    switch ($_GET['operation']) {
        case 'getAllEmpCliente':
            echo json_encode($empresa->getAllEmpresasCliente());
            break;

        case 'getDataEmpresa':
            echo json_encode($empresa->getDatosEmpresa($_GET['idempresa']));
            break;

    }



}

if (isset($_POST['operation'])) {
    switch ($_POST['operation']) {

        case 'create':
            $registro = [
                'iddistrito' => $_POST['iddistrito'],
                'razonsocial' => $_POST['razonsocial'],
                'nombrecomercial' => $_POST['nombrecomercial'],
                'ruc' => $_POST['ruc'],
                'representante' => $_POST['representante'],
                'email' => $_POST['email'] !== '' && $_POST['email'] !== 'null' ? $_POST['email'] : null,
                'direccion' => $_POST['direccion'] !== '' && $_POST['direccion'] !== 'null' ? $_POST['direccion'] : null,
                'referencia' => $_POST['referencia'] !== '' && $_POST['referencia'] !== 'null' ? $_POST['referencia'] : null,
                'latitud' => $_POST['latitud'] !== '' && $_POST['latitud'] !== 'null' ? $_POST['latitud'] : null,
                'longitud' => $_POST['longitud'] !== '' && $_POST['longitud'] !== 'null' ? $_POST['longitud'] : null,
                'telprimario' => $_POST['telprimario'],
                'telsecundario' => $_POST['telsecundario'] !== '' && $_POST['telsecundario'] !== 'null' ? $_POST['telsecundario'] : null
            ];

            $results = ["id" => $empresa->create($registro)];
            echo json_encode($results);
            break;



        case 'update':
            $registro = [
                'razonsocial' => $_POST['razonsocial'],
                'nombrecomercial' => $_POST['nombrecomercial'],
                'ruc' => $_POST['ruc'],
                'representante' => $_POST['representante'] !== '' ? $_POST['representante'] : null,
                'email' => $_POST['email'] !== '' ? $_POST['email'] : null,
                'telprimario' => $_POST['telprimario'],
                'idempresa' => $_POST['idempresa']
            ];


            $results = ['rows' => $empresa->update($registro)];
            echo json_encode($results);
            break;


    }
}