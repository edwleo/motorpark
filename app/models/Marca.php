<?php

require_once '../config/Database.php';

class Marca
{

  private $pdo = null;

  public function __construct()
  {
    $this->pdo = Database::getConexion();
  }

  public function getAllMarcas()
  {
    $query = "
    SELECT
      MR.idmarca, MR.marca, COUNT(MD.idmodelo) 'modelos'
      FROM marcas MR
        LEFT JOIN modelos MD ON MD.idmarca = MR.idmarca
        GROUP BY MR.idmarca, MR.marca;
    ";

    try {
      $cmd = $this->pdo->prepare($query);
      $cmd->execute();
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return [];
    }
  }

  public function create($marca = ''): int
  {
    $query = "INSERT INTO marcas (marca) VALUES (?)";
    try {
      $cmd = $this->pdo->prepare($query);
      $cmd->execute(array($marca)
      );
      return (int) $this->pdo->lastInsertId();
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return -1;
    }
  }

  public function delete($idmarca = -1): int
  {
    $sql = "DELETE FROM marcas WHERE idmarca = ?";
    try {
      $cmd = $this->pdo->prepare($sql);
      $cmd->execute(array($idmarca));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return (int) $cmd->rowCount();
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return -1;
    }
  }

}