<?php
require_once __DIR__ . '/../models/Telefono.php';
require_once __DIR__ . '/../config/database.php';

class TelefonoController {
    private $db;
    private $telefonoModel;

    public function __construct() {
        $this->db = Database::connect();
        $this->telefonoModel = new Telefono($this->db);
    }

    // Mostrar todos los teléfonos
    public function index() {
        $telefonos = $this->telefonoModel->read();
        require_once __DIR__ . '/../views/telefono/index.php';
    }

    // Mostrar formulario de creación
    public function create() {
        require_once __DIR__ . '/../views/telefono/create.php';
    }

    // Guardar un nuevo teléfono
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->telefonoModel->idpersona = $_POST['idpersona'];
            $this->telefonoModel->numero = $_POST['numero'];
            $this->telefonoModel->create();
        }
        header("Location: /ibm5a/public/telefono/index");
        exit;
    }

    // Mostrar formulario de edición
    public function edit() {
        if (isset($_GET['idtelefono'])) {
            $this->telefonoModel->idtelefono = $_GET['idtelefono'];
            $telefono = $this->telefonoModel->readOne();
            require_once __DIR__ . '/../views/telefono/edit.php';
        }
    }

    // Actualizar un teléfono
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->telefonoModel->idtelefono = $_POST['idtelefono'];
            $this->telefonoModel->idpersona = $_POST['idpersona'];
            $this->telefonoModel->numero = $_POST['numero'];
            $this->telefonoModel->update();
        }
        header("Location: /ibm5a/public/telefono/index");
        exit;
    }

    // Eliminar un teléfono
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->telefonoModel->idtelefono = $_POST['idtelefono'];
            $this->telefonoModel->delete();
        }
        header("Location: /ibm5a/public/telefono/index");
        exit;
    }
}
