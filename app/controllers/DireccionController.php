<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Direccion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/models/Persona.php';

class DireccionController
{
    private Direccion $direccion;
    private Persona   $persona;

    public function __construct()
    {
        $db              = (new Database())->getConnection();
        $this->direccion = new Direccion($db);
        $this->persona   = new Persona($db);
    }

    /* ========== CRUD ========== */

    /** Listar */
    public function index(): void
    {
        $direcciones = $this->direccion->all();
        require $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/views/direccion/index.php';
    }

    /** Mostrar formulario de alta */
    public function createForm(): void
    {
        $personas = $this->persona->read();   // o all()
        require $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/views/direccion/create.php';
    }

    /** Guardar nueva dirección */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método no permitido');
        }

        $idPersona = trim($_POST['idpersona'] ?? '');
        $nombre    = trim($_POST['nombre']    ?? '');

        if ($idPersona === '' || $nombre === '') {
            exit('Faltan datos');
        }

        $ok = $this->direccion->create([
            'idpersona' => $idPersona,
            'nombre'    => $nombre
        ]);

        header('Location: /ibm5a/public/direccion?status=' . ($ok ? 'created' : 'error'));
        exit;
    }

    /** Mostrar formulario de edición */
    public function edit(int $id): void
    {
        $direccion = $this->direccion->find($id);
        if (!$direccion) {
            http_response_code(404);
            exit('Dirección no encontrada');
        }

        $personas = $this->persona->read();
        require $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/views/direccion/edit.php';
    }

    /** Actualizar registro */
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método no permitido');
        }

        $id        = (int)($_POST['iddireccion'] ?? 0);
        $idPersona = trim($_POST['idpersona']    ?? '');
        $nombre    = trim($_POST['nombre']       ?? '');

        if ($id === 0 || $idPersona === '' || $nombre === '') {
            exit('Faltan datos');
        }

        $ok = $this->direccion->update([
            'iddireccion' => $id,
            'idpersona'   => $idPersona,
            'nombre'      => $nombre
        ]);

        header('Location: /ibm5a/public/direccion?status=' . ($ok ? 'updated' : 'error'));
        exit;
    }

    /** Confirmación de borrado (opcional) */
    public function deleteConfirm(int $id): void
    {
        $direccion = $this->direccion->find($id);
        if (!$direccion) {
            http_response_code(404);
            exit('Dirección no encontrada');
        }

        require $_SERVER['DOCUMENT_ROOT'] . '/ibm5a/app/views/direccion/delete.php';
    }

    /** Borrar definitivamente */
    public function destroy(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método no permitido');
        }

        $id = (int)($_POST['iddireccion'] ?? 0);
        if ($id === 0) {
            exit('Faltan datos');
        }

        $ok = $this->direccion->delete($id);

        header('Location: /ibm5a/public/direccion?status=' . ($ok ? 'deleted' : 'error'));
        exit;
    }

    /* ========== API (JSON) ========== */
    public function api(): void
    {
        while (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->direccion->all());
        exit;
    }
}
