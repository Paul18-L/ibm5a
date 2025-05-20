<?php

require_once '../app/models/Estadocivil.php';

class EstadocivilController {
    private $estadocivil;

    public function __construct() {
        $this->estadocivil = new Estadocivil(Database::getConnection()); // Ajusta la forma en que obtienes $db
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
                    header('Location: index.php?msg=updated');
                    exit;
                } else {
                    die("Error al actualizar el estado civil.");
                }
            } else {
                die("Faltan datos para actualizar.");
            }
        } else {
            die("Método incorrecto.");
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['idestadocivil'])) {
                $this->estadocivil->idestadocivil = $_POST['idestadocivil'];

                if ($this->estadocivil->delete()) {
                    header('Location: index.php?msg=deleted');
                    exit;
                } else {
                    die("Error al eliminar el estado civil.");
                }
            } else {
                die("Faltan datos para eliminar.");
            }
        } else {
            die("Método incorrecto.");
        }
    }
}

// Manejo de acción en la URL
if (isset($_GET['action'])) {
    $controller = new EstadocivilController();

    switch ($_GET['action']) {
        case 'index':
            $controller->index();
            break;
        case 'create':
            $controller->create();
            break;
        case 'eliminar':
            if (!empty($_GET['idestadocivil'])) {
                $controller->eliminar($_GET['idestadocivil']);
            } else {
                echo "Error: Falta el ID para eliminar.";
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
    // Mostrar la lista por defecto
    $controller = new EstadocivilController();
    $controller->index();
}
?>
