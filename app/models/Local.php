<?php

require_once '../config/Database.php';

class Local
{


    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConexion();
    }

    // Función para traer la tienda  por nomnbrecomercial

    public function getMotorPark()
    {
        try {
            $query = "SELECT idmotorpark, nombrecomercial FROM motorpark";
            $cmd = $this->pdo->prepare($query);
            $cmd->execute();
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $error) {
            error_log($error->getMessage());
            return [];
        }
    }

    public function getAllLocales(): array
    {

        try {
            $query = "
            SELECT 
                l.*, 
                d.distrito, 
                p.provincia, 
                dp.departamento
            FROM locales l
            INNER JOIN distritos d ON l.iddistrito = d.iddistrito
            INNER JOIN provincias p ON d.idprovincia = p.idprovincia
            INNER JOIN departamentos dp ON p.iddepartamento = dp.iddepartamento
        ";
            $cmd = $this->pdo->prepare($query);
            $cmd->execute();
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $error) {
            error_log($error->getMessage());
            return [];
        }
    }

    public function create($params = [])
    {
        $query = "INSERT INTO locales(tienda, iddistrito, idmotorpark, principal, responsable, correo, direccion, telefono, latitud, longitud ) VALUES (?,?,?,?,?,?,?,?,?,?)";
        try {
            $cmd = $this->pdo->prepare($query);
            $cmd->execute(
                array(
                    $params['tienda'],
                    $params['iddistrito'],
                    $params['idmotorpark'],
                    $params['principal'],
                    $params['responsable'],
                    $params['correo'],
                    $params['direccion'],
                    $params['telefono'],
                    $params['latitud'],
                    $params['longitud']
                )
            );
            return (int) $this->pdo->lastInsertId();
        } catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    }

    public function getTelResponsableById($idlocal = 0): array
    {
        $query = "SELECT responsable, telefono FROM locales WHERE idlocal = ?";
        try {
            $cmd = $this->pdo->prepare($query);
            $cmd->execute(array($idlocal));
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $error) {
            error_log($error->getMessage());
            return [];
        }
    }
    public function update($params): int
    {
        try {
            $query = "UPDATE locales SET  
                responsable = ?, 
                telefono = ?, 
                modificado = NOW()
              WHERE idlocal = ?";

            $cmd = $this->pdo->prepare($query);
            $cmd->execute([
                $params['responsable'],
                $params['telefono'],
                $params['idlocal']
            ]);

            return (int) $cmd->rowCount();
        } catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    }

    public function delete($idlocal = -1): int
    {
        try {
            $cmd = $this->pdo->prepare("DELETE FROM locales WHERE idlocal=?");
            $cmd->execute(array($idlocal));
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return (int) $cmd->rowCount();
        } catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    }
}

// $local = new Local();
// echo json_encode($local->delete(5));

//   $datos = [
//       'tienda' => 'Motorpark',
//       'iddistrito' => 1007,
//       'idmotorpark' => 1,
//       'principal' => 'S',
//       'responsable' => 'Mendoza Huaraca Yhon Kennidey',
//       'correo' => 'atencion@yondaperu.com',
//       'direccion' => 'Chincha Alta 11702',
//       'telefono' => '999665558',
//       'latitud' => null,
//       'longitud' => null,
//       'idlocal' => 1
//   ];

//   echo json_encode($local->create($datos));

// echo json_encode($local->getTelResponsableById(1));
