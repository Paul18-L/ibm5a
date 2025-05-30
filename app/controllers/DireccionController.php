<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Direccion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Persona.php';

class DireccionController {
    private $direccion;
    private $persona;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->direccion = new Direccion($this->db);
        $this->persona = new Persona($this->db);
    }

    // Mostrar todas las direcciones
    public function index() {
        $direcciones = $this->direccion->read();
        require_once '../app/views/direccion/index.php';
    }

    // Mostrar formulario de creación
    public function createForm() {
        $personas = $this->persona->read();
        require_once '../app/views/direccion/create.php';
    }

    // Crear nueva dirección
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['detalle']) && isset($_POST['idpersona'])) {
                $this->direccion->detalle = $_POST['detalle'];
                $this->direccion->idpersona = $_POST['idpersona'];
                if ($this->direccion->create()) {
                    echo "Dirección creada exitosamente";
                } else {
                    echo "Error al crear la dirección";
                }
            } else {
                echo "Faltan datos (detalle o idpersona)";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }

    // Formulario de edición
    public function edit($id) {
        $this->direccion->id = $id;
        $direccion = $this->direccion->readOne();
        $personas = $this->persona->read();

        if (!$direccion) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/direccion/edit.php';
    }

    // Formulario para confirmar eliminación
    public function eliminar($id) {
        $this->direccion->id = $id;
        $direccion = $this->direccion->readOne();

        if (!$direccion) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/direccion/delete.php';
    }

    // Actualizar dirección
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['detalle']) && isset($_POST['id']) && isset($_POST['idpersona'])) {
                $this->direccion->id = $_POST['id'];
                $this->direccion->detalle = $_POST['detalle'];
                $this->direccion->idpersona = $_POST['idpersona'];
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
                $this->direccion->id = $_POST['id'];
                if ($this->direccion->delete()) {
                    echo "Dirección borrada exitosamente";
                    exit;
                } else {
                    echo "Error al eliminar la dirección";
                }
            } else {
                echo "Falta el ID para eliminar";
            }
        } else {
            echo "Método incorrecto";
        }
        die();
    }
}

// Manejo de la acción
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
            } else {
                echo "Falta el parámetro ID para editar.";
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controller->eliminar($_GET['id']);
            } else {
                echo "Falta el parámetro ID para eliminar.";
            }
            break;
        case 'update':
            $controller->update();
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
    $controller = new DireccionController();
    $controller->index();
}
?>
