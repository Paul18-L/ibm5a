<?php
// En DireccionController.php
// Programador: Carlos Andrés Martínez Casanova

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Direccion.php';

class DireccionController {
    private $direccion;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->direccion = new Direccion($this->db);
    }

    public function index() {
        $direcciones = $this->direccion->read();
        require_once '../app/views/direccion/index.php';
    }

    public function createForm() {
        require_once '../app/views/direccion/create.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['nombre'])) {
                $this->direccion->nombre = $_POST['nombre'];

                if ($this->direccion->create()) {
                    header('Location: index.php?msg=created');
                } else {
                    $error = "Error al crear la dirección.";
                    require_once '../app/views/direccion/create.php';
                }
            } else {
                $error = "Faltan datos en el formulario.";
                require_once '../app/views/direccion/create.php';
            }
            exit;
        }

        header('Location: index.php');
        exit;
    }

    public function editForm($iddireccion) {
        $this->direccion->iddireccion = $iddireccion;
        $direccion = $this->direccion->readOne();

        if (!$direccion) {
            die("Error: No se encontró la dirección.");
        }

        require_once '../app/views/direccion/edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['iddireccion']) && !empty($_POST['nombre'])) {
                $this->direccion->iddireccion = $_POST['iddireccion'];
                $this->direccion->nombre = $_POST['nombre'];

                if ($this->direccion->update()) {
                    header('Location: index.php?msg=updated');
                } else {
                    $error = "Error al actualizar la dirección.";
                    $this->editForm($_POST['iddireccion']);
                }
            } else {
                $error = "Faltan datos en el formulario de actualización.";
                $this->editForm($_POST['iddireccion']);
            }
            exit;
        }

        header('Location: index.php');
        exit;
    }

    public function deleteForm($iddireccion) {
        $this->direccion->iddireccion = $iddireccion;
        $direccion = $this->direccion->readOne();

        if (!$direccion) {
            die("Error: No se encontró la dirección.");
        }

        require_once '../app/views/direccion/delete.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['iddireccion'])) {
                $this->direccion->iddireccion = $_POST['iddireccion'];
                if ($this->direccion->delete()) {
                    header('Location: index.php?msg=deleted');
                } else {
                    header('Location: index.php?msg=error_delete');
                }
            } else {
                header('Location: index.php?msg=no_id_delete');
            }
            exit;
        }

        header('Location: index.php');
        exit;
    }
}

// Enrutamiento por acción
if (isset($_GET['action'])) {
    $controller = new DireccionController();
    $action = $_GET['action'];
    $id = $_GET['id'] ?? $_POST['iddireccion'] ?? null;

    switch ($action) {
        case 'index':
            $controller->index();
            break;
        case 'createForm':
            $controller->createForm();
            break;
        case 'create':
            $controller->create();
            break;
        case 'editForm':
            if ($id !== null) {
                $controller->editForm($id);
            } else {
                echo "Error: ID no especificado para editar.";
            }
            break;
        case 'update':
            $controller->update();
            break;
        case 'deleteForm':
            if ($id !== null) {
                $controller->deleteForm($id);
            } else {
                echo "Error: ID no especificado para eliminar.";
            }
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
}
?>
