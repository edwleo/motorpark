<?php

require_once '../config/Database.php';

class Persona
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConexion();
    }

    public function create($params) {
        $query  = "INSERT INTO personas(apellidos,nombres, tipodoc, nrodoc, genero, fechanac, estadocivil, email, iddistrito, direccion, referencia, telprimario, telalternativo,latitud, longitud)
                  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        try {
            $cmd = $this->pdo->prepare($query);
            $cmd->execute(array(
                $params['apellidos'],
                $params['nombres'],
                $params['tipodoc'],
                $params['nrodoc'],
                $params['genero'],
                $params['fechanac'],
                $params['estadocivil'],
                $params['email'],
                $params['iddistrito'],
                $params['direccion'],
                $params['referencia'],
                $params['telprimario'],
                $params['telalternativo'],
                $params['latitud'],
                $params['longitud']

            ));

            return (int) $this->pdo->lastInsertId();

        }catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    
    
    
    }


}

// $persona = new Persona();

// $datos =  [
//     'apellidos' => 'Juarez Mendoza',
//     'nombres'  => 'Francisco',
//     'tipodoc' => 'DNI',
//     'nrodoc'  => '55665552',
//     'genero' => 'M',
//     'fechanac' => '1998-12-06',
//     'estadocivil' => 'SOL',
//     'email' => 'franc98qgmail.com',
//     'iddistrito' => 1007,
//     'direccion' => 'Calle Bienvenida #445',
//     'referencia' => null,
//     'telprimario' => '996658999',
//     'telalternativo' => null,
//     'latitud' => null,
//     'longitud' => null 
// ];

// echo json_encode($persona->create($datos));