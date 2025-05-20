<?php
// Modelo Persona
class Persona {
    private $conn;
    private $table_name = "persona";

    // Propiedades de la tabla persona
    public $idpersona;
    public $nombres;
    public $apellidos;
    public $fechanacimiento;
    public $idsexo;
    public $idestadocivil;

    // Constructor con conexión a base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método privado para enlazar parámetros comunes
    private function bindCommonParams($stmt) {
        $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
        $stmt->bindParam(":fechanacimiento", $this->fechanacimiento, PDO::PARAM_STR);
        $stmt->bindParam(":idsexo", $this->idsexo, PDO::PARAM_INT);
        $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);
    }

    // Crear una nueva persona
    public function create() {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                      (nombres, apellidos, fechanacimiento, idsexo, idestadocivil)
                      VALUES (:nombres, :apellidos, :fechanacimiento, :idsexo, :idestadocivil)";
            
            $stmt = $this->conn->prepare($query);
            $this->bindCommonParams($stmt);
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en create(): " . $e->getMessage());
            return false;
        }
    }

    // Leer todas las personas
    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en read(): " . $e->getMessage());
            return [];
        }
    }

    // Leer una sola persona por su ID
    public function readOne() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " 
                      WHERE idpersona = :idpersona LIMIT 1";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;

        } catch (PDOException $e) {
            error_log("Error en readOne(): " . $e->getMessage());
            return null;
        }
    }

    // Actualizar datos de una persona
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
            $this->bindCommonParams($stmt);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en update(): " . $e->getMessage());
            return false;
        }
    }

    // Eliminar una persona
    public function delete() {
        try {
            if (empty($this->idpersona)) {
                return false;
            }

            $query = "DELETE FROM " . $this->table_name . " 
                      WHERE idpersona = :idpersona";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en delete(): " . $e->getMessage());
            return false;
        }
    }
}
?>
