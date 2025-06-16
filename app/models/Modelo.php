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

  /**
   * Obtenemos una lista de modelos de vehículos según la marca y tipo pasado como parámetro
   * @param int $idmarca
   * @param int $idtipovehiculo
   * @return array
   */
  public function getModelosByTipoMarca(int $idmarca, int $idtipovehiculo)  
  {
    $query = "
    SELECT
    MD.idmodelo, MD.modelo, MD.anio
    FROM modelos MD
      INNER JOIN marcas MR ON MR.idmarca = MD.idmarca
      INNER JOIN tipovehiculos TV ON TV.idtipovehiculo = MD.idtipovehiculo
      WHERE MR.idmarca = ? AND TV.idtipovehiculo = ?
      ORDER BY MD.modelo, MD.anio;
    ";
    try {
      $cmd = $this->pdo->prepare($query);
      $cmd->execute(array($idmarca, $idtipovehiculo));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return [];
    }
  }


  /**
   * Agrega un nuevo modelo de vehículo de acuerdo a la marca y tipo
   * @param mixed $params Conjunto de datos de entrada en un arreglo asociativo
   * @return int Retorna la PK generada
   */
  public function create($params = []): int
  {
    $query = "INSERT INTO modelos (idmarca, idtipovehiculo, modelo, anio)  VALUES	(?,?,?,?)";
    try {
      $cmd = $this->pdo->prepare($query);
      $cmd->execute(
        array(
          $params['idmarca'],
          $params['idtipovehiculo'],
          $params['modelo'],
          $params['anio']
        )
      );
      return (int) $this->pdo->lastInsertId();
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return -1;
    }
  }

  public function delete($idmodelo = -1): int
  {
    $sql = "DELETE FROM modelos WHERE idmodelo = ?";
    try {
      $cmd = $this->pdo->prepare($sql);
      $cmd->execute(array($idmodelo));
      return (int) $cmd->rowCount();
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return -1;
    }
  }

}