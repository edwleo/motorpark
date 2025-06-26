<?php

require_once '../config/Database.php';

class Ubigeo
{

  private $pdo = null;

  public function __construct()
  {
    $this->pdo = Database::getConexion();
  }

  public function getAllDepartamentos(): array
  {
    $query = "SELECT * FROM departamentos ORDER BY departamento";
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

  public function getAllProvincias($iddepartamento): array
  {
    $query = "SELECT * FROM provincias WHERE iddepartamento = ? ORDER BY provincia";
    try {
      $cmd = $this->pdo->prepare($query);
      $cmd->execute(array($iddepartamento));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return [];
    }
  }

  public function getAllDistritos($idprovincia): array
  {
    $query = "SELECT * FROM distritos WHERE idprovincia = ? ORDER BY distrito";
    try {
      $cmd = $this->pdo->prepare($query);
      $cmd->execute(array($idprovincia));
      $results = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return [];
    }
  }
  
  /**
   * Obtiene todos los distritos sin filtrar
   */
  public function getAllDistritosAll(): array
  {
    $sql = "SELECT iddistrito, distrito
          FROM distritos
          ORDER BY distrito";
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return [];
    }
  }
}
