<?php

require_once '../config/Database.php';

class Tienda{

  private $pdo = null;

  public function __construct(){ $this->pdo = Database::getConexion(); }

  public function getTiendasByIdConcesionario($idconcesionario = -1):array{
    try{
      $cmd = $this->pdo->prepare("call spu_tiendas_por_concesionario(?)");
      $cmd->execute(array($idconcesionario));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }catch(PDOException $error){
      error_log($error->getMessage());
      return [];
    }
  }

  public function getTiendasById($idTienda = -1):array{
    try{
      $cmd = $this->pdo->prepare("call spu_tiendas_obtener(?)");
      $cmd->execute(array($idTienda));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }catch(PDOException $error){
      error_log($error->getMessage());
      return [];
    }
  }

  //PENDIENTE !!!
  public function delete($idTienda = -1):int{
    try{
      $cmd = $this->pdo->prepare("DELETE FROM tiendas WHERE idtienda = ?");
      $cmd->execute(array($idTienda));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return 1;
    }catch(PDOException $error){
      error_log($error->getMessage());
      return -1;
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
