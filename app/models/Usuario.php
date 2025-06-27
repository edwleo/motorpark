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
      IFNULL(
        DATE_FORMAT(cl.fechafin, '%Y-%m-%d'),
        'Indeterminado'
      )               AS fecha_fin,
      col.idcolaborador AS idcolaborador,
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
   * Buscar por DNI
   */
  public function getPersonaByDNI(string $nrodoc): array
  {
    $sql = "SELECT idpersona, apellidos, nombres 
            FROM personas 
            WHERE nrodoc = :nrodoc
            LIMIT 1";
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':nrodoc', $nrodoc, PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row ?: [];
    } catch (PDOException $e) {
      error_log("Error en getPersonaByDNI: " . $e->getMessage());
      return [];
    }
  }

  /**
   * Devuelve el usernick (usuario) de un colaborador dado su idcolaborador.
   */
  public function getUsernickById(int $idColaborador): array
  {
    $sql = "SELECT usernick 
            FROM colaboradores 
            WHERE idcolaborador = :id
            LIMIT 1";
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':id', $idColaborador, PDO::PARAM_INT);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row ?: [];
    } catch (PDOException $e) {
      error_log("Error en getUsernickById: " . $e->getMessage());
      return [];
    }
  }

  /**
   * Actualiza la contraseña de un colaborador.
   */
  public function updatePassword(int $idColaborador, string $newPassword): array
  {
    try {
      $hash = password_hash($newPassword, PASSWORD_DEFAULT);
      $sql = "UPDATE colaboradores
                SET userpassword = :hash
                WHERE idcolaborador = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':hash', $hash, PDO::PARAM_STR);
      $stmt->bindValue(':id',   $idColaborador, PDO::PARAM_INT);
      $stmt->execute();
      return ['success' => true];
    } catch (PDOException $e) {
      error_log("Error en updatePassword: " . $e->getMessage());
      return ['success' => false, 'message' => 'No se pudo actualizar la contraseña.'];
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

  /**
   * Crea una nueva persona usando el SPU y devuelve el nuevo ID.
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

  public function searchPersonas() {}

  /**
   * FUNCIONES PARA REGISTRAR USUARIOS 
   */

  public function registerContractAndUser(int $idPersona, array $data): array
  {
    try {
      $this->pdo->beginTransaction();

      // 1) Contrato
      $idContrato = $this->createContratoLaboral(
        $idPersona,
        intval($data['cargo']),
        $data['fecha_inicio'],
        $data['fecha_fin'],
        $data['tipo_contrato']
      );

      // 2) Validar y crear colaborador
      if ($data['password1'] !== $data['password2']) {
        throw new Exception('Las contraseñas no coinciden');
      }
      $hash = password_hash($data['password1'], PASSWORD_DEFAULT);
      $this->createColaborador($idContrato, $data['usuario'], $hash);

      $this->pdo->commit();
      return ['success' => true];
    } catch (Exception $e) {
      $this->pdo->rollBack();
      return ['success' => false, 'message' => $e->getMessage()];
    }
  }

  public function createContratoLaboral(int $idPersona, int $idCargo, string $fechaInicio, ?string $fechaFin, string $tipoContrato = 'P'): int
  {
    $sql = "INSERT INTO contratoslaborales (idpersona, idcargo, fechainicio, fechafin, tipocontrato, creado)
            VALUES (:idpersona, :idcargo, :fechainicio, :fechafin, :tipocontrato, NOW())";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':idpersona', $idPersona, PDO::PARAM_INT);
    $stmt->bindValue(':idcargo',   $idCargo,   PDO::PARAM_INT);
    $stmt->bindValue(':fechainicio', $fechaInicio);
    // si $fechaFin es null, se insertará NULL
    $stmt->bindValue(':fechafin',   $fechaFin, $fechaFin ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmt->bindValue(':tipocontrato', $tipoContrato);
    $stmt->execute();
    return intval($this->pdo->lastInsertId());
  }

  public function createColaborador(int $idContrato, string $usernick, string $passwordHash): int
  {
    $sql = "INSERT INTO colaboradores (idcontratolaboral, usernick, userpassword, creado)
            VALUES (:idcontrato, :usernick, :userpassword, NOW())";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':idcontrato',   $idContrato,   PDO::PARAM_INT);
    $stmt->bindValue(':usernick',     $usernick,     PDO::PARAM_STR);
    $stmt->bindValue(':userpassword', $passwordHash, PDO::PARAM_STR);
    $stmt->execute();
    return intval($this->pdo->lastInsertId());
  }

  /**
   * Registro completo: persona - contrato - colaborador
   */
  public function registerFull(array $data): array
  {
    try {
      $this->pdo->beginTransaction();

      // 1) Persona
      $respPersona = $this->createPersona($data);
      if (!$respPersona['success']) {
        throw new Exception('Error al crear persona');
      }
      $idPersona = $respPersona['idpersona'];

      // 2) Contrato laboral
      $fechaFin = !empty($data['sin_fecha_fin']) ? null : $data['fecha_fin'];
      $idContrato = $this->createContratoLaboral(
        $idPersona,
        intval($data['cargo']),
        $data['fecha_inicio'],
        $fechaFin,
        $data['tipo_contrato'] ?? 'P'
      );

      // 3) Colaborador (hashear la contraseña antes)
      if ($data['password1'] !== $data['password2']) {
        throw new Exception('Las contraseñas no coinciden');
      }
      $hash = password_hash($data['password1'], PASSWORD_DEFAULT);
      $this->createColaborador($idContrato, $data['usuario'], $hash);

      $this->pdo->commit();
      return ['success' => true];
    } catch (Exception $e) {
      $this->pdo->rollBack();
      error_log("registerFull failed: " . $e->getMessage());
      return ['success' => false, 'message' => $e->getMessage()];
    }
  }
}
