<?php
class EstadoCivil {
    private PDO $conn;  // especifica tipo PDO
    private string $table_name = "estadocivil";

    public ?int $idestadocivil = null;
    public ?string $nombre = null;

    public function __construct($db) {
        if (!$db instanceof PDO) {
            throw new InvalidArgumentException("La conexión debe ser un objeto PDO.");
        }
        $this->conn = $db;
    }

    // Crear un nuevo estado civil
    public function create(): bool {
        try {
            $query = "INSERT INTO {$this->table_name} (nombre) VALUES (:nombre)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en create(): " . $e->getMessage());
            return false;
        }
    }

    // Leer todos los estados civiles
    public function read(): array {
        try {
            $query = "SELECT * FROM {$this->table_name} ORDER BY idestadocivil ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en read(): " . $e->getMessage());
            return [];
        }
    }

    // Leer un solo estado civil por ID
    public function readOne(): ?array {
        try {
            $query = "SELECT * FROM {$this->table_name} WHERE idestadocivil = :idestadocivil LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log("Error en readOne(): " . $e->getMessage());
            return null;
        }
    }

    // Actualizar un estado civil
    public function update(): bool {
        try {
            $query = "UPDATE {$this->table_name} SET nombre = :nombre WHERE idestadocivil = :idestadocivil";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en update(): " . $e->getMessage());
            return false;
        }
    }

    // Eliminar un estado civil
    public function delete(): bool {
        try {
            if (empty($this->idestadocivil) || !is_numeric($this->idestadocivil)) {
                error_log("ID inválido en delete()");
                return false;
            }

            $query = "DELETE FROM {$this->table_name} WHERE idestadocivil = :idestadocivil";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":idestadocivil", $this->idestadocivil, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en delete(): " . $e->getMessage());
            return false;
        }
    }
}
?>
