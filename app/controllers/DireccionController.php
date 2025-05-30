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
        $this->persona = new Persona($this->db); // <<--- ¡IMPORTANTE!
    }

    public function index() {
        $direcciones = $this->direccion->read();
        require_once '../app/views/direccion/index.php';
    }

    public function createForm() {
        $personas = $this->persona->read();
        require_once '../app/views/direccion/create.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['detalle']) && isset($_POST['idpersona'])) {
                $this->direccion->detalle = $_POST['detalle'];
                $this->direccion->idpersona = $_POST['idpersona']; // <<--- ¡CLAVE!

                if ($this->direccion->create()) {
                    header('Location: index.php?msg=created');
                    exit;
                } else {
                    echo "Error al crear la dirección";
                }
            } else {
                echo "Faltan datos";
            }
        } else {
            echo "Método incorrecto";
        }
    }

    // ...otros métodos (edit, eliminar, update, delete) permanecen igual...
}

// Controlador directo desde la URL
if (isset($_GET['action'])) {
    $controller = new DireccionController();

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
}
