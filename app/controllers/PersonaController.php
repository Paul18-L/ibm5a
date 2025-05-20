<?php
// PersonaController.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Persona.php';

class PersonaController {
    private $persona;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->persona = new Persona($db);
    }

    public function index() {
        $personas = $this->persona->read();
        require_once __DIR__ . '/../views/persona/index.php';
    }

    public function createForm() {
        require_once __DIR__ . '/../views/persona/create.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = ['nombres', 'apellidos', 'fechanacimiento', 'idsexo', 'idestadocivil'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    $error = "Faltan datos en el formulario.";
                    require_once __DIR__ . '/../views/persona/create.php';
                    return;
                }
            }

            $this->persona->nombres = $_POST['nombres'];
            $this->persona->apellidos = $_POST['apellidos'];
            $this->persona->fechanacimiento = $_POST['fechanacimiento'];
            $this->persona->idsexo = $_POST['idsexo'];
            $this->persona->idestadocivil = $_POST['idestadocivil'];

            if ($this->persona->create()) {
                header('Location: index.php?msg=created');
                exit;
            } else {
                $error = "Error al crear la persona.";
                require_once __DIR__ . '/../views/persona/create.php';
            }
        } else {
            header('Location: index.php');
            exit;
        }
    }

    public function editForm($idpersona) {
        $this->persona->idpersona = $idpersona;
        $persona = $this->persona->readOne();

        if (!$persona) {
            die("Error: No se encontró la persona.");
        }

        require_once __DIR__ . '/../views/persona/edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = ['idpersona', 'nombres', 'apellidos', 'fechanacimiento', 'idsexo', 'idestadocivil'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    $error = "Faltan datos en el formulario.";
                    $this->editForm($_POST['idpersona']);
                    return;
                }
            }

            $this->persona->idpersona = $_POST['idpersona'];
            $this->persona->nombres = $_POST['nombres'];
            $this->persona->apellidos = $_POST['apellidos'];
            $this->persona->fechanacimiento = $_POST['fechanacimiento'];
            $this->persona->idsexo = $_POST['idsexo'];
            $this->persona->idestadocivil = $_POST['idestadocivil'];

            if ($this->persona->update()) {
                header('Location: index.php?msg=updated');
                exit;
            } else {
                $error = "Error al actualizar la persona.";
                $this->editForm($_POST['idpersona']);
            }
        } else {
            header('Location: index.php');
            exit;
        }
    }

    public function deleteForm($idpersona) {
        $this->persona->idpersona = $idpersona;
        $persona = $this->persona->readOne();

        if (!$persona) {
            die("Error: No se encontró la persona.");
        }

        require_once __DIR__ . '/../views/persona/delete.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idpersona'])) {
            $this->persona->idpersona = $_POST['idpersona'];
            if ($this->persona->delete()) {
                header('Location: index.php?msg=deleted');
            } else {
                header('Location: index.php?msg=error_delete');
            }
        } else {
            header('Location: index.php?msg=no_id_delete');
        }
        exit;
    }
}

// Ruteador simple
if (isset($_GET['action'])) {
    $controller = new PersonaController();
    $action = $_GET['action'];
    $id = $_GET['id'] ?? $_POST['idpersona'] ?? null;

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
            $id ? $controller->editForm($id) : die("ID no especificado.");
            break;
        case 'update':
            $controller->update();
            break;
        case 'deleteForm':
            $id ? $controller->deleteForm($id) : die("ID no especificado.");
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
    // Si no se define ninguna acción, puedes redirigir o mostrar un mensaje
    header('Location: index.php?action=index');
    exit;
}
?>
