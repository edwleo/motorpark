<?php

require_once '../config/Database.php';

class TipoVehiculo{

  private $pdo;

  public function __construct(){ $this->pdo = Database::getConexion(); }

  public function getAll():array{
    $sql = "SELECT idtipovehiculo, tipovehiculo FROM tipovehiculos ORDER BY tipovehiculo";

    try{
      $query = $this->pdo->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      error_log($e);
      return [];
    }
  }

  
  public function getTipoVehiculoByMarca(int $idmarca):array{
    $sql = "
    SELECT
    DISTINCT(TV.tipovehiculo), MD.idtipovehiculo 
    FROM modelos MD
      INNER JOIN tipovehiculos TV ON MD.idtipovehiculo = TV.idtipovehiculo
      WHERE MD.idmarca = ?
      ORDER BY TV. tipovehiculo;
    ";

    try{
      $query = $this->pdo->prepare($sql);
      $query->execute([$idmarca]);
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      error_log($e);
      return [];
    }
  }

}
