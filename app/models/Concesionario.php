<?php

require_once '../config/Database.php';

class Concesionario{

  private $pdo = null;

  public function __construct(){ $this->pdo = Database::getConexion(); }

  public function getAllConcesionarios():array{
    $query = "SELECT idconcesionario, ruc, razonsocial, nombrecomercial FROM concesionarios ORDER BY creado DESC";
    try{
      $cmd = $this->pdo->prepare($query);
      $cmd->execute();
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }catch(PDOException $error){
      error_log($error->getMessage());
      return [];
    }
  }

  public function getConcesionarioByRUC($ruc = ''):array{
    $query = "SELECT idconcesionario, ruc, razonsocial, nombrecomercial FROM concesionarios WHERE ruc = ?";
    try{
      $cmd = $this->pdo->prepare($query);
      $cmd->execute(array($ruc));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }catch(PDOException $error){
      error_log($error->getMessage());
      return [];
    }
  }

  public function create($params = []):int{
    $query = "INSERT INTO concesionarios (ruc, razonsocial, nombrecomercial) VALUES (?,?,?)";
    try{
      $cmd = $this->pdo->prepare($query);
      $cmd->execute(
        array(
          $params['ruc'],
          $params['razonsocial'],
          $params['nombrecomercial']
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
