<?php

require_once '../config/Database.php';

class Persona
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConexion();
    }


    // Función para traer los datos del clientePersona a actualizar.
    public function getDatosPersona($idpersona = 0): array
    {

        $query = "
                SELECT
                    p.idpersona,
                    p.nombres,
                    p.apellidos,
                    p.estadocivil,
                    p.email,
                    p.direccion,
                    p.telprimario,
                    p.latitud,
                    p.longitud,
                    d.iddistrito,
                    d.distrito,
                    pr.idprovincia,
                    pr.provincia,
                    dp.iddepartamento,
                    dp.departamento
                FROM personas p
                INNER JOIN distritos d ON p.iddistrito = d.iddistrito
                INNER JOIN provincias pr ON d.idprovincia = pr.idprovincia
                INNER JOIN departamentos dp ON pr.iddepartamento = dp.iddepartamento
                WHERE p.idpersona = ?";
        try {
            $cmd = $this->pdo->prepare($query);
            $cmd->execute(array($idpersona));
            $results = $cmd->fetch(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $error) {
            error_log($error->getMessage());
            return [];
        }
    }




    public function getPersonasCliente()
    {
        try {

            $query = "SELECT
                            c.idcliente,
                            c.idpersona,
                            CONCAT(de.departamento, ' / ', pr.provincia, ' / ', di.distrito) AS ubicacion,
                            p.direccion,
                            CONCAT(p.apellidos, ' ', p.nombres) AS nombrecompleto,
                            p.tipodoc,
                            p.nrodoc,
                            p.email,
                            p.telprimario
                        FROM clientes c
                        INNER JOIN personas p ON c.idpersona = p.idpersona
                        LEFT JOIN distritos di ON p.iddistrito = di.iddistrito
                        LEFT JOIN provincias pr ON di.idprovincia = pr.idprovincia
                        LEFT JOIN departamentos de ON pr.iddepartamento = de.iddepartamento
                        WHERE c.tipocliente = 'P' AND c.estado = 'ACT'";
            $cmd = $this->pdo->prepare($query);
            $cmd->execute();
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $error) {
            error_log($error->getMessage());
            return [];
        }
    }

    public function update($params): int
    { {
            try {
                $query = "UPDATE personas SET  
                nombres = ?, 
                apellidos = ?, 
                estadocivil = ?,
                email = ?,
                direccion = ?,
                telprimario = ?,
                latitud   = ?,
                longitud = ?,
                iddistrito = ?,
                modificado = NOW()
              WHERE idpersona  = ?";

                $cmd = $this->pdo->prepare($query);
                $cmd->execute([
                    $params['nombres'],
                    $params['apellidos'],
                    $params['estadocivil'],
                    $params['email'],
                    $params['direccion'],
                    $params['telprimario'],
                    $params['latitud'],
                    $params['longitud'],
                    $params['iddistrito'],
                    $params['idpersona']
                ]);

                return (int) $cmd->rowCount();
            } catch (PDOException $error) {
                error_log($error->getMessage());
                return -1;
            }
        }


    }


    public function create($params)
    {
        $query = "INSERT INTO personas(apellidos,nombres, tipodoc, nrodoc, genero, fechanac, estadocivil, email, iddistrito, direccion, referencia, telprimario, telalternativo,latitud, longitud)
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

        } catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }



    }


}

// $persona = new Persona();

// $datosActualizados = [
//     'nombres' => 'Luis Alberto',
//     'apellidos' => 'Ramírez Gómez',
//     'estadocivil' => 'CAS',
//     'email' => 'luis.ramirez@example.com',
//     'direccion' => 'Av. Los Olivos 123',
//     'telprimario' => '987654321',
//     'latitud' => '-12.0464',
//     'longitud' => '-77.0428',
//     'iddistrito' => 1007,    
//     'idpersona' => 6         
// ];

// var_dump($persona->update($datosActualizados));

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