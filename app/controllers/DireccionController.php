<!DOCTYPE html>
<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

// En DireccionController.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Direccion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Persona.php';
class DireccionController {
    private $direccion;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->direccion = new Direccion($this->db);
    }

    // Mostrar todas las direcciones
    public function index() {
        $direcciones = $this->direccion->read();
        require_once '../app/views/direccion/index.php';
    }
    public function create() {


        $personas = $this->persona->read();
        require_once '../app/views/direccion/create.php';
    }
    

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['detalle'])) {
                $this->direccion->detalle = $_POST['detalle'];
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

    public function edit($id) {
        $this->direccion->id = $id;
        $direccion = $this->direccion->readOne();

        if (!$direccion) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/direccion/edit.php';
    }

    public function eliminar($id) {
        $this->direccion->id = $id;
        $direccion = $this->direccion->readOne();

        if (!$direccion) {
            die("Error: No se encontró el registro.");
        }

        require_once '../app/views/direccion/delete.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Formulario recibido";
            if (isset($_POST['detalle'])) {
                $this->direccion->detalle = $_POST['detalle'];
                $this->direccion->id = $_POST['id'];
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

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                $this->direccion->id = $_POST['id'];
                if ($this->direccion->delete()) {
                    echo "Dirección borrada exitosamente";
                    die();
                    header('Location: index.php?msg=deleted');
                    exit;
                } else {
                    header('Location: index.php?msg=error');
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
}

// Manejo de la acción en la URL
if (isset($_GET['action'])) {
    $controller = new DireccionController();

    echo "hola";
    switch ($_GET['action']) {
        case 'create':
            $controller->create();
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
    // echo "No se especificó ninguna acción.";
}
?>
