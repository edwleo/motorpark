<?php

require_once '../config/Database.php';

class Empresa
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConexion();
    }


    public function getAllEmpresasCliente()
    {
        try {

            $query = "SELECT
                            c.idcliente,
                            e.idempresa,
                            CONCAT(dep.departamento, ' / ', p.provincia, ' / ', d.distrito) AS ubicacion,
                            e.direccion,
                            e.representante AS responsable,
                            e.ruc,
                            e.nombrecomercial,
                            e.telprimario,
                            e.email,
                            e.estado
                        FROM clientes c
                        INNER JOIN empresas e ON c.idempresa = e.idempresa
                        INNER JOIN distritos d ON e.iddistrito = d.iddistrito
                        INNER JOIN provincias p ON d.idprovincia = p.idprovincia
                        INNER JOIN departamentos dep ON p.iddepartamento = dep.iddepartamento
                        WHERE c.tipocliente = 'E'  AND c.estado = 'ACT'";

            $cmd = $this->pdo->prepare($query);
            $cmd->execute();
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $error) {
            error_log($error->getMessage());
            return [];
        }
    }



    public function getDatosEmpresa($idempresa = 0): array
    {
        $query = "
                SELECT
                    e.razonsocial,
                    e.nombrecomercial,
                    e.ruc,
                    e.representante,
                    e.email,
                    e.telprimario
                FROM empresas e
              
                WHERE e.idempresa = ?;
                
                ";
        try {

            $cmd = $this->pdo->prepare($query);
            $cmd->execute(array($idempresa));
            $results = $cmd->fetch(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $error) {
            error_log($error->getMessage());
            return [];
        }
    }


    public function create($params = [])
    {
        $query = "INSERT INTO empresas (
                    iddistrito,
                    razonsocial,
                    nombrecomercial,
                    ruc,
                    representante,
                    email,
                    direccion,
                    referencia,
                    latitud,
                    longitud,
                    telprimario,
                    telsecundario
                ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?) ";

        try {

            $cmd = $this->pdo->prepare($query);
            $cmd->execute(array(
                $params['iddistrito'],
                $params['razonsocial'],
                $params['nombrecomercial'],
                $params['ruc'],
                $params['representante'],
                $params['email'], // null
                $params['direccion'],
                $params['referencia'],// null
                $params['latitud'], // null
                $params['longitud'],// null
                $params['telprimario'],
                $params['telsecundario']//null

            ));

            return (int) $this->pdo->lastInsertId();

        } catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    }

    public function update($params = []): int
    {
        try {
            $query = "UPDATE empresas SET  
                razonsocial= ?, 
                nombrecomercial = ?, 
                ruc = ?,
                representante = ?,
                email = ?,
                telprimario = ?
              WHERE idempresa  = ?";

            $cmd = $this->pdo->prepare($query);
            $cmd->execute([
                $params['razonsocial'],
                $params['nombrecomercial'],
                $params['ruc'],
                $params['representante'],
                $params['email'],
                $params['telprimario'],
                $params['idempresa']

            ]);

            return (int) $cmd->rowCount();
        } catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    }




}








// $empresa = new Empresa();
// var_dump($empresa->getDatosEmpresa(13));
// $datos = [
//     'iddistrito'       => 102, // ID de distrito válido
//     'razonsocial'      => 'Constructora Andina SAC',
//     'nombrecomercial'  => 'Andina',
//     'ruc'              => '20123456789',
//     'representante'    => 'Luis Martínez Gómez',
//     'email'            =>  'empresa@andina.com',
//     'direccion'        => 'Av. Los Héroes 345 - Piso 4',
//     'referencia'       => null,
//     'latitud'          => null,
//     'longitud'         => null,
//     'telprimario'      => '998877665',
//     'telsecundario'    => null
// ];

// var_dump($empresa->create($datos));