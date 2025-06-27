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
      return isset($row['last_id']) ? (int) $row['last_id'] : -1;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return -1;
    }
  }

  /**
   * Crea una nueva persona usando el SPU y devuelve el nuevo ID.
   *
   * @param array $data  Campos necesarios para el SPU.
   * @return array       ['success' => bool, 'idpersona' => int|null, 'message' => string|null]
   */
  public function createPersona(array $data): array
  {
    try {
      $sql = "CALL spu_pers_registrar(
            :tipodoc, :nrodoc, :apellidos, :nombres,
            :genero, :fechanac, :estadocivil, :email,
            :iddistrito, :direccion, :referencia,
            :telprimario, :telalternativo
        )";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':tipodoc', $data['tipodoc'], PDO::PARAM_STR);
      $stmt->bindValue(':nrodoc', $data['nrodoc'], PDO::PARAM_STR);
      $stmt->bindValue(':apellidos', $data['apellidos'], PDO::PARAM_STR);
      $stmt->bindValue(':nombres', $data['nombres'], PDO::PARAM_STR);
      $stmt->bindValue(':genero', $data['genero'], PDO::PARAM_STR);
      $stmt->bindValue(':fechanac', $data['fechanac'], PDO::PARAM_STR);
      $stmt->bindValue(':estadocivil', $data['estadocivil'], PDO::PARAM_STR);
      $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
      $stmt->bindValue(':iddistrito', $data['iddistrito'], PDO::PARAM_INT);
      $stmt->bindValue(':direccion', $data['direccion'], PDO::PARAM_STR);
      $stmt->bindValue(':referencia', $data['referencia'], PDO::PARAM_STR);
      $stmt->bindValue(':telprimario', $data['telprimario'], PDO::PARAM_STR);
      $stmt->bindValue(':telalternativo', $data['telalternativo'], PDO::PARAM_STR);

      $stmt->execute();
      // El SPU devuelve un SELECT con last_id
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return [
        'success' => true,
        'idpersona' => intval($row['last_id']),
        'message' => null
      ];
    } catch (PDOException $e) {
      error_log("Error en createPersona: " . $e->getMessage());
      return [
        'success' => false,
        'idpersona' => null,
        'message' => 'Error al insertar la persona en BD.'
      ];
    }
  }

}
