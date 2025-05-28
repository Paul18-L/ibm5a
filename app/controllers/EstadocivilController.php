<?php
// Mostrar errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Requiere archivos necesarios
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Estadocivil.php';

class estadocivilController {
    private $estadocivil;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->estadocivil = new estadocivil($this->db);
    }

    public function index() {
        $estadosciviles = $this->estadocivil->read();
        require_once '../app/views/estadocivil/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['nombre'])) {
                $this->estadocivil->nombre = trim($_POST['nombre']);
                if ($this->estadocivil->create()) {
                    header('Location: estadocivilController.php?action=index&msg=created');
                    exit;
                } else {
                    echo "❌ Error al crear el estado civil.";
                }
            } else {
                echo "⚠️ El campo 'nombre' es obligatorio.";
            }
        } else {
            require_once '../app/views/estadocivil/create.php';
        }
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
            if (!empty($_POST['nombre']) && !empty($_POST['idestadocivil'])) {
                $this->estadocivil->nombre = trim($_POST['nombre']);
                $this->estadocivil->idestadocivil = intval($_POST['idestadocivil']);

                if ($this->estadocivil->update()) {
                    header('Location: estadocivilController.php?action=index&msg=updated');
                    exit;
                } else {
                    echo "❌ Error al actualizar.";
                }
            } else {
                echo "⚠️ Faltan datos.";
            }
        } else {
            echo "❌ Método no permitido.";
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['idestadocivil'])) {
                $this->estadocivil->idestadocivil = intval($_POST['idestadocivil']);

                if ($this->estadocivil->delete()) {
                    header('Location: estadocivilController.php?action=index&msg=deleted');
                    exit;
                } else {
                    echo "❌ Error al eliminar.";
                }
            } else {
                echo "⚠️ Falta el ID.";
            }
        } else {
            echo "❌ Método no permitido.";
        }
    }
}

// Enrutador simple
if (isset($_GET['action'])) {
    $controller = new estadocivilController();

    switch ($_GET['action']) {
        case 'index':
            $controller->index();
            break;
        case 'create':
            $controller->create();
            break;
        case 'eliminar':
            if (isset($_GET['idestadocivil'])) {
                $controller->eliminar($_GET['idestadocivil']);
            } else {
                echo "❌ Falta el ID para eliminar.";
            }
            break;
        case 'update':
            $controller->update();
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            echo "❌ Acción no válida.";
            break;
    }
} else {
    header("Location: estadocivilController.php?action=index");
    exit;
}
?>
