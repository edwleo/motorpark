<?php

require_once '../config/Database.php';

class Usuario
{

  private $pdo = null;

  public function __construct()
  {
    $this->pdo = Database::getConexion();
  }

  /**
   * Obtiene todos los usuarios
   */
  public function getAllUsuarios(): array
  {
    $query = "SELECT
        p.idpersona     AS id,
        p.apellidos     AS apellidos,
        p.nombres       AS nombres,
        a.area          AS area,
        cg.cargo        AS cargo,
        cl.fechainicio  AS fecha_inicio,
        cl.fechafin     AS fecha_fin,
        col.usernick    AS usuario
      FROM personas p
      INNER JOIN contratoslaborales cl
        ON cl.idpersona = p.idpersona
      INNER JOIN cargos cg
        ON cg.idcargo = cl.idcargo
      INNER JOIN areas a
        ON a.idarea = cg.idarea
      INNER JOIN colaboradores col
        ON col.idcontratolaboral = cl.idcontratolaboral
      ORDER BY p.idpersona
      LIMIT 0,1000;
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
   * Devuelve todas las áreas.
   */
  public function getAllAreas(): array
  {
    $sql = "SELECT idarea, area FROM areas ORDER BY area";
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return [];
    }
  }

  /**
   * Dado un id de área, devuelve los cargos asociados.
   */
  public function getCargosByArea(int $idArea): array
  {
    $sql = "SELECT idcargo, cargo
            FROM cargos
            WHERE idarea = :idarea
            ORDER BY cargo";
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':idarea', $idArea, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return [];
    }
  }

  public function create(array $params): int
  {
    try {
      $sql = "CALL spu_pers_registrar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        $params['tipodoc'],
        $params['nrodoc'],
        $params['apellidos'],
        $params['nombres'],
        $params['genero'],
        $params['fechanac'],
        $params['estadocivil'],
        $params['email'],
        $params['iddistrito'],
        $params['direccion'],
        $params['referencia'],
        $params['telprimario'],
        $params['telalternativo']
      ]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return isset($row['last_id']) ? (int)$row['last_id'] : -1;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return -1;
    }
  }
  
}
