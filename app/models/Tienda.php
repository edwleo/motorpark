<?php

require_once '../config/Database.php';

class Tienda{

  private $pdo = null;

  public function __construct(){ $this->pdo = Database::getConexion(); }

  public function getAllTiendas():array{
    $query = "";
    try{
      $cmd = $this->pdo->prepare($query);
      $cmd->execute();
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }catch(PDOException $error){
      error_log("Query", $error->getMessage());
      return [];
    }
  }

  public function create($params = []):int{
    $query = "INSERT INTO tiendas (iddistrito, idconcesionario, direccion, email, telefono, contacto) VALUES (?,?,?,?,?,?)";
    try{
      $cmd = $this->pdo->prepare($query);
      $cmd->execute(
        array(
          $params['iddistrito'],
          $params['idconcesionario'],
          $params['direccion'],
          $params['email'],
          $params['telefono'],
          $params['contacto']
        )
      );
      return (int)$this->pdo->lastInsertId();
    }
    catch(PDOException $error){
      error_log($error->getMessage());
      return -1;
    }
  }
}
