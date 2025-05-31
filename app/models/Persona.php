<?php
class Persona {
    private $conn;
    private $table_name = "persona";

    public $idpersona;
    public $nombres;
    public $apellidos;
    public $fechanacimiento;
    public $idsexo;
    public $idestadocivil;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear nueva persona
    public function create() {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                      (nombres, apellidos, fechanacimiento, idsexo, idestadocivil)
                      VALUES (:nombres, :apellidos, :fechanacimiento, :idsexo, :idestadocivil)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":fechanacimiento", $this->fechanacimiento, PDO::PARAM_STR);
            $stmt->bindParam(":idsexo", $this->idsexo, PDO::PARAM_INT);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en create() Persona: " . $e->getMessage());
            return false;
        }
    }

    // Leer todas las personas con nombres legibles de sexo y estado civil
    public function read() {
        try {
            $query = "SELECT p.*, 
                             s.nombre AS elsexo, 
                             e.nombre AS elestadocivil 
                      FROM " . $this->table_name . " p
                      LEFT JOIN sexo s ON p.idsexo = s.idsexo
                      LEFT JOIN estadocivil e ON p.idestadocivil = e.idestadocivil";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en read() Persona: " . $e->getMessage());
            return [];
        }
    }

    // Leer una persona por id con nombres legibles de sexo y estado civil
    public function readOne() {
        try {
            $query = "SELECT p.*, 
                             s.nombre AS elsexo, 
                             e.nombre AS elestadocivil 
                      FROM " . $this->table_name . " p
                      LEFT JOIN sexo s ON p.idsexo = s.idsexo
                      LEFT JOIN estadocivil e ON p.idestadocivil = e.idestadocivil
                      WHERE p.idpersona = :idpersona
                      LIMIT 1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idpersona', $this->idpersona, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en readOne() Persona: " . $e->getMessage());
            return false;
        }
    }

    // Actualizar persona
    public function update() {
        try {
            $query = "UPDATE " . $this->table_name . " SET
                      nombres = :nombres,
                      apellidos = :apellidos,
                      fechanacimiento = :fechanacimiento,
                      idsexo = :idsexo,
                      idestadocivil = :idestadocivil
                      WHERE idpersona = :idpersona";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":fechanacimiento", $this->fechanacimiento, PDO::PARAM_STR);
            $stmt->bindParam(":idsexo", $this->idsexo, PDO::PARAM_INT);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en update() Persona: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar persona
    public function delete() {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE idpersona = :idpersona";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idpersona', $this->idpersona, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en delete() Persona: " . $e->getMessage());
            return false;
        }
    }
}
