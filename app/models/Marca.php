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

  /**
   * Se retorna la PK de la marca registrada
   * @param mixed $marca
   * @return int
   */
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

  /**
   * Elimina una marca de forma física, siempre que esta no esté siendo utilizada
   * @param mixed $idmarca PK de la marca a eliminar
   * @return int Cantidad de filas afectadas, si es 0, no se eliminó registros
   */
  public function delete($idmarca = -1): int
  {
    $sql = "DELETE FROM marcas WHERE idmarca = ?";
    try {
      $cmd = $this->pdo->prepare($sql);
      $cmd->execute(array($idmarca));
      return (int) $cmd->rowCount();
    } catch (PDOException $error) {
      error_log($error->getMessage());
      return -1;
    }
  }

}