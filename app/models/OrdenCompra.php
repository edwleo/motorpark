<?php

require_once '../config/Database.php';

class OrdenCompra
{
  private $pdo = null;

  public function __construct()
  {
    $this->pdo = Database::getConexion();
  }

  public function create($params = []): int
  {
    try {
      $cmd = $this->pdo->prepare("call spu_oc_registrar(?,?,?,?,?,?)");
      $cmd->execute(
        array(
          $params['idtienda'],
          $params['idlogistica'],
          $params['moneda'],
          $params['serie'],
          $params['numstock'],
          $params['observaciones']
        )
      );
      $result = $cmd->fetch(PDO::FETCH_ASSOC);
      return (int) $result['last_id'];
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return -1;
    }
  }

}