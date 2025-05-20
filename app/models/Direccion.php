<?php
// Modelo Direccion
// Programador: Lopez Paul

class Direccion {
    private $conn;
    private $table_name = "direccion";

    // Propiedades del modelo
    public $iddireccion;
    public $idpersona;
    public $nombre;

    // Constructor con inyección de conexión
    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear una nueva dirección
    public function create() {
        try {
            $query = "INSERT INTO $this->table_name (idpersona, nombre)
                      VALUES (:idpersona, :nombre)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en create(): " . $e->getMessage());
            return false;
        }
    }

    // Leer todas las direcciones
    public function read() {
        try {
            $query = "SELECT * FROM $this->table_name";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en read(): " . $e->getMessage());
            return [];
        }
    }

    // Leer una dirección por su ID
    public function readOne() {
        try {
            $query = "SELECT * FROM $this->table_name WHERE iddireccion = :iddireccion LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":iddireccion", $this->iddireccion, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en readOne(): " . $e->getMessage());
            return null;
        }
    }

    // Actualizar una dirección existente
    public function update() {
        try {
            $query = "UPDATE $this->table_name SET
                        idpersona = :idpersona,
                        nombre = :nombre
                      WHERE iddireccion = :iddireccion";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $this->idpersona, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(":iddireccion", $this->iddireccion, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en update(): " . $e->getMessage());
            return false;
        }
    }

    // Eliminar una dirección
    public function delete() {
        try {
            if (empty($this->iddireccion)) {
                return false;
            }

            $query = "DELETE FROM $this->table_name WHERE iddireccion = :iddireccion";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":iddireccion", $this->iddireccion, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en delete(): " . $e->getMessage());
            return false;
        }
    }

    // Leer todas las direcciones de una persona específica
    public function readByPersona($idpersona) {
        try {
            $query = "SELECT * FROM $this->table_name WHERE idpersona = :idpersona";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en readByPersona(): " . $e->getMessage());
            return [];
        }
    }
}
?>
