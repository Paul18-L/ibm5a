<?php
// Modelo Persona
class Persona {
    private $conn;
    private $table_name = "persona1"; // Cambiado según tu función read()

    // Propiedades de la tabla persona
    public $idpersona;
    public $nombres;
    public $apellidos;
    public $fechanacimiento;
    public $idsexo;
    public $idestadocivil;

    // Constructor para la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear una nueva persona
    public function create() {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombres, apellidos, fechanacimiento, idsexo, idestadocivil)
                      VALUES (:nombres, :apellidos, :fechanacimiento, :idsexo, :idestadocivil)";

            $stmt = $this->conn->prepare($query);

            // Asignar valores
            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":fechanacimiento", $this->fechanacimiento, PDO::PARAM_STR);
            $stmt->bindParam(":idsexo", $this->idsexo, PDO::PARAM_INT);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);

            $exito = $stmt->execute();

            if ($exito) {
                echo "Persona registrada correctamente.";
            } else {
                echo "Error al registrar persona.";
            }

            return $exito;
        } catch (PDOException $e) {
            echo "Error PDO: " . $e->getMessage();
            error_log("Error en create() para persona: " . $e->getMessage());
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
            error_log("Error en read() para persona: " . $e->getMessage());
            return [];
        }
    }

    // Leer una sola persona por ID
    public function readOne() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE idpersona = :idpersona LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en readOne() para persona: " . $e->getMessage());
            return null;
        }
    }

    // Actualizar una persona
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
            error_log("Error en update() para persona: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar una persona
    public function delete() {
        try {
            if (empty($this->idpersona)) {
                return false;
            }

            $query = "DELETE FROM " . $this->table_name . " WHERE idpersona = :idpersona";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en delete() para persona: " . $e->getMessage());
            return false;
        }
    }

    // Obtener todas las personas
    public function getAll() {
        try {
            $query = $this->conn->query("SELECT * FROM " . $this->table_name);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getAll(): " . $e->getMessage());
            return [];
        }
    }
}
?>
