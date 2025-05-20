<?php
session_start();

// Cargar controladores
require_once '../app/controllers/PersonaController.php';
require_once '../app/controllers/SexoController.php';
require_once '../app/controllers/DireccionController.php';
require_once '../app/controllers/TelefonoController.php';
require_once '../app/controllers/EstadocivilController.php';

$requestUri = $_SERVER["REQUEST_URI"];
$basePath = '/ibm5a/public/';

// Quitar el prefijo basePath y los parámetros GET
$route = str_replace($basePath, '', $requestUri);
$route = strtok($route, '?');

// Agregar hoja de estilos
echo '<link rel="stylesheet" type="text/css" href="' . $basePath . 'css/stylesMenu.css">';

// Mostrar menú si no hay ruta específica
if (empty($route) || $route === '/') {
    echo "<div class='menu-container'>";
    echo "<h1>Menú de Tablas</h1>";
    echo "<ul class='menu-list'>";
    echo "<li><a href='{$basePath}persona/index'>Personas</a></li>";
    echo "<li><a href='{$basePath}sexo/index'>Sexos</a></li>";
    echo "<li><a href='{$basePath}direccion/index'>Direcciones</a></li>";
    echo "<li><a href='{$basePath}telefono/index'>Teléfonos</a></li>";
    echo "<li><a href='{$basePath}estadocivil/index'>Estados Civiles</a></li>";
    echo "</ul>";
    echo "</div>";
} else {
    switch ($route) {

        // RUTAS PARA PERSONA
        case 'persona':
        case 'persona/index':
            (new PersonaController())->index();
            break;

        case 'persona/create':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                (new PersonaController())->createForm();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new PersonaController())->create();
            }
            break;

        case 'persona/editForm':
            if (isset($_GET['id'])) {
                (new PersonaController())->editForm($_GET['id']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;

        case 'persona/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new PersonaController())->update();
            }
            break;

        case 'persona/deleteForm':
            if (isset($_GET['id'])) {
                (new PersonaController())->deleteForm($_GET['id']);
            } else {
                echo "Error: Falta el ID para eliminar.";
            }
            break;

        case 'persona/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new PersonaController())->delete();
            }
            break;

        // RUTAS PARA SEXO
        case 'sexo':
        case 'sexo/index':
            (new SexoController())->index();
            break;

        case 'sexo/create':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                (new SexoController())->createForm();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new SexoController())->create();
            }
            break;

        case 'sexo/edit':
            if (isset($_GET['idsexo'])) {
                (new SexoController())->edit($_GET['idsexo']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;

        case 'sexo/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new SexoController())->update();
            }
            break;

        case 'sexo/eliminar':
            if (isset($_GET['idsexo'])) {
                (new SexoController())->eliminar($_GET['idsexo']);
            } else {
                echo "Error: Falta el ID para eliminar.";
            }
            break;

        case 'sexo/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new SexoController())->delete();
            }
            break;

        // RUTAS PARA DIRECCION
        case 'direccion':
        case 'direccion/index':
            (new DireccionController())->index();
            break;

        // RUTAS PARA TELEFONO
        case 'telefono':
        case 'telefono/index':
            (new TelefonoController())->index();
            break;

        // RUTAS PARA ESTADO CIVIL
        case 'estadocivil':
        case 'estadocivil/index':
            (new EstadocivilController())->index();
            break;

        case 'estadocivil/create':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                (new EstadocivilController())->createForm();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new EstadocivilController())->create();
            }
            break;

        case 'estadocivil/edit':
            if (isset($_GET['idestadocivil'])) {
                (new EstadocivilController())->edit($_GET['idestadocivil']);
            } else {
                echo "Error: Falta el ID para editar.";
            }
            break;

        case 'estadocivil/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new EstadocivilController())->update();
            }
            break;

        case 'estadocivil/eliminar':
            if (isset($_GET['idestadocivil'])) {
                (new EstadocivilController())->eliminar($_GET['idestadocivil']);
            } else {
                echo "Error: Falta el ID para eliminar.";
            }
            break;

        case 'estadocivil/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                (new EstadocivilController())->delete();
            }
            break;

        default:
            echo "Error 404: Página no encontrada.";
            break;
    }
}
?>
