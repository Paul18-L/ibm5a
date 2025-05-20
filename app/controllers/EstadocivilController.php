<?php
require_once '../app/models/Estadocivil.php';

class EstadocivilController {
    private $estadocivil;

    public function __construct() {
        $this->estadocivil = new Estadocivil();
    }

    public function index() {
        $estadociviles = $this->estadocivil->readAll();
        require '../app/views/estadocivil/index.php';
    }

    public function edit($idestadocivil) {
        $this->estadocivil->idestadocivil = $idestadocivil;
        $estadocivil = $this->estadocivil->readOne();

        if (!$estadocivil) {
            echo "Error: No se encontró el estado civil.";
            return;
        }

        require '../app/views/estadocivil/edit.php';
    }

    public function eliminar($idestadocivil) {
        $this->estadocivil->idestadocivil = $idestadocivil;
        $estadocivil = $this->estadocivil->readOne();

        if (!$estadocivil) {
            echo "Error: No se encontró el estado civil.";
            return;
        }

        require '../app/views/estadocivil/delete.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->estadocivil->idestadocivil = $_POST['idestadocivil'] ?? null;
            $this->estadocivil->nombre = $_POST['nombre'] ?? null;

            if ($this->estadocivil->update()) {
                header('Location: /ibm5a/public/estadocivil/index?msg=updated');
                exit;
            } else {
                echo "Error al actualizar el estado civil.";
            }
        } else {
            echo "Método no permitido.";
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->estadocivil->idestadocivil = $_POST['id'] ?? null;

            if ($this->estadocivil->delete()) {
                header('Location: /ibm5a/public/estadocivil/index?msg=deleted');
                exit;
            } else {
                echo "Error al eliminar el estado civil.";
            }
        } else {
            echo "Método no permitido.";
        }
    }
}

// Manejo de acciones desde la URL
if (isset($_GET['action'])) {
    $controller = new EstadocivilController();

    switch ($_GET['action']) {
        case 'index':
            $controller->index();
            break;
        case 'edit':
            if (isset($_GET['idestadocivil'])) {
                $controller->edit($_GET['idestadocivil']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'eliminar':
            if (isset($_GET['idestadocivil'])) {
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
    }
}
?>
