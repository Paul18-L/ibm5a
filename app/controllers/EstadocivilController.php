<?php
class EstadocivilController {
    private $estadocivil;

    public function __construct() {
        require_once '../app/config/database.php'; // Incluye tu clase de conexión
        require_once '../app/models/Estadocivil.php';

        $database = new Database(); // Crear objeto de conexión
        $db = $database->getConnection(); // Obtener conexión PDO

        $this->estadocivil = new Estadocivil($db); // Pasar la conexión al modelo
    }

    public function index() {
        $datos = $this->estadocivil->read();
        require_once '../app/views/estadocivil/index.php';
    }

    public function create() {
        require_once '../app/views/estadocivil/create.php';
    }

    public function edit($idestadocivil) {
        $this->estadocivil->idestadocivil = $idestadocivil;
        $estadocivil = $this->estadocivil->readOne();

        if (!$estadocivil) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/estadocivil/edit.php';
    }

    public function eliminar($idestadocivil) {
        $this->estadocivil->idestadocivil = $idestadocivil;
        $estadocivil = $this->estadocivil->readOne();

        if (!$estadocivil) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/estadocivil/delete.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['idestadocivil']) && !empty($_POST['nombre'])) {
                $this->estadocivil->idestadocivil = $_POST['idestadocivil'];
                $this->estadocivil->nombre = $_POST['nombre'];

                if ($this->estadocivil->update()) {
                    header('Location: /ibm5a/public/estadocivil/index?msg=updated');
                    exit;
                } else {
                    die("Error al actualizar el estado civil.");
                }
            } else {
                die("Faltan datos para actualizar.");
            }
        } else {
            die("Método incorrecto");
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['idestadocivil'])) {
                $this->estadocivil->idestadocivil = $_POST['idestadocivil'];

                if ($this->estadocivil->delete()) {
                    header('Location: /ibm5a/public/estadocivil/index?msg=deleted');
                    exit;
                } else {
                    die("Error al eliminar el estado civil.");
                }
            } else {
                die("Faltan datos para eliminar.");
            }
        } else {
            die("Método incorrecto");
        }
    }
}
?>
