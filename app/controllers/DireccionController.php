<?php
// DireccionController.php
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
            $nombre = $_POST['nombre'] ?? null;

            if (!empty($nombre)) {
                $this->direccion->nombre = htmlspecialchars($nombre);

                if ($this->direccion->create()) {
                    header('Location: index.php?msg=created');
                    exit;
                }

                $error = "Error al crear la dirección.";
            } else {
                $error = "Falta el nombre de la dirección.";
            }

            require_once '../app/views/direccion/create.php';
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
            $iddireccion = $_POST['iddireccion'] ?? null;
            $nombre = $_POST['nombre'] ?? null;

            if (!empty($iddireccion) && !empty($nombre)) {
                $this->direccion->iddireccion = htmlspecialchars($iddireccion);
                $this->direccion->nombre = htmlspecialchars($nombre);

                if ($this->direccion->update()) {
                    header('Location: index.php?msg=updated');
                    exit;
                }

                $error = "Error al actualizar la dirección.";
            } else {
                $error = "Faltan datos en el formulario.";
            }

            $this->editForm($iddireccion);
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
            $iddireccion = $_POST['iddireccion'] ?? null;

            if (!empty($iddireccion)) {
                $this->direccion->iddireccion = htmlspecialchars($iddireccion);

                if ($this->direccion->delete()) {
                    header('Location: index.php?msg=deleted');
                    exit;
                } else {
                    header('Location: index.php?msg=error_delete');
                    exit;
                }
            }

            header('Location: index.php?msg=no_id_delete');
            exit;
        }

        header('Location: index.php');
        exit;
    }
}

// Enrutamiento
if (isset($_GET['action'])) {
    $controller = new DireccionController();
    $action = $_GET['action'];
    $id = $_GET['id'] ?? null;

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
            if ($id) {
                $controller->editForm($id);
            } else {
                echo "Error: ID no especificado para editar.";
            }
            break;
        case 'update':
            $controller->update();
            break;
        case 'deleteForm':
            if ($id) {
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
