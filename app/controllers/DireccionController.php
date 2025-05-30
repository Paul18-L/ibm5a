<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Direccion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Persona.php';

class DireccionController {
    private $direccion;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->direccion = new Direccion($this->db);
        $this->persona = new Persona($this->db);
    }

    // Mostrar todas las direcciones
    public function index() {
        $direccions = $this->direccion->read();
        require_once '../app/views/direccion/index.php';
    }

    // Formulario de creación
    public function createForm() {
        $personas = $this->persona->read();
        require_once '../app/views/direccion/create.php';
    }

    // Guardar nueva dirección
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['descripcion']) && isset($_POST['idpersona'])) {
                $this->direccion->idpersona = $_POST['idpersona'];
                $this->direccion->descripcion = $_POST['descripcion'];
                if ($this->direccion->create()) {
                    echo "Dirección creada exitosamente";
                } else {
                    echo "Error al crear la dirección";
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

    // Formulario de edición
    public function edit($iddireccion) {
        $this->direccion->iddireccion = $iddireccion;
        $direccion = $this->direccion->readOne();
        $personas = $this->persona->read();

        if (!$direccion) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/direccion/edit.php';
    }

    // Formulario de confirmación para eliminar
    public function eliminar($id) {
        $this->direccion->iddireccion = $id;
        $direccion = $this->direccion->readOne();

        if (!$direccion) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/direccion/delete.php';
    }

    // Actualizar dirección
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['descripcion']) && isset($_POST['idpersona']) && isset($_POST['iddireccion'])) {
                $this->direccion->idpersona = $_POST['idpersona'];
                $this->direccion->descripcion = $_POST['descripcion'];
                $this->direccion->iddireccion = $_POST['iddireccion'];
                if ($this->direccion->update()) {
                    echo "Dirección actualizada exitosamente";
                } else {
                    echo "Error al actualizar la dirección";
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

    // Eliminar dirección
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                $this->direccion->iddireccion = $_POST['id'];
                if ($this->direccion->delete()) {
                    echo "Dirección borrada exitosamente";
                    exit;
                } else {
                    echo "Error al eliminar la dirección";
                    exit;
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

    // API para obtener todas las direcciones
    public function api() {
        while (ob_get_level()) {
            ob_end_clean();
        }

        $direcciones = $this->direccion->read();
        header('Content-Type: application/json');
        echo json_encode($direcciones);
        exit;
    }
}

// Manejo de la acción desde la URL
if (isset($_GET['action'])) {
    $controller = new DireccionController();

    switch ($_GET['action']) {
        case 'createForm':
            $controller->createForm();
            break;
        case 'create':
            $controller->create();
            break;
        case 'edit':
            if (isset($_GET['id'])) {
                $controller->edit($_GET['id']);
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controller->eliminar($_GET['id']);
            }
            break;
        case 'update':
            $controller->update();
            break;
        case 'delete':
            $controller->delete();
            break;
        case 'api':
            $controller->api();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
    // Mostrar index por defecto si no se especifica acción
    $controller = new DireccionController();
    $controller->index();
}
?>
