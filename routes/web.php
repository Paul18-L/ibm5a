<?php
session_start();

// Incluir los controladores necesarios
require_once '../app/controllers/PersonaController.php';
require_once '../app/controllers/SexoController.php';
require_once '../app/controllers/DireccionController.php';
require_once '../app/controllers/TelefonoController.php';
require_once '../app/controllers/EstadocivilController.php';

$requestUri = $_SERVER["REQUEST_URI"];
$basePath = '/ibm5a/public/';
// Remover el prefijo basePath
$route = str_replace($basePath, '', $requestUri);
$route = strtok($route, '?'); // Quitar parámetros GET

// Función para crear instancia del controlador según nombre
function createController($name) {
    switch ($name) {
        case 'persona':
            return new PersonaController();
        case 'sexo':
            return new SexoController();
        case 'direccion':
            return new DireccionController();
        case 'telefono':
            return new TelefonoController();
        case 'estadocivil':
            return new EstadocivilController();
        default:
            return null;
    }
}

if (empty($route) || $route === '/') {
    // Menú principal
    echo "<h1>Menú de Tablas</h1>";
    echo "<ul>";
    echo "<li><a href='" . $basePath . "persona/index'>Personas</a></li>";
    echo "<li><a href='" . $basePath . "sexo/index'>Sexos</a></li>";
    echo "<li><a href='" . $basePath . "direccion/index'>Direcciones</a></li>";
    echo "<li><a href='" . $basePath . "telefono/index'>Teléfonos</a></li>";
    echo "<li><a href='" . $basePath . "estadocivil/index'>Estados Civiles</a></li>";
    echo "</ul>";
} else {
    switch ($route) {
        // PERSONA
        case 'persona':
        case 'persona/index':
            $controller = createController('persona');
            $controller->index();
            break;
        case 'persona/create':
            $controller = createController('persona');
            $controller->createForm();
            break;
        case 'persona/edit':
            if (isset($_GET['idpersona'])) {
                $controller = createController('persona');
                $controller->edit($_GET['idpersona']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'persona/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = createController('persona');
                $controller->update();
            }
            break;
        case 'persona/view':
            if (isset($_GET['idpersona'])) {
                $controller = createController('persona');
                $controller->registro($_GET['idpersona']);
            } else {
                echo "Error: Falta el ID para ver.";
            }
            break;

        // SEXO
        case 'sexo':
        case 'sexo/index':
            $controller = createController('sexo');
            $controller->index();
            break;
        case 'sexo/edit':
            if (isset($_GET['idsexo'])) {
                $controller = createController('sexo');
                $controller->edit($_GET['idsexo']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'sexo/eliminar':
            if (isset($_GET['idsexo'])) {
                $controller = createController('sexo');
                $controller->eliminar($_GET['idsexo']);
            } else {
                echo "Error: Falta el ID para eliminar.";
            }
            break;
        case 'sexo/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = createController('sexo');
                $controller->delete();
            }
            break;
        case 'sexo/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = createController('sexo');
                $controller->update();
            }
            break;

        // DIRECCION
        case 'direccion':
        case 'direccion/index':
            $controller = createController('direccion');
            $controller->index();
            break;
        case 'direccion/create':
            $controller = createController('direccion');
            $controller->createForm();
            break;
        case 'direccion/edit':
            if (isset($_GET['iddireccion'])) {
                $controller = createController('direccion');
                $controller->edit($_GET['iddireccion']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'direccion/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = createController('direccion');
                $controller->update();
            }
            break;

        // TELEFONO
        case 'telefono':
        case 'telefono/index':
            $controller = createController('telefono');
            $controller->index();
            break;
        case 'telefono/create':
            $controller = createController('telefono');
            $controller->createForm();
            break;
        case 'telefono/edit':
            if (isset($_GET['idtelefono'])) {
                $controller = createController('telefono');
                $controller->edit($_GET['idtelefono']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'telefono/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = createController('telefono');
                $controller->update();
            }
            break;

        // ESTADO CIVIL
        case 'estadocivil':
        case 'estadocivil/index':
            $controller = createController('estadocivil');
            $controller->index();
            break;
        case 'estadocivil/edit':
            if (isset($_GET['idestadocivil'])) {
                $controller = createController('estadocivil');
                $controller->edit($_GET['idestadocivil']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;
        case 'estadocivil/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = createController('estadocivil');
                $controller->update();
            }
            break;
        case 'estadocivil/eliminar':
            if (isset($_GET['idestadocivil'])) {
                $controller = createController('estadocivil');
                $controller->eliminar($_GET['idestadocivil']);
            } else {
                echo "Error: Falta el ID para eliminar.";
            }
            break;
        case 'estadocivil/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = createController('estadocivil');
                $controller->delete();
            }
            break;

        default:
            echo "Error 404: Página no encontrada.";
            break;
    }
}
?>
