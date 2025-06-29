<?php

require_once '../config/Database.php';

class Cliente
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConexion();
    }

    
    

    public function create($params = [])
    {
        $query = "INSERT INTO clientes(idpersona, idempresa, idcolregistra, idcolactualiza, tipocliente)
              VALUES(:idpersona, :idempresa, :idcolregistra, :idcolactualiza, :tipocliente)";
        try {
            $cmd = $this->pdo->prepare($query);
            $cmd->execute([
                ':idpersona' => $params['idpersona'] ?? null,
                ':idempresa' => $params['idempresa'] ?? null,
                ':idcolregistra' => $params['idcolregistra'] ?? null,
                ':idcolactualiza' => $params['idcolactualiza'] ?? null,
                ':tipocliente' => $params['tipocliente']
            ]);
            return (int) $this->pdo->lastInsertId();
        } catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    }

        public function delete($idcliente = -1): int
    {
        try {
            $cmd = $this->pdo->prepare("UPDATE clientes SET estado = 'INACT' WHERE idcliente=?");
            $cmd->execute(array($idcliente));
            return (int) $cmd->rowCount();
        } catch (PDOException $error) {
            error_log($error->getMessage());
            return -1;
        }
    }


}

// $cliente = new Cliente();
// var_dump($cliente->delete(8));
// var_dump($cliente->create([
//     'idpersona' => 4,
//     'idcolregistra' => null,
//     'idcolactualiza' => null,
//     'tipocliente' => 'P'
// ]));
