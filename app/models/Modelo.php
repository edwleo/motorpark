<?php

require_once '../config/Database.php';

class Modelo{

  private $pdo;

  public function __construct(){ $this->pdo = Database::getConexion(); }

  public function getAllModelos($idmarca)
  {
    try {
      $cmd = $this->pdo->prepare("call spu_modelos_obtener_por_marca(?)");
      $cmd->execute(array($idmarca));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return [];
    }
  }

}