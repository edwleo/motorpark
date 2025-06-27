<?php

require_once '../config/Database.php';

class Cliente
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConexion();
    }

    public function getAllClientes()
    {
        try {

            $query = "SELECT
                            c.idcliente,
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
                        WHERE c.tipocliente = 'P'";
            $cmd = $this->pdo->prepare($query);
            $cmd->execute();
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $error) {
            error_log($error->getMessage());
            return [];
        }
    }


    public function create($params = []) {

        $query = "INSERT INTO clientes(idpersona, idcolregistra, idcolactualiza, tipocliente) VALUES(?,?,?,?)";
        try {

            $cmd = $this->pdo->prepare($query);
            $cmd->execute(array(
                $params['idpersona'],
                $params['idcolregistra'],
                $params['idcolactualiza'],
                $params['tipocliente']
            ));

            return (int) $this->pdo->lastInsertId();

            
        } catch(PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    }


}

//  $cliente = new Cliente();

// var_dump($cliente->create([
//     'idpersona' => 4,
//     'idcolregistra' => null,
//     'idcolactualiza' => null,
//     'tipocliente' => 'P'
// ]));
